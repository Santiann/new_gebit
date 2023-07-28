@php
    $page_title = "Usuário";
    $page_description = "Editar #". $usuario->a001_id_usuario;
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

        @include ('sistema.usuario.form', ['submitButtonText' => 'Salvar'])

        {!! Form::close() !!}
    </div>

@stop

@push('css')

@endpush

@push('js')

@endpush
