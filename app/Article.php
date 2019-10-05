<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $table = 'articles';
    //protected $fillable = ['cover_picture', 'title', 'slug', 'content', 'category_id', 'author', 'publish', 'created_at', 'updated_at'];
    
    //Articles belogTo to category
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    //Articles belongsToMany images
    public function images() 
    {
    	return $this->belongsToMany('App\Image');
	}

    //Tags belongsToMany Articles
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    //return slug of the article
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Reference belogsToMany Articles
    public function references()
    {
        return $this->belongsToMany('App\Reference');
        
    }
}
