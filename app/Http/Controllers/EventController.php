<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\Fee;
use App\Subscriber;
use Paypal;
use Redirect;
use App\Payment;

class EventController extends Controller
{
    /**
     * EventController constructor.
     */
    private $_apiContext;

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

    public function index()
    {
        return view('admin.events.view');
    }

    public function view($id)
    {
        $subscribed = false;
        $event = DB::table('sirtts_events')->where('id', $id)->first();
        $registered = false;
        if(DB::table('sirtts_subscribers')->where([['user_id',Auth::user()->id],['event_id',$id]])->first())
        {
            $registered = true;
        }

        $flag = DB::table('sirtts_subscribers')->select('user_id')->where([
            ['event_id',$id],
            ['user_id',Auth::user()->id],
            ])->get();

        if(count($flag)>0)
        {
            $subscribed = true;
        }
        if($event->fees == 'Yes')
        {
            $fee = DB::table('sirtts_fees')->where('event_id', $id)->first();
                    return view('events.view')
                        ->with('id',$id)
                        ->with('event',$event)
                        ->with('fee',$fee)
                        ->with('subscribed',$subscribed)
                        ->with('registered',$registered);
        }
        return view('events.view')
            ->with('id',$id)
            ->with('event',$event)
            ->with('subscribed',$subscribed);
    }

    public function viewAll()
    {
        $date = date('Y-m-d');
        $events = array();
        $temp = Event::all();
        for ($i=0; $i < count($temp); $i++) { 
            if(strtotime($temp[$i]->start_date)>=strtotime($date))
            {
                array_push($events,$temp[$i]);
            }
        }

        $fees = Fee::all();

        return view('events.all')
            ->with('events',$events)
            ->with('count',count($events))
            ->with('fees',$fees)
            ->with('sortEvent','');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $keywords = array();
        $keywords = explode(' ', $keyword);
        $events = array();
        $temp = array();
        $date = date('Y-m-d');

        for($i=0;$i<count($keywords);$i++)
        {
            array_push($temp,Event::where([
                ['event_name', 'LIKE', '%'.$keywords[$i].'%'],
                ['start_date', '>=', $date],
                ])->orWhere([
                ['description', 'LIKE', '%'.$keywords[$i].'%'],
                ['start_date', '>=', $date],
                ])->get());
        }

        for($i=0;$i<count($temp);$i++)
        {
            for($j=0;$j<count($temp[$i]);$j++)
            {
                array_push($events,$temp[$i][$j]);
            }
        }
                //$events = array_unique($events);

        for($i=0;$i<count($events);$i++)
        {
            for($j=$i+1;$j<count($events);$j++)
            {
                if($events[$i]->id==$events[$j]->id)
                {
                    array_splice($events,$j,1);
                }
            }
        }

        $count = count($events);
        $fees = Fee::all();

        if($count==0)
        {
            return view('events.all')
                ->with('count',0)
                ->with('warning','No events found.')
                ->with('sortEvent','');
        }
        else
        {
        return view('events.all')
            ->with('events',$events)
            ->with('count',$count)
            ->with('fees',$fees)
            ->with('sortEvent','');
        }
    }

    public function sort(Request $request)
    {
        $sort = $request->sortEvents;
        $date = date('Y-m-d');
        if($sort=='alpha_a_z')
        {
            
            $events = Event::where('start_date', '>=', $date)->orderBy('event_name')->get();
            $fees = Fee::all();

            return view('events.all')
                ->with('events',$events)
                ->with('count',count($events))
                ->with('fees',$fees)
                ->with('sortEvent',$sort);
        }
        elseif($sort=='alpha_z_a')
        {
            $events = Event::where('start_date', '>=', $date)->orderBy('event_name', 'desc')->get();
            $fees = Fee::all();

            return view('events.all')
                ->with('events',$events)
                ->with('count',count($events))
                ->with('fees',$fees)
                ->with('sortEvent',$sort);
        }
        elseif($sort=='free')
        {
            $events = $events = Event::where('start_date', '>=', $date)->orderBy('fees')->get();
            $fees = Fee::all();

            return view('events.all')
                ->with('events',$events)
                ->with('count',count($events))
                ->with('fees',$fees)
                ->with('sortEvent',$sort);
        }
        elseif($sort=='paid')
        {
            $events = $events = Event::where('start_date', '>=', $date)->orderBy('fees', 'desc')->get();
            $fees = Fee::all();

            return view('events.all')
                ->with('events',$events)
                ->with('count',count($events))
                ->with('fees',$fees)
                ->with('sortEvent',$sort);
        }
        elseif($sort=='old_to_new')
        {
            $events = $events = Event::where('start_date', '>=', $date)->orderBy('created_at')->get();
            $fees = Fee::all();

            return view('events.all')
                ->with('events',$events)
                ->with('count',count($events))
                ->with('fees',$fees)
                ->with('sortEvent',$sort);
        }
        elseif($sort=='new_to_old')
        {
            $events = $events = Event::where('start_date', '>=', $date)->orderBy('created_at', 'desc')->get();
            $fees = Fee::all();

            return view('events.all')
                ->with('events',$events)
                ->with('count',count($events))
                ->with('fees',$fees)
                ->with('sortEvent',$sort);
        }

    }

