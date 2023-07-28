@php
    $page_title = "Permissões/Menu";
    $page_description = "Listagem";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>{!! Session::get('flash_message') !!}</strong>
        </div>
    @endif

<div class="box">
    <div class="box-header">
        <div class="box-tools">
            @permission('permissions-create')
                <a href="{{ url('/permissions/create') }}" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar {{ $page_title }}</a>
            @endpermission

        </div>
    </div>
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
            <thead>
                <th>Nome</th>
                <th>Ordem</th>
                <th>Nome Interno</th>
                <th>Url</th>
                <th width="120px">Ações</th>
            </thead>
        </table>

    </div>
</div>
@stop


@push('css')


@endpush

@push('js')


    <script>
        $(document).ready(function() {
            $('#datatable-table').DataTable({

                fixedHeader: {
                    header: true,
                    /*headerOffset: 83,*/
                    footer: false
                },

                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                processing: true,
                serverSide: true,
                responsive: true,

                "pageLength": 100,
                ajax: '{!! route('permissions.data') !!}',
                "order": [[1, "asc"]],
                columns: [
                    { data: 'display_name', name: 'display_name' , orderable: false},
                    { data: 'ordem', name: 'ordem' , orderable: true},
                    { data: 'name', name: 'name' , orderable: false},
                    { data: 'url', name: 'url', orderable: false},
                    { data: 'action', name: 'action', orderable: false, searchable: false  }
                ],
                "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
            });
        });
    </script>
@endpush
