@php
    $page_title = "Orçamento";
    $page_description = "Orçar #". $cotacao->a018_id_contacao;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($cotacao, [
        'method' => 'PATCH',
        'url' => ['/orcamento', $cotacao->a018_id_contacao],
        'class' => 'form form-cotacao EspacoTopo',
        'data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.orcamento.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')
    <script>
        $("#a020_status_combo").val('{{$cotacao->a020_status??"O"}}').select2({disabled:true});
        $("#a020_status").val('{{$cotacao->a020_status??"O"}}');

        if('{{$cotacao->a018_status??"O"}}' != 'O')
        {
            $(".botaoSalvarTela").remove();
            $(".FornecedoresAdicionar").remove();
        }
    </script>
@endpush
