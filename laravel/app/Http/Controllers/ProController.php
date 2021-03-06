<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pro;
use App\Att;
use App\Bid;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class ProController extends Controller
{
    protected $middleware=['App\Http\Middleware\Authenticate'=>[]];
    public function jie()
    {
        return view('woyaojiekuan');
    }

    public function jiepost(Request $req)
    {

        if(!\Auth::check()){
            return redirect('auth/login');
        }
        /*
        //自动验证
        $this->validate($req,
            [
                'age'=>'required|in:15,40,80',
                'money'=>'required|digits_between:2,7',
                'mobile'=>'required|regex:/^1[34578]\d{9}$/'
            ],
            [
                'age.required'=>'请选择年龄',
                'age.in'=>'请选择年龄',
                'money.required'=>'借款金额不能为空',
                'money.digits_between'=>'借款金额只能是10~9999999',
                'mobile.required'=>'手机号码不能为空',
                'mobile.regex'=>'请输入正确的手机号码'
            ]
        );
        */

        //手动验证
        $validate=Validator::make(
            $req->all(),
            [
                'age'=>'required|in:15,40,80',
                'money'=>'required|digits_between:2,7',
                'mobile'=>'required|regex:/^1[34578]\d{9}$/'
            ],
            [
                'age.required'=>'请选择年龄',
                'age.in'=>'请选择年龄',
                'money.required'=>'借款金额不能为空',
                'money.digits_between'=>'借款金额只能是10~9999999',
                'mobile.required'=>'手机号码不能为空',
                'mobile.regex'=>'请输入正确的手机号码'
            ]
        );
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }

        DB::beginTransaction();

        try {

            $pro = new Pro();
            $att = new Att();

            $user = \Auth::user();

            $pro->uid = $user->uid;
            $pro->name = $user->name;
            $pro->money = $req->money*100;
            $pro->mobile = $req->mobile;
            $pro->age = $req->age;
            $pro->status = 0;
            $pro->pubtime = time();

            $result1 = $pro->save();

            $att->uid = $user->uid;
            $att->pid = $pro->pid;

            $result2 = $att->save();

            if (!$result1 || !$result2) {
                DB::rollBack();
            } else {
                DB::commit();
                return 'ok';
            }

        } catch (\Exception $e) {

            DB::rollBack();

        }
    }

    public function pro($pid){

        $pro=Pro::find($pid);
        return view('touzi',['pro'=>$pro]);

    }

    public function propost(Request $req,$pid){

        $user=\Auth::user();

        $bid=new Bid();
        $bid->uid=$user->uid;
        $bid->pid=$pid;
        $bid->title=$req->title;
        $bid->amount=$req->amount*100;
        $bid->pubtime=time();

        $result1=$bid->save();


        $pro=Pro::find($pid);
        $pro->recive+=$req->amount*100;
        if($pro->money==$pro->recive){
            $pro->status=2;
            //生成还款表和还款收益表记录
            $this->prodone($pro);
        }
        $result2=$pro->save();



        echo $result1&&$result2?'ok':'fail';

    }

    protected function prodone($pro){

        //生成还款表
        $row=[];
        $row['uid']=$pro->uid;
        $row['pid']=$pro->pid;
        $row['title']=$pro->title;
        $row['status']=0;
        for($i=1;$i<=$pro->hrange;$i++){
            $row['amount']=($pro->money*$pro->rate/1200)+$pro->money/$pro->hrange;
            $row['paydate']=date('Y-m-d',strtotime("+ {$i} months"));
            DB::table('hks')->insert($row);
        }

        //生成收益定时任务表
        $bids=Bid::where('pid','=',$pro->pid)->get();
        $row=[];
        $row['pid']=$pro->pid;
        $row['title']=$pro->title;
        $row['enddate']=date('Y-m-d',strtotime("+ {$pro->hrange} months"));
        foreach($bids as $bid){
            $row['uid']=$bid->uid;
            $row['amount']=$bid->amount*$pro->rate/36500;
            DB::table('tasks')->insert($row);
        }


    }
}
