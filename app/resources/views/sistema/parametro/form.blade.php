<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/parametro')}}" class="btn btn-default">
        <i class="fa fa-ban"></i> Cancelar
    </a>
    <button type="submit" class="btn bg-olive pull-right">
        <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
</div>

{!! Form::hidden('a000_ind_adm', null, ['class' => 'form-control', 'id'=>'a000_ind_adm']) !!}

<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('a000_sigla') ? 'has-error' : ''}}">
                {!! Form::label('a000_sigla', 'Sigla', ['class' => 'control-label']) !!}
                {!! Form::text('a000_sigla', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required']) !!}
                {!! $errors->first('a000_sigla', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('a000_nome') ? 'has-error' : ''}}">
                {!! Form::label('a000_nome', 'Nome', ['class' => 'control-label']) !!}
                {!! Form::text('a000_nome', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required']) !!}
                {!! $errors->first('a000_nome', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('a000_descricao') ? 'has-error' : ''}}">
                {!! Form::label('a000_descricao', 'Descrição', ['class' => 'control-label']) !!}
                {!! Form::text('a000_descricao', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required']) !!}
                {!! $errors->first('a000_descricao', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('a000_valor') ? 'has-error' : ''}}">
                {!! Form::label('a000_valor', 'Valor', ['class' => 'control-label']) !!}
                {!! Form::textarea('a000_valor', null, ['class' => 'form-control jsummernote','autocomplete' => 'off', 'required' => 'required','rows'=>"5"]) !!}
                {!! $errors->first('a000_valor', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group " >
                <label class="control-label">Status </label>
                <div style="margin-top: 7px;">
                    <label class="control-label">{!! Form::checkbox('a000_status', 1,  ($parametro->a000_status??1) == 1 ?  true : false, ['id' => 'a000_status','class'=>'control-label']) !!} Ativo</label>&ensp;
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
        $(document).ready(function () {
            $('.select2').select2({
                language: 'pt-BR'
            });

            $('.jsummernote').summernote({
                height: 250,   //set editable area's height
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });
    </script>
@endpush


