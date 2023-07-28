<?php
    $page_title = "Meus Dados";
    $page_description = "";
?>



<?php $__env->startSection('title', $page_title); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="box">

        <?php echo Form::model($usuario, [
            'method' => 'PATCH',
            'url' => ['usuario', $usuario->a001_id_usuario],
            'class' => 'form form-usuario EspacoTopo',
            'data-toggle' => 'validator',
            'files' => true
        ]); ?>

        <?php echo Form::hidden('meusdados', 1, ['class' => 'meusdados', 'id' => 'meusdados']); ?>

        <?php echo $__env->make('sistema.usuario.form', ['submitButtonText' => 'Salvar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo Form::close(); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style>

    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {
            $('.form').validator('validate')
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/sistema/usuario/meusDados.blade.php ENDPATH**/ ?>