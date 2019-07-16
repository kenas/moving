<?php

namespace App\Providers;

use App\Article;
use App\Tag;
use App\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

    

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
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