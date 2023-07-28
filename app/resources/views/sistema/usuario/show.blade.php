@php
    $page_title = "Usuario";
    $page_description = "Detalhe #". $usuario->a001_id_usuario;
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
        <li><a href="{{ url('/usuario')}}">{{ $page_title ?? "Page Title" }}</a></li>
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
            <a href="{{ url('/usuario') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('usuario-edit')
            <a href="{{ url('/usuario/' . $usuario->a001_id_usuario . '/edit') }}" title="Edit Usuario"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('usuario-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['usuario', $usuario->a001_id_usuario],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Usuario',
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
                    <td>{{ $usuario->a001_id_usuario }}</td>
                </tr>
                <tr><th> A001 Nome </th><td> {{ $usuario->a001_nome }} </td></tr><tr><th> A001 Email </th><td> {{ $usuario->a001_email }} </td></tr><tr><th> A001 Status </th><td> {{ $usuario->a001_status }} </td></tr><tr><th> A001 Cpf </th><td> {{ $usuario->a001_cpf }} </td></tr><tr><th> A001 Telefone </th><td> {{ $usuario->a001_telefone }} </td></tr><tr><th> A001 Cargo </th><td> {{ $usuario->a001_cargo }} </td></tr><tr><th> A001 Cep </th><td> {{ $usuario->a001_cep }} </td></tr><tr><th> A001 Endereco </th><td> {{ $usuario->a001_endereco }} </td></tr><tr><th> A001 Numero End </th><td> {{ $usuario->a001_numero_end }} </td></tr><tr><th> A047 Id Cidade </th><td> {{ $usuario->a047_id_cidade }} </td></tr><tr><th> A001 Complemento </th><td> {{ $usuario->a001_complemento }} </td></tr><tr><th> A001 Bairro </th><td> {{ $usuario->a001_bairro }} </td></tr><tr><th> Criado Em </th><td> {{ $usuario->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $usuario->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $usuario->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $usuario->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
