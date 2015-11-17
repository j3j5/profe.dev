@extends('site.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>New {{ ucwords(str_replace('_', ' ', str_singular($tableName))) }}</h2>

            <form method="POST" action="/{{ packageConfig('prefix') }}/{{ $tableName }}">
                {!! csrf_field() !!}

                @foreach($form as $name => $options)
                <div class="form-group {{ $errors->has($name)? 'has-error' : '' }}">
                    {!! Form::label($name, $options['label'], [ 'class' => 'control-label' ]) !!}
                    @if($options['type'] == 'checkbox')
                        {!! Form::$options['type']($name, 1) !!}
                    @elseif ($options['type'] == 'number')
                        {!! Form::input($options['type'], $name, null, ['class'=>'form-control']) !!}
                    @elseif ($name == 'thumbnail' OR $name == 'archivo')
                        {!! Form::$options['type']($name, null, ['class'=>'form-control', 'readonly' => '']) !!}
                    @else
                        {!! Form::$options['type']($name, null, ['class'=>'form-control']) !!}
                    @endif

                    @if ($errors->has($name))
                    <p class="help-block">{{ $errors->first($name) }}</p>
                    @endif
                </div>
                @endforeach
                <button class="btn btn-success" type="submit">{{ packageTranslation('vivify.insert') }}</button>
                <a class="btn btn-default" href="/{{ packageConfig('prefix') }}/{{ $tableName }}">{{ packageTranslation('vivify.cancel') }}</a>
            </form>
        </div>
        <div class="col-md-8 col-md-offset-2 uploadZone">
            <div id="thumbnails-upload" class="col-md-6">
                <label class="control-label">Thumbnail</label>
                <form id="images-dropzone" action="/propuestas/images/upload" class="dropzone">
                    {!! csrf_field() !!}
                    <div class="dz-message"><span>{{ packageTranslation('vivify.uploadDropZone') }}</span></div>
                </form>
            </div>
            <div id="files-upload" class="col-md-6">
                <label class="control-label">Archivo</label>
                <form id="files-dropzone" action="/propuestas/upload" class="dropzone">
                    {!! csrf_field() !!}
                    <div class="dz-message"><span>{{ packageTranslation('vivify.uploadDropZone') }}</span></div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
