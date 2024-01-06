<?php if(!isset($hide_header_buttons)): ?>
<div class="box-footer BotesFixoTopo">
    <?php ($url = (($tipo??'')!='') ? '/emp_'.($tipo??'').'' : '/empresa'); ?>
    <a href="<?php echo e(url($url)); ?>" class="btn btn-default btnCancelar">
        <i class="fa fa-ban"></i> Cancelar
    </a>
   
    <a href="<?php echo e($login_url??""); ?>" class="btn btn-default jaSouMembro" style="display: none;">
        <?php echo e(__('adminlte::adminlte.i_already_have_a_membership')); ?>

    </a>

    <?php if(($empresa->a004_dono_cadastro??1) == 1 or true): ?>
    <button type="button" onclick="enviarFormulario()" class="btn bg-olive pull-right">
        <i class="fa fa-save"></i> <span class="jtxtSalvar"><?php echo e(isset($submitButtonText) ? $submitButtonText : 'Salvar'); ?></span>
    </button>
    <?php else: ?>
        <span class="btn btn-default  pull-right" >Somente quem é Proprietário pode alterar</span>
    <?php endif; ?>
</div>
<?php endif; ?>

<div class="box-body">
    <?php echo Form::hidden('a005_id_empresa', $empresa->a005_id_empresa??0, ['id'=>'a005_id_empresa','class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'20']); ?>

    <?php echo Form::hidden('a004_dono_cadastro', $empresa->a004_dono_cadastro??1, ['id'=>'a004_dono_cadastro','class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'20']); ?>

    <?php echo Form::hidden('tipo_empresa', ($tipo??''), ['id'=>'tipo_empresa','class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'50']); ?>

    
    <?php if(!isset($hide_header_buttons)): ?>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="tabs_hint">
            <li class="form_geral"><a class="active" href="#form_geral" data-toggle="tab">Geral</a></li>
            <li class="form_contato"><a href="#form_contato" data-toggle="tab">Contatos</a></li>
            <?php if($empresa->a004_dono_cadastro??1 == 1): ?>
                <li class="form_socio" style="display: none;"><a href="#form_socio" data-toggle="tab">Sócios</a></li>
            <?php endif; ?>
            <?php if(isset($editPage)): ?>
                <li class="form_docs"><a href="#form_docs" data-toggle="tab">Documentos</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="tab-content">
        <div class="active tab-pane" id="form_geral">
            <?php if(!isset($hide_header_buttons)): ?>
                <?php echo $__env->make('sistema.empresa.formGeral', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('sistema.empresa.formGeral', ['hide_header_buttons' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        <?php if(!isset($hide_header_buttons)): ?>
        <div class="tab-pane" id="form_contato"><?php echo $__env->make('sistema.empresa.formContato', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
        <div class="tab-pane" id="form_socio"><?php echo $__env->make('sistema.empresa.formSocio', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
            <?php if(isset($editPage)): ?>
                <div class="tab-pane" id="form_docs"><?php echo $__env->make('sistema.empresa.formDocs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
            <?php endif; ?>
        <?php endif; ?>
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

    <?php if(!isset($hide_header_buttons)): ?>
    <div class="box-footer mt-4">
        <?php ($url = (($tipo??'')!='') ? '/emp_'.($tipo??'').'' : '/empresa'); ?>
        <a href="<?php echo e(url($url)); ?>" class="btn btn-default btnCancelar">
            <i class="fa fa-ban"></i> Cancelar
        </a>
            <a href="<?php echo e($login_url??""); ?>" class="btn btn-default jaSouMembro" style="display: none;">
                <?php echo e(__('adminlte::adminlte.i_already_have_a_membership')); ?>

            </a>

        <?php if(($empresa->a004_dono_cadastro??1) == 1 or true): ?>
        <button type="button" onclick="enviarFormulario()" class="btn bg-olive pull-right">
            <i class="fa fa-save"></i> <span class="jtxtSalvar"><?php echo e(isset($submitButtonText) ? $submitButtonText : 'Salvar'); ?></span>
        </button>
        <?php else: ?>
            <span class="btn btn-default  pull-right" >Somente quem é Proprietário pode alterar</span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>


<?php $__env->startPush('css'); ?>
    <style>
        .tooltip{font-size:12px; }
        select[readonly].select2-hidden-accessible + .select2-container {
            pointer-events: none;
            touch-action: none;
        }

        select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
            background: #eee;
            box-shadow: none;
        }

        select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow,
        select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
            display: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    <script>

        <?php if((($tipo??"")=="empresa")): ?>
        $("#a005_ind_empresa").prop("readonly", true);
        <?php endif; ?>

        <?php if((($tipo??"")=="cliente")): ?>
        $("#a005_ind_cliente").prop("readonly", true);
        <?php endif; ?>

        <?php if((($tipo??"")=="fornecedor")): ?>
        $("#a005_ind_fornecedor").prop("readonly", true);
        <?php endif; ?>

        $(document).ready(function () {
            $('.select2').select2({
                language: 'pt-BR'
            });
            validaMatrizFilial();
            validaFisicoJuridico();
            validaClienteFornecedor();
            validaEstrangeiro();

            <?php if(isset($notificarContatos) && $notificarContatos): ?>
               changeTab('form_contato')
               $('#notificarContatoAlteracoes').modal('toggle')
            <?php endif; ?>
        });

        function enviarFormulario()
        {
            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: 'Um convite será enviado ao email informado para que este participe de sua rede de negócios.',
                buttons: {
                    confirm: {
                        text: 'Confirmar',
                        btnClass: 'btn-success',
                        action: function () {
                            $('.form-empresa').submit();
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }

        function changeTab(id_tab)
        {
            $('#tabs_hint li a').removeClass('active')
            $('.tab-pane').removeClass('active')
            $('#'+id_tab).addClass('active')
            $('li.'+id_tab+' a').addClass('active')
        }

        $("#a005_email").keyup(function () {
            if($("#a005_email_original").val()!=$("#a005_email").val())
                $("#a005_email").addClass('validaunico');
            else
                $("#a005_email").removeClass('validaunico');
        })

        $('.jIndEmpresa').tooltip({
            title: "Utilize essa opção para cadastrar uma Empresa adicional na sua conta!",
            html: true,
            placement: "top"
        });

        //Busca por CEP
        $("#a005_cep").blur(function () {
            buscaCep();
        });

        $(".buscaexistente").blur(function($value){
            buscaExistente(this);
        });

        $("#a005_tipo_empresa").change(function($value){
            validaMatrizFilial();
        });
        $("#a005_tipo_cliente").change(function($value){
            validaFisicoJuridico();
        });

        $("#a005_ind_empresa").click(function($value){
            if($("#a005_ind_empresa").prop("readonly"))
            {

                if($("#a005_ind_empresa:checked").length==0) {
                    $("#a005_ind_empresa").prop('checked', true);
                }
                else {
                    $("#a005_ind_empresa").prop('checked', false);
                }
                return;
            }
            validaClienteFornecedor();
        });

        $("#a005_ind_fornecedor").click(function($value){
            //validaClienteFornecedor();
        });

        $("#a005_ind_cliente").click(function($value){
            //validaClienteFornecedor();
        });

        $("#a005_ind_estrangeiro").click(function($value){
            if($("#a005_ind_estrangeiro").prop("readonly"))
            {

                if($("#a005_ind_estrangeiro:checked").length==0) {
                    $("#a005_ind_estrangeiro").prop('checked', true);
                }
                else {
                    $("#a005_ind_estrangeiro").prop('checked', false);
                }
                return;
            }
            validaEstrangeiro();
        });

        // $("#a005_status").click(function($value){
        //     if($("#a005_status").prop("readonly"))
        //     {

        //         if($("#a005_status:checked").length==0) {
        //             $("#a005_status").prop('checked', true);
        //         }
        //         else {
        //             $("#a005_status").prop('checked', false);
        //         }
        //         return;
        //     }

        //     if($("#a005_status:checked").length <=0)
        //     {
        //         $.alert({
        //             theme: 'light',
        //             title: 'ALERTA',
        //             content: 'Ao Desativar, todos os Usuários da Empresa não tem mais acesso ao sistema!',
        //         });
        //     }

        // });


        function buscaExistente(thiss)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var valorDigitado = $(thiss).val();
            var valorEdit = $("#"+$(thiss).attr('id')+"_edit").val();

            if(valorDigitado.replace(/\D/g, '') == valorEdit.replace(/\D/g, ''))
            {
                return ;
            }

            url = '/empresa_buscaExistente';
            if($("#cadastrese").length>0) {
                url = '/registrar_buscaExistente'
            }

            $.ajax({
                url: url,
                type: "GET",
                data: {valorDigitado: valorDigitado},
                headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                success: function (response) {
                    if(response.a005_id_empresa != undefined)
                    {

                        if($("#cadastrese").length>0) {
                            $.alert({
                                theme: 'light',
                                title: 'ALERTA',
                                content: 'Empresa já se encontra cadastrada, entre em contato com o Adminstrador do Sistema!',
                            });
                            $(thiss).val("");
                            return;
                        }
                        <?php if((($tipo??"")!="empresa")): ?>
                            $("#imagemEmpresa").val(response.a005_logo).prop("readonly", true);
                            $("#a005_id_empresa").val(response.a005_id_empresa).prop("readonly", true);
                            $("#a005_tipo_cliente").val(response.a005_tipo_cliente).prop("readonly", true);
                            $("#a005_tipo_empresa").val(response.a005_tipo_empresa).prop("readonly", true);
                            $("#a005_id_empresa_matriz").val(response.a005_id_empresa_matriz).prop("readonly", true);
                            $("#a005_ind_estrangeiro").val(response.a005_ind_estrangeiro).prop("readonly", true);
                            $("#a005_nome_completo").val(response.a005_nome_completo).prop("readonly", true);
                            $("#a005_razao_social").val(response.a005_razao_social).prop("readonly", true);
                            $("#a005_nome_fantasia").val(response.a005_nome_fantasia).prop("readonly", true);
                            $("#a005_ie").val(response.a005_ie).prop("readonly", true);
                            $("#a005_im").val(response.a005_im).prop("readonly", true);
                            $("#a005_fone").val(response.a005_fone).prop("readonly", true);
                            $("#a005_email").val(response.a005_email).prop("readonly", true);
                            $("#a005_email").removeClass('validaunico');
                            $("#a005_cep").val(response.a005_cep).prop("readonly", true);
                            $("#a047_id_cidade").val(response.a047_id_cidade).prop("readonly", true);
                            $("#a005_endereco").val(response.a005_endereco).prop("readonly", true);
                            $("#a005_bairro").val(response.a005_bairro).prop("readonly", true);
                            $("#a005_numero_end").val(response.a005_numero_end).prop("readonly", true);
                            $("#a005_complemento_end").val(response.a005_complemento_end).prop("readonly", true);
                            $("#a048_id_estado").val(response.a048_id_estado).prop("readonly", true);


                            // if(response.a005_status==1)
                            //     $("#a005_status").prop("checked",true).prop("readonly", true);
                            // else
                            //     $("#a005_status").prop("checked",false).prop("readonly", true);



                            $("#a048_id_estado").select2()
                            $("#a048_id_estado").prop("readonly", true);;
                            $('#a047_id_cidade').html('<option value=""></option>');
                            //$('#a048_id_estado').select2({ disabled:'readonly' })
                            $.ajax({
                                url: "/carregaCidade",
                                type: "GET",
                                data: {idEstado: response.a048_id_estado},
                                headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                                success: function (responseCidade) {
                                    var count = responseCidade.length;

                                    $.each(responseCidade, function (el) {
                                        $('#a047_id_cidade').append('<option value="' + responseCidade[el].a047_id_cidade + '">' + responseCidade[el].a047_nome_cidade + '</option>');
                                    });
                                    $('#a047_id_cidade').val(response.a047_id_cidade);
                                    $('#a047_id_cidade').prop("readonly", true);
                                    $('#a047_id_cidade').select2();

                                    // $('#a047_id_cidade').select2({ disabled:'readonly' })

                                    <?php if(!isset($hide_header_buttons)): ?>
                                        $('.form').validator('validate');
                                    <?php endif; ?>
                                },
                                error: function (responseCidade) {
                                    alert('Erro, tente novamente por favor!');
                                }
                            });
                            
                            <?php if(!isset($hide_header_buttons)): ?>
                                $('.form').validator('validate');
                            <?php endif; ?>
                        <?php else: ?>
                            var tipo = "CNPJ";
                            if($("#a005_tipo_cliente").val()=="F")
                            {
                                tipo = "CPF";
                            }
                            $.alert({
                                theme: 'light',
                                title: 'ALERTA',
                                content: tipo+' já está em uso no sistema. Cadastre como cliente ou fornecedor.',
                            });
                            $(thiss).val("");
                            return;
                        <?php endif; ?>
                    }
                    else{
                        removeReadOnly_limpa();
                    }
                },
                error: function (response) {
                    $.alert('Erro, tente novamente por favor!');
                }
            });
        }

        function validaFisicoJuridico()
        {
            var indEstr = $("#a005_ind_estrangeiro").prop("checked");

            $(".jCodIdentificacao").hide();
            $("#a005_cod_identificacao").prop("required", false);


            if ($("#a005_tipo_cliente").val() == "F") /*Fisico*/
            {
                $(".form_socio").hide();
                $(".jTipoMatriz").hide();
                $("#a005_tipo_empresa").prop("required", false);
                $("#a005_tipo_empresa").val('M');

                $(".jJuridico").hide();
                $("#a005_cnpj").prop("required", false);
                $("#a005_razao_social").prop("required", false);
                $("#a005_nome_fantasia").prop("required", false);

                $(".jFisico").show();

                <?php if(!isset($hide_header_buttons)): ?>
                    $("#a005_cpf").prop("required", true);
                    $("#a005_nome_completo").prop("required", true);
                <?php endif; ?>

            }
            else if ($("#a005_tipo_cliente").val() == "J")  /*Juridico*/{

                if($("#a005_ind_empresa").prop("checked"))
                {
                    $(".form_socio").show();
                }
                <?php if((($tipo??"")=="empresa")): ?>
                $(".jTipoMatriz").show();
                <?php endif; ?>

                $(".jJuridico").show();

                <?php if(!isset($hide_header_buttons)): ?>
                    $("#a005_tipo_empresa").prop("required", true);
                    $("#a005_cnpj").prop("required", true);
                    $("#a005_razao_social").prop("required", true);
                    $("#a005_nome_fantasia").prop("required", true);
                <?php endif; ?>

                $(".jFisico").hide();
                $("#a005_cpf").prop("required", false);
                $("#a005_nome_completo").prop("required", false);
            }
            else {
                $(".jTipoMatriz").hide();
                $("#a005_tipo_empresa").prop("required", false);

                $(".jJuridico").hide();
                $("#a005_cnpj").prop("required", false);
                $("#a005_razao_social").prop("required", false);
                $("#a005_nome_fantasia").prop("required", false);

                $(".jFisico").hide();
                $("#a005_cpf").prop("required", false);
                $("#a005_nome_completo").prop("required", false);
            }

            $("#a005_fone").show();
            $("#a005_foneSemMask").hide();

            $("#a006_fone_form").show();
            $("#a006_foneSemMask_form").hide();


            <?php if(!isset($hide_header_buttons)): ?>
                $("#a005_fone").prop("required", true);
                $("#a005_foneSemMask").prop("required", false);
            <?php endif; ?>

            if(indEstr)
            {
                $("#a005_fone").prop("required", false);
                $("#a005_foneSemMask").prop("required", true);

                $("#a005_fone").hide();
                $("#a005_foneSemMask").show();

                $("#a006_fone_form").hide();
                $("#a006_foneSemMask_form").show();

                $(".jTipoCliente").hide();
                $("#a005_tipo_cliente").val('F');

                $(".jNomeCompleto").show();

                $(".jCodIdentificacao").show();
                $(".jNaoEstrangeiro").hide();
                $("#a005_cod_identificacao").prop("required", true);


                $("#a005_cep").prop("required", false);
                $("#a048_id_estado").prop("required", false);
                $("#a047_id_cidade").prop("required", false);

                $("#a005_nome_estado").prop("required", true);
                $("#a005_nome_cidade").prop("required", true);

                $(".jcep").hide();
                $(".jcidadenacional").hide();
                $(".jcidadeestrangeiro").show();
                $(".jendereco").removeClass('col-md-6').addClass('col-md-9');


                $("#a005_cnpj").prop("required", false);
                $("#a005_cpf").prop("required", false);
            }
            else {

                $(".jTipoCliente").show();

                <?php if(!isset($hide_header_buttons)): ?>
                    $("#a005_cep").prop("required", true);
                    $("#a048_id_estado").prop("required", true);
                    $("#a047_id_cidade").prop("required", true);
                <?php else: ?>
                    $("#a048_id_estado").prop("required", false);
                    $("#a047_id_cidade").prop("required", false);
                <?php endif; ?>
                $("#a005_nome_estado").prop("required", false);
                $("#a005_nome_cidade").prop("required", false);

                $(".jcep").show();
                $(".jcidadenacional").show();
                $(".jcidadeestrangeiro").hide();
                $(".jendereco").removeClass('col-md-9').addClass('col-md-6');
            }
            validaCadastroExterno();
        }

        function validaCadastroExterno()
        {
            if($("#cadastrese").length>0) {
                $(".FormSubtitulo").hide();
                $(".jTipoMatriz").hide();
                // $(".divStatus").hide();
                $(".btnCancelar").hide();
                $(".jaSouMembro").show();
                $("#a005_tipo_empresa").prop("required", false);
                $("#a005_tipo_empresa").val('M');
                $(".jtxtSalvar").html("Criar nova conta");
            }

        }

        function validaMatrizFilial()
        {
            if($("#a005_tipo_empresa").val()=="F") /*Filial*/
            {
                $(".jTipoFilial").show();
                $("#a005_id_empresa_matriz").prop("required", true)

            }
            else /*Matriz*/{
                $(".jTipoFilial").hide();
                $("#a005_id_empresa_matriz").prop("required", false)
            }
        }

        function validaClienteFornecedor()
        {
            var indCli = $("#a005_ind_cliente").prop("checked");
            var indFor = $("#a005_ind_fornecedor").prop("checked");
            var indEmp = $("#a005_ind_empresa").prop("checked");

            if($("#a005_ind_empresa").prop("readonly"))
            {
                if("<?php echo e(($empresa->a005_ind_empresa??"0")); ?>" == "1")
                {
                    indEmp = true;
                }
                else {

                    indEmp = false;
                }
            }


            if(!indFor && !indCli && !indEmp)
            {
                $(".jTipoCliente").hide();
                $("#a005_tipo_cliente").prop("required", false);
                $("#a005_tipo_cliente").val("");
            }

            //se for somente Forncedor entao é do tipo Juricido
            if(indFor && !indCli && !indEmp)
            {
                $(".jTipoCliente").hide();
                $("#a005_tipo_cliente").prop("required", false);
                $("#a005_tipo_cliente").val("J");
            }

            if(indCli || indEmp)
            {
                $(".jTipoCliente").show();
                $("#a005_tipo_cliente").prop("required", true);

            }

            if(indEmp)
            {
                $(".form_socio").show();
            }
            else
                $(".form_socio").hide();

            validaFisicoJuridico();
            $(".select2").select2();
        }

        function validaEstrangeiro()
        {

            validaFisicoJuridico();

        }


        function buscaCep() {
            var cep = "";

            if($(".jcampoCep").length>0) {
                cep = $(".jcampoCep").val().replace(/\D/g, '');
            }

            if (cep != "") {
                var validacep = /^[0-9]{8}$/;
                if (validacep.test(cep)) {
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
                            $(".jcampoEndereco").val(dados.logradouro);
                            $(".jcampoBairro").val(dados.bairro);
                            var idEstado = dados.uf;
                            var idcidade = dados.localidade;

                            $.ajax({
                                url: '/carregaCidadeEstado',
                                type: 'GET',
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                data: {
                                    idEstado: idEstado,
                                    idcidade: idcidade
                                },
                                success: function (response) {

                                    $('#a047_id_cidade').html('<option value=""></option>');
                                    var cidades = response['cidades'];
                                    $.each(cidades, function (el) {
                                        $('#a047_id_cidade').append('<option value="' + cidades[el].a047_id_cidade + '">' + cidades[el].a047_nome_cidade + '</option>');
                                    });

                                    $('.jcampoEstado option[value="' + response['estado'] + '"]').prop('selected', true);
                                    $('.jcampoEstado').select2();

                                    $('.jcampoCidade option[value="' + response['cidade'] + '"]').prop('selected', true);
                                    $('.jcampoCidade').select2();

                                    <?php if(!isset($hide_header_buttons)): ?>
                                        $('.form').validator('validate');
                                    <?php endif; ?>

                                },
                                error: function () {

                                }
                            });
                        }
                        else {
                            $.alert("CEP não encontrado.");
                        }
                    });
                }
                else {
                    $.alert("Formato de CEP inválido.");
                }
            }
        }

        /***** Busca cidade *******/
        $('.jcampoEstado').change(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var idEstado = $(this).val();

            $('#a047_id_cidade').html('<option value=""></option>');

            $.ajax({
                url: "/carregaCidade",
                type: "GET",
                data: {idEstado: idEstado},
                headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                success: function (response) {
                    var count = response.length;

                    $.each(response, function (el) {
                        $('#a047_id_cidade').append('<option value="' + response[el].a047_id_cidade + '">' + response[el].a047_nome_cidade + '</option>');
                    });
                    $('#a047_id_cidade').select2();

                },
                error: function (response) {
                    alert('Erro, tente novamente por favor!');
                }
            });
        });

        <?php if(isset($empresa)): ?>
        function visualizarAlteracaoContato()
        {
            let empresa = $('#a005_razao_social').val() || $('#a005_nome_fantasia').val() || $('#a005_nome_completo').val()

            $('#visualizarNotificacaoContato #empresa').text(empresa)
            $('#visualizarNotificacaoContato #contato').text($('#notify_contato').text().trim())
            $('#visualizarNotificacaoContato #responsavel').text($('#notify_funcao').val())
            $('#visualizarNotificacaoContato #mensagem').text($('#notify_texto').val())

            $('#visualizarNotificacaoContato').modal('toggle')
        }

        function notificarAlteracaoContato()
        {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let inputs = $('#notificarContatoAlteracoes select, #notificarContatoAlteracoes textarea, #notificarContatoAlteracoes input')
            let array = inputs.serializeArray();
            $('#notificarContatoAlteracoes').modal('toggle')
            inputs.attr('disabled','disabled')

            $.ajax({
                url: "/notificarAlteracaoContato/<?php echo e($empresa->a005_id_empresa); ?>",
                type: "POST",
                data: array,
                headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                success: function (response) {
                    if (!response.success) {
                        $.alert(response.message);
                    }
                    else {
                        inputs.removeAttr('disabled')
                        $('#notificarContatoAlteracoes input, #notificarContatoAlteracoes textarea').val('')
                    }
                },
                error: function (response) {
                    $.alert('Não foi possível enviar a notificação');
                    console.log(response)
                },
            });
            
            inputs.removeAttr('disabled')
        }
        <?php endif; ?>

        <?php if(!isset($contrato)): ?>
        function addTableContato() {

            var a006_tipo_contato = $("#a006_tipo_contato_form").val();
            var a006_nome = $("#a006_nome_form").val();
            var a006_fone = $("#a006_fone_form").val();
            var a006_foneSemMask = $("#a006_foneSemMask_form").val();

            if(a006_foneSemMask != "")
            {
                a006_fone = a006_foneSemMask;
            }

            var a006_email = $("#a006_email_form").val();
            // var a006_status = $("#a006_status_form:checked").length;

            if (a006_tipo_contato_form == "" || a006_nome == "" || a006_fone == "" || a006_email == "" ) {
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor Preencher todos os campos!',
                });
                return;
            }

            if (validaEmail(a006_email) == false) {
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor Preencher um e-mail Válido!',
                });
                return;
            }

            var txtStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i>  Ativo </span>'
            if(a006_status==0)
            {
                txtStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i>  Inativo </span>'
            }
            var txtContato = $("#a006_tipo_contato_form").find(":selected").text();

            var colextra = '';
            <?php if(($empresa->a004_dono_cadastro??1) == 1): ?>
                colextra ='<td></td>'
            <?php endif; ?>

            var addLinha = '<tr class="dados_id bg_add_linha">' +
                '<td>' + txtContato + '<input type="hidden" name="a006_tipo_contato[]" id="a006_tipo_contato" value="' + a006_tipo_contato + '"></td>' +
                '<td>' + a006_nome + '<input type="hidden" name="a006_nome[]" id="a006_nome" value="' + a006_nome + '"></td>' +
                '<td>' + a006_fone + '<input type="hidden" name="a006_fone[]" id="a006_fone" value="' + a006_fone + '"></td>' +
                '<td>' + a006_email + '<input type="hidden" name="a006_email[]" id="a006_email" value="' + a006_email + '"></td>' +
                '<td>' + txtStatus + '<input type="hidden" name="a006_status[]" id="a006_status" value="' + a006_status + '"></td>' +
                colextra +
                '<td>' +
                '<div class="btn btn-info" title="Editar Contato" onclick="editacontatoempresa(this)"><i class="fa fa-edit" aria-hidden="true"></i></div>'+
                '<div class="btn btn-danger" title="Excluir Contato" onclick="removecontatoempresa(\'Tem certeza que deseja excluir este Contato?\', this)">' + '<i class="fa fa-trash-o" aria-hidden="true"></i></div>' +
                '</td>' +
                '</tr>';
            $('#table-contato').append(addLinha);


            /***** Resentando os valores dos campos ******/
            $("#a006_tipo_contato_form").val("");
            $("#a006_nome_form").val("");
            $("#a006_fone_form").val("");
            $("#a006_email_form").val("");
            $("#a006_status_form").prop("checked", true);
            $('#a006_tipo_contato_form').select2();

            // let newOption = new Option(a006_nome, a006_nome, false, false);
            // $('#notify_contato').append(newOption).trigger('change');

            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: 'Um contato foi adicionado/alterado. Para notificar clientes e fornecedores, é necessário Salvar as alterações da empresa. Deseja salvar?',
                buttons: {
                    confirm: {
                        text: 'Sim',
                        btnClass: 'btn-success',
                        action: function () {
                            $('#notificar_contatos').val(1)
                            $('.form-empresa').submit();
                        }
                    },
                    cancel: {
                        text: 'Não',
                    }
                }
            });
            
        }

        //Remover linha da tabela
        function removecontatoempresa(string,  thiscampo) {
            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: string,
                buttons: {
                    confirm: {
                        text: 'Excluir',
                        btnClass: 'btn-danger',
                        action: function () {
                            $(thiscampo).parents('.dados_id').remove();

                            // let nome = $(thiscampo).parents('.dados_id').find('#a006_nome').val();
                            // $('#notify_contato option[value="'+nome+'"]').detach();

                            $.confirm({
                                theme: 'light',
                                title: 'ALERTA',
                                content: 'Um contato foi excluído. Para notificar clientes e fornecedores, é necessário Salvar as alterações da empresa. Deseja salvar?',
                                buttons: {
                                    confirm: {
                                        text: 'Sim',
                                        btnClass: 'btn-success',
                                        action: function () {
                                            $('#notificar_contatos').val(1)
                                            $('.form-empresa').submit();
                                        }
                                    },
                                    cancel: {
                                        text: 'Não',
                                    }
                                }
                            });
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }

        function editacontatoempresa(thiscampo)
        {
            var linha = $(thiscampo).parents('.dados_id');
            if((linha.length)>0) {
                linha = linha[0];
                var a006_tipo_contato = $("#a006_tipo_contato", linha).val();
                var a006_nome = $("#a006_nome", linha).val();
                var a006_fone = $("#a006_fone", linha).val();
                var a006_email = $("#a006_email", linha).val();
                var a006_status = $("#a006_status", linha).val();

                $("#a006_tipo_contato_form").val(a006_tipo_contato);
                $("#a006_nome_form").val(a006_nome);
                $("#a006_fone_form").val(a006_fone);
                $("#a006_email_form").val(a006_email);

                if (a006_status == 1) {
                    $("#a006_status_form").prop("checked", true);
                }
                else {
                    $("#a006_status_form").prop("checked", false);
                }

                $('#a006_tipo_contato_form').select2();

                linha.remove();
            }
        }
        <?php endif; ?>
        
        function addTableSocio() {

            var a007_nome = $("#a007_nome_form").val();
            var a007_percent_participacao = $("#a007_percent_participacao_form").val();

            if (a007_nome == "" || a007_percent_participacao == "" ) {
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor Preencher todos os campos!',
                });
                return;
            }


            var addLinha = '<tr class="dados_id bg_add_linha">' +
                '<td>' + a007_nome + '<input type="hidden" name="a007_nome[]" id="a007_nome" value="' + a007_nome + '"></td>' +
                '<td>' + a007_percent_participacao + '<input type="hidden" name="a007_percent_participacao[]" id="a007_percent_participacao" value="' + a007_percent_participacao + '"></td>' +
                '<td>' +
                '<div class="btn btn-info" title="Editar Sócio" onclick="editasocioempresa(this)"><i class="fa fa-edit" aria-hidden="true"></i></div>'+
                '<div class="btn btn-danger" title="Excluir Sócio" onclick="removesocioempresa(\'Tem certeza que deseja excluir este Sócio?\', this)">' + '<i class="fa fa-trash-o" aria-hidden="true"></i></div>' +
                '</td>' +
                '</tr>';
            $('#table-socio').append(addLinha);


            /***** Resentando os valores dos campos ******/
            $("#a007_nome_form").val("");
            $("#a007_percent_participacao_form").val("");
        }

        //Remover linha da tabela
        function removesocioempresa(string,  thiscampo) {
            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: string,
                buttons: {
                    confirm: {
                        text: 'Excluir',
                        btnClass: 'btn-danger',
                        action: function () {
                            $(thiscampo).parents('.dados_id').remove();
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }

        function editasocioempresa(thiscampo)
        {
            var linha = $(thiscampo).parents('.dados_id');

            if((linha.length)>0) {

                linha = linha[0];
                var a007_nome = $("#a007_nome", linha).val();
                var a007_percent_participacao = $("#a007_percent_participacao", linha).val();

                $("#a007_nome_form").val(a007_nome);
                $("#a007_percent_participacao_form").val(a007_percent_participacao);


                linha.remove();

            }

        }

        function removeReadOnly_limpa()
        {

            if($("#a005_email").prop("readonly")) {
                $("#imagemEmpresa").prop("readonly", false).val('');
                $("#a005_id_empresa").prop("readonly", false).val('');
                $("#a005_tipo_cliente").prop("readonly", false);
                $("#a005_tipo_empresa").prop("readonly", false);
                $("#a005_id_empresa_matriz").prop("readonly", false);
                $("#a005_ind_estrangeiro").prop("readonly", false).val('');
                $("#a005_nome_completo").prop("readonly", false).val('');
                $("#a005_razao_social").prop("readonly", false).val('');
                $("#a005_nome_fantasia").prop("readonly", false).val('');
                $("#a005_ie").prop("readonly", false).val('');
                $("#a005_im").prop("readonly", false).val('');
                $("#a005_fone").prop("readonly", false).val('');
                $("#a005_email").prop("readonly", false).val('');
                $("#a005_email").addClass('validaunico').val('');
                $("#a005_cep").prop("readonly", false).val('');
                $("#a047_id_cidade").prop("readonly", false).val('');
                $("#a005_endereco").prop("readonly", false).val('');
                $("#a005_bairro").prop("readonly", false).val('');
                $("#a005_numero_end").prop("readonly", false).val('');
                $("#a005_complemento_end").prop("readonly", false).val('');
                $("#a048_id_estado").prop("readonly", false).val('');

                // $("#a005_status").prop("checked", true).prop("readonly", false).val('');
                $("#a048_id_estado").prop("readonly", false).val('');
                $('#a047_id_cidade').prop("readonly", false).val('');

                $("#a048_id_estado").select2();
                $("#a047_id_cidade").select2();
            }
        }

    </script>
<?php $__env->stopPush(); ?>


<?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/empresa/form.blade.php ENDPATH**/ ?>