<div class="row">
    <div class="FormSubtitulo">
    </div>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            {!! Form::label('add_new_note_title', 'Título da anotação:', ['class' => 'control-label']) !!}
            {!! Form::text('add_new_note_title', null, ['class' => 'form-control','autocomplete' => 'off']) !!}
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-8">
            {!! Form::label('add_new_note', 'Alteração realizada no contrato:', ['class' => 'control-label']) !!}
            {!! Form::textarea('add_new_note', null, ['class' => 'form-control','autocomplete' => 'off', 'size' => '10x4']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mt-2">
            <br>
            <button type="button" class="ml-2 pull-right button-modal btn bg-info" onclick="addAnotacao()">
                <i class="fa fa-pencil"></i> Adicionar anotação
            </button>
        </div>
    </div>
    <br>
    <br>

    @if($anotacoes??"" != "")
        <table class="display responsive nowrap" style="width:100%" id="tableRenovacaoContrato">
            <thead>
                <th></th>
                <th>Data</th>
                <th>Usuário</th>
                <th>Título</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach($anotacoes as $key=>$value)
                <tr class="data-tr" data-id-anotacao="{{ $value->a026_id_anotacao }}"
                    style="cursor:pointer;"
                    ondblclick="openDetails(this)"
                    data-obs-anotacao="{{ $value->a026_anotacao_obs }}"
                    data-da-minha-empresa-anotacao="{{ $value->da_minha_empresa }}"
                    data-aceite-anotacao="{{ $value->a026_anotacao_aceite }}"
                    data-child-value="{{ $value->a026_anotacao_descricao }}">
                    <td class="details-control"></td>
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->a026_nome_usuario}}</td>
                    <td>{{$value->a026_anotacao_titulo}}</td>
                    <td>
                    @if (isset($value->a026_anotacao_aceite))
                        @if ($value->a026_anotacao_aceite)
                        <span class="badge badge-success">Aceito</span>
                        @else
                        <span class="badge badge-danger">Rejeitado</span>
                        @endif
                    @else
                        <span class="badge badge-secondary">Pendente</span>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@push('css')
<style>
    @import url('//cdn.datatables.net/1.10.2/css/jquery.dataTables.css');
    td.details-control {
        background: url('http://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
</style>
@endpush
@push('js')
<script>
    function openDetails(that)
    {
        $(that).children('.details-control').eq(0).click()
    }

    function addAnotacao()
    {
        let titulo = $('#add_new_note_title').val();
        let anotacao = $('#add_new_note').val();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/salvarAnotacao/{{ $contrato->a013_id_contrato }}",
            type: "POST",
            data: {a026_anotacao_titulo: titulo, a026_anotacao_descricao: anotacao},
            headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
            success: function (response) {
                if (!response.success) {
                    $.alert(response.message);
                }
                else {
                    tableRenovacaoContrato.row.add( [
                        '<td></td>',
                        response.data.created_at,
                        response.data.a026_nome_usuario,
                        response.data.a026_anotacao_titulo,
                        response.data.a026_anotacao_aceite ?? '',
                    ] ).draw( false );

                    $('#tableRenovacaoContrato tbody tr:last-child td:first-child').addClass('details-control')
                    $('#tableRenovacaoContrato tbody tr:last-child').attr('data-child-value', response.data.a026_anotacao_descricao)
                    $('#tableRenovacaoContrato tbody tr:last-child').attr('data-id-anotacao', response.data.a026_id_anotacao)
                    $('#tableRenovacaoContrato tbody tr:last-child').attr('data-aceite-anotacao', response.data.a026_anotacao_aceite ?? '')
                }
            },
            error: function (response) {
                $.alert('Não foi possível adicionar a anotação');
                console.log(response)
            }
        });
    }

    function addComentarioAnotacao()
    {
        let comentario = $('#add_comment_note').val();
        let aceite = $('[name="a026_anotacao_aceite"]:checked').val()
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/salvarComentarioAnotacao/"+id_anotacao_selecionada,
            type: "POST",
            data: {a026_anotacao_obs: comentario, a026_anotacao_aceite: aceite},
            headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
            success: function (response) {
                if (!response.success) {
                    $.alert(response.message);
                }
                else {
                    $('#add_comment_note').val('')
                    $('#addComentarioAnotacao').modal('toggle')

                    let tr_anotacao = $('[data-id-anotacao='+id_anotacao_selecionada+']')

                    tr_anotacao.attr('data-obs-anotacao', response.data.a026_anotacao_obs)
                    tr_anotacao.attr('data-aceite-anotacao', response.data.a026_anotacao_aceite)

                    if (response.data.a026_anotacao_obs) {
                        tr_anotacao.next('tr').find('.comment').text(response.data.a026_anotacao_obs)
                        tr_anotacao.next('tr').find('.hidden').removeClass('hidden')
                    }
                }
            },
            error: function (response) {
                $.alert('Não foi possível adicionar a anotação');
                console.log(response)
            }
        });
    }
</script>
@endpush