<?php
    $page_title = "Usuário";
    $page_description = "Listagem";
?>




<?php $__env->startSection('title', $page_title); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(Session::has('flash_message')): ?>
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong><?php echo Session::get('flash_message'); ?></strong>
        </div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <div class="box-tools">
                <?php if (\Entrust::can('usuario-create')) : ?>
                <a href="<?php echo e(url('usuario/create')); ?>" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar <?php echo e($page_title ?? "Page Title"); ?></a>
                <?php endif; // Entrust::can ?>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                <thead>
                <th width="80px">Código</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Status</th>
                <th width="80px">Ações</th>
                </thead>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('css'); ?>


<?php $__env->stopPush(); ?>


<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function() {
            $('#datatable-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "pageLength": 100,
                fixedHeader: {
                    header: true,
                    footer: false
                },
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                ajax: '<?php echo route('usuario.data'); ?>',
                columns: [
                    { data: 'a001_id_usuario', name: 't001_usuario.a001_id_usuario' },
                    { data: 'a001_nome', name: 't001_usuario.a001_nome' },
                    { data: 'a001_email', name: 't001_usuario.a001_email' },
                    { data: 'a001_cpf', name: 'a001_cpf' },
                    { data: 'a001_status', name: 'a001_status' },
                    { data: 'action', name: 'action' }
                ],
                "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\app\resources\views/sistema/usuario/index.blade.php ENDPATH**/ ?>