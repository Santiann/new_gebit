@php
    $page_title = ucfirst($tipo??"Empresa");
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/empresa/create', 'class' => 'form form-empresa EspacoTopo', 'files' => true]) !!}

    @include ('sistema.empresa.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')

@endpush
