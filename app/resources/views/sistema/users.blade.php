
{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <title>Laravel DataTable - Tuts Make</title>

@stop

@section('content')


<div class="container">
    <h2>Laravel DataTable - Tuts Make</h2>
    <table class="table table-bordered" id="laravel_datatable">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Created at</th>
        </tr>
        </thead>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#laravel_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('users-list') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' }
                ]
            });
        });
    </script>
@stop
