@php
    $page_title = "Parametro";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/parametro/create', 'class' => 'form form-parametro EspacoTopo', 'data-toggle' => 'validator', 'files' => true]) !!}

    @include ('sistema.parametro.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')

@endpush
