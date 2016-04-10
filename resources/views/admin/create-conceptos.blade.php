@extends('site.layouts.master')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Nuevos {{ ucwords(str_replace('_', ' ', str_singular($tableName))) }}</h2>

            <form method="POST" action="/{{ packageConfig('prefix') }}/{{ $tableName }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @foreach($form as $name => $options)
                @if ($name == 'belongsTo')
                    @foreach($options as $belongsToName => $belongsToOptions)
                    <div class="form-group {{ $errors->has($belongsToName)? 'has-error' : '' }}">
                        {!! Form::label($belongsToName, $belongsToOptions['label'], [ 'class' => 'control-label' ]) !!}
                        {!! Form::select($belongsToOptions['column'], $belongsTo[$belongsToName], null, ['class' => 'form-control']) !!}
                    </div>
                    @endforeach
                @else
                    <div class="form-group {{ $errors->has($name)? 'has-error' : '' }}">
                    {!! Form::label($name, $options['label'], [ 'class' => 'control-label' ]) !!}
                    @if($options['type'] == 'checkbox')
                        {!! Form::{$options['type']}($name, 1) !!}
                    @elseif ($options['type'] == 'number')
                        {!! Form::input($options['type'], $name, null, ['class'=>'form-control']) !!}
                    @elseif ($options['type'] == 'select')
                        {!! Form::{$options['type']}($name, $options['dropdown'], null, ['class'=>'form-control']) !!}
                    @elseif ($name == 'thumbnail')
                        {!! Form::{$options['type']}($name, null, ['class'=>'form-control', 'readonly' => '']) !!}
                    @else
                        {!! Form::{$options['type']}($name, null, ['class'=>'form-control']) !!}
                    @endif
                    @if ($errors->has($name))
                        <p class="help-block">{{ $errors->first($name) }}</p>
                    @endif
                    </div>
                @endif
                @endforeach
                <button class="btn btn-success" type="submit">{{ packageTranslation('vivify.insert') }}</button>
                <a class="btn btn-default" href="/{{ packageConfig('prefix') }}/{{ $tableName }}">{{ packageTranslation('vivify.cancel') }}</a>
            </form>
        </div>
        @include("admin.partials._images-uploadZone")
    </div>
</div>
@endsection
