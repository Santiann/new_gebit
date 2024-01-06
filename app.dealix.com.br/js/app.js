$(document).ready(function () {
    $("input").attr("autocomplete", "off");

    $(document).on( "change",".foneddd", function(event) {
        if($(this).val().length<14){
            let form_group = $(this).parent('div');
            form_group.addClass('has-error has-danger');
            $(".with-errors",form_group).html('<ul class="list-unstyled"><li>Telefone incompleto</li></ul>');
        }
    });
});


$('.create').click(function(e) {
    e.preventDefault();
    if($("#form")[0].checkValidity()){
        $("#form").submit();
    }
});


function validaCamposObrigatorioTabs()
{
    $('.tab-pane',$(".tab-content")).each(function(value,row){
        var id = $(row).attr("id");
        var qtdError = ($(".list-unstyled",$(row)).length)

        $('a',$(".nav-tabs")).each(function(value,row){
            if($(row).attr('href') == ("#"+id))
            {
                if((qtdError>0)){
                    $(row).attr("style", "text-decoration:underline red;");
                }
                else {
                    $(row).attr("style", "text-decoration:none;");
                }
            }
        });

    });
    return true;
}


/**** Modal confirmar Excluir ***/
function ConfirmaExcluir(string, form) {
    var form = $(form).parents('form:first');
    $.confirm({
        theme: 'light',
        title: 'ALERTA',
        content: string,
        buttons: {
            confirm: {
                text: 'Excluir',
                btnClass: 'btn-danger',
                action: function () {
                    $(form).submit();
                }
            },
            cancel: {
                text: 'Cancelar',
            }
        }
    });
}

/**** Modal confirmar Cancelar com motivo ***/
function ConfirmaCancelarModal(string, form,stringInput) {
    var form = $(form).parents('form:first');
    var input = '<input type="text" placeholder="'+stringInput+'" class="inputMotivoCancelar form-control" required />';
    $.confirm({
        theme: 'light',
        title: 'ALERTA',
        content: string+input,
        buttons: {
            confirm: {
                text: 'Sim',
                btnClass: 'btn-danger',
                action: function () {
                    var valInput = this.$content.find('.inputMotivoCancelar').val();
                    if(!valInput){
                        $.alert('Favor Preencher o '+stringInput);
                        return false;
                    }
                    $(form).append('<input name="inputConfirm" value="" type="hidden">');
                    $("input[name=inputConfirm]").val(valInput);

                    if(valInput.length<=15)
                    {
                        $.alert('Justificativa deve ser maior que 15 Dígitos');
                        return;
                    }

                    $(form).submit();
                }
            },
            cancel: {
                text: 'Não',
            }
        }
    });
}

function alertModalInativar(string, form) {
    var form = $(form).parents('form:first');
    $.confirm({
        theme: 'light',
        title: 'ALERTA',
        content: string,
        buttons: {
            confirm: {
                text: 'Inativar',
                btnClass: 'btn-danger',
                action: function () {
                    $(form).submit();
                }
            },
            cancel: {
                text: 'Cancelar',
            }
        }
    });
}


/****** Validação CPF *******/
function validaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000" || strCPF == "11111111111" || strCPF == "22222222222" || strCPF == "33333333333" || strCPF == "44444444444" || strCPF == "55555555555" || strCPF == "66666666666" || strCPF == "77777777777" || strCPF == "88888888888" || strCPF == "99999999999") return false;

    for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;

    return true;
}

function validaEmail(email) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email)) {
        //$("MsgErro").show().text('Por favor, informe um email válido.');
        return false;
    }
    return true;
}

function validaCNPJ(cnpj)
{
    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;


    tamanho = cnpj.length - 2;
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) return false;
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;
}


$(".emailvalido").blur(function () {
    var CampoLimpo = $(this).val();

    if (CampoLimpo != '') {

        var form_group = $(this).parents(".form-group");
        if (validaEmail(CampoLimpo) == false)
        {
            $(form_group).addClass('has-error has-danger');
            $(".with-errors",form_group).html('E-mail Inválido');
        }
        else {
            $(form_group).removeClass('has-error has-danger');
            $('.with-errors',form_group).html('');
        }
    }
});


