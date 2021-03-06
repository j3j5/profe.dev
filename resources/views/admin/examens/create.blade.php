@extends('site.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Nuevo {{ ucwords(str_replace('_', ' ', str_singular($tableName))) }}</h2>

            <form method="POST" action="/{{ config('vivify.prefix') }}/{{ $tableName }}">
                {!! csrf_field() !!}

                @foreach($form as $name => $options)
                <div class="form-group {{ $errors->has($name)? 'has-error' : '' }}">
                    {!! Form::label($name, $options['label'], [ 'class' => 'control-label' ]) !!}
                    @if($options['type'] == 'checkbox')
                        {!! Form::{$options['type']}($name, 1) !!}
                    @elseif ($options['type'] == 'number')
                        {!! Form::input($options['type'], $name, null, ['class'=>'form-control']) !!}
                    @elseif ($options['type'] == 'select')
                        {!! Form::{$options['type']}($name, $options['dropdown'], null, ['class'=>'form-control']) !!}
                    @elseif ($name == 'thumbnail' OR $name == 'archivo')
                        {!! Form::{$options['type']}($name, null, ['class'=>'form-control', 'readonly' => '']) !!}
                    @else
                        {!! Form::{$options['type']}($name, null, ['class'=>'form-control']) !!}
                    @endif

                    @if ($errors->has($name))
                    <p class="help-block">{{ $errors->first($name) }}</p>
                    @endif
                </div>
                @endforeach
                <button class="btn btn-lg btn-success" type="submit">{{ trans('vivify.insert') }}</button>
                <a class="btn btn-sm btn-default" href="/{{ config('vivify.prefix') }}/{{ $tableName }}">{{ trans('vivify.cancel') }}</a>
            </form>
        </div>
        @include("admin.partials._propuestas-uploadZone")
    </div>
</div>

@stop
