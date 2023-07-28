@switch($status)
    @case('paid')
    <strong style="color: green" >Pago</strong>
    @break
    @case('waiting_payment')
    <strong style="color: orange">Aguardando pagamento</strong>
    @break
    @case('trialing')
    <strong style="color: blue">Em período gratuito</strong>
    @break
    @case('canceled')
    <strong style="color: red">Cancelado</strong>
    @break
    @case('ended')
    <strong style="color: red">Finalizado</strong>
    @break
    @case('unpaid')
    <strong style="color: red">Não pago</strong>
    @break
    @default
    <strong style="color: red">Indefinido</strong>
    @break
@endswitch