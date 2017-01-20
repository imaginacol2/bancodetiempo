<?php

namespace App\Http\Controllers;

use DateTime;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $hasImage=false;
        $activities = DB::table('activities')->where('status',1)->where('userleft','<>',0)->where('timeutc','>=',gmdate('U'))->orderBy('timeutc', 'asc')->limit(30)->get();
        $userid = Auth::id();
        $usercoins=DB::table('users')->where('id',$userid)->first();

        if($usercoins){
            $usercoins=$usercoins->hours;
        }


        foreach ($activities as $k=>$activity){
            $activities[$k]->avalible=true;

            $days=["Lun","Mar","Mie","Jue","Vie","Sab","Dom"];
            $mounts=["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
            $userown = DB::table('useractivities')->where('userid',$userid)->where('activityid', $activity->id)->where('userrol',1)->first();

            $activity->userown=false;
            $activity->going=false;
            if($userown){
                $activity->userown=true;
            }

            if(DB::table('useractivities')->where('userid',$userid)->where('activityid', $activity->id)->first()){
                $activity->going=true;
            }

            $activity->timeutc=DateTime::createFromFormat("U", $activity->timeutc);
            $activity->time=[$days[$activity->timeutc->format("N")-1],$activity->timeutc->format("j"),$mounts[$activity->timeutc->format("n")-1]];

            $activity->category=DB::table('activity_categories')->where('activity', $activity->id)->first();

            if(!isset($activity->category)){
                $activity->category=DB::table('activity_categories')->first();
            }

            $activity->hasimage=false;
            if(File::exists('assets/activities/'.$activity->id.'.jpg')){
                $activity->hasimage=true;
            }

        }

        if(File::exists('assets/profiles/'.$userid.'.jpg')){
            $hasImage=true;
        }
        //}
        //avalible

		return view('home',['activities'=>$activities,'hasImage'=>$hasImage,'userid'=>$userid,'usercoins'=>$usercoins]);
    }
}
