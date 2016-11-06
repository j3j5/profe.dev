<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('imageHost', function($expression) {
            if(app()->environment('production') || app()->environment('beta')){
                return "https://f001.backblaze.com/file/" . config('b2client.bucket_name');
            }
            return '';
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
