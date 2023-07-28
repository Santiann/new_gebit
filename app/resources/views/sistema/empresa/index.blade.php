@php
    $page_title = ucfirst($tipo??"Empresa");
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
                @permission('empresa-create')
                    @php($url = (($tipo??'')!='') ? '/emp_'.($tipo??'').'/create' : '/empresa/create')
                    <a href="{{ url($url) }}" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar {{ $page_title ?? "Page Title" }}</a>
                @endpermission
            </div>
        </div>


        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                <thead>
                    <th width="80px">Código</th>
                    <th>Tipo</th>
                    <th>Tipo Empresa</th>
                    <th>Nome</th>
                    <th>CPF - CNPJ - ID Estrangeiro</th>
                    <th>Fone</th>
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
                'excel', 'pdf',
                {
                    text: 'Exibir inativos',
                    action: function ( e, dt, node, config ) {
                        let button = node[0];

                        if ($(button).text().includes('Exibir')) {
                            dt.rows().every(function (rowIdx, tableLoop, rowLoop) {
                                let node = this.node()
                                let data = this.data()
                                
                                if (data.a005_status.includes('Inativo')) {
                                    $(node).show()
                                }
                            });

                            $(button).text('Esconder inativos')

                        } else {
                            dt.rows().every(function (rowIdx, tableLoop, rowLoop) {
                                let node = this.node()
                                let data = this.data()
                                
                                if (data.a005_status.includes('Inativo')) {
                                    $(node).hide()
                                }
                            });

                            $(button).text('Exibir inativos')
                        }
                    }
                }
            ],
            "ajax": {
                "url": '{!! route('empresa.data') !!}',
                "data": function ( d ) {
                    d.tipo_empresa = '{{$tipo??''}}';
                }
            },
            columns: [
            	{ data: 'a005_id_empresa', name: 't005_empresa.a005_id_empresa'},
				{ data: 'a005_tipo_cliente', name: 't005_empresa.a005_tipo_cliente' },
				{ data: 'tipo_empresa', name: 'tipo_empresa',"visible": false },
				{ data: 'nome', name: 'nome' },
				{ data: 'a005_cpf_cnpj_id', name: "a005_cpf_cnpj_id" },
				{ data: 'a005_fone', name: 't005_empresa.a005_fone' },
				{ data: 'a005_status', name: 'a005_status' },
				{ data: 'action', name: 'action' }
            ],
            rowCallback: function( row, data, index ) {
                if (data['a005_status'].includes('Inativo')) {
                    $(row).hide();
                }
            },
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
        });
    });
</script>
@endpush
