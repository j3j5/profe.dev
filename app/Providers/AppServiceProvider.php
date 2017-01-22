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

        if (!app()->environment('local')) {
            Asset::$secure = true;
        }

        // Assets Files
        Asset::add('//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
        Asset::add("//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");

        Asset::add("js/base.js");
        if (request()->is('admin*')) {
            Asset::add("css/admin.css");
            Asset::add("js/admin.js");
        } else {
            Asset::add("css/app.css");
            Asset::add("js/app.js");
        }
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
            "css/app.css",
            "js/base.js",
            "js/app.js",
            "js/admin.js",
        ];
        $assets = [];
        foreach ($files as $file) {
            if (is_readable(public_path($file))) {
                $assets[$file] = md5(file_get_contents(public_path($file)));
            }
        }
        $files = NULL;

        Storage::put("assets/assets.json", json_encode($assets, JSON_UNESCAPED_SLASHES));
    }
}
