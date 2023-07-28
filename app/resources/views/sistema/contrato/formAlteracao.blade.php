@php
    $comboUsuario[0]='Sistema';
@endphp
<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>
@if($columnsHistorico??"" != "" && $historico??"" != "")
    <div class="box-body">
        <table class="display responsive nowrap" style="width:100%" id="tableHistoricoContrato">
            <thead>
                <th class="hidden">id</th>
                <th>Data Alteração</th>
                <th>Usuário</th>
                <th>Campos alterados</th>
                <!-- @foreach($columnsHistorico as $key=>$value)
                    <th>{{$attributes[$value]??$value}}</th>
                @endforeach -->
            </thead>
            <tbody>
            @foreach($historico as $key=>$hist)
                <tr>
                    <td class="hidden">{{ $hist->a016_id_historico }}</td>
                    <td>{{ \Carbon\Carbon::parse($hist->a016_data_alteracao)->format('d/m/Y H:i') }}</td>
                    <td>{{$comboUsuario[$hist->a001_id_usuario]}}</td>
                    @php($log = json_decode($hist->a016_log, true))

                    <td>
                        @if($hist->a016_campos_alterados != '')
                            @php($campos_alterados = json_decode($hist->a016_campos_alterados, true))
                            
                            @foreach($campos_alterados as $chave => $value)
                                @if ($chave != 'updated_at')
                                <b>{{ $attributes[$chave] ?? $chave }}</b> alterado de <s class="text-danger">{{ $value }}</s> para 
                                    <span class="text-success">
                                    @isset ($log[$chave])
                                    {{ $log[$chave] }}
                                    @endisset
                                    </span> <br>
                                @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endif



