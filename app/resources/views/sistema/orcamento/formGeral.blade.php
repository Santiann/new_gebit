<div class="row">
    <div class="col-md-4" style="display: none;">
        <div class="form-group {{ $errors->has('a005_id_empresa') ? 'has-error' : ''}}">
            {!! Form::label('a005_id_empresa', 'Empresa', ['class' => 'control-label']) !!}
            {!! Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control','id'=>'a005_id_empresa', 'required' => 'required','autocomplete' => 'off', 'readonly'=>'readonly'))!!}
            {!! $errors->first('a005_id_empresa', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a018_o_que') ? 'has-error' : ''}}">
            {!! Form::label('a018_o_que', 'O Quê', ['class' => 'control-label']) !!}
            {!! Form::text('a018_o_que', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'200', 'readonly'=>'readonly']) !!}
            {!! $errors->first('a018_o_que', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a018_descricao') ? 'has-error' : ''}}">
            {!! Form::label('a018_descricao', 'Descrição', ['class' => 'control-label']) !!}
            {!! Form::text('a018_descricao', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'200', 'readonly'=>'readonly']) !!}
            {!! $errors->first('a018_descricao', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a018_porque') ? 'has-error' : ''}}">
            {!! Form::label('a018_porque', 'Porquê', ['class' => 'control-label']) !!}
            {!! Form::text('a018_porque', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'200', 'readonly'=>'readonly']) !!}
            {!! $errors->first('a018_porque', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a018_para_quem') ? 'has-error' : ''}}">
            {!! Form::label('a018_para_quem', 'Para Quem', ['class' => 'control-label']) !!}
            {!! Form::text('a018_para_quem', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'200', 'readonly'=>'readonly']) !!}
            {!! $errors->first('a018_para_quem', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a018_data_prevista') ? 'has-error' : ''}}">
            {!! Form::label('a018_data_prevista', 'Data Prevista', ['class' => 'control-label']) !!}
            {!! Form::text('a018_data_prevista', null, ['class' => 'form-control dataMask','autocomplete' => 'off', 'required' => 'required', 'readonly'=>'readonly']) !!}
            {!! $errors->first('a018_data_prevista', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a018_entrega') ? 'has-error' : ''}}">
            {!! Form::label('a018_entrega', 'Entrega', ['class' => 'control-label']) !!}
            {!! Form::text('a018_entrega', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'200', 'readonly'=>'readonly']) !!}
            {!! $errors->first('a018_entrega', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a018_forma_pagamento') ? 'has-error' : ''}}">
            {!! Form::label('a018_forma_pagamento', 'Forma Pagamento', ['class' => 'control-label']) !!}
            {!! Form::text('a018_forma_pagamento', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'200', 'readonly'=>'readonly']) !!}
            {!! $errors->first('a018_forma_pagamento', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a018_onde') ? 'has-error' : ''}}">
            {!! Form::label('a018_onde', 'Onde', ['class' => 'control-label']) !!}
            {!! Form::text('a018_onde', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'200', 'readonly'=>'readonly']) !!}
            {!! $errors->first('a018_onde', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a018_notificar') ? 'has-error' : ''}}">
            {!! Form::label('a018_notificar', 'Notificar', ['class' => 'control-label']) !!}
            {!! Form::text('a018_notificar', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'200', 'readonly'=>'readonly']) !!}
            {!! $errors->first('a018_notificar', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-2" >
        <div class="form-group {{ $errors->has('a020_status') ? 'has-error' : ''}}">
            {!! Form::label('a020_status', 'Status', ['class' => 'control-label']) !!}
            {!! Form::hidden('a020_status', null, ['class' => 'form-control', 'id' => 'a018_status']) !!}
            {!! Form::select('a020_status_combo',$comboStatus,null,array('class' => 'form-control select2 ','id'=>'a020_status_combo', 'required' => 'required','autocomplete' => 'off', 'readonly'=>'readonly'))!!}
            {!! $errors->first('a018_status', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a020_data_entrega') ? 'has-error' : ''}}">
            {!! Form::label('a020_data_entrega', 'Data Entrega', ['class' => 'control-label']) !!}
            {!! Form::text('a020_data_entrega', null, ['class' => 'form-control dataCalendario dataMask','autocomplete' => 'off', 'id'=>'a020_data_entrega', 'required' => 'required']) !!}
            {!! $errors->first('a020_data_entrega', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a020_valor') ? 'has-error' : ''}}">
            {!! Form::label('a020_valor', 'Quanto', ['class' => 'control-label']) !!}
            {!! Form::text('a020_valor', null, ['class' => 'form-control moneyMaskCuston','autocomplete' => 'off', 'id'=>'a020_valor', 'required' => 'required']) !!}
            {!! $errors->first('a020_valor', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('a020_obs') ? 'has-error' : ''}}">
            {!! Form::label('a020_obs', 'Obs', ['class' => 'control-label']) !!}
            {!! Form::text('a020_obs', null, ['class' => 'form-control','autocomplete' => 'off', 'id'=>'a020_obs']) !!}
            {!! $errors->first('a020_obs', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>

</div>

