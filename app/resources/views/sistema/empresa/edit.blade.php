@php
    $page_title = ucfirst($tipo??"Empresa");
    $page_description = "Editar #". $empresa->a005_id_empresa;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">
    {!! Form::model($empresa, [
        'method' => 'PATCH',
        'url' => ['/empresa', $empresa->a005_id_empresa],
        'class' => 'form form-empresa EspacoTopo',
        'files' => true
    ]) !!}
    {!! Form::hidden('meusdados', 1, ['class' => 'meusdados', 'id' => 'meusdados']) !!}
    @include ('sistema.empresa.form', ['submitButtonText' => 'Salvar', 'editPage' => true])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')
    <script>
        $("#a005_ind_empresa").prop("readonly", true);

        $("#a005_ind_empresa").click(function($value){
            if($("#a005_ind_empresa:checked").length<=0)
                $("#a005_ind_empresa").prop("checked", true);
            validaClienteFornecedor();
        });

        @if(($empresa->a004_dono_cadastro??1) == 1)

        @else
            $(".jIndEmpresa").hide();
            $(".jValidaDonoCadastro").attr('readonly','readonly');
            $(".validaunico").removeClass('validaunico');
            $(".jcontatode").hide();
        @endif



        $('.form').validator('validate');
    </script>
@endpush
