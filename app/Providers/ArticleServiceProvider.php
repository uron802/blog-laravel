<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer(
            'layouts.sidebar',
            'App\Http\Composers\NewArticleComposers'
        );
        view()->composer(
            'layouts.sidebar',
            'App\Http\Composers\SidebarTagComposers'
        );
    }
}
