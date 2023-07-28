@php
    $page_title = "Empresa";
    $page_description = "Detalhe #". $empresa->a005_id_empresa;
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
        <li><a href="{{ url('/empresa')}}">{{ $page_title ?? "Page Title" }}</a></li>
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
            <a href="{{ url('/empresa') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('empresa-edit')
            <a href="{{ url('/empresa/' . $empresa->a005_id_empresa . '/edit') }}" title="Edit Empresa"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('empresa-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['empresa', $empresa->a005_id_empresa],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Empresa',
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
                    <td>{{ $empresa->a005_id_empresa }}</td>
                </tr>
                <tr><th> A005 Tipo Cliente </th><td> {{ $empresa->a005_tipo_cliente }} </td></tr><tr><th> A005 Logo </th><td> {{ $empresa->a005_logo }} </td></tr><tr><th> A005 Tipo Empresa </th><td> {{ $empresa->a005_tipo_empresa }} </td></tr><tr><th> A005 Id Empresa Matriz </th><td> {{ $empresa->a005_id_empresa_matriz }} </td></tr><tr><th> A005 Ind Estrangeiro </th><td> {{ $empresa->a005_ind_estrangeiro }} </td></tr><tr><th> A005 Cod Identificacao </th><td> {{ $empresa->a005_cod_identificacao }} </td></tr><tr><th> A005 Ind Cliente </th><td> {{ $empresa->a005_ind_cliente }} </td></tr><tr><th> A005 Ind Fornecedor </th><td> {{ $empresa->a005_ind_fornecedor }} </td></tr><tr><th> A005 Cpf </th><td> {{ $empresa->a005_cpf }} </td></tr><tr><th> A005 Nome Completo </th><td> {{ $empresa->a005_nome_completo }} </td></tr><tr><th> A005 Cnpj </th><td> {{ $empresa->a005_cnpj }} </td></tr><tr><th> A005 Razao Social </th><td> {{ $empresa->a005_razao_social }} </td></tr><tr><th> A005 Nome Fantasia </th><td> {{ $empresa->a005_nome_fantasia }} </td></tr><tr><th> A005 Ie </th><td> {{ $empresa->a005_ie }} </td></tr><tr><th> A005 Im </th><td> {{ $empresa->a005_im }} </td></tr><tr><th> A005 Fone </th><td> {{ $empresa->a005_fone }} </td></tr><tr><th> A005 Email </th><td> {{ $empresa->a005_email }} </td></tr><tr><th> A005 Cep </th><td> {{ $empresa->a005_cep }} </td></tr><tr><th> A047 Id Cidade </th><td> {{ $empresa->a047_id_cidade }} </td></tr><tr><th> A005 Endereco </th><td> {{ $empresa->a005_endereco }} </td></tr><tr><th> A005 Bairro </th><td> {{ $empresa->a005_bairro }} </td></tr><tr><th> A005 Numero End </th><td> {{ $empresa->a005_numero_end }} </td></tr><tr><th> A005 Complemento End </th><td> {{ $empresa->a005_complemento_end }} </td></tr><tr><th> A005 Status </th><td> {{ $empresa->a005_status }} </td></tr><tr><th> Criado Em </th><td> {{ $empresa->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $empresa->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $empresa->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $empresa->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
