<?php

use App\Article;

Auth::routes();

Route::get('/', function () {
	
	$articles = Article::where('publish', '=', 1)->orderBy('created_at', 'DESC')->paginate(3);

	return view('pages.welcome', compact('articles'));
})->name('welcomepage');
	
Route::get('/dashboard', 'ArticlesController@index')->name('dashboard');
Route::resource('/articles', 'ArticlesController');
Route::put('/publish/{id}', 'HomeController@updatePublish')->name('status.publish');
Route::patch('/article/{id}', 'ArticlesController@update')->name('update.article');
Route::get('/article/{id}/edit', 'ArticlesController@edit')->name('edit.article');
Route::delete('article/{id}', 'HomeController@destroy')->name('article.destroy');
Route::get('/dashboard/categories', 'CategoryController@allCategoryForDashboard')->name('dashboard.categories');
Route::post('/dashboard/categories/store', 'CategoryController@store')->name('categories.store');
Route::get('/search', 'HomeController@search');

Route::get('/kategorie', function() {return 'sdd';});
Route::get('/kategorie/{slug}', 'CategoryController@index')->name('category.index');
Route::get('/kategorie/{category}/clanek/{slug}', 'ArticlesController@show')->name('articles.show');
Route::get('/tag/{tag}', 'TagController@index')->name('tag.index');
Route::get('/kontakt', 'ContactFormController@getEmail')->name('getEmail');
Route::post('/odeslat', 'ContactFormController@sendEmail')->name('sendEmail');

