<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GrowController extends Controller
{
    public function run(){
        $today=date('Y-m-d');
        $tasks=DB::table('tasks')->where('enddate','>',$today)->get();

        foreach($tasks as $task){
            $task=(array)$task;
            $task['paydate']=$today;
            unset($task['enddate']);
            unset($task['tid']);
            DB::table('grows')->insert($task);
        }

        return 'ok';
    }

    public function myzd(){
        //$user=\Auth::user();
        //$hks=DB::table('hks')->where('uid','=',$user->uid)->get();
        $hks=DB::table('hks')->get();
        return view('myzd',['hks'=>$hks]);
    }

    public function mytz(){
        $user=\Auth::user();
        $bids=DB::table('bids')->where('bids.uid','=',$user->uid)->whereIn('status',[1,2])->join('projects','bids.pid','=','projects.pid')->get(['bids.*','projects.status']);
        return view('mytz',['bids'=>$bids]);
    }

    public function mysy(){
        $user=\Auth::user();
        $grows=DB::table('grows')->where('uid','=',$user->uid)->orderBy('gid','desc')->get();
        return view('mysy',['grows'=>$grows]);
    }
}
