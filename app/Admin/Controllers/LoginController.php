<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller{
      //登录界面
    public function  index()
     {
         return view('/admin/login/index');
     }
     //登录行为
    public  function  login(Request $request)
    {
      //验证
        $this->validate($request, [
            'name' => 'required|min:2',
            'password' => 'required|min:6|max:30',
        ]);
        //逻辑
        $user=request(['name','password']);
        if(true == \Auth::guard('admin')->attempt($user))
        {
             return redirect('admin/home');
        }
        //渲染
        return \Redirect::back()->withErrors("用户名或密码错误");
    }
    //登出行为
    public  function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}