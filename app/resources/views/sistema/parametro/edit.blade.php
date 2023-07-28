@php
    $page_title = "Parametro";
    $page_description = "Editar #". $parametro->a000_id_parametro;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($parametro, [
        'method' => 'PATCH',
        'url' => ['/parametro', $parametro->a000_id_parametro],
        'class' => 'form form-parametro EspacoTopo',
        'data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.parametro.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')
    <script>
        $(document).ready(function() {
            if($("#a000_ind_adm").val() == "1") {
                $("#a000_sigla").prop("readonly", "readonly");
            }

        });
    </script>
@endpush
