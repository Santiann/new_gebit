@php
    $page_title = "Parametro";
    $page_description = "Detalhe #". $parametro->a000_id_parametro;
@endphp

@extends('layouts.app')

@section('page-bar')
<!-- BEGIN PAGE BAR -->
<section class="content-header">
    <h1>
        {{ $page_title ?? "Page Title" }}
        <!--<small>{{ $page_description ?? null }}</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/parametro')}}">{{ $page_title ?? "Page Title" }}</a></li>
        <li class="active">{{ $page_description ?? "Detalhe" }}</li>
    </ol>
</section>
<!-- END PAGE BAR -->
@stop

@section('page-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $page_title ?? "Page Title" }}</h3>
        {{-- <span class="badge badge-info">@if ($count != 0) {!! $count !!} @endif</span> --}}
        <div class="box-tools">
            <a href="{{ url('/parametro') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('parametro-edit')
            <a href="{{ url('/parametro/' . $parametro->a000_id_parametro . '/edit') }}" title="Edit Parametro"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('parametro-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['parametro', $parametro->a000_id_parametro],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Parametro',
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
                    <td>{{ $parametro->a000_id_parametro }}</td>
                </tr>
                <tr><th> A000 Sigla </th><td> {{ $parametro->a000_sigla }} </td></tr><tr><th> A000 Nome </th><td> {{ $parametro->a000_nome }} </td></tr><tr><th> A000 Descricao </th><td> {{ $parametro->a000_descricao }} </td></tr><tr><th> S000 Valor </th><td> {{ $parametro->s000_valor }} </td></tr><tr><th> A000 Status </th><td> {{ $parametro->a000_status }} </td></tr><tr><th> Criado Em </th><td> {{ $parametro->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $parametro->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $parametro->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $parametro->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
