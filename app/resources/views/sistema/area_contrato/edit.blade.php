@php
    $page_title = "Áreas";
    $page_description = "Editar #". $area_contrato->a011_id_area;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($area_contrato, [
        'method' => 'PATCH',
        'url' => ['/area_contrato', $area_contrato->a011_id_area],
        'class' => 'form form-area_contrato EspacoTopo',
        'data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.area_contrato.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')

@endpush
