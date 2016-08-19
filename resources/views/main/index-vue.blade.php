@extends('site.layouts.master')

@section('content')
<div class="container-fluid content">
    <div id="admin" @keyup.esc="showModal = false" class="col-md-10 col-md-offset-1">
        <h2>{{ ucwords(str_replace('_', ' ', str_plural($tableName))) }} </h2>
            <div class="col-sm-12">
                <button @click="showModal = true"  class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Añadir nuevo</button>
            @if (count($rows) == 0)
            </div>
            <div class="alert alert-info" role="alert">{{ trans('vivify.no-records') }}</div>
            @else
                <button @click="toggleFilter" class="btn btn-default">Filtrar</button>
            </div>

            <div class="col-sm-12">
                <bootstrap-table
                        :columns="{{ json_encode($columns) }}"
                        :values="{{ json_encode($rows) }}"
                        :show-filter.sync="showFilter"
                >
                </bootstrap-table>
            </div>
            @endif
            <add-item-modal
                :show.sync="showModal"
                name="{{ ucwords(str_replace('_', ' ', str_plural($tableName))) }}"
                fields="{{ json_encode($form) }}"
                action="/{{ config('vivify.prefix') }}/{{ $tableName }}"
                uploader="{{ in_array($tableName, ['images']) }}"
                :model.sync="selectedModel"
            >
    </div>
</div>
@endsection
