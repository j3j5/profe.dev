@extends('site.layouts.master')

@section('content')

    @include('site.partials._cursos-header')

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
