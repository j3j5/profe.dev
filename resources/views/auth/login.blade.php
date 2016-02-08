@extends('site.layouts.master')

@section('content')
<div class="container login col-md-8 col-md-offset-2">
    {!! Form::open(array('url'=>'auth/login', 'method'=>'POST', 'accept-charset'=>'UTF-8', 'class' => 'form-signin')) !!}

        <h2 class="form-signin-heading">{{ trans('auth.login-heading') }}</h2>
        <div class="form-group">
            {!! Form::label('email','E-mail',array('id'=>'','class'=>'sr-only', 'for' => 'inputEmail')) !!}
            <?php $email_placeholder = trans('auth.email-placeholder'); ?>
            {!! Form::email('email','',array('id'=>'inputEmail','class'=>'form-control', 'placeholder' => $email_placeholder)) !!}
        </div>
        <div class="form-group">
            <?php $password = trans('auth.password'); $password_placeholder = trans('auth.password-placeholder'); ?>
            {!! Form::label('password', $password, array('id'=>'','class'=>'sr-only', 'for' => 'inputPassword')) !!}
            {!! Form::password('password', array('id'=>'inputPassword', 'class'=>'form-control', 'placeholder' => $password_placeholder, 'required' => '')) !!}
        </div>

        <div class="checkbox">
          <label>
            {!! Form::checkbox('status','1',true) !!} {{ trans('auth.remember-me') }}
          </label>
        </div>

        <?php $login = trans('auth.login-btn'); ?>
        {!! Form::submit($login, array('id' => '', 'class'=>'btn btn-lg btn-primary btn-block')) !!}

        {!! csrf_field() !!}

    {!! Form::close() !!}
</div>

@stop
