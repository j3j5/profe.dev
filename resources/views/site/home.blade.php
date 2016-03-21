@extends('site.layouts.master')

@section('content')
    <div id="mainContainer" class="container-fluid">
        <div class="row">

            @include('site.partials._carousel')

            <div class="container marketing">

                <!-- Three columns of text below the carousel -->
                <div class="row">
                    <a href="{{ route('PropuestasPrimero') }}">
                        <div class="col-lg-4">
                            <div class="img-circle" style="width: 140px; height: 140px; margin:auto; background:url(data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==);">
                                <span class="course">1<sup style="text-decoration: underline;">o</sup></span>
                            </div>
                            <h2>Primero</h2>
                            <p>Aquí están las propuestas para primero.</p>
                        </div><!-- /.col-lg-4 -->
                    </a>
                    <a href="{{ route('PropuestasSegundo') }}">
                        <div class="col-lg-4">
                            <div class="img-circle" style="width: 140px; height: 140px; margin:auto; background:url(data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==);">
                                <span class="course">2<sup style="text-decoration: underline;">o</sup></span>
                            </div>
                            <h2>Segundo</h2>
                            <p>Propuestas para segundo, ¡aquí!.</p>
                        </div><!-- /.col-lg-4 -->
                    </a>
                    <a href="{{ route('PropuestasTercero') }}">
                        <div class="col-lg-4">
                            <div class="img-circle" style="width: 140px; height: 140px; margin:auto; background:url(data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==);">
                                <span class="course">3<sup style="text-decoration: underline;">o</sup></span>
                            </div>
                            <h2>Tercero</h2>
                            <p>Aquí las propuestas para tercero.</p>
                        </div><!-- /.col-lg-4 -->
                    </a>
                </div><!-- /.row -->
            </div> <!-- /.container marketing -->
        </div><!-- /.row -->
    </div> <!-- /.container -->
@stop
