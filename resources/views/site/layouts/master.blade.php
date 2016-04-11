<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="_token" content="{{ csrf_token() }}">

        <!--   Favicons BS       -->
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-194x194.png" sizes="194x194">
        <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#66ab8c">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="/mstile-144x144.png">
        <meta name="theme-color" content="#66ab8c">

        <title>@if(isset($title)) {{ "$title | "}}@endif Profe Mariana</title>

        <!-- css files -->
        {{ Asset::css() }}
        <!-- less files -->
        {{ Asset::less() }}
        <!-- css styles -->
        {{ Asset::styles() }}
        <!-- js files (header) -->
        {{ Asset::js('header') }}
        <!-- js scripts (header) -->
        {{ Asset::scripts('header') }}

        @if(config('app.analytics_template'))
        @include(config('app.analytics_template'))
        @endif
    </head>

    <body class="">

        @if(request()->is('admin/*'))
            @include('admin.layouts.admin-navigation')
        @else
            @include('site.layouts.navigation')
        @endif

        @yield('content')

        <footer class="footer">
            <div class="container">
                <p class="text-muted pull-right">
                <strong>
                    Hecho con <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> por J&amp;M
                    <span class="glyphicon glyphicon-flash" aria-hidden="true"></span> {{ date('Y') }}
                </strong></p>
            </div>
        </footer>

        <!-- js files -->
        {{ Asset::js() }}
        <!-- js scripts -->
        {{ Asset::scripts('footer') }}
        <!-- jquery scripts -->
        {{ Asset::scripts('ready') }}
    </body>
</html>