$(".cpfcnpjvalido").blur(function () {
    var valorLimpo = $(this).val().replace(/[\.-]/g, "");
    var form_group = $(this).parents(".form-group");
    if (valorLimpo != '') {

        var retornoValida = true;
        var msgRetorno = "";
        if(valorLimpo.length==11) {
            retornoValida = validaCPF(valorLimpo);
            msgRetorno = "CPF";
        }
        else //if(valorLimpo.length==14)
        {
            retornoValida = validaCNPJ(valorLimpo);
            msgRetorno = "CNPJ";
        }
        if (retornoValida == false) {
            $(form_group).addClass('has-error has-danger');
            $('.with-errors',form_group).html(msgRetorno+' Inválido');

        } else {
            $(form_group).removeClass('has-error has-danger');
            $('.with-errors',form_group).html('');
        }
    }
});

$(".cpfvalido").blur(function () {
    var cpfLimpo = $(this).val().replace(/[\.-]/g, "");
    var form_group = $(this).parents(".form-group");
    if (cpfLimpo != '') {

        if (validaCPF(cpfLimpo) == false) {
            $(form_group).addClass('has-error has-danger');
            $('.with-errors',form_group).html('CPF Inválido');

        } else {
            $(form_group).removeClass('has-error has-danger');
            $('.with-errors',form_group).html('');
        }
    }
});

$(".cnpjvalido").blur(function () {
    var cnpjLimpo = $(this).val().replace(/[\.-]/g, "");
    var form_group = $(this).parents(".form-group");
    if (cnpjLimpo != '') {

        if (validaCNPJ(cnpjLimpo) == false) {
            $(form_group).addClass('has-error has-danger');
            $('.with-errors',form_group).html('CNPJ Inválido');

        } else {
            $(form_group).removeClass('has-error has-danger');
            $('.with-errors',form_group).html('');
        }
    }
});

$(".emailvalido").keyup(function () {

    var form_group = $(this).parents(".form-group");
    $(form_group).removeClass('has-error has-danger');
    $('.with-errors',form_group).html('');

});

$(".cpfvalido").keyup(function () {

    var form_group = $(this).parents(".form-group");
    $(form_group).removeClass('has-error has-danger');
    $('.with-errors',form_group).html('');

});

$(".cnpjvalido").keyup(function () {

    var form_group = $(this).parents(".form-group");
    $(form_group).removeClass('has-error has-danger');
    $('.with-errors',form_group).html('');

});

function mostraDataHoraAtual()
{
    var data = new Date(),
        dia  = data.getDate().toString(),
        diaF = (dia.length == 1) ? '0'+dia : dia,
        mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
        mesF = (mes.length == 1) ? '0'+mes : mes,
        anoF = data.getFullYear();
    horaF = data.getHours();
    minF = data.getMinutes();
    return diaF+"/"+mesF+"/"+anoF+' '+horaF+':'+minF;
}

/******* Data formatada BR *************/
function dtFormatadaBr(data) {
    var data = new Date(data),
        dia = ("0" + (data.getDate() + 0)).slice(-2),
        mes = ("0" + (data.getMonth() + 1)).slice(-2),
        ano = data.getFullYear();
    return [dia, mes, ano].join('/');
}

/* dd/mm/yyyy para yyyy-mm-dd */
function formataData_BR_to_DB(data) {
    var arr = data.split('/');
    return [arr[2], arr[1], arr[0]].join('-');
}

/* yyyy-mm-dd para dd/mm/yyyy  */
function formataData_DB_to_BR(data) {
    var data = new Date(data),
        dia = ("0" + (data.getDate() + 1)).slice(-2),
        mes = ("0" + (data.getMonth() + 1)).slice(-2),
        ano = data.getFullYear();
    return [dia, mes, ano].join('/');
}

function dataAtual_BR() {
    var data = new Date(),
        dia = ("0" + (data.getDate() + 1)).slice(-2),
        mes = ("0" + (data.getMonth() + 1)).slice(-2),
        ano = data.getFullYear();
    return [dia, mes, ano].join('/');
}


