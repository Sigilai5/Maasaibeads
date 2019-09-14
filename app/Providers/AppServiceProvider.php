<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use mysql_xdevapi\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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

//        View::share('key', 'value');
        /* View Composer*/
        //we use '*' to select all views, if we wanted one then ['home'] and many ['home','welcome'] etc
        View::composer(['*'], function($view)
        {
            $view->with('user',Auth::user()); //here we share user data across all fields
        });

    }
}