    public function subscribe($id)
    {
        $user = DB::table('sirtts_user_details')->where('user_id',Auth::user()->id)->first();
        $dependent = DB::table('sirtts_dependents')->where('user_id',Auth::user()->id)->get();
        $event = DB::table('sirtts_events')->where('id',$id)->first();

        return view('events.subscription')
            ->with('user',$user)
            ->with('dependent',$dependent)
            ->with('event_id',$id)
            ->with('event_name',$event->event_name)
            ->with('event',$event)
            ->with('fees',$event->fees);
    }
    public function Unsubscribe($id)
    {
        $event = DB::table('sirtts_events')->where('id',$id)->first();

        if($event->fees == 'No')
        {
            DB::table('sirtts_subscribers')->where([
                ['event_id', '=', $id],
                ['user_id','=',Auth::user()->id],
                ])->delete();

            return back()->with('warning', 'Unsubscribed!');
        }
        else
        {
            return back()->with('warning', 'Error!');
        }
    }

    public function subscription(Request $request,$event_id)
    {
        $event = DB::table('sirtts_events')->where('id',$event_id)->first();
        $dependents = DB::table('sirtts_dependents')->where('user_id',Auth::user()->id)->get();
        $dependent_id = array();

        for($i=0;$i<count($dependents);$i++)
        {
            if($request['dependent_id_'.$i]) array_push($dependent_id,$request['dependent_id_'.$i]);
        }
        if(!$request->user_id and count($dependent_id)==0)
        {
            return back()->with('warning','You need to select at least one subscriber');
        }
        else
        {
            if($event->fees =='No')
            {
                if($request->user_id)
                {
                    Subscriber::create([
                        'event_id'=>$event_id,
                        'user_id'=>Auth::id(),
                    ]);
                }
                for($i=0;$i<count($dependent_id);$i++)
                {
                    Subscriber::create([
                        'event_id'=>$event_id,
                        'user_id'=>Auth::id(),
                        'dependent_id'=>$dependent_id[$i]
                    ]);
                }
                return redirect(route('event.view',$event_id))
                    ->with('status', 'Subscribed!');
            }
            else
            {
                $fee = DB::table('sirtts_fees')->where('event_id',$event_id)->first();

                if($request->user_id)
                {
                    $multiplier = count($dependent_id)+1;
                }
                else
                {
                    $multiplier = count($dependent_id);
                }

                if($fee->type == 'Flat')
                {
                    $discount = 0;
                    if($fee->discount)  $discount = $fee->discount;
                    $amount = $fee->fee-$discount;
                    $currency = $fee->currency;

                    $final_fee = array();
                    for($i=0;$i<$multiplier;$i++)
                    {
                        array_push($final_fee,$amount);
                    }
                    if($request->user_id) session(['user' => true]);
                    session(['dependent_id' => $dependent_id]);
                    session(['count' => $multiplier]);

                    return view('events.payment.checkout')
                        ->with('amount',$multiplier*$amount)
                        ->with('discount',$discount)
                        ->with('currency',$currency)
                        ->with('event_id',$event_id)
                        ->with('count',$multiplier)
                        ->with('event_name',$event->event_name)
                        ->with('event',$event)
                        ->with('final_fee',$final_fee)
                        ->with('fee',$fee->fee);
                }
                elseif($fee->type =='Structured')
                {
                    $discount = $fee->discount;
                    $applicants = $fee->applicants;

                    $final_fee = array();
                    $j=0;
                    $temp = 0;
                    for($i=0;$i<$multiplier;$i++)
                    {
                        if($i==0)
                        {
                            array_push($final_fee,$fee->fee);
                            $j++;
                        }
                        else
                        {
                            if($i<=$applicants)
                            {
                                $temp = $final_fee[0]-$discount*$j;
                                array_push($final_fee,$temp);
                                $j++;
                            }
                            else array_push($final_fee,$temp);
                        }

                    }

                    $amount = array_sum($final_fee);
                    $currency = $fee->currency;

                    if($request->user_id) session(['user' => true]);
                    session(['dependent_id' => $dependent_id]);
                    session(['count' => $multiplier]);

                    return view('events.payment.checkout')
                        ->with('amount',$amount)
                        ->with('discount',$discount)
                        ->with('currency',$currency)
                        ->with('event_id',$event_id)
                        ->with('count',$multiplier)
                        ->with('event',$event)
                        ->with('event_name',$event->event_name)
                        ->with('final_fee',$final_fee)
                        ->with('fee',$fee->fee);
                }
            }
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
        $redirectUrls->setReturnUrl(route('checkout.completed',$event_id));
        $redirectUrls->setCancelUrl(route('checkout.canceled',$event_id));

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
        $dependent_id = session('dependent_id');
        $user = session('user');


        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');


        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);
        //Paypal::getAll(array('count' => 100, 'start_index' => 0), $this->_apiContext);

        $details = Paypal::getById($id, $this->_apiContext);

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

        if($user)
        {
            Subscriber::create([
                'event_id'=>$event_id,
                'user_id'=>Auth::id()
            ]);
        }
            for($i=0;$i<count($dependent_id);$i++)
            {
                Subscriber::create([
                    'event_id'=>$event_id,
                    'user_id'=>Auth::id(),
                    'dependent_id'=>$dependent_id[$i]
                ]);
            }

       return view('events.payment.success')
           ->with('id',$event_id)
           ->with('event',$event)
           ->with('status','Your transaction is completed');
    }
    public function getCancel(Request $request)
    {
        $event_id = $request->event_id;
        $event = DB::table('sirtts_events')->where('id', $event_id)->first();
        
        return view('events.payment.canceled')
            ->with('id',$event_id)
            ->with('event',$event)
            ->with('status','Your transaction has been canceled');
    }
}