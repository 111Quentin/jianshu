<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

class TopicController extends Controller{

    public  function  index()
    {
        $topics=\App\Topic::paginate(5);
        return view('/admin/topic/index',compact('topics'));
    }

    public  function create()
    {
        return view('/admin/topic/create');
    }

    public  function  store()
    {
        //验证
         $this->validate(request(),[
             'name'=>'required|string',
         ]);
        //逻辑
        \App\Topic::create(['name'=>request('name')]);
        //渲染
        return  redirect('/admin/topics');
    }
    public  function  destroy(\App\Topic $topic)
    {
        $topic->delete();
        return  [
            'error'=>'0',
            'msg'=>''
        ];
    }
}