@php
    $page_title = "Permissões/Menu";
    $page_description = "Editar #". $permission->id;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($permission, [
        'method' => 'PATCH',
        'url' => ['/permissions', $permission->id],
        'class' => 'form form-permissions EspacoTopo','data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.permissions.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop


@push('css')

@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $(".jnomeInterno").prop("readonly","readonly");

        });

    </script>
@endpush
