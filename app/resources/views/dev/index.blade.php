@php
    $page_title = "CRUD - Generator";
    $page_description = "Listagem";
@endphp


@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')
    <h1>{{$page_title}}</h1>
@stop


@section('content')
    <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
        <thead>
        <tr>
            <th width="15%">Database</th>
            <th>Tabela</th>
            <th width="10%">Códigos CRUD</th>
        </tr>
        </thead>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script>
        $(function() {
// OBTEM O TOKEN DO LARAVEL ===================================================
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('#datatable-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "pageLength": 100,
                ajax: {
                    url:'{!! route('devtables.data') !!}',
                    headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
                    dataType: 'JSON',
                    type: 'GET',
                    data: { _token: CSRF_TOKEN },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization');
                    },
                },
                columns: [
                    { data: 'TABLE_SCHEMA', name: 'TABLE_SCHEMA' },
                    { data: 'TABLE_NAME', name: 'TABLE_NAME' },
                    { data: 'action', name: 'action' }
                ],
                "oLanguage": { "sUrl": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" },
                "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
            });
        });
    </script>

@stop


