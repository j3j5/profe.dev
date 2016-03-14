@extends('site.layouts.master')

@section('content')
    <div class="page-header">
        <a href="" ><h1>{{ $curso }}</h1></a>
    </div>

    @if(!empty($propuestas))
    <div class="container">
        @foreach($propuestas as $propuesta)
            <a href="/uploads/{{ $propuesta->archivo }}">
                <div class="col-md-3">
                    <div style="width:150px; height:150px;">
                        <img class="img-thumbnail" src="/uploads/{{ $propuesta->thumbnail }}" style="max-height: 100%">
                    </div>
                    <h2>{{ $propuesta->nombre }}</h2>
                    <p>{{ $propuesta->contenidos }}</p>
                </div><!-- /.col-lg-4 -->
            </a>

        @endforeach
    </div>
    @else
    <div class="container">
        <div class="col-md-6 col-md-offset-3">Lo siento, aún no hay ninguna propuesta disponible para este curso.</div>
    </div>
    @endif

@stop
