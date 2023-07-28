@php
    $page_title = "Categoria de Contrato";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/pendencias_contrato/create', 'class' => 'form form-categoria_contrato EspacoTopo',  'files' => true]) !!}

    @include ('sistema.pendencias_contrato.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')

@endpush
