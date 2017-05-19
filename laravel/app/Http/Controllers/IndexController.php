<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pro;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;

class IndexController extends Controller
{
    public function index(){
        $pros=Pro::where('status','=',1)->take(3)->get();
        return view('index',['pros'=>$pros]);
    }
    public function sm(Request $req){
        require_once base_path()."/vendor/alidayu/TopSdk.php";

        date_default_timezone_set('Asia/Shanghai');

        $appkey='23836732';
        $secret='23d1e41b5f3385af16919bab846e15dd';
        $mobile=$req->mobile;

        $code=mt_rand(1000,9999);

        $c = new \TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secret;
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend("123456");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("点点贷");
        $req->setSmsParam("{\"code\":\"".$code."\",\"product\":\"点点贷\"}");
        $req->setRecNum($mobile);
        $req->setSmsTemplateCode("SMS_67226577");
        $resp = $c->execute($req);
        var_dump($resp);

        if($resp['err_code']==0&&$resp['success']==true){
            $req->session()->put('code',$code);
            return json_encode(['code'=>0,'date'=>'','msg'=>'验证码发送成功']);
        }else{
            return json_encode(['code'=>1,'date'=>'','msg'=>'验证码发送失败']);
        }
    }

    public function checksm(Request $req){
        if(''==$req->fucode){
            return json_encode(['code'=>1,'date'=>'','msg'=>'短信验证码不能为空']);
        }

        if($req->session()->get('code')!=$req->mobile){
            return json_encode(['code'=>2,'date'=>'','msg'=>'短信验证码不正确']);
        }else{
            return json_encode(['code'=>0,'date'=>'','msg'=>'短信验证成功']);
        }

    }
    public function test(Request $req){
        return $req->session()->get('phrase');
    }

    public function captcha(Request $req){
        $builder = new CaptchaBuilder;
        $builder->build();

//        header('Content-type: image/jpeg');
//        $builder->output();
        $req->session()->put('phrase',$builder->getPhrase());
        return  json_encode(['url'=>$builder->inline()]);
    }

    public function checkCaptcha(Request $req){

        if(''==$req->imgcode){
            return json_encode(['code'=>1,'date'=>'','msg'=>'验证码不能为空']);
        }
        if($req->session()->get('phrase')===$req->imgcode) {
            return json_encode(['code'=>0,'date'=>'','msg'=>'验证码正确']);
        }else {
            return json_encode(['code'=>2,'date'=>'','msg'=>'验证码错误']);
        }
    }
}
