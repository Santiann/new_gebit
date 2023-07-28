@php
    $page_title = "Permissões/Menu";
    $page_description = "Detalhe #". $permission->id;
@endphp


@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $page_title ?? "Page Title" }}</h3>
        {{-- <span class="badge badge-info">@if ($count != 0) {!! $count !!} @endif</span> --}}
        <div class="box-tools">
            <a href="{{ url('/permissions') }}" title="Back"><button class="btn btn-default btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
            @permission('permissions-edit')
            <a href="{{ url('/permissions/' . $permission->id . '/edit') }}" title="Edit permission"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
            @endpermission
            @permission('permissions-delete')
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['permissions', $permission->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Excluir permission',
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
                    <td>{{ $permission->id }}</td>
                </tr>
                <tr><th> Name </th><td> {{ $permission->name }} </td></tr><tr><th> Display Name </th><td> {{ $permission->display_name }} </td></tr><tr><th> Description </th><td> {{ $permission->description }} </td></tr><tr><th> Tipo </th><td> {{ $permission->tipo }} </td></tr><tr><th> Url </th><td> {{ $permission->url }} </td></tr><tr><th> Idmodulo </th><td> {{ $permission->idmodulo }} </td></tr><tr><th> Idparent </th><td> {{ $permission->idparent }} </td></tr><tr><th> Ordem </th><td> {{ $permission->ordem }} </td></tr><tr><th> Icone </th><td> {{ $permission->icone }} </td></tr><tr><th> Criado Em </th><td> {{ $permission->created_at }} </td></tr><tr><th> Criado Por </th><td> {{ $permission->created_at_user }} </td></tr><tr><th> Alterado Em </th><td> {{ $permission->updated_at }} </td></tr><tr><th> Alterado Por </th><td> {{ $permission->updated_at_user }} </td></tr>
            </tbody>
        </table>
    </div>
</div>


@stop


@push('css')

@endpush
@push('js')

@endpush

