<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\Fee;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = array();
        $date = date('Y-m-d');
        $temp_recent = Event::orderBy('created_at', 'desc')->get();
        $recent = array();
        $fees = Fee::all();


        $event = DB::table('sirtts_subscribers')->select('event_id')->where([
            ['user_id',Auth::user()->id],
            ['dependent_id','=',NULL],
            ])->distinct()->get();

        for($i=0;$i<count($event);$i++)
        {
            $temp = DB::table('sirtts_events')->where('id',$event[$i]->event_id)->first();
            if(strtotime($temp->start_date)>=strtotime($date))
            {
                array_push($events,$temp);
            }
            
        }

        for ($i=0; $i < count($temp_recent); $i++) { 
            if(strtotime($temp_recent[$i]->start_date)>=strtotime($date))
            {
                if($i<6)
                {
                    array_push($recent,$temp_recent[$i]);
                }
                else
                {
                    break;
                }
            }
        }

        $count = count($events);
        
        return view('home')
            ->with('events',$events)
            ->with('count',$count)
            ->with('recent',$recent)
            ->with('fees',$fees);
    }
}
