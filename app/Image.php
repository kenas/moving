<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	//Image belongsToMany articles
	public function articles() {
    	return $this->belongsToMany('App\Article');
	}
}
