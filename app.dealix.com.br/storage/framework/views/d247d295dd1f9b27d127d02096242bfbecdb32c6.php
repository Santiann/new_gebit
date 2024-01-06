<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>
<input name="id_documento_del" id="id_documento_del" type="hidden" value="0" >
<?php if(isset($documentos)): ?>
<h3>Contrato</h3>
<div class="row divAddDivsDocumento">

</div>
<hr>
<?php endif; ?>
<h3>Outros documentos</h3>
<div class="outrosDoc">
    <input hidden name="a014_id_outros_doc_delete" />
    <?php if(isset($documentos)): ?>
    <?php $__currentLoopData = $documentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $documento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div data-id="<?php echo e($documento->a014_id_documento); ?>" class="row doc-row">
        <div class="col-md-6"> 
            <div class="form-group has-error has-danger"> 
                <label class="control-label" style="width: 100%;">Documento:</label> 
                <a href="/storage/app/public<?php echo e($documento->a014_documento); ?>" download>Baixar arquivo</a>
                <div onclick='deleteDoc(<?php echo e($documento->a014_id_documento); ?>)' class="btn btn-xs btn-danger ml-5"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
                <div class="help-block with-errors"></div> 
            </div> 
        </div> 
        <div class="col-md-2"> 
            <div class="form-group"> 
                <label for="a014_outro_doc_obs<?php echo e($documento->a014_id_documento); ?>" class="control-label">Observação</label> 
                <input class="form-control" id="a014_outro_doc_obs<?php echo e($documento->a014_id_documento); ?>" name="a014_outro_doc_obs[<?php echo e($documento->a014_id_documento); ?>]" type="text" value="<?php echo e($documento->a014_obs); ?>" maxlength="500" required> 
                <div class="help-block with-errors"></div> 
            </div> 
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<div class="row">
    <div class="col-md-6"> 
        <div class="btn btn-success" onclick="novoDoc()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Novo documento
        </div>
    </div>
</div>

<!-- Novo documento -->
<div class="row novoDoc d-none">
    <div class="col-md-2" style="overflow:hidden;"> 
        <div class="form-group has-error has-danger"> 
            <label class="control-label" style="width: 100%;">Novo documento:</label> 
            <input style="width: -moz-available;" name="a014_outro_doc[]" disabled type="file" />
            <div class="help-block with-errors"></div> 
        </div> 
    </div> 
    <div class="col-md-10"> 
            <div class="form-group"> 
            <label class="control-label">Observação</label> 
            <input class="form-control" disabled name="a014_outro_doc_obs[]" type="text" maxlength="500"> 
            <div class="help-block with-errors"></div> 
        </div> 
    </div>
</div>

<?php $__env->startPush('js'); ?>
<script>
    let id_outros_doc_delete = [];
    let id_new_doc = 0;

    function novoDoc()
    {
        let fields = $('.novoDoc:last');
        let new_fields = fields.clone();

        new_fields.removeClass('d-none');
        new_fields.appendTo('.outrosDoc');

        let last_field_inputs = $('.outrosDoc .novoDoc:last input');
        last_field_inputs.prop('disabled', false);
        
        last_field_inputs.eq(0).attr('name', `a014_outro_doc[${id_new_doc}]`)
        last_field_inputs.eq(1).attr('name', `a014_outro_doc_obs[${id_new_doc}]`)

        id_new_doc--;
    }

    function deleteDoc(id)
    {
        id_outros_doc_delete.push(id);
        $('[name="a014_id_outros_doc_delete"]').val(id_outros_doc_delete);

        $(`[data-id="${id}"]`).remove();
    }
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/contrato/formDocumento.blade.php ENDPATH**/ ?>