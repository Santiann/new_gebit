@php
    $page_title = "Area_contrato";
    $page_description = "Detalhe #". $area_contrato->a011_id_area;
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
        <li><a href="{{ url('/area_contrato')}}">{{ $page_title ?? "Page Title" }}</a></li>
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
            <a href="{{ url('/area_contrato') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('area_contrato-edit')
            <a href="{{ url('/area_contrato/' . $area_contrato->a011_id_area . '/edit') }}" title="Edit Area_contrato"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('area_contrato-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['area_contrato', $area_contrato->a011_id_area],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Area_contrato',
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
                    <td>{{ $area_contrato->a011_id_area }}</td>
                </tr>
                <tr><th> A005 Id Empresa </th><td> {{ $area_contrato->a005_id_empresa }} </td></tr><tr><th> A011 Descricao </th><td> {{ $area_contrato->a011_descricao }} </td></tr><tr><th> A011 Status </th><td> {{ $area_contrato->a011_status }} </td></tr><tr><th> Criado Em </th><td> {{ $area_contrato->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $area_contrato->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $area_contrato->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $area_contrato->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
