<div class="jContato">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('a029_tipo_contato') ? 'has-error' : ''}}">
                {!! Form::label('a029_tipo_contato', 'Tipo', ['class' => 'control-label']) !!}
                {!! Form::select('a029_tipo_contato_form',$optionTipo_contato??[],null,array('class' => 'form-control select2','id'=>'a029_tipo_contato_form','autocomplete' => 'off'))!!}
                {!! $errors->first('a029_tipo_contato', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('a029_nome') ? 'has-error' : ''}}">
                {!! Form::label('a029_nome', 'Nome', ['class' => 'control-label']) !!}
                {!! Form::text('a029_nome_form', null, ['class' => 'form-control','autocomplete' => 'off', 'id'=>'a029_nome_form']) !!}
                {!! $errors->first('a029_nome', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('a029_fone') ? 'has-error' : ''}}">
                {!! Form::label('a029_fone', 'Telefone', ['class' => 'control-label']) !!}
                {!! Form::text('a029_fone_form', null, ['class' => 'form-control foneddd','autocomplete' => 'off', 'id'=>'a029_fone_form']) !!}
                {!! Form::text('a029_foneSemMask_form', null, ['class' => 'form-control numeroMask','autocomplete' => 'off', 'id'=>'a029_foneSemMask_form', "style"=>"display:none;"]) !!}
                {!! $errors->first('a029_fone', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('a029_email') ? 'has-error' : ''}}">
                {!! Form::label('a029_email', 'E-mail', ['class' => 'control-label']) !!}
                {!! Form::text('a029_email_form', null, ['class' => 'form-control emailvalido','autocomplete' => 'off', 'id'=>'a029_email_form']) !!}
                {!! $errors->first('a029_email', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group " >
                <label class="control-label">Status </label>
                <div style="margin-top: 7px;">
                    <label class="control-label">{!! Form::checkbox('a029_status_form', 1,  true , ['id' => 'a029_status_form','class'=>'control-label']) !!} Ativo</label>&ensp;
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <label  class="control-label" style="width: 100%;">&nbsp;</label>
            <a class="btn bg-green pull-right" href="javascript: addTableContato();" style="width: 100%;">
                <i class="fa fa-plus"></i> Adicionar
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="table-contato">
                        <tr>
                            <th>Tipo</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th class="jcontatode" >Cadastrado por</th>
                            <th style="width:80px">Ação</th>
                        </tr>
                        @if (($contatos??'') != '')

                            @foreach ($contatos as $row)
                                <?php
                                $txtStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i>  Ativo </span>';
                                if($row['a029_status'] == 0)
                                    $txtStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i>  Inativo </span>';
                                ?>
                                <tr class="dados_id bg_add_linha">
                                    <td>{{ $optionTipo_contato[$row['a029_tipo_contato']] }}<input type="hidden" id="a029_tipo_contato" name="a029_tipo_contato[]" value="{{ $row['a029_tipo_contato'] }}"></td>
                                    <td>{{ $row['a029_nome'] }}<input type="hidden" id="a029_nome" name="a029_nome[]" value="{{ $row['a029_nome'] }}"></td>
                                    <td>{{ (($empresa->a005_ind_estrangeiro??0) == 0) ? $row['a029_fone'] : $row['a029_foneSemMask'] }}<input type="hidden" id="a029_fone" name="a029_fone[]" value="{{ $row['a029_fone'] }}"></td>
                                    <td>{{ $row['a029_email'] }}<input type="hidden" id="a029_email" name="a029_email[]" value="{{ $row['a029_email'] }}"></td>
                                    <td>{!! $txtStatus !!}<input type="hidden" id="a029_status" name="a029_status[]" value="{{ $row['a029_status'] }}"></td>
                                    <td class="jcontatode">{{ $row->Usuario_createdBy->a001_nome  }}<input type="hidden" id="created_at_user" name="created_at_user[]" value="{{ $row['created_at_user'] }}"></td>
                                    <td>
                                        <div class="btn btn-info"  title="Editar Contato" onclick="editacontatoempresa(this)"><i class="fa fa-edit" aria-hidden="true"></i></div>
                                        <div class="btn btn-danger" title="Remover Contato" onclick="removecontatoempresa('Tem certeza que deseja excluir este contato?', this)"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(function() {
            @if (!$isFornecedorOrAdmin)
                $('#a029_tipo_contato_form option[value="C"]').attr('disabled',true)
                $('#a029_tipo_contato_form').select2()
            @endif
        });
        function addTableContato() {
            let a029_tipo_contato = $("#a029_tipo_contato_form").val();
            let a029_nome = $("#a029_nome_form").val();
            let a029_fone = $("#a029_fone_form").val();
            let a029_foneSemMask = $("#a029_foneSemMask_form").val();
            let a029_status = $('#a029_status_form').is(':checked')

            if(a029_foneSemMask != "")
            {
                a029_fone = a029_foneSemMask;
            }

            var a029_email = $("#a029_email_form").val();

            if (a029_tipo_contato_form == "" || a029_nome == "" || a029_fone == "" || a029_email == "" ) {
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor Preencher todos os campos!',
                });
                return;
            }

            if (validaEmail(a029_email) == false) {
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor Preencher um e-mail Válido!',
                });
                return;
            }

            var txtStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i>  Ativo </span>'
            if(a029_status==0)
            {
                txtStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i>  Inativo </span>'
            }
            var txtContato = $("#a029_tipo_contato_form").find(":selected").text();

            var colextra = '';
            @if(($empresa->a004_dono_cadastro??1) == 1)
                colextra ='<td></td>'
            @endif

            var addLinha = '<tr class="dados_id bg_add_linha">' +
                '<td>' + txtContato + '<input type="hidden" name="a029_tipo_contato[]" id="a029_tipo_contato" value="' + a029_tipo_contato + '"></td>' +
                '<td>' + a029_nome + '<input type="hidden" name="a029_nome[]" id="a029_nome" value="' + a029_nome + '"></td>' +
                '<td>' + a029_fone + '<input type="hidden" name="a029_fone[]" id="a029_fone" value="' + a029_fone + '"></td>' +
                '<td>' + a029_email + '<input type="hidden" name="a029_email[]" id="a029_email" value="' + a029_email + '"></td>' +
                '<td>' + txtStatus + '<input type="hidden" name="a029_status[]" id="a029_status" value="' + a029_status + '"></td>' +
                colextra +
                '<td>' +
                '<div class="btn btn-info" title="Editar Contato" onclick="editacontatoempresa(this)"><i class="fa fa-edit" aria-hidden="true"></i></div>'+
                '<div class="btn btn-danger" title="Excluir Contato" onclick="removecontatoempresa(\'Tem certeza que deseja excluir este Contato?\', this)">' + '<i class="fa fa-trash-o" aria-hidden="true"></i></div>' +
                '</td>' +
                '</tr>';
            $('#table-contato').append(addLinha);


            /***** Resentando os valores dos campos ******/
            $("#a029_tipo_contato_form").val("");
            $("#a029_nome_form").val("");
            $("#a029_fone_form").val("");
            $("#a029_email_form").val("");
            $("#a029_status_form").prop("checked", true);
            $('#a029_tipo_contato_form').select2();

            // let newOption = new Option(a029_nome, a029_nome, false, false);
            // $('#notify_contato').append(newOption).trigger('change');
        }

        function editacontatoempresa(thiscampo)
        {
            var linha = $(thiscampo).parents('.dados_id');
            if((linha.length)>0) {
                linha = linha[0];
                var a029_tipo_contato = $("#a029_tipo_contato", linha).val();
                var a029_nome = $("#a029_nome", linha).val();
                var a029_fone = $("#a029_fone", linha).val();
                var a029_email = $("#a029_email", linha).val();
                var a029_status = $("#a029_status", linha).val();

                $("#a029_tipo_contato_form").val(a029_tipo_contato);
                $("#a029_nome_form").val(a029_nome);
                $("#a029_fone_form").val(a029_fone);
                $("#a029_email_form").val(a029_email);

                if (a029_status == 1) {
                    $("#a029_status_form").prop("checked", true);
                }
                else {
                    $("#a029_status_form").prop("checked", false);
                }

                $('#a029_tipo_contato_form').select2();

                linha.remove();
            }
        }

        function removecontatoempresa(string,  thiscampo) {
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

                            // let nome = $(thiscampo).parents('.dados_id').find('#a029_nome').val();
                            // $('#notify_contato option[value="'+nome+'"]').detach();
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }
    </script>
@endpush