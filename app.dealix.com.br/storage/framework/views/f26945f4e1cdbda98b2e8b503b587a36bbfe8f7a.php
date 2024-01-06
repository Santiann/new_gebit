<?php if(!isset($hide_header_buttons)): ?>
<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>
<?php endif; ?>

<?php if(isset($hide_header_buttons)): ?>
<form></form>
<form action="#" id="form_modal_create_contrato">
<?php endif; ?>
<div class="jGeral">
    <div class="row">
        <div class="col-md-2 jIndEmpresa" style="display: none;" >
            <div class="form-group" >
                <div style="margin-top: 7px;">
                    <label class="control-label"><?php echo Form::checkbox('a005_ind_empresa', 1,  (($empresa->a005_ind_empresa??"0") == 1) || (($tipo??"")=="empresa")  ?  true : false, ['id' => 'a005_ind_empresa','class'=>'control-label','autocomplete' => 'off']); ?> Multi Empresa <i class="fa fa-info-circle jIndEmpresa" style="color:#3c8dbc;font-size: 16px;"></i>
                    </label>&ensp;
                </div>
            </div>
        </div>
        <div class="col-md-2"  style="<?php if(($tipo??'')=="empresa"): ?>display: none;<?php endif; ?>">
            <div class="form-group " >
                <div style="margin-top: 7px;">
                    <label class="control-label"><?php echo Form::checkbox('a005_ind_cliente', 1,  (($empresa->a005_ind_cliente??"0") == 1) || (($tipo??"")=="cliente")  ?  true : false, ['id' => 'a005_ind_cliente','class'=>'control-label','autocomplete' => 'off']); ?> Cliente</label>&ensp;
                </div>
            </div>
        </div>
        <div class="col-md-2"  style="<?php if(($tipo??'')=="empresa"): ?>display: none;<?php endif; ?>">
            <div class="form-group "  >
                <div style="margin-top: 7px;">
                    <label class="control-label"><?php echo Form::checkbox('a005_ind_fornecedor', 1,  (($empresa->a005_ind_fornecedor??"0") == 1) || (($tipo??"")=="fornecedor") ?  true : false, ['id' => 'a005_ind_fornecedor','class'=>'control-label','autocomplete' => 'off']); ?> Fornecedor</label>&ensp;
                </div>
            </div>
        </div>
        <!-- <div class="col-md-2">
            <div class="form-group " >
                <div style="margin-top: 7px;">
                    <label class="control-label"><?php echo Form::checkbox('a005_ind_estrangeiro', 1,  ($empresa->a005_ind_estrangeiro??"0") == 1 ?  true : false, ['id' => 'a005_ind_estrangeiro','class'=>'control-label jValidaDonoCadastro','autocomplete' => 'off']); ?> Estrangeiro</label>&ensp;
                </div>
            </div>
        </div> -->
        <?php echo Form::hidden('a005_ind_estrangeiro', '0', ['id'=>'a005_ind_estrangeiro','class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'1']); ?>

    </div>
    <div class="row">
        <div class="col-md-4 jTipoCliente" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a005_tipo_cliente') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_tipo_cliente', 'Tipo', ['class' => 'control-label']); ?>

                <?php if(isset($hide_header_buttons)): ?>
                    <?php echo Form::select('a005_tipo_cliente',$comboTipo_cliente,null,array('class' => 'form-control select2','id'=>'a005_tipo_cliente', 'autocomplete' => 'off')); ?>

                <?php else: ?>
                    <?php echo Form::select('a005_tipo_cliente',$comboTipo_cliente,null,array('class' => 'form-control select2 jValidaDonoCadastro','id'=>'a005_tipo_cliente', 'autocomplete' => 'off')); ?>

                <?php endif; ?>
                <?php echo $errors->first('a005_tipo_cliente', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

        <?php echo Form::hidden('a005_tipo_empresa', 'M', ['id'=>'a005_tipo_empresa','class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'1']); ?>


        <!-- <div class="col-md-4 jTipoEmpresa jTipoMatriz" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a005_tipo_empresa') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_tipo_empresa', 'Tipo Empresa', ['class' => 'control-label']); ?>

                <?php echo Form::select('a005_tipo_empresa',$comboTipo_empresa,null,array('class' => 'form-control select2 jValidaDonoCadastro','id'=>'a005_tipo_empresa', 'autocomplete' => 'off')); ?>

                <?php echo $errors->first('a005_tipo_empresa', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div> -->

        <div class="col-md-4 jTipoEmpresa jTipoFilial" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a005_id_empresa_matriz') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_id_empresa_matriz', 'Empresa Matriz', ['class' => 'control-label']); ?>

                <?php echo Form::select('a005_id_empresa_matriz',$comboEmpresaPai??[],null,array('class' => 'form-control select2 jValidaDonoCadastro','id'=>'a005_id_empresa_matriz','autocomplete' => 'off')); ?>

                <?php echo $errors->first('a005_id_empresa_matriz', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>



    </div>
    <div class="row">
        <div class="col-md-4 jCodIdentificacao" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a005_cod_identificacao') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_cod_identificacao', 'Identificação', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_cod_identificacao', null, ['class' => 'form-control jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'20']); ?>

                <?php echo $errors->first('a005_cod_identificacao', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4 jFisico jNaoEstrangeiro" style="display: none;">
            <div class="form-group box_cpfvalido <?php echo e($errors->has('a005_cpf') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_cpf', 'CPF', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_cpf', null, ['class' => 'form-control cpfMask cpfvalido buscaexistente jValidaDonoCadastro','autocomplete' => 'off']); ?>

                <?php echo Form::hidden('a005_cpf_edit', $empresa->a005_cpf??"", ['id'=>'a005_cpf_edit','class' => 'form-control cpfMask','autocomplete' => 'off']); ?>

                <?php echo $errors->first('a005_cpf', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors erro_cpf"></div>
            </div>
        </div>
        <div class="col-md-8 jFisico jNomeCompleto" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a005_nome_completo') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_nome_completo', 'Nome Completo', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_nome_completo', null, ['class' => 'form-control jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'50']); ?>

                <?php echo $errors->first('a005_nome_completo', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-4 jJuridico jNaoEstrangeiro" style="display: none;">
            <div class="form-group box_cnpjvalido <?php echo e($errors->has('a005_cnpj') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_cnpj', 'CNPJ', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_cnpj', null, ['class' => 'form-control cnpjMask cnpjvalido buscaexistente jValidaDonoCadastro','autocomplete' => 'off']); ?>

                <?php echo Form::hidden('a005_cnpj_edit', $empresa->a005_cnpj??"", ['id'=>'a005_cnpj_edit','class' => 'form-control cnpjMask','autocomplete' => 'off']); ?>

                <?php echo $errors->first('a005_cnpj', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors erro_cnpj"></div>
            </div>
        </div>
        <div class="col-md-8 jJuridico jNaoEstrangeiro" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a005_razao_social') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_razao_social', 'Razão Social', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_razao_social', null, ['class' => 'form-control jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'100']); ?>

                <?php echo $errors->first('a005_razao_social', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4 jJuridico jNaoEstrangeiro" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a005_nome_fantasia') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_nome_fantasia', 'Nome Fantasia', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_nome_fantasia', null, ['class' => 'form-control jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'100']); ?>

                <?php echo $errors->first('a005_nome_fantasia', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4 jJuridico jNaoEstrangeiro" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a005_ie') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_ie', 'IE', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_ie', null, ['class' => 'form-control numeroMask jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'20']); ?>

                <?php echo $errors->first('a005_ie', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4 jJuridico jNaoEstrangeiro" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a005_im') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_im', 'IM', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_im', null, ['class' => 'form-control numeroMask jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'20']); ?>

                <?php echo $errors->first('a005_im', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="form-group box_emailvalido <?php echo e($errors->has('a005_email') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_email', 'E-mail', ['class' => 'control-label']); ?>

                <?php if(isset($hide_header_buttons)): ?>
                    <?php echo Form::text('a005_email', null, ['class' => 'form-control jValidaDonoCadastro', 'columnname'=>'a001_email', 'tablename'=>'t001_usuario' ,'pknametable'=>'a001_id_usuario', 'pkVal'=>($empresa->a001_id_usuario??0),'autocomplete' => 'off', 'maxlength'=>'50']); ?>

                <?php else: ?>
                    <?php echo Form::text('a005_email', null, ['class' => 'form-control emailvalido jValidaDonoCadastro', 'columnname'=>'a001_email', 'tablename'=>'t001_usuario' ,'pknametable'=>'a001_id_usuario', 'pkVal'=>($empresa->a001_id_usuario??0),'autocomplete' => 'off',  'maxlength'=>'50']); ?>

                <?php endif; ?>
                <?php echo Form::hidden('a005_email_original', $empresa->a005_email??'', ['id' => 'a005_email_original','class' => 'form-control','autocomplete' => 'off']); ?>

                <?php echo $errors->first('a005_email', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors erro_email"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group <?php echo e($errors->has('a005_fone') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_fone', 'Telefone', ['class' => 'control-label']); ?>

                <?php if(isset($hide_header_buttons)): ?>
                    <?php echo Form::text('a005_fone', null, ['class' => 'form-control foneddd','autocomplete' => 'off']); ?>

                <?php else: ?>
                    <?php echo Form::text('a005_fone', null, ['class' => 'form-control foneddd ','autocomplete' => 'off', 'required' => 'required']); ?>

                <?php endif; ?>
                <?php echo Form::text('a005_foneSemMask', null, ['class' => 'form-control numeroMask jValidaDonoCadastro','autocomplete' => 'off', 'id'=>'a005_foneSemMask', "style"=>"display:none;"]); ?>

                <?php echo $errors->first('a005_fone', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>


        <div class="col-md-4 jcep">
            <div class="form-group <?php echo e($errors->has('a005_cep') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_cep', 'CEP', ['class' => 'control-label']); ?>

                <?php if(isset($hide_header_buttons)): ?>
                    <?php echo Form::text('a005_cep', null, ['class' => 'form-control cepMask jcampoCep','autocomplete' => 'off']); ?>

                <?php else: ?>
                    <?php echo Form::text('a005_cep', null, ['class' => 'form-control cepMask jcampoCep jValidaDonoCadastro','autocomplete' => 'off', 'required' => 'required']); ?>

                <?php endif; ?>
                <?php echo $errors->first('a005_cep', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-6 jendereco">
            <div class="form-group <?php echo e($errors->has('a005_endereco') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_endereco', 'Endereço', ['class' => 'control-label']); ?>

                <?php if(isset($hide_header_buttons)): ?>
                    <?php echo Form::text('a005_endereco', null, ['class' => 'form-control jcampoEndereco jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'300']); ?>

                <?php else: ?>
                    <?php echo Form::text('a005_endereco', null, ['class' => 'form-control jcampoEndereco jValidaDonoCadastro','autocomplete' => 'off',  'maxlength'=>'300']); ?>

                <?php endif; ?>
                <?php echo $errors->first('a005_endereco', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group <?php echo e($errors->has('a005_numero_end') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_numero_end', 'Número', ['class' => 'control-label']); ?>

                <?php if(isset($hide_header_buttons)): ?>
                    <?php echo Form::text('a005_numero_end', null, ['class' => 'form-control jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'30']); ?>

                <?php else: ?>
                    <?php echo Form::text('a005_numero_end', null, ['class' => 'form-control jValidaDonoCadastro','autocomplete' => 'off',  'maxlength'=>'30']); ?>

                <?php endif; ?>
                <?php echo $errors->first('a005_numero_end', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group <?php echo e($errors->has('a005_complemento_end') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_complemento_end', 'Complemento', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_complemento_end', null, ['class' => 'form-control jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'50']); ?>

                <?php echo $errors->first('a005_complemento_end', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group <?php echo e($errors->has('a005_bairro') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_bairro', 'Bairro', ['class' => 'control-label']); ?>

                <?php if(isset($hide_header_buttons)): ?>
                    <?php echo Form::text('a005_bairro', null, ['class' => 'form-control jcampoBairro jValidaDonoCadastro','autocomplete' => 'off', 'maxlength'=>'200']); ?>

                <?php else: ?>
                    <?php echo Form::text('a005_bairro', null, ['class' => 'form-control jcampoBairro jValidaDonoCadastro','autocomplete' => 'off',  'maxlength'=>'200']); ?>

                <?php endif; ?>
                <?php echo $errors->first('a005_bairro', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-3 jcidadeestrangeiro" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a047_id_cidade') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a047_id_cidade', 'Cidade', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_nome_cidade', null, ['class' => 'form-control jValidaDonoCadastro','id'=>'a005_nome_cidade','autocomplete' => 'off', 'maxlength'=>'50', 'style'=>'']); ?>

                <?php echo $errors->first('a047_id_cidade', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>


        <div class="col-md-3 jcidadenacional">
            <div class="form-group <?php echo e($errors->has('a047_id_cidade') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a047_id_cidade', 'Cidade', ['class' => 'control-label']); ?>

                <?php echo Form::select('a047_id_cidade',$comboCidade??[],null,array('class' => 'form-control select2 jcampoCidade jValidaDonoCadastro','id'=>'a047_id_cidade', 'autocomplete' => 'off')); ?>

                <?php echo $errors->first('a047_id_cidade', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-3 jcidadeestrangeiro" style="display: none;">
            <div class="form-group <?php echo e($errors->has('a048_id_estado') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a048_id_estado', 'Estado', ['class' => 'control-label']); ?>

                <?php echo Form::text('a005_nome_estado', null, ['class' => 'form-control jValidaDonoCadastro','id'=>'a005_nome_estado','autocomplete' => 'off', 'maxlength'=>'50', 'style'=>'']); ?>

                <?php echo $errors->first('a048_id_estado', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-3 jcidadenacional">
            <div class="form-group <?php echo e($errors->has('a048_id_estado') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a048_id_estado', 'Estado', ['class' => 'control-label']); ?>

                <?php echo Form::select('a048_id_estado',$comboEstado??[],null,array('class' => 'form-control select2 jcampoEstado jValidaDonoCadastro','id'=>'a048_id_estado', 'autocomplete' => 'off')); ?>

                <?php echo $errors->first('a048_id_estado', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- <div class="col-md-2 divStatus">
            <div class="form-group " >
                <label class="control-label">Status </label>
                <div style="margin-top: 7px;">

                    <label class="control-label"><?php echo Form::checkbox('a005_status', 1,  ($empresa->a005_status??"1") == 1 ?  true : false, ['id' => 'a005_status','class'=>'control-label jValidaDonoCadastro']); ?> Ativo</label>&ensp;
                </div>
            </div>
        </div> -->

        <!-- <div class="col-md-4">
            <div class="form-group <?php echo e($errors->has('a005_logo') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_logo', 'Logo', ['class' => 'control-label']); ?>

                <div class=" ">
                    <?php echo Form::file('a005_logo', ['class' => 'a005_logo jInputFileUploadImg jValidaDonoCadastro', 'id'=>'a005_logo',"multiple"=>"multiple"]); ?>

                </div>
                <?php echo $errors->first('a005_logo', '<p class="help-block">:message</p>'); ?>

            </div>
        </div> -->

        <!-- <div class="col-md-3">
            <div class="form-group ">
                <img id="imagemEmpresa" class="jImagemExibirUpload" src="<?php echo ($empresa->a005_logo??"") != "" ? url('storage/'.@$empresa->a005_logo) : asset('/img/sem-image.jpg'); ?>" style="max-height: 250px; max-width: 250px;">
                <div class="help-block with-errors"></div>
            </div>
        </div> -->

    </div>
</div>
<?php if(isset($hide_header_buttons)): ?>
</form>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/empresa/formGeral.blade.php ENDPATH**/ ?>