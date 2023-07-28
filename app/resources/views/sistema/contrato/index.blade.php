@php
    $page_title = "Contrato";
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
                @permission('contrato-create')
                @if(($indEmpresaEmpresa??0)>0)
                    <a href="{{ url('/contrato/create') }}" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar {{ $page_title ?? "Page Title" }}</a>
                @endif
                @endpermission
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
            ajax: '{!! route('contrato.data') !!}',
            columns: [
            	{ data: 'a013_numero_contrato', name: 'a013_numero_contrato' },
                { data: 'nomeEmpresa', name: 'nomeEmpresa', visible: JSON.parse("{{ (count($comboEmpresa)??0) == 1 ?'false' : 'true' }}") },
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
@endpush
