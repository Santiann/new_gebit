@php
    $page_title = "Perfil de Acesso";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')


    <div class="box">

        {!! Form::open(['url' => '/role/create', 'class' => 'form form-roles EspacoTopo', 'files' => true,'data-toggle' => 'validator']) !!}

        @include ('sistema.role.form')

        {!! Form::close() !!}
    </div>

@stop


@section('css')

@stop
