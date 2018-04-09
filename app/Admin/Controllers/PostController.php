<?php
  namespace App\Admin\Controllers;
  use \App\Post;
  class PostController extends Controller{
      public  function  index()
      {
          $posts=Post::withoutGlobalScope('avaiable')->where('status',0)->orderBy('created_at','desc')->paginate(4);
          return  view('admin/post/index',compact('posts'));
      }

      public  function  status($post)
      {
           //验证
          $this->validate(request(),[
              'status'=>'required|in:-1,1',
          ]);
          $post = Post::query()->find($post);
         $post->status=request('status');
         $post->save();
         return[
             'error'=>0,
             'msg'=>''
         ];
      }
  }