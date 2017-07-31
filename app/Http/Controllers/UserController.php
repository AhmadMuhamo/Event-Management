<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDetails;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Dependent;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    protected function validator(array $data)
    {
        //
    }

    public function index()
    {
        $user_det = DB::table('sirtts_user_details')->where('user_id', Auth::id())->first();
        $dependents = DB::table('sirtts_dependents')->where('user_id', Auth::id())->get();

            if(count($dependents)==0)
            {
                return view('user.profile.profile')->with('user', Auth::user())
                    ->with('user_det',$user_det)
                    ->with('count',0) ;
            }
            else
            {

                return view('user.profile.profile')->with('user', Auth::user())
                    ->with('user_det',$user_det)
                    ->with('count',count($dependents))
                    ->with('dependents',$dependents);
            }

    }

    public function update()
    {
        $user_det = DB::table('sirtts_user_details')->where('user_id', Auth::id())->first();
        return view('user.profile.update')
            ->with('user', Auth::user())
            ->with('user_det',$user_det);
    }

    protected function store(Request $data)
    {
        $this->validate($data, [
            'first_name' => 'required|min:3|max:255|regex:/[a-zA-Z]/',
            'last_name' => 'required|min:3|max:255',
            'birthday' => 'required|regex:/^(\d{1,2})-(\d{1,2})-(\d{4})$/',
            'primary_phone' => 'numeric|min:6',
            'other_phone' => 'nullable|numeric|min:6',
            'postal_code' => 'max:8',
        ]);
        $birthday = $data['birthday'];
        if($birthday=='') $birthday = NULL;
        else $birthday = date('Y-m-d',strtotime($birthday));
         DB::table('sirtts_user_details')
                    ->where('user_id',Auth::id())
                    ->update([
                        'first_name' => ucfirst($data['first_name']),
                        'last_name' => ucfirst($data['last_name']),
                        'gender' => $data['gender'],
                        'birth_date' => $birthday,
                        'primary_phone' => $data['primary_phone'],
                        'other_phone' => $data['other_phone'],
                        'country' => $data['country'],
                        'city' => $data['city'],
                        'postal_code' => $data['postal_code'],
                        'address' => $data['address'],
                        'address_line2' => $data['address_line2'],
                        'billing_address' => $data['billing_address'],
                        'billing_address_line2' => $data['billing_address_line2'],
                    ]);
        return redirect(route('profile'))
            ->with('status','Profile info has been updated successfully');

    }

}
