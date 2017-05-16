<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pro;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        $pros=Pro::where('status','=',1)->take(3)->get();
        return view('index',['pros'=>$pros]);
    }
}
