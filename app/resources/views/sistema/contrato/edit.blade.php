@php
    $page_title = "Contrato";
    $page_description = "Editar #". $contrato->a013_id_contrato;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($contrato, [
        'method' => 'PATCH',
        'url' => ['/contrato', $contrato->a013_id_contrato],
        'class' => 'form form-contrato EspacoTopo',
        'data-toggle' => 'validator',
        'data-disable' => 'false',
        'files' => true
    ]) !!}

    @include ('sistema.contrato.form', ['submitButtonText' => 'Alterar contrato', 'editPage' => true])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')

@endpush
