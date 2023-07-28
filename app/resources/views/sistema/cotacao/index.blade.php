@php
    $page_title = "Cotação";
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
                @permission('cotacao-create')
                    <a href="{{ url('/cotacao/create') }}" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar {{ $page_title ?? "Page Title" }}</a>
                @endpermission
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                <thead>
                    <th width="80px">Código</th>
					<th>Empresa</th>
					<th>O Que</th>
					<th>Data Prevista</th>
					<th>Notificar</th>
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
            ajax: '{!! route('cotacao.data') !!}',
            columns: [
            	{ data: 'a018_id_contacao', name: 't018_cotacao.a018_id_contacao' },
                { data: 'nomeEmpresa', name: 'nomeEmpresa', visible: JSON.parse("{{ (count($comboEmpresa)??0) == 1 ?'false' : 'true' }}") },
				{ data: 'a018_o_que', name: 't018_cotacao.a018_o_que' },
				{ data: 'a018_data_prevista', name: 't018_cotacao.a018_data_prevista' },
				{ data: 'a018_notificar', name: 't018_cotacao.a018_notificar' },
				{ data: 'a018_status', name: 'a018_status' },
				{ data: 'action', name: 'action' }
            ],
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
        });
    });
</script>
@endpush
