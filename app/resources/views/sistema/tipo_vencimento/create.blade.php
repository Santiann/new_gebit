@php
    $page_title = "Tipo de Vencimento";
    $page_description = "Novo";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::open(['url' => '/tipo_vencimento/create', 'class' => 'form form-tipo_vencimento EspacoTopo', 'data-toggle' => 'validator', 'files' => true]) !!}

    @include ('sistema.tipo_vencimento.form')

    {!! Form::close() !!}
</div>
@stop

@push('css')

@endpush

@push('js')

@endpush
