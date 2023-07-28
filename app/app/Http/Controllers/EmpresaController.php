<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Empresa_contato;
use App\Empresa_socio;
use App\Empresa_usuario;
use App\Empresa_documento;
use App\Estado;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use App\Role;
use App\User;
use App\Usuario;
use App\UsuarioRoles;
use Yajra\DataTables\DataTables;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use GuzzleHttp;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:empresa-show|empresa-create|empresa-edit|empresa-delete']);
    }

    public function notificarAlteracaoContato(Request $request)
    {
        try {
            $controller = new Controller();
            
            $id_empresa = $request->route('id');
            $empresa = Empresa::find($id_empresa);
            $contato = Empresa_contato::find($request->notify_contato);

            $parametrosView['empresa'] = $empresa->a005_nome_fantasia ?? $empresa->a005_razao_social ?? $empresa->a005_nome_completo;
            $parametrosView['contato'] = $contato->a006_nome;
            $parametrosView['funcao'] = $request->notify_funcao;
            $parametrosView['mensagem'] = $request->notify_texto;

            $empresas = $empresa->Empresa_usuario_hasMany()->where('a005_id_empresa', $id_empresa)->with('Empresa_belongsTo')->get();

            foreach ($empresas as $key => $emp) {
                $emails = $emp->Usuario_belongsTo->empresas->pluck('a005_email')->toArray();
                $nome_empresa = $emp->a005_nome_fantasia ?? $emp->a005_razao_social ?? $emp->a005_nome_completo;

                foreach ($emails as $key => $value) {
                    $controller->enviaEmailPadraoView('sistema.email.alteracaoContato',$parametrosView,'Dealix','naoresponda@dealix.com.br',$nome_empresa, $value, 'Dealix - Alteração de Contato');
                }
            }

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function datatable(Request $request)
    {
        $tipo = ($request->tipo_empresa??'');
        $ind = '';
        $url = 'empresa';

        if($tipo != ''){
            ///adicionado a coluna pra filtrar no datatable
            $ind = 'a005_ind_'.$tipo;
            $url = 'emp_'.$tipo;
        }

        $edit = Entrust::can($url.'-edit');
        $delete = Entrust::can($url.'-delete');

        $comboTipo_cliente = $this->optionTipo_cliente();
        $comboTipo_empresa = $this->optionTipo_empresa();

        $query =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where(function($where) use($ind,$tipo){
                if($ind!='') {
                    $where->where('t005_empresa.'.$ind, 1);
                }
                if($tipo == 'empresa'){
                    $where->where('a004_dono_cadastro', 1);
                }
            })
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0)
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
            })
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW('max(a004_dono_cadastro) as a004_dono_cadastro'))
            ->addSelect(DB::RAW("concat(ifnull(a005_cpf,''),ifnull(a005_cnpj,''),ifnull(a005_cod_identificacao,'')) as a005_cpf_cnpj_id"))
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"));

        return Datatables::of($query)
            ->filterColumn('nome', function ($query, $keyword) {
                $sql = ' concat(ifnull(a005_nome_fantasia,\'\'),ifnull(a005_nome_completo,\'\')) ';
                $query->whereRaw($sql . ' like ?', ["%{$keyword}%"]);
            })


            ->addColumn('action', function ($row) use ($edit, $delete,$url) {
                $acoes = "";
                if ($edit) {
                    if(($row->a004_dono_cadastro??0) == 1)
                    {
                        $acoes .= '<a class="btn btn-xs btn-primary" title="Editar "  href="/'.$url.'/' . $row->a005_id_empresa . '/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
                    }
                    else{
                        $acoes .= '<a class="btn btn-xs btn-primary" title="Abrir "  href="/'.$url.'/' . $row->a005_id_empresa . '/show" ><span class="fa fa-file-o" aria-hidden="true"></span></a> ';
                    }
                }

                if ($delete) {
                    if(($row->a004_dono_cadastro??0) == 1) {
                        $acoes .= '<form method="POST" action="/empresa/' . $row->a005_id_empresa . '" style="display:inline">
                        <input name="_method" value="DELETE" type="hidden">
                        ' . csrf_field() . '
                        <button type="button" class="btn btn-xs btn-danger" title="Excluir" onclick="ConfirmaExcluir(\'Confirma Excluir o Registro?\',this)">
                           <span class="fa fa-trash"></span>
                        </button>
                    </form>';
                    }
                }
                return $acoes;
            })
            ->editColumn('a005_tipo_cliente', function ($row) use ($comboTipo_cliente) {
                return $comboTipo_cliente[$row["a005_tipo_cliente"]]??'';
            })
            ->filterColumn('a005_tipo_cliente', function ($query, $keyword) {
                $sql = 'case a005_tipo_cliente when  "F" then "Físico" when "J" then "Jurídico" else "" end ';
                $query->whereRaw($sql . ' like ?', ["%{$keyword}%"]);
            })

            ->editColumn('tipo_empresa', function ($row) {
                $ret = "";
                if($row->a005_ind_empresa){
                    $ret .= "";
                }
                if($row->a005_ind_cliente){
                    if(strlen($ret)>0 )
                        $ret .= " - ";
                    $ret .= "Cliente";
                }
                if($row->a005_ind_fornecedor){
                    if(strlen($ret)>0 )
                        $ret .= " - ";
                    $ret .= "Fornecedor";
                }
                return $ret;
            })
            ->filterColumn('tipo_empresa', function ($query, $keyword) {
                $sql = "concat(case a005_ind_empresa when 1 then '' else '' end,case a005_ind_cliente when 1 then ' Cliente' else '' end,case a005_ind_fornecedor when 1 then ' Fornecedor' else '' end,'' )";
                $query->whereRaw($sql . ' like ?', ["%{$keyword}%"]);
            })

            ->orderColumn('tipo_empresa', function ($query, $keyword) {
                $query->orderByRaw("concat(case a005_ind_empresa when 1 then '' else '' end,case a005_ind_cliente when 1 then ' Cliente' else '' end,case a005_ind_fornecedor when 1 then ' Fornecedor' else '' end,'' ) " .$keyword);
            })


            ->editColumn('a005_tipo_empresa', function ($row) use ($comboTipo_empresa) {
                return $comboTipo_empresa[$row["a005_tipo_empresa"]];
            })
            ->filterColumn('a005_tipo_empresa', function ($query, $keyword) {
                $sql = 'case a005_tipo_empresa when  "M" then "Matriz" when "F" then "Filial" else "" end ';
                $query->whereRaw($sql . ' like ?', ["%{$keyword}%"]);
            })
            ->addColumn('a005_cpf_cnpj_id', function ($row) {


                if (($row->a005_cpf ?? "") != "") {
                    $row->a005_cpf = $this->mask($row->a005_cpf, '###.###.###-##');
                } else {
                    $row->a005_cpf = "";
                }
                if (($row->a005_cnpj ?? "") != "") {
                    $row->a005_cnpj = $this->mask($row->a005_cnpj, '##.###.###/####-##');
                } else {
                    $row->a005_cnpj = "";
                }
                return ($row->a005_cpf ?? "") . ($row->a005_cnpj ?? "") . ($row->a005_cod_identificacao ?? "");
            })


            ->orderColumn('a005_cpf_cnpj_id', function ($query, $keyword) {
                $query->orderByRaw("concat(ifnull(a005_cpf,''),ifnull(a005_cnpj,''),ifnull(a005_cod_identificacao,'')) ".$keyword);
            })
            ->filterColumn('a005_cpf_cnpj_id', function ($query, $keyword) {
                $sql = ' concat(ifnull(a005_cpf,\'\'),ifnull(a005_cnpj,\'\'),ifnull(a005_cod_identificacao,\'\')) ';
                $query->whereRaw($sql . ' like ?', ["%{$keyword}%"]);
            })

            ->editColumn('a005_fone', function ($row) {
                if(($row->a005_ind_estrangeiro??0)==1)
                {
                    return $row->a005_fone;
                }
                else {
                    if (isset($row->a005_fone)) {
                        if (strlen($row->a005_fone) == 10) {
                            return $this->mask($row->a005_fone, '(##) ####-####');
                        } else {
                            return $this->mask($row->a005_fone, '(##) # ####-####');
                        }
                    } else {
                        return "";
                    }
                }

            })
            ->filterColumn('a005_fone', function ($query, $keyword) {

            })
            ->editColumn('a005_status', function ($status) {

                if (isset($status->a005_status)) {
                    if ($status->a005_status == '1') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;

                    } else {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }
                }
            })
            ->filterColumn('a005_status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Ativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a005_status', '1');
                    }
                    if (strpos(strtoupper('Inativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a005_status', '0');
                    }
                });
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function index(Request $request, $tipo=null)
    {


        //$parametrosView['mensagem'] = 'teste de envioa de email';
        //$this->enviaEmailPadraoView('sistema.email.aviso',$parametrosView,'fabriciok','feibris@gmail.com','fabricioESFERA','fabricio@esfera.com.br', 'assunto teste');

        return view('sistema.empresa.index',compact('tipo'));
    }

    public function create($tipo=null)
    {
        $comboCidade = $this->optionCidade(0);
        $comboEstado = $this->optionEstado();
        $comboTipo_cliente = $this->optionTipo_cliente();
        $comboTipo_empresa = $this->optionTipo_empresa();
        $comboEmpresaPai = $this->optionEmpresaPai(0);
        $optionTipo_contato = $this->optionTipo_contato();


        return view('sistema.empresa.create', compact('comboCidade', 'comboTipo_cliente', 'comboTipo_empresa', 'comboEmpresaPai', 'comboEstado', 'optionTipo_contato','tipo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'a005_endereco' => 'required',
            'a005_numero_end' => 'required',
        ]);
        
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a005_tipo_empresa'] = $requestData['a005_tipo_empresa'] ?? 'M';
        $requestData['a005_tipo_cliente'] = $requestData['a005_tipo_cliente'] ?? 'J';
        $requestData['a005_ind_empresa'] = $requestData['a005_ind_empresa'] ?? 0;

        //$requestData['a005_ind_empresa'] = 1;
        $requestData['a005_ind_cliente'] = $requestData['a005_ind_cliente'] ?? 0;
        $requestData['a005_ind_estrangeiro'] = $requestData['a005_ind_estrangeiro'] ?? 0;
        $requestData['a005_ind_fornecedor'] = $requestData['a005_ind_fornecedor'] ?? 0;
        $requestData['a004_dono_cadastro'] = $requestData['a004_dono_cadastro'] ?? 1;
        $requestData['a005_status'] = $requestData['a005_status'] ?? 1;
        $requestData['a005_cpf'] = $this->retiraCaracter($requestData['a005_cpf']);
        $requestData['a005_cep'] = $this->retiraCaracter($requestData['a005_cep']??0);
        $requestData['a005_cnpj'] = $this->retiraCaracter($requestData['a005_cnpj']);
        $requestData['a005_fone'] = $this->retiraCaracter($requestData['a005_fone']);
        $requestData["a005_id_empresa"] = $requestData["a005_id_empresa"]??0;


        DB::beginTransaction();
        try {

            //upload de arquivos da aba comercial
            if($request->hasFile('a005_logo')) {

                $arquivo = $request->file('a005_logo');
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/empresa', $fileName, 'public');
                $requestData['a005_logo'] = '/uploads/empresa/' . $fileName;
            }


            if($requestData["a005_id_empresa"]==0)
            {
                ///nao mudei o $requestData["a005_id_empresa"] pois tem oustras validaçoes com essa informação, por isso do updade abaixo
                $empresa = Empresa::create($requestData);

                $update["a005_ind_empresa"] = 1;
                $empresa->update($update);
            }
            else{

                $empresa = Empresa::findOrFail($requestData["a005_id_empresa"]);

                //se nao é cliente entao qpega do request pra ver se setou pra 1
                if($empresa["a005_ind_cliente"] == 0)
                    $update["a005_ind_cliente"] = $requestData['a005_ind_cliente'] ?? 0;

                if($empresa["a005_ind_fornecedor"] == 0)
                    $update["a005_ind_fornecedor"] = $requestData['a005_ind_fornecedor'] ?? 0;

                //if($empresa["a005_ind_estrangeiro"] == 1)
                //    $update["a005_ind_estrangeiro"] = $requestData['a005_ind_estrangeiro'] ?? 0;

                $update["a005_ind_empresa"] = 1;
                $empresa->update($update);
            }



            $dono_cadastro = $requestData['a004_dono_cadastro'];
            $usuario = null;
            if($requestData['a005_ind_empresa']==1)
            {
                $dono_cadastro = 1;
            }
            else{
                $dono_cadastro = 0;

                $usuarioEncontrado = Usuario::query()->where('a001_email',$requestData['a005_email'])->first();
                
                if (!$usuarioEncontrado) {

                    //precisa criar um usuario dono desse cadastro e relacionar
                    $usuario = new Usuario();
                    $usuario->a001_nome = $requestData['a005_nome_completo'] ?? ($requestData["a005_nome_fantasia"] ?? $requestData["a005_email"]);
                    $usuario->a001_email = $requestData['a005_email'];
                    $usuario->a001_cep = $requestData['a005_cep'];
                    $usuario->a001_telefone = $requestData['a005_fone'];
                    $usuario->a001_endereco = $requestData['a005_endereco'];
                    $usuario->a001_numero_end = $requestData['a005_numero_end'];
                    $usuario->a047_id_cidade = $requestData['a047_id_cidade'];
                    $usuario->a001_complemento = $requestData['a005_complemento_end'];
                    $usuario->a001_bairro = $requestData['a005_bairro'];
                    $usuario->a001_cpf = $requestData['a005_cpf'] ?? null;
                    $usuario->a001_status = 1;
                    $usuario->save();

                    
                    $user = new User();
                    $user->name = $requestData['a005_nome_completo'] ?? ($requestData["a005_nome_fantasia"] ?? $requestData["a005_email"]);
                    $user->email = $requestData['a005_email'];
                    $user->password = Str::random(20);
                    $user->foto = $requestData['a005_logo'] ?? "";
                    $user->ativo = 1;
                    $user->a001_id_usuario = $usuario->a001_id_usuario;
                    $user->cadastro_completo = 0;
                    $user->api_token = Str::random(20);
                    $user->remember_token = Str::random(10);
                    $user->username = $requestData['a005_email'];
                    $user->primeiro_acesso = 1;
                    $user->ind_super_adm = 0;
                    $user->ind_adm = 1;
                    $user->creditos = 0;
                    $user->save();



                    // ===== após criar o novo cliente acima, este novo cliente terá como fornecedor a empresa do usuário atual logado =====
                    $cliente = Empresa::find(Auth::user()->id_empresa_principal);
                    $newCliente = $cliente->replicate();
                    
                    if ($requestData['a005_ind_cliente']) {
                        $newCliente->a005_ind_fornecedor = 1;
                        $newCliente->a005_ind_cliente = 0;
                    }
                    // ===== após criar o novo fornecedor, este novo fornecedor terá como cliente a empresa do usuário atual logado =====
                    if ($requestData['a005_ind_fornecedor']) {
                        $newCliente->a005_ind_fornecedor = 0;
                        $newCliente->a005_ind_cliente = 1;
                    }
                    $newCliente->save();
                    Empresa_usuario::query()->Create([
                        'a001_id_usuario' => $usuario->a001_id_usuario,
                        'a005_id_empresa' => $newCliente->a005_id_empresa,
                        'a004_dono_cadastro' => '0',
                        'created_at_user' => $user->id
                    ]);
                    // ========= fim ===========


                    //relaciona a empresa com o usuario criado
                    $empresaUsuario = Empresa_usuario::query()->Create([
                        'a001_id_usuario' => $usuario->a001_id_usuario,
                        'a005_id_empresa' => $empresa->a005_id_empresa,
                        'a004_dono_cadastro' => '1',
                        'created_at_user' => $user->id
                    ]);

                    //relaciona o perfil
                    $this->relacionaPerfil($empresa->a005_id_empresa, $usuario->a001_id_usuario, $user->id);

                    // $token = Password::createToken($user);
                    // ///envia o email para cadastrar senha
                    // $user->sendPasswordResetNotification($token);
                }
                else {
                    $usuario = $usuarioEncontrado;
                }
            }

            //relaciona a empresa com o usuario logado
            Empresa_usuario::query()->Create([
                'a001_id_usuario' => Auth::user()->a001_id_usuario,
                'a005_id_empresa' => $empresa->a005_id_empresa,
                'a004_dono_cadastro' => $dono_cadastro,
                'created_at_user'  => Auth::user()->id
            ]);

            // grava os contatos da empresa
            $this->gravaContato($empresa->a005_id_empresa, $requestData);

            //grava os socios da empresa quando perfil de adm
            $this->gravaSocio($empresa->a005_id_empresa, $requestData);


            $this->relacionaPerfil($empresa->a005_id_empresa, Auth::user()->a001_id_usuario, Auth::user()->id);

            $nome = $requestData['a005_nome_completo'] ?? ($requestData["a005_nome_fantasia"] ?? $requestData["a005_email"]);
            Session::flash('flash_message', "$nome adicionado com sucesso.");

            DB::commit();

            
            $host_name = Auth::user()->name;
            $client = new GuzzleHttp\Client(['base_uri' => env('URL_SITE')]);
            $response = $client->request('GET', "/company-invite/{$nome}/{$requestData['a005_email']}/{$host_name}");
            $content = json_decode($response->getBody()->getContents());

            if ($request->expectsJson()) {
                return ['success' => 'true', 'content' => $empresa];
            }

            $url = 'empresa';
            if(($requestData['tipo_empresa']??'')!='') {
                $url = '/emp_' . ($requestData['tipo_empresa'] ?? '');
            }
            
            return redirect($url);

        } catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage());
            
            if ($request->expectsJson()) {
                return ['success' => 'false', 'error' => $e->getMessage()];
            }

            Session::flash('flash_message', 'Não foi possível criar o usuário!');

            $url = 'empresa';
            if(($requestData['tipo_empresa']??'')!='') {
                $url = '/emp_' . ($requestData['tipo_empresa'] ?? '');
            }
            return redirect($url);
        }
    }

    public function show($id,$tipo=null)
    {
        $empresa = Empresa::query()
            ->join('t004_empresa_usuario','t004_empresa_usuario.a005_id_empresa','=','t005_empresa.a005_id_empresa')
            ->where('t005_empresa.a005_id_empresa',$id)
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0)
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
            })
            ->orderby('a004_dono_cadastro', 'desc')
            ->first()
        ;


        $this->validaAcessoEdit(0, 'show',$empresa->a005_id_empresa);

        $idEstado = Cidade::query()->where('a047_id_cidade', $empresa->a047_id_cidade)->first()->a048_id_estado ?? 0;

        $empresa->a048_id_estado = $idEstado;
        $empresa->a005_foneSemMask = $empresa->a005_fone;

        $comboCidade = $this->optionCidade($idEstado);
        $comboEstado = $this->optionEstado();
        $comboTipo_cliente = $this->optionTipo_cliente();
        $comboTipo_empresa = $this->optionTipo_empresa();
        $optionTipo_contato = $this->optionTipo_contato();
        $comboEmpresaPai = $this->optionEmpresaPai($id);

        $ids_empresa_logado = Empresa_usuario::query()
            ->where('a001_id_usuario', Auth::user()->a001_id_usuario)
            ->where('a004_dono_cadastro',1)
            ->select('a005_id_empresa')->get()->toArray();

        $EmpresaContatos = Empresa_contato::query()
            ->leftjoin('t005_empresa','t005_empresa.a005_id_empresa','=','t006_empresa_contato.a005_id_empresa_criou')
            ->where('t006_empresa_contato.a005_id_empresa', $id)
            //->wherein('a005_id_empresa_criou', $ids_empresa_logado)
            ->get();



        $EmpresaSocios = Empresa_socio::query()->where('a005_id_empresa', $id)->get();


        $EmpresaContatos->map(function($row) use ($ids_empresa_logado,$id){

            $row->a006_foneSemMask = $row->a006_fone;
            $nomeEmpresa = $row->a005_nome_completo??($row->a005_razao_social??'');
            $row->EmpresaCadastrou = $nomeEmpresa;
            $row->a005_id_empresa_criou = $row->a005_id_empresa_criou??$id;

            $row->podeEditar = 0;
            $contem = collect($ids_empresa_logado)->pluck('a005_id_empresa')->contains($row->a005_id_empresa_criou);
            if($contem)
            {
                $row->podeEditar = 1;
            }



            if (strlen($row->a005_fone) == 10) {
                $row->a006_fone = $this->mask($row->a006_fone, '(##) ####-####');
            } else {
                $row->a006_fone = $this->mask($row->a006_fone, '(##) # ####-####');
            }
        });


        return view('sistema.empresa.edit', compact('empresa', 'comboCidade', 'comboTipo_cliente', 'comboTipo_empresa', 'comboEmpresaPai', 'comboEstado', 'EmpresaContatos', 'EmpresaSocios', 'optionTipo_contato','tipo'));
    }

    public function edit($id, $tipo='empresa', $notificarContatos = 0)
    {
        $this->validaAcessoEdit($id, 'empresa');


        $empresa = Empresa::query()
            ->join('t004_empresa_usuario','t004_empresa_usuario.a005_id_empresa','=','t005_empresa.a005_id_empresa')
            ->where('t005_empresa.a005_id_empresa',$id)
            //->where('t004_empresa_usuario.a001_id_usuario',Auth::user()->a001_id_usuario)
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0)
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
            })
            ->orderby('a004_dono_cadastro', 'desc')
            ->first()
        ;



        $idEstado = Cidade::query()->where('a047_id_cidade', $empresa->a047_id_cidade)->first()->a048_id_estado ?? 0;

        $empresa->a048_id_estado = $idEstado;
        $empresa->a005_foneSemMask = $empresa->a005_fone;

        $comboCidade = $this->optionCidade($idEstado);
        $comboEstado = $this->optionEstado();
        $comboTipo_cliente = $this->optionTipo_cliente();
        $comboTipo_empresa = $this->optionTipo_empresa();
        $optionTipo_contato = $this->optionTipo_contato();
        $comboEmpresaPai = $this->optionEmpresaPai($id);

        $EmpresaContatos = Empresa_contato::query()
            ->leftjoin('t005_empresa','t005_empresa.a005_id_empresa','=','t006_empresa_contato.a005_id_empresa_criou')
            ->where('t006_empresa_contato.a005_id_empresa', $id)
            ->get();

        $EmpresaSocios = Empresa_socio::query()->where('a005_id_empresa', $id)->get();


        $EmpresaContatos->map(function($row){

            $row->a006_foneSemMask = $row->a006_fone;

            $nomeEmpresa = $row->a005_nome_completo??($row->a005_razao_social??'');
            $row->EmpresaCadastrou = $nomeEmpresa;

            $row->podeEditar = 1;

            if (strlen($row->a005_fone) == 10) {
                $row->a006_fone = $this->mask($row->a006_fone, '(##) ####-####');
            } else {
                $row->a006_fone = $this->mask($row->a006_fone, '(##) # ####-####');
            }
        });


        $documentos = $empresa->Empresa_documentos_hasMany()->get();

        return view('sistema.empresa.edit', compact('notificarContatos', 'documentos','empresa', 'comboCidade', 'comboTipo_cliente', 'comboTipo_empresa', 'comboEmpresaPai', 'comboEstado', 'EmpresaContatos', 'EmpresaSocios', 'optionTipo_contato','tipo'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'a005_endereco' => 'required',
            'a005_numero_end' => 'required'
        ]);

        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a005_tipo_empresa'] = $requestData['a005_tipo_empresa'] ?? 'M';
        $requestData['a005_tipo_cliente'] = $requestData['a005_tipo_cliente'] ?? 'E';
        $requestData['a005_ind_empresa'] = $requestData['a005_ind_empresa'] ?? 0;
        $requestData['a004_dono_cadastro'] = $requestData['a004_dono_cadastro'] ?? 0;
        $requestData['a005_ind_cliente'] = $requestData['a005_ind_cliente'] ?? 0;
        $requestData['a005_ind_estrangeiro'] = $requestData['a005_ind_estrangeiro'] ?? 0;
        $requestData['a005_ind_fornecedor'] = $requestData['a005_ind_fornecedor'] ?? 0;
        $requestData['a005_status'] = $requestData['a005_status'] ?? 0;
        $requestData['a005_cpf'] = $this->retiraCaracter($requestData['a005_cpf']);
        $requestData['a005_cep'] = $this->retiraCaracter($requestData['a005_cep']??0);
        $requestData['a005_cnpj'] = $this->retiraCaracter($requestData['a005_cnpj']);
        $requestData['a005_fone'] = $this->retiraCaracter($requestData['a005_fone']);



        DB::beginTransaction();
        try {


            $empresa = Empresa::findOrFail($id);


            if(($requestData['a004_dono_cadastro']??0) != 1)
            {

                $empresa->a005_ind_empresa = 1;
                $empresa->a005_ind_cliente = $empresa->a005_ind_cliente == 1 ? $empresa->a005_ind_cliente : $requestData['a005_ind_cliente'];
                $empresa->a005_ind_fornecedor = $empresa->a005_ind_fornecedor == 1 ? $empresa->a005_ind_fornecedor : $requestData['a005_ind_fornecedor'];
                $empresa->save();

                $this->gravaContato($id, $requestData);

                DB::commit();
                if(($requestData['tipo_empresa'] ?? '')=="empresa")
                {
                    Session::flash('flash_message', ucfirst($requestData['tipo_empresa'] ?? '').' atualizada!');
                }
                else{
                    Session::flash('flash_message', ucfirst($requestData['tipo_empresa'] ?? '').' atualizado!');
                }

                $url = 'empresa';
                if(($requestData['tipo_empresa']??'')!='') {
                    $url = '/emp_' . ($requestData['tipo_empresa'] ?? '');
                }
                if ($request->notificar_contatos) {
                    $url .= "/$id/edit/empresa/1";
                }
                return redirect($url);
            }


            //upload de arquivos da aba comercial
            if($request->hasFile('a005_logo')) {

                Storage::disk('public')->delete($empresa->a005_logo??"");

                $arquivo = $request->file('a005_logo');
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/empresa', $fileName, 'public');
                $requestData['a005_logo'] = '/uploads/empresa/' . $fileName;
            }

            $user = User::where('id' , Auth::user()->id)->first();
            $user->cadastro_completo = 1;
            $user->save();

            $this->gravaDocumentos($id, $request);

            $empresa->update($requestData);

            $this->gravaContato($id, $requestData);

            $this->gravaSocio($id, $requestData);

            $this->relacionaPerfil($id, Auth::user()->a001_id_usuario, Auth::user()->id);

            if(($requestData['tipo_empresa'] ?? '')=="empresa")
            {
                Session::flash('flash_message', ucfirst($requestData['tipo_empresa'] ?? '').' atualizada!');
            }
            else{
                Session::flash('flash_message', ucfirst($requestData['tipo_empresa'] ?? '').' atualizado!');
            }

            DB::commit();

            $url = 'empresa';
            if(($requestData['tipo_empresa']??'')!='') {
                $url = '/emp_' . ($requestData['tipo_empresa'] ?? '');
            }
            if ($request->notificar_contatos) {
                $url .= "/$id/edit/empresa/1";
            }
            return redirect($url);

        } catch (\Exception $e) {

            DB::rollBack();
            if(($requestData['tipo_empresa'] ?? '')=="empresa")
            {
                Session::flash('flash_message', 'Não foi possível atualizar a '.ucfirst($requestData['tipo_empresa'] ?? '').'!');
            }
            else{
                Session::flash('flash_message', 'Não foi possível atualizar o '.ucfirst($requestData['tipo_empresa'] ?? '').'!');
            }

            $url = 'empresa';
            if(($requestData['tipo_empresa']??'')!='') {
                $url = '/emp_' . ($requestData['tipo_empresa'] ?? '');
            }
            return redirect($url);
        }
    }

    public function gravaDocumentos($a005_id_empresa, $request)
    {
        $docs_anteriores = Empresa_documento::where('a005_id_empresa', $a005_id_empresa);

        // exclusão
        if ($request->a014_id_outros_doc_delete) {
            $delete_ids = explode(',', $request->a014_id_outros_doc_delete);
            
            $delete_docs = $docs_anteriores->whereIn('a025_id_documento', $delete_ids)->get();
            
            foreach ($delete_docs as $key => $doc) {
                Storage::disk('public')->delete($doc->a025_id_documento??"");
                $doc->delete();
            }
        }

        // atualização
        if ($request->a014_outro_doc_obs) {
            $update_docs = $docs_anteriores->whereIn('a025_id_documento', array_keys($request->a014_outro_doc_obs))->get();
            foreach ($update_docs as $key => $value) {
                $observacao = $request->a014_outro_doc_obs[$value->a025_id_documento];

                if ($observacao) { 
                    $value->a025_obs = $observacao;
                    $value->save();
                }
            }
        }


        // gravação
        if ($request->hasFile('a014_outro_doc'))
        {
            foreach ($request->a014_outro_doc as $key => $file) {
                //readicionando o arquivo
                $fileName = str_random(12) . '_'.$file->getFileName() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/empresa/documentos', $fileName, 'public');
                $caminhoUpload = '/uploads/empresa/documentos/' . $fileName;

                $contrato_doc_new = new Empresa_documento();
                $contrato_doc_new->a005_id_empresa = $a005_id_empresa;
                $contrato_doc_new->a025_documento = $caminhoUpload;
                $contrato_doc_new->a025_obs = $request->a014_outro_doc_obs[$key] ?? null;
                $contrato_doc_new->save();
            }
        }
    }

    public function destroy($id,$tipo=null)
    {
        DB::beginTransaction();
        try {
            $empresa = Empresa::findOrFail($id);
            $empresa->delete();

            Session::flash('flash_message', "$empresa->a005_nome_completo foi desativado.");

            DB::commit();
            $url = 'empresa';
            if(($tipo??'')!='') {
                $url = '/emp_' . ($requestData['tipo_empresa'] ?? '');
            }
            return redirect($url);

        } catch (\Exception $e) {

            DB::rollBack();
            dd($e->getMessage());

            Session::flash('flash_message', "Não foi possível excluir $empresa->a005_nome_completo");

            $url = 'empresa';
            if(($tipo??'')!='') {
                $url = '/emp_' . ($requestData['tipo_empresa'] ?? '');
            }
            return redirect($url);
        }
    }

    public function optionCidade($idEstado)
    {
        $ret = Cidade::query()
            ->where('a048_id_estado', '=', $idEstado ?? 0)
            ->orderby('a047_nome_cidade')
            ->pluck('a047_nome_cidade', 'a047_id_cidade')
            ->prepend('', '');
        return $ret;
    }

    public function optionEstado()
    {
        $ret = Estado::query()
            ->orderby('a048_nome_estado')
            ->pluck('a048_nome_estado', 'a048_id_estado')
            ->prepend('', '');
        return $ret;
    }

    public function optionTipo_cliente()
    {
        $ret = ['' => "", 'F' => "Físico", 'J' => "Jurídico"];
        return $ret;
    }

    public function optionTipo_contato()
    {
        $ret = ['' => '', 'F' => 'Financeiro', 'T' => 'Técnico', 'R' => 'Relacionamento'];
        return $ret;
    }

    public function optionTipo_empresa()
    {
        $ret = ['M' => "Matriz", 'F' => "Filial"];
        return $ret;
    }

    private function optionEmpresaPai($id)
    {
        $ret = Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where(function($w){
                if (Auth::user()->ind_super_adm<=0) {
                    $w->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                }
            })
            ->where('t005_empresa.a005_id_empresa', '!=', $id)
            ->where('t005_empresa.a005_tipo_cliente',  'J')
            ->pluck('t005_empresa.a005_nome_fantasia', 't005_empresa.a005_id_empresa')->prepend('', '');
        return $ret;
    }



    public function gravaContato($a005_id_empresa, $requestData)
    {
        $id_empresa_logada = Empresa_usuario::query()->where('a001_id_usuario', Auth::user()->a001_id_usuario)->first()->a005_id_empresa??0;


        Empresa_contato::query()
            ->where('a005_id_empresa', '=', $a005_id_empresa)
            //->where('a005_id_empresa_criou', '=', $id_empresa_logada)
            ->delete();



        for ($x = 0; $x < count($requestData['a006_nome'] ?? []); $x++) {

            $id_empresa_criou = $requestData["a005_id_empresa_criou"][$x]??$id_empresa_logada;

            $EmpresaContato = new Empresa_contato();
            $EmpresaContato->a005_id_empresa = $a005_id_empresa;
            $EmpresaContato->a005_id_empresa_criou = $id_empresa_criou;
            $EmpresaContato->a006_tipo_contato = $requestData["a006_tipo_contato"][$x];
            $EmpresaContato->a006_nome = $requestData["a006_nome"][$x];
            $EmpresaContato->a006_fone = $this->retiraCaracter($requestData["a006_fone"][$x]);
            $EmpresaContato->a006_email = $requestData["a006_email"][$x];
            $EmpresaContato->a006_status = $requestData["a006_status"][$x];
            $EmpresaContato->save();
        }
    }

    public function gravaSocio($a005_id_empresa, $requestData)
    {
        Empresa_socio::query()->where('a005_id_empresa', '=', $a005_id_empresa)->delete();
        for ($x = 0; $x < count($requestData['a007_nome'] ?? []); $x++) {
            $EmpresaSocio = new Empresa_socio();
            $EmpresaSocio->a005_id_empresa = $a005_id_empresa;
            $EmpresaSocio->a007_nome = $requestData["a007_nome"][$x];
            $EmpresaSocio->a007_percent_participacao = $requestData["a007_percent_participacao"][$x];
            $EmpresaSocio->save();
        }
    }

    /// valida o perfil da empresa se estiver com os check marcados
    public function relacionaPerfil($a005_id_empresa, $a001_id_usuario, $id)
    {

        $idUsuario = $a001_id_usuario??Auth::user()->a001_id_usuario;
        $idUser = $id??Auth::user()->id;

        //busca todas as empresas do usuario
        $userEmpresa = Empresa_usuario::query()->where('a001_id_usuario', $idUsuario)->select('a005_id_empresa')->get()->toArray();

        //todas as empresas do usuario
        $empresa = Empresa::query()->wherein('a005_id_empresa', $userEmpresa)->get();

        //busca os perfis adm, cliente, fornecedor
        $perfil = Role::query()->orWhere('ind_adm', 1)->orWhere('ind_cliente', 1)->orWhere('ind_fornecedor', 1)->get();

        ///pega os inds marcados na tela, em vez de pegar do request, peguei da empresa que ja foi salva antes de entrar nessa funcao
        $ind_empresa = $empresa->Sum('a005_ind_empresa');
        $ind_cliente = $empresa->Sum('a005_ind_cliente');
        $ind_fornecedor = $empresa->Sum('a005_ind_fornecedor');

        //aqui pega as PK de cada perfil pra poder gravar;
        $perfil_adm = $perfil->where('ind_adm', 1)->values()[0];
        $perfil_cli = $perfil->where('ind_cliente', 1)->values()[0];
        $perfil_for = $perfil->where('ind_fornecedor', 1)->values()[0];



        ///relaciona como empresa do sistema caso steja marcado ind_empresa
        if ($ind_empresa > 0) {
            $role_user = UsuarioRoles::query()->updateOrCreate(['user_id' => $idUser, 'role_id' => $perfil_adm->id]);
        } else {
            $role_user = UsuarioRoles::query()->where('user_id', $idUser)->where('role_id', $perfil_adm->id)->delete();
        }

        ///relaciona como perfil de cliente caso esteja o ind_cliente marcado
        if ($ind_cliente > 0) {
            $role_user = UsuarioRoles::query()->updateOrCreate(['user_id' => $idUser, 'role_id' => $perfil_cli->id]);
        } else {
            $role_user = UsuarioRoles::query()->where('user_id', $idUser)->where('role_id', $perfil_cli->id)->delete();
        }

        ///relaciona como perfil de fornecedor caso esteja o ind_fornecedor marcado
        if ($ind_fornecedor > 0) {
            $role_user = UsuarioRoles::query()->updateOrCreate(['user_id' => $idUser, 'role_id' => $perfil_for->id]);
        } else {
            $role_user = UsuarioRoles::query()->where('user_id', $idUser)->where('role_id', $perfil_for->id)->delete();
        }

    }

    public function buscaExistente(Request $request, $todos = false, $cli_for = 1)
    {
        $valordigitado = $todos ? $request->valorDigitado : $this->retiraCaracter($request->valorDigitado);

        $empresa = Empresa::query()
            ->leftJoin('t047_cidade','t047_cidade.a047_id_cidade','=','t005_empresa.a047_id_cidade');
           
            if(strlen($valordigitado)==11) {
                $empresa->where('a005_cpf', $valordigitado);
            }
            elseif(strlen($valordigitado)==14) {
                $empresa->where('a005_cnpj', $valordigitado);
            }
            else{
                $cli_for == 1 ? $empresa->where('a005_ind_fornecedor',true) :
                    $empresa->where('a005_ind_cliente',true);
                
                $empresa->where(function($where) use ($valordigitado) {
                    $where->where('a005_cod_identificacao', $valordigitado)
                        ->orWhere('a005_nome_completo', 'like', "%$valordigitado%")
                        ->orWhere('a005_razao_social', 'like', "%$valordigitado%")
                        ->orWhere('a005_nome_fantasia', 'like', "%$valordigitado%");
                });
            }
            $empresa->select('a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa'
                ,'a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia'
                ,'a005_ie','a005_im','a005_fone','a005_email','a005_cep','t005_empresa.a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end'
                ,'a005_status','a048_id_estado');

        $empresa = $todos ? $empresa->get() : $empresa->first();

        return $empresa;
    }


}
