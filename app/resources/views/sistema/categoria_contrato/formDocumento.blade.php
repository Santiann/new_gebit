<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>

<div class="jCatagoriaDoc">

    <div class="row">

        <div class="col-md-5">
            <div class="form-group {{ $errors->has('a009_descricao') ? 'has-error' : ''}}">
                {!! Form::label('a009_descricao', 'Descrição', ['class' => 'control-label']) !!}
                {!! Form::text('a009_descricao_form', null, ['class' => 'form-control','autocomplete' => 'off', 'id'=>'a009_descricao_form']) !!}
                {!! $errors->first('a009_descricao', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('a009_dias_alerta_vencimento') ? 'has-error' : ''}}">
                {!! Form::label('a009_dias_alerta_vencimento', 'Dias de Alerta do Vencimento', ['class' => 'control-label']) !!}
                {!! Form::text('a009_dias_alerta_vencimento_form', null, ['class' => 'form-control numero3Mask','autocomplete' => 'off', 'id'=>'a009_dias_alerta_vencimento_form']) !!}
                {!! $errors->first('a009_dias_alerta_vencimento', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group " >
                <label class="control-label">Obrigatório </label>
                <div style="margin-top: 7px;">
                    <label class="control-label">{!! Form::checkbox('a009_ind_obrigatorio_form', 1,  true , ['id' => 'a009_ind_obrigatorio_form','class'=>'control-label']) !!} Sim</label>&ensp;
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group " >
                <label class="control-label">Status </label>
                <div style="margin-top: 7px;">
                    <label class="control-label">{!! Form::checkbox('a009_status_form', 1,  true , ['id' => 'a009_status_form','class'=>'control-label']) !!} Ativo</label>&ensp;
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <label  class="control-label" style="width: 100%;">&nbsp;</label>
            <a class="btn bg-green pull-right" href="javascript: addTableCategoriaDocumento();" style="width: 100%;">
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
                            <th>Descrição</th>
                            <th>Dias de Alerta do Vencimento</th>
                            <th>Obrigatório</th>
                            <th>Status</th>
                            <th style="width:80px">Ação</th>
                        </tr>
                        @if (($CategoriaDocumentos??'') != '')

                            @foreach ($CategoriaDocumentos as $row)
                                <?php
                                $txtStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i>  Ativo </span>';
                                if($row['a009_status'] == 0)
                                    $txtStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i>  Inativo </span>';

                                $txtObrig  = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i>  Sim </span>';
                                if($row['a009_ind_obrigatorio'] == 0)
                                    $txtObrig = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i>  Não </span>';

                                ?>
                                <tr class="dados_id bg_add_linha">
                                    <td>{{ $row['a009_descricao'] }}<input type="hidden" id="a009_descricao" name="a009_descricao[]" value="{{ $row['a009_descricao'] }}"></td>
                                    <td>{{ $row['a009_dias_alerta_vencimento'] }}<input type="hidden" id="a009_dias_alerta_vencimento" name="a009_dias_alerta_vencimento[]" value="{{ $row['a009_dias_alerta_vencimento'] }}"></td>
                                    <td>{!!  $txtObrig !!}<input type="hidden" id="a009_ind_obrigatorio" name="a009_ind_obrigatorio[]" value="{{ $row['a009_ind_obrigatorio'] }}"></td>
                                    <td>{!!  $txtStatus !!}<input type="hidden" id="a009_status" name="a009_status[]" value="{{ $row['a009_status'] }}"></td>
                                    <td>
                                        <div class="btn btn-info" title="Editar Documento" onclick="editacategoriadocumento(this)"><i class="fa fa-edit" aria-hidden="true"></i></div>
                                        <div class="btn btn-danger" title="Excluir Documento" onclick="removecategoriadocumento('Tem certeza que deseja excluir este Documento?', this)"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
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
