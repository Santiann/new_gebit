@php
    $page_title = "Tipo de Contrato";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/tipo_contrato/create', 'class' => 'form form-tipo_contrato EspacoTopo',  'files' => true]) !!}

    @include ('sistema.tipo_contrato.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')

@endpush
