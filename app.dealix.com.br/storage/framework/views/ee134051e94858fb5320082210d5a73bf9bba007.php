<?php
    $page_title = "Contrato";
    $page_description = "Novo";
?>



<?php $__env->startSection('title', $page_title); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="box">

    <?php echo Form::open(['url' => '/new_gebit/app.dealix.com.br/contrato/create', 'class' => 'form form-contrato EspacoTopo', 'files' => true]); ?>


    <?php echo $__env->make('sistema.contrato.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo Form::close(); ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/contrato/create.blade.php ENDPATH**/ ?>