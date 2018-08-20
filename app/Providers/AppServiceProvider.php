<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    view()->composer('*', function ($view) {
		    $allTags = \Cache::rememberForever('tags.list', function () {
			    return \App\Tag::all();
		    });
		    $currentUser = auth()->user();
		    $view->with(compact('allTags', 'currentUser'));
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
