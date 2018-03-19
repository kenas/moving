<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //Articles belogTo to category
    public function category ()
    {
    	return $this->belongsTo('App\Category');
    }
}
