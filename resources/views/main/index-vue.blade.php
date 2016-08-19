@extends('site.layouts.master')

@section('content')
<div class="container-fluid content">
    <div class="col-md-10 col-md-offset-1">
        <h2>{{ ucwords(str_replace('_', ' ', str_plural($tableName))) }} <a class="btn btn-primary pull-right" href="/{{ config('vivify.prefix') }}/{{ $tableName }}/create">{{ trans('vivify.create') }}</a></h2>

        @if (count($rows) == 0)
            <div class="alert alert-info" role="alert">{{ trans('vivify.no-records') }}</div>
        @else
            <div class="row">
                <div class="col-sm-12">
                    <button @click="addItem" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add an item</button>
                    <button @click="toggleFilter" class="btn btn-default">Toggle Filter</button>
                    <button @click="togglePicker" class="btn btn-default">Toggle Column Picker</button>
                </div>
                <br/><br/>
                <bootstrap-table
                        :columns="{{ json_encode($columns) }}"
                        :values="{{ json_encode($rows) }}"
                        :show-filter="showFilter"
                        :show-column-picker="showPicker"
                >
                </bootstrap-table>
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
