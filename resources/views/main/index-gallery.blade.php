@extends('site.layouts.master')

@section('content')
<div class="container-fluid content">
    <div id="admin" @keyup.esc="closeAndResetModal" class="col-md-12">

        <h2>{{ ucwords($models[$model]) }} </h2>

        <admin-gallery model-name="{{ $model }}"></admin-gallery>

        @include("admin.$model.modal")

    </div>
</div>
@endsection
