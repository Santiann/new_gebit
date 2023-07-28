@php
    $page_title = "Notificacao";
    $page_description = "Detalhe #". $notificacao->a996_id_notificacao;
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
        <li><a href="{{ url('/notificacao')}}">{{ $page_title ?? "Page Title" }}</a></li>
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
            <a href="{{ url('/notificacao') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('notificacao-edit')
            <a href="{{ url('/notificacao/' . $notificacao->a996_id_notificacao . '/edit') }}" title="Edit Notificacao"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('notificacao-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['notificacao', $notificacao->a996_id_notificacao],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir Notificacao',
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
                    <td>{{ $notificacao->a996_id_notificacao }}</td>
                </tr>
                <tr><th> A001 Id Usuario </th><td> {{ $notificacao->a001_id_usuario }} </td></tr><tr><th> A996 Assunto </th><td> {{ $notificacao->a996_assunto }} </td></tr><tr><th> A996 Conteudo </th><td> {{ $notificacao->a996_conteudo }} </td></tr><tr><th> A996 Ind Lido </th><td> {{ $notificacao->a996_ind_lido }} </td></tr><tr><th> Criado Em </th><td> {{ $notificacao->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $notificacao->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $notificacao->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $notificacao->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
