<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/categoria_contrato')}}" class="btn btn-default">
        <i class="fa fa-ban"></i> Cancelar
    </a>
    @if (($CategoriaDocumentos[0]->a014_id_documento??0) == 0)
    <button type="submit" class="btn bg-olive pull-right">
        <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
    @else
        <span class="btn btn-default  pull-right" >Catergoria Utilizada em Contrato, não é possível alterar</span>
    @endif
</div>

<div class="box-body">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="tabs_hint">
            <li class="form_geral"><a class="active" href="#form_geral" data-toggle="tab">Geral</a></li>
            <li class="form_documento"><a href="#form_documento" data-toggle="tab">Documentos</a></li>

        </ul>
    </div>
    <div class="tab-content">
        <div class="active tab-pane" id="form_geral">@include ('sistema.categoria_contrato.formGeral')</div>
        <div class="tab-pane" id="form_documento">@include ('sistema.categoria_contrato.formDocumento')</div>
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


        });




        $("#a005_id_empresa").change(function($value){
            validaCampoUnicoExistente($(".validaunico"));
        });

        $(".validaunico").blur(function () {
            //validaCampoUnicoExistente(this);
        });

        function addTableCategoriaDocumento() {

            var a009_descricao = $("#a009_descricao_form").val();
            var a009_dias_alerta_vencimento = $("#a009_dias_alerta_vencimento_form").val();
            var a009_ind_obrigatorio = $("#a009_ind_obrigatorio_form:checked").length;
            var a009_status = $("#a009_status_form:checked").length;

            if (a009_dias_alerta_vencimento == "" || a009_descricao == "") {
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor Preencher todos os campos!',
                });
                return;
            }

            var txtObrig = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i>  Sim </span>'
            if(a009_ind_obrigatorio==0)
            {
                txtObrig = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i>  Não </span>'
            }

            var txtStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i>  Ativo </span>'
            if(a009_status==0)
            {
                txtStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i>  Inativo </span>'
            }



            var addLinha = '<tr class="dados_id bg_add_linha">' +
                '<td>' + a009_descricao + '<input type="hidden" name="a009_descricao[]" id="a009_descricao" value="' + a009_descricao + '"></td>' +
                '<td>' + a009_dias_alerta_vencimento + '<input type="hidden" name="a009_dias_alerta_vencimento[]" id="a009_dias_alerta_vencimento" value="' + a009_dias_alerta_vencimento + '"></td>' +
                '<td>' + txtObrig + '<input type="hidden" name="a009_ind_obrigatorio[]" id="a009_ind_obrigatorio" value="' + a009_ind_obrigatorio + '"></td>' +
                '<td>' + txtStatus + '<input type="hidden" name="a009_status[]" id="a009_status" value="' + a009_status + '"></td>' +
                '<td>' +
                '<div class="btn btn-info" title="Editar Documento" onclick="editacategoriadocumento(this)"><i class="fa fa-edit" aria-hidden="true"></i></div>'+
                '<div class="btn btn-danger" title="Excluir Documento" onclick="removecategoriadocumento(\'Tem certeza que deseja excluir este Documento?\', this)">' + '<i class="fa fa-trash-o" aria-hidden="true"></i></div>' +
                '</td>' +
                '</tr>';
            $('#table-contato').append(addLinha);


            /***** Resentando os valores dos campos ******/
            $("#a009_descricao_form").val("");
            $("#a009_dias_alerta_vencimento_form").val("");
            $("#a009_ind_obrigatorio_form").prop("checked", true);
            $("#a009_status_form").prop("checked", true);

        }

        //Remover linha da tabela
        function removecategoriadocumento(string,  thiscampo) {
            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: string,
                buttons: {
                    confirm: {
                        text: 'Excluir',
                        btnClass: 'btn-danger',
                        action: function () {
                            $(thiscampo).parents('.dados_id').remove();
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }

        function editacategoriadocumento(thiscampo)
        {
            var linha = $(thiscampo).parents('.dados_id');
            if((linha.length)>0) {
                linha = linha[0];
                var a009_descricao = $("#a009_descricao", linha).val();
                var a009_dias_alerta_vencimento = $("#a009_dias_alerta_vencimento", linha).val();
                var a009_ind_obrigatorio = $("#a009_ind_obrigatorio", linha).val();
                var a009_status = $("#a009_status", linha).val();

                $("#a009_descricao_form").val(a009_descricao);
                $("#a009_dias_alerta_vencimento_form").val(a009_dias_alerta_vencimento);
                $("#a009_ind_obrigatorio_form").val(a009_ind_obrigatorio);
                $("#a009_status_form").val(a009_status);

                if (a009_status == 1) {
                    $("#a009_status_form").prop("checked", true);
                }
                else {
                    $("#a009_status_form").prop("checked", false);
                }

                if (a009_ind_obrigatorio == 1) {
                    $("#a009_ind_obrigatorio_form").prop("checked", true);
                }
                else {
                    $("#a009_ind_obrigatorio_form").prop("checked", false);
                }

                linha.remove();
            }
        }

    </script>
@endpush