// ******************Adicionar duas casas decimais ****************************
function number_format(number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''

    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
            .toFixed(prec)
    }

    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
}

function atualizaAvisosAsync() {
    $.ajax({
        url: '/headerAviso',
        type: 'GET',
        async: false
    })
        .success(function (response) {
            $('.javisos').html(response)
        });
}

function atualizaAvisos() {
    $.ajax({
        url: '/headerAviso',
        type: 'GET'
    })
        .success(function (response) {
            $('.javisos').html(response)
        });
}

/**** Modal Aviso ***/
function modalAvisos(id, titulo, string, urlArquivo, nomeArquivo, tipoAviso, indObrigResposta, detalhes) {

    var botoesModalConfirm = {
        cancel: {
            text: 'Fechar',
        }
    };


    if (urlArquivo != '') {
        string += '<br><a href="/arquivos/avisos/' + urlArquivo + '" target="_blank"><small><i class="fa fa-file-o"></i> ' + nomeArquivo + '</small></a>';
    }

    if (detalhes != '') {
        string = '<small>' + detalhes + '</small><br>Mensagem:<br>' + string;
    }

    if (indObrigResposta == "1") {
        string += '<br>Resposta:<br><input type="text" class="form-control input-sm jrespostaPrescricao" name="respostaPrescricao">';

        botoesModalConfirm['EnviarResposta'] = {
            text: 'Enviar Resposta',
            btnClass: 'btn-blue',
            action: function () {

                if ($(".jrespostaPrescricao").val() != "") {
                    //chama ajax pra gravar a resposta
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "/salvaRespostaAviso",
                        type: "GET",
                        async: false,
                        data: {idAviso: id, titulo: titulo, resposta: $(".jrespostaPrescricao").val()},
                        headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                        success: function (response) {
                            atualizaAvisos();
                        },
                        error: function (response) {
                            atualizaAvisos();
                            $.alert('Não foi possível salvar a resposta');
                        }
                    });
                }
                else {
                    $.alert('Favor preencher uma resposta!');
                }

            }
        };
    }
    else {
        botoesModalConfirm['ok'] = {
            text: 'OK',
            btnClass: 'btn-blue',
            action: function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/okAviso",
                    type: "GET",
                    async: false,
                    data: {idAviso: id, titulo: titulo},
                    headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                    success: function (response) {
                        atualizaAvisos();
                    },
                    error: function (response) {
                        atualizaAvisos();
                        $.alert('Não foi possível Marcar com lido');
                    }
                });

            }
        };
    }

    $.confirm({
        theme: 'light',
        title: titulo,
        content: string,
        buttons: botoesModalConfirm
    });
}

// Setar um cookie
function setCookie(cname, cvalue) {
    var d = new Date();
    // d.setTime(d.getTime() + (exdays*24*60*60*1000));
    // var expires = "expires=" + d.toGMTString();
    var expires = d.getTime() + (60 * 1);
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//Recuperar um cookie
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

//validação data início
function verificaDataInicial(numPer) {

    //validação data início
    $('.dataInicio_' + numPer).change(function () {

        //data inicial
        var strData = $('.dataInicio_' + numPer).val();
        var partesData = strData.split("/");
        var dataInicial = new Date(partesData[2], partesData[1] - 1, partesData[0]);


        var endData = $('.dataFinal_' + numPer).val();
        var partesData = endData.split("/");
        var datafinal = new Date(partesData[2], partesData[1] - 1, partesData[0]);

        if (dataInicial > datafinal) {
            $('.dataInicio_' + numPer).val("");

            $.alert({
                theme: 'light',
                title: 'ALERTA',
                content: 'Data inícial, não pode ser maior que data final!',
            });
        }
    });
}


//validacao data final
function verificaDataFinal(numPer) {
    //validação data final
    $('.dataFinal_' + numPer).change(function () {

        //data inicial
        var strData = $('.dataInicio_' + numPer).val();
        var partesData = strData.split("/");
        var dataInicial = new Date(partesData[2], partesData[1] - 1, partesData[0]);


        var endData = $('.dataFinal_' + numPer).val();
        var partesData = endData.split("/");
        var datafinal = new Date(partesData[2], partesData[1] - 1, partesData[0]);

        if (dataInicial > datafinal) {
            $('.dataFinal_' + numPer).val("");

            $.alert({
                theme: 'light',
                title: 'ALERTA',
                content: 'Data final, não pode ser maior que a inícial!',
            });
        }
    });
}

/******** Valida Data **********/
function validateDate(id) {
    var RegExPattern = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])      [\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;

    if ($(id).val() != '') {
        if (!((id.value.match(RegExPattern)))) {
            $.alert('Data inválida');
            $(id).val('');
        }
    }
}


