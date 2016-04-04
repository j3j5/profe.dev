
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">packageTranslation('vivify.toggle') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">{{ packageTranslation('vivify.admin-panel') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            @foreach(packageConfig('tables') as $table)
                @if(request()->is("admin/$table*"))
                <li class="active">
                @else
                <li>
                @endif
                <a href="/{{ packageConfig('prefix') }}/{{ $table }}">{{ ucwords(str_replace('_', ' ', $table)) }}</a></li>
            @endforeach
            </ul>

            <ul class="nav navbar-nav navbar-right">
            @if (packageConfig('additionalLinks'))
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                </a>
                    <ul class="dropdown-menu" role="menu">
                    @foreach(packageConfig('additionalLinks') as $label => $link)
                        <li><a href="{{ action($link) }}">{{ $label }}</a></li>
                    @endforeach
                    </ul>
                </li>
            @endif
                <li>
                    <div class="form-group navbar-form navbar-right home-login">
                        <a href="/auth/logout"><button type="submit" class="btn my-btn logout">{{ trans('auth.logout-btn') }}</button></a>
                    </div>
                </li>
            </ul>
        </div>
        </div>
    </nav>
