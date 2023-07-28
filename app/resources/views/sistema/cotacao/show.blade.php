@php
    $page_title = "Cotacao";
    $page_description = "Detalhe #". $cotacao->a018_id_contacao;
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
        <li><a href="{{ url('/cotacao')}}">{{ $page_title ?? "Page Title" }}</a></li>
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
            <a href="{{ url('/cotacao') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('cotacao-edit')
            <a href="{{ url('/cotacao/' . $cotacao->a018_id_contacao . '/edit') }}" title="Edit Cotacao"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('cotacao-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['cotacao', $cotacao->a018_id_contacao],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Cotacao',
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
                    <td>{{ $cotacao->a018_id_contacao }}</td>
                </tr>
                <tr><th> A005 Id Empresa </th><td> {{ $cotacao->a005_id_empresa }} </td></tr><tr><th> A018 O Que </th><td> {{ $cotacao->a018_o_que }} </td></tr><tr><th> A018 Descricao </th><td> {{ $cotacao->a018_descricao }} </td></tr><tr><th> A018 Porque </th><td> {{ $cotacao->a018_porque }} </td></tr><tr><th> A018 Para Quem </th><td> {{ $cotacao->a018_para_quem }} </td></tr><tr><th> A018 Data Prevista </th><td> {{ $cotacao->a018_data_prevista }} </td></tr><tr><th> A018 Entrega </th><td> {{ $cotacao->a018_entrega }} </td></tr><tr><th> A018 Forma Pagamento </th><td> {{ $cotacao->a018_forma_pagamento }} </td></tr><tr><th> A018 Onde </th><td> {{ $cotacao->a018_onde }} </td></tr><tr><th> A018 Notificar </th><td> {{ $cotacao->a018_notificar }} </td></tr><tr><th> A018 Status </th><td> {{ $cotacao->a018_status }} </td></tr><tr><th> Criado Em </th><td> {{ $cotacao->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $cotacao->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $cotacao->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $cotacao->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
