<div class="col-lg-3 col-6">
    <div class="small-box bg-gray">
        <div class="inner">
            <h3>{{$cotacao["total"]??0}}</h3>
            <p>Total Cotações/Orçamentos </p>
        </div>
        <div class="icon">
            <i class="{{$iconeCotacao}}"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{$cotacao["cotacaoPendente"]??0}}</h3>
            <p>Cotação Pendentes</p>
        </div>
        <div class="icon">
            <i class="{{$iconeCotacao}}"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{$cotacao["orcamentoPendente"]??0}}</h3>
            <p>Orçamento Pendentes</p>
        </div>
        <div class="icon">
            <i class="{{$iconeOrcamento}}"></i>
        </div>
        <a href="/orcamento" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3 col-6" >
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{$cotacao["finalizadoMes"]??0}}</h3>
            <p>Últimas  Cotações (mês)</p>
        </div>
        <div class="icon">
            <i class="{{$iconeCotacao}}"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
        <div class="inner">
            <h3>{{$cotacao["cancelado"]??0}}</h3>
            <p>Orçamento Sem Aprovação/Cancelado</p>
        </div>
        <div class="icon">
            <i class="{{$iconeOrcamento}}"></i>
        </div>
        <a href="/orcamento" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3 col-6">
    <div class="small-box bg-orange">
        <div class="inner">
            <h3>{{$cotacao["aprovacao"]??0}}</h3>
            <p>Cotação em Aprovação</p>
        </div>
        <div class="icon">
            <i class="{{$iconeCotacao}}"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{$cotacao["entrega"]??0}}</h3>
            <p>Cotação Aguardando Entrega</p>
        </div>
        <div class="icon">
            <i class="{{$iconeCotacao}}"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{$cotacao["finalizado"]??0}}</h3>
            <p>Cotação Finalizada/Entregue </p>
        </div>
        <div class="icon">
            <i class="{{$iconeCotacao}}"></i>
        </div>
        <a href="/cotacao" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>




