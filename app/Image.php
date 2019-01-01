<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	//Image belongsToMany article
	public function articles() {
    	return $this->belongsToMany('App\Article');
	}
}
