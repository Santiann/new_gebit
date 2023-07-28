@php
    $page_title = "Tipo de Vencimento";
    $page_description = "Editar #". $tipo_vencimento->a012_id_tipo_vencimento;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($tipo_vencimento, [
        'method' => 'PATCH',
        'url' => ['/tipo_vencimento', $tipo_vencimento->a012_id_tipo_vencimento],
        'class' => 'form form-tipo_vencimento EspacoTopo',
        'data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.tipo_vencimento.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')

@endpush
