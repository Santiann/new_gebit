@php
    $page_title = "Compromissos com documentos";
    $page_description = "Detalhe #". $compromisso->a022_id_compromisso;
@endphp

@extends('layouts.app')

@section('page-bar')
<!-- BEGIN PAGE BAR -->
<section class="content-header">
    <h1>
        {{ $page_title ?? "Page Title" }}
        <!--<small>{{ $page_description or null }}</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/compromisso')}}">{{ $page_title ?? "Page Title" }}</a></li>
        <li class="active">{{ $page_description or "Detalhe" }}</li>
    </ol>
</section>
<!-- END PAGE BAR -->
@stop

@section('page-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $page_title or "Page Title" }}</h3>
        {{-- <span class="badge badge-info">@if ($count != 0) {!! $count !!} @endif</span> --}}
        <div class="box-tools">
            <a href="{{ url('/compromisso') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('compromisso-edit')
            <a href="{{ url('/compromisso/' . $compromisso->a022_id_compromisso . '/edit') }}" title="Edit Compromisso"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('compromisso-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['compromisso', $compromisso->a022_id_compromisso],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Compromisso',
                        'onclick'=>'return confirm("Confirma Excluir?")'
                ))!!}
            {!! Form::close() !!}
            @endpermission
        </div>
    </div>
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $compromisso->a022_id_compromisso }}</td>
                </tr>
                <tr><th> A005 Id Empresa </th><td> {{ $compromisso->a005_id_empresa }} </td></tr><tr><th> A013 Id Contrato </th><td> {{ $compromisso->a013_id_contrato }} </td></tr><tr><th> A005 Id Empresa Cli For </th><td> {{ $compromisso->a005_id_empresa_cli_for }} </td></tr><tr><th> A022 Classificacao </th><td> {{ $compromisso->a022_classificacao }} </td></tr><tr><th> A022 Finalidade </th><td> {{ $compromisso->a022_finalidade }} </td></tr><tr><th> A022 Data Vencimento </th><td> {{ $compromisso->a022_data_vencimento }} </td></tr><tr><th> A022 Valor Pagar </th><td> {{ $compromisso->a022_valor_pagar }} </td></tr><tr><th> A022 Uso Vital </th><td> {{ $compromisso->a022_uso_vital }} </td></tr><tr><th> A022 Data Pagamento </th><td> {{ $compromisso->a022_data_pagamento }} </td></tr><tr><th> A022 Valor Pago </th><td> {{ $compromisso->a022_valor_pago }} </td></tr><tr><th> A022 Forma Pagamento </th><td> {{ $compromisso->a022_forma_pagamento }} </td></tr><tr><th> A022 Status </th><td> {{ $compromisso->a022_status }} </td></tr><tr><th> Criado Em </th><td> {{ $compromisso->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $compromisso->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $compromisso->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $compromisso->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
