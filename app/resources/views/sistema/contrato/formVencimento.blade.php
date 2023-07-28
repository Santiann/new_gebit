<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>


<div class="jContato">

    <div class="row">
        <div class="col-md-5">
            <div class="form-group {{ $errors->has('a012_id_tipo_vencimento') ? 'has-error' : ''}}">
                {!! Form::label('a012_id_tipo_vencimento', 'Tipo', ['class' => 'control-label']) !!}
                {!! Form::select('a012_id_tipo_vencimento_form',$comboTipo_vencimento??[],null,array('class' => 'form-control select2','id'=>'a012_id_tipo_vencimento_form','autocomplete' => 'off'))!!}
                {!! $errors->first('a012_id_tipo_vencimento', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group {{ $errors->has('a017_valor') ? 'has-error' : ''}}">
                {!! Form::label('a017_valor', 'Valor', ['class' => 'control-label']) !!}
                {!! Form::text('a017_valor_form', null, ['class' => 'form-control moneyMaskCuston','autocomplete' => 'off', 'id'=>'a017_valor_form']) !!}
                {!! $errors->first('a017_valor', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <label  class="control-label" style="width: 100%;">&nbsp;</label>
            <a class="btn bg-green pull-right" href="javascript: addTableContratoTipoVencimento();" style="width: 100%;">
                <i class="fa fa-plus"></i> Adicionar
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="table-contato">
                        <tr>
                            <th>Tipo Vencimento</th>
                            <th>Valor</th>
                            <th style="width:80px">Ação</th>
                        </tr>
                        @if (($contratoTipoVencimento??'') != '')
                            @foreach ($contratoTipoVencimento as $row)
                                <tr class="dados_id bg_add_linha">
                                    <td>{{ $comboTipo_vencimento[$row['a012_id_tipo_vencimento']] }}<input type="hidden" id="a012_id_tipo_vencimento" name="a012_id_tipo_vencimento[]" value="{{ $row['a012_id_tipo_vencimento'] }}"></td>
                                    <td>{{ $row['a017_valor'] }}<input type="hidden" id="a017_valor" name="a017_valor[]" value="{{ $row['a017_valor'] }}"></td>
                                    <td>
                                        <div class="btn btn-info" title="Editar Tipo Vencimento" onclick="editaContratoTipoVencimento(this)"><i class="fa fa-edit" aria-hidden="true"></i></div>
                                        <div class="btn btn-danger" title="Excluir Tipo Vencimento" onclick="removeContratoTipoVencimento('Tem certeza que deseja excluir este Tipo?', this)"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

