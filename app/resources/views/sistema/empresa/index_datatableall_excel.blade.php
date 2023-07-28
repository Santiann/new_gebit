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
            "pageLength": 10,
             fixedHeader: {
               header: true,
               footer: false
            },
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                'excel', 'pdf', {
                    extend: 'excel',
                    text: 'excel all',
                    className: 'btn btn-warning btn-sm',
                    action: newExportAction
                }, {
                    extend: 'print',
                    text: 'print all',
                    className: 'btn btn-warning btn-sm',
                    action: newExportAction
                }//*/
                ,{
                    extend: 'pdf',
                    text: 'pdf all',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    className: 'btn btn-warning btn-sm',
                    action: newExportAction
                },//*/
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
				{ data: 'tipo_empresa', name: 'tipo_empresa' },
				{ data: 'nome', name: 'nome' },
				{ data: 'a005_cpf_cnpj_id', name: "a005_cpf_cnpj_id" },
				{ data: 'a005_fone', name: 't005_empresa.a005_fone' },
				{ data: 'a005_status', name: 'a005_status' },
				{ data: 'action', name: 'action' }
            ],
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
        });
    });

    var oldExportAction = function (self, e, dt, button, config) {
        if (button[0].className.indexOf('buttons-excel') >= 0) {
            if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
            }
            else {
                $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            }
        } else if (button[0].className.indexOf('buttons-print') >= 0) {
            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
        } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
            $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config);
        }
    };

    var newExportAction = function (e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;

        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = 2147483647;

            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                oldExportAction(self, e, dt, button, config);

                dt.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });

                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(dt.ajax.reload, 0);

                // Prevent rendering of the full data to the DOM
                return false;
            });
        });

        // Requery the server with the new one-time export settings
        dt.ajax.reload();
    };
</script>
@endpush
