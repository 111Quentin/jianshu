<?php

namespace App;



class AdminRole extends Model
{
    protected  $table="admin_roles";

    //当前角色的所有的权限
    public  function  permissions()
    {
        return $this->belongsToMany(\App\AdminPermission::class,
            'admin_permission_role','permission_id',
            'role_id')->withPivot(['permission_id',
            'role_id']);
    }

    //给角色赋予权限
    public  function grantPermisson($permission)
    {
         return $this->permissions()->save($permission);
    }

    //取消角色赋予的权限
    public  function  deletePermisson($permission)
    {
        return $this->permissions()->detach($permission);
    }

    //判断角色是否有权限
    public  function  hasPermission($permission)
    {
        return $this->permissions->contains($permission);
    }
}
