<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'image', 'content',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'post_id', 'id');
    }

    public static function defaultLiked($post, $user_auth_id)
    {
      $defaultLiked = 0;
      foreach ($post['likes'] as $key => $like) {
          if($like['user_id'] == $user_auth_id) {
            $defaultLiked = 1;
            break;
          }
      }

      if(count($defaultLiked) == 0) {
            $defaultLiked == false;
        } else {
            $defaultLiked == true;
        }

      return $defaultLiked;
    }

    public function meals()
    {
        return $this->hasMany('App\Meal', 'post_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
