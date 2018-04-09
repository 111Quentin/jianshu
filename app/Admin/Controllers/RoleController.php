<?php

namespace App\Admin\Controllers;

use \App\AdminUser;
use Illuminate\Http\Request;
class RoleController extends Controller{
      //登录界面
    public function  index()
     {
        $roles=\App\AdminRole::paginate(5);
         return view('/admin/role/index',compact('roles'));
     }

     //
     public  function  create()
     {
         return  view('admin/role/add');
     }

    public  function  store()
    {
        //验证
        $this->validate(request(),[
            'name'=>'required|min:3',
            'description'=>'required',
        ]);
        //逻辑
        \App\AdminRole::create(request(['name','description']));
        //渲染
        return redirect('/admin/roles');
    }

    public  function  permission(\App\AdminRole $role)
    {
        //获取所有权限
         $permissions=\App\AdminPermission::all();
        //获取当前角色权限
         $myPermissions=$role->permissions;
        return view("admin/role/permission",compact('permissions',
            'myPermissions','role'));
    }

    public  function  storePermission(\App\AdminRole $role)
    {
        //验证
        $this->validate(request(),[
            'permissions'=>'required|array',
        ]);

        $permissions=\App\AdminPermission::findMany(request('permissions'));
        $myPermissions=$role->permissions;

        //要对已经有的权限
        $addPermissions=$permissions->diff($myPermissions);
        foreach ($addPermissions as $permission)
        {
            $role->grantPermisson($permission);
        }
        //要删除的
        $deletePermissions=$myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission)
        {
            $role->deletePermisson($permission);
        }
        return back();
    }
}