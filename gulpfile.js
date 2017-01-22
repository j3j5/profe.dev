const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass(
        'app.scss',
        'public/css/app.css'
    );

    mix.sass(
        'admin.scss',
        'public/css/admin.css'
    );

    mix.webpack(
        './resources/assets/js/bootstrap.js',
        './public/js/base.js'
    );
    mix.webpack(
        './resources/assets/js/app.js',
        './public/js/app.js'
    );
    mix.webpack(
        './resources/assets/js/admin.js',
        './public/js/admin.js'
    );
});
