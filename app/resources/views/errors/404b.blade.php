@php
    $page_title = "";
    $page_description = "";
@endphp


@extends('adminlte::page')

@section('title', $page_title)


@section('content')

    <body class="bodyNot" cz-shortcut-listen="true">
    <div class="flex-center position-ref full-height">
        <div class="code">404</div>
        <div class="message" style="padding: 10px;">Not Found</div>
    </div>


    </body>
@stop

@push('css')
    <style>
        bodyNot {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 80vh;
            margin: 0;
        }

        .full-height {
            height: 80vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .code {
            border-right: 2px solid;
            font-size: 26px;
            padding: 0 15px 0 15px;
            text-align: center;
        }

        .message {
            font-size: 18px;
            text-align: center;
        }
    </style>

@endpush
