@php
    $page_title = "Meus Dados";
    $page_description = "";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

    <div class="box">

        {!! Form::model($usuario, [
            'method' => 'PATCH',
            'url' => ['usuario', $usuario->a001_id_usuario],
            'class' => 'form form-usuario EspacoTopo',
            'data-toggle' => 'validator',
            'files' => true
        ]) !!}
        {!! Form::hidden('meusdados', 1, ['class' => 'meusdados', 'id' => 'meusdados']) !!}
        @include ('sistema.usuario.form', ['submitButtonText' => 'Salvar'])

        {!! Form::close() !!}
    </div>

@stop

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            $('.form').validator('validate')
        });
    </script>
@endpush
