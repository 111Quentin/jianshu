<?php

namespace App;

use App\Model;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    protected  $fillable=['title','content'];
    //定义索引里面的type
    public function  searchableAs()
    {
        return "post";
    }
  //定义有哪些字段需要搜索
    public  function  toSearchableArray()
    {
        return ['title'=>$this->title,
            'content'=>$this->content,
            ];
    }

    //关联用户模型

    public   function  user(){
        return $this->belongsTo('App\User');
    }

    //关联评论模型

    public function  comments(){
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    //和用户进行关联
    public  function zan($user_id){
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);

    }

    //文章的所有赞
    public  function  zans()
    {
        return $this->hasMany(\App\Zan::class);
    }

    //属于某个作者的文章
    public  function  scopeAuthorBy(Builder $query,$user_id)
    {
        return $query->where('user_id',$user_id);
    }
      public function topics()
      {
          return $this->belongsToMany(\App\Topic::class, 'post_topics', 'post_id', 'topic_id')->withPivot(['topic_id', 'post_id']);
      }

    public function  postTopics()
    {
        return $this->hasMany(\App\PostTopic::class,'post_id','id');
    }

    //不属于某个专题的文章
    public  function  scopeTopicNotBy(Builder $query,$topic_id)
    {
        return $query->doesntHave('postTopics','and',function($q) use($topic_id){
            $q->where('topic_id',$topic_id);
        });
    }

    //全局scope的方式
    protected  static function  boot()
    {
        parent::boot();
        static::addGlobalScope("avaiable",function(Builder $builder){
            $builder->whereIn('status',[0,1]);
        });
    }
}

