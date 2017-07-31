<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\User;
use App\UserDetails;
use App\Fee;
use App\RegEvent;
use App\Subscriber;
use Carbon\Carbon;
use Paypal;

class AdminController extends Controller
{

    /**
     * AdminController constructor.
     */

    private $_apiContext;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

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
        return view('home');
    }
    public function createEvent()
    {
        return view('admin.events.create');
    }

    public function createRegistrationEvent()
    {
        return view('admin.events.registration.create');
    }

    public function storeEvent(Request $data)
    {
        $this->validate($data, [
            'event_name' => 'required|min:4|max:255|regex:/[a-zA-Z]/',
            'start_date' => 'required|date',
            'location' => 'required',
        ]);

        $event = Event::create([
                'event_name' => ucfirst($data['event_name']),
                'event_type' => 'Event',
                'description' => $data['event_description'],
                'start_date' => $data['start_date'],
                'start_time' => $data['start_time'],
                'end_date' => $data['end_date'],
                'end_time' => $data['end_time'],
                'location' => $data['location'],
                'fees' => $data['fees'],
            ]);

        if($event->fees =='Yes')
        {
            Fee::create([
                'event_id'=>$event->id,
                'type' => $data['type'],
                'fee' => $data['fee'],
                'currency' => $data['currency'],
                'discount' => $data['discount'],
                'applicants' => $data['applicants']
            ]);
        }
        return redirect(route('events'))
            ->with('status','Event has been created');
    }

    public function storeRegistrationEvent(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required|min:4|max:255|regex:/[a-zA-Z]/',
            'start_date' => 'required|date',
        ]);
        if(count($request['location'])>1)
        {
            $event = Event::create([
                'event_name' => ucfirst($request['event_name']),
                'event_type' => 'Registration',
                'description' => $request['event_description'],
                'start_date' => $request['start_date'],
                'start_time' => $request['start_time'],
                'end_date' => $request['end_date'],
                'end_time' => $request['end_time'],
                'location' => 'Multiple Locations',
                'fees' => 'Yes',
            ]);
        }
        else
        {
            $event = Event::create([
                'event_name' => ucfirst($request['event_name']),
                'event_type' => 'Registration',
                'description' => $request->event_description,
                'start_date' => $request->start_date,
                'start_time' => $request->start_time,
                'end_date' => $request->end_date,
                'end_time' => $request->end_time,
                'location' => $request->location[0],
                'fees' => 'Yes',
            ]);
        }

        Fee::create([
                'event_id'=>$event->id,
                'type' => $request->type,
                'fee' => $request->fee[0],
                'currency' => $request->currency,
                'discount' => $request->discount,
                'applicants' => $request->applicants,
            ]);

        for ($i=0; $i < count($request->course); $i++) {
            if(array_key_exists($i, $request->location)) 
            {
                RegEvent::create([
                            'event_id'=>$event->id,
                            'course'=>$request->course[$i],
                            'fees'=>$request->fee[$i],
                            'currency'=>$request->currency,
                            'location'=>$request->location[$i],
                            ]);
            }
            else
            {
                RegEvent::create([
                            'event_id'=>$event->id,
                            'course'=>$request->course[$i],
                            'fees'=>$request->fee[$i],
                            'currency'=>$request->currency,
                            ]);
            }
                            

        }

        return redirect(route('events'))
            ->with('status','Event has been created');
    }

    public function editEvent($id)
    {
        $event = DB::table('sirtts_events')->where('id', $id)->first();
        if($event->fees == 'Yes')
        {
            $fee = DB::table('sirtts_fees')->where('event_id', $id)->first();
                return view('admin.events.manage')
                    ->with('id',$id)
                    ->with('event',$event)
                    ->with('fee',$fee)
                    ->with('status','Event has been updated');
        }
        return view('admin.events.manage')
            ->with('id',$id)
            ->with('event',$event)
            ->with('status','Event has been updated');
    }

    public function deleteEvent($id)
    {
        DB::table('sirtts_fees')
        ->where('event_id',$id)
        ->delete();

        DB::table('sirtts_subscribers')
        ->where('event_id',$id)
        ->delete();

        DB::table('sirtts_events')
            ->where('id',$id)
            ->delete();

        return redirect(route('events'))
            ->with('warning','Event has been deleted');
    }

    public function saveEvent(Request $data)
    {
        $this->validate($data, [
            'event_name' => 'required|min:4|max:255|regex:/[a-zA-Z]/',
            'start_date' => 'required|date',
            'location' => 'required',
            'type' =>'regex:/[a-zA-Z]/'
        ]);

        DB::table('sirtts_events')
            ->where('id',$data['event_id'])
            ->update([
                'event_name' => ucfirst($data['event_name']),
                'description' => $data['event_description'],
                'start_date' => $data['start_date'],
                'start_time' => $data['start_time'],
                'end_date' => $data['end_date'],
                'end_time' => $data['end_time'],
                'location' => $data['location'],
        ]);

        if($data->amount)
        {
            DB::table('sirtts_fees')
                ->where('event_id',$data['event_id'])
                ->update([
                    'fee'=>$data['amount'],
                    'currency' => $data['currency'],
                    'discount' => $data['discount'],
                    'applicants' => $data['applicants']
            ]);
        }
        return redirect()->route('event.view',$data['event_id'])->with('status','Event has been updated');
    }

    public function manageEvents()
    {
        $subscribers = Subscriber::all();

        $ids = array();
        $events = array();
        for($i=0;$i<count($subscribers);$i++)
        {
            array_push($ids,$subscribers[$i]->event_id);
        }
        $ids = array_unique($ids);
        $ids_filtered = array_values($ids);
        for($i=0;$i<count($ids);$i++)
        {
            array_push($events,DB::table('sirtts_events')->where('id', $ids_filtered[$i])->first());
        }

        return view('admin.events.manage_all')
                ->with('count',count($events))
                ->with('events',$events);
    }

    public function eventManage($id)
    {
        $event = DB::table('sirtts_events')->where('id', $id)->first();
        $subscribers = DB::table('sirtts_subscribers')->where('event_id', $id)->get();

        return view('admin.events.manage_event')
                ->with('event',$event)
                ->with('subscribers',$subscribers);
    }

    public function manageUsers()
    {
        $users = User::all();
        $dependents = array();
        
        for($i=0;$i<count($users);$i++)
        {
            if($temp = DB::table('sirtts_dependents')->where('user_id', $users[$i]->id)->get())
            {
                array_push($dependents,count($temp));
            }
            else array_push($dependents,0);
            
        }

        return view('admin.accounts.manage_users')
                ->with('users',$users)
                ->with('dependents',$dependents);
    }

    public function manageUser($user_id)
    {
        $user = DB::table('sirtts_users')->where('id', $user_id)->first();
        $user_details = DB::table('sirtts_user_details')->where('user_id', $user_id)->first();
        $dependents = DB::table('sirtts_dependents')->where('user_id', $user_id)->get();


        return view('admin.accounts.manage')
                ->with('user',$user)
                ->with('user_det',$user_details)
                ->with('dependents',$dependents);
    }

    public function createAccount()
    {
        return view('admin.accounts.create');
    }

    public function storeAccount(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:sirtts_users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'activated' => true,
                'admin' => $request['admin'],
            ]);

        UserDetails::create(['user_id' => $user->id]);
        return redirect('home')->with('status','Account has been created');
    }

    public function paymentDetails(Request $request)
    {
        return view('admin.payments.payment');
    }
    public function getPaymentDetails(Request $request)
    {
        $id = $request->payment_id;
        $details = Paypal::getById($id, $this->_apiContext);

        $method = $details->payer->payment_method;
        $status = (string) $details->transactions[0]->related_resources[0]->sale->state;
        $amount = $details->transactions[0]->amount->total." ".$details->transactions[0]->amount->currency;
        $refund_url = $details->transactions[0]->related_resources[0]->sale->links[1]->href;
        $payer_email = $details->payer->payer_info->email;
        $payer_id = $details->payer->payer_info->payer_id;
        $payer_first_name = $details->payer->payer_info->first_name;
        $payer_last_name = $details->payer->payer_info->last_name;
        $payer_phone = $details->payer->payer_info->phone;
        $payer_country = $details->payer->payer_info->country_code;
        $shipping_name = $details->payer->payer_info->shipping_address->recipient_name;
        $shipping_address_line1 = $details->payer->payer_info->shipping_address->line1;
        $shipping_city = $details->payer->payer_info->shipping_address->city;
        $shipping_state = $details->payer->payer_info->shipping_address->state;
        $shipping_country = $details->payer->payer_info->shipping_address->country_code;
        $shipping_postal_code = $details->payer->payer_info->shipping_address->postal_code;
        $event_name = $details->transactions[0]->description;
        $fee = $details->transactions[0]->related_resources[0]->sale->transaction_fee->value." ".$details->transactions[0]->related_resources[0]->sale->transaction_fee->currency;
        $creation_time = date('M j, Y  g:i a - T',strtotime($details->transactions[0]->related_resources[0]->sale->create_time));


        return view('admin.payments.details')
                ->with('payment_id',$id)
                ->with('method',$method)
                ->with('status',$status)
                ->with('amount',$amount)
                ->with('refund_url',$refund_url)
                ->with('payer_email',$payer_email)
                ->with('payer_id',$payer_id)
                ->with('payer_first_name',$payer_first_name)
                ->with('payer_last_name',$payer_last_name)
                ->with('payer_phone',$payer_phone)
                ->with('payer_country',$payer_country)
                ->with('shipping_name',$shipping_name)
                ->with('shipping_address_line1',$shipping_address_line1)
                ->with('shipping_city',$shipping_city)
                ->with('shipping_state',$shipping_state)
                ->with('shipping_country',$shipping_country)
                ->with('shipping_postal_code',$shipping_postal_code)
                ->with('event_name',$event_name)
                ->with('fee',$fee)
                ->with('creation_time',$creation_time);
    }
}
