
@php
    $page_title = "Dashboard";
    $page_description = ".";
    use App\Http\Controllers\DashboardController;
@endphp
@extends('adminlte::page')


{{-- @section('content_header')
    <h1>Dealix</h1>
@stop --}}

@section('content')

    <div class="page-home mx-auto">

        {!! DashboardController::IndicadorContrato() !!}


        <!-- {!! DashboardController::graficoCustoCategoriaContrato() !!}

        {!! DashboardController::graficoCustoTipoContrato() !!}

        {!! DashboardController::IndicadorCotacao() !!}

        {!! DashboardController::graficoCompromisso() !!} -->

    </div>

@stop

@section('css')

@stop

@push('js')

@endpush
