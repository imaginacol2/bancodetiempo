<?php

namespace App\Http\Controllers;

use DateTime;
use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
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

    function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public function getActivityForm(){
        if(Auth::guest()){
            return view('auth.login');
        }

        $categories=DB::table('categories')->get();

        return view('auth.createactivity',["categories"=>$categories]);
    }

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function setActivity(){
        if(Auth::guest()){
            return view('auth.noconfirmclass',['message'=>"No se encuentra en el sistema"]);
        }
        $userid = Auth::id();
        $input = Input::get();
        if($input["userlimit"]!=0){
            $userleft=$input["userlimit"];
        } else {
            $userleft=1;
        }


        $activityID=DB::table('activities')->insertGetId(['title' => $input["title"], 'slug' => $this->slugify($input["title"]),'description'=>$input["description"],'place'=>$input["place"],'duration'=>$input["duration"],'userlimit'=>$input["userlimit"],'timeutc'=>(strtotime($input["time"])+(5*60*60)),'userleft'=>$userleft]);
        DB::table('activity_categories')->insert(['activity'=>$activityID,'category'=>$input["category"]]);
        DB::table('useractivities')->insert(['userid'=>$userid,'activityid'=>$activityID,'userrol'=>1]);
        return redirect('/activity/'.$this->slugify($input["title"]).'/'.$activityID);
    }

    public function assistActivity($id){

        if(Auth::guest()){
            return view('auth.login');
        }

        $userid = Auth::id();

        if($id==0){
            return view('auth.noconfirmclass',['message'=>"Usted ya se encuentra logueado"]);
        }

        $activity = DB::table('activities')->where('id',$id)->first();
        if(!$activity || $activity->status==0){
            return view('auth.noconfirmclass',['message'=>"La actividad no se ha encontrado"]);
        };

        $userinactivity = DB::table('useractivities')->where('userid',$userid)->where('activityid',$id)->first();

        if($userinactivity){
            if($userinactivity->userrol==1) {
                DB::table('activities')->where('id', $activity->id)->update(['status' => 0]);
                return view('auth.noconfirmclass',['message'=>"La actividad ha sido cancelada"]);
            } else {
                DB::table('useractivities')->where('userid', $userid)->where('activityid', $activity->id)->delete();
            }

            if($activity->userlimit!=0){
                DB::table('activities')->where('id', $activity->id)->increment('userleft');
            }
            return view('auth.noconfirmclass',['message'=>"Se te ha eliminado de la actividad"]);
        }

        if($activity->userleft==0 && $activity->userlimit!=0){
            return view('auth.noconfirmclass',['message'=>"Ya no hay cupos disponibles para la actividad"]);
        }

        DB::table('activities')->where('id', $activity->id)->decrement('userleft');
        DB::table('useractivities')->insert(['userid' => $userid, 'activityid' => $activity->id,'userrol'=>0]);

        return view('auth.confirmclass');
    }

    public function getActivity($slug,$id)
    {
        $activity = DB::table('activities')->where('id',$id)->where('slug', $slug)->first();

        if(!$activity){
            return redirect('/');
        };

        $days=["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo"];
        $mounts=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        $userid = Auth::id();

        $usercoins=DB::table('users')->where('id',$userid)->first();
        $usercoins=$usercoins->hours;

        $activity->timeutc=DateTime::createFromFormat("U", $activity->timeutc);
        $activity->time=[$days[$activity->timeutc->format("N")-1],$activity->timeutc->format("j"),$mounts[$activity->timeutc->format("n")-1]];

        $userown = DB::table('useractivities as ua')->join("users as us",'ua.userid', '=' ,'us.id')->where('ua.activityid',$id)->where('userrol',1)->first();

        $activity->going=false;
        $activity->userown=false;
        if(DB::table('useractivities')->where('userid',$userid)->where('activityid', $activity->id)->where('userrol',1)->first()){
            $activity->userown=true;
        }

        if(DB::table('useractivities')->where('userid',$userid)->where('activityid', $activity->id)->first()){
            $activity->going=true;
        }

        $userown->image=false;
        if(File::exists('assets/profiles/'.$userown->id.'.jpg')){
            $userown->image=true;
        }

        $usersassist = DB::table('useractivities as ua')->join("users as us",'ua.userid', '=' ,'us.id')->where('ua.activityid',$id)->where('userrol',0)->get();

        $hasImage=false;
        if(File::exists('assets/profiles/'.$userid.'.jpg')){
            $hasImage=true;
        }

        $activity->hasimage=false;
        if(File::exists('assets/activities/'.$activity->id.'.jpg')){
            $activity->hasimage=true;
        }

        $activity->category=DB::table('activity_categories')->where('activity', $activity->id)->first();
        if(!isset($activity->category)){
            $activity->category=DB::table('activity_categories')->first();
        }


		return view('activity',['activity'=>$activity,'hasImage'=>$hasImage,'userown'=>$userown,'usersassist'=>$usersassist,'usercoins'=>$usercoins]);
    }
}
