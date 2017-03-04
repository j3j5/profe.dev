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

        @include("site.partials._analytics")
    </head>

    <body class="{{$body_class or ""}}">

        @if(request()->is('admin/*'))
        <div id="admin">
            @include('admin.layouts.admin-navigation')
        @else
        <div id="app">
            @include('site.layouts.navigation')
        @endif

            @yield('content')

            <footer class="footer">
                <div class="container-fluid">
                    <p class="text-muted pull-right">
                    <strong>
                        Hecho con <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> por J&amp;M
                        <span class="glyphicon glyphicon-flash" aria-hidden="true"></span> {{ date('Y') }}
                    </strong></p>
                </div>
            </footer>

        </div>
        <!-- js scripts -->
        {{ Asset::scripts('footer') }}
        <!-- js files -->
        {{ Asset::js() }}
        <!-- jquery scripts -->
        {{ Asset::scripts('ready') }}
    </body>
</html>
