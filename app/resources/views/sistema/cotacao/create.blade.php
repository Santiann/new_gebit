@php
    $page_title = "Cotação";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/cotacao/create', 'class' => 'form form-cotacao EspacoTopo', 'data-toggle' => 'validator', 'files' => true]) !!}

    @include ('sistema.cotacao.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')
    <script>
        $("#a018_status_combo").val("O").select2({disabled:true});
        $("#a018_status").val("O");

    </script>
@endpush
