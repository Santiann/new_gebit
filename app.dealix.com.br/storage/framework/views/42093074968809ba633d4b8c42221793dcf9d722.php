<?php
    $comboUsuario[0]='Sistema';
?>
<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>
<?php if($columnsHistorico??"" != "" && $historico??"" != ""): ?>
    <div class="box-body">
        <table class="display responsive nowrap" style="width:100%" id="tableHistoricoContrato">
            <thead>
                <th class="hidden">id</th>
                <th>Data Alteração</th>
                <th>Usuário</th>
                <th>Campos alterados</th>
                <!-- <?php $__currentLoopData = $columnsHistorico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($attributes[$value]??$value); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
            </thead>
            <tbody>
            <?php $__currentLoopData = $historico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$hist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="hidden"><?php echo e($hist->a016_id_historico); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($hist->a016_data_alteracao)->format('d/m/Y H:i')); ?></td>
                    <td><?php echo e($comboUsuario[$hist->a001_id_usuario]); ?></td>
                    <?php ($log = json_decode($hist->a016_log, true)); ?>

                    <td>
                        <?php if($hist->a016_campos_alterados != ''): ?>
                            <?php ($campos_alterados = json_decode($hist->a016_campos_alterados, true)); ?>
                            
                            <?php $__currentLoopData = $campos_alterados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chave => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($chave != 'updated_at'): ?>
                                <b><?php echo e($attributes[$chave] ?? $chave); ?></b> alterado de <s class="text-danger"><?php echo e($value); ?></s> para 
                                    <span class="text-success">
                                    <?php if(isset($log[$chave])): ?>
                                    <?php echo e($log[$chave]); ?>

                                    <?php endif; ?>
                                    </span> <br>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>
    </div>
<?php endif; ?>



<?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/contrato/formAlteracao.blade.php ENDPATH**/ ?>