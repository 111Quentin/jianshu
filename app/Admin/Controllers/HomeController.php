<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{
      //登录界面
    public function  index()
     {
         return view('/admin/home/index');
     }

}