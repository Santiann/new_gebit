@php

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

@endphp
<li class="nav-item align-self-center">
    <a id="popoverCreditos" data-content="Clique aqui e adquira mais créditos" rel="popover" data-placement="bottom" data-trigger="hover" target="_blank" href="{{ env('URL_SITE') }}/comeceja">
        <span style="font-size: 13px;" class="p-3 badge badge-pill badge-success">$ {{$labelCreditos}}</span>
    </a>
</li>
<li class="nav-item dropdown notifications-menu">
    <a class="nav-link testeclickinicial" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        <span class="label label-warning jLabelQtdNoificacao">{{$labelqtdNotification}}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">você tem <span class="jMsgQtdNoificacao">{{$qtdNotification}}</span> notificações não lida</li>
        <li>
            <ul class="menu">
                @foreach($notificacoes as $row)
                <li>
                    <a href="javascript:void(0);" style="{{$row->a996_ind_lido==0?"font-weight: bold;":""}}"  title="Ler notificação" onclick="fLerNotificacao('{!! $row->a996_id_notificacao !!}','{!! $row->a996_assunto !!}','{!! $row->a996_conteudo !!}','{{$row->a996_ind_lido}}',this)">
                        <i class="{{$row->a996_nome_icone}}"></i> <span> {!! $row->a996_assunto !!} </span>
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <li class="footer"><a href="/notificacao">Ver Todas</a></li>
    </ul>
</li>

@push('js')
<script>
    $(function() {
        $('#popoverCreditos').popover({ 
            trigger: "hover",
            template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div style="font-size: 13px;" class="popover-body"></div></div>',
        });
    });
</script>
@endpush