<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="_token" content="{{ csrf_token() }}">

        <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600,700,700italic">
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link type="text/css" rel="stylesheet" href="{{ asset('css/global.css') }}" />
    </head>

    <body class="">

            @yield('content')

            <div class="footer">
                <strong>{{ trans('messages.footer') }} © 2015</strong>
            </div>
    </body>
</html>
