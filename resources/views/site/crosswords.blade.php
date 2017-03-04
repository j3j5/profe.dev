@extends('site.layouts.master')

@section('content')

    <div id="crosswords">
        <xwords :width=20 :height=20 :words="{{json_encode($words)}}" :answers="{{json_encode($answers)}}" :clues="[]"></xword>
    </div>
@endsection
