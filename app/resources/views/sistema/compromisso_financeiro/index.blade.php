@php
    $page_title = "Compromissos financeiros";
    $page_description = "Listagem";
@endphp


@extends('adminlte::page')

@section('title', $page_title)

@section('content_header')

@stop

@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>{!! Session::get('flash_message') !!}</strong>
        </div>
    @endif
    <div class="box">
        <div class="box-header">
            <div class="box-tools">
                @permission('compromisso-create')
                    <a href="{{ url('/compromisso_financeiro/create') }}" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar {{ $page_title ?? "Page Title" }}</a>
                @endpermission
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                <thead>
                    <th width="80px">Código</th>
                    <th>Empresa</th>
                    <th>Contrato</th>
                    <th>Clinte/Fornec</th>
                    <th>Vencimento</th>
                    <th>Valor</th>
                    <th>Valor Pago</th>
                    <th>Status</th>
                    <th width="80px">Ações</th>
                </thead>
            </table>
        </div>
    </div>

@stop


@push('css')


@endpush


@push('js')
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
            ajax: '{!! route('compromisso_financeiro.data') !!}',
            columns: [
            	{ data: 'a022_id_compromisso', name: 'a022_id_compromisso' },
                { data: 'nomeEmpresa', name: 'nomeEmpresa', visible: JSON.parse("{{ (count($comboEmpresa)??0) == 1 ?'false' : 'true' }}") },
				{ data: 'a013_numero_contrato', name: 't013_contrato.a013_numero_contrato' },
                { data: 'nomeCliFor', name: 'nomeCliFor' },
				{ data: 'a022_data_vencimento', name: 'a022_data_vencimento' },
				{ data: 'a022_valor_pagar', name: 'a022_valor_pagar' },
				{ data: 'a022_valor_pago', name: 'a022_valor_pago' },
				{ data: 'a022_status', name: 'a022_status' },
				{ data: 'action', name: 'action' }
            ],
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
        });
    });
</script>
@endpush
