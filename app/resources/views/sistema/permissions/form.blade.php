<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/permissions')}}" class="btn btn-default">
       <i class="fa fa-ban"></i> Cancelar
    </a>
    <button type="submit" class="btn btn-success pull-right">
       <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
</div>
@if(Session::has('flash_message'))
    <div class="alert alert-info">
        <a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
        <strong>{!! Session::get('flash_message') !!}</strong>
    </div>
@endif

<div class="box-body">
	<div class="row">
		<div class="col-md-4" style="display: none;">
			<div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
				{!! Form::label('tipo', 'Tipo', ['class' => 'control-label']) !!}
				{{ Form::select('tipo', ['MENU'=>'Menu','PERM'=>'Permissão'], null, ['class' => 'form-control', 'required' => 'required']) }}
				{!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
			</div>
		</div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('display_name') ? 'has-error' : ''}}">
                {!! Form::label('display_name', 'Nome do Menu', ['class' => 'control-label']) !!}
                {!! Form::text('display_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('display_name', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
		<div class="col-md-4">
			<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
				{!! Form::label('name', 'Nome Interno', ['class' => 'control-label']) !!}
				{!! Form::text('name', null, ['class' => 'form-control jnomeInterno', 'required' => 'required']) !!}
				{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
			</div>
		</div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
                {!! Form::label('url', 'Url', ['class' => 'control-label']) !!}
                {!! Form::text('url', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
	</div>
	<div class="row">

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('idparent') ? 'has-error' : ''}}">
                {!! Form::label('idparent', 'Menu Pai', ['class' => 'control-label']) !!}
                <select class="form-control" name="idparent" id="idparent" onchange="carregaordemPai(this);">
                    <option ordem="000000000000" value=""></option>
                    @if(@$menuspai)
                        @foreach($menuspai as $menu)
                            @if($menu->id == @$permission->idparent)
                                <option ordem="{{$menu->ordem}}" value="{{$menu->id}}" selected="selected">{!! '('.$menu->ordem.') '.$menu->espacamento.$menu->display_name." (".$menu->url.")"!!}</option>
                            @else
                                <option ordem="{{$menu->ordem}}" value="{{$menu->id}}">{!! '('.$menu->ordem.') '.$menu->espacamento.$menu->display_name." (".$menu->url.")" !!}</option>
                            @endif

                        @endforeach
                    @endif
                </select>
                {!! $errors->first('idparent', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('ordem') ? 'has-error' : ''}}">
                {!! Form::label('ordem', 'Ordem', ['class' => 'control-label']) !!}
                {!! Form::text('ordem', null, ['class' => 'form-control', 'readonly'=>'readonly', 'style'=>'background-color: #fff;font-family: arial;']) !!}
                <input class="form-control" name="ordemDigitado" id="ordemDigitado" style="" maxlength="2" type="text">
                {!! Form::hidden('ordemAtual', @$permission->ordem , ['class' => 'form-control', 'id'=>'ordemAtual', 'style'=>'background-color: #fff;']) !!}
                {!! $errors->first('ordem', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('icone') ? 'has-error' : ''}} jdivIcon">
                <label class="control-label">Ícone <i class="fa fa-asterisk" title="aqui vai mostrar o icone que preencher abaixo, o qual vai mostrar no menu"></i></label>
                <a href="https://www.w3schools.com/icons/fontawesome_icons_webapp.asp" target="_blank" style="right: 20px;position: absolute;">Link com exemplos de Ícones</a>
                {!! Form::text('icone', null, ['class' => 'form-control jIconeText', "autocomplete"=>"off"]) !!}
                {!! $errors->first('icone', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
	</div>
	<div class="row">
        <div class="col-md-2">
            <div class="form-group " >
                <label class="control-label">Status </label>
                <div style="margin-top: 7px;">
                    <label class="control-label">{!! Form::checkbox('status', 1,  ($permission->status??"1") == 1 ?  true : false, ['id' => 'status','class'=>'control-label']) !!} Ativo</label>&ensp;
                </div>
            </div>
        </div>

	</div>

	@if ($errors->any())
		<div class="row">
			<div class="col-md-12">
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

        $("i",$(".jIconeText").parents(".jdivIcon")).attr("class",$(".jIconeText").val());

        $(".jIconeText").keyup(function (){
            $("i",$(".jIconeText").parents(".jdivIcon")).attr("class",$(".jIconeText").val());

        });


        $("#ordemDigitado").mask("99");
        if($("#ordem").val() == "")
            $("#ordem").val("__000000000000");
        $("#ordemDigitado").css("left","0px")

        function carregaordemPai(campo){
            var ordem = $("option:selected", campo).attr("ordem");
            var ordemMostrar = ordem;

            if(parseInt(ordem.substring(16,18))>0)
            {
                $("#ordemDigitado").css("display","none");
            }
            else if(parseInt(ordem.substring(14,16))>0)
            {
                ordemMostrar = ordem.substring(0,16)+"__";
                $("#ordemDigitado").css("left","93px").val($("#ordemAtual").val().substring(16,18));
            }
            else if(parseInt(ordem.substring(12,14))>0)
            {
                ordemMostrar = ordem.substring(0,14)+"__"+ordem.substring(16,18);
                $("#ordemDigitado").css("left","93px").val($("#ordemAtual").val().substring(14,16));
            }
            else if(parseInt(ordem.substring(10,12))>0)
            {
                ordemMostrar = ordem.substring(0,12)+"__"+ordem.substring(14,18);
                $("#ordemDigitado").css("left","93px").val($("#ordemAtual").val().substring(12,14));
            }
            else if(parseInt(ordem.substring(8,10))>0)
            {
                ordemMostrar = ordem.substring(0,10)+"__"+ordem.substring(12,18);
                $("#ordemDigitado").css("left","79px").val($("#ordemAtual").val().substring(10,12));
            }
            else if(parseInt(ordem.substring(6,8))>0)
            {
                ordemMostrar = ordem.substring(0,8)+"__"+ordem.substring(10,18);
                $("#ordemDigitado").css("left","65px").val($("#ordemAtual").val().substring(8,10));
            }
            else if(parseInt(ordem.substring(4,6))>0)
            {
                ordemMostrar = ordem.substring(0,6)+"__"+ordem.substring(8,18);
                $("#ordemDigitado").css("left","51px").val($("#ordemAtual").val().substring(6,8));
            }
            else if(parseInt(ordem.substring(2,4))>0)
            {
                ordemMostrar = ordem.substring(0,4)+"__"+ordem.substring(6,18);
                $("#ordemDigitado").css("left","37px").val($("#ordemAtual").val().substring(4,6));
            }
            else if(parseInt(ordem.substring(0,2))>0)
            {
                ordemMostrar = ordem.substring(0,2)+"__"+ordem.substring(4,18);
                $("#ordemDigitado").css("left","23px").val($("#ordemAtual").val().substring(2,4));
            }
            else if(parseInt(ordem)==0)
            {
                ordemMostrar = "__"+ordem.substring(2,18);
                $("#ordemDigitado").css("left","8px").val($("#ordemAtual").val().substring(0,2));
            }

            $("#ordem").val(ordemMostrar);


        }
        jQuery(document).ready(function() {
            carregaordemPai($("#idparent"));
        });


	</script>
@endpush
