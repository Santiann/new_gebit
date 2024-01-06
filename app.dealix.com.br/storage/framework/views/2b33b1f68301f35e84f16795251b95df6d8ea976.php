<div class="box-footer BotesFixoTopo">
    <a href="<?php echo e(url('/contrato')); ?>" class="btn btn-default">
        <i class="fa fa-ban"></i> Cancelar
    </a>

    <?php if(($showFornecedor ?? 0) == 1): ?>
        <span class="btn btn-default  pull-right">Não é possível alterar o Contrato</span>
    <?php else: ?>
        <?php if(($contrato->a013_status ?? 'A') != 'C'): ?>
            <button type="submit" class="btn bg-olive pull-right">
                <i class="fa fa-save"></i> <?php echo e(isset($submitButtonText) ? $submitButtonText : 'Salvar'); ?>

            </button>
        <?php else: ?>
            <span class="btn btn-default  pull-right">Contrato Cancelado, não é possível alterar</span>
        <?php endif; ?>
    <?php endif; ?>

</div>

<div class="box-body">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="tabs_hint">
            <li class="form_geral"><a class="active" href="#form_geral" data-toggle="tab">Geral</a></li>
            <!-- <li class="form_vencimento"><a href="#form_vencimento" data-toggle="tab">Vencimentos</a></li> -->
            <li class="form_documento"><a href="#form_documento" data-toggle="tab">Documentos</a></li>
            <?php if(isset($contrato)): ?>
                <li class="form_usuarios"><a href="#form_usuarios" data-toggle="tab">Usuários</a></li>
            <?php endif; ?>
            <?php if(($showFornecedor ?? 0) != 1): ?>
                <?php if(isset($contrato)): ?>
                    <li class="form_contatos"><a href="#form_contatos" data-toggle="tab">Contatos</a></li>
                    <li class="form_renovacao"><a href="#form_renovacao" data-toggle="tab">Anotações de Negociações</a></li>
                    <li class="form_pendencias"><a href="#form_pendencias" data-toggle="tab">Pendências</a></li>
                    <li class="form_financeiro"><a href="#form_financeiro" data-toggle="tab">Financeiro</a></li>
                <?php endif; ?>
                <li class="form_alteracao"><a href="#form_alteracao" data-toggle="tab">Histórico Alterações</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="tab-content">
        <?php echo $__env->make('sistema.contrato.modals.add_comentario_anotacao', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if(isset($isFornecedorOrAdmin) && $isFornecedorOrAdmin): ?>
            <?php echo $__env->make('sistema.contrato.modals.add_parcela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('sistema.contrato.modals.email_parcela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <div class="active tab-pane" id="form_geral"><?php echo $__env->make('sistema.contrato.formGeral', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
        <!-- <div class="tab-pane" id="form_vencimento"><?php echo $__env->make('sistema.contrato.formVencimento', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div> -->
        <div class="tab-pane" id="form_documento"><?php echo $__env->make('sistema.contrato.formDocumento', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
        <?php if(isset($contrato)): ?>
            <div class="tab-pane" id="form_usuarios"><?php echo $__env->make('sistema.contrato.formUsuarios', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
            <div class="tab-pane" id="form_contatos"><?php echo $__env->make('sistema.contrato.formContato', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
            <div class="tab-pane" id="form_renovacao"><?php echo $__env->make('sistema.contrato.formRenovacao', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>

            <!-- ================== FORM FINANCEIRO ================= -->
            <div class="tab-pane" id="form_financeiro">
                <div class="row mb-4">
                    <div class="FormSubtitulo">
                        <?php if(isset($isFornecedorOrAdmin) && $isFornecedorOrAdmin): ?>
                            <button type="button" data-toggle="modal" data-target="#addParcela"
                                class="button-modal nova-parcela btn bg-info">
                                <i class="fa fa-money"></i> Nova parcela
                            </button>

                            <button type="button" class="button-modal btn btn-sm bg-olive ml-2" data-toggle="modal"
                                data-target="#parcelaEmail">
                                <i class="fa fa-envelope-o"></i> Parcela via e-mail
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="box-body">
                    <?php if($financeiro ?? '' != ''): ?>
                        <table class="display responsive nowrap" style="width:100%" id="tableFinanceiro">
                            <thead>
                                <th></th>
                                <th>Data</th>
                                <th>Para a empresa</th>
                                <th>Valor do período</th>
                                <!-- <th>Recorrência</th> -->
                                <th>Comissão</th>
                                <th>Extra</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Doc</th>
                                <th class="text-center">Alterar</th>
                                <th class="text-center">Visualizado</th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $financeiro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="data-tr" data-id-financeiro="<?php echo e($value->a028_id_contrato_financeiro); ?>"
                                        data-justificativa-financeiro="<?php echo e($value->a028_justificativa); ?>"
                                        data-status-financeiro="<?php echo e($value->a028_status); ?>">
                                        <td class="details-control"></td>
                                        <?php
                                            $nome_empresa = $value->Empresa_belongsTo->a005_nome_fantasia ?? ($value->Empresa_belongsTo->a005_razao_social ?? $value->Empresa_belongsTo->a005_nome_completo);
                                        ?>
                                        <td><?php echo e(\Carbon\Carbon::parse($value->a028_data_cobranca)->format('d/m/Y')); ?></td>
                                        <td><?php echo e($nome_empresa); ?></td>
                                        <td><?php echo e($value->a028_valor_fracao); ?></td>
                                        <!-- <td><?php echo e($value->a028_recorrencia); ?></td> -->
                                        <td><?php echo e($value->a028_valor_comissao); ?></td>
                                        <td><?php echo e($value->a028_valor_extra); ?></td>
                                        <td class="text-center">
                                            <?php if(isset($value->a028_status)): ?>
                                                <?php if($value->a028_status == 0): ?>
                                                    <span class="badge badge-danger">Atrasado</span>
                                                <?php elseif($value->a028_status == 1): ?>
                                                    <span class="badge badge-success">Pago</span>
                                                <?php elseif($value->a028_status == 2): ?>
                                                    <span class="badge badge-warning">Aguardando</span>
                                                <?php elseif($value->a028_status == 3): ?>
                                                    <span class="badge badge-dark">Rejeitado</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">Pendente</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($value->a028_documento): ?>
                                                <a href="/<?php echo e($value->a028_documento); ?>" target="_blank">Baixar arquivo</a>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if(!$value->da_minha_empresa && $value->a028_status < 2): ?>
                                                <button type="button" onclick="confirmChangeStatusFinanceiro(1, this)"
                                                    class="btn btn-success">Pago</button>
                                                <button type="button" onclick="confirmChangeStatusFinanceiro(0, this)"
                                                    class="btn btn-danger">Atrasado</button>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="<?php echo e($value->visualizadores_email); ?>"
                                                class="glyphicon glyphicon-eye-open"></span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

            </div>
            <!-- ========================= END FORM FINANCEIRO ================= -->


            <!-- ================== FORM PENDENCIAS ================= -->
            <div class="tab-pane" id="form_pendencias">

                <div class="row">
                    <div class="FormSubtitulo">
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?php echo Form::label('nova_pendencia', 'Pendência:', ['class' => 'control-label']); ?>

                            <?php echo Form::text('nova_pendencia', null, ['class' => 'form-control', 'autocomplete' => 'off']); ?>

                        </div>
                        <div class="col-md-2 mt-5">
                            Para a empresa
                            <?php $emp =  isset($isFornecedorOrAdmin) && $isFornecedorOrAdmin ? $contrato->Empresa_belongsTo : $cli_for ?>
                            <b><?php echo e($emp->a005_razao_social ?? ($emp->a005_nome_fantasia ?? $emp->a005_nome_completo)); ?></b>
                        </div>
                        <div class="col-md-4 mt-2">
                            <br>
                            <button type="button" class="ml-2 button-modal btn bg-info" onclick="addPendencia()">
                                <i class="fa fa-pencil"></i> Adicionar pendência
                            </button>
                        </div>
                    </div>
                    <br>
                    <br>
                    <?php if($pendencias ?? '' != ''): ?>
                        <table class="display responsive nowrap" style="width:100%" id="tablePendencias">
                            <thead>
                                <th>Para a empresa</th>
                                <th>Pendência</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>Alterar status</th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pendencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="data-tr" data-id-pendencia="<?php echo e($value->a027_id_pendencia); ?>"
                                        data-aceite-pendencia="<?php echo e($value->a027_pendencia_aceite); ?>">
                                        <?php
                                            $nome_empresa = $value->Empresa_belongsTo->a005_nome_fantasia ?? ($value->Empresa_belongsTo->a005_razao_social ?? $value->Empresa_belongsTo->a005_nome_completo);
                                        ?>
                                        <td><?php echo e($nome_empresa); ?></td>
                                        <td><?php echo e($value->a027_pendencia); ?></td>
                                        <td><?php echo e($value->created_at); ?></td>
                                        <td>
                                            <?php if(isset($value->a027_pendencia_aceite)): ?>
                                                <?php if($value->a027_pendencia_aceite): ?>
                                                    <span class="badge badge-success">Aceito</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Rejeitado</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">Pendente</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(!$value->da_minha_empresa): ?>
                                                <button type="button" onclick="confirmChangeStatus(1, this)"
                                                    class="btn btn-success">Aceitar</button>
                                                <button type="button" onclick="confirmChangeStatus(0, this)"
                                                    class="btn btn-danger">Rejeitar</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

            </div>
            <!-- ========================= END FORM PENDENCIAS ================= -->
        <?php endif; ?>
        <div class="tab-pane" id="form_alteracao"><?php echo $__env->make('sistema.contrato.formAlteracao', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
    </div>
    <?php if($errors->any()): ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="callout callout-danger">
                    <ul class="">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function() {
            var tableRenovacaoContrato, tablePendencias, tableFinanceiro, id_anotacao_selecionada;

            $('.select2').select2({
                language: 'pt-BR'
            });

            if ($("#a013_periodicidade_reajuste").val() != "") {
                $("#a013_indice_reajuste").prop("required", true);
            } else {
                $("#a013_indice_reajuste").prop("required", false);
            }

            CarregaCategoriaDocumentos();
            verificaStatus();
            verificatermos();

            <?php if(isset($contrato)): ?>
                verificaPermissaoUsuario();
            <?php endif; ?>
            criaDataTableHistorico();
            criaDataTableUsuariosContrato();
            criaDataTablePendencias();
            criaDataTableFinanceiro();

            if ("<?php echo e($contrato->a013_assinatura ?? ''); ?>" != "") {
                $(".a013_assinatura").prop("required", false);
            }

            if ('<?php echo e($contrato->a013_id_contrato ?? 0); ?>' != '0') {
                $("#a013_data_inicio").prop('readonly', true).attr('tabIndex', '-1');
                $("#a013_prazo_contrato").prop('readonly', true).attr('tabIndex', '-1');
                $("#a013_data_fim").prop('readonly', true).attr('tabIndex', '-1');
                // $('.periodo').hide();

                $("#a013_data_renovacao").prop('readonly', false).removeAttr("tabIndex");;
            }

        });



        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href");
            if ((target == '#form_alteracao')) {
                $('#tableHistoricoContrato').DataTable().destroy();
                $('#tableRenovacaoContrato').DataTable().destroy();
                criaDataTableHistorico();
            } else {

            }
        });

        $(".a013_status").click(function() {
            verificaStatus();
        });

        $("#a013_aceita_termo").click(function() {
            verificatermos();
        });

        $('#a005_id_empresa').change(function() {
            carregaOptionsEmpresa();
        });
        $('#a008_id_cat_contrato').change(function() {
            CarregaCategoriaDocumentos();
        });
        /*$(".validaunico").blur(function () {
            validaCampoUnicoExistente(this);
        });*/

        $("#a013_periodicidade_reajuste").blur(function() {
            if ($(this).val() != "") {
                $("#a013_indice_reajuste").prop("required", true);
            } else {
                $("#a013_indice_reajuste").prop("required", false);
            }
        });


        $("#periodo").change(function() {
            if (this.value == "") {
                $('#valor_periodo').val(1);
                $('#valor_periodo').attr('readonly', true);
                $('#a013_data_fim').attr('readonly', false);
            } else {
                $('#valor_periodo').attr('readonly', false);
                $('#a013_data_fim').attr('readonly', true);
                let value = $("#a013_prazo_contrato").val();
                calculaDataFinal(this.value, value);
            }
        });


        $("#valor_periodo").blur(function() {
            let tipo = $('#periodo').val();
            calculaDataFinal(tipo, this);
        });
        // $("#valor_periodo").keyup(function () {
        //     let tipo = $('#periodo').val();
        //     calculaDataFinal(tipo, this);
        // });
        $("#valor_periodo").focusout(function() {
            let tipo = $('#periodo').val();
            calculaDataFinal(tipo, this);
        });


        $("#a013_data_renovacao").focusout(function() {
            let tipo = $('#periodo').val();
            calculaDataFinal(tipo, this);
        });
        $("#a013_data_inicio").focusout(function() {
            let tipo = $('#periodo').val();
            calculaDataFinal(tipo, this);
        });
        $("#a013_data_fim").focusout(function() {
            let tipo = $('#periodo').val();
            calculaDataFinal(tipo, this);
        });

        $('.dataCalendarioAcao').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            startDate: new Date(),
            autoclose: true,
        }).on('changeDate', function(obj) {
            calculaDataFinal('data', this)
        }).on('focus', function() {
            $('.datepicker').css("display", "none");
        })

        $('.dataMask').focusin(function() {
            $('.datepicker').css("display", "none");
        });


        function verificaPermissaoUsuario() {
            let permission = "<?php echo e(isset($permission_user) && $permission_user); ?>"

            if (!permission) {
                let elem = $('select, input, textarea, button, .btn')
                elem.attr('disabled', true)
                elem.attr('onclick', '')
            }
        }

        function carregaOptionsEmpresa() {
            var idEmpresa = $("#a005_id_empresa").val();

            $.ajax({
                url: '/new_gebit/app.dealix.com.br/appcarregaOptionsEmpresa',
                type: 'GET',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {
                    idEmpresa: idEmpresa,
                },
                success: function(response) {

                    //console.log(response);

                    $('#a005_id_empresa_cli_for').html('');
                    $('#a008_id_cat_contrato').html('');
                    $('#a010_id_tipo_contrato').html('');
                    $('#a011_id_area').html('');
                    $('#a001_id_usuario').html('');

                    $('#a012_id_tipo_vencimento_form').html('');


                    $.each(response.comboEmpresaClieFor, function(key, value) {
                        if (key == "") {
                            $('#a005_id_empresa_cli_for').prepend($("<option></option>").attr("value",
                                key).text(value));
                        } else {
                            $('#a005_id_empresa_cli_for').append($("<option></option>").attr("value",
                                key).text(value));
                        }
                        $('#a005_id_empresa_cli_for').val($("#a005_id_empresa_cli_for option:first")
                            .val());
                    });
                    $.each(response.comboCategoria_contrato, function(key, value) {
                        if (key == "") {
                            $('#a008_id_cat_contrato').prepend($("<option></option>").attr("value", key)
                                .text(value));
                        } else {
                            $('#a008_id_cat_contrato').append($("<option></option>").attr("value", key)
                                .text(value));
                        }
                        // $('#a008_id_cat_contrato').val($("#a008_id_cat_contrato option:first").val());
                    });
                    $.each(response.comboTipo_contrato, function(key, value) {
                        if (key == "") {
                            $('#a010_id_tipo_contrato').prepend($("<option></option>").attr("value",
                                key).text(value));
                        } else {
                            $('#a010_id_tipo_contrato').append($("<option></option>").attr("value", key)
                                .text(value));
                        }
                        $('#a010_id_tipo_contrato').val($("#a010_id_tipo_contrato option:first").val());
                    });
                    $.each(response.comboArea_contrato, function(key, value) {
                        if (key == "") {
                            $('#a011_id_area').prepend($("<option></option>").attr("value", key).text(
                                value));
                        } else {
                            $('#a011_id_area').append($("<option></option>").attr("value", key).text(
                                value));
                        }
                        $('#a011_id_area').val($("#a011_id_area option:first").val());
                    });


                    $.each(response.comboResponsavel, function(key, value) {
                        if (key == "") {
                            $('#a001_id_usuario').prepend($("<option></option>").attr("value", key)
                                .text(value));
                        } else {
                            $('#a001_id_usuario').append($("<option></option>").attr("value", key).text(
                                value));
                        }
                        // $('#a001_id_usuario').val($("#a001_id_usuario option:first").val());
                        $('#a001_id_usuario').val('<?php echo e(Auth::user()->a001_id_usuario); ?>');
                    });


                    $.each(response.comboTipo_vencimento, function(key, value) {
                        if (key == "") {
                            $('#a012_id_tipo_vencimento_form').prepend($("<option></option>").attr(
                                "value", key).text(value));
                        } else {
                            $('#a012_id_tipo_vencimento_form').append($("<option></option>").attr(
                                "value", key).text(value));
                        }
                        $('#a012_id_tipo_vencimento_form').val($(
                            "#a012_id_tipo_vencimento_form option:first").val());
                    });


                },
                error: function() {

                }
            });
        }

        function calculaDataFinal(tipo, campo) {
            if ($("#a013_data_inicio").val().length < 10) {
                return;
            }
            var dataInicio = new Date(formataData_BR_to_DB($("#a013_data_inicio").val()) + " 00:00");
            var valor_periodo = $("#valor_periodo").val();
            var dataFinal = "";
            if ($("#a013_data_fim").val() != "")
                dataFinal = new Date(formataData_BR_to_DB($("#a013_data_fim").val()) + " 00:00");


            if (($("#a013_data_renovacao").val() != "")) {
                if ($("#a013_data_renovacao").val().length < 10) {
                    return;
                }
                dataInicio = new Date(formataData_BR_to_DB($("#a013_data_renovacao").val()) + " 00:00");

                $("#valor_periodo").prop('readonly', false).removeAttr("tabIndex");
                $("#a013_data_fim").prop('readonly', false).removeAttr("tabIndex");

                $(".a013_status").prop('checked', false)
                $($(".a013_status")[0]).prop('checked', true)

                if (($(campo).attr("id") == "a013_data_renovacao")) {
                    ///criado essas variaveis pois nao pode mexer nas atuais (dataInicio,dataFinal,dias) pois elas sao validadas depois
                    var inicioRenov = dataInicio;
                    var finalRenov = dataFinal;
                    var diasRenov = $('#a013_prazo_contrato').val();

                    ///aqui caso altere data de renovação, habilita dias e data fim pra poder alterar mas primeiramente ja calcula com os dias do contrato anterior
                    inicioRenov.setDate(inicioRenov.getDate() + parseInt(diasRenov));
                    finalRenov = dtFormatadaBr(new Date(inicioRenov));
                    $("#a013_data_fim").val(finalRenov);

                    dataInicio = new Date(formataData_BR_to_DB($("#a013_data_renovacao").val()) + " 00:00");
                    dataFinal = new Date(formataData_BR_to_DB($("#a013_data_fim").val()) + " 00:00");
                }
            }

            if (dataInicio != "" && valor_periodo != "") {
                let calc_date = new Date(dataInicio);

                if (tipo == "dias") {
                    calc_date.setDate(dataInicio.getDate() + parseInt(valor_periodo));
                    dataFinal = new Date(calc_date)
                    $("#a013_data_fim").val(dtFormatadaBr(dataFinal));
                } else if (tipo == "semanas") {
                    calc_date.setDate(dataInicio.getDate() + parseInt(valor_periodo) * 7);
                    dataFinal = new Date(calc_date)
                    $("#a013_data_fim").val(dtFormatadaBr(dataFinal));
                } else if (tipo == "meses") {
                    calc_date.setMonth(dataInicio.getMonth() + parseInt(valor_periodo));
                    dataFinal = new Date(calc_date)
                    $("#a013_data_fim").val(dtFormatadaBr(dataFinal));
                } else if (tipo == "anos") {
                    calc_date.setFullYear(dataInicio.getFullYear() + parseInt(valor_periodo));
                    dataFinal = new Date(calc_date)
                    $("#a013_data_fim").val(dtFormatadaBr(dataFinal));
                }

                if (dataFinal != "") {
                    let Difference_In_Time = dataFinal.getTime() - dataInicio.getTime();
                    let dias = Difference_In_Time / (1000 * 3600 * 24);
                    $("#a013_prazo_contrato").val(dias);
                }
            }

            if ((valor_periodo != "" || valor_periodo == 0) && (dataInicio != "" && dataFinal != "")) {
                if (valor_periodo <= 0) {

                    $.alert("Data Final não pode ser Menor que a Data Início ou Data de Renovação!");
                    $("#a013_prazo_contrato, #valor_periodo").val(1)
                    $("#valor_periodo").focus();
                    calculaDataFinal("dias");
                }
            }
        }

        function CarregaCategoriaDocumentos() {
            var idCategoria = $("#a008_id_cat_contrato").val();
            var idContrato = "<?php echo e($contrato->a013_id_contrato ?? 0); ?>";

            if (idCategoria != "") {
                $.ajax({
                    url: '/new_gebit/app.dealix.com.br/carregaCategoriaDocumentos',

                    type: 'GET',
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data: {
                        idCategoria: idCategoria,
                        idContrato: idContrato
                    },
                    success: function(response) {

                        var documentos = response.documentos;
                        var html = '';
                        $(".divAddDivsDocumento").html('');


                        for (var x = 0; x < documentos.length; x++) {

                            var required = "";
                            //campos obrigatorios data e obs
                            if (documentos[x].a009_ind_obrigatorio == 1) {
                                required = 'required="required"';
                            }

                            var urlsalva = documentos[x].a014_documento;
                            var url = "http://<?php echo e($_SERVER['HTTP_HOST']); ?>/storage/app/public" + urlsalva;
                            var a014_data = documentos[x].a014_data;
                            var a014_data_vencimento = documentos[x].a014_data_vencimento;
                            var a014_obs = documentos[x].a014_obs;
                            var a008_termo_cancelamento = documentos[x].a008_termo_cancelamento;

                            $(".jtermoCancel").html(a008_termo_cancelamento);


                            var idDoc = documentos[x].a009_id_cat_contr_doc;
                            html = '' +
                                '   <div class="col-md-12">' +
                                '       <div class="form-group has-error has-danger">' +
                                '           <label for="a014_documento' + idDoc +
                                '" class="control-label" style="width: 100%;">' + documentos[x].a009_descricao +
                                '</label>' +
                                '           <a download href="' + url + '" class="jUrlSalva' + idDoc +
                                '">Baixar contrato</a> <div class="btn btn-xs btn-danger jdelUrlSalva jUrlSalva' +
                                idDoc + '" id="' + idDoc +
                                '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>' +
                                '           <input class="jUpload' + idDoc + '" name="a014_documento' + idDoc +
                                '" id="a014_documento' + idDoc + '" obrigatorio="' + documentos[x]
                                .a009_ind_obrigatorio + '" type="file" data-error="Adicione ' + documentos[x]
                                .a009_descricao + '" value="' + urlsalva + '" >' +
                                '           <input name="id_cat_contrato[]" type="hidden" value="' + idDoc +
                                '" >' +
                                '           <div class="help-block with-errors"></div>' +
                                '        </div>' +
                                '    </div>' +
                                '   <div class="row>' +
                                '   <div class="col-md-4">' +
                                '        <div class="form-group">' +
                                '            <label for="a014_data_vencimento" class="control-label">Data Vencimento</label>' +
                                '            <input class="form-control dataMask" name="a014_data_vencimento[]" type="text" value="' +
                                a014_data_vencimento + '" id="a014_data_vencimento[]" maxlength="10" ' +
                                required +
                                ' pattern="(^(((0[1-9]|1[0-9]|2[0-8])[\\/](0[1-9]|1[012]))|((29|30|31)[\\/](0[13578]|1[02]))|((29|30)[\\/](0[4,6,9]|11)))[\\/](19|[2-9][0-9])\\d\\d$)|(^29[\\/]02[\\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)">' +
                                '            <div class="help-block with-errors"></div>' +
                                '        </div>' +
                                '    </div>' +
                                '   <div class="col-md-8">' +
                                '        <div class="form-group">' +
                                '            <label for="a014_obs" class="control-label">Observação</label>' +
                                '            <input class="form-control" name="a014_obs[]" type="text" value="' +
                                a014_obs + '" id="a014_obs[]" maxlength="500" ' + required + '>' +
                                '            <div class="help-block with-errors"></div>' +
                                '        </div>' +
                                '    </div>' +
                                '    </div>' +
                                '';

                            $(".divAddDivsDocumento").append(html);

                            if (documentos[x].a009_ind_obrigatorio == 1) {
                                $('.jUpload' + idDoc).prop("required", true);
                                //$(".jUpload").prop("required", true);
                            }
                            if (urlsalva != "") {
                                $('.jUpload' + idDoc).prop("required", false);
                                $('.jUpload' + idDoc).hide();
                            } else {
                                $('.jUrlSalva' + idDoc).hide();
                            }
                        }


                        $(".jdelUrlSalva").click(function() {
                            var id = $(this).attr('id');
                            $(".jUrlSalva" + id).hide();
                            $(".jUpload" + id).show();
                            if ($(".jUpload" + id).attr('obrigatorio') > 0)
                                $('.jUpload' + id).prop("required", true);

                            var idsDel = $("#id_documento_del").val();
                            idsDel += "," + id;
                            $("#id_documento_del").val(idsDel);


                        });


                        //jUrlSalva
                        //jUpload

                        $('form').validator('update');

                        $('.dataCalend').datepicker({
                            format: 'dd/mm/yyyy',
                            language: 'pt-BR',
                            autoclose: true
                        });


                    }
                });
            }
        }

        function addTableContratoTipoVencimento() {

            var a012_id_tipo_vencimento = $("#a012_id_tipo_vencimento_form").val();
            var a017_valor = $("#a017_valor_form").val();

            if (a012_id_tipo_vencimento == "" || a017_valor == "") {
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor Preencher todos os campos!',
                });
                return;
            }


            var txt = $("#a012_id_tipo_vencimento_form").find(":selected").text();

            var addLinha = '<tr class="dados_id bg_add_linha">' +
                '<td>' + txt +
                '<input type="hidden" name="a012_id_tipo_vencimento[]" id="a012_id_tipo_vencimento" value="' +
                a012_id_tipo_vencimento + '"></td>' +
                '<td>' + a017_valor + '<input type="hidden" name="a017_valor[]" id="a017_valor" value="' + a017_valor +
                '"></td>' +
                '<td>' +
                '<div class="btn btn-info" title="Editar Contato" onclick="editaContratoTipoVencimento(this)"><i class="fa fa-edit" aria-hidden="true"></i></div> ' +
                '<div class="btn btn-danger" title="Excluir Contato" onclick="removeContratoTipoVencimento(\'Tem certeza que deseja excluir este Contato?\', this)">' +
                '<i class="fa fa-trash-o" aria-hidden="true"></i></div>' +
                '</td>' +
                '</tr>';
            $('#table-contato').append(addLinha);

            /***** Resentando os valores dos campos ******/
            $("#a012_id_tipo_vencimento_form").val("");
            $("#a017_valor_form").val("");
            $('#a012_id_tipo_vencimento_form').select2();

        }

        //Remover linha da tabela
        function removeContratoTipoVencimento(string, thiscampo) {
            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: string,
                buttons: {
                    confirm: {
                        text: 'Excluir',
                        btnClass: 'btn-danger',
                        action: function() {
                            $(thiscampo).parents('.dados_id').remove();
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }

        function editaContratoTipoVencimento(thiscampo) {
            var linha = $(thiscampo).parents('.dados_id');
            if ((linha.length) > 0) {
                linha = linha[0];
                var a012_id_tipo_vencimento = $("#a012_id_tipo_vencimento", linha).val();
                var a017_valor = $("#a017_valor", linha).val();

                $("#a012_id_tipo_vencimento_form").val(a012_id_tipo_vencimento);
                $("#a017_valor_form").val(a017_valor);

                $('#a012_id_tipo_vencimento_form').select2();

                linha.remove();
            }
        }



        function criaDataTableHistorico() {
            $('#tableHistoricoContrato').DataTable({
                responsive: true,
                "pageLength": 100,
                fixedHeader: {
                    header: true,
                    footer: false
                },
                order: [
                    [0, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                "language": {
                    "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json"
                }
            });

            tableRenovacaoContrato = $('#tableRenovacaoContrato').DataTable({
                responsive: true,
                "pageLength": 100,
                fixedHeader: {
                    header: true,
                    footer: false
                },
                order: [
                    [1, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                "language": {
                    "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json"
                }
            });
        }

        function criaDataTablePendencias() {
            tablePendencias = $('#tablePendencias').DataTable({
                responsive: true,
                "pageLength": 100,
                fixedHeader: {
                    header: true,
                    footer: false
                },
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                "ordering": false,
                "language": {
                    "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json"
                }
            });
        }

        function criaDataTableFinanceiro() {
            tableFinanceiro = $('#tableFinanceiro').DataTable({
                responsive: true,
                "pageLength": 100,
                fixedHeader: {
                    header: true,
                    footer: false
                },
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                "ordering": false,
                "language": {
                    "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json"
                }
            });
        }

        function format(tr) {
            let value = tr.data('child-value')
            let observacao = tr.data('obs-anotacao')
            let aceite = tr.data('aceite-anotacao')
            let da_minha_empresa = tr.data('da-minha-empresa-anotacao')

            let html = '<div class="card"><div class="card-footer">Anotação</div><div class="card-body"><div class="p-5">' +
                value + '</div></div>';

            if (observacao) {
                html +=
                    '<div class="card ml-5"><div class="card-footer">Comentário</div><div class="card-body"><div class="p-5 comment">' +
                    observacao + '</div></div></div></div>'
                html +=
                    '<div class="p-5"><button data-toggle="modal" data-target="#addComentarioAnotacao" class="button-modal anotacao-comentario btn '

                if (aceite !== '') {
                    if (aceite != 0)
                        html += 'btn-success disabled" disabled>Aceito</button></div>';
                    else
                        html += 'btn-danger disabled" disabled>Rejeitado</button></div>';
                } else if (!da_minha_empresa) {
                    html += 'btn btn-info">Aceitar / Rejeitar</button></div>';
                } else {
                    html += 'btn btn-info disabled" disabled>Aceitar / Rejeitar</button></div>';
                }
            } else {
                html +=
                    '<div class="card ml-5 hidden"><div class="card-footer">Comentário</div><div class="card-body"><div class="p-5 comment"></div></div></div></div>'
                html +=
                    '<div class="p-5"><button type="button" data-toggle="modal" data-target="#addComentarioAnotacao" class="button-modal anotacao-comentario btn ';

                if (aceite !== '') {
                    if (aceite != 0)
                        html += 'btn-success disabled" disabled>Aceito</button></div>';
                    else
                        html += 'btn-danger disabled" disabled>Rejeitado</button></div>';
                } else if (!da_minha_empresa) {
                    html += 'btn btn-info">Aceitar / Rejeitar</button></div>';
                } else {
                    html += 'btn btn-info disabled" disabled>Aceitar / Rejeitar</button></div>';
                }

                html += '</div>';
            }

            return html;
        }


        function format_details_financeiro(tr) {
            let justificativa = tr.data('justificativa-financeiro')

            let html =
                '<div class="card"><div class="card-footer">Justificativa</div><div class="card-body"><div class="p-5">' +
                justificativa + '</div></div></div>';

            return html;
        }


        // Add event listener for opening and closing details
        $('#tableRenovacaoContrato').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = tableRenovacaoContrato.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(tr)).show();
                tr.addClass('shown');
            }

            $('.anotacao-comentario').on('click', function() {
                id_anotacao_selecionada = $(this).closest('tr').prev().data('id-anotacao')
            })
        });

        $('#tableFinanceiro').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = tableFinanceiro.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format_details_financeiro(tr)).show();
                tr.addClass('shown');
            }

            $('.financeiro-justificativa').on('click', function() {
                id_parcela_selecionada = $(this).closest('tr').prev().data('id-anotacao')
            })
        });

        var dataTableUsuariosContrato;

        function criaDataTableUsuariosContrato() {
            dataTableUsuariosContrato = $('#tableUsuariosContrato').DataTable({
                responsive: true,
                "pageLength": 100,
                fixedHeader: {
                    header: true,
                    footer: false
                },
                dom: 'Bfrtip',
                buttons: [],
                "language": {
                    "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json"
                }
            });
        }

        function verificaStatus() {
            if ($('.a013_status:checked').val() == 'C') {
                <?php if(($contrato->a013_status ?? 'A') == 'C'): ?>
                    $(".a013_status").prop("disabled", true)
                <?php endif; ?>
                $(".jMostraTermo").show();
                $("#a013_aceita_termo").prop("required", "required");
            } else {
                $(".jMostraTermo").hide();
                $("#a013_aceita_termo").prop("required", false);
            }
        }

        function verificatermos() {
            if ($("#a013_aceita_termo").prop("checked")) {
                $('.jMotraDataUserCancelou').show();

                if ($(".dataCancelamento").html().length < 5) {
                    $(".dataCancelamento").html(mostraDataHoraAtual());
                }
            } else {
                $('.jMotraDataUserCancelou').hide();
            }
        }

        <?php if(isset($contrato)): ?>
        function addParcela()
            {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                let inputs = $('#addParcela input, #addParcela textarea').serializeArray()
                let form = $('#addParcelaForm')[0]
                let formData = new FormData()

                inputs.forEach(function(elem) {
                    formData.append(elem.name, elem.value)
                })
                formData.append( 'a028_documento',  $('#a028_documento')[0].files[0] );

                $('#addParcela').modal('toggle')

                $.ajax({
                    url: "/salvarNovaParcelaFinanceiro/<?php echo e($contrato->a013_id_contrato); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                    success: function (response) {
                        if (!response.success) {
                            $.alert(response.message);
                        }
                        else {
                            $('#addParcela input, #addParcela textarea').val('')

                            tableFinanceiro.row.add( [
                                '<td></td>',
                                new Date(response.data.a028_data_cobranca + ' 00:00:00').toLocaleDateString('pt-br'),
                                response.data.nome_empresa,
                                response.data.a028_valor_fracao,
                                response.data.a028_valor_comissao,
                                response.data.a028_valor_extra,
                                '<td class="text-center"><span class="badge badge-warning">Aguardando</span></td>',
                                '',
                                '',
                                '<td class="text-center"><span data-toggle="tooltip" data-placement="top" title="" class="glyphicon glyphicon-eye-open"></span></td>'
                            ] ).draw( false );

                            $('#tableFinanceiro tbody tr:last-child td:first-child').addClass('details-control')
                            $('#tableFinanceiro tbody tr:last-child').attr('data-id-financeiro', response.data.a028_id_contrato_financeiro)
                            $('#tableFinanceiro tbody tr:last-child').attr('data-status-financeiro', response.data.a028_status ?? '')
                            $('#tableFinanceiro tbody tr:last-child').attr('data-justificativa-financeiro', response.data.a028_justificativa ?? '')
                        }
                    },
                    error: function (response) {
                        $.alert('Não foi possível adicionar a anotação');
                        console.log(response)
                    }
                });
            }
            <?php endif; ?>


        function confirmChangeStatusFinanceiro(status, that) {
            let tipo = status ? 'paga' : 'atrasada';

            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: 'Tem certeza que deseja definir esta parcela como ' + tipo + '?',
                buttons: {
                    confirm: {
                        text: tipo,
                        btnClass: status ? 'btn-success' : 'btn-danger',
                        action: function() {
                            changeStatusFinanceiro(status, that)
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }

        function changeStatusFinanceiro(status, that) {
            let id_financeiro = $(that).closest('tr').data('id-financeiro')
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/salvarStatusFinanceiro/" + id_financeiro,
                type: "POST",
                data: {
                    a028_status: status
                },
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                success: function(response) {
                    if (!response.success) {
                        $.alert(response.message);
                    } else {
                        let status = response.data.a028_status;
                        let status_button = '<td><span class="badge badge-'
                        if (status == '1') {
                            status_button += 'success">Pago'
                        } else {
                            status_button += 'danger">Atrasado'
                        }
                        status_button += '</span></td>'

                        tableFinanceiro.row($(that).closest('tr')).remove();
                        tableFinanceiro.row.add([
                            '<td></td>',
                            new Date(response.data.a028_data_cobranca + ' 00:00:00').toLocaleDateString(
                                'pt-br'),
                            response.data.nome_empresa,
                            response.data.a028_valor_fracao,
                            response.data.a028_recorrencia,
                            response.data.a028_valor_comissao,
                            response.data.a028_valor_extra,
                            status_button,
                            '<td><button type="button" onclick="confirmChangeStatusFinanceiro(1, this)" class="btn btn-success">Pago</button>&nbsp' +
                            '<button type="button" onclick="confirmChangeStatusFinanceiro(0, this)" class="btn btn-danger">Atrasado</button></td>'
                        ]).draw(false);

                        $('#tableFinanceiro tbody tr:last-child td:first-child').addClass('details-control')
                        $('#tableFinanceiro tbody tr:last-child').attr('data-id-financeiro', response.data
                            .a028_id_contrato_financeiro)
                        $('#tableFinanceiro tbody tr:last-child').attr('data-status-financeiro', response.data
                            .a028_status ?? '')
                        $('#tableFinanceiro tbody tr:last-child').attr('data-justificativa-financeiro', response
                            .data.a028_justificativa ?? '')
                    }
                },
                error: function(response) {
                    $.alert('Não foi possível alterar a parcela');
                    console.log(response)
                }
            });
        }

        <?php if(isset($emp)): ?>
            function addPendencia() {
                let pendencia = $('#nova_pendencia').val();
                let id_empresa_pendencia = <?php echo e($emp->a005_id_empresa); ?>;
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "/salvarPendencia/<?php echo e($contrato->a013_id_contrato); ?>",
                    type: "POST",
                    data: {
                        a027_pendencia: pendencia,
                        a005_id_empresa: id_empresa_pendencia
                    },
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    success: function(response) {
                        if (!response.success) {
                            $.alert(response.message);
                        } else {
                            tablePendencias.row.add([
                                response.data.nome_empresa,
                                response.data.a027_pendencia,
                                response.data.created_at,
                                '<td><span class="badge badge-secondary">Pendente</span></td>',
                                '<td><button type="button" onclick="confirmChangeStatus(1, this)" class="btn btn-success">Aceitar</button>&nbsp' +
                                '<button type="button" onclick="confirmChangeStatus(0, this)" class="btn btn-danger">Rejeitar</button></td>'
                            ]).draw(false);

                            $('#tablePendencias tbody tr:last-child').attr('data-id-pendencia', response.data
                                .a027_id_pendencia)
                            $('#tablePendencias tbody tr:last-child').attr('data-aceite-pendencia', response
                                .data.a027_pendencia_aceite ?? '')
                        }
                    },
                    error: function(response) {
                        $.alert('Não foi possível adicionar a pendência');
                        console.log(response)
                    }
                });
            }
        <?php endif; ?>

        function confirmChangeStatus(status, that) {
            let tipo = status ? 'aceitar' : 'rejeitar';

            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: 'Tem certeza que deseja ' + tipo + ' esta pendência?',
                buttons: {
                    confirm: {
                        text: tipo,
                        btnClass: status ? 'btn-success' : 'btn-danger',
                        action: function() {
                            changeStatus(status, that)
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }

        function changeStatus(status, that) {
            let id_pendencia = $(that).closest('tr').data('id-pendencia')
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/salvarStatusPendencia/" + id_pendencia,
                type: "POST",
                data: {
                    a027_pendencia_aceite: status
                },
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                success: function(response) {
                    if (!response.success) {
                        $.alert(response.message);
                    } else {
                        let status = response.data.a027_pendencia_aceite;
                        let pendencia_button = '<td><span class="badge badge-'
                        if (status == '1') {
                            pendencia_button += 'success">Aceito'
                        } else {
                            pendencia_button += 'danger">Rejeitado'
                        }
                        pendencia_button += '</span></td>'

                        tablePendencias.row($(that).closest('tr')).remove();
                        tablePendencias.row.add([
                            response.data.nome_empresa,
                            response.data.a027_pendencia,
                            response.data.created_at,
                            pendencia_button,
                            '<td><button type="button" onclick="confirmChangeStatus(1, this)" class="btn btn-success">Aceitar</button>&nbsp' +
                            '<button type="button" onclick="confirmChangeStatus(0, this)" class="btn btn-danger">Rejeitar</button></td>'
                        ]).draw(false);

                        $('#tablePendencias tbody tr:last-child').attr('data-id-pendencia', response.data
                            .a027_id_pendencia)
                        $('#tablePendencias tbody tr:last-child').attr('data-aceite-pendencia', response.data
                            .a027_pendencia_aceite ?? '')
                    }
                },
                error: function(response) {
                    $.alert('Não foi possível alterar a pendência');
                    console.log(response)
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/contrato/form.blade.php ENDPATH**/ ?>