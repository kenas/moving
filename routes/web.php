<?php

use App\Article;
use App\Experience;

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
Route::delete('article/{id}', 'ArticlesController@destroy')->name('article.destroy');
Route::get('/dashboard/categories', 'CategoryController@allCategoryForDashboard')->name('dashboard.categories');
Route::post('/dashboard/categories/store', 'CategoryController@store')->name('categories.store');
Route::post('/category/{id}', 'CategoryController@destroy')->name('category.destroy');
Route::get('/search', 'HomeController@search');
Route::get('/dashboard/fotogalerie', 'FotogalerieController@index')->name('dashboard.fotogalerie');
Route::get('/dashboard/experiences', 'ExperiencesController@index')->name('dashboard.experiences');
Route::post('dashboard/experiences/store/', 'ExperiencesController@store')->name('dashboard.experiences.store');
Route::post('/dashboard/experiences/destroy/{id}', 'ExperiencesController@destroy')->name('experiences.destroy');

Route::post('/dashboard/experiences/update/{id}', 'ExperiencesController@update')->name('experiences.update');
Route::post('/dashboard/fotogalerie/store/', 'FotogalerieController@store')->name('dashboard.fotogalerie.store');
Route::post('/dashboard/fotogalerie/{id}', 'FotogalerieController@destroy')->name('dashboard.fotogalerie.destroy');

Route::get('/aboutme', function() {
	return view('pages.aboutme');
})->name('aboutme');

Route::get('/zkusenosti', function() {
	
	$experiences = Experience::orderBy('year', 'DESC')->get();

    return view('pages.experiences', compact('experiences'));

})->name('experiences');

Route::get('/kategorie', 'CategoryController@getAllCategories');
Route::get('/kategorie/{slug}', 'CategoryController@index')->name('category.index');
Route::get('/kategorie/{category}/clanek/{slug}', 'ArticlesController@show')->name('articles.show');
Route::get('/fotogalerie', 'FotogalerieController@show')->name('fotogalerie');
Route::get('/tag/{tag}', 'TagController@index')->name('tag.index');
Route::get('/kontakt', 'ContactFormController@getEmail')->name('getEmail');
Route::post('/odeslat', 'ContactFormController@sendEmail')->name('sendEmail');

