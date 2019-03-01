<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    //Article belogsToMany references
    public function articles()
    {
    	return $this->belongsToMany('App\Article')->where('publish', 1);
        
    }
}
