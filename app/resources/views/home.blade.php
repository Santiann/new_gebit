{{-- resources/views/admin/dashboard.blade.php --}}
@php
    $page_title = "";
    $page_description = ".";
@endphp
@extends('adminlte::page')

@section('title', '>>Dealix')

{{-- @section('content_header')
    <h1>Dealix</h1>
@stop --}}

@section('content')

    <div class="page-home mx-auto">
        <div class="row line-search">
            <div class="col-12 col-lg-9 col-search">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Faça a sua busca">
                </div>
            </div>
            <div class="col-12 col-lg-3 col-criarauditoria">
                <button class="btn btn-default btn-block btn-criar"><i class="fas fa-plus-circle"></i> Criar Auditoria</button>
            </div>
        </div>

        <div class="row align-items-center line-button">
            <div class="col-4 text-center">
                <a class="btn btn-block btn-home rounded-circle mx-auto" href="">
                    <i class="icon fas fa-calculator"></i>
                    <span class="txt-button">Cotações</span>
                </a>
            </div>
            <div class="col-4 text-center">
                <a class="btn btn-block btn-home rounded-circle mx-auto" href="">
                    <i class="icon fas fa-hand-holding-usd"></i>
                    <span class="txt-button">Comissões</span>
                </a>
            </div>
            <div class="col-4 text-center">
                <a class="btn btn-block btn-home rounded-circle mx-auto" href="">
                    <i class="icon far fa-calendar-alt"></i>
                    <span class="txt-button">Mensalidade</span>
                </a>
            </div>
        </div>
    </div>

@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@section('js')

@stop
