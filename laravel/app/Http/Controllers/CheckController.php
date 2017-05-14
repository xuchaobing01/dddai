<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pro;
use App\Att;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CheckController extends Controller
{
    public function proList(){
        $pros=Pro::orderBy('pid','desc')->get();
        return view('prolist',['pros'=>$pros]);
    }

    public function check($id){

        $pro=Pro::find($id);

        if(!$pro){
            return redirect('/prolist');
        }

        $att=Att::where('pid',$id)->first();

        return view('shenhe',['pro'=>$pro,'att'=>$att]);
    }

    public function checkpost(Request $req,$id){

        DB::beginTransaction();

        try{

            $pro=Pro::find($id);

            if(!$pro){
                return redirect('/prolist');
            }

            $att=Att::where('pid',$id)->first();

            $pro->title=$req->title;
            $pro->rate=$req->rate;
            $pro->hrange=$req->hrange;
            $pro->status=$req->status;

            $result1=$pro->save();

            $att->title=$req->title;
            $att->realname=$req->realname;
            $att->gender=$req->gender;
            $att->udesc=$req->desc;

            $result2=$att->save();

            if(!$result1||!$result2){
                DB::rollBack();
                return 'error';
            }else{
                DB::commit();
                return redirect('prolist');
            }


        }catch(\Exception $e){
            DB::rollBack();
            return 'error';
        }



    }
}
