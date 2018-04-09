<?php

namespace App\Admin\Controllers;
use App\Topic;
use Illuminate\Http\Request;

class NoticeController extends Controller{

    public  function  index()
    {
        $notices=\App\Notice::paginate(5);
        return view('/admin/notice/index',compact('notices'));
    }

    public  function create()
    {
        return view('/admin/notice/create');
    }

    public  function  store(Request $request)
    {
        //验证
         $this->validate($request,[
             'title'=>'required|string',
             'content'=>'required|string',
         ]);
        //逻辑
        $notice=\App\Notice::create(request(['title','content']));
       $this->dispatch(new \App\Jobs\SendMessage($notice));
        //渲染
        return  redirect('/admin/notices');
    }

    public  function  destroy(\App\Notice $notice)
    {
        $notice->delete();
        return  [
            'error'=>'0',
            'msg'=>''
        ];
    }

}