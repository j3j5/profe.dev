@extends('site.layouts.master')

@section('content')

        @include('site.partials._cursos-header')
    <div class="container">
        <div class="text-center row">
            <a href="{{ route("Propuestas", [$curso]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Propuestas</p>
                    </div>
                </div>
            </a>
            <a href="{{ route("curso") }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Galería</p>
                    </div>
                </div>
            </a>
            <a href="{{ route("curso") }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Glosario</p>
                    </div>
                </div>
            </a>
        </div> <!--  content row    -->
    </div> <!--  container    -->
@stop
