@if(!isset($hide_header_buttons))
<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/area_contrato')}}" class="btn btn-default">
       <i class="fa fa-ban"></i> Cancelar
    </a>
    <button type="submit" class="btn bg-olive pull-right">
       <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
</div>
@endif

<div class="box-body">
<div class="row">
    <div class="col-md-4" style="{{ (count($comboEmpresa)??0) == 1 ? "display: none;" : "" }}">
        <div class="form-group {{ $errors->has('a005_id_empresa') ? 'has-error' : ''}}">
            {!! Form::label('a005_id_empresa', 'Empresa', ['class' => 'control-label']) !!}
            @if(!isset($hide_header_buttons))
                {!! Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa', 'required' => 'required','autocomplete' => 'off'))!!}
            @else
                {!! Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control select2 ','id'=>'a005_id_empresa_area','autocomplete' => 'off'))!!}
            @endif
            {!! $errors->first('a005_id_empresa', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>

        </div>
    </div>
    <div class=" {{ (count($comboEmpresa)??0) == 1 ? "col-md-11" : "col-md-7" }}">
        <div class="form-group {{ $errors->has('a011_descricao') ? 'has-error' : ''}}">
            {!! Form::label('a011_descricao', 'Descrição', ['class' => 'control-label']) !!}
            @if(!isset($hide_header_buttons))
                {!! Form::text('a011_descricao', null, ['class' => 'form-control validaunico', 'tablename'=>'t011_area_contrato' ,'pknametable'=>'a011_id_area', 'pkVal'=>($area_contrato->a011_id_area??0),'autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'300']) !!}
            @else
                {!! Form::text('a011_descricao', null, ['class' => 'form-control', 'tablename'=>'t011_area_contrato' ,'pknametable'=>'a011_id_area', 'pkVal'=>($area_contrato->a011_id_area??0),'autocomplete' => 'off', 'maxlength'=>'300']) !!}
            @endif
            {!! $errors->first('a011_descricao', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group ">
            <label class="control-label">Status </label>
            <div style="margin-top: 7px;">
                <label class="control-label">{!! Form::checkbox('a011_status', 1,  ($area_contrato->a011_status??"1") == 1 ?  true : false, ['id' => 'a011_status','class'=>'control-label','autocomplete' => 'off']) !!} Ativo</label>&ensp;
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


