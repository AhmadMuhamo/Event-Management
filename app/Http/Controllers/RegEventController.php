<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\RegEventDetails;
use App\Payment;
use App\Subscriber;
use Redirect;
use Paypal;

class RegEventController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');

        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }

    public function eventRegistration($id)
    {
        $user = DB::table('sirtts_user_details')->where('user_id',Auth::user()->id)->first();
        $dependent = DB::table('sirtts_dependents')->where('user_id',Auth::user()->id)->get();
        $event = DB::table('sirtts_events')->where('id',$id)->first();
        $data = DB::table('sirtts_registration_events')->where('event_id',$id)->get();
        
        return view('events.registration.registration')
            ->with('user',$user)
            ->with('dependent',$dependent)
            ->with('event',$event)
            ->with('data',$data);
    }

    public function registrationEventPayFees(Request $request)
    {
        $dependent = DB::table('sirtts_dependents')->where('user_id',Auth::user()->id)->get();
        $disc = DB::table('sirtts_fees')->where('event_id',$request->event_id)->first();
        $event = DB::table('sirtts_events')->where('id',$request->event_id)->first();
        $currency = $disc->currency;
        $disc_amount = $disc->discount;
        $dependent_id = array();
        $course = array();
        $location = array();
        $fee = array();
        $discount = array();
        $amount = 0;

        //user
        if($request->batch_user)
        {
            $temp = DB::table('sirtts_registration_events')->where('course',$request->batch_user)->first();
            array_push($fee,$temp->fees);
            array_push($course,$request->batch_user);
            array_push($location,$request->location_user);
            array_push($dependent_id,0);
        }
        //dependents
        for($i=0;$i<count($dependent);$i++)
        {
            if($request['batch_student'.$i])
            {
                array_push($dependent_id,$request['dependent_id_'.$i]);

                $temp = DB::table('sirtts_registration_events')->where('course',$request['batch_student'.$i])->first();
                array_push($fee,$temp->fees);
                array_push($course,$request['batch_student'.$i]);
                array_push($location,$request['location_student'.$i]);
            }
        }
        $event_fee = DB::table('sirtts_fees')->where('event_id',$request->event_id)->first();
        $applicants = $event_fee->applicants;
        //discount
        if($event_fee->type == 'Structured')
        {
            $j = 0;
            $temp = 0;
            for($i=0;$i<count($fee);$i++)
            {
                if($i==0)
                    {
                        $discount[$i] = $fee[$i];
                        $j++;
                    }
                else if($i <= $applicants)
                {
                    $temp = $fee[$i]-$disc_amount*$j;
                    $discount[$i] = $temp;
                    $temp2=$fee[$i]-$temp;
                    $j++;
                }
                else
                {
                    $discount[$i] =$fee[$i]-$temp2;
                }
            }
        }
        else if($event_fee->type == 'Flat')
        {
            for($i=0;$i<count($fee);$i++)
            {
                $discount[$i] = $fee[$i]-$disc_amount;
            }
        }
                    
        //amount
        for($i=0;$i<count($fee);$i++)
        {
            $amount +=$discount[$i];
        }

        session(['dependent_id' => $dependent_id]);
        session(['course' => $course]);
        session(['location' => $location]);
        session(['fees'=>$fee]);
        session(['discount'=>$discount]);

        $total_discount = array_sum($fee)-array_sum($discount);

        if($amount==0)
        {
            return back()->with('warning','You need to select at least one subscriber');
        }
        else
        {
            return view('events.registration.checkout')
            ->with('event',$event)
            ->with('amount',$amount)
            ->with('currency',$currency)
            ->with('batch',$course)
            ->with('fee',$fee)
            ->with('discount',$discount)
            ->with('total_discount',$total_discount);
        }
        
    }

    public function getCheckout()
    {
        $event_id = $_POST['id'];
        $event = DB::table('sirtts_events')->where('id', $event_id)->first();
        $fee = $_POST['amount'];
        $currency = $_POST['currency'];

        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal:: Amount();
        $amount->setCurrency($currency);
        $amount->setTotal($fee);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($event->event_name);

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(route('registration.checkout.completed',$event_id));
        $redirectUrls->setCancelUrl(route('registration.checkout.canceled',$event_id));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to( $redirectUrl );
    }

    public function getDone(Request $request)
    {
        $event_id = $request->event_id;
        $event = DB::table('sirtts_events')->where('id', $event_id)->first();
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');


        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        $details = Paypal::getById($id, $this->_apiContext);

        $course = session('course');
        $location = session('location');
        $dependent_id = session('dependent_id');
        $discount = session('discount');

        for($i=0;$i<count($discount);$i++)
        {
            if($course[$i])
            {
                if($dependent_id[$i] == 0)
                {

                    RegEventDetails::create([
                        'event_id' => $event_id,
                        'user_id' => Auth::id(),
                        'course' => $course[$i],
                        'location' => $location[$i],
                        'transaction_id' => $id,
                        'fees' => $discount[$i]
                    ]);

                    Subscriber::create([
                        'event_id'=>$event_id,
                        'user_id'=>Auth::id(),
                    ]);
                }
                else
                {
                    RegEventDetails::create([
                        'event_id' => $event_id,
                        'user_id' => Auth::id(),
                        'dependent_id' => $dependent_id[$i],
                        'course' => $course[$i],
                        'location' => $location[$i],
                        'transaction_id' => $id,
                        'fees' => $discount[$i]
                    ]);

                    Subscriber::create([
                        'event_id'=>$event_id,
                        'user_id'=>Auth::id(),
                        'dependent_id'=>$dependent_id[$i],
                    ]);
                }

            }
        }

        Payment::create([
            'user_id'=>Auth::id(),
            'event_id'=>$event_id,
            'payment_method'=>$details->payer->payment_method,
            'status'=>$details->transactions[0]->related_resources[0]->sale->state,
            'amount'=>$details->transactions[0]->amount->total." ".$details->transactions[0]->amount->currency,
            'payment_id'=>$id,
            'payer_id'=>$payer_id,
            'refund_url'=>$details->transactions[0]->related_resources[0]->sale->links[1]->href
        ]);

        return view('events.payment.success')
            ->with('event',$event)
            ->with('status','Your transaction is completed');
    }
    public function getCancel(Request $request)
    {
        $event_id = $request->event_id;
        $event = DB::table('sirtts_events')->where('id', $event_id)->first();
        return view('events.payment.canceled')
            ->with('event',$event)
            ->with('status','Your transaction has been canceled');
    }
}
