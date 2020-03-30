<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Foundation\Auth\User;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id =  Auth::user()->id;
        $admin_value =  Auth::user()->admin;
        if($admin_value === 1){
            $user = User::all();
            $report = Report::with('user')->select('id','user_id','user_report','date')->get();
        }elseif ($admin_value === 2){
            $user = User::all();
            $report = Report::with('user')->select('id','user_id','user_report','date')->get();
        }else{
            $report = Report::with('user')->where('user_id',$id)->get();
            $user = User::find($id);
        }
//        dd($report);

        return view('home')->with(['user'=>$user,'report'=>$report,'admin_code'=>$admin_value]);
    }

    public  function next_date(Request $request){
            dd($request->all());
    }

    public function add(Request $request)
    {
        Report::saveTasts($request);
        return json_encode(true);
    }
    public function filter_user(Request $request)
    {
        $user_id = $request->user_name;
        if($user_id == 0){
            $report =  Report::with('user')->get();
        }else{
            $report =  Report::with('user')->where('user_id',$user_id)->get();
        }
        $user = User::all();
        return view('home')->with(['user'=>$user,'report'=>$report,'user_id'=>$user_id]);
    }

    public function filter_date(Request $request)
    {
        $user_id = $request->user_id;
        $date = $request->data;
        if(Auth::user()->admin == 0){
            $report =  Report::with('user')->where('date',$date)->where('user_id',Auth::user()->id)->orderBy('user_id','asc')->get();
            $user = User::find(Auth::user()->id);
        }else{
            if($user_id){
                $report =  Report::with('user')->where('date',$date)->where('user_id',$user_id)->orderBy('user_id','asc')->get();
                $user = User::all();
            }else{
                $report =  Report::with('user')->where('date',$date)->orderBy('user_id','asc')->get();
                $user = User::all();
            }
            //        foreach ($report as $item){
            //            $report1 =  Report::where('date',$date)->orderBy('user_id','asc')->distinct('user_id')->get();
            //            dd($report1);
            //        }
        }
//        dd($report[0]->user['name']);
        $arr = [
           'report'=> $report,
            'user'=>$user
        ];
        return json_encode($arr);
    }
}
