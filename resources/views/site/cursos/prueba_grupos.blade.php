@extends('site.layouts.master')

@section('content')

    @include('site.partials._cursos-header')


    <div class="container">
        <div class="text-center row">
            <h1 class="text-uppercase"><strong>Elija su grupo</strong></h1>
            <a href="{{ route("Prueba", [$curso, "2017-A"]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Grupo A </p>
                        <p><small>Prueba Domiciliaria</small></p>
                    </div>
                </div>
            </a>
            <a href="{{ route("Prueba", [$curso, "2017-B"]) }}">
                <div class="col-md-4 col-md-offset-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Grupo B</p>
                        <p><small>Prueba en Clase</small></p>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection
