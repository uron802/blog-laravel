<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // バージョン5.7.7より古いMySQLや、バージョン10.2.2より古いMariaDBを使用している場合に使用
        Schema::defaultStringLength(191);

        // Bootstrap4 -> default　へ変更
        Paginator::defaultView('pagination::bulma');
        Paginator::defaultSimpleView('pagination::bulma-simple');

        Blade::include('includes.select', 'select');
        Blade::include('includes.radio', 'radio');
    }
}
