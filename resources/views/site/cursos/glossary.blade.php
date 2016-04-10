@extends('site.layouts.master')

@section('content')

    @include('site.partials._cursos-header')

    @if(!$conceptos->isEmpty())
    <div class="container">
        <div id="links" class="text-left">
            @foreach($conceptos as $concepto)
            <div class="col-md-6 concepto">
                <h3><span class="label label-info palabra">{{ $concepto->palabra }}</span></h3>
                <span class="col-md-8 definicion"> @newlinesToBr($concepto->definicion) </span>
                @if($concepto->thumbnail)
                <span class="col-md-4"> <img style="max-height:120px;" class="" src="@if(app()->environment('production'))https://f001.backblaze.com/file/{{ config('b2client.bucket_name') }}@endif/uploads/{{ $concepto->thumbnail}}"></span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="col-md-offset-4 col-md-4 well bg-info">
        <p class="">Lo siento, aún no hay ningún concepto disponible para este curso.</p>
    </div>
    @endif

@stop
