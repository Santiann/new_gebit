<div class="row justify-content-center">
    <div class="col-lg-2 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo e($contratos["avencer"]??0); ?></h3>
                <p>Contrato Prestes a Renovar </p>
            </div>
            <div class="icon">
                <i class="<?php echo e($icone); ?>"></i>
            </div>
            <a href="/contrato" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-2 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo e($contratos["ativo"]??0); ?></h3>
                <p>Contratos Vigentes</p>
            </div>
            <div class="icon">
                <i class="<?php echo e($icone); ?>"></i>
            </div>
            <a href="/contrato" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-2 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo e($contratos["vencido"]??0); ?></h3>
                <p>Contratos Expirados </p>
            </div>
            <div class="icon">
                <i class="<?php echo e($icone); ?>"></i>
            </div>
            <a href="/contrato" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-2 col-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo e($contratos["vencido"]??0); ?></h3>
                <p>Pendências Documentais </p>
            </div>
            <div class="icon">
                <i class="<?php echo e($icone); ?>"></i>
            </div>
            <a href="/contrato" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-2 col-4">
        <div class="small-box bg-white">
            <div class="inner">
                <h3><?php echo e($contratos["pendencias_finan"]??0); ?></h3>
                <p>Pendências Financeiras </p>
            </div>
            <div class="icon">
                <i class="<?php echo e($icone); ?>"></i>
            </div>
            <a href="/contrato" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-2 col-4">
        <div class="small-box bg-gray">
            <div class="inner">
                <h3><?php echo e($contratos["pendencias"]??0); ?></h3>
                <p>Pendências em aberto </p>
            </div>
            <div class="icon">
                <i class="<?php echo e($icone); ?>"></i>
            </div>
            <a href="<?php echo e(route('pendencias_contrato.index')); ?>" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/dashboard/indicadorContrato.blade.php ENDPATH**/ ?>