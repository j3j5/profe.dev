@extends('site.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>{{ ucwords(str_replace('_', ' ', str_plural($tableName))) }} <a class="btn btn-primary pull-right" href="/{{ packageConfig('prefix') }}/{{ $tableName }}/create">{{ packageTranslation('vivify.create') }}</a></h2>

            @if ($filters)
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ packageTranslation('vivify.filter-noun') }}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-inline" method="GET">
                    @foreach($filters as $name => $options)
                        <div class="form-group">
                        {!! Form::label($name, $options['label'], [ 'class' => 'control-label' ]) !!}
                        {!! Form::{$options['type']}($name, @$filterValue[$name], ['class'=>'form-control']) !!}
                        </div>
                    @endforeach
                    <button class="btn btn-info" type="submit">{{ packageTranslation('vivify.filter-verb') }}</button>
                    <a href="/{{ packageConfig('prefix') }}/{{ $tableName }}" class="btn btn-warning">{{ packageTranslation('vivify.reset') }}</a>
                    </form>
                </div>
                </div>
            @endif

            @if (count($rows) == 0)
                <div class="alert alert-info" role="alert">{{ packageTranslation('vivify.no-records') }}</div>
            @else
                <table class="table table-hover">
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
                    @foreach($rows as $row)
                    <tr>
                        @foreach($columns as $col)
                            @if($tableName == 'images' && $col == 'nombre-archivo')
                            <td class="admin-row-thumb"><img class="admin-thumb" src="@if(app()->environment('production'))https://f001.backblaze.com/file/{{ config('b2client.bucket_name') }}@endif/images/galeria/{{ $row->curso }}/{{ $row->$col }}"></td>
                            @elseif(in_array($tableName, ['propuestas', 'conceptos']) && $col == 'thumbnail')
                            <td class="admin-row-thumb">@if($row->$col)<img class="admin-thumb" src="@if(app()->environment('production'))https://f001.backblaze.com/file/{{ config('b2client.bucket_name') }}@endif/uploads/{{ $row->$col}}">@endif</td>

                            @else
                            <td class="admin-row">{{ str_limit($row->$col, 35) }}</td>
                            @endif
                        @endforeach
                        <td class="admin-row text-right">
                            <div class="btn-group">
                                <a class="btn btn-xs btn-info" href="/{{ packageConfig('prefix') }}/{{ $tableName }}/edit/{{ $row->id }}">
                                    <i class="fa fa-4 fa-pencil-square-o"></i>
                                </a>
                                <a class="btn btn-xs btn-danger" onclick="return confirm('{{ packageTranslation('vivify.confirmation') }}')" href="/{{ packageConfig('prefix') }}/{{ $tableName }}/delete/{{ $row->id }}">
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
