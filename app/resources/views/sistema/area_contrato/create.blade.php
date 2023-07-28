@php
    $page_title = "Áreas";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/area_contrato/create', 'class' => 'form form-area_contrato EspacoTopo', 'files' => true]) !!}

    @include ('sistema.area_contrato.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')

@endpush
