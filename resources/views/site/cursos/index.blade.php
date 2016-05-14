@extends('site.layouts.master')
<?php use App\Models\MeGusta; ?>
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
            <a href="{{ route("Gallery", [$curso]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Galería</p>
                    </div>
                </div>
            </a>
            <a href="{{ route("Glossary", [$curso]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Glosario</p>
                    </div>
                </div>
            </a>
            @if(request()->is("curso/segundo"))
            <a href="https://f001.backblaze.com/file/profemariana/uploads/SIMULACROS+2%C2%B0.pdf">
                <div class="col-md-offset-4 col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Simulacros</p>
                    </div>
                </div>
            </a>
            @endif
        </div> <!--  content row    -->
        @if(MeGusta::whereCurso($cursoNr)->exists())
        <div class="text-center row">
            <a href="{{ route("Megustas", [$curso]) }}">
                <div class="col-md-offset-4 col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Me Gusta</p>
                    </div>
                </div>
            </a>
        </div> <!--  content row    -->
        @endif
    </div> <!--  container    -->
@stop
