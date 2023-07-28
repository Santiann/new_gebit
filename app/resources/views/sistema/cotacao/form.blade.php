<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/cotacao')}}" class="btn btn-default">
       <i class="fa fa-ban"></i> Cancelar
    </a>
    <button type="submit" class="btn bg-olive pull-right botaoSalvarTela">
       <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
</div>

<div class="box-body">
    {{ csrf_field() }}
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="tabs_hint">
            <li class="form_geral"><a class="active" href="#form_geral" data-toggle="tab">Geral</a></li>
            <li class="form_upload"><a class="" href="#form_upload" data-toggle="tab">Arquivos</a></li>
            <li class="form_fornecedor"><a class="" href="#form_fornecedor" data-toggle="tab">Fornecedores</a></li>
            <li class="form_historico"><a class="" href="#form_historico" data-toggle="tab">Histórico</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="active tab-pane" id="form_geral">@include ('sistema.cotacao.formGeral')</div>
        <div class="tab-pane" id="form_upload">@include ('sistema.cotacao.formUpload')</div>
        <div class="tab-pane" id="form_fornecedor">@include ('sistema.cotacao.formFornecedor')</div>
        <div class="tab-pane" id="form_historico">@include ('sistema.cotacao.formHistorico')</div>
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

            if('{{$cotacao->a018_status??"O"}}'=="A") {
                $($("#a018_status_combo option")[3]).prop('disabled', true);
                $($("#a018_status_combo option")[4]).prop('disabled', true);
                $("#a018_status_combo").prop('required', false);


            }
            else if('{{$cotacao->a018_status??"O"}}'=="E") {
                $($("#a018_status_combo option")[1]).prop('disabled', true);
                $($("#a018_status_combo option")[2]).prop('disabled', true);
                $($("#a018_status_combo option")[5]).prop('disabled', true);
                $($("#a018_status_combo option")[6]).prop('disabled', true);
                $("#a018_status_combo").prop('required', false);

            }
            else if(('{{$cotacao->a018_status??"O"}}'=="O") || ('{{$cotacao->a018_status??"O"}}'=="S") || ('{{$cotacao->a018_status??"O"}}'=="C") ){
                $($("#a018_status_combo option")[2]).prop('disabled', true);
                $($("#a018_status_combo option")[3]).prop('disabled', true);
                $($("#a018_status_combo option")[4]).prop('disabled', true);
                $("#a018_status_combo").prop('required', false);
            }
            else if('{{$cotacao->a018_status??"O"}}'=="F") {
                $($("#a018_status_combo option")[1]).prop('disabled', true);
                $($("#a018_status_combo option")[2]).prop('disabled', true);
                $($("#a018_status_combo option")[3]).prop('disabled', true);
                $($("#a018_status_combo option")[5]).prop('disabled', true);
                $($("#a018_status_combo option")[6]).prop('disabled', true);
                $("#a018_status_combo").prop('required', false);
            }

            $('.select2').select2({language: 'pt-BR'});

            criaDataTableHistorico();

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                if ((target == '#form_historico')) {
                    $('#tableHistorico').DataTable().destroy();
                    criaDataTableHistorico();
                } else {

                }
            });

            function chamaDepois() {
                $('input[type="file"]').change(function () {
                    var encoutrouInputSemUpload = 0
                    $("input[name='a019_upload[]']").each(function(){
                        if (this.files.length == 0)
                        {
                            encoutrouInputSemUpload++;
                            return;
                        }
                    });

                    if(encoutrouInputSemUpload<1) {
                        var clone = $($("#tableCotacaoArquivo tr")[$("#tableCotacaoArquivo tr").length-1]).clone();
                        clone.removeClass("divUploadCopy");
                        $("#tableCotacaoArquivo").append(clone);

                        var qtd = $("input[name='a019_upload[]']").length-1;
                        $($("input[name='a019_upload[]']")[qtd]).val("");
                        $(".lixeiraUpload").show();
                        $($(".lixeiraUpload")[qtd]).hide();
                        chamaDepois();
                    }

                });
            }
            chamaDepois();

        });

        $("#a018_status_combo").change(function(){
            $("#a018_status").val($(this).val());
            mudaStatusFornecedor();
        });

        $("#a005_id_empresa_for_form").change(function(){
            $("#a020_email_outro_fornecedor_form").val($("#a005_id_empresa_for_form option:selected").attr("email"));
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


        function addcotacaofornecedor() {

            var a005_id_empresa = $("#a005_id_empresa_for_form").val();
            var a020_email_outro_fornecedor = $("#a020_email_outro_fornecedor_form").val();
            var a020_data_entrega = $("#a020_data_entrega_form").val();
            var a020_valor = $("#a020_valor_form").val();
            var a020_obs = $("#a020_obs_form").val();

            if (a005_id_empresa == "" || a020_email_outro_fornecedor == "") {
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor Preencher o fornecedor e o e-mail!',
                });
                return;
            }

            var arr = $("#a020_email_outro_fornecedor_form").val().split(';');
            var emailInvalido = false;
            $.each( arr, function( index, value ) {
                if (validaEmail(value) == false) {
                    emailInvalido = true;

                }
            });
            if(emailInvalido)
            {
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor Preencher um e-mail Válido!',
                });
                return;
            }




            var txtEmpresa = $("#a005_id_empresa_for_form").find(":selected").text();

            var addLinha = '<tr class="dados_id bg_add_linha">' +
                '<td>' + txtEmpresa + '<input type="hidden" name="a005_id_empresa_for[]" id="a005_id_empresa_for" value="' + a005_id_empresa + '"></td>' +
                '<td>' + a020_email_outro_fornecedor + '<input type="hidden" name="a020_email_outro_fornecedor[]" id="a020_email_outro_fornecedor" value="' + a020_email_outro_fornecedor + '"></td>' +
                '<td>' + a020_data_entrega + '<input type="hidden" name="a020_data_entrega[]" id="a020_data_entrega" value="' + a020_data_entrega + '"></td>' +
                '<td>' + a020_valor + '<input type="hidden" name="a020_valor[]" id="a020_valor" value="' + a020_valor + '"></td>' +
                '<td>' + a020_obs + '<input type="hidden" name="a020_obs[]" id="a020_obs" value="' + a020_obs + '"></td>' +
                '<td><span class="label bg-info" >Orçamento</span><input type="hidden" name="a020_status[]" id="a020_status" value="O"></td>' +
                '<td> <div class="btn btn-danger" title="Remover Forncedor" onclick="removeCotacaoFornecedor(\'Tem certeza que deseja excluir este Fornecedor?\', this)">' + '<i class="fa fa-trash-o" aria-hidden="true"></i></div></td>' +
                '</tr>';
            $('#tablecotacaofornecedor').append(addLinha);

            /***** Resentando os valores dos campos ******/
            $("#a005_id_empresa_for_form").val('');
            $("#a020_email_outro_fornecedor_form").val('');
            $("#a020_data_entrega_form").val('');
            $("#a020_valor_form").val('');
            $("#a020_obs_form").val('')
            $('#a005_id_empresa_for_form').select2();

        }
        //Remover linha da tabela
        function removeCotacaoFornecedor(string, thiscampo) {
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

        function mudaStatusFornecedor()
        {
            var statusOrc = $("#a018_status_combo").val()
            $(".tdStatus").each(function(index, row){
                var $spanhtml = ($('span',$(row)).html())
                var $inputval = ($('#a020_status',$(row)).val())

                switch(statusOrc) {
                    case 'F':
                        if($inputval == 'E')
                        {
                            $('#a020_status',$(row)).val($inputval);
                            $('span',$(row)).html('Finalizado');
                            $('span',$(row)).addClass('bg-success').removeClass('bg-warning');
                        }
                        break;
                    case 'O':
                        $('#a020_status',$(row)).val($inputval);
                        $('span',$(row)).html('Orçamento');
                        $('span',$(row))
                            .removeClass("bg-warning")
                            .removeClass("bg-orange")
                            .removeClass("bg-info")
                            .removeClass("bg-success")
                            .removeClass("bg-danger")
                            .addClass('bg-info');
                        break;
                    case 'C':
                        $('#a020_status',$(row)).val($inputval);
                        $('span',$(row)).html('Cancelado');
                        $('span',$(row))
                            .removeClass("bg-warning")
                            .removeClass("bg-orange")
                            .removeClass("bg-info")
                            .removeClass("bg-success")
                            .removeClass("bg-danger")
                            .addClass('bg-danger');
                        break;
                    case 'S':
                        $('#a020_status',$(row)).val($inputval);
                        $('span',$(row)).html('Sem Aprovação');
                        $('span',$(row))
                            .removeClass("bg-warning")
                            .removeClass("bg-orange")
                            .removeClass("bg-info")
                            .removeClass("bg-success")
                            .removeClass("bg-danger")
                            .addClass('bg-danger');
                        break;

                    default:
                        break;
                }


            })
        }

        function aprovaCotacaoFornecedor(string, thiss)
        {
            $.confirm({
                theme: 'light',
                title: 'Confirmar',
                content: string,
                buttons: {
                    confirm: {
                        text: 'Aprovar',
                        btnClass: 'btn-success',
                        action: function () {

                            $("span",$(".tdStatus",$(thiss).parents("table")))
                                .removeClass("bg-warning")
                                .removeClass("bg-orange")
                                .removeClass("bg-primary")
                                .removeClass("bg-success")
                                .addClass("bg-danger");

                            $("span",$(".tdStatus",$(thiss).parents("table"))).html("Sem Aprovação");
                            $("input",$(".tdStatus",$(thiss).parents("table"))).val("S");

                            $("span",$(".tdStatus",$(thiss).parents("tr"))).removeClass("bg-danger").addClass("bg-warning");
                            $("span",$(".tdStatus",$(thiss).parents("tr"))).html("Aguardando Entrega");
                            $("input",$(".tdStatus",$(thiss).parents("tr"))).val("E");

                            $("#a018_status").val('E');
                            $("#a018_status_combo").select2({disabled: false}).val('E').select2({disabled: true});
                            $(".tdAcao",$(thiss).parents("table")).html("");
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }


        function criaDataTableHistorico()
        {
            $('#tableHistorico').DataTable({
                //responsive: true,
                "pageLength": 100,
                fixedHeader: {
                    header: true,
                    footer: false
                },
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                "language": { "url": "/bower_components/admin-lte/plugins/datatables/lang/pt-BR.json" }
                ,responsive: {
                    details: {
                        renderer: function ( api, rowIdx ) {
                            // Select hidden columns for the given row
                            var data = api.cells( rowIdx, ':hidden' ).eq(0).map( function ( cell ) {
                                var header = $( api.column( cell.column ).header() );

                                var dados = "";//api.cell( cell ).data()
                                var split = api.cell( cell ).data().split('       ');
                                //split.length
                                $.each(split,function(key, value){
                                    dados += value+"<BR>";
                                });

                                var html = '<tr>'+'<td>'+header.text()+':'+'</td> '+
                                    '<td>'+ dados + '</td>'+'</tr>';

                                return html
                            } ).toArray().join('');

                            return data ?
                                $('<table/>').append( data ) :
                                false;
                        }
                    }
                }
            });
        }

    </script>
@endpush


