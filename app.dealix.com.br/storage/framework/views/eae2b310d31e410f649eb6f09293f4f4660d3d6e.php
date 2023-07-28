<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>

<div class="jEmpPerfil">

    <div class="row">
        <div class="box1 col-md-12">
            <div class="form-group multiple <?php echo e($errors->has('a005_id_empresa') ? 'has-error' : ''); ?>">
                <?php echo Form::select('a005_id_empresa[]', $empresa??[], null, array('class' => 'form-control jSelectListEmpresa','id'=>'a005_id_empresa','size'=>'7','required' => 'required','multiple' => 'multiple','autocomplete' => 'off')); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
        <!-- https://www.virtuosoft.eu/code/bootstrap-duallistbox/  EXEMPLO-->
    </div>

    <div class="row">
        <div class="box1 col-md-12">
            <div class="form-group multiple <?php echo e($errors->has('role_id') ? 'has-error' : ''); ?>">
                <?php echo Form::select('role_id[]', $role??[], null, array('class' => 'form-control jSelectListPerfil','id'=>'role_id','size'=>'7','required' => 'required','multiple' => 'multiple','autocomplete' => 'off')); ?>

                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\app\resources\views/sistema/usuario/formEmpresa.blade.php ENDPATH**/ ?>