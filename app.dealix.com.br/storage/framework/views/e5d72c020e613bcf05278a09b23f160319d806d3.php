<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>

<div class="jCatagoria">

    <div class="row">
        <div class="col-md-4" style="<?php echo e((count($comboEmpresa)??0) == 1 ? "display: none;" : ""); ?>">
            <div class="form-group <?php echo e($errors->has('a005_id_empresa') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a005_id_empresa', 'Empresa', ['class' => 'control-label']); ?>

                <?php if(!isset($hide_header_buttons)): ?>
                    <?php echo Form::select('a005_id_empresa',$comboEmpresa,0,array('class' => 'form-control select2 ','id'=>'a005_id_empresa', 'required' => 'required','autocomplete' => 'off')); ?>

                <?php else: ?>
                    <?php echo Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa_categoria', 'autocomplete' => 'off')); ?>

                <?php endif; ?>
                <?php echo $errors->first('a005_id_empresa', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>

            </div>
        </div>
        <div class=" <?php echo e((count($comboEmpresa)??0) == 1 ? "col-md-11" : "col-md-7"); ?>">
            <div class="form-group <?php echo e($errors->has('a008_descricao') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a008_descricao', 'Descrição', ['class' => 'control-label']); ?>

                <?php if(!isset($hide_header_buttons)): ?>
                    <?php echo Form::text('a008_descricao', null, ['class' => 'form-control validaunico', 'tablename'=>'t008_categoria_contrato' ,'pknametable'=>'a008_id_cat_contrato', 'pkVal'=>($categoria_contrato->a008_id_cat_contrato??0),'autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'300']); ?>

                <?php else: ?>
                    <?php echo Form::text('a008_descricao', null, ['class' => 'form-control', 'tablename'=>'t008_categoria_contrato' ,'pknametable'=>'a008_id_cat_contrato', 'pkVal'=>($categoria_contrato->a008_id_cat_contrato??0),'autocomplete' => 'off', 'maxlength'=>'300']); ?>

                <?php endif; ?>
                <?php echo $errors->first('a008_descricao', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group ">
                <label class="control-label">Status </label>
                <div style="margin-top: 7px;">
                    <label class="control-label"><?php echo Form::checkbox('a008_status', 1,  ($categoria_contrato->a008_status??"1") == 1 ?  true : false, ['id' => 'a008_status','class'=>'control-label','autocomplete' => 'off']); ?> Ativo</label>&ensp;
                </div>
            </div>
        </div>
    </div>
    <?php if(!isset($hide_header_buttons)): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group <?php echo e($errors->has('a008_termo_cancelamento') ? 'has-error' : ''); ?>">
                <?php echo Form::label('a008_termo_cancelamento', 'Termo de Cancelamento', ['class' => 'control-label']); ?>

                <?php echo Form::textarea('a008_termo_cancelamento', null, ['class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'1000','size' => '10x4']); ?>

                <?php echo $errors->first('a008_termo_cancelamento', '<p class="help-block">:message</p>'); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>


<?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/categoria_contrato/formGeral.blade.php ENDPATH**/ ?>