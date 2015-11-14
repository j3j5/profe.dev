@extends('site.layouts.master')

@section('content')
<div class="container">

    @if (count($errors) > 0)
        <div class="error">
            <strong>Whoops!</strong> There were some problems with your input.<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('url'=>'auth/register', 'method'=>'POST', 'accept-charset'=>'UTF-8', 'class' => 'form-horizontal')) !!}

        <div class="form-group">
            {!! Form::label('name','Nombre',array('id'=>'','class'=>'col-sm-2 control-label', 'for' => 'inputUsername')) !!}
            <div class="col-sm-10">
                {!! Form::text('name','',array('id'=>'inputName','class'=>'form-control', 'placeholder' => 'Tu nombre')) !!}
            </div>
        </div>

        <div class="form-group">
        {!! Form::label('email','E-mail',array('id'=>'','class'=>'col-sm-2 control-label', 'for' => 'inputEmail')) !!}
            <div class="col-sm-10">
                {!! Form::email('email','',array('id'=>'inputEmail','class'=>'form-control', 'placeholder' => 'Tu dirección de email')) !!}
            </div>
        </div>
        <div class="form-group">
        {!! Form::label('password','Contraseña',array('id'=>'','class'=>'col-sm-2 control-label', 'for' => 'inputPassword')) !!}
            <div class="col-sm-10">
            {!! Form::password('password',array('id'=>'inputPassword','class'=>'form-control', 'placeholder' => 'Tu contraseña')) !!}
            </div>
        </div>

        <div class="form-group">
        {!! Form::label('password','Repita Contraseña',array('id'=>'','class'=>'col-sm-2 control-label', 'for' => 'inputPassword')) !!}
            <div class="col-sm-10">
            {!! Form::password('password_confirmation',array('id'=>'inputPassword','class'=>'form-control', 'placeholder' => 'Tu contraseña')) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Registrate', array('id' => '', 'class'=>'btn btn-default')) !!}
            </div>
        </div>

    {!! Form::close() !!}
</div>

@stop
