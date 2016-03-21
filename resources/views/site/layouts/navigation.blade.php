<?php
    if(request()->is('admin/*')) {
        $active_admin = 'active';
    } else {
        $active = request()->path();
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
            <a class="navbar-brand" href="{{ route("Home") }}">Profe Mariana</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="@if($active == "primero") active @endif"><a href="{{ route("curso", ["primero"]) }}">Primero</a></li>
                <li class="@if($active == "segundo") active @endif"><a href="{{ route("curso", ["segundo"]) }}">Segundo</a></li>
                <li class="@if($active == "tercero") active @endif"><a href="{{ route("curso", ["tercero"]) }}">Tercero</a></li>
            @if(Auth::check())
                <li class="{{ $active_admin or '' }}"><a href="/admin/propuestas">{{ trans('navbar.admin') }}</a></li>
            @endif
            </ul>
            <ul class="nav navbar-nav navbar-right ">
            @if(Auth::check())
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
