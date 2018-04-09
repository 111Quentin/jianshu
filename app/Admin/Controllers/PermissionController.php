<?php

namespace App\Admin\Controllers;

use \App\AdminUser;

class PermissionController extends Controller{
      //登录界面
    public function  index()
     {
         $permissions=\App\AdminPermission::paginate(5);
         return view('/admin/permission/index',compact('permissions'));
     }

    public function  create()
    {
        return view('/admin/permission/add');
    }

    public function  store()
    {
        //验证
        $this->validate(request(),[
            'name'=>'required|min:3',
            'description'=>'required',
        ]);
        //逻辑
        \App\AdminPermission::create(request(['name','description']));
        //渲染
        return redirect('/admin/permissions');
    }

    public  function  destroy(\App\AdminPermission $permission)
    {
        $permission->delete();
        return  [
            'error'=>'0',
            'msg'=>''
        ];
    }
}