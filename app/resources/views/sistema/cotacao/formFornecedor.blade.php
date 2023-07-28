
<div class="jcotacaoFornecedor">

    <div class="row FornecedoresAdicionar">
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('a005_id_empresa_for') ? 'has-error' : ''}}">
                {!! Form::label('a005_id_empresa_for', 'Fornecedor', ['class' => 'control-label']) !!}

                <select name="a005_id_empresa_for_form" id="a005_id_empresa_for_form" class='form-control select2' autocomplete="off">
                    <option value="" email=""></option>
                    @foreach($fornecedor as $row)
                        <option value="{{$row->a005_id_empresa}}" email="{{$row->a005_email}}"> {{$row->nome }} </option>
                    @endforeach
                    <option value="0" email="">Outro Fornecedor</option>
                </select>

                {!! $errors->first('a005_id_empresa_for', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('a020_email_outro_fornecedor') ? 'has-error' : ''}}">
                {!! Form::label('a020_email_outro_fornecedor', 'E-mail', ['class' => 'control-label']) !!}
                {!! Form::text('a020_email_outro_fornecedor_form', null, ['class' => 'form-control','autocomplete' => 'off', 'id'=>'a020_email_outro_fornecedor_form']) !!}
                {!! $errors->first('a020_email_outro_fornecedor', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('a020_data_entrega') ? 'has-error' : ''}}">
                {!! Form::label('a020_data_entrega', 'Data Entrega', ['class' => 'control-label']) !!}
                {!! Form::text('a020_data_entrega_form', null, ['class' => 'form-control dataCalendario dataMask','autocomplete' => 'off', 'id'=>'a020_data_entrega_form']) !!}
                {!! $errors->first('a020_data_entrega', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('a020_valor') ? 'has-error' : ''}}">
                {!! Form::label('a020_valor', 'Quanto', ['class' => 'control-label']) !!}
                {!! Form::text('a020_valor_form', null, ['class' => 'form-control moneyMaskCuston','autocomplete' => 'off', 'id'=>'a020_valor_form']) !!}
                {!! $errors->first('a020_valor', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group {{ $errors->has('a020_obs') ? 'has-error' : ''}}">
                {!! Form::label('a020_obs', 'Obs', ['class' => 'control-label']) !!}
                {!! Form::text('a020_obs_form', null, ['class' => 'form-control','autocomplete' => 'off', 'id'=>'a020_obs_form']) !!}
                {!! $errors->first('a020_obs', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <label  class="control-label" style="width: 100%;">&nbsp;</label>
            <a class="btn bg-green pull-right" href="javascript: addcotacaofornecedor();" style="width: 100%;">
                <i class="fa fa-plus"></i> Adicionar
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="tablecotacaofornecedor">
                        <tr>
                            <th>Fornecedor</th>
                            <th>E-mail</th>
                            <th>Data Entrega</th>
                            <th>Quanto</th>
                            <th>Obs</th>
                            <th>Status</th>
                            <th style="width:80px">Ação</th>
                        </tr>
                        @if (($fornecedorList??'') != '')
                            @foreach ($fornecedorList as $row)
                                @php
                                    $cor = "bg-info";
                                    //dump($row['a020_status']);
                                    if(($row['a020_status']??"O")=="O")
                                    {
                                        $cor = "bg-info";
                                    }
                                    elseif(($row['a020_status']??"O")=="E")
                                    {
                                        $cor = "bg-warning";
                                    }
                                    elseif(($row['a020_status']??"O")=="A")
                                    {
                                        $cor = "bg-orange";
                                    }
                                    elseif((($row['a020_status']??"O")=="S") || (($row['a020_status']??"O")=="C"))
                                    {
                                        $cor = "bg-danger";
                                    }
                                @endphp
                                <tr class="dados_id bg_add_linha">
                                    <td>{{ $comboFornecedor[($row['a005_id_empresa']??0)]??"" }}<input type="hidden" id="a005_id_empresa_for" name="a005_id_empresa_for[]" value="{{ $row['a005_id_empresa'] }}"></td>
                                    <td>{{ $row['a020_email_outro_fornecedor']??"" }}<input type="hidden" id="a020_email_outro_fornecedor" name="a020_email_outro_fornecedor[]" value="{{ $row['a020_email_outro_fornecedor'] }}"></td>
                                    <td>{{ $row['a020_data_entrega']??"" }}<input type="hidden" id="a020_data_entrega" name="a020_data_entrega[]" value="{{ $row['a020_data_entrega'] }}"></td>
                                    <td>{{ $row['a020_valor']??"" }}<input type="hidden" id="a020_valor" name="a020_valor[]" value="{{ $row['a020_valor'] }}"></td>
                                    <td>{{ $row['a020_obs']??"" }}<input type="hidden" id="a020_obs" name="a020_obs[]" value="{{ $row['a020_obs'] }}"></td>
                                    <td class="tdStatus " >
                                        <span class="label {{$cor}}">{{ $row['a020_status_dsc']??"" }}</span>
                                        <input type="hidden" id="a020_status" name="a020_status[]" value="{{ $row['a020_status'] }}"></td>
                                    <td class="tdAcao">
                                        @if(($row['a020_status']??"") == "O")
                                        <div class="btn btn-danger" title="Remover Fornecedor" onclick="removeCotacaoFornecedor('Tem certeza que deseja excluir este Fornecedor?', this)"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                        @endif
                                        @if(($row['a020_status']??"") == "A")
                                        <div class="btn btn-success botaoAprova" title="Aprovar Cotação" onclick="aprovaCotacaoFornecedor('Tem certeza que deseja Aprovar esta Cotação?', this)"><i class="fa fa-check " aria-hidden="true"></i></div>
                                        @endif
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
