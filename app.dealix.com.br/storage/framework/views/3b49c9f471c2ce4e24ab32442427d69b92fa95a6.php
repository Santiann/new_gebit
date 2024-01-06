<?php

$qtdNotification = 0;

$notificacoes = \App\Notificacao::query()
    ->where('a001_id_usuario',Auth::user()->a001_id_usuario)
    ->where('a996_ind_lido',0)
    ->get();

    $notificacoes->map(function($row){
        $row->a996_assunto = preg_replace('/\s\s+/', '',str_replace('\'','´',str_replace('"','´',$row->a996_assunto)));
        $row->a996_conteudo = preg_replace('/\s\s+/', '',str_replace('\'','´',str_replace('"','´',$row->a996_conteudo)));
    });

$qtdNotification = $notificacoes->count();


$labelqtdNotification = $qtdNotification;
if($qtdNotification>9)
{
    $labelqtdNotification = "+9";
}

$labelCreditos = Auth::user()->creditos;

?>
<li class="nav-item align-self-center">
    <a id="popoverCreditos" data-content="Clique aqui e adquira mais créditos" rel="popover" data-placement="bottom" data-trigger="hover" target="_blank" href="<?php echo e(env('URL_SITE')); ?>/comeceja">
        <span style="font-size: 13px;" class="p-3 badge badge-pill badge-success">$ <?php echo e($labelCreditos); ?></span>
    </a>
</li>
<li class="nav-item dropdown notifications-menu">
    <a class="nav-link testeclickinicial" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        <span class="label label-warning jLabelQtdNoificacao"><?php echo e($labelqtdNotification); ?></span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">você tem <span class="jMsgQtdNoificacao"><?php echo e($qtdNotification); ?></span> notificações não lida</li>
        <li>
            <ul class="menu">
                <?php $__currentLoopData = $notificacoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="javascript:void(0);" style="<?php echo e($row->a996_ind_lido==0?"font-weight: bold;":""); ?>"  title="Ler notificação" onclick="fLerNotificacao('<?php echo $row->a996_id_notificacao; ?>','<?php echo $row->a996_assunto; ?>','<?php echo $row->a996_conteudo; ?>','<?php echo e($row->a996_ind_lido); ?>',this)">
                        <i class="<?php echo e($row->a996_nome_icone); ?>"></i> <span> <?php echo $row->a996_assunto; ?> </span>
                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
        <li class="footer"><a href="/notificacao">Ver Todas</a></li>
    </ul>
</li>

<?php $__env->startPush('js'); ?>
<script>
    $(function() {
        $('#popoverCreditos').popover({ 
            trigger: "hover",
            template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div style="font-size: 13px;" class="popover-body"></div></div>',
        });
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/vendor/adminlte/notification.blade.php ENDPATH**/ ?>