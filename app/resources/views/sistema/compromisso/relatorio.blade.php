@php
    $page_title = "Compromisso";
    $page_description = "Relatório";
@endphp


@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

    <div class="box">
        <div class="box-body">
            <div class="row" style="width: 100%;">
                <div class="col-md-12" style="padding: 0px;">
                    <div class="box" style="padding: 14px 0px;">
                        <div class="box-header with-border"  style="padding: 0px;">
                            <div class="box-title pull-left" style="font-size: 18px;padding-top: 7px;">Filtros</div>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool jBotaoFiltro" data-widget="collapse" style="padding: 0 10px;"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="col-md-12"  style="padding: 0px;">
                                <div class="row">
                                    <div class="col-md-4" style="{{ (count($comboEmpresa)??0) == 1 ? "display: none;" : "" }}">
                                        <div class="form-group {{ $errors->has('a005_id_empresa') ? 'has-error' : ''}}">
                                            {!! Form::label('a005_id_empresa', 'Empresa', ['class' => 'control-label']) !!}
                                            {!! Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control jmultipleselect2','id'=>'a005_id_empresa', '' => '','autocomplete' => 'off','multiple'=>'multiple'))!!}
                                            {!! $errors->first('a005_id_empresa', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a005_id_empresa_for') ? 'has-error' : ''}}">
                                            {!! Form::label('a005_id_empresa_for', 'Cliente/Fornecedor', ['class' => 'control-label']) !!}
                                            {!! Form::select('a005_id_empresa_for',$comboEmpresaFor,null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa_for', '' => '','autocomplete' => 'off','multiple'=>'multiple'))!!}
                                            {!! $errors->first('a005_id_empresa_for', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a022_classificacao') ? 'has-error' : ''}}">
                                            {!! Form::label('a022_classificacao', 'Classificação', ['class' => 'control-label']) !!}
                                            {!! Form::select('a022_classificacao',$comboClassificacao,null,array('class' => 'form-control select2 ','id'=>'a022_classificacao', '' => '','autocomplete' => 'off'))!!}
                                            {!! $errors->first('a005_id_empresa_for', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a022_data_vencimento_de') ? 'has-error' : ''}}">
                                            {!! Form::label('a022_data_vencimento_de', 'Vencimento de', ['class' => 'control-label']) !!}
                                            {!! Form::text('a022_data_vencimento_de', null, ['class' => 'form-control dataCalendario dataMask','autocomplete' => 'off', 'required' => 'required']) !!}
                                            {!! $errors->first('a022_data_vencimento_de', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a022_data_vencimento_ate') ? 'has-error' : ''}}">
                                            {!! Form::label('a022_data_vencimento_ate', 'Vencimento até', ['class' => 'control-label']) !!}
                                            {!! Form::text('a022_data_vencimento_ate', null, ['class' => 'form-control dataCalendario dataMask','autocomplete' => 'off', 'required' => 'required']) !!}
                                            {!! $errors->first('a022_data_vencimento_ate', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a022_valor_pagar_de') ? 'has-error' : ''}}">
                                            {!! Form::label('a022_valor_pagar_de', 'Valor a pagar de', ['class' => 'control-label']) !!}
                                            {!! Form::text('a022_valor_pagar_de', null, ['class' => 'form-control moneyMaskCuston','id'=>'a022_valor_pagar_de','autocomplete' => 'off', '' => '']) !!}
                                            {!! $errors->first('a022_valor_pagar_de', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a022_valor_pagar_ate') ? 'has-error' : ''}}">
                                            {!! Form::label('a022_valor_pagar_ate', 'Valor a pagar até', ['class' => 'control-label']) !!}
                                            {!! Form::text('a022_valor_pagar_ate', null, ['class' => 'form-control moneyMaskCuston','id'=>'a022_valor_pagar_ate','autocomplete' => 'off', '' => '']) !!}
                                            {!! $errors->first('a022_valor_pagar_ate', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a022_valor_pago_de') ? 'has-error' : ''}}">
                                            {!! Form::label('a022_valor_pago_de', 'Valor pago de', ['class' => 'control-label']) !!}
                                            {!! Form::text('a022_valor_pago_de', null, ['class' => 'form-control moneyMaskCuston','id'=>'a022_valor_pago_de','autocomplete' => 'off', '' => '']) !!}
                                            {!! $errors->first('a022_valor_pago_de', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a022_valor_pago_ate') ? 'has-error' : ''}}">
                                            {!! Form::label('a022_valor_pago_ate', 'Valor pago até', ['class' => 'control-label']) !!}
                                            {!! Form::text('a022_valor_pago_ate', null, ['class' => 'form-control moneyMaskCuston','id'=>'a022_valor_pago_ate','autocomplete' => 'off', '' => '']) !!}
                                            {!! $errors->first('a022_valor_pago_ate', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-success pull-right" onclick="pesquisarRelatorio()">
                                <i class="fa fa-search "></i> Pesquisar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="width: 100%">
                <table class="table table-striped table-bordered table-hover" width="100%" id="datatable_relatorio">
                    <thead>
                        <th>Empresa</th>
                        <th>Código Compromisso</th>
                        <th>Contrato</th>
                        <th>Classificação</th>
                        <th>Finalidade</th>
                        <th>Cliente Fornecedor</th>
                        <th>Data Vencimento</th>
                        <th>Valor a Pagar</th>
                        <th>Uso Vital</th>
                        <th>Data Pagamento</th>
                        <th>Valor Pago</th>
                        <th>Forma de Pagamento</th>
                        <th>Arquivos</th>
                        <th>Status</th>
                    </thead>

                </table>
            </div>
        </div>
    </div>

@stop


@push('css')
    <style>
        .dataTables_wrapper .dataTables_filter {
            visibility: hidden;
        }
    </style>

@endpush


@push('js')
<script>

    $(document).ready(function() {

        $('.jmultipleselect2').select2();
    });


    $(document).ready(function() {
        $('#datatable_relatorio').DataTable({
            responsive: true,
            "pageLength": 100,
             fixedHeader: {
               header: true,
               footer: false
            },
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ],
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
        });
    });


    $('#a005_id_empresa').change(function () {
        carregaOptionsEmpresa();
    });

    function carregaOptionsEmpresa() {
        var idEmpresa = $("#a005_id_empresa").val();

        $.ajax({
            url: '/carregaOptionsEmpresaCompromisso',
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {
                idEmpresa: idEmpresa,
            },
            success: function (response) {

                $('#a005_id_empresa_for').html('');
                $.each(response.comboEmpresaFor, function (key, value) {
                    if (key == "") {
                        $('#a005_id_empresa_for').prepend($("<option></option>").attr("value", key).text(value));
                    }
                    else {
                        $('#a005_id_empresa_for').append($("<option></option>").attr("value", key).text(value));
                    }
                    //$('#a005_id_empresa_for').val($("#a005_id_empresa_for option:first").val());
                });
            },
            error: function () {

            }
        });
    }

    function pesquisarRelatorio()
    {
        var a005_id_empresa = $("#a005_id_empresa").val();

        if(a005_id_empresa == "")
        {
            $.alert("Seleciona uma empresa!");
            return;
        }

        var a005_id_empresa_for = $("#a005_id_empresa_for").val();
        var a022_classificacao = $("#a022_classificacao").val();

        var a022_data_vencimento_de = $("#a022_data_vencimento_de").val();
        var a022_data_vencimento_ate = $("#a022_data_vencimento_ate").val();

        var a022_data_pagamento_de = $("#a022_data_pagamento_de").val();
        var a022_data_pagamento_ate = $("#a022_data_pagamento_ate").val();
        var a022_valor_pago_de = $("#a022_valor_pago_de").val();
        var a022_valor_pago_ate = $("#a022_valor_pago_ate").val();


        $('#datatable_relatorio').DataTable().destroy();
        $('#datatable_relatorio').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            "pageLength": 100,
            fixedHeader: {
                header: true,
                footer: false
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: { orthogonal: 'export' }
                },
            ],
            "ajax": {
                "url": "{!! route('compromisso_relatorio.data') !!}",
                "data": {
                    "a005_id_empresa": a005_id_empresa,
                    "a005_id_empresa_for": a005_id_empresa_for,
                    "a022_classificacao": a022_classificacao,
                    "a022_data_vencimento_de": a022_data_vencimento_de,
                    "a022_data_vencimento_ate": a022_data_vencimento_ate,
                    "a022_data_pagamento_de": a022_data_pagamento_de,
                    "a022_data_pagamento_ate": a022_data_pagamento_ate,
                    "a022_valor_pago_de": a022_valor_pago_de,
                    "a022_valor_pago_ate": a022_valor_pago_ate,
                }
            },
            columns: [
                { data: 'nomeEmpresa', name: 'nomeEmpresa', visible: JSON.parse("{{ (count($comboEmpresa)??0) == 1 ?'false' : 'true' }}") },
                { data: 'a022_id_compromisso', name: 'a022_id_compromisso' },
                { data: 'a013_numero_contrato', name: 'a013_numero_contrato' },
                { data: 'classificacao', name: 'classificacao' },
                { data: 'a022_finalidade', name: 'a022_finalidade' },
                { data: 'nomeCliFor', name: 'nomeCliFor' },
                { data: 'a022_data_vencimento', name: 'a022_data_vencimento' },
                { data: 'a022_valor_pagar', name: 'a022_valor_pagar' , render: function (data, type, row) {
                        return type === 'export' ?
                            data.replace( /[$.]/g, '' ).replace(",",".") :
                            data;
                    }},
                { data: 'a022_uso_vital', name: 'a022_uso_vital' },
                { data: 'a022_data_pagamento', name: 'a022_data_pagamento' },
                { data: 'a022_valor_pago', name: 'a022_valor_pago', render: function (data, type, row) {
                        return type === 'export' ?
                            data.replace( /[$.]/g, '' ).replace(",",".") :
                            data;
                    }},
                //{ data: 'a022_valor_pago', name: 'a022_valor_pago' },
                //{ data: 'a022_valor_pago', name: 'a022_valor_pago' , render: $.fn.dataTable.render.number('.', ',', 2, '{!! Config::get('app.moeda') !!}')},
                { data: 'a022_forma_pagamento', name: 'a022_forma_pagamento', render: $.fn.dataTable.render.text() },
                { data: 'arquivos', name: 'arquivos' },
                { data: 'a022_status', name: 'a022_status' },
            ],
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
            ,responsive: {
                details: {
                    renderer: function ( api, rowIdx ) {
                        // Select hidden columns for the given row
                        var data = api.cells( rowIdx, ':hidden' ).eq(0).map( function ( cell ) {
                            var header = $( api.column( cell.column ).header() );

                            var dados = api.cell( cell ).data();
                            if(dados != null) {
                                var split = api.cell(cell).data().split(',');
                                //split.length
                                dados = "";
                                $.each(split, function (key, value) {
                                    dados += value + "<BR>";
                                });
                            }
                            var html = '<tr>'+'<td>'+header.text()+':'+'</td> '+
                                '<td>'+ dados + '</td>'+'</tr>';

                            return html
                        } ).toArray().join('');

                        return data ?
                            $('<table/>').append( data ) :
                            false;
                    }
                }
            }
        });

        $(".jBotaoFiltro").click();

    }

</script>
@endpush
