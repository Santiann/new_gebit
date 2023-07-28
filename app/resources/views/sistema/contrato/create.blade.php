@php
    $page_title = "Contrato";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/contrato/create', 'class' => 'form form-contrato EspacoTopo', 'files' => true]) !!}

    @include ('sistema.contrato.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')

@endpush