function validaCampoUnicoExistente(thiis, submit= false)
{

    var tipo = $(thiis).attr("name").substring(5);
    var valorDigitado = $(thiis).val();
    var idEdit = $(thiis).attr("pkVal");
    var nametabela = $(thiis).attr("tablename");
    var nameColunaValidar = $(thiis).attr("id");
    if($(thiis).attr("columnname") != undefined) {
        nameColunaValidar = $(thiis).attr("columnname");
    }
    var nameColunaPK = $(thiis).attr("pknametable");

    var idEmpresa = $("#a005_id_empresa").val();

/// ...
/// tipo = cpf ou cnpj
/// valor = é o valor preenchido no campo
/// id = é o caso de edit, é o valor da chave primaria , para nao validar com ele mesmo
/// nametabela = table onde vai validar se ja existe
/// nameColunaCpfCnpj = nome da coluna na tabela que vai validar
/// nameColunaPK = nome da coluna da tabela da chave primaria
//function validaCpfCnpjExistente(tipo, valor, id, nametabela, nameColunaCpfCnpj, nameColunaPK, thiis)
//{

    var valorDigitadoLimpo = valorDigitado.replace(/[\.-]/g, "");
    var form_group = $(thiis).parents(".form-group");

    if (valorDigitadoLimpo.length == 0) {
        return true;
    }
    if(tipo == 'cpf' || tipo == 'cnpj') {
        if (valorDigitadoLimpo.length != 11 && valorDigitadoLimpo.length != 14) {
            return true;
        }
    }

    $.ajax({
        url: '/new_gebit/app.dealix.com.br/validaUnicoExistente',
        type: 'GET',
        data: {
            valorDigitado: valorDigitado,
            idEdit:idEdit,
            nametabela:nametabela,
            nameColunaValidar:nameColunaValidar,
            nameColunaPK:nameColunaPK,
            idEmpresa:idEmpresa
        }
    })
        .success(function (response) {
            console.log(response)

            if (response == 1) {
                $(form_group).addClass('has-error has-danger');
                if(tipo == 'cpf') {
                    $('.with-errors',form_group).html('CPF já Existente');
                }
                else if(tipo == 'cnpj')
                {
                    $('.with-errors',form_group).html('CNPJ já Existente');
                }
                else if(tipo == 'email')
                {
                    $('.with-errors',form_group).html('E-mail já Existente');
                }
                else {
                    $('.with-errors',form_group).html('Informação já Existente');
                }
                return false;
            }
            else if(response == 2)
            {
                $(form_group).addClass('has-error has-danger');
                $('.with-errors',form_group).html('Selecione a empresa');
            }
            else {
                if($( ".with-errors:contains('Existe')",form_group).length>0) {
                    $(form_group).removeClass('has-error has-danger');
                    $('.with-errors', form_group).html('');
                }
                if($( ".with-errors:contains('Selecione')",form_group).length>0) {
                    $(form_group).removeClass('has-error has-danger');
                    $('.with-errors', form_group).html('');
                }


            }
            if (submit) {
                criaContrato();
            }
        });
    }
    
    function criaContrato() {
        const radiosEmpresa = document.getElementsByName('a013_empresa_contratante');
        const radiosStatus = document.getElementsByName('a013_status');
    
        const valEmpresa = getValorSelecionado(radiosEmpresa);
        const valStatus = getValorSelecionado(radiosStatus);
    
        const dadosContrato = {
            a013_moeda: $("#a013_moeda").val(),
            a013_status: valStatus,
            a013_data_fim: $("#a013_data_fim").val(),
            a013_finalidade: $("#a013_finalidade_cliente").val(),
            a013_valor_extra: $("#a013_valor_extra").val(),
            a013_data_inicio: $("#a013_data_inicio").val(),
            a013_obs_contrato: $("#a013_obs_contrato_cliente").val(),
            a013_valor_fracao: $("#a013_valor_fracao").val(),
            a013_classificacao: $("#a013_classificacao").val(),
            a013_prazo_contrato: $("#a013_prazo_contrato").val(),
            a013_numero_contrato: $("#a013_numero_contrato").val(),
            a008_id_cat_contrato: $("#a008_id_cat_contrato").val(),
            a013_dias_vencimento: $("#a013_dias_vencimento").val(),
            a005_id_empresa_select: $("#a005_id_empresa").val(),
            a005_id_empresa_cli_for: $("#a005_id_empresa_cli_for").val(),
            a013_empresa_contratante: valEmpresa,
            a013_valor_total_contrato: $("#a013_valor_total_contrato").val(),
            a013_valor_extra_referencia: $("#a013_valor_extra_referencia").val()
        };
    
        $.ajax({
            url: '/new_gebit/app.dealix.com.br/contrato/createcontrato',
            type: 'GET',
            data: dadosContrato
        }).done(function (response) {
            if (response == '1') {
                window.location.href = '/new_gebit/app.dealix.com.br/contrato';
            } else {
                console.error('Ocorreu um erro.');
            }
        });
    }
    
    function getValorSelecionado(radios) {
        for (let i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                return radios[i].value;
            }
        }
        return '';
    }

