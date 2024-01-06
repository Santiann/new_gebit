<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>

<div class="jUsuario">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group <?php echo e($errors->has('a001_nome') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_nome', 'Nome', ['class' => 'control-label']); ?>

                <?php echo Form::text('a001_nome', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'50']); ?>

                <?php echo $errors->first('a001_nome', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group <?php echo e($errors->has('a001_cpf') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_cpf', 'CPF', ['class' => 'control-label']); ?>

                <?php echo Form::text('a001_cpf', null, ['class' => 'form-control cpfMask cpfvalido', 'tablename'=>'t001_usuario' ,'pknametable'=>'a001_id_usuario', 'pkVal'=>($usuario->a001_id_usuario??0),'autocomplete' => 'off']); ?>

                <?php echo $errors->first('a001_cpf', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group <?php echo e($errors->has('a001_email') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_email', 'E-mail', ['class' => 'control-label']); ?>

                <?php if(isset($usuario->a001_email)): ?>
                    <?php echo Form::text('a001_email', null, ['class' => 'form-control validaunico', 'tablename'=>'t001_usuario' ,'pknametable'=>'a001_id_usuario', 'pkVal'=>($usuario->a001_id_usuario??0),'autocomplete' => 'off', 'required' => 'required', 'readonly' => 'true', 'maxlength'=>'50']); ?>

                <?php else: ?>
                    <?php echo Form::text('a001_email', null, ['class' => 'form-control validaunico', 'tablename'=>'t001_usuario' ,'pknametable'=>'a001_id_usuario', 'pkVal'=>($usuario->a001_id_usuario??0),'autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'50']); ?>

                <?php endif; ?>
                <?php echo $errors->first('a001_email', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="form-group <?php echo e($errors->has('a001_telefone') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_telefone', 'Telefone', ['class' => 'control-label']); ?>

                <?php echo Form::text('a001_telefone', null, ['class' => 'form-control foneddd','autocomplete' => 'off', 'required' => 'required']); ?>

                <?php echo $errors->first('a001_telefone', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group <?php echo e($errors->has('a001_cargo') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_cargo', 'Cargo', ['class' => 'control-label']); ?>

                <?php echo Form::text('a001_cargo', null, ['class' => 'form-control','autocomplete' => 'off',  'maxlength'=>'150']); ?>

                <?php echo $errors->first('a001_cargo', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group <?php echo e($errors->has('a001_cep') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_cep', 'CEP', ['class' => 'control-label']); ?>

                <?php echo Form::text('a001_cep', null, ['class' => 'form-control cepMask jcampoCep','autocomplete' => 'off', 'required' => 'required']); ?>

                <?php echo $errors->first('a001_cep', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="form-group <?php echo e($errors->has('a001_endereco') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_endereco', 'Endereço', ['class' => 'control-label']); ?>

                <?php echo Form::text('a001_endereco', null, ['class' => 'form-control jcampoEndereco','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'300']); ?>

                <?php echo $errors->first('a001_endereco', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group <?php echo e($errors->has('a001_numero_end') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_numero_end', 'Número', ['class' => 'control-label']); ?>

                <?php echo Form::text('a001_numero_end', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'30']); ?>

                <?php echo $errors->first('a001_numero_end', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group <?php echo e($errors->has('a001_complemento') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_complemento', 'Complemento', ['class' => 'control-label']); ?>

                <?php echo Form::text('a001_complemento', null, ['class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'50']); ?>

                <?php echo $errors->first('a001_complemento', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group <?php echo e($errors->has('a048_id_estado') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a048_id_estado', 'Estado', ['class' => 'control-label']); ?>

                <?php echo Form::select('a048_id_estado',$comboEstado??[],null,array('class' => 'form-control select2 jcampoEstado','id'=>'a048_id_estado', 'required' => 'required','autocomplete' => 'off')); ?>

                <?php echo $errors->first('a048_id_estado', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group <?php echo e($errors->has('a047_id_cidade') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a047_id_cidade', 'Cidade', ['class' => 'control-label']); ?>

                <?php echo Form::select('a047_id_cidade',$comboCidade??[],null,array('class' => 'form-control select2 jcampoCidade','id'=>'a047_id_cidade', 'required' => 'required','autocomplete' => 'off')); ?>

                <?php echo $errors->first('a047_id_cidade', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group <?php echo e($errors->has('a001_bairro') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_bairro', 'Bairro', ['class' => 'control-label']); ?>

                <?php echo Form::text('a001_bairro', null, ['class' => 'form-control jcampoBairro','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'150']); ?>

                <?php echo $errors->first('a001_bairro', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-1">
            <div class="form-group ">
                <label class="control-label">Status </label>
                <div style="margin-top: 7px;">
                    <label
                        class="control-label"><?php echo Form::checkbox('a001_status', 1,  ($usuario->a001_status??"1") == 1 ?  true : false, ['id' => 'a001_status','class'=>'control-label','autocomplete' => 'off']); ?>

                        Ativo</label>&ensp;
                </div>
            </div>
        </div>
    </div>
    <br>
    <h3>Alterar senha</h3>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                <?php echo Form::label('password', 'Senha atual', ['class' => 'control-label']); ?>

                <?php echo Form::password('password', ['class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'150']); ?>

                <?php echo $errors->first('password', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group <?php echo e($errors->has('new_password') ? 'has-error' : ''); ?>">
                <?php echo Form::label('new_password', 'Nova senha', ['class' => 'control-label']); ?>

                <?php echo Form::password('new_password', ['class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'150']); ?>

                <?php echo $errors->first('new_password', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group <?php echo e($errors->has('confirm_new_password') ? 'has-error' : ''); ?>">
                <?php echo Form::label('confirm_new_password', 'Confirme a nova senha', ['class' => 'control-label']); ?>

                <?php echo Form::password('confirm_new_password', ['class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'150']); ?>

                <?php echo $errors->first('confirm_new_password', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <h5>A nova senha deve conter pelo menos 8 caracteres, com maiúsculas, minúsculas, letras, números e caracteres especiais.<h5>
    <br>
    <div class="row">

        <div class="col-md-4">
            <div class="form-group <?php echo e($errors->has('a001_foto') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a001_foto', 'Upload de Foto', ['class' => 'control-label']); ?>

                <div class=" ">
                    <?php echo Form::file('a001_foto', ['class' => 'a001_foto jInputFileUploadImg', 'id'=>'a001_foto']); ?>

                </div>
                <?php echo $errors->first('a001_foto', '<p class="help-block">:message</p>'); ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group ">
                <img src="<?php echo e(($usuario->a001_foto??"") != "" ? url('storage/'.@$usuario->a001_foto) : asset('/img/sem-foto.jpg')); ?>" class="jImagemExibirUpload" style="max-height: 250px; max-width: 250px;">
                <div class="help-block with-errors"></div>
            </div>
        </div>

    </div>


</div>
<?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/usuario/formGeral.blade.php ENDPATH**/ ?>