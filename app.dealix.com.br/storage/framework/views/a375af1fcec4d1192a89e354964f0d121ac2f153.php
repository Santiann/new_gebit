<?php if(!isset($hide_header_buttons)): ?>
<div class="box-footer BotesFixoTopo">
    <a href="<?php echo e(url('/area_contrato')); ?>" class="btn btn-default">
       <i class="fa fa-ban"></i> Cancelar
    </a>
    <button type="submit" class="btn bg-olive pull-right">
       <i class="fa fa-save"></i> <?php echo e(isset($submitButtonText) ? $submitButtonText : 'Salvar'); ?>

    </button>
</div>
<?php endif; ?>

<div class="box-body">
<div class="row">
    <div class="col-md-4" style="<?php echo e((count($comboEmpresa)??0) == 1 ? "display: none;" : ""); ?>">
        <div class="form-group <?php echo e($errors->has('a005_id_empresa') ? 'has-error' : ''); ?>">
            <?php echo Form::label('a005_id_empresa', 'Empresa', ['class' => 'control-label']); ?>

            <?php if(!isset($hide_header_buttons)): ?>
                <?php echo Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa', 'required' => 'required','autocomplete' => 'off')); ?>

            <?php else: ?>
                <?php echo Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa_area','autocomplete' => 'off')); ?>

            <?php endif; ?>
            <?php echo $errors->first('a005_id_empresa', '<p class="help-block">:message</p>'); ?>

            <div class="help-block with-errors"></div>

        </div>
    </div>
    <div class=" <?php echo e((count($comboEmpresa)??0) == 1 ? "col-md-11" : "col-md-7"); ?>">
        <div class="form-group <?php echo e($errors->has('a011_descricao') ? 'has-error' : ''); ?>">
            <?php echo Form::label('a011_descricao', 'Descrição', ['class' => 'control-label']); ?>

            <?php if(!isset($hide_header_buttons)): ?>
                <?php echo Form::text('a011_descricao', null, ['class' => 'form-control validaunico', 'tablename'=>'t011_area_contrato' ,'pknametable'=>'a011_id_area', 'pkVal'=>($area_contrato->a011_id_area??0),'autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'300']); ?>

            <?php else: ?>
                <?php echo Form::text('a011_descricao', null, ['class' => 'form-control', 'tablename'=>'t011_area_contrato' ,'pknametable'=>'a011_id_area', 'pkVal'=>($area_contrato->a011_id_area??0),'autocomplete' => 'off', 'maxlength'=>'300']); ?>

            <?php endif; ?>
            <?php echo $errors->first('a011_descricao', '<p class="help-block">:message</p>'); ?>

            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group ">
            <label class="control-label">Status </label>
            <div style="margin-top: 7px;">
                <label class="control-label"><?php echo Form::checkbox('a011_status', 1,  ($area_contrato->a011_status??"1") == 1 ?  true : false, ['id' => 'a011_status','class'=>'control-label','autocomplete' => 'off']); ?> Ativo</label>&ensp;
            </div>
        </div>
    </div>

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
            $('.select2').select2({
                language: 'pt-BR'
            });
            $(".validaunico").blur(function () {
                //validaCampoUnicoExistente(this);
            });
        });
	</script>
<?php $__env->stopPush(); ?>


<?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/area_contrato/form.blade.php ENDPATH**/ ?>