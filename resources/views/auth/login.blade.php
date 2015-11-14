@extends('site.layouts.master')

@section('content')
<div class="container">
    {!! Form::open(array('url'=>'auth/login', 'method'=>'POST', 'accept-charset'=>'UTF-8', 'class' => 'form-horizontal')) !!}

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
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                    {!! Form::checkbox('status','1',true) !!} Recuérdame
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Login', array('id' => '', 'class'=>'btn btn-default')) !!}
            </div>
        </div>

    {!! Form::close() !!}
</div>

@stop
