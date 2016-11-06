@extends('site.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>{{ ucwords(str_replace('_', ' ', str_plural($tableName))) }} <a class="btn btn-primary pull-right" href="/{{ config('vivify.prefix') }}/{{ $tableName }}/create">{{ trans('vivify.create') }}</a></h2>

            @if ($filters)
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans('vivify.filter-noun') }}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-inline" method="GET">
                    @foreach($filters as $name => $options)
                        <div class="form-group">
                        {!! Form::label($name, $options['label'], [ 'class' => 'control-label' ]) !!}
                        {!! Form::{$options['type']}($name, @$filterValue[$name], ['class'=>'form-control']) !!}
                        </div>
                    @endforeach
                    <button class="btn btn-info" type="submit">{{ trans('vivify.filter-verb') }}</button>
                    <a href="/{{ config('vivify.prefix') }}/{{ $tableName }}" class="btn btn-warning">{{ trans('vivify.reset') }}</a>
                    </form>
                </div>
                </div>
            @endif

            @if (count($rows) == 0)
                <div class="alert alert-info" role="alert">{{ trans('vivify.no-records') }}</div>
            @else
                <table class="table table-hover">
                <thead>
                    <tr>
                    @foreach($columns as $col)
                        <th style="{{ ($col == $orderColumn)? 'text-decoration: underline' : '' }}">
                        @if(is_array($col))
                        {{ ucfirst($col['label']) }}
                        <a href="{{ $sortHref . '&column=' . $col['label'] }}">
                        @else
                        {{ ucfirst($col) }}
                        <a href="{{ $sortHref . '&column=' . $col }}">
                        @endif
                            <span class="glyphicon glyphicon-sort-by-alphabet{{ ($col == $orderColumn && $direction == 'desc')? '' : '-alt' }}"></span>
                        </a>
                        </th>
                    @endforeach
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                    <tr>
                        @foreach($columns as $col)
                            @if($col == 'thumbnail')
                            <td class="admin-row-thumb">@if($row->$col)<img class="admin-thumb" src="@imageHost()/uploads/{{ $row->$col}}">@endif</td>
                            @elseif($col == 'grupo')
                            <?php $text = App\Models\Concepto::find($row->id)->grupo->nombre; ?>
                            <td class="admin-row">{{ str_limit($text, 35) }}</td>
                            @else
                            <td class="admin-row">{{ str_limit($row->$col, 35) }}</td>
                            @endif
                        @endforeach
                        <td class="admin-row text-right">
                            <div class="btn-group">
                                <a class="btn btn-xs btn-info" href="/{{ config('vivify.prefix') }}/{{ $tableName }}/edit/{{ $row->id }}">
                                    <i class="fa fa-4 fa-pencil-square-o"></i>
                                </a>
                                <a class="btn btn-xs btn-danger" onclick="return confirm('{{ trans('vivify.confirmation') }}')" href="/{{ config('vivify.prefix') }}/{{ $tableName }}/delete/{{ $row->id }}">
                                    <i class="fa fa-1 fa-trash-o"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>

                <div class="text-center">
                {!! $rows->appends(\Request::all())->render() !!}
                </div>
            @endif
        </div>
        @if($tableName == 'images')
        @include('admin.partials._bulkImages-uploadZone')
        @endif
    </div>
</div>
@endsection
