@extends('site.layouts.master')

@section('content')
    <div id="mainContainer" class="container-fluid">

        <div class="concurso img-circle col-md-offset-5 col-md-2">
            <a href="https://f001.backblaze.com/file/profemariana/uploads/CONCURSO+LOGOTIPO.pdf">
                <span class="concurso-text">Concurso</br>&nbsp;Logo</span>
            </a>
        </div>

        @include('site.partials._carousel')

        <div id="mark" class="container marketing" >
            <!-- Three columns of text below the carousel -->
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{ route("curso", ["primero"]) }}">
                        <div class="curso-home img-circle">
                            <span class="center course">1<sup style="text-decoration: underline;">o</sup></span>
                        </div>
                        <h2>Primero</h2>
                        <p>Aquí están las propuestas para primero.</p>
                    </a>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <a href="{{ route("curso", ["segundo"]) }}">
                        <div class="curso-home img-circle">
                            <span class="center course">2<sup style="text-decoration: underline;">o</sup></span>
                        </div>
                        <h2>Segundo</h2>
                        <p>Propuestas para segundo, ¡aquí!.</p>
                    </a>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <a href="{{ route("curso", ["tercero"]) }}">
                        <div class="curso-home img-circle">
                            <span class="center course">3<sup style="text-decoration: underline;">o</sup></span>
                        </div>
                        <h2>Tercero</h2>
                        <p>Aquí las propuestas para tercero.</p>
                    </a>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div> <!-- /.container marketing -->
    </div> <!-- /.container -->
@stop
