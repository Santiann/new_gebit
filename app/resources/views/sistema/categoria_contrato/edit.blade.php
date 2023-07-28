@php
    $page_title = "Categoria de Contrato";
    $page_description = "Editar #". $categoria_contrato->a008_id_cat_contrato;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($categoria_contrato, [
        'method' => 'PATCH',
        'url' => ['/categoria_contrato', $categoria_contrato->a008_id_cat_contrato],
        'class' => 'form form-categoria_contrato EspacoTopo',
        'data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.categoria_contrato.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')

@endpush
