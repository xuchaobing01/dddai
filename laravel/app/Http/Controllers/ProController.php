<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pro;
use App\Att;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProController extends Controller
{
    public function jie()
    {
        return view('woyaojiekuan');
    }

    public function jiepost(Request $req)
    {

        if(!\Auth::check()){
            return redirect('auth/login');
        }

        DB::beginTransaction();

        try {

            $pro = new Pro();
            $att = new Att();

            $user = \Auth::user();

            $pro->uid = $user->uid;
            $pro->name = $user->name;
            $pro->money = $req->money;
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
}
