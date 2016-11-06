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
                <a href="@imageHost()/uploads/{{ $like->imagen }}" title="{{ $like->autor }}" data-author="{{ $like->autor }}" data-gallery>
                        <img src="@imageHost()/uploads/{{ $like->imagen}}" alt="">
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
