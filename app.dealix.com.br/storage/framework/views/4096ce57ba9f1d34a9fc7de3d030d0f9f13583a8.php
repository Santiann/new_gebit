<?php
    $page_title = "Tipo de Vencimento";
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
                <?php if (\Entrust::can('tipo_vencimento-create')) : ?>
                    <a href="<?php echo e(url('/tipo_vencimento/create')); ?>" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar <?php echo e($page_title ?? "Page Title"); ?></a>
                <?php endif; // Entrust::can ?>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                <thead>
                    <th width="80px">Código</th>
					<th>Empresa</th>
					<th>Descrição</th>
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
            ajax: '<?php echo route('tipo_vencimento.data'); ?>',
            columns: [
            	{ data: 'a012_id_tipo_vencimento', name: 'a012_id_tipo_vencimento' },
                { data: 'nomeEmpresa', name: 'nomeEmpresa', visible: JSON.parse("<?php echo e((count($comboEmpresa)??0) == 1 ?'false' : 'true'); ?>") },
				{ data: 'a012_descricao', name: 'a012_descricao' },
				{ data: 'a012_status', name: 'a012_status' },
				{ data: 'action', name: 'action' }
            ],
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/sistema/tipo_vencimento/index.blade.php ENDPATH**/ ?>