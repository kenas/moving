<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Category has many articles
    public function articles ()
    {
    	return $this->HasMany('App\Article');
    }

    //return slug of the category
    public function getRouteKeyName()
    {
        return 'name';
    }
}
