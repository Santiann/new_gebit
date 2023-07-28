<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>

<div class="row mb-5 justify-content-center">
    <div class="col-md-2">
        <input type="radio" id="contratante" name="a013_empresa_contratante" value="1" {{ isset($contrato) ? ($contrato->a013_empresa_contratante == "1" ? "checked" : "") : "checked" }}>
        <label class="control-label" for="contratante">Sou contratante</label>&ensp;
    </div>
    <div class="col-md-2">
        <input type="radio" id="contratado" name="a013_empresa_contratante" value="2" {{ isset($contrato) && $contrato->a013_empresa_contratante == 2 ? 'checked' : '' }}>
        <label class="control-label" for="contratado">Fui contratado</label>&ensp;
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a005_id_empresa') ? 'has-error' : ''}}">
            {!! Form::label('a005_id_empresa', 'Contratante', ['class' => 'label-contratante control-label']) !!}
            {!! Form::select('a005_id_empresa_select',$comboEmpresa,null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa', 'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a005_id_empresa', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a005_id_empresa_cli_for') ? 'has-error' : ''}}">

            @permission('empresa-create')
                @include ('sistema.contrato.modals.create_company')
                <button type="button" class="button-modal btn btn-sm bg-olive mr-2" style="font-size: 6px" data-toggle="modal" data-target="#createCompanyModal">
                <i class="fa fa-plus"></i>
                </button>
            @endpermission
            {!! Form::label('a005_id_empresa_cli_for', 'Contratada', ['class' => 'label-contratada control-label']) !!}
            @if (isset($cli_for))
            {!! Form::select('a005_id_empresa_cli_for',[$cli_for->a005_id_empresa => $cli_for->a005_nome_fantasia ?? $cli_for->a005_razao_social ?? $cli_for->a005_nome_completo],null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa_cli_for', 'required' => 'required','autocomplete' => 'off'))!!}
            @else
            {!! Form::select('a005_id_empresa_cli_for',[],null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa_cli_for', 'required' => 'required','autocomplete' => 'off'))!!}
            @endif
            {!! $errors->first('a005_id_empresa_cli_for', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a013_numero_contrato') ? 'has-error' : ''}}">
            {!! Form::label('a013a013_numero_contrato', 'Número Contrato', ['class' => 'control-label']) !!}
            {!! Form::text('a013_numero_contrato', null, ['class' => 'form-control alfaNumericoMask20 validaunico', 'tablename'=>'t013_contrato' ,'pknametable'=>'a013_id_contrato','id'=>'a013_numero_contrato', 'pkVal'=>($contrato->a013_id_contrato??0),'autocomplete' => 'off', 'required' => 'required']) !!}
            {!! $errors->first('a013_numero_contrato', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('a013_referencia_cliente') ? 'has-error' : ''}}">
                {!! Form::label('a013_referencia_cliente', 'Referência do Cliente   ', ['class' => 'control-label']) !!}
                {!! Form::text('a013_referencia_cliente', null, ['maxlength'=>'20','class' => 'form-control','autocomplete' => 'off', 'readonly' => isset($isFornecedor) && $isFornecedor]) !!}
                {!! $errors->first('a013_referencia_cliente', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('a013_referencia_fornecedor') ? 'has-error' : ''}}">
                {!! Form::label('a013_referencia_fornecedor', 'Referência do Fornecedor   ', ['class' => 'control-label']) !!}
                {!! Form::text('a013_referencia_fornecedor', null, ['maxlength'=>'20','class' => 'form-control','autocomplete' => 'off', 'readonly' => isset($isFornecedor) && !$isFornecedor]) !!}
                {!! $errors->first('a013_referencia_fornecedor', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('a013_finalidade_cliente') ? 'has-error' : ''}}">
                {!! Form::label('a013_finalidade_cliente', 'Finalidade Cliente', ['class' => 'control-label']) !!}
                {!! Form::textarea('a013_finalidade_cliente', null, ['class' => 'form-control','maxlength' => '1024', 'autocomplete' => 'off', 'rows' => 3, 'cols' => 54, 'onkeyup' => 'countChar(this, 1024)', 'readonly' => isset($isFornecedor) && $isFornecedor]) !!}
                Este campo deve conter no máximo 1024 caracteres. <span class="charNum"></span> caracteres restantes.
                {!! $errors->first('a013_finalidade_cliente', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('a013_finalidade_fornecedor') ? 'has-error' : ''}}">
                {!! Form::label('a013_finalidade_fornecedor', 'Finalidade Fornecedor', ['class' => 'control-label']) !!}
                {!! Form::textarea('a013_finalidade_fornecedor', null, ['class' => 'form-control','maxlength' => '1024', 'autocomplete' => 'off', 'rows' => 3, 'cols' => 54, 'onkeyup' => 'countChar(this, 1024)', 'readonly' => isset($isFornecedor) && !$isFornecedor]) !!}
                Este campo deve conter no máximo 1024 caracteres. <span class="charNum"></span> caracteres restantes.
                {!! $errors->first('a013_finalidade_fornecedor', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
<div class="row ">
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a013_data_inicio') ? 'has-error' : ''}}">
            {!! Form::label('a013_data_inicio', 'Data de Início do Contrato', ['class' => 'control-label']) !!}
            {!! Form::text('a013_data_inicio', null, ['id' => 'a013_data_inicio', 'class' => 'a013_data_inicio form-control dataMask','autocomplete' => 'off', 'required' => 'required','pattern'=>'(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)']) !!}
            {!! $errors->first('a013_data_inicio', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-2 periodo">
        <div class="form-group">
            {!! Form::label('periodo', 'Tempo de Contrato', ['class' => 'control-label']) !!}
            <select class="form-control" id="periodo" data-toggle="tooltip" data-placement="bottom" title="Escolha o período de contrato.">
                <option value="dias" selected>Dias</option>
                <option value="semanas">Semanas</option>
                <option value="meses">Meses</option>
                <option value="anos">Anos</option>
                <!-- <option value="">Personalizado</option> -->
            </select>
        </div>
    </div>
    <div class="col-md-1 periodo">
        <div class="form-group {{ $errors->has('a013_prazo_contrato') ? 'has-error' : ''}}">
            {!! Form::label('a013_prazo_contrato', 'Quantidade', ['class' => 'control-label']) !!}
            {!! Form::text('a013_prazo_contrato', null, ['id' => 'valor_periodo', 'class'  => 'form-control numero3Mask','autocomplete' => 'off', 'required' => 'required', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Digite o número equivalente ao período, por exemplo, se selecionou no campo Tempo de Contrato a opção Dias, digite 30 para ficar 30 dias.']) !!}
            {!! Form::hidden('a013_prazo_contrato', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required']) !!}
            {!! $errors->first('a013_prazo_contrato', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a013_data_fim') ? 'has-error' : ''}}">
            {!! Form::label('a013_data_fim', 'Data Fim', ['class' => 'control-label']) !!}
            {!! Form::text('a013_data_fim', null, ['readonly' => 'true', 'class' => ' a013_data_fim form-control  dataMask','autocomplete' => 'off', 'required' => 'required','pattern'=>'(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)']) !!}
            {!! $errors->first('a013_data_fim', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a013_data_renovacao') ? 'has-error' : ''}}">
            {!! Form::label('a013_data_renovacao', 'Data Renovação', ['class' => 'control-label']) !!}
            {!! Form::text('a013_data_renovacao', null, ['class' => 'a013_data_renovacao form-control dataMask', 'readonly'=>'readonly', 'autocomplete' => 'off','tabIndex'=>'-1','pattern'=>'(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)']) !!}
            {!! $errors->first('a013_data_renovacao', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group {{ $errors->has('a013_dias_vencimento') ? 'has-error' : ''}}">
            {!! Form::label('a013_dias_vencimento', 'Dia Vencimento', ['class' => 'control-label']) !!}
            {!! Form::text('a013_dias_vencimento', null, ['class' => 'form-control numero3Mask','autocomplete' => 'off', 'required' => 'required', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Este campo diz respeito a quando deverá ser paga a parcela.
                Mudar a posição deste campo para o lado direito após o campo recorrência.']) !!}
            {!! $errors->first('a013_dias_vencimento', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('a013_moeda') ? 'has-error' : ''}}">
            {!! Form::label('a013_moeda', 'Moeda', ['class' => 'control-label']) !!}
            {!! Form::select('a013_moeda',
                [
                    'real' => 'Real',
                    'dolar' => 'Dólar',
                    'euro' => 'Euro',
                ]
            ,null,array('class' => 'form-control  ','id'=>'a013_moeda', 'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a013_moeda', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group {{ $errors->has('a013_valor_fracao') ? 'has-error' : ''}}">
            {!! Form::label('a013_valor_fracao', 'Valor da parcela', ['class' => 'control-label']) !!}
            {!! Form::text('a013_valor_fracao', null, ['id' => 'a013_valor_fracao', 'class' => 'form-control moneyMaskCuston','autocomplete' => 'off']) !!}
            {!! $errors->first('a013_valor_fracao', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-3 recorrencia">
        <div class="form-group">
            {!! Form::label('recorrencia', 'Recorrência', ['class' => 'control-label']) !!}
            {!! Form::select('a013_recorrencia',
                [
                    'mensal' => 'Mensal',
                    'bimestral' => 'Bimestral',
                    'trimestral' => 'Trimestral',
                    'semestral' => 'Semestral',
                    'anual' => 'Anual',
                ]
            ,null,array('class' => 'form-control select2 ','id'=>'recorrencia', 'required' => 'required','autocomplete' => 'off'))!!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('a013_valor_extra') ? 'has-error' : ''}}">
            {!! Form::label('a013_valor_extra', 'Valor Extra', ['class' => 'control-label']) !!}
            {!! Form::text('a013_valor_extra', null, ['id' => 'a013_valor_extra', 'class' => 'form-control moneyMaskCuston','autocomplete' => 'off', '' => '', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Este campo diz respeito a custos extras que podem haver no início do contrato, como por exemplo, um setup, uma implantação.']) !!}
            {!! $errors->first('a013_valor_extra', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('a013_valor_total_contrato') ? 'has-error' : ''}}">
            {!! Form::label('a013_valor_total_contrato', 'Valor total do contrato', ['class' => 'control-label']) !!}
            {!! Form::text('a013_valor_total_contrato', null, ['id' => 'a013_valor_total_contrato','readonly' => 'true', 'class' => 'form-control moneyMaskCuston','autocomplete' => 'off']) !!}
            {!! $errors->first('a013_valor_total_contrato', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('a013_valor_extra_referencia') ? 'has-error' : ''}}">
            {!! Form::label('a013_valor_extra_referencia', 'Referência', ['class' => 'control-label']) !!}
            {!! Form::textarea('a013_valor_extra_referencia', null, ['id' => 'a013_valor_extra_referencia','minlength'=>'256', 'class' => 'form-control ','autocomplete' => 'off', '' => '', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Insira o motivo para a cobrança do valor extra.']) !!}
            {!! $errors->first('a013_valor_extra_referencia', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
</div>
<div class="row">
    
    <!-- <div class="col-md-3">
        <div class="form-group {{ $errors->has('a013_valor_comissao') ? 'has-error' : ''}}">
            {!! Form::label('a013_valor_comissao', 'Valor Comissão', ['class' => 'control-label']) !!}
            {!! Form::text('a013_valor_comissao', null, ['class' => 'form-control moneyMaskCuston','autocomplete' => 'off', '' => '']) !!}
            {!! $errors->first('a013_valor_comissao', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div> -->
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a013_periodicidade_reajuste') ? 'has-error' : ''}}">
            {!! Form::label('a013_periodicidade_reajuste', 'Periodicidade Reajuste (meses)', ['class' => 'control-label']) !!}
            {!! Form::text('a013_periodicidade_reajuste', null, ['class' => 'form-control numero3Mask','autocomplete' => 'off']) !!}
            {!! $errors->first('a013_periodicidade_reajuste', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a013_indice_reajuste') ? 'has-error' : ''}}">
            {!! Form::label('a013_indice_reajuste', 'Índice Reajuste', ['class' => 'control-label']) !!}
            {!! Form::text('a013_indice_reajuste', null, ['class' => 'form-control ','autocomplete' => 'off', 'maxlength'=>'500']) !!}
            {!! $errors->first('a013_indice_reajuste', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a013_prazo_recisao') ? 'has-error' : ''}}">
            {!! Form::label('a013_prazo_recisao', 'Aviso de rescisão (em dias)', ['class' => 'control-label']) !!}
            {!! Form::text('a013_prazo_recisao', null, ['class' => 'form-control numero4Mask','autocomplete' => 'off', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'é com base no valor deste campo que o sistema enviará alertas de que o contrato está prestes a ser renovado.' ]) !!}
            {!! $errors->first('a013_prazo_recisao', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <!-- <div class="col-md-4">
        <div class="form-group {{ $errors->has('a013_custo_recisao_antecipada') ? 'has-error' : ''}}">
            {!! Form::label('a013_custo_recisao_antecipada', 'Custo Recisão Antecipada', ['class' => 'control-label']) !!}
            {!! Form::text('a013_custo_recisao_antecipada', null, ['class' => 'form-control moneyMaskCuston','autocomplete' => 'off']) !!}
            {!! $errors->first('a013_custo_recisao_antecipada', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div> -->
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('a013_obs_custo_revisao_antec') ? 'has-error' : ''}}">
            {!! Form::label('a013_obs_custo_revisao_antec', 'Condições para rescisão antecipada', ['class' => 'control-label']) !!}
            {!! Form::textarea('a013_obs_custo_revisao_antec', null, ['class' => 'form-control','autocomplete' => 'off','maxlength'=> '256', 'onkeyup' => 'countChar(this, 256)']) !!}
            {!! $errors->first('a013_obs_custo_revisao_antec', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
   <!--  @if (!isset($isFornecedorOrAdmin) || $isFornecedorOrAdmin )
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a013_conta_contabil') ? 'has-error' : ''}}">
            {!! Form::label('a013_conta_contabil', 'Conta Contabil', ['class' => 'control-label']) !!}
            {!! Form::text('a013_conta_contabil', null, ['class' => 'form-control','autocomplete' => 'off']) !!}
            {!! $errors->first('a013_conta_contabil', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div> 
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('a001_id_usuario') ? 'has-error' : ''}}">
            {!! Form::label('a001_id_usuario', 'Responsável', ['class' => 'control-label']) !!}
            {!! Form::select('a001_id_usuario',$comboResponsavel,null,array('class' => 'form-control select2 ','id'=>'a001_id_usuario', 'autocomplete' => 'off'))!!}
            {!! $errors->first('a001_id_usuario', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    @endif-->
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('a013_obs_contrato_cliente') ? 'has-error' : ''}}">
            {!! Form::label('a013_obs_contrato_cliente', 'Obs. Contrato Cliente', ['class' => 'control-label']) !!}
            {!! Form::textarea('a013_obs_contrato_cliente', null, ['class' => 'form-control','maxlength'=> '500', 'autocomplete' => 'off', 'onkeyup' => 'countChar(this, 500)', 'readonly' => isset($isFornecedor) && $isFornecedor]) !!}
            Este campo deve conter no máximo 500 caracteres. <span class="charNum"></span> caracteres restantes.
            {!! $errors->first('a013_obs_contrato_cliente', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('a013_obs_contrato_fornecedor') ? 'has-error' : ''}}">
            {!! Form::label('a013_obs_contrato_fornecedor', 'Obs. Contrato Fornecedor', ['class' => 'control-label']) !!}
            {!! Form::textarea('a013_obs_contrato_fornecedor', null, ['class' => 'form-control','maxlength'=> '500', 'autocomplete' => 'off', 'onkeyup' => 'countChar(this, 500)', 'readonly' => isset($isFornecedor) && !$isFornecedor]) !!}
            Este campo deve conter no máximo 500 caracteres. <span class="charNum"></span> caracteres restantes.
            {!! $errors->first('a013_obs_contrato_fornecedor', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>

    @if (!isset($isFornecedorOrAdmin) || $isFornecedorOrAdmin )
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('a008_id_cat_contrato') ? 'has-error' : ''}}">

            @permission('categoria_contrato-create')
                @include ('sistema.contrato.modals.create_category')
                <!-- Button trigger modal -->
                <button type="button" class="button-modal btn btn-sm bg-olive mr-2" style="font-size: 6px" data-toggle="modal" data-target="#createCategoryModal">
                <i class="fa fa-plus"></i>
                </button>
            @endpermission
            {!! Form::label('a008_id_cat_contrato', 'Categoria', ['class' => 'control-label']) !!}
            {!! Form::select('a008_id_cat_contrato[]',$comboCategoria_contrato,isset($contrato) ? $contrato->Categoria_contrato_belongsTo()->wherePivotIn('a005_id_empresa',$id_empresas)->get() : 0,array('class' => 'form-control jmultipleselect2 ','id'=>'a008_id_cat_contrato', 'required' => 'required','autocomplete' => 'off', 'multiple' => 'multiple'))!!}
            {!! $errors->first('a008_id_cat_contrato', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('a013_centro_custo') ? 'has-error' : ''}}">
            {!! Form::label('a013_centro_custo', 'Centro Custo', ['class' => 'control-label']) !!}
            {!! Form::text('a013_centro_custo', null, ['class' => 'form-control','autocomplete' => 'off']) !!}
            {!! $errors->first('a013_centro_custo', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a011_id_area') ? 'has-error' : ''}}">

            @permission('area_contrato-create')
                @include ('sistema.contrato.modals.create_area')
                <!-- Button trigger modal -->
                <button type="button" class="button-modal btn btn-sm bg-olive mr-2" style="font-size: 6px" data-toggle="modal" data-target="#createAreaModal">
                <i class="fa fa-plus"></i>
                </button>
            @endpermission
            {!! Form::label('a011_id_area', 'Área', ['class' => 'control-label']) !!}
            {!! Form::select('a011_id_area',$comboArea_contrato,null,array('class' => 'form-control select2 ','id'=>'a011_id_area', 'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a011_id_area', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    @endif
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a010_id_tipo_contrato') ? 'has-error' : ''}}">

            @permission('tipo_contrato-create')
                @include ('sistema.contrato.modals.create_type')
                <!-- Button trigger modal -->
                <button type="button" class="button-modal btn btn-sm bg-olive mr-2" style="font-size: 6px" data-toggle="modal" data-target="#createTypeModal">
                <i class="fa fa-plus"></i>
                </button>
            @endpermission
            {!! Form::label('a010_id_tipo_contrato', 'Tipo', ['class' => 'control-label']) !!}
            {!! Form::select('a010_id_tipo_contrato',$comboTipo_contrato,null,array('class' => 'form-control select2 ','id'=>'a010_id_tipo_contrato', 'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a010_id_tipo_contrato', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a013_classificacao') ? 'has-error' : ''}}">
            {!! Form::label('a013_classificacao', 'Classificação', ['class' => 'control-label']) !!}
            {!! Form::select('a013_classificacao',$comboClassificacao,null,array('class' => 'form-control select2 ','id'=>'a013_classificacao', 'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a013_classificacao', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>



    <!-- <div class="col-md-4">
        <div class="form-group {{ $errors->has('a013_assinatura') ? 'has-error' : ''}}">
            {!! Form::label('a013_assinatura', 'Upload de Assinatura', ['class' => 'control-label']) !!}
            <div class=" ">
                {!! Form::file('a013_assinatura', ['class' => ' a013_assinatura',''=>'', 'id'=>'a013_assinatura',"multiple"=>"multiple"]) !!}
            </div>
            {!! $errors->first('a013_assinatura', '<p class="help-block">:message</p>') !!}
        </div>
    </div> -->

    <div class="col-md-8" style="padding: 0;">
        <div class="form-group ">
            <div class="col-md-12">
                <div class="form-group ">
                    <label class="control-label">Status </label>
                    <div style="margin-top: 7px;">
                        <label class="control-label">{!! Form::radio('a013_status', 'A',  ($contrato->a013_status??"A") == 'A' ?  true : false, ['id' => 'a013_status_A','class'=>'control-label a013_status','autocomplete' => 'off']) !!} Ativo</label>&ensp;
                        <label class="control-label">{!! Form::radio('a013_status', 'D',  ($contrato->a013_status??"A") == 'D' ?  true : false, ['id' => 'a013_status_D','class'=>'control-label a013_status','autocomplete' => 'off']) !!} Inativo</label>&ensp;
                        <label class="control-label">{!! Form::radio('a013_status', 'C',  ($contrato->a013_status??"A") == 'C' ?  true : false, ['id' => 'a013_status_C','class'=>'control-label a013_status','autocomplete' => 'off']) !!} Cancelado</label>&ensp;
                        <label class="control-label">{!! Form::radio('a013_status', 'V',  ($contrato->a013_status??"A") == 'V' ?  true : false, ['id' => 'a013_status_V','class'=>'control-label a013_status','autocomplete' => 'off']) !!} Vencido</label>&ensp;
                    </div>
                </div>
            </div>
            <div class="col-md-12 jMostraTermo" style="display: none;">
                <div class="form-group ">
                    <label class="control-label" style="width: 100%">Termo de Cancelamento: </label>
                    <label class="control-label jtermoCancel" style="width: 100%;font-weight:normal;"></label>
                    <div style="margin-top: 7px;">
                        <label class="control-label">
                            {!! Form::checkbox('a013_aceita_termo', '1',  ($contrato->a013_aceita_termo??"0") == '1' ?  true : false, ['id' => 'a013_aceita_termo','class'=>'control-label','autocomplete' => 'off']) !!} Aceite do Termo de Cancelamento</label>&ensp;
                            {!! $errors->first('a013_obs_contrato', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                    </div>
                    <div class="jMotraDataUserCancelou" style="margin-top: 7px;display: none;">
                        <label class="control-label">Data: <span class="dataCancelamento" style="font-weight:normal;">{{$contrato->a013_data_cancelado??""}}</span></label>&ensp;<label class="control-label">Usuário: <span style="font-weight:normal;">{{ $contrato->usuarioCancelou??Auth::user()->name }}</span></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-3">
        <div class="form-group ">
            <img src="{{ ($contrato->a013_assinatura??"") != "" ? url('storage/'.@$contrato->a013_assinatura) : asset('/img/sem-image.jpg') }}" style="max-height: 250px; max-width: 250px;">
            <div class="help-block with-errors"></div>
        </div>
    </div> -->
</div>

@push('js')
<script>
    window.onload = function() {
        $('.jmultipleselect2').select2({
            language: "pt"
        });

        let app_env = "{{ env('APP_ENV') }}"

        if (app_env == 'production') {
            $.alert("Para qualquer alteração realizada, as empresas vinculadas serão notificadas.");
        }

        selectClienteFornecedor();
        @if(!isset($contrato))
        $('[name="a005_id_empresa_select"]').trigger('change')
        @endif
    };

    function selectClienteFornecedor()
    {
        $('#a005_id_empresa_cli_for').select2({
            language: "es",
            minimumInputLength: 3,
            ajax: {
                url:'/empresa_buscaExistente/true/' + $('[name="a013_empresa_contratante"]:checked').val(),
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    var query = {
                        valorDigitado: params.term,
                        type: 'public'
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.a005_nome_completo ?? item.a005_nome_fantasia ?? item.a005_razao_social,
                                id: item.a005_id_empresa
                            }
                        })
                    };
                }
            },
        });
    }

    $('#contratante, #contratado').change(function(){
        let text = $(this).val() == 1 ? 'Contratante' : 'Contratada';
        let label_contratante = $('.label-contratante')

        $('.label-contratada').text(label_contratante.text())
        label_contratante.text(text)

        $('#a005_id_empresa_cli_for').empty().select2();
        selectClienteFornecedor();
    });

    $('#periodo, #valor_periodo, #a013_data_inicio, #a013_valor_fracao, #a013_valor_extra, #recorrencia').change(function(){
        let valor_periodo = $('#valor_periodo').val() || 1
        let valor_fracao = parseFloat( $('#a013_valor_fracao').val().replace(/[.]/g, '').replace(',','.') )
        let valor_extra = $('#a013_valor_extra').val() ? parseFloat( $('#a013_valor_extra').val().replace(/[.]/g, '').replace(',','.') ) : 0
        let periodo = $('#periodo').val()
        let recorrencia = $('#recorrencia').val()
        let valor_recorrencia, valor_total = 0

        if (periodo == 'anos') {
            switch (recorrencia) {
                case 'mensal':
                    valor_recorrencia = 12
                    break;
                case 'bimestral':
                    valor_recorrencia = 6
                    break;
                case 'trimestral':
                    valor_recorrencia = 4
                    break;
                case 'semestral':
                    valor_recorrencia = 2
                    break;
                case 'anual':
                    valor_recorrencia = 1
                    break;
            }

            valor_total = valor_periodo * valor_recorrencia * valor_fracao
        }
        else {
            
            switch (periodo) {
                case 'dias':
                    switch (recorrencia) {
                        case 'mensal':
                            valor_recorrencia = 30
                            break;
                        case 'bimestral':
                            valor_recorrencia = 60
                            break;
                        case 'trimestral':
                            valor_recorrencia = 90
                            break;
                        case 'semestral':
                            valor_recorrencia = 180
                            break;
                        case 'anual':
                            valor_recorrencia = 365
                            break;
                    }
                    break;
                case 'semanas':
                    switch (recorrencia) {
                        case 'mensal':
                            valor_recorrencia = 4
                            break;
                        case 'bimestral':
                            valor_recorrencia = 8
                            break;
                        case 'trimestral':
                            valor_recorrencia = 12
                            break;
                        case 'semestral':
                            valor_recorrencia = 24
                            break;
                        case 'anual':
                            valor_recorrencia = 48
                            break;
                    }
                    break;
                case 'meses':
                    switch (recorrencia) {
                        case 'mensal':
                            valor_recorrencia = 1
                            break;
                        case 'bimestral':
                            valor_recorrencia = 2
                            break;
                        case 'trimestral':
                            valor_recorrencia = 3
                            break;
                        case 'semestral':
                            valor_recorrencia = 6
                            break;
                        case 'anual':
                            valor_recorrencia = 12
                            break;
                    }
                    break;
            }

            valor_total = valor_periodo * valor_fracao / valor_recorrencia
        }
    
        let total = valor_total < valor_fracao ? valor_fracao : valor_total
        total += valor_extra
        total = isNaN( total ) ? 0.00 : total

        $('#a013_valor_total_contrato').val(new Intl.NumberFormat('pt-BR').format(total))
        
    })

    
    $('.modal').on('hidden.bs.modal', function () {
        $('.modal [name="a005_id_empresa"]').prop('disabled',true)
    })
    $('.modal').on('show.bs.modal', function () {
        $('.modal [name="a005_id_empresa"]').prop('disabled',false)
    })

    function countChar(that, max) {
        let len = that.value.length;
        let count = max - len;

        if (count >= 0)
            $(that).next('.charNum').text(count);
    };

    $('#a005_id_empresa_cli_for').on('select2:select', function (e) {
        $.alert("Será enviado um convite para o cliente/fornecedor participar deste contrato. "+
                "Caso aceite, este terá acesso e poderá alterar os campos até que ambas as partes entrem em acordo.");
    });

</script>
@endpush