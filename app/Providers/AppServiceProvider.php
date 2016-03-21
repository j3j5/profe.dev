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
        Asset::add('//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
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
