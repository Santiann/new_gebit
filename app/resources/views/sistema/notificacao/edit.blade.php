@php
    $page_title = "Notificacao";
    $page_description = "Editar #". $notificacao->a996_id_notificacao;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($notificacao, [
        'method' => 'PATCH',
        'url' => ['/notificacao', $notificacao->a996_id_notificacao],
        'class' => 'form form-notificacao EspacoTopo',
        'data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.notificacao.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')

@endpush
