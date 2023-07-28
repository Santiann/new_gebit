
<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>

<div class="jSocio">

    <div class="row">
        <div class="col-md-7">
            <div class="form-group {{ $errors->has('a007_nome') ? 'has-error' : ''}}">
                {!! Form::label('a007_nome', 'Nome', ['class' => 'control-label']) !!}
                {!! Form::text('a007_nome_form', null, ['class' => 'form-control','autocomplete' => 'off', 'id'=>'a007_nome_form']) !!}
                {!! $errors->first('a007_nome', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('a007_percent_participacao') ? 'has-error' : ''}}">
                {!! Form::label('a007_percent_participacao', '% Participação', ['class' => 'control-label']) !!}
                {!! Form::text('a007_percent_participacao_form', null, ['class' => 'form-control percent3Mask','autocomplete' => 'off', 'id'=>'a007_percent_participacao_form']) !!}
                {!! $errors->first('a007_percent_participacao', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-2">
            <label  class="control-label" style="width: 100%;">&nbsp;</label>
            <a class="btn bg-green pull-right" href="javascript: addTableSocio();" style="width: 100%;">
                <i class="fa fa-plus"></i> Adicionar
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="table-socio">
                        <tr>
                            <th>Nome</th>
                            <th>%</th>
                            <th style="width:80px">Ação</th>
                        </tr>
                        @if (($EmpresaSocios??'') != '')
                            @foreach ($EmpresaSocios as $row)
                                <tr class="dados_id bg_add_linha">
                                    <td>{{ $row['a007_nome'] }}<input type="hidden" id="a007_nome" name="a007_nome[]" value="{{ $row['a007_nome'] }}"></td>
                                    <td>{{ $row['a007_percent_participacao'] }}<input type="hidden" id="a007_percent_participacao" name="a007_percent_participacao[]" value="{{ $row['a007_percent_participacao'] }}"></td>
                                    <td>
                                        <div class="btn btn-info"  title="Editar Sócio" onclick="editasocioempresa(this)"><i class="fa fa-edit" aria-hidden="true"></i></div>
                                        <div class="btn btn-danger" title="Remover Sócio" onclick="removesocioempresa('Tem certeza que deseja excluir este Sócio?', this)"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
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
