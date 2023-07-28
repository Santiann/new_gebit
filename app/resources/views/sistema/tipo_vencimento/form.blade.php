<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/tipo_vencimento')}}" class="btn btn-default">
       <i class="fa fa-ban"></i> Cancelar
    </a>
    <button type="submit" class="btn bg-olive pull-right">
       <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
</div>

<div class="box-body">
<div class="row">
    <div class="col-md-4" style="{{ (count($comboEmpresa)??0) == 1 ? "display: none;" : "" }}">
        <div class="form-group {{ $errors->has('a005_id_empresa') ? 'has-error' : ''}}">
            {!! Form::label('a005_id_empresa', 'Empresa', ['class' => 'control-label']) !!}
            {!! Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa', 'required' => 'required','autocomplete' => 'off'))!!}
            {!! $errors->first('a005_id_empresa', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>

        </div>
    </div>
    <div class=" {{ (count($comboEmpresa)??0) == 1 ? "col-md-11" : "col-md-7" }}">
        <div class="form-group {{ $errors->has('a012_descricao') ? 'has-error' : ''}}">
            {!! Form::label('a012_descricao', 'Descrição', ['class' => 'control-label']) !!}
            {!! Form::text('a012_descricao', null, ['class' => 'form-control validaunico', 'tablename'=>'t012_tipo_vencimento' ,'pknametable'=>'a012_id_tipo_vencimento', 'pkVal'=>($tipo_vencimento->a012_id_tipo_vencimento??0),'autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'300']) !!}
            {!! $errors->first('a012_descricao', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group ">
            <label class="control-label">Status </label>
            <div style="margin-top: 7px;">
                <label class="control-label">{!! Form::checkbox('a012_status', 1,  ($tipo_vencimento->a012_status??"1") == 1 ?  true : false, ['id' => 'a012_status','class'=>'control-label','autocomplete' => 'off']) !!} Ativo</label>&ensp;
            </div>
        </div>
    </div>

</div>
    @if ($errors->any())
        <div class="row">
            <div class="col-xs-12">
                <div class="callout callout-danger">
                    <ul class="">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                language: 'pt-BR'
            });
            $(".validaunico").blur(function () {
                //validaCampoUnicoExistente(this);
            });
        });
	</script>
@endpush


