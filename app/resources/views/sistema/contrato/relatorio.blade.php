@php
    $page_title = "Contrato";
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
                                    <div class="col-md-2">
                                        <div class="form-group " >
                                            <div style="margin-top: 7px;">
                                                <label class="control-label">{!! Form::checkbox('a005_ind_cliente', 1, false, ['id' => 'a005_ind_cliente','class'=>'control-label','autocomplete' => 'off']) !!} Cliente</label>&ensp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group " >
                                            <div style="margin-top: 7px;">
                                                <label class="control-label">{!! Form::checkbox('a005_ind_fornecedor', 1, false, ['id' => 'a005_ind_fornecedor','class'=>'control-label','autocomplete' => 'off']) !!} Fornecedor</label>&ensp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group " >
                                            <div style="margin-top: 7px;">
                                                <label class="control-label">{!! Form::checkbox('a005_ind_estrangeiro', 1, false, ['id' => 'a005_ind_estrangeiro','class'=>'control-label','autocomplete' => 'off']) !!} Estrangeiro</label>&ensp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group " >
                                            <div style="margin-top: 7px;">
                                                <label class="control-label">{!! Form::checkbox('a013_assinatura', 1,  false, ['id' => 'a013_assinatura','class'=>'control-label','autocomplete' => 'off']) !!} Contrato Assinado</label>&ensp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">



                                    <div class="col-md-4" style="{{ (count($comboEmpresa)??0) == 1 ? "display: none;" : "" }}">
                                        <div class="form-group {{ $errors->has('a005_id_empresa') ? 'has-error' : ''}}">
                                            {!! Form::label('a005_id_empresa', 'Empresa', ['class' => 'control-label']) !!}
                                            {!! Form::select('a005_id_empresa[]',$comboEmpresa,null,array('class' => 'form-control jmultipleselect2 ','id'=>'a005_id_empresa', '' => '','autocomplete' => 'off','multiple'=>'multiple'))!!}
                                            {!! $errors->first('a005_id_empresa', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a005_id_empresa_cli') ? 'has-error' : ''}}">
                                            {!! Form::label('a005_id_empresa_cli', 'Cliente', ['class' => 'control-label']) !!}
                                            {!! Form::select('a005_id_empresa_cli',$comboEmpresaClie,null,array('class' => 'form-control jmultipleselect2 ','id'=>'a005_id_empresa_cli', '' => '','autocomplete' => 'off','multiple'=>'multiple'))!!}
                                            {!! $errors->first('a005_id_empresa_cli', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a005_id_empresa_for') ? 'has-error' : ''}}">
                                            {!! Form::label('a005_id_empresa_for', 'Fornecedor', ['class' => 'control-label']) !!}
                                            {!! Form::select('a005_id_empresa_for',$comboEmpresaFor,null,array('class' => 'form-control jmultipleselect2 ','id'=>'a005_id_empresa_for', '' => '','autocomplete' => 'off','multiple'=>'multiple'))!!}
                                            {!! $errors->first('a005_id_empresa_for', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a013_numero_contrato') ? 'has-error' : ''}}">
                                            {!! Form::label('a013a013_numero_contrato', 'Número Contrato', ['class' => 'control-label']) !!}
                                            {!! Form::text('a013_numero_contrato', null, ['class' => 'form-control alfaNumericoMask20','id'=>'a013_numero_contrato','autocomplete' => 'off', '' => '']) !!}
                                            {!! $errors->first('a013_numero_contrato', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a010_id_tipo_contrato') ? 'has-error' : ''}}">
                                            {!! Form::label('a010_id_tipo_contrato', 'Tipo', ['class' => 'control-label']) !!}
                                            {!! Form::select('a010_id_tipo_contrato',$comboTipo_contrato,null,array('class' => 'form-control select2 ','id'=>'a010_id_tipo_contrato', 'autocomplete' => 'off'))!!}
                                            {!! $errors->first('a010_id_tipo_contrato', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a008_id_cat_contrato') ? 'has-error' : ''}}">
                                            {!! Form::label('a008_id_cat_contrato', 'Categoria', ['class' => 'control-label']) !!}
                                            {!! Form::select('a008_id_cat_contrato',$comboCategoria_contrato,0,array('class' => 'form-control jmultipleselect2 ','id'=>'a008_id_cat_contrato', 'autocomplete' => 'off','multiple'=>'multiple'))!!}
                                            {!! $errors->first('a008_id_cat_contrato', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a011_id_area') ? 'has-error' : ''}}">
                                            {!! Form::label('a011_id_area', 'Área', ['class' => 'control-label']) !!}
                                            {!! Form::select('a011_id_area',$comboArea_contrato,0,array('class' => 'form-control jmultipleselect2','id'=>'a011_id_area', '' => '','autocomplete' => 'off','multiple'=>'multiple'))!!}
                                            {!! $errors->first('a011_id_area', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a013_valor_total_contrato') ? 'has-error' : ''}}">
                                            {!! Form::label('a013_valor_total_contrato', 'Valor de', ['class' => 'control-label']) !!}
                                            {!! Form::text('a013_valor_total_contrato_de', null, ['class' => 'form-control moneyMaskCuston','id'=>'a013_valor_total_contrato_de','autocomplete' => 'off', '' => '']) !!}
                                            {!! $errors->first('a013_valor_total_contrato', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a013_valor_total_contrato') ? 'has-error' : ''}}">
                                            {!! Form::label('a013_valor_total_contrato', 'Valor até', ['class' => 'control-label']) !!}
                                            {!! Form::text('a013_valor_total_contrato_ate', null, ['class' => 'form-control moneyMaskCuston','id'=>'a013_valor_total_contrato_ate','autocomplete' => 'off', '' => '']) !!}
                                            {!! $errors->first('a013_valor_total_contrato', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a013_status') ? 'has-error' : ''}}">
                                            {!! Form::label('a013_status', 'Status', ['class' => 'control-label']) !!}
                                            {!! Form::select('a013_status',$comboStatus,null,array('class' => 'form-control select2 ','id'=>'a013_status', '' => '','autocomplete' => 'off'))!!}
                                            {!! $errors->first('a013_status', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a013_data_inicio') ? 'has-error' : ''}}">
                                            {!! Form::label('a013_data_inicio', 'Data Início', ['class' => 'control-label']) !!}
                                            {!! Form::text('a013_data_inicio', null, ['class' => 'form-control dataCalendario dataMask','autocomplete' => 'off', 'required' => 'required']) !!}
                                            {!! $errors->first('a013_data_inicio', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('a013_data_fim') ? 'has-error' : ''}}">
                                            {!! Form::label('a013_data_fim', 'Data Fim', ['class' => 'control-label']) !!}
                                            {!! Form::text('a013_data_fim', null, ['class' => 'form-control dataCalendario dataMask','autocomplete' => 'off', 'required' => 'required']) !!}
                                            {!! $errors->first('a013_data_fim', '<p class="help-block">:message</p>') !!}
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
                        <th>Número Contrato</th>
                        <th>Empresa</th>
                        <th>Cliente Fornecedor</th>
                        <th>Início Fim</th>
                        <th>Valor</th>
                        <th>Valor fração</th>
                        <th>Comissão</th>
                        <th>Periodicidade de reajuste</th>
                        <th>Conta Contábil</th>
                        <th>Centro de Custo</th>
                        <th>Área</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Assinatura</th>
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

    /*
    *
    * */
    $(document).ready(function() {

        $('.jmultipleselect2').select2();
    });

    $(document).ready(function() {
        let datatable_relatorio = $('#datatable_relatorio').DataTable({
            responsive: true,
            "pageLength": 100,
             fixedHeader: {
               header: true,
               footer: false
            },
            dom: 'Bfrtip',
            buttons: [
                'excel',
                {
                    extend: 'colvis',
                    text: 'Colunas',
                }
            ],
            //ajax: '{!! route('contrato.data') !!}',
            columns: [
                { data: 'a013_numero_contrato', name: 'a013_numero_contrato' },
                { data: 'nomeEmpresa', name: 'nomeEmpresa', visible: JSON.parse("{{ (count($comboEmpresa)??0) == 1 ?'false' : 'true' }}") },
                { data: 'nomeCliFor', name: 'nomeCliFor' },
                { data: 'dataInicioFim', name: 'dataInicioFim' },
                { data: 'a013_valor_total_contrato', name: 'a013_valor_total_contrato' },
                { data: 'a013_valor_fracao', name: 'a013_valor_fracao' },
                { data: 'a013_valor_comissao', name: 'a013_valor_comissao' },
                { data: 'a013_periodicidade_reajuste', name: 'a013_periodicidade_reajuste' },
                { data: 'a013_conta_contabil', name: 'a013_conta_contabil', visible: false },
                { data: 'a013_centro_custo', name: 'a013_numero_contrato', visible: false },
                { data: 'area', name: 'area' },
                { data: 'categoria', name: 'categoria' },
                { data: 'a013_status', name: 'a013_status' },
                { data: 'a013_assinatura', name: 'a013_assinatura' },
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
            url: '/carregaOptionsEmpresa',
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {
                idEmpresa: idEmpresa,
            },
            success: function (response) {

                $('#a005_id_empresa_cli').html('');
                $('#a005_id_empresa_for').html('');
                $('#a008_id_cat_contrato').html('');
                $('#a010_id_tipo_contrato').html('');
                $('#a011_id_area').html('');
                $('#a001_id_usuario').html('');

                $.each(response.comboEmpresaClie, function (key, value) {
                    if (key == "") {
                        $('#a005_id_empresa_cli').prepend($("<option></option>").attr("value", key).text(value));
                    }
                    else {
                        $('#a005_id_empresa_cli').append($("<option></option>").attr("value", key).text(value));
                    }
                    //$('#a005_id_empresa_cli').val($("#a005_id_empresa_cli option:first").val());
                });

                $.each(response.comboEmpresaFor, function (key, value) {
                    if (key == "") {
                        $('#a005_id_empresa_for').prepend($("<option></option>").attr("value", key).text(value));
                    }
                    else {
                        $('#a005_id_empresa_for').append($("<option></option>").attr("value", key).text(value));
                    }
                    //$('#a005_id_empresa_for').val($("#a005_id_empresa_for option:first").val());
                });

                $.each(response.comboCategoria_contrato, function (key, value) {
                    if (key == "") {
                        $('#a008_id_cat_contrato').prepend($("<option></option>").attr("value", key).text(value));
                    }
                    else {
                        $('#a008_id_cat_contrato').append($("<option></option>").attr("value", key).text(value));
                    }
                    // $('#a008_id_cat_contrato').val($("#a008_id_cat_contrato option:first").val());
                });

                $.each(response.comboTipo_contrato, function (key, value) {
                    if (key == "") {
                        $('#a010_id_tipo_contrato').prepend($("<option></option>").attr("value", key).text(value));
                    }
                    else {
                        $('#a010_id_tipo_contrato').append($("<option></option>").attr("value", key).text(value));
                    }
                    // $('#a010_id_tipo_contrato').val($("#a010_id_tipo_contrato option:first").val());
                });

                $.each(response.comboArea_contrato, function (key, value) {
                    if (key == "") {
                        $('#a011_id_area').prepend($("<option></option>").attr("value", key).text(value));
                    }
                    else {
                        $('#a011_id_area').append($("<option></option>").attr("value", key).text(value));
                    }
                    // $('#a011_id_area').val($("#a011_id_area option:first").val());
                });

                $.each(response.comboResponsavel, function (key, value) {
                    if (key == "") {
                        $('#a001_id_usuario').prepend($("<option></option>").attr("value", key).text(value));
                    }
                    else {
                        $('#a001_id_usuario').append($("<option></option>").attr("value", key).text(value));
                    }
                    // $('#a001_id_usuario').val($("#a001_id_usuario option:first").val());
                    // $('#a001_id_usuario').val('{{Auth::user()->a001_id_usuario}}');
                });
            },
            error: function () {

            }
        });
    }

    function pesquisarRelatorio()
    {
        var a005_id_empresa = $("#a005_id_empresa").val();

        /*if(a005_id_empresa == "")
        {
            $.alert("Seleciona uma ou mais empresa!");
            return;
        }*/

        var a005_id_empresa_cli = $("#a005_id_empresa_cli").val();
        var a005_id_empresa_for = $("#a005_id_empresa_for").val();
        var a013_numero_contrato = $("#a013_numero_contrato").val();
        var a010_id_tipo_contrato = $("#a010_id_tipo_contrato").val();
        var a008_id_cat_contrato = $("#a008_id_cat_contrato").val();
        var a011_id_area = $("#a011_id_area").val();
        var a013_valor_total_contrato_de = $("#a013_valor_total_contrato_de").val();
        var a013_valor_total_contrato_ate = $("#a013_valor_total_contrato_ate").val();
        var a013_status = $("#a013_status").val();
        var a013_data_inicio = $("#a013_data_inicio").val();
        var a013_data_fim = $("#a013_data_fim").val();

        var a005_ind_cliente = $("#a005_ind_cliente:checked").length;
        var a005_ind_fornecedor = $("#a005_ind_fornecedor:checked").length;
        var a005_ind_estrangeiro = $("#a005_ind_estrangeiro:checked").length;
        var a013_assinatura = $("#a013_assinatura:checked").length;

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
                'excel',
                {
                    extend: 'colvis',
                    text: 'Colunas',
                }
            ],
            "ajax": {
                "url": "{!! route('contrato_relatorio.data') !!}",
                "data": {
                    "a005_id_empresa": a005_id_empresa,
                    "a005_id_empresa_cli": a005_id_empresa_cli,
                    "a005_id_empresa_for": a005_id_empresa_for,
                    "a013_numero_contrato": a013_numero_contrato,
                    "a010_id_tipo_contrato": a010_id_tipo_contrato,
                    "a008_id_cat_contrato": a008_id_cat_contrato,
                    "a011_id_area": a011_id_area,
                    "a013_valor_total_contrato_de": a013_valor_total_contrato_de,
                    "a013_valor_total_contrato_ate": a013_valor_total_contrato_ate,
                    "a013_status": a013_status,
                    "a013_data_inicio": a013_data_inicio,
                    "a013_data_fim": a013_data_fim,
                    "a005_ind_cliente":a005_ind_cliente,
                    "a005_ind_fornecedor":a005_ind_fornecedor,
                    "a005_ind_estrangeiro":a005_ind_estrangeiro,
                    "a013_ind_assinatura":a013_assinatura,
                }
            },
            columns: [
                { data: 'a013_numero_contrato', name: 'a013_numero_contrato' },
                { data: 'nomeEmpresa', name: 'nomeEmpresa', visible: JSON.parse("{{ (count($comboEmpresa)??0) == 1 ?'false' : 'true' }}") },
                { data: 'nomeCliFor', name: 'nomeCliFor' },
                { data: 'dataInicioFim', name: 'dataInicioFim' },
                { data: 'a013_valor_total_contrato', name: 'a013_valor_total_contrato' },
                { data: 'a013_valor_fracao', name: 'a013_valor_fracao' },
                { data: 'a013_valor_comissao', name: 'a013_valor_comissao' },
                { data: 'a013_periodicidade_reajuste', name: 'a013_periodicidade_reajuste' },
                { data: 'a013_conta_contabil', name: 'a013_conta_contabil', visible: false },
                { data: 'a013_centro_custo', name: 'a013_numero_contrato', visible: false },
                { data: 'area', name: 'area' },
                { data: 'categoria', name: 'categoria' },
                { data: 'a013_status', name: 'a013_status' },
                { data: 'a013_assinatura', name: 'a013_assinatura' },
            ],
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
        });

        $(".jBotaoFiltro").click();

    }

</script>
@endpush
