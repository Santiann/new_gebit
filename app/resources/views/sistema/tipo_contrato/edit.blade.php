@php
    $page_title = "Tipo de Contrato";
    $page_description = "Editar #". $tipo_contrato->a010_id_tipo_contrato;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($tipo_contrato, [
        'method' => 'PATCH',
        'url' => ['/tipo_contrato', $tipo_contrato->a010_id_tipo_contrato],
        'class' => 'form form-tipo_contrato EspacoTopo',
        'data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.tipo_contrato.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')

@endpush
