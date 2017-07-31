<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dependent;
use Illuminate\Support\Facades\DB;

class DependentController extends Controller
{
    /**
     * DependentController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function view()
    {
        $dependents = DB::table('sirtts_dependents')->where('user_id', Auth::id())->get();
        return view('user.dependents.view')
            ->with('count',count($dependents))
            ->with('dependents',$dependents);
    }

    public function create()
    {
        return view('user.dependents.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3|max:255|regex:/[a-zA-Z]/',
            'last_name' => 'required|min:3|max:255',
            'phone_number' => 'numeric|min:6',
            'email' => 'required|email|max:255|unique:sirtts_dependents',
        ]);

       Dependent::create([
                'user_id'=> Auth::id(),
                'first_name' => ucfirst($request['first_name']),
                'last_name' => ucfirst($request['last_name']),
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'gender' => $request['gender'],
                'relation' => $request['relation'],
            ]);
        return redirect(route('dependents'))
            ->with('status','Dependent has been added successfully');
    }

    public function edit($id)
    {
        $dependent = DB::table('sirtts_dependents')->where('id',$id)->first();
        return view('user.dependents.manage')
            ->with('id',$id)
            ->with('dependent',$dependent);
    }

    public function storeEdited(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3|max:255|regex:/[a-zA-Z]/',
            'last_name' => 'required|min:3|max:255',
            'phone_number' => 'numeric|min:6',
            'email' => 'required|email|max:255',
        ]);


        DB::table('sirtts_dependents')
            ->where('id',$request['id'])
            ->update([
            'first_name' => ucfirst($request['first_name']),
            'last_name' => ucfirst($request['last_name']),
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'gender' => $request['gender'],
            'relation' => $request['relation'],
        ]);

        return redirect(route('dependents'))
            ->with('status','Dependent details have been updated successfully');
    }

    public function delete($id)
    {
        DB::table('sirtts_subscribers')
            ->where('dependent_id',$id)
            ->delete();
        
        DB::table('sirtts_dependents')
            ->where('id',$id)
            ->delete();

        return back()
            ->with('warning','Dependent has been deleted');
    }
}
