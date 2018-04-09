<?php

namespace App;

use App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    //
    protected  $fillable=[
        'name','email','password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    //用户的文章列表
    public  function  posts()
    {
        return   $this->hasMany(\App\Post::class ,'user_id','id');
    }

    //关注我的Fan模型
    public function  fans()
    {
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }

    //我关注的Fan模型
    public  function  stars()
    {
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }
    //关注某人
    public  function  doFan($uid)
    {
        $fan=new \App\Fan();
        $fan->star_id=$uid;
        return $this->stars()->save($fan);
    }

    //取消关注
    public  function  doUnFan($uid)
    {
        $fan=new \App\Fan();
        $fan->star_id=$uid;
        return $this->stars()->delete($fan);
    }
    //当前用户是否被uid关注了
    public  function  hasFan($uid)
    {
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //当前用户是否关注了uid
    public  function  hasStar($uid)
    {
        return $this->stars()->where('star_id',$uid)->count();
    }

    //我收到的通知
    public  function  notices()
    {
      return  $this->belongsToMany('\App\Notice','user_notice','user_id','notice_id')->withPivot(['user_id','notice_id']);
    }

    //增加通知
    public    function  addNotices($notice)
    {
        return $this->notices()->save($notice);
    }

    //删除通知
    public  function   deleteNotices($notice)
    {
        return $this->notices()->detach($notice);
    }

    public function getAvatarAttribute($value)
    {
        if (empty($value)) {
            return '/storage/01ddb5b4060ee10df210af2bad7635ac/xkoJFvQWERy9SDjQRA8ET1EWec8uPjSpE6c4jUQY.jpeg';
        }
        return $value;
    }
}
