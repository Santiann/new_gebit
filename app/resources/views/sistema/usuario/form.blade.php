<div class="box-footer BotesFixoTopo">

    <a href="{{ url('/usuario')}}" class="btn btn-default jbtnCancelarForm">
        <i class="fa fa-ban"></i> Cancelar
    </a>

    <button type="submit" class="btn bg-olive pull-right">
        <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
</div>

<div class="box-body">



    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="tabs_hint">
            <li class="form_geral"><a class="active" href="#form_geral" data-toggle="tab">Geral</a></li>
            <li class="form_empresa"><a class="" href="#form_empresa" data-toggle="tab">Empresas - Perfis</a></li>
            <li class="form_assinatura"><a class="" href="{{ route('assinatura') }}">Assinatura</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="active tab-pane" id="form_geral">
            @include ('sistema.usuario.formGeral')
        </div>
        <div class="tab-pane" id="form_empresa">
            @include ('sistema.usuario.formEmpresa')
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
            $(".clear1").hide();
            $(".clear2").hide();
        });


        var jSelectListEmpresa = $('.jSelectListEmpresa').bootstrapDualListbox({
            nonSelectedListLabel: '<label class="control-label">Lista de Empresas</label>',
            selectedListLabel: '<label class="control-label">Lista de Empresas Selecionados</label>',
            preserveSelectionOnMove: false,
            moveOnSelect: false,
            nonSelectedFilter: '',
            infoText: false,
            infoTextEmpty: false
        });

        var jSelectListPerfil = $('.jSelectListPerfil').bootstrapDualListbox({
            nonSelectedListLabel: '<label class="control-label">Lista de Perfis</label>',
            selectedListLabel: '<label class="control-label">Lista de Perfis Selecionados</label>',
            preserveSelectionOnMove: false,
            moveOnSelect: false,
            nonSelectedFilter: '',
            infoText: false,
            infoTextEmpty: false
        });


        $(".validaunico").blur(function () {
            validaCampoUnicoExistente(this);
        });


        $("#a001_cep").blur(function () {
            buscaCep();
        });

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


