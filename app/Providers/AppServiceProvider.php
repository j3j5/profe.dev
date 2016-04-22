<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Asset;
use Blade;
use Storage;

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

        $this->buildCacheBuster();

        Asset::setCachebuster(storage_path('app/assets/assets.json'));

        Asset::$secure = request()->secure();
        // CSS Files
        Asset::add('//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
        Asset::add('css/vendor/bootstrap.min.simplex.css');
        Asset::addStyle(file_get_contents(public_path('css/global.css')));

        Asset::add('//fonts.googleapis.com/css?family=Oxygen:400,700');
        Asset::add('//fonts.googleapis.com/css?family=Covered+By+Your+Grace');

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

    private function buildCacheBuster()
    {
        $files = [
            "css/vendor/bootstrap.min.simplex.css",
            "css/global.css",
            "css/home.css",
            "css/cursos.css",
            "css/propuestas.css",
            "css/vendor/bootstrap-image-gallery.min.css",
            "js/vendor/bootstrap-image-gallery.min.js",
            "css/dropzone/dropzone.min.css",
            "js/dropzone/dropzone.min.js",
        ];
        $assets = [];
        foreach ($files as $file) {
            $assets[$file] = md5(file_get_contents(public_path($file)));
        }
        $files = NULL;

        Storage::put("assets/assets.json", json_encode($assets, JSON_UNESCAPED_SLASHES));
    }
}
