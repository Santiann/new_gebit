@php
    $page_title = "Perfil de Acesso";
    $page_description = "Editar #". $role->id;
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

    <div class="box">

        {!! Form::model($role, [
            'method' => 'PATCH',
            'url' => ['/role', $role->id],
            'class' => 'form form-role EspacoTopo','data-toggle' => 'validator',
            'files' => true
        ]) !!}

        @include ('sistema.role.form', ['submitButtonText' => 'Salvar'])

        {!! Form::close() !!}
    </div>

@stop


@push('css')

@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var indDesativaAlter = 0
            indDesativaAlter += $("#ind_super_adm").val();
            indDesativaAlter += $("#ind_adm").val();
            indDesativaAlter += $("#ind_cliente").val();
            indDesativaAlter += $("#ind_fornecedor").val();

            if(indDesativaAlter>0)
            {
                $("#name").prop("readonly","readonly");
                $("#description").prop("readonly","readonly");
                $("#a005_id_empresa").prop("readonly","readonly");
                $("#a005_id_empresa").prop("required","");
                $(".jPerfilAdm").hide();


                $(".jPerfilAdmMostra").removeClass('col-md-3').removeClass('col-md-4').addClass('col-md-6');

            }

        });

        $("#status").click(function( value){
            if($("#status:checked").length<=0){
                $.alert("Usuários Ligados a esse Perfil não terão os acessos contido nesse Perfil");
            }
        });



    </script>
@endpush

