@extends('site.layouts.master')

@section('content')

    @include('site.partials._cursos-header')

    <div class="container">
        <a href="{{ route("Glossary", ['primero']) }}">
            <div class="col-md-4">
                <div class="prueba-grupo text-center">
                    <h3><i class="fa fa-list" aria-hidden="true"></i> Glosario <i class="fa fa-file" aria-hidden="true"></i></h3>
                </div>
            </div>
        </a>
        <a href=@if($grupo === '2017-A')
            "https://f001.backblazeb2.com/file/profemariana/uploads/PRUEBA++2017+1RO+CAT+A.pdf"
        @else
            "#{{-- https://f001.backblazeb2.com/file/profemariana/uploads/PRUEBA+2017+1RO+CAT.B.pdf --}}" title="El archivo estará disponible el día de la prueba."
        @endif>
            <div class="col-md-4">
                <div class="prueba-grupo text-center">
                    <h3><i class="fa fa-id-card-o" aria-hidden="true"></i> Prueba <i class="fa fa-pencil-square-o" aria-hidden="true"></i></h3>
                </div>
            </div>
        </a>
        <a href="@if($grupo === '2017-A')
            https://f001.backblazeb2.com/file/profemariana/uploads/REGLAMENTO+CAT+A.pdf
        @else
            https://f001.backblazeb2.com/file/profemariana/uploads/REGLAMENTO+CAT.B.pdf
        @endif">
            <div class="col-md-4">
                <div class="prueba-grupo text-center">
                    <h3><i class="fa fa-question-circle-o" aria-hidden="true"></i> Reglamento <i class="fa fa-life-ring" aria-hidden="true"></i></h3>
                </div>
            </div>
        </a>
    </div>

    <div class="container">
        <p></p>
    </div>

    @if(!$images->isEmpty())
    <div class="container">

        <div id="links" class="text-center">
            @foreach($images as $image)
            <div class="image-gallery-prueba">
                <figure class="figure">
                    <a href="@imageHost()/images/galeria/{{ $image->curso }}/{{ $image->{"nombre-archivo"} }}" title="{{ $image->titulo }}" data-gallery data-description="{{ $image->artista }}">
                        <img src="@imageHost()/images/galeria/{{ $image->curso }}/{{ $image->{"nombre-archivo"} }}" alt="{{ $image->titulo }}" class="figure-img rounded">
                    </a>
                    <figcaption class="figure-caption">{{ $image->titulo }}</figcaption>
                </figure>

            </div>
            @endforeach
        </div>
    </div>

    @include('site.partials._curso-gallery')

    @else
    <div class="col-md-offset-4 col-md-4 well bg-info">
        <p class="">Lo siento, aún no hay ninguna imagen disponible para este curso.</p>
    </div>
    @endif

@stop
