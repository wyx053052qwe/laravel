<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');
    }
    public function dologin(Request $request)
    {
        $date = $request->all();
        $data = DB::table('shop_user')->where('user_email', $date['user_email'])->first();
//        dd($data);
        if (empty($data)) {
            echo("<script>alert('用户名不正确');location='/login/login'</script>");
        }
        $pwd=md5($date['user_pwd']);
        if($pwd!=$data->user_pwd){
            echo("<script>alert('密码不正确');location='/login/login'</script>");
        }else{
            session(['name'=>$date['user_email'],'id'=>$data->user_id]);
            echo("<script>alert('登录成功');location='/'</script>");
        }
    }
        public function logout(Request $request)
    {
        $request->session()->flush();
        return \redirect('/login/login');
    }

}
