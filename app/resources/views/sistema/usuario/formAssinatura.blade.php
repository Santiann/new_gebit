@php
    $page_title = "Minha assinatura";
    $page_description = "";
@endphp

@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')

    @if (isset($assinatura))

        {!! Form::model($assinatura, [
            'method' => 'PUT',
            'url' => ['assinatura', $assinatura->id],
            'class' => 'form form-usuario EspacoTopo',
            'data-toggle' => 'validator'
        ]) !!}

        <div class="box-footer BotesFixoTopo">
            <a href="{{ url('/usuario')}}" class="btn btn-default jbtnCancelarForm">
                <i class="fa fa-ban"></i> Cancelar
            </a>

            <button type="submit" class="btn bg-olive pull-right">
                <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
            </button>
        </div>

        <div class="box">
            <div class="row">
                <div class="FormSubtitulo">

                </div>
            </div>

            @if($status)
            <div class="alert alert-danger" role="alert">
                @if($status == 'unpaid')
                O pagamento da sua assinatura está pendente. Aguarde até que o pagamento seja aprovado para liberar todos os recursos.<br><br>
                Se ainda não efetuou o pagamento, <a href="https://pagar.me/customers/#/subscriptions/{{ $assinatura->id }}?token={{ env('PAGARME_API_KEY') }}" class="">clique aqui</a>
                @else
                Sua assinatura foi cancelada. É necessário realizar uma nova para continuar utilizando o sistema.
                <a href="{{ env('URL_SITE') }}/comeceja" class="">Clique aqui para conferir os planos</a>
                @endif
            </div>
            @endif

            @if ($subscription)
            <div class="nav nav-tabs">
                <br>
                Algumas informações estão sincronizadas com a plataforma de pagamentos e podem levar um tempo para serem atualizadas.
            </div>
            <br>
            <div class="jUsuario">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Nome: </label>
                            {{ $subscription->customer->name }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">E-mail: </label>
                            {{ $subscription->customer->email }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Telefone: </label>
                            ({{ $subscription->phone->ddd }}) {{ $subscription->phone->number }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Seu plano: 
                                <select class="form-control" name="plano" id="plano">
                                    @foreach($planos as $plan)
                                    <option 
                                        data-is-monthly="{{ $plan->is_monthly }}"
                                        {{ $subscription->plan->id === $plan->pagarme_id ? 'selected' : '' }} 
                                        value="{{ $plan->pagarme_id }}"
                                        >
                                        {{ $plan->nome }}
                                    </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Dias do plano: </label>
                            <br>
                            <span id="plan_days">{{ $subscription->plan->days }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">Status: </label>
                        @include('sistema.usuario._statusAssinatura', ['status' => $subscription->status])
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        Método de pagamento:<br>
                        <label>
                            <input type="radio" name="payment_method" {{ $subscription->payment_method == 'boleto' ? 'checked' : '' }} value="boleto" />
                            Boleto
                        </label>
                        <br>
                        <label class="control-label">
                            <input type="radio" name="payment_method" {{ $subscription->payment_method == 'credit_card' ? 'checked' : '' }}  value="credit_card" />
                            Cartão de crédito
                        </label>
                    </div>
                </div>
            <!-- {# credit card area #} -->
            <div class="{{ $subscription->payment_method == 'boleto' ? 'd-none' : '' }}" id="credit_card_area">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Cartão cadastrado: </label> {{ $subscription->card_brand }} / ****{{ $subscription->card_last_digits }}
                        </div>
                    </div>
                    <label>Alterar cartão de crédito:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input  type="number" name="card_number" id="card_number" data-mask="0000000000000000" class="form-control" placeholder="Número do cartão">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input  type="text" name="card_holder_name" id="card_holder_name" placeholder="Nome no cartão" class="form-control">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <input  type="text" name="card_expiration_date" id="card_expiration_date" data-mask="00/00"  placeholder="Mês e ano de vencimento" class="form-control">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <input  type="text" name="card_cvv" id="card_cvv" data-mask="0000" placeholder="Código de segurança" class="form-control">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- {# end credit card area #} -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Início da assinatura: </label>
                            {{ date_format(date_create($subscription->current_period_start),"d/m/Y H:i:s") }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Fim da assinatura: </label>
                            {{ date_format(date_create($subscription->current_period_end),"d/m/Y H:i:s") }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                        <thead>
                            <th width="80px">Status</th>
                            <th>Valor pago</th>
                            <th>Método de pagamento</th>
                            <th>Última atualização</th>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>@include('sistema.usuario._statusAssinatura', ['status' => $transaction->status])</td>
                                <td>{{ "R$ ". number_format(($transaction->paid_amount / 100), 2, ',', '.') }}</td>
                                <td>{{ $transaction->payment_method }}</td>
                                <td>{{ date_format(date_create($transaction->date_updated),"d/m/Y H:i:s") }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
        {!! Form::close() !!}
    @else 
        <div class="alert alert-danger" role="alert">
            Não há assinaturas vinculadas a sua conta. Adquira um plano no site utilizando o seu e-mail para associar uma assinatura.
            <a href="{{ env('URL_SITE') . '/comeceja' }}">Clique aqui para adquirir</a>
        </div>
    @endif

@stop

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script>
        $('#plano').change(function(){
            $is_monthly = $(this).find(':selected').data('is-monthly')

            if ($is_monthly)
                $('#plan_days').text('30');
            else
                $('#plan_days').text('365');
        });

        $('[name="payment_method"]').change(function(){
            if ($(this).val() == 'credit_card')
                $('#credit_card_area').removeClass('d-none')
            else
                $('#credit_card_area').addClass('d-none')
        })
    </script>
@endpush

