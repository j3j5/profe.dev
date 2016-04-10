<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Asset;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('newlinesToBr', function ($text) {
            return "<?php echo str_replace(\"\n\", \"</br>\", $text); ?>";
        });

        Asset::$secure = request()->secure();
        // CSS Files
        Asset::add('//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
        Asset::add('/css/vendor/bootstrap.min.simplex.css');
        Asset::add('/css/global.css');

        // JS Files
        Asset::add('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js');
        Asset::add('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js');
//         Asset::add('/upup.min.js');
//         Asset::add('/upup.sw.min.js');

//         $offline_script = "UpUp.start({
//             'content-url': 'offline/index.html',
//             'assets': ['/css/vendor/bootstrap.min.superhero.css', '/css/offline.css',]
//         });";
//         Asset::addScript($offline_script);
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
