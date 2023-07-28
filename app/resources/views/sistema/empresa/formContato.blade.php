@isset ($empresa)
<div class="row">
    <div class="">
    
    <!-- Modal -->
    <div class="modal fade" id="notificarContatoAlteracoes" tabindex="-1" role="dialog" aria-labelledby="notificarContatoAlteracoes" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-4">
            <div class="modal-header">
                <h3 class="modal-title">Notificar alterações para clientes/fornecedores</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>É necessário salvar as alterações da empresa para que as informações sejam atualizadas.</span>
                <div class="row mt-4">
                <div class="col-md-4">
                    <label for="notify_contato" class="control-label">Selecione o contato</label>
                    <select name="notify_contato" class="form-control select2" id="notify_contato">
                        @foreach ($EmpresaContatos as $row)
                        <option value="{{ $row['a006_id_empresa_contato'] }}">{{ $row['a006_nome'] }} ({{$optionTipo_contato[$row['a006_tipo_contato']] }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="notify_funcao" class="control-label">Responsável por</label>
                    <input id="notify_funcao" name="notify_funcao" class="form-control" autocomplete="off"/>
                </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <label for="notify_texto" class="control-label">Texto adicional</label>
                        <textarea class="form-control" autocomplete="off" name="notify_texto" type="text" id="notify_texto" rows="4" cols="50"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="visualizarAlteracaoContato()" type="button" class="btn btn-primary"><i class="fa fa-eye"></i> Visualizar mensagem</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button onclick="notificarAlteracaoContato()" type="button" class="btn btn-success"><i class="fa fa-envelope-o"></i> Enviar</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal -->
    <div class="modal fade" id="visualizarNotificacaoContato" tabindex="-1" role="dialog" aria-labelledby="visualizarNotificacaoContato" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-4">
            <div class="modal-header">
                <h3 class="modal-title">Mensagem</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>Prezado,<br><br>
                        Houve uma alteração nos contatos da empresa <span id="empresa"></span>. <span id="contato"></span> será o(a) novo(a) responsável por <span id="responsavel"></span>.
                        <br><br>
                        <span id="mensagem"></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    </div>
</div>
@endisset

<div class="jContato">

    @isset ($empresa)
    <div class="row justify-content-end">
        <div class="col-md-2">
        {!! Form::hidden('notificar_contatos', null, ['class' => 'form-control','autocomplete' => 'off', 'id'=>'notificar_contatos']) !!}
        <button type="button" class="ml-2 button-modal bg-blue pull-right" data-toggle="modal" data-target="#notificarContatoAlteracoes">
            <i class="fa fa-envelope-o"></i> Notificar alterações
        </div>
    </div>
    @endisset
    <div class="row">
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('a006_tipo_contato') ? 'has-error' : ''}}">
                {!! Form::label('a006_tipo_contato', 'Tipo', ['class' => 'control-label']) !!}
                {!! Form::select('a006_tipo_contato_form',$optionTipo_contato??[],null,array('class' => 'form-control select2','id'=>'a006_tipo_contato_form','autocomplete' => 'off'))!!}
                {!! $errors->first('a006_tipo_contato', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('a006_nome') ? 'has-error' : ''}}">
                {!! Form::label('a006_nome', 'Nome', ['class' => 'control-label']) !!}
                {!! Form::text('a006_nome_form', null, ['class' => 'form-control','autocomplete' => 'off', 'id'=>'a006_nome_form']) !!}
                {!! $errors->first('a006_nome', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('a006_fone') ? 'has-error' : ''}}">
                {!! Form::label('a006_fone', 'Telefone', ['class' => 'control-label']) !!}
                {!! Form::text('a006_fone_form', null, ['class' => 'form-control foneddd','autocomplete' => 'off', 'id'=>'a006_fone_form']) !!}
                {!! Form::text('a006_foneSemMask_form', null, ['class' => 'form-control numeroMask','autocomplete' => 'off', 'id'=>'a006_foneSemMask_form', "style"=>"display:none;"]) !!}
                {!! $errors->first('a006_fone', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('a006_email') ? 'has-error' : ''}}">
                {!! Form::label('a006_email', 'E-mail', ['class' => 'control-label']) !!}
                {!! Form::text('a006_email_form', null, ['class' => 'form-control emailvalido','autocomplete' => 'off', 'id'=>'a006_email_form']) !!}
                {!! $errors->first('a006_email', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group " >
                <label class="control-label">Status </label>
                <div style="margin-top: 7px;">
                    <label class="control-label">{!! Form::checkbox('a006_status_form', 1,  true , ['id' => 'a006_status_form','class'=>'control-label']) !!} Ativo</label>&ensp;
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
                        @if (($EmpresaContatos??'') != '')

                            @foreach ($EmpresaContatos as $row)
                                <?php
                                $txtStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i>  Ativo </span>';
                                if($row['a006_status'] == 0)
                                    $txtStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i>  Inativo </span>';
                                ?>
                                <tr class="dados_id bg_add_linha">
                                    <td>{{ $optionTipo_contato[$row['a006_tipo_contato']] }}<input type="hidden" id="a006_tipo_contato" name="a006_tipo_contato[]" value="{{ $row['a006_tipo_contato'] }}"></td>
                                    <td>{{ $row['a006_nome'] }}<input type="hidden" id="a006_nome" name="a006_nome[]" value="{{ $row['a006_nome'] }}"></td>
                                    <td>{{ (($empresa->a005_ind_estrangeiro??0) == 0) ? $row['a006_fone'] : $row['a006_foneSemMask'] }}<input type="hidden" id="a006_fone" name="a006_fone[]" value="{{ $row['a006_fone'] }}"></td>
                                    <td>{{ $row['a006_email'] }}<input type="hidden" id="a006_email" name="a006_email[]" value="{{ $row['a006_email'] }}"></td>
                                    <td>{!! $txtStatus !!}<input type="hidden" id="a006_status" name="a006_status[]" value="{{ $row['a006_status'] }}"></td>
                                    <td class="jcontatode">{{ $row['EmpresaCadastrou']  }}<input type="hidden" id="a005_id_empresa_criou" name="a005_id_empresa_criou[]" value="{{ $row['a005_id_empresa_criou'] }}"></td>
                                    <td>
                                        @if(($row['podeEditar']??0)!=0)
                                        <div class="btn btn-info"  title="Editar Contato" onclick="editacontatoempresa(this)"><i class="fa fa-edit" aria-hidden="true"></i></div>
                                        <div class="btn btn-danger" title="Remover Contato" onclick="removecontatoempresa('Tem certeza que deseja excluir este contato?', this)"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                        @endif
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
