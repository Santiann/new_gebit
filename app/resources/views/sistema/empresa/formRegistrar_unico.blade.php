<div class="box-footer BotesFixoTopo">

    <a href="{{ $login_url??"" }}" class="btn btn-default jaSouMembro">
        {{ __('adminlte::adminlte.i_already_have_a_membership') }}
    </a>
    <button type="submit" class="btn bg-olive pull-right">
        <i class="fa fa-save"></i> <span class="jtxtSalvar">Criar nova conta</span>
    </button>

</div>

<div class="box-body">

    {!! Form::hidden('a004_dono_cadastro', $empresa->a004_dono_cadastro??1, ['id'=>'a004_dono_cadastro','class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'20']) !!}

    <div class="row">
        <div class="FormSubtitulo">

        </div>
    </div>

    <div class="jGeral">
        <div class="row">

            <div class="col-md-2">
                <div class="form-group {{ $errors->has('a005_logo') ? 'has-error' : ''}}">
                    {!! Form::label('a005_logo', 'Logo', ['class' => 'control-label']) !!}
                    <div class=" ">
                        {!! Form::file('a005_logo', ['class' => 'a005_logo jInputFileUploadImg dropify', 'id'=>'a005_logo',"multiple"=>"multiple", "data-default-file"=>asset('/img/sem-image.jpg'), 'data-height'=>"155" ]) !!}
                    </div>
                    {!! $errors->first('a005_logo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="col-md-10">

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('a005_cpf_cnpj') ? 'has-error' : ''}}">
                        {!! Form::label('a005_cpf_cnpj', 'CPF/CNPJ', ['class' => 'control-label']) !!}
                        {!! Form::text('a005_cpf_cnpj', null, ['class' => 'form-control cpfCnpjmask cpfcnpjvalido buscaexistente','autocomplete' => 'off']) !!}
                        {!! $errors->first('a005_cpf_cnpj', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('a005_nome_completo') ? 'has-error' : ''}}">
                        {!! Form::label('a005_nome_completo', 'Nome Completo', ['class' => 'control-label']) !!}
                        {!! Form::text('a005_nome_completo', null, ['class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'50']) !!}
                        {!! $errors->first('a005_nome_completo', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group  {{ $errors->has('a005_email') ? 'has-error' : ''}}">
                        {!! Form::label('a005_email', 'E-mail', ['class' => 'control-label']) !!}
                        {!! Form::text('a005_email', null, ['class' => 'form-control emailvalido validaunico', 'columnname'=>'a001_email', 'tablename'=>'t001_usuario' ,'pknametable'=>'a001_id_usuario', 'pkVal'=>($empresa->a001_id_usuario??0),'autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'50']) !!}
                        {!! $errors->first('a005_email', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors "></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('a005_fone') ? 'has-error' : ''}}">
                        {!! Form::label('a005_fone', 'Telefone', ['class' => 'control-label']) !!}
                        {!! Form::text('a005_fone', null, ['class' => 'form-control foneddd','autocomplete' => 'off', 'required' => 'required']) !!}
                        {!! $errors->first('a005_fone', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>


                <div class="col-md-2 jcep">
                    <div class="form-group {{ $errors->has('a005_cep') ? 'has-error' : ''}}">
                        {!! Form::label('a005_cep', 'CEP', ['class' => 'control-label']) !!}
                        {!! Form::text('a005_cep', null, ['class' => 'form-control cepMask jcampoCep','autocomplete' => 'off', 'required' => 'required']) !!}
                        {!! $errors->first('a005_cep', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-5 jendereco">
                    <div class="form-group {{ $errors->has('a005_endereco') ? 'has-error' : ''}}">
                        {!! Form::label('a005_endereco', 'Endereço', ['class' => 'control-label']) !!}
                        {!! Form::text('a005_endereco', null, ['class' => 'form-control jcampoEndereco','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'300']) !!}
                        {!! $errors->first('a005_endereco', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group {{ $errors->has('a005_numero_end') ? 'has-error' : ''}}">
                        {!! Form::label('a005_numero_end', 'Número', ['class' => 'control-label']) !!}
                        {!! Form::text('a005_numero_end', null, ['class' => 'form-control','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'30']) !!}
                        {!! $errors->first('a005_numero_end', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('a005_bairro') ? 'has-error' : ''}}">
                        {!! Form::label('a005_bairro', 'Bairro', ['class' => 'control-label']) !!}
                        {!! Form::text('a005_bairro', null, ['class' => 'form-control jcampoBairro','autocomplete' => 'off', 'required' => 'required', 'maxlength'=>'200']) !!}
                        {!! $errors->first('a005_bairro', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('a005_complemento_end') ? 'has-error' : ''}}">
                        {!! Form::label('a005_complemento_end', 'Complemento', ['class' => 'control-label']) !!}
                        {!! Form::text('a005_complemento_end', null, ['class' => 'form-control','autocomplete' => 'off', 'maxlength'=>'50']) !!}
                        {!! $errors->first('a005_complemento_end', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>



                <div class="col-md-3 ">
                    <div class="form-group {{ $errors->has('a048_id_estado') ? 'has-error' : ''}}">
                        {!! Form::label('a048_id_estado', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::select('a048_id_estado',$comboEstado??[],null,array('class' => 'form-control select2 jcampoEstado','id'=>'a048_id_estado', 'required' => 'required','autocomplete' => 'off'))!!}
                        {!! $errors->first('a048_id_estado', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-3 ">
                    <div class="form-group {{ $errors->has('a047_id_cidade') ? 'has-error' : ''}}">
                        {!! Form::label('a047_id_cidade', 'Cidade', ['class' => 'control-label']) !!}
                        {!! Form::select('a047_id_cidade',$comboCidade??[],null,array('class' => 'form-control select2 jcampoCidade','id'=>'a047_id_cidade', 'required' => 'required','autocomplete' => 'off'))!!}
                        {!! $errors->first('a047_id_cidade', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>


                </div>


                <div class="col-md-3" style=" display: none;">
                    <div class="form-group ">
                        <img id="imagemEmpresa" class="jImagemExibirUpload" src="{!!  ($empresa->a005_logo??"") != "" ? url('storage/'.@$empresa->a005_logo) : asset('/img/sem-image.jpg') !!}" style="max-height: 250px; max-width: 250px;">
                        <div class="help-block with-errors"></div>
                    </div>
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
            $('.dropify').dropify({
                messages: {
                    'default': 'Clique aqui pra adicionar uma imagem',
                    'replace': 'Clique aqui pra substituir a imagem',
                    'remove':  'Excluir',
                    'error':   'Erro, tente novamente!.'
                }
            });
        });

        //Busca por CEP
        $("#a005_cep").blur(function () {
            buscaCep();
        });

        $(".buscaexistente").blur(function($value){
            buscaExistente(this);
        });


        function buscaExistente(thiss)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var valorDigitado = $(thiss).val();

            url = '/empresa_buscaExistente';
            if($("#cadastrese").length>0) {
                url = '/registrar_buscaExistente'
            }

            $.ajax({
                url: url,
                type: "GET",
                data: {valorDigitado: valorDigitado},
                headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                success: function (response) {
                    if(response.a005_id_empresa != undefined)
                    {

                        if($("#cadastrese").length>0) {
                            $.alert({
                                theme: 'light',
                                title: 'ALERTA',
                                content: 'Empresa já se encontra cadastrado, entre em contado com o Adminstrador do Sistema!',
                            });
                            $(thiss).val("");
                            return;
                        }
                        $.confirm({
                            theme: 'light',
                            title: 'ALERTA',
                            content: "Encontrado Empresa já cadastrada Deseja Preencher os dados encontrados?",
                            buttons: {
                                confirm: {
                                    text: 'Confirmar',
                                    btnClass: 'btn-success',
                                    action: function () {

                                        $("#imagemEmpresa").val(response.a005_logo).prop("readonly", true);
                                        $("#a005_id_empresa").val(response.a005_id_empresa).prop("readonly", true);
                                        $("#a005_tipo_cliente").val(response.a005_tipo_cliente).prop("readonly", true);
                                        $("#a005_tipo_empresa").val(response.a005_tipo_empresa).prop("readonly", true);
                                        $("#a005_id_empresa_matriz").val(response.a005_id_empresa_matriz).prop("readonly", true);
                                        $("#a005_ind_estrangeiro").val(response.a005_ind_estrangeiro).prop("readonly", true);
                                        //$("#a005_cod_identificacao").val(response.a005_cod_identificacao)
                                        //$("#a005_cpf").val(response.a005_cpf);
                                        $("#a005_nome_completo").val(response.a005_nome_completo).prop("readonly", true);
                                        //$("#a005_cnpj").val(response.a005_cnpj)
                                        $("#a005_razao_social").val(response.a005_razao_social).prop("readonly", true);
                                        $("#a005_nome_fantasia").val(response.a005_nome_fantasia).prop("readonly", true);
                                        $("#a005_ie").val(response.a005_ie).prop("readonly", true);
                                        $("#a005_im").val(response.a005_im).prop("readonly", true);
                                        $("#a005_fone").val(response.a005_fone).prop("readonly", true);
                                        $("#a005_email").val(response.a005_email).prop("readonly", true);
                                        $("#a005_email").removeClass('validaunico');
                                        $("#a005_cep").val(response.a005_cep).prop("readonly", true);
                                        $("#a047_id_cidade").val(response.a047_id_cidade).prop("readonly", true);
                                        $("#a005_endereco").val(response.a005_endereco).prop("readonly", true);
                                        $("#a005_bairro").val(response.a005_bairro).prop("readonly", true);
                                        $("#a005_numero_end").val(response.a005_numero_end).prop("readonly", true);
                                        $("#a005_complemento_end").val(response.a005_complemento_end).prop("readonly", true);
                                        $("#a048_id_estado").val(response.a048_id_estado).prop("readonly", true);

                                        if(response.a005_status==1)
                                            $("#a005_status").prop("checked",true).prop("readonly", true);
                                        else
                                            $("#a005_status").prop("checked",false).prop("readonly", true);

                                        $("#a048_id_estado").select2()
                                        $("#a048_id_estado").prop("readonly", true);;
                                        $('#a047_id_cidade').html('<option value=""></option>');

                                        $.ajax({
                                            url: "/carregaCidade",
                                            type: "GET",
                                            data: {idEstado: response.a048_id_estado},
                                            headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                                            success: function (responseCidade) {
                                                var count = responseCidade.length;

                                                $.each(responseCidade, function (el) {
                                                    $('#a047_id_cidade').append('<option value="' + responseCidade[el].a047_id_cidade + '">' + responseCidade[el].a047_nome_cidade + '</option>');
                                                });
                                                $('#a047_id_cidade').val(response.a047_id_cidade);
                                                $('#a047_id_cidade').select2();
                                                $('#a047_id_cidade').prop("readonly", true);

                                            },
                                            error: function (responseCidade) {
                                                alert('Erro, tente novamente por favor!');
                                            }
                                        });

                                    }
                                },
                                cancel: {
                                    text: 'Cancelar',
                                    btnClass: 'btn-default',
                                    action: function () {
                                        $(".buscaexistente").val("");
                                    }
                                }
                            }
                        });
                    }

                },
                error: function (response) {
                    $.alert('Erro, tente novamente por favor!');
                }
            });
        }




        function buscaCep() {
            var cep = "";

            if($(".jcampoCep").length>0) {
                cep = $(".jcampoCep").val().replace(/\D/g, '');
            }

            if (cep != "") {
                var validacep = /^[0-9]{8}$/;
                if (validacep.test(cep)) {
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
                            $(".jcampoEndereco").val(dados.logradouro);
                            $(".jcampoBairro").val(dados.bairro);
                            var idEstado = dados.uf;
                            var idcidade = dados.localidade;

                            $.ajax({
                                url: '/carregaCidadeEstado',
                                type: 'GET',
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                data: {
                                    idEstado: idEstado,
                                    idcidade: idcidade
                                },
                                success: function (response) {

                                    $('#a047_id_cidade').html('<option value=""></option>');
                                    var cidades = response['cidades'];
                                    $.each(cidades, function (el) {
                                        $('#a047_id_cidade').append('<option value="' + cidades[el].a047_id_cidade + '">' + cidades[el].a047_nome_cidade + '</option>');
                                    });

                                    $('.jcampoEstado option[value="' + response['estado'] + '"]').prop('selected', true);
                                    $('.jcampoEstado').select2();

                                    $('.jcampoCidade option[value="' + response['cidade'] + '"]').prop('selected', true);
                                    $('.jcampoCidade').select2();

                                },
                                error: function () {

                                }
                            });
                        }
                        else {
                            $.alert("CEP não encontrado.");
                        }
                    });
                }
                else {
                    $.alert("Formato de CEP inválido.");
                }
            }
        }

        /***** Busca cidade *******/
        $('.jcampoEstado').change(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var idEstado = $(this).val();

            $('#a047_id_cidade').html('<option value=""></option>');

            $.ajax({
                url: "/carregaCidade",
                type: "GET",
                data: {idEstado: idEstado},
                headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                success: function (response) {
                    var count = response.length;

                    $.each(response, function (el) {
                        $('#a047_id_cidade').append('<option value="' + response[el].a047_id_cidade + '">' + response[el].a047_nome_cidade + '</option>');
                    });
                    $('#a047_id_cidade').select2();

                },
                error: function (response) {
                    alert('Erro, tente novamente por favor!');
                }
            });
        });



    </script>
@endpush


