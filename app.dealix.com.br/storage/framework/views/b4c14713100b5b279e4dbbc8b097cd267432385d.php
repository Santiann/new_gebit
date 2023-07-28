<div class="col-lg-3 col-6">
    <div class="small-box bg-gray">
        <div class="inner">
            <h3><?php echo e($cotacao["total"]??0); ?></h3>
            <p>Total Cotações/Orçamentos </p>
        </div>
        <div class="icon">
            <i class="<?php echo e($iconeCotacao); ?>"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo e($cotacao["cotacaoPendente"]??0); ?></h3>
            <p>Cotação Pendentes</p>
        </div>
        <div class="icon">
            <i class="<?php echo e($iconeCotacao); ?>"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo e($cotacao["orcamentoPendente"]??0); ?></h3>
            <p>Orçamento Pendentes</p>
        </div>
        <div class="icon">
            <i class="<?php echo e($iconeOrcamento); ?>"></i>
        </div>
        <a href="/orcamento" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3 col-6" >
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo e($cotacao["finalizadoMes"]??0); ?></h3>
            <p>Últimas  Cotações (mês)</p>
        </div>
        <div class="icon">
            <i class="<?php echo e($iconeCotacao); ?>"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo e($cotacao["cancelado"]??0); ?></h3>
            <p>Orçamento Sem Aprovação/Cancelado</p>
        </div>
        <div class="icon">
            <i class="<?php echo e($iconeOrcamento); ?>"></i>
        </div>
        <a href="/orcamento" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3 col-6">
    <div class="small-box bg-orange">
        <div class="inner">
            <h3><?php echo e($cotacao["aprovacao"]??0); ?></h3>
            <p>Cotação em Aprovação</p>
        </div>
        <div class="icon">
            <i class="<?php echo e($iconeCotacao); ?>"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?php echo e($cotacao["entrega"]??0); ?></h3>
            <p>Cotação Aguardando Entrega</p>
        </div>
        <div class="icon">
            <i class="<?php echo e($iconeCotacao); ?>"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo e($cotacao["finalizado"]??0); ?></h3>
            <p>Cotação Finalizada/Entregue </p>
        </div>
        <div class="icon">
            <i class="<?php echo e($iconeCotacao); ?>"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>




<?php /**PATH C:\wamp64\www\app\resources\views/sistema/dashboard/indicadorCotacao.blade.php ENDPATH**/ ?>