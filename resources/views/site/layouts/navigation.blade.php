<?php
    if(request()->is('admin/*')) {
        $active_admin = 'active';
    } elseif(request()->is('auth/*')) {
        $active_login = 'active';
    } elseif(request()->is('/')) {
        $active_home = 'active';
    }
?>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Profe Mariana</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ $active_home or '' }}"><a href="/">{{ trans('navbar.home') }}</a></li>
                <li class="{{ $active_admin or '' }}"><a href="/admin/propuestas">{{ trans('navbar.admin') }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right ">
            @if(Auth::guest())
                <li class="{{ $active_login or '' }}"><a href="/auth/login">{{ trans('auth.login-btn') }}</a></li>
            @else
                <li>
                    <div class="form-group navbar-form navbar-right home-login">
                        <a href="/auth/logout"><button type="submit" class="btn my-btn logout">{{ trans('auth.logout-btn') }}</button></a>
                    </div>
                </li>
            @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
