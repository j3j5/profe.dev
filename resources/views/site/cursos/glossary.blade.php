@extends('site.layouts.master')

@section('content')

    @include('site.partials._cursos-header')

    @if(!$empty)
    <div class="container">
        @foreach($secciones as $seccion)
        <div class="row">
            <h2><span class="label label-default seccion">{{ $seccion['nombre'] }}</span></h2>
            @foreach($seccion['conceptos'] as $concepto)
            <div class="col-md-12 concepto">
                <h3><span class="label label-info palabra">{{ $concepto->palabra }}</span></h3>
                <span class="definicion"> @newlinesToBr($concepto->definicion) </span>
                @if($concepto->thumbnail)
                <span class="concepto-thumb"> <img style="max-height:120px;" class="" src="@imageHost()/uploads/{{ $concepto->thumbnail}}"></span>
                @endif
            </div>
            @endforeach
        </div>
        <hr>
        @endforeach
    </div>
    @else
    <div class="col-md-offset-4 col-md-4 well bg-info">
        <p class="">Lo siento, aún no hay ningún concepto disponible para este curso.</p>
    </div>
    @endif

@stop
