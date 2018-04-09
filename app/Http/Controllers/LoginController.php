<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录界面
    public function  index(){
        if(\Auth::check()) {
            return redirect("/posts");
        }
        return view('login.index');
    }
    //登录行为
    public function login(Request $request){

        //验证
           $this->validate($request,[
               'email'=>'required|email',
               'password'=>'required|min:5|max:10',
               'is_remember'=>'',
           ]);
        //逻辑
             $user=request(['email','password']);
             $is_remember=boolval(request('is_remember'));

             if(true ===\Auth::attempt($user,$is_remember)){

                 return redirect('/posts');
             }

        //渲染
        return \Redirect::back()->withErrors("用户名密码错误");
    }
             //登出行为
        public function  logout()
        {
           \Auth::logout();
            return redirect('/login');
        }

}
