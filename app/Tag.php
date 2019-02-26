<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    //Article belogsToMany tags
    public function articles()
    {
    	return $this->belongsToMany('App\Article')->where('publish', 1);
        
    }

    //get the tags by slug of the tag
    public function  getRouteKeyName()
    {
    	return 'name';
    }
}
