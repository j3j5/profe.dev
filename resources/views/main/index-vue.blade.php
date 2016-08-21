@extends('site.layouts.master')

@section('content')
<div class="container-fluid content">
    <div id="admin" @keyup.esc="showModal = false" class="col-md-10 col-md-offset-1">
        <h2>{{ ucwords(str_replace('_', ' ', str_plural($model))) }} </h2>
        <bootstrap-table
            endpoint="{{ route('getTableValues', $model) }}"
            :columns.sync="tableColumns"
            :values.sync="tableValues"
        >
        </bootstrap-table>
    </div>
</div>
@endsection
