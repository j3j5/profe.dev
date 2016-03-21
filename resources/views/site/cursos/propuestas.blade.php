@extends('site.layouts.master')

@section('content')

    @include('site.partials._cursos-header')


    @if(!$propuestas->isEmpty())
    <div class="container">
        @foreach($propuestas as $propuesta)
            <a href="@if(app()->environment('production'))https://f001.backblaze.com/file/{{ config('b2client.bucket_name') }}@endif/uploads/{{ $propuesta->archivo }}" target="_blank">
                <div class="col-xs-6 col-md-3">
                    <div class="container-fluid">
                        <div class="row thumb center-block">
                        @if(!empty($propuesta->thumbnail))
                            <img class="img-thumbnail" src="@if(app()->environment('production'))https://f001.backblaze.com/file/{{ config('b2client.bucket_name') }}@endif/uploads/{{ $propuesta->thumbnail}}">

                        @else
                            <img class="img-thumbnail" src="images/pdficon.png">
                        @endif
                        </div>
                        <div class="propuesta-info text-center">
                            <h2 class="propuesta-nombre">{{ $propuesta->nombre }}</h2>
                            <p class="contenidos">
                            @foreach($propuesta->contenidos as $contenido)
                                <span class="contenido">#{{ trim($contenido) }}</span>
                            @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </a>

        @endforeach
    </div>
    @else
    <div class="col-md-offset-4 col-md-4 well bg-info">
        <p class="">Lo siento, aún no hay ninguna propuesta disponible para este curso.</p>
    </div>
    @endif

@stop