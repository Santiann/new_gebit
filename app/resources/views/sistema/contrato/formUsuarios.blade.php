<div class="row">
    <div class="FormSubtitulo">

    </div>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            {!! Form::label('add_new_user', 'Selecione o usuário que terá acesso ao contrato', ['class' => 'control-label']) !!}
            {!! Form::select('add_new_user',$comboUsuarios ?? [],null,array('class' => 'form-control select2 ','id'=>'add_new_user', 'autocomplete' => 'off'))!!}
        </div>
        <div class="col-md-4">
            {!! Form::label('permission_new_user', 'Perfil do usuário', ['class' => 'control-label']) !!}
            <div class="form-group " >
                <div style="margin-top: 7px;">
                    <label class="control-label">{!! Form::checkbox('permission_new_user', 0, false, ['id' => 'permission_new_user','class'=>'control-label']) !!} Administrador (poderá editar todos os campos)</label>&ensp;
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-2">
        <br>
            <button type="button" class="ml-2 button-modal btn bg-info" onclick="addUsuario()">
                <i class="fa fa-user"></i> Adicionar membro
            </button>
        </div>
    </div>
    <br>
    <br>
    <table class="display responsive nowrap" style="width:100%" id="tableUsuariosContrato">
        <thead>
            <th>Usuário</th>
            <!-- <th>Permissão</th> -->
        </thead>
        <tbody>
        @php($usuarios_acesso = json_decode($contrato->a013_usuarios_acesso) )
        @isset($usuarios_acesso)
        @foreach($usuarios_acesso as $usuario)
            <tr>
                <td>{{ $usuario->a001_nome }}</td>
            </tr>
        @endforeach
        @endisset
        </tbody>
    </table>
</div>

@push('js')
<script>
    function addUsuario()
    {
        let selected = $('#add_new_user').select2('data')[0];
        let isAdmin = $('#permission_new_user').is(':checked');
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/salvarUsuarios/{{ $contrato->a013_id_contrato }}",
            type: "POST",
            data: {a001_id_usuario: selected.id, a001_nome: selected.text, admin: isAdmin},
            headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
            success: function (response) {
                if (!response.success) {
                    $.alert(response.message);
                }
                else {
                    dataTableUsuariosContrato.row.add( [
                        selected.text,
                    ] ).draw( false );
                }
            },
            error: function (response) {
                $.alert('Não foi possível salvar o usuario');
                console.log(response)
            }
        });

    }
</script>
@endpush