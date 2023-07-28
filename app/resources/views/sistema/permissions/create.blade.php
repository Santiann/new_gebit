@php
    $page_title = "Permissões/Menu";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/permissions/create', 'class' => 'form form-permissions EspacoTopo', 'files' => true
        ,'data-toggle' => 'validator']) !!}

    @include ('sistema.permissions.form')

    {!! Form::close() !!}
</div>

@stop


@push('css')

@endpush
@push('js')

@endpush