function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}



$('.form').validator().on('submit', function (e) {
    if ($('.cpfvalido').length) {
        var cpfLimpo = $(".cpfvalido").val().replace(/[\.-]/g, "");

        if(cpfLimpo.length>0) {
            if (validaCPF(cpfLimpo) == false) {
                $('.box_cpfvalido').addClass('has-error has-danger');
                $('.erro_cpf').html('CPF Inválido');
                return false;
            }
        }
    }

    if ($('.cnpjvalido').length) {
        var cnpjLimpo = $(".cnpjvalido").val().replace(/[\.-]/g, "");

        if(cnpjLimpo.length>0) {
            if (validaCNPJ(cnpjLimpo) == false) {
                $('.box_cnpjvalido').addClass('has-error has-danger');
                $('.erro_cnpj').html('CNPJ Inválido');
                return false;
            }
        }
    }

    if ($('.emailvalido').length) {
        var campoLimpo = $(".emailvalido").val();

        if (campoLimpo != '' && validaEmail(campoLimpo) == false) {
            $('.box_emailvalido').addClass('has-error has-danger');
            $('.erro_email').html('E-mail Inválido');
            return false;
        }
    }




    ///validar se o termo Existente ou Cadastrada esta no error do html pra nao deixar salvar e prosseguir
    if(!e.isDefaultPrevented()) {
        if ($('.validaunico').length) {
            e.preventDefault();
            var retorno = validaCampoUnicoExistente($(".validaunico"), true);

        }
    }


});


