@php
    $page_title = "Categoria_contrato";
    $page_description = "Detalhe #". $categoria_contrato->a008_id_cat_contrato;
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
        <li><a href="{{ url('/categoria_contrato')}}">{{ $page_title ?? "Page Title" }}</a></li>
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
            <a href="{{ url('/categoria_contrato') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('categoria_contrato-edit')
            <a href="{{ url('/categoria_contrato/' . $categoria_contrato->a008_id_cat_contrato . '/edit') }}" title="Edit Categoria_contrato"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('categoria_contrato-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['categoria_contrato', $categoria_contrato->a008_id_cat_contrato],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Categoria_contrato',
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
                    <td>{{ $categoria_contrato->a008_id_cat_contrato }}</td>
                </tr>
                <tr><th> A005 Id Empresa </th><td> {{ $categoria_contrato->a005_id_empresa }} </td></tr><tr><th> A008 Descricao </th><td> {{ $categoria_contrato->a008_descricao }} </td></tr><tr><th> A008 Termo Cancelamento </th><td> {{ $categoria_contrato->a008_termo_cancelamento }} </td></tr><tr><th> A008 Status </th><td> {{ $categoria_contrato->a008_status }} </td></tr><tr><th> Criado Em </th><td> {{ $categoria_contrato->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $categoria_contrato->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $categoria_contrato->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $categoria_contrato->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
