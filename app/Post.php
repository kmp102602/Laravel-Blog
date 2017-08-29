<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category()
    {
    	return $this->belongsTo('App\Category');  
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');  //laravel will look for post_tag table by default.
    }

    public function comment()
    {
    	return $this->hasMany('App\Comment');
    }
}
