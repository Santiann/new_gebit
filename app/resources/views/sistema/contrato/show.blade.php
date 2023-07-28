@php
    $page_title = "Contrato";
    $page_description = "Detalhe #". $contrato->a013_id_contrato;
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
        <li><a href="{{ url('/contrato')}}">{{ $page_title ?? "Page Title" }}</a></li>
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
            <a href="{{ url('/contrato') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('contrato-edit')
            <a href="{{ url('/contrato/' . $contrato->a013_id_contrato . '/edit') }}" title="Edit Contrato"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('contrato-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['contrato', $contrato->a013_id_contrato],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Contrato',
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
                    <td>{{ $contrato->a013_id_contrato }}</td>
                </tr>
                <tr><th> A005 Id Empresa </th><td> {{ $contrato->a005_id_empresa }} </td></tr><tr><th> A005 Id Empresa Cli For </th><td> {{ $contrato->a005_id_empresa_cli_for }} </td></tr><tr><th> A008 Id Cat Contrato </th><td> {{ $contrato->a008_id_cat_contrato }} </td></tr><tr><th> A010 Id Tipo Contrato </th><td> {{ $contrato->a010_id_tipo_contrato }} </td></tr><tr><th> A011 Id Area </th><td> {{ $contrato->a011_id_area }} </td></tr><tr><th> A013 Numero Contrato </th><td> {{ $contrato->a013_numero_contrato }} </td></tr><tr><th> A013 Classificacao </th><td> {{ $contrato->a013_classificacao }} </td></tr><tr><th> A013 Finalidade </th><td> {{ $contrato->a013_finalidade }} </td></tr><tr><th> A013 Prazo Contrato </th><td> {{ $contrato->a013_prazo_contrato }} </td></tr><tr><th> A013 Data Inicio </th><td> {{ $contrato->a013_data_inicio }} </td></tr><tr><th> A013 Data Fim </th><td> {{ $contrato->a013_data_fim }} </td></tr><tr><th> A013 Dias Vencimento </th><td> {{ $contrato->a013_dias_vencimento }} </td></tr><tr><th> A013 Valor Total Contrato </th><td> {{ $contrato->a013_valor_total_contrato }} </td></tr><tr><th> A013 Valor Extra </th><td> {{ $contrato->a013_valor_extra }} </td></tr><tr><th> A013 Valor Comissao </th><td> {{ $contrato->a013_valor_comissao }} </td></tr><tr><th> A013 Periodicidade Reajuste </th><td> {{ $contrato->a013_periodicidade_reajuste }} </td></tr><tr><th> A013 Indice Reajuste </th><td> {{ $contrato->a013_indice_reajuste }} </td></tr><tr><th> A013 Prazo Recisao </th><td> {{ $contrato->a013_prazo_recisao }} </td></tr><tr><th> A013 Custo Recisao Antecipada </th><td> {{ $contrato->a013_custo_recisao_antecipada }} </td></tr><tr><th> A013 Obs Custo Revisao Antec </th><td> {{ $contrato->a013_obs_custo_revisao_antec }} </td></tr><tr><th> A013 Conta Contabil </th><td> {{ $contrato->a013_conta_contabil }} </td></tr><tr><th> A013 Centro Custo </th><td> {{ $contrato->a013_centro_custo }} </td></tr><tr><th> A001 Id Usuario </th><td> {{ $contrato->a001_id_usuario }} </td></tr><tr><th> A013 Obs Contrato </th><td> {{ $contrato->a013_obs_contrato }} </td></tr><tr><th> A013 Assinatura </th><td> {{ $contrato->a013_assinatura }} </td></tr><tr><th> A013 Status </th><td> {{ $contrato->a013_status }} </td></tr><tr><th> Criado Em </th><td> {{ $contrato->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $contrato->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $contrato->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $contrato->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
