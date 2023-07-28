<?php
    $page_title = "Dashboard";
    $page_description = ".";
    use App\Http\Controllers\DashboardController;
?>





<?php $__env->startSection('content'); ?>

    <div class="page-home mx-auto">

        <?php echo DashboardController::IndicadorContrato(); ?>



        <!-- <?php echo DashboardController::graficoCustoCategoriaContrato(); ?>


        <?php echo DashboardController::graficoCustoTipoContrato(); ?>


        <?php echo DashboardController::IndicadorCotacao(); ?>


        <?php echo DashboardController::graficoCompromisso(); ?> -->

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\app\resources\views/sistema/dashboard/dashboard.blade.php ENDPATH**/ ?>