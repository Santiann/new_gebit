
@php
    $page_title = "Perfil";
    $page_description = "Detalhe #". $role->id;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

    <div class="box">
        <div class="box-footer ">
            <a href="{{ url('/role')}}" class="btn btn-default">
                <i class="fa fa-ban"></i> Cancelar
            </a>

        </div>
        <div class="container">
            <div class="row">


                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">Perfil {{ $role->id }}</div>
                        <div class="card-body">



                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>ID</th><td>{{ $role->id }}</td>
                                        </tr>
                                        <tr><th> Name </th><td> {{ $role->name }} </td></tr><tr><th> Display Name </th><td> {{ $role->display_name }} </td></tr><tr><th> Description </th><td> {{ $role->description }} </td></tr><tr><th> A005 Id Empresa </th><td> {{ $role->a005_id_empresa }} </td></tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop


@push('css')

@endpush
@push('js')

@endpush
