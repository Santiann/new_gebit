<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/notificacao')}}" class="btn btn-default">
       <i class="fa fa-ban"></i> Cancelar
    </a>
    <button type="submit" class="btn bg-olive pull-right">
       <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
</div>

<div class="box-body">
<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a001_id_usuario') ? 'has-error' : ''}}">
            {!! Form::label('a001_id_usuario', 'A001 Id Usuario', ['class' => 'control-label']) !!}
            {!! Form::number('a001_id_usuario', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required']) !!}
            {!! $errors->first('a001_id_usuario', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a996_assunto') ? 'has-error' : ''}}">
            {!! Form::label('a996_assunto', 'A996 Assunto', ['class' => 'control-label']) !!}
            {!! Form::text('a996_assunto', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required']) !!}
            {!! $errors->first('a996_assunto', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a996_conteudo') ? 'has-error' : ''}}">
            {!! Form::label('a996_conteudo', 'A996 Conteudo', ['class' => 'control-label']) !!}
            {!! Form::text('a996_conteudo', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required']) !!}
            {!! $errors->first('a996_conteudo', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('a996_ind_lido') ? 'has-error' : ''}}">
            {!! Form::label('a996_ind_lido', 'A996 Ind Lido', ['class' => 'control-label']) !!}
            {!! Form::number('a996_ind_lido', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required']) !!}
            {!! $errors->first('a996_ind_lido', '<p class="help-block">:message</p>') !!}
            <div class="help-block with-errors"></div>
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
        });
	</script>
@endpush


