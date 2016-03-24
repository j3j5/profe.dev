@extends('site.layouts.master')

@section('content')

    @include('site.partials._cursos-header')

    @if(!$images->isEmpty())
    <div class="container">
        <div id="links">
            @foreach($images as $image)
            <div class="col-md-1" style="width:75px;">
            <a href="@if(app()->environment('production'))https://f001.backblaze.com/file/{{ config('b2client.bucket_name') }}@endif/images/{{ $image->{"nombre-archivo"} }}" title="{{ $image->titulo }}" data-gallery>
                <img style=" width:100%;" src="@if(app()->environment('production'))https://f001.backblaze.com/file/{{ config('b2client.bucket_name') }}@endif/images/{{ $image->{"nombre-archivo"} }}" alt="">
            </a>
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
