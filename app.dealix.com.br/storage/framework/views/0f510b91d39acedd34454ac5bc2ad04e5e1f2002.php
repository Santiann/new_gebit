<?php
    $page_title = "Contrato";
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
                <?php if (\Entrust::can('contrato-create')) : ?>
                <?php if(($indEmpresaEmpresa??0)>0): ?>
                    <a href="<?php echo e(url('/contrato/create')); ?>" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar <?php echo e($page_title ?? "Page Title"); ?></a>
                <?php endif; ?>
                <?php endif; // Entrust::can ?>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                <thead>
					<th>Número Contrato</th>
					<th>Empresa</th>
					<th>Classificação</th>
					<th>Cliente - Fornecedor</th>
					<th>Início</th>
					<th>Fim</th>
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
            ajax: '<?php echo route('contrato.data'); ?>',
            columns: [
            	{ data: 'a013_numero_contrato', name: 'a013_numero_contrato' },
                { data: 'nomeEmpresa', name: 'nomeEmpresa', visible: JSON.parse("<?php echo e((count($comboEmpresa)??0) == 1 ?'false' : 'true'); ?>") },
				{ data: 'classificacao', name: 'classificacao' },
				{ data: 'nomeCliFor', name: 'nomeCliFor' },
				{ data: 'dataInicio', name: 'dataInicio' },
				{ data: 'dataFim', name: 'dataFim' },
				{ data: 'a013_status', name: 'a013_status' },
				{ data: 'action', name: 'action' }
            ],
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
        });
    });


    $('#datatable-table').on('click', '.botaoDuplicar', function () {
        var idcopy = $(this).attr('idcopy');
        duplicarForm(idcopy);
    });

    function duplicarForm(idcopy) {
        $.confirm({
            theme: 'light',
            title: 'ALERTA',
            content: "Deseja duplicar o Contrato?",
            buttons: {
                confirm: {
                    text: 'CONFIRMAR',
                    btnClass: 'btn-success',
                    action: function () {
                        window.location = '/contrato/copy/' + idcopy + '';
                    }
                },
                cancel: {
                    text: 'Cancelar',
                }
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/contrato/index.blade.php ENDPATH**/ ?>