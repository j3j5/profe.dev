@extends('site.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Editar {{ ucwords(str_replace('_', ' ', str_singular($tableName))) }} </h2>
            <form method="POST" action="/{{ config('vivify.prefix') }}/{{ $tableName }}/{{ $entity->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">

                @foreach($form as $name => $options)
                <div class="form-group {{ $errors->has($name)? 'has-error' : '' }}">
                    {!! Form::label($name, $options['label']) !!}
                    @if($options['type'] == 'checkbox')
                        {!! Form::hidden($name, 0) !!}
                        {!! Form::{$options['type']}($name, 1, $entity->$name) !!}
                    @elseif ($options['type'] == 'number')
                        {!! Form::input($options['type'], $name, $entity->$name, ['class'=>'form-control']) !!}
                    @elseif ($name == 'thumbnail' OR $name == 'archivo')
                        {!! Form::{$options['type']}($name, $entity->$name, ['class'=>'form-control', 'readonly' => '']) !!}
                    @elseif ($options['type'] == 'select')
                        {!! Form::{$options['type']}($name, $options['dropdown'], $entity->$name, ['class'=>'form-control']) !!}
                    @else
                        {!! Form::{$options['type']}($name, $entity->$name, ['class'=>'form-control']) !!}
                    @endif
                    @if ($errors->has($name))
                        <p class="help-block">{{ $errors->first($name) }}</p>
                    @endif
                </div>
                @endforeach


                <button class="btn btn-lg btn-success" type="submit">{{ trans('vivify.update') }}</button>
                <a class="btn btn-sm btn-default" href="/{{ config('vivify.prefix') }}/{{ $tableName }}">{{ trans('vivify.cancel') }}</a>
            </form>
        </div>
    @include("admin.partials._propuestas-uploadZone")
    </div> <!-- row -->
</div> <!-- container -->
@stop
