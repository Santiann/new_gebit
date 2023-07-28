@php
    $page_title = "Usuário";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

    <div class="box">

        {!! Form::open(['url' => '/usuario/create', 'class' => 'form form-usuario EspacoTopo', 'data-toggle' => 'validator', 'files' => true]) !!}

        @include ('sistema.usuario.form')

        {!! Form::close() !!}
    </div>
@stop

@push('css')

@endpush

@push('js')

@endpush
