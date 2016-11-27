@extends('site.layouts.master')

@section('content')
<div class="container-fluid content">
    <div id="admin" class="col-md-12">

        <h2>{{ ucwords($models[$table]) }} </h2>

        <admin-gallery model-name="{{ $table }}"></admin-gallery>

        <add-{{$model}}-modal
            name="{{ $table }}"
            :show="showModal"
            :action="modalAction"
            :model="selectedModel"
        ></add-{{$model}}-modal>


    </div>
    @include("admin.$table.modal")
</div>
@endsection
