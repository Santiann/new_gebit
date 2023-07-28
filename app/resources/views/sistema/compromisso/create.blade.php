@php
    $page_title = "Compromissos com documentos";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/compromisso/create', 'class' => 'form form-compromisso EspacoTopo', 'data-toggle' => 'validator', 'files' => true]) !!}

    @include ('sistema.compromisso.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')

@endpush
