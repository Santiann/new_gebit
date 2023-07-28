
@php
    $comboUsuario[0]='Sistema';
@endphp

@if($columnsHistorico??"" != "" && $historico??"" != "")
    <div class="box-body">
        <table class="display responsive nowrap" style="width:100%" id="tableHistorico">
            <thead>
            <th>Data Alteração</th>
            <th>Usuário</th>
            @foreach($columnsHistorico as $key=>$value)
                <th>{{$attributes[$value]??$value}}</th>
            @endforeach
            </thead>
            <tbody>
            @foreach($historico as $key=>$value)
                <tr>
                    <td>{{$value->a021_data_alteracao}}</td>
                    <td>{{$comboUsuario[$value->a001_id_usuario]}}</td>
                    @php($rooms = json_decode($value->a021_log, true))
                    @foreach($columnsHistorico as $keyCol=>$valueCol)
                        <td>
                            @if($valueCol=="a005_id_empresa")
                                {{ $comboTodasEmpresaCliFor[$rooms[$valueCol]]??$rooms[$valueCol]??'' }}
                            @elseif($valueCol=="a018_status")
                                {{ $comboStatus[$rooms[$valueCol]]??$rooms[$valueCol]??'' }}
                            @else
                                {{ $rooms[$valueCol]??'' }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endif
