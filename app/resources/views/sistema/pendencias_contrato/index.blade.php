@php
    $page_title = "Pendências de Contratos";
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
                @permission('pendencias_contrato-create')
                    <a href="{{ url('/pendencias_contrato/create') }}" class="btn btn-sm bg-olive"> <i class="fa fa-plus"></i> Adicionar {{ $page_title ?? "Page Title" }}</a>
                @endpermission
            </div>
        </div>
        <div class="box-body">
            <table class="display responsive nowrap" style="width:100%" id="tablePendencias">
                <thead>
                    <th>Para a empresa</th>
                    <th>Pendência</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($pendencias as $key=>$value)
                    <tr class="data-tr" data-id-pendencia="{{ $value->a027_id_pendencia }}"
                        data-aceite-pendencia="{{ $value->a027_pendencia_aceite }}">
                        @php 
                            $nome_empresa = $value->Empresa_belongsTo->a005_nome_fantasia ??
                                            $value->Empresa_belongsTo->a005_razao_social ??
                                            $value->Empresa_belongsTo->a005_nome_completo;
                        @endphp
                        <td>{{$nome_empresa}}</td>
                        <td>{{$value->a027_pendencia}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>
                        @if (isset($value->a027_pendencia_aceite))
                            @if ($value->a027_pendencia_aceite)
                            <span class="badge badge-success">Aceito</span>
                            @else
                            <span class="badge badge-danger">Rejeitado</span>
                            @endif
                        @else
                            <span class="badge badge-secondary">Pendente</span>
                        @endif
                        </td>
                        <td>
                            <a href="{{ route('contrato.edit', $value->a013_id_contrato) }}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> Acessar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop


@push('css')


@endpush


@push('js')
<script>
    $(document).ready(function() {
        $('#tablePendencias').DataTable({
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
            "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
        });
    });
</script>
@endpush
