@extends('site.layouts.master')

@section('content')
<div class="container-fluid content">
    <div id="admin" @keyup.esc="showModal = false" class="col-md-10 col-md-offset-1">
        <h2>{{ ucwords(str_replace('_', ' ', str_plural($model))) }} </h2>

        <!-- BUTTONS (ADD + FILTER) -->
        <div class="col-sm-12">
            <button @click="showModal = true"  class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Añadir nuevo</button>
        </div>

        <admin-table
            model="{{ $model }}"
            :columns.sync="tableColumns"
            :values.sync="tableValues"
        >
        </admin-table>

        <add-item-modal
            name="{{ $model }}"
            :show.sync="showModal"
            :action="modalAction"
            :model="selectedModel"
        ></add-item-modal>

    </div>
</div>
@endsection
