<?php
    $page_title = "Perfil de Acesso";
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
                <?php if (\Entrust::can('roles-create')) : ?>
                <a href="<?php echo e(url('/role/create')); ?>" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar <?php echo e($page_title); ?></a>
                <?php endif; // Entrust::can ?>

            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                <thead>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Status</th>
                <th width="120px">Ações</th>
                </thead>
            </table>

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('css'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


    <script>
        $(document).ready(function() {
            $('#datatable-table').DataTable({

                fixedHeader: {
                    header: true,
                    /*headerOffset: 83,*/
                    footer: false
                },

                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                processing: true,
                serverSide: true,
                responsive: true,

                "pageLength": 100,
                ajax: '<?php echo route('role.data'); ?>',
                "order": [[0, "asc"],[2, "asc"],[1, "asc"]],
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'status', name: 'status'},
                    { data: 'action', name: 'action', orderable: false, searchable: false  }
                ],
                "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\app\resources\views/sistema/role/index.blade.php ENDPATH**/ ?>