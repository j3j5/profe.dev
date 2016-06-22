    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="{{ route("Home") }}"><i class="fa fa-home"></i></a></li>
            @foreach( explode('/', request()->path()) as $crumb)
                @if($crumb !== "curso")
            <li class="text-capitalize">
                @if(in_array($crumb, ["primero", "segundo", "tercero"]))
                <a href="{{ route("curso", [$curso]) }}">{{ $crumb }}</a>
                @else
                <?php if($crumb == 'examenes') { $crumb = "exámenes";  } ?>
                <a href="{{ route("curso", [$curso, $crumb]) }}">{{ $crumb }}</a>
                @endif
            </li>
                @endif
            @endforeach
        </ol>
    </div>
