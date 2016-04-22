@extends('site.layouts.master')

@section('content')

    @include('site.partials._cursos-header')

    @if(!$likes->isEmpty())
    <div class="container">
        <div id="links" class="text-center">
            @foreach($titulos as $titulo)
                <h2><span class="label label-default seccion">{{ $titulo->titulo }}</span></h2>
                <?php $title_likes = $likes->where('titulo', $titulo->titulo ); ?>
                @foreach($title_likes as $like)
                <div class="megusta-gallery">
                <a href="@if(app()->environment('production'))https://f001.backblaze.com/file/{{ config('b2client.bucket_name') }}@endif/uploads/{{ $like->imagen }}" title="{{ $like->autor }}" data-author="{{ $like->autor }}" data-gallery>
                        <img src="@if(app()->environment('production'))https://f001.backblaze.com/file/{{ config('b2client.bucket_name') }}@endif/uploads/{{ $like->imagen}}" alt="">
                    </a>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>

    @include('site.partials._curso-gallery')
    @else
    <div class="col-md-offset-4 col-md-4 well bg-info">
        <p class="">Lo siento, aún no hay ningún <i>me gusta</i> en este curso.</p>
    </div>
    @endif

@stop
