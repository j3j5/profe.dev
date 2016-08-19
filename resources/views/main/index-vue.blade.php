@extends('site.layouts.master')

@section('content')
<div class="container-fluid content">
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
            <table id="admin-table" class="table table-hover">
            <thead>
                <tr>
                @foreach($columns as $col)
                    <th style="{{ ($col == $orderColumn)? 'text-decoration: underline' : '' }}">
                    {{ ucfirst($col) }}
                    <a href="{{ $sortHref . '&column=' . $col }}">
                        <span class="glyphicon glyphicon-sort-by-alphabet{{ ($col == $orderColumn && $direction == 'desc')? '' : '-alt' }}"></span>
                    </a>
                    </th>
                @endforeach
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <myrow rows="{{ $rows->toJson() }}" columns="{{json_encode($columns)}}"></myrow>
            </tbody>
            </table>

            <div class="text-center">
            {!! $rows->appends(\Request::all())->render() !!}
            </div>
        @endif
    </div>
    @if(in_array($tableName, ['images']))
    @include('admin.partials._bulkImages-uploadZone')
    @endif
</div>

<script>

</script>

@endsection
