<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="_token" content="{{ csrf_token() }}">

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400" rel="stylesheet" type="text/css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css"/>
    </head>

    <body class="">

        @if(request()->is('admin/*'))
            @include('site.layouts.admin-navigation')
        @else
            @include('site.layouts.navigation')
        @endif

        @yield('content')

        <footer class="footer">
            <div class="container">
                <p class="text-muted"><strong>{{ trans('messages.footer') }} © {{ date('y') }}</strong></p>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
