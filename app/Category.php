<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $fillable = ['name', 'slug'];
    
    //Category has many articles
    public function articles ()
    {
    	return $this->HasMany('App\Article')->where('publish', 1);
    }

    //return slug of the category
    public function getRouteKeyName()
    {
        return 'name';
    }
}
