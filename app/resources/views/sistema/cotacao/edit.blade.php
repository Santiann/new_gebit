@php
    $page_title = "Cotação";
    $page_description = "Editar #". $cotacao->a018_id_contacao;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($cotacao, [
        'method' => 'PATCH',
        'url' => ['/cotacao', $cotacao->a018_id_contacao],
        'class' => 'form form-cotacao EspacoTopo',
        'data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.cotacao.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')
    <script>
        $("#a018_status_combo").val('{{$cotacao->a018_status??"O"}}');//.select2({disabled:true});
        $("#a018_status").val('{{$cotacao->a018_status??"O"}}');

        if('{{$cotacao->a018_status??"O"}}'=="E") {
            $("#a018_status_combo").select2({disabled: false}).val('E');//.select2({disabled: true});
            $("#a018_status").val('E');
            //$(".botaoSalvarTela").remove();
            $(".FornecedoresAdicionar").remove();
        }



    </script>
@endpush
