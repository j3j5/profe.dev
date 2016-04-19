<!doctype html>
<html lang="es" moznomarginboxes mozdisallowselectionprint>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="_token" content="{{ csrf_token() }}">

        @include("site.partials._favicons")

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