$(document).ready(function () {

    $(".select2 ").select2({
        selectOnClose: true, //auto select when select2 dropdown is closed
        language: 'pt-BR'
    });


    $('.dataCalendario').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR',
        autoclose: true
    });
    $('.cpfMask').mask('000.000.000-00', {reverse: true});
    $('.cnpjMask').mask('00.000.000/0000-00', {reverse: true});

    $('.dataMaskplaceholder').mask('00/00/0000', {placeholder: "__/__/____"});
    $('.dataMask').mask('00/00/0000');

    $('.numero3Maskplaceholder').mask('999', {placeholder: "___"});
    $('.numero3Mask').mask('999', );

    $('.numero4Maskplaceholder').mask('9999', {placeholder: "____"});
    $('.numero4Mask').mask('9999', );

    $('.cepMask').mask('99999-999');

    $('.horaMask').mask('H0:M0', {
        translation: {
            'H': {
                pattern: /[0-2]/
            },
            'M': {
                pattern: /[0-5]/
            }
        },
        placeholder: "__:__"
    });

    $('.alfaNumericoMask7').mask('ZZZZZZZ', {translation: {'Z': {pattern: /[a-zA-Z0-9]/, optional: true}}});
    $('.alfaNumericoMask20').mask('ZZZZZZZZZZZZZZZZZZZZ', {translation: {'Z': {pattern: /[a-zA-Z0-9]/, optional: true}}});

    $('.moneyMaskCuston').mask("#.##0,00", {
        reverse: true,
        onKeyPress: function (valor, event, currentField, options) {

            //verifica se tem  digitado no campo  algo maior que zero
            if (valor > 0) {
                //se for 1 digito preencher com zeros na frente
                if (valor.length == 1) {
                    $(currentField).val('0,0' + $(currentField).val())
                }
                //se for 2 digito preencher com zeros na frente
                else if (valor.length == 2) {
                    $(currentField).val('0,' + $(currentField).val())
                }
            }
            //verifica se o que esta digitado é maior que 4 digitos (0,00) entao a cada digito some com o zero a esquerda pois zeros a esquerda nao tem valor real
            if (valor.length > 4) {
                validarzero = valor.substring(0, 1);

                if (validarzero == "0") {
                    valor = valor.substring(1);
                    $(currentField).val(valor)
                }
            }
            //valida se é 00 no campo entao muda pra 1 zero somente
            if (valor == "00") {
                valor = valor.substring(1);
                $(currentField).val(valor)
            }
        }
    });

    $('.decimal4MaskCuston').mask("#.##0,0000", {
        reverse: true,
        onKeyPress: function (valor, event, currentField, options) {

            //verifica se tem  digitado no campo  algo maior que zero
            if (valor > 0) {
                //se for 1 digito preencher com zeros na frente
                if (valor.length == 1) {
                    $(currentField).val('0,000' + $(currentField).val())
                }
                //se for 2 digito preencher com zeros na frente
                else if (valor.length == 2) {
                    $(currentField).val('0,00' + $(currentField).val())
                }
                else if (valor.length == 3) {
                    $(currentField).val('0,0' + $(currentField).val())
                }
                else if (valor.length == 4) {
                    $(currentField).val('0,' + $(currentField).val())
                }
            }
            //verifica se o que esta digitado é maior que 6 digitos (0,0000) entao a cada digito some com o zero a esquerda pois zeros a esquerda nao tem valor real
            if (valor.length > 6) {
                validarzero = valor.substring(0, 1);
                console.log(validarzero)
                if (validarzero == "0") {
                    valor = valor.substring(1);
                    $(currentField).val(valor)
                }
            }
            //valida se é 00 no campo entao muda pra 1 zero somente
            if ((valor == "00")||(valor == "000")||(valor == "0000")) {
                valor = valor.substring(1);
                $(currentField).val(valor)
            }
        }
    });

    $(".numeroMask").mask("9#");


    var NonoDigito = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(NonoDigito.apply({}, arguments), options);
            }
        };

    $('.foneddd').mask(NonoDigito, spOptions)


    var cpfCnpj = function (val) {
            return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-00999';
        },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(cpfCnpj.apply({}, arguments), options);
            }
        };
    $('.cpfCnpjmask').mask(cpfCnpj, spOptions)

    var percentDigito = function (val) {
            return val.replace(/\D/g, '').length === 3 ? '00' : '009';
        },
        percentOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(percentDigito.apply({}, arguments), options);
            },
            onComplete: function(perc) {
                $('.percent3Mask').val(100);
            },
        };

    $('.percent3Mask').mask(percentDigito,percentOptions);

    $('input[type="checkbox"][readonly]').attr("onclick","return false;");
});


$(document).ajaxStart(function(){
    $.blockUI({
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#ccc',
            left: '50%',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .9,
            color: '#fff',
            border: '1px solid #aaa',
            'width': '160px'
        },
        message: '<h1 style="color: red;"><img src="/img/logo-login.png" style="width: 110px;" /> Aguarde</h1>'
    });
}).ajaxStop(function() {
    $.unblockUI();
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.jImagemExibirUpload').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
$(".jInputFileUploadImg").change(function() {
    readURL(this);
});

