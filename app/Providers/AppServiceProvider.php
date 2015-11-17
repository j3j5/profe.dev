<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Asset;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // CSS Files
        Asset::add('//fonts.googleapis.com/css?family=Lato:100');
        Asset::add('//fonts.googleapis.com/css?family=Source+Sans+Pro:400');
        Asset::add('css/vendor/bootstrap.min.superhero.css');
        Asset::add('css/global.css');

        // JS Files
        Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js');
        Asset::add('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js');

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
