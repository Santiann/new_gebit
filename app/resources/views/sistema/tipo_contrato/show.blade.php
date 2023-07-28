@php
    $page_title = "Tipo_contrato";
    $page_description = "Detalhe #". $tipo_contrato->a010_id_tipo_contrato;
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
        <li><a href="{{ url('/tipo_contrato')}}">{{ $page_title ?? "Page Title" }}</a></li>
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
            <a href="{{ url('/tipo_contrato') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('tipo_contrato-edit')
            <a href="{{ url('/tipo_contrato/' . $tipo_contrato->a010_id_tipo_contrato . '/edit') }}" title="Edit Tipo_contrato"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('tipo_contrato-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['tipo_contrato', $tipo_contrato->a010_id_tipo_contrato],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Tipo_contrato',
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
                    <td>{{ $tipo_contrato->a010_id_tipo_contrato }}</td>
                </tr>
                <tr><th> A005 Id Empresa </th><td> {{ $tipo_contrato->a005_id_empresa }} </td></tr><tr><th> A010 Descricao </th><td> {{ $tipo_contrato->a010_descricao }} </td></tr><tr><th> A010 Status </th><td> {{ $tipo_contrato->a010_status }} </td></tr><tr><th> Criado Em </th><td> {{ $tipo_contrato->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $tipo_contrato->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $tipo_contrato->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $tipo_contrato->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
