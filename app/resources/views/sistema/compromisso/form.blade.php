<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/compromisso')}}" class="btn btn-default">
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
            <li class="form_documento"><a href="#form_documento" data-toggle="tab">Documentos</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="active tab-pane" id="form_geral">@include ('sistema.compromisso.formGeral')</div>
        <div class="tab-pane" id="form_documento">@include ('sistema.compromisso.formUpload')</div>
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

            function chamaDepois() {
                $('input[type="file"]').change(function () {
                    var encoutrouInputSemUpload = 0
                    $("input[name='a023_upload[]']").each(function(){
                        if (this.files.length == 0)
                        {
                            encoutrouInputSemUpload++;
                            return;
                        }
                    });

                    if(encoutrouInputSemUpload<1) {
                        var tr = $($("#tableCotacaoArquivo tr")[$("#tableCotacaoArquivo tr").length-1]);
                        $(".a023_descricao",$(tr)).prop('required', true);

                        var clone = tr.clone();
                        clone.removeClass("divUploadCopy");
                        $(".a023_descricao",$(clone)).val("");
                        $(".a023_descricao",$(clone)).prop('required', false);


                        $("#tableCotacaoArquivo").append(clone);

                        var qtd = $("input[name='a023_upload[]']").length-1;
                        $($("input[name='a023_upload[]']")[qtd]).val("");
                        $(".lixeiraUpload").show();
                        $($(".lixeiraUpload")[qtd]).hide();
                        $('.form').validator('update');
                        chamaDepois();
                    }

                });
            }
            chamaDepois();
        });

        function removeLinhaTableArquivo(thiss) {
            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: 'Tem certeza que deseja excluir este Arquivo?',
                buttons: {
                    confirm: {
                        text: 'Excluir',
                        btnClass: 'btn-danger',
                        action: function () {
                            $(thiss).parents('.arquivo_id_0').remove();
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }

        $('#a005_id_empresa').change(function () {
            carregaOptionsEmpresa();
        });

        function carregaOptionsEmpresa() {
            var idEmpresa = $("#a005_id_empresa").val();

            $.ajax({
                url: '/carregaOptionsEmpresaCompromisso',
                type: 'GET',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {
                    idEmpresa: idEmpresa,
                    ind_multi_select : 0,
                },
                success: function (response) {

                    $('#a005_id_empresa_cli_for').html('');
                    $.each(response.comboEmpresaFor, function (key, value) {
                        $('#a005_id_empresa_cli_for').prepend($("<option></option>").attr("value", key).text(value));
                    });
                    $("#a005_id_empresa_cli_for").val($("#a005_id_empresa_cli_for option:first").val());
                    $("#a005_id_empresa_cli_for").select2()

                    $('#a013_id_contrato').html('');
                    $.each(response.comboContrato, function (key, value) {
                        $('#a013_id_contrato').prepend($("<option></option>").attr("value", key).text(value));
                    });
                    $("#a013_id_contrato").val($("#a013_id_contrato option:first").val());
                    $("#a013_id_contrato").select2()

                },
                error: function () {

                }
            });
        }

        $('#a013_id_contrato').change(function () {
            carregaOptionsContrato();
        });

        function carregaOptionsContrato() {
            var idContrato = $("#a013_id_contrato").val();
            var idEmpresa = $("#a005_id_empresa").val();

            $.ajax({
                url: '/carregaOptionsEmpresaCompromisso',
                type: 'GET',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {
                    idContrato: idContrato,
                    idEmpresa: idEmpresa,
                    ind_multi_select : 0,
                },
                success: function (response) {

                    $('#a005_id_empresa_cli_for').html('');
                    $.each(response.comboEmpresaFor, function (key, value) {
                        $('#a005_id_empresa_cli_for').prepend($("<option></option>").attr("value", key).text(value));
                    });
                    $("#a005_id_empresa_cli_for").val($("#a005_id_empresa_cli_for option:first").val());
                    $("#a005_id_empresa_cli_for").select2()



                },
                error: function () {

                }
            });
        }


	</script>
@endpush


