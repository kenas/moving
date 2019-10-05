<?php

namespace App\Providers;

use App\Article;
use App\Tag;
use App\Category;
// use Carbon\Carbon;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Jenssegers\Date\Date;

    

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Carbon::setLocale('cs');

        Date::setLocale(LC_TIME, config('app.locale'));

        View::composer(['errors.404', 'errors::404'], function($view)
        {
            $view->with(
                'articles', Article::where('publish', 1)->latest()->paginate(5)
            );
        });


        View::composer('navbar.navbar', function ($view){
            $view->with(
                'getAllCategories', Category::all()
            );
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}