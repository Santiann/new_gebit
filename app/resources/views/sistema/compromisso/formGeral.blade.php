
<div class="row">
    <div class="col-md-1 jclasscodigo" style="display: none;">
        <div class="form-group {{ $errors->has('a022_id_compromisso') ? 'has-error' : ''}}">
            {!! Form::label('a022_id_compromisso', 'Código', ['class' => 'control-label']) !!}
            {!! Form::text('a022_id_compromisso', null, ['class' => 'form-control ','autocomplete' => 'off',$readonly??"", 'disabled'=>'disabled']) !!}
            {!! $errors->first('a022_id_compromisso', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-3" style="{{ (count($comboEmpresa)??0) == 1 ? "display: none;" : "" }}">
        <div class="form-group {{ $errors->has('a005_id_empresa') ? 'has-error' : ''}}">
            {!! Form::label('a005_id_empresa', 'Empresa', ['class' => 'control-label']) !!}
            {!! Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa', $readonly??"",'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a005_id_empresa', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <!-- <div class="{{ (count($comboEmpresa)??0) == 1 ? "col-md-4" : "col-md-3" }}">
        <div class="form-group {{ $errors->has('a013_id_contrato') ? 'has-error' : ''}}">
            {!! Form::label('a013_id_contrato', 'Contrato', ['class' => 'control-label']) !!}
            {!! Form::select('a013_id_contrato',[],null,array('class' => 'form-control select2 ','id'=>'a013_id_contrato', $readonly??"", 'autocomplete' => 'off'))!!}
            {!! $errors->first('a013_id_contrato', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div> -->
    <!-- <div class="{{ (count($comboEmpresa)??0) == 1 ? "col-md-4" : "col-md-3" }}">
        <div class="form-group {{ $errors->has('a005_id_empresa_cli_for') ? 'has-error' : ''}}">
            {!! Form::label('a005_id_empresa_cli_for', 'Cliente/Fornecedor', ['class' => 'control-label']) !!}
            {!! Form::select('a005_id_empresa_cli_for',[],null,array('class' => 'form-control select2 ', $readonly??"",'id'=>'a005_id_empresa_cli_for', 'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a005_id_empresa_cli_for', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div> -->
    <!-- <div class="{{ (count($comboEmpresa)??0) == 1 ? "col-md-4" : "col-md-3" }} jclassclassificacao">
        <div class="form-group {{ $errors->has('a022_classificacao') ? 'has-error' : ''}}">
            {!! Form::label('a022_classificacao', 'Classificação', ['class' => 'control-label']) !!}
            {!! Form::select('a022_classificacao',$comboClassificacao,null,array('class' => 'form-control select2 ', $readonly??"",'id'=>'a022_classificacao', 'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a022_classificacao', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div> -->

    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a022_data_vencimento') ? 'has-error' : ''}}">
            {!! Form::label('a022_data_vencimento', 'Data Vencimento', ['class' => 'control-label']) !!}
            {!! Form::text('a022_data_vencimento', null, ['class' => 'form-control dataCalendario dataMask','autocomplete' => 'off', $readonly??"",'required' => 'required']) !!}
            {!! $errors->first('a022_data_vencimento', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a022_valor_pagar') ? 'has-error' : ''}}">
            {!! Form::label('a022_valor_pagar', 'Valor a Pagar', ['class' => 'control-label']) !!}
            {!! Form::text('a022_valor_pagar', null, ['class' => 'form-control moneyMaskCuston','autocomplete' => 'off', $readonly??""]) !!}
            {!! $errors->first('a022_valor_pagar', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a022_data_pagamento') ? 'has-error' : ''}}">
            {!! Form::label('a022_data_pagamento', 'Data Pagamento', ['class' => 'control-label']) !!}
            {!! Form::text('a022_data_pagamento', null, ['class' => 'form-control dataCalendario dataMask','autocomplete' => 'off', $required??""]) !!}
            {!! $errors->first('a022_data_pagamento', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('a022_finalidade') ? 'has-error' : ''}}">
            {!! Form::label('a022_finalidade', 'Finalidade', ['class' => 'control-label']) !!}
            {!! Form::text('a022_finalidade', null, ['class' => 'form-control','autocomplete' => 'off', $readonly??"",'required' => 'required']) !!}
            {!! $errors->first('a022_finalidade', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a022_data_inicio') ? 'has-error' : ''}}">
            {!! Form::label('a022_data_inicio', 'Data Início', ['class' => 'control-label']) !!}
            {!! Form::text('a022_data_inicio', null, ['id' => 'a022_data_inicio', 'class' => 'a022_data_inicio form-control dataMask','autocomplete' => 'off', 'required' => 'required','pattern'=>'(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)']) !!}
            {!! $errors->first('a022_data_inicio', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a022_data_fim') ? 'has-error' : ''}}">
            {!! Form::label('a022_data_fim', 'Data Fim', ['class' => 'control-label']) !!}
            {!! Form::text('a022_data_fim', null, ['class' => ' a022_data_fim form-control  dataMask','autocomplete' => 'off','pattern'=>'(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)']) !!}
            {!! $errors->first('a022_data_fim', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-2 periodo">
        <div class="form-group">
            {!! Form::label('periodo', 'Período', ['class' => 'control-label']) !!}
            {!! Form::select('a022_recorrencia',['diario'=>'Diário','semanal'=>'Semanal','mensal'=>'Mensal','semestral'=>'Semestral','anual'=>'Anual'],isset($compromisso) ? $compromisso->a022_recorrencia : null,array('class' => 'form-control select2 ','id'=>'periodo','autocomplete' => 'off'))!!}
        </div>
    </div>
    <!-- <div class="col-md-2">
        <div class="form-group {{ $errors->has('a022_valor_pago') ? 'has-error' : ''}}">
            {!! Form::label('a022_valor_pago', 'Valor Pago', ['class' => 'control-label']) !!}
            {!! Form::text('a022_valor_pago', null, ['class' => 'form-control moneyMaskCuston','autocomplete' => 'off', $required??""]) !!}
            {!! $errors->first('a022_valor_pago', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div> -->
    <!-- <div class="col-md-8">
        <div class="form-group {{ $errors->has('a022_forma_pagamento') ? 'has-error' : ''}}">
            {!! Form::label('a022_forma_pagamento', 'Forma Pagamento', ['class' => 'control-label']) !!}
            {!! Form::text('a022_forma_pagamento', null, ['class' => 'form-control','autocomplete' => 'off', $required??""]) !!}
            {!! $errors->first('a022_forma_pagamento', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div> -->
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a022_status') ? 'has-error' : ''}}">
            {!! Form::label('a022_status', 'Status', ['class' => 'control-label']) !!}
            {!! Form::select('a022_status',$comboStatus,null,array('class' => 'form-control select2 ', $readonly??"",'id'=>'a022_status', 'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a022_status', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group " >
            <label class="control-label">Uso Vital</label>
            <div style="margin-top: 7px;">
                <label class="control-label">{!! Form::checkbox('a022_uso_vital', 1,  ($compromisso->a022_uso_vital??0) == 1 ?  true : false, ['id' => 'a022_uso_vital','class'=>'control-label', $readonly??""]) !!} Sim</label>&ensp;
            </div>
        </div>
    </div>


</div>


