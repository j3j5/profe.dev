@extends('site.layouts.master')

@section('content')
<div class="container-fluid content">
    <div id="admin" @keyup.esc="closeAndResetModal" class="col-md-10 col-md-offset-1">
        <h2>{{ ucwords(str_replace('_', ' ', str_plural($model))) }} </h2>

        <admin-table
            model="{{ $model }}"
            :columns.sync="tableColumns"
            :values.sync="tableValues"
            :show-modal.sync="showModal"
        >
        </admin-table>

        @include("admin.$model.modal")

    </div>
</div>
@endsection
