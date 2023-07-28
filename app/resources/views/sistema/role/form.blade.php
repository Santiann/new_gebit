<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/role')}}" class="btn btn-default">
        <i class="fa fa-ban"></i> Cancelar
    </a>

    <button type="submit" class="btn btn-success pull-right">
        <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
</div>

{!! Form::hidden('ind_super_adm', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id'=>'ind_super_adm']) !!}
{!! Form::hidden('ind_adm', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id'=>'ind_adm']) !!}
{!! Form::hidden('ind_cliente', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id'=>'ind_cliente']) !!}
{!! Form::hidden('ind_fornecedor', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id'=>'ind_fornecedor']) !!}

<div class="box-body">
    <div class="row">
        <div class="col-md-3 jPerfilAdmMostra">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'maxlength'=>'150', 'required' => 'required','autocomplete' => 'off']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-4 jPerfilAdmMostra">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', 'Descrição', ['class' => 'control-label']) !!}
                {!! Form::text('description', null, ['class' => 'form-control' , 'maxlength'=>'150','required' => 'required','autocomplete' => 'off']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4 jPerfilAdm" >
            <div class="form-group {{ $errors->has('a005_id_empresa') ? 'has-error' : ''}}">
                {!! Form::label('a005_id_empresa', 'Empresa', ['class' => 'control-label']) !!}
                {!! Form::select('a005_id_empresa',$comboEmpresa,null,array('class' => 'form-control select2 text-uppercase','id'=>'a005_id_empresa', 'required' => 'required','autocomplete' => 'off'))!!}
                {!! $errors->first('a005_id_empresa', '<p class="help-block">:message</p>') !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-1 jPerfilAdm">
            <div class="form-group " >
                <label class="control-label">Status </label>
                <div style="margin-top: 7px;">
                    <label class="control-label">{!! Form::checkbox('status', 1,  ($role->status??"1") == 1 ?  true : false, ['id' => 'status','class'=>'control-label','autocomplete' => 'off']) !!} Ativo</label>&ensp;
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="box1 col-md-12">
            <div class="form-group {{ $errors->has('a001_id_usuario') ? 'has-error' : ''}}">
                {!! Form::select('a001_id_usuario[]', $usuario??[], $usuarioSelected??[1], array('class' => 'form-control jSelectListUsuario','size'=>'10','multiple' => 'multiple','autocomplete' => 'off')) !!}

                <div class="help-block with-errors"></div>
            </div>
        </div>
    <!-- https://www.virtuosoft.eu/code/bootstrap-duallistbox/  EXEMPLO-->
    </div>

    <div class="row">
        @php
            // dump($permissions->where('tipo','MENU')->sortBy('ordem')->sortBy('modulo.ordem'));
        @endphp
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>

                <td align="center" width="2%">
                    <button type="button" class="btn btn-xs bg-white" checado="0" onclick="checktodos('menu', this)"><i class="fa fa-square"></i></button>

                </td>
                <td>Menu</td>
                <td align="center" width="10%">
                    <button type="button" class="btn btn-xs bg-gray" checado="0" onclick="checktodos('showmenu', this)"><i class="fa fa-square"></i></button>
                    Visualizar
                </td>
                <td align="center" width="10%">
                    <button type="button" class="btn btn-xs bg-green" checado="0" onclick="checktodos('createmenu', this)">
                        <i class="fa fa-square"></i></button>
                    Adicionar
                </td>
                <td align="center" width="8%">
                    <button type="button" class="btn btn-xs btn-primary" checado="0" onclick="checktodos('editmenu', this)">
                        <i class="fa fa-square"></i></button>
                    Alterar
                </td>
                <td align="center" width="8%">
                    <button type="button" class="btn btn-xs btn-danger" checado="0" onclick="checktodos('deletemenu', this)"><i class="fa fa-square"></i></button>
                    Excluir
                </td>
            </tr>
            </thead>
            <tbody>

            @if(($menusQuery??"")!="")
                @foreach($menusQuery as $menu)
                    <tr class="{{$menu->idclassFilhos}}">
                        <td align="center"  style="">
                            <label class="mt-checkbox mt-checkbox-outline">
                                {{ Form::checkbox('permission[]', $menu->id, in_array($menu->id, $rolePermissions) ? true : false, ['class' => 'menu ', "onclick"=>"fSelecionaLinha(this,'".$menu->idclassPai."')"]) }}
                                <span></span>
                            </label>
                        </td>
                        <td>
                            @if ($menu->idclassFilhos == "")
                                <strong>{{ $menu->display_nameEspacos }}</strong>
                            @else
                                {!! $menu->display_nameEspacos !!}
                            @endif
                             ({{ $menu->url }})&nbsp;&nbsp;&nbsp;
                        </td>

                        @php
                            $permShow = $permissions->where('tipo','PERM')->where('name',$menu->name."-show")->values()->all();

                            $idPermShow = -3;
                            if(isset($permShow)&&count($permShow)>0)
                                $idPermShow = $permShow[0]->id;
                                $permsTypes = ['-create','-edit','-delete'];
                                $perms = [$idPermShow+1,$idPermShow+2,$idPermShow+3];
                                $i=0;


                        @endphp


                        <td align="center">
                            <!-- input do show adicionado junto ao primeiro checkbox e vai aceitar o mesmo valor checado ou nao do listar-->
                            <label class="mt-checkbox mt-checkbox-outline">
                                {{ Form::checkbox('permission[]', $permShow[0]->id, in_array($permShow[0]->id, $rolePermissions) ? true : false, ['class' => str_replace('-',' ',$permShow[0]->name."menu"), "onclick"=>"fSelecionaColuna(this,'".$menu->idclassPai."')"]) }}
                                <span></span>
                            </label>
                        </td>

                        @foreach($perms as $tipoperm)
                            <td align="center">

                                @foreach($permissions->where('tipo','PERM')->where('id',$tipoperm)->sortBy('name') as $perm)
                                    @if(strpos($perm->name,$permsTypes[$i]))
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            {{ Form::checkbox('permission[]', $perm->id, in_array($perm->id, $rolePermissions) ? true : false, ['class' => str_replace('-',' ',$perm->name."menu"),"onclick"=>"fSelecionaColuna(this,'".$menu->idclassPai."')"]) }}
                                            <span></span>
                                        </label>
                                    @endif
                                @endforeach
                            </td>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
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
            $(".clear1").hide();
            $(".clear2").hide();
            @if(Auth::user()->ind_super_adm<=0)
                buscaUsuariosExistente();
            @endif
        });

        var jSelectListUsuario = $('.jSelectListUsuario').bootstrapDualListbox({
            nonSelectedListLabel: '<label class="control-label">Lista de Usuários</label>',
            selectedListLabel: '<label class="control-label">Lista de Usuários Selecionados</label>',
            preserveSelectionOnMove: false,
            moveOnSelect: false,
            nonSelectedFilter: '',
            infoText: false,
            infoTextEmpty: false
        });


        function fSelecionaLinha(campo, id) {
            id = id.replace(" ", "");
            $("input:checkbox", $("." + id)).prop("checked", $(campo).prop("checked"));
            $("input:checkbox", $(campo).parents("tr")).prop("checked", $(campo).prop("checked"));
        }

        function fSelecionaColuna(campo, id) {
            id = id.replace(" ", "");
            var permission = $(campo).attr('class').split(' ')[1];
            $("."+permission, $("." + id)).prop("checked", $(campo).prop("checked"));
        }

        function checktodos(classCamposCheck, campoClick) {

            if ($(campoClick).attr("checado") == "1") {
                $(campoClick).attr("checado", "0");
                $("i", campoClick).removeClass("fa-check-square").addClass("fa-square");
                $("." + classCamposCheck).prop("checked", false);
                if (classCamposCheck == "menu")
                    $("input:checkbox", $(campoClick).parents("table")).prop("checked", false);
            }
            else {
                $(campoClick).attr("checado", "1");
                $("i", campoClick).removeClass("fa-square").addClass("fa-check-square");
                $("." + classCamposCheck).prop("checked", true);
                if (classCamposCheck == "menu")
                    $("input:checkbox", $(campoClick).parents("table")).prop("checked", true);
            }
        }

        $('#submitForm').click(function (event) {

            if ($('#formRoles').serialize().indexOf('permission') == -1) {
                event.preventDefault();
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'É necessário selecionar ao menos uma <strong>permissão.</strong>'
                });
            }
        });

        $("#a005_id_empresa").change(function($value){
            buscaUsuariosExistente();
        });

        function buscaUsuariosExistente()
        {

            var id_empresa = $("#a005_id_empresa").val();



            $.ajax({
                url: '/usuarioEmpresa',
                type: 'GET',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {
                    id_empresa: id_empresa,
                    indRoleFixo: 0
                },
                success: function (response) {


                    $('.jSelectListUsuario').html('');

                    $.each(response, function (i,val) {
                        $('.jSelectListUsuario').append('<option value="' + i + '">' + val + '</option>');
                    });
                    jSelectListUsuario.bootstrapDualListbox('refresh');


                },
                error: function () {

                }
            });


        }


    </script>
@endpush
