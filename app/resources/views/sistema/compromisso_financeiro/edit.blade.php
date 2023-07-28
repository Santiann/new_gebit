@php
    $page_title = "Compromisso financeiro";
    $page_description = "Editar #". $compromisso->a022_id_compromisso;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

<div class="box">

    {!! Form::model($compromisso, [
        'method' => 'PATCH',
        'url' => ['/compromisso_financeiro', $compromisso->a022_id_compromisso],
        'class' => 'form form-compromisso EspacoTopo',
        'data-toggle' => 'validator',
        'files' => true
    ]) !!}

    @include ('sistema.compromisso_financeiro.form', ['submitButtonText' => 'Salvar'])

    {!! Form::close() !!}
</div>

@stop

@push('css')

@endpush

@push('js')
<script>
    if(($(".jclassclassificacao").attr('class').indexOf("col-md-3"))>=0)
        $(".jclassclassificacao").removeClass("col-md-3").addClass("col-md-2");
    if(($(".jclassclassificacao").attr('class').indexOf("col-md-4"))>=0)
        $(".jclassclassificacao").removeClass("col-md-4").addClass("col-md-3");


    $(".jclasscodigo").show();





</script>
@endpush
