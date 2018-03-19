<?php

use App\Article;

Auth::routes();

Route::get('/', function () {
    
    $articles = Article::where('publish', '=', 1)->orderBy('created_at', 'DESC')->paginate(3);
    //$articles->withPath('custom/url');

    return view('welcome', compact('articles'));
});
	
Route::get('/dashboard', 'HomeController@index');
Route::resource('/articles', 'ArticlesController');

Route::get('/category/{category}', 'CategoryController@index');
Route::get('/category/{category}/{slag}', 'CategoryController@show');
