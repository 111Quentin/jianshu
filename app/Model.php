<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;


class Model extends BaseModel
{

    //表posts
    protected  $guarded=[];  //不可以注入的字段
    /* protected  $fillable=['title','content'];  //可以注入数据字段*/
}
