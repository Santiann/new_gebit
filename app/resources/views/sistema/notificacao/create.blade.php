@php
    $page_title = "Notificacao";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/notificacao/create', 'class' => 'form form-notificacao EspacoTopo', 'data-toggle' => 'validator', 'files' => true]) !!}

    @include ('sistema.notificacao.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')

@endpush
