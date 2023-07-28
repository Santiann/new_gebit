<?php

namespace App\Http\Controllers;

use App\CamposExclusivos;
use App\Contrato_contato;
use App\Area_contrato;
use App\Categoria_contrato;
use App\Categoria_contrato_doc;
use App\Contrato_documento;
use App\Contrato_hist_alteracoes;
use App\Contrato_hist_renovacao;
use App\ContratoAnotacao;
use App\ContratoPendencia;
use App\ContratoFinanceiro;
use App\Contrato_tipo_vencimento;
use App\Empresa;
use App\Empresa_usuario;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Controllers\EmpresaController;
use App\Http\Requests;
use App\Parametro;
use App\Tipo_contrato;
use App\Tipo_vencimento;
use App\Usuario;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

use App\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class ContratoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:contrato-show|contrato-create|contrato-edit|contrato-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('contrato-edit');
        $show = Entrust::can('contrato-show');
        $delete = Entrust::can('contrato-delete');

        $Classificacao = $this->optionClassificacao();

        //busca todas as empresas do usuario
        $userEmpresa = Empresa_usuario::query()->where('a001_id_usuario', Auth::user()->a001_id_usuario)->select('a005_id_empresa')->get()->pluck('a005_id_empresa')->toArray();



        return Datatables::of(
            Contrato::query()
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't013_contrato.a005_id_empresa')
                ->join('t004_empresa_usuario as empresa_usuario_cli_for', 'empresa_usuario_cli_for.a005_id_empresa', '=', 't013_contrato.a005_id_empresa_cli_for')
                ->leftjoin('t005_empresa', 't013_contrato.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->leftjoin('t005_empresa as t005_empresaCliFor', 't013_contrato.a005_id_empresa_cli_for', '=', 't005_empresaCliFor.a005_id_empresa')
                ->where(function($where){
                    if(Auth::user()->ind_super_adm<=0) {
                        $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                        $where->orwhere('empresa_usuario_cli_for.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    }
                })
                ->where(function($where){
                    if(Auth::user()->ind_super_adm<=0) {
                        $where->where('t004_empresa_usuario.a004_dono_cadastro', '=',1);
                        $where->where('empresa_usuario_cli_for.a004_dono_cadastro', '=', 1);
                    }
                })
                ->select('a013_id_contrato','t013_contrato.a005_id_empresa','a005_id_empresa_cli_for','a010_id_tipo_contrato','a011_id_area','a013_numero_contrato','a013_classificacao','a013_finalidade','a013_prazo_contrato','a013_data_inicio','a013_data_fim','a013_dias_vencimento','a013_valor_total_contrato','a013_valor_extra','a013_valor_comissao','a013_periodicidade_reajuste','a013_indice_reajuste','a013_prazo_recisao','a013_custo_recisao_antecipada','a013_obs_custo_revisao_antec','a013_conta_contabil','a013_centro_custo','t013_contrato.a001_id_usuario','a013_obs_contrato','a013_assinatura','a013_status')
                ->addSelect(DB::RAW("count(t004_empresa_usuario.a004_id_empresa_usuario) contadorEmpresa"))
                ->addSelect(DB::RAW("count(empresa_usuario_cli_for.a004_id_empresa_usuario) contadorFornecedor"))
                ->addSelect(DB::RAW("concat(ifnull(t005_empresa.a005_nome_fantasia,''),ifnull(t005_empresa.a005_nome_completo,'')) as nomeEmpresa"))
                ->addSelect(DB::RAW("concat(ifnull(t005_empresaCliFor.a005_nome_fantasia,''),ifnull(t005_empresaCliFor.a005_nome_completo,'')) as nomeCliFor"))
                ->groupBy('a013_id_contrato','t013_contrato.a005_id_empresa','a005_id_empresa_cli_for','a010_id_tipo_contrato','a011_id_area','a013_numero_contrato','a013_classificacao','a013_finalidade'
                    ,'a013_prazo_contrato','a013_data_inicio','a013_data_fim','a013_dias_vencimento','a013_valor_total_contrato','a013_valor_extra','a013_valor_comissao','a013_periodicidade_reajuste','a013_indice_reajuste'
                    ,'a013_prazo_recisao','a013_custo_recisao_antecipada','a013_obs_custo_revisao_antec','a013_conta_contabil','a013_centro_custo','t013_contrato.a001_id_usuario','a013_obs_contrato','a013_assinatura','a013_status'
                    ,'t005_empresa.a005_nome_fantasia','t005_empresa.a005_nome_completo','t005_empresaCliFor.a005_nome_fantasia','t005_empresaCliFor.a005_nome_completo')
            )
            ->addColumn('action', function ($row) use ($edit,$show,$delete, $userEmpresa) {
                //$acoes = $row->a005_id_empresa."-".$row->a005_id_empresa_cli_for."=";
                $acoes = "";

                ///contrato cancelado nao pode ser alterado
                if($edit && $row->a013_status != 'C'){
                    /// se é um contrato da empresa e nao do fornecedor
                    // if(in_array($row->a005_id_empresa, $userEmpresa)) { nova regra: se o contrato ainda não foi fechado, ambas as partes podem editar
                        $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Contrato" href="/contrato/' . $row->a013_id_contrato . '/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
                    // }
                    // else {
                    //     $acoes .= '<a class="btn btn-xs btn-primary" title="Visualizar Contrato" href="/contrato/' . $row->a013_id_contrato . '/showFornecedor" ><span class="fa fa-eye" aria-hidden="true"></span></a> ';
                    // }
                }
                if($show && $row->a013_status == 'C'){
                    $acoes .= '<a class="btn btn-xs btn-primary" title="Visualizar Contrato" href="/contrato/'.$row->a013_id_contrato.'/edit" ><span class="fa fa-eye" aria-hidden="true"></span></a> ';
                }
                if ($edit ) {
                    if(in_array($row->a005_id_empresa, $userEmpresa)) {
                        $acoes .= '<a class="botaoDuplicar btn btn-xs btn-primary " title="Duplicar Contrato" href="javascript:void(0)" idcopy="' . $row->a013_id_contrato . '" ><span class="fa fa-copy" title ="Duplicar Contrato" aria-hidden="true"></span></a> ';
                    }
                }
                if($delete && $row->a013_status != 'C'){
                    if(in_array($row->a005_id_empresa, $userEmpresa)) {
                        $acoes .= '<form method="POST" action="/contrato/' . $row->a013_id_contrato . '" style="display:inline">
                            <input name="_method" value="DELETE" type="hidden">
                            ' . csrf_field() . '
                            <button type="button" class="btn btn-xs btn-danger" title="Excluir Contrato" onclick="ConfirmaExcluir(\'Confirma Excluir Contrato?\',this)">
                               <span class="fa fa-trash"></span>
                            </button>
                        </form>';
                    }
                }
                return $acoes;
            })
            ->filterColumn('nomeEmpresa', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    $where->orwhere(DB::RAW("concat(ifnull(t005_empresa.a005_nome_fantasia,''),ifnull(t005_empresa.a005_nome_completo,''))"), 'like', '%'.$keyword.'%');
                });
            })
            ->editColumn('a013_status', function ($row) {

                if (isset($row->a013_status)) {
                    if ($row->a013_status == 'A') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;

                    } elseif ($row->a013_status == 'D') {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }elseif ($row->a013_status == 'C') {
                        $labelStatus = '<span class="label label-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Cancelado </span>';
                        return $labelStatus;
                    }elseif ($row->a013_status == 'V') {
                    $labelStatus = '<span class="label label-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Vencido </span>';
                    return $labelStatus;
                }
                }
            })
            ->filterColumn('a013_status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Ativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a013_status', 'A');
                    }
                    if (strpos(strtoupper('Inativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a013_status', 'D');
                    }
                    if (strpos(strtoupper('Cancelado'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a013_status', 'C');
                    }
                    if (strpos(strtoupper('Vencido'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a013_status', 'V');
                    }
                });
            })
            ->addColumn('classificacao', function ($row) use ($Classificacao) {
                return $Classificacao[$row->a013_classificacao];
            })
            ->orderColumn('classificacao', function ($query, $keyword) {
                //dump($keyword);
                $query->orderByRaw("a013_classificacao ".$keyword);
            })
            ->filterColumn('classificacao', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Produto'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a013_classificacao', 'P');
                    }
                    if (strpos(strtoupper('Serviço'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a013_classificacao', 'S');
                    }
                });
            })
            ->addColumn('dataInicio',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->a013_data_inicio)->format('d/m/Y');
            })
            ->orderColumn('dataInicio', function ($query, $keyword) {
                //dump($keyword);
                $query->orderByRaw("a013_data_inicio ".$keyword);
            })
            ->addColumn('dataFim',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->a013_data_fim)->format('d/m/Y');
            })
            ->orderColumn('dataFim', function ($query, $keyword) {
                //dump($keyword);
                $query->orderByRaw("a013_data_fim ".$keyword);
            })

            ->filterColumn('nomeCliFor', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    $where->orwhere(DB::RAW("concat(ifnull(t005_empresaCliFor.a005_nome_fantasia,''),ifnull(t005_empresaCliFor.a005_nome_completo,''))"), 'like', '%'.$keyword.'%');
                });
            })

        ->escapeColumns(['*'])
        ->make(true);
    }

    public function index(Request $request)
    {
        $comboEmpresa = $this->optionEmpresa();

        //busca todas as empresas do usuario
        $indEmpresaEmpresa = Empresa_usuario::query()
            ->join('t005_empresa','t005_empresa.a005_id_empresa','=','t004_empresa_usuario.a005_id_empresa')
            ->where('t004_empresa_usuario.a001_id_usuario', Auth::user()->a001_id_usuario)
            ->where('a004_dono_cadastro', 1)
            ->where('a005_ind_empresa', 1)
            ->select('t004_empresa_usuario.a005_id_empresa')->get()->count();

        return view('sistema.contrato.index', compact('comboEmpresa','indEmpresaEmpresa'));
    }

    public function create()
    {
        $comboEmpresa = $this->optionEmpresa();
        $idEmpresa = 0;
        if((count($comboEmpresa)??0)==1){
            $comboEmpresa->map(function($row,$key) use(&$idEmpresa){
                $idEmpresa = $key;
            });
        }
        $comboResponsavel = $this->optionResponsavel($idEmpresa);
        $comboUsuario = $this->optionTodosUsuario();
		$comboEmpresaClieFor = $this->optionEmpresaCliFor($idEmpresa);
		$comboCategoria_contrato = $this->optionCategoria_contrato();
        $comboTipo_contrato = $this->optionTipo_contrato([0]);
		$comboTipo_vencimento = $this->optionTipo_vencimento($idEmpresa);
		$comboArea_contrato = $this->optionArea_contrato([0]);
        $comboClassificacao = $this->optionClassificacao();
        $comboTipo_cliente = app(EmpresaController::class)->optionTipo_cliente();
        $comboTipo_empresa = app(EmpresaController::class)->optionTipo_empresa();
        $comboCidade = app(EmpresaController::class)->optionCidade(0);
        $comboEstado = app(EmpresaController::class)->optionEstado();

        return view('sistema.contrato.create', compact('comboCidade','comboEstado','comboTipo_empresa','comboTipo_cliente', 'comboResponsavel','comboEmpresa','comboCategoria_contrato','comboTipo_contrato','comboArea_contrato','comboClassificacao','comboEmpresaClieFor','comboTipo_vencimento','comboUsuario'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'a005_id_empresa_select' => 'required',
			'a005_id_empresa_cli_for' => 'required',
			// 'a008_id_cat_contrato' => 'required',
			// 'a010_id_tipo_contrato' => 'required',
			// 'a011_id_area' => 'required',
			'a013_numero_contrato' => 'required',
			// 'a013_classificacao' => 'required',
			'a013_finalidade' => 'required|max:1024',
			'a013_prazo_contrato' => 'required',
			'a013_data_inicio' => 'required',
            'a013_data_fim' => 'required',
            'a013_obs_contrato' => 'max:500',
		]);
               
        $requestData = $request->except('a008_id_cat_contrato');
        $requestData['a005_id_empresa'] = $requestData['a005_id_empresa_select'];
        $requestData['a013_empresa_contratante'] = $requestData['a013_empresa_contratante'] == 1 ? $requestData['a005_id_empresa'] : $requestData['a005_id_empresa_cli_for'];
        
        if (!$this->validaCreditos($requestData['a005_id_empresa'], $requestData['a005_id_empresa_cli_for']))
        {
            Session::flash('flash_message', 'Quantidade de contratos gratuitos atingida. É necessário efeturar uma assinatura.');;
            return redirect('contrato');
        }
        
        $requestData['a013_data_renovacao'] = null;
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;

        $requestData['a013_status'] = $requestData['a013_status']??'C';
        $requestData['a013_data_inicio'] = Carbon::createFromFormat('d/m/Y',$requestData['a013_data_inicio'])->format('Y-m-d');
        $requestData['a013_data_fim'] = Carbon::createFromFormat('d/m/Y',$requestData['a013_data_fim'])->format('Y-m-d');

        $requestData['a013_valor_total_contrato'] = $requestData['a013_valor_total_contrato'] ? $this->converteDecimalDB($requestData['a013_valor_total_contrato']) : '0.00';
        $requestData['a013_valor_fracao'] = $requestData['a013_valor_fracao'] ? $this->converteDecimalDB($requestData['a013_valor_fracao']) : '0.00';
        $requestData['a013_valor_extra'] = $requestData['a013_valor_extra'] ? $this->converteDecimalDB($requestData['a013_valor_extra']) : '0.00';
        // $requestData['a013_valor_comissao'] = $requestData['a013_valor_comissao'] ? $this->converteDecimalDB($requestData['a013_valor_comissao']) : '0.00';

        // $requestData['a013_custo_recisao_antecipada'] = $requestData['a013_custo_recisao_antecipada'] ? $this->converteDecimalDB($requestData['a013_custo_recisao_antecipada']) : '0.00';


        DB::beginTransaction();
        try {

            //upload de arquivos da aba comercial
            if($request->hasFile('a013_assinatura')) {

                $arquivo = $request->file('a013_assinatura');
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/contrato', $fileName, 'public');
                $requestData['a013_assinatura'] = '/uploads/contrato/' . $fileName;
            }

            $contrato = Contrato::create($requestData);

            // salvar categorias para cada usuario
            $id_empresas = $this->getEmpresasUsuarioContrato($contrato);
            
            foreach ($request->a008_id_cat_contrato as $key => $value) {
                $categorias[$value] = ['a005_id_empresa'=> $id_empresas[0]];
            }
            $contrato->Categoria_contrato_belongsTo()->attach($categorias);
            // $contrato->Categoria_contrato_belongsTo()->attach($request->a008_id_cat_contrato, ['t024_relacao_categorias_contrato'=> $requestData['a005_id_empresa_select'] ]);


            // desconto de créditos
            $users_empresa = $contrato->Empresa_belongsTo->Empresa_usuario_hasMany->map(function($user) {
                return $user->Usuario_belongsTo;
            });
            $users_cli_for = $contrato->Empresa_CliFor_belongsTo->Empresa_usuario_hasMany->map(function($user) {
                return $user->Usuario_belongsTo;
            });
            $usuarios = $users_empresa->merge($users_cli_for);
            $usuarios->map(function($usuario){
                $id_empresas = $usuario->empresas->pluck('a005_id_empresa')->toArray();
                $contratos = Contrato::query()->whereIn('a005_id_empresa', $id_empresas)->orWhereIn('a005_id_empresa_cli_for', $id_empresas)->get();
                
                if ($contratos->count() > env('CONTRATOS_GRATUITOS')) {
                    $user = $usuario->User_belongsTo;
                    $user->creditos--;
                    $user->save();
                }
            });

            $this->gravaTipoVencimento($contrato->a013_id_contrato, $requestData);

            $this->gravaDocumentos($contrato->a013_id_contrato, $request);

            $this->gravaOutrosDocumentos($contrato->a013_id_contrato, $request);

            $this->gravaCamposExclusivos($contrato, $requestData);

            $this->gravaHistorico($contrato);

            $this->notificarUsuarios($contrato, 'criado');

            Session::flash('flash_message', 'Contrato adicionado!');
            DB::commit();

            return redirect('contrato');

        } catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage());
            Session::flash('flash_message', 'Não foi possível Criar o Contrato!');
            return redirect('contrato');
        }
    }

    public function validaCreditos($id_empresa, $id_empresa_clifor)
    {
        $empresa = Empresa::find($id_empresa);
        $empresa_clifor = Empresa::find($id_empresa_clifor);
        $empresa_usuarios = $empresa->Empresa_usuario_hasMany->merge( $empresa_clifor->Empresa_usuario_hasMany);
        $valido = 1;    

        foreach ($empresa_usuarios as $elem) {
            $id_empresas = $elem->Usuario_belongsTo->empresas->pluck('a005_id_empresa')->toArray();
            $contratos = Contrato::query()->whereIn('a005_id_empresa', $id_empresas)->orWhereIn('a005_id_empresa_cli_for', $id_empresas)->get();
            $user = \App\User::find($elem->Usuario_belongsTo->a001_id_usuario);
            $assinatura = \App\Assinatura::where('customer_id', $user->pagarme_customer_id)->first();

            if ($contratos->count() >= (int)env('CONTRATOS_GRATUITOS') &&
                !$assinatura) {
                $valido = 0;
            }
            else {
                $valido = 1;
            }
        };

        return $valido;
    }

    // empresas vinculadas ao usuario que pertencem ao contrato
    private function getEmpresasUsuarioContrato($contrato)
    {
        $id_empresas_usuario = Auth::user()->Usuario_belongsTo->empresas->pluck('a005_id_empresa')->toArray();
        $id_empresas_contrato = [$contrato->Empresa_belongsTo->a005_id_empresa, $contrato->Empresa_CliFor_belongsTo->a005_id_empresa];

        foreach ($id_empresas_usuario as $key => $value) {
            if (in_array($value, $id_empresas_contrato))
                $id_empresas[] = $value;
        }

        return $id_empresas;
    }

    public function gravaCamposExclusivos($contrato, $dados)
    {
        $id_empresas = $this->getEmpresasUsuarioContrato($contrato);
        CamposExclusivos::contrato($contrato->a013_id_contrato, $id_empresas)->delete();

        return CamposExclusivos::insert([[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a013_centro_custo',
            'a030_valor' => $dados['a013_centro_custo'] ?? "",
            'a005_id_empresa' => $id_empresas[0],
        ],[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a010_id_tipo_contrato',
            'a030_valor' => $dados['a010_id_tipo_contrato'] ?? "",
            'a005_id_empresa' => $id_empresas[0],
        ],[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a013_classificacao',
            'a030_valor' => $dados['a013_classificacao'] ?? "",
            'a005_id_empresa' => $id_empresas[0],
        ],[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a011_id_area',
            'a030_valor' => $dados['a011_id_area'] ?? "",
            'a005_id_empresa' => $id_empresas[0],
        ],[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a013_finalidade_cliente',
            'a030_valor' => $dados['a013_finalidade_cliente'] ?? "",
            'a005_id_empresa' => $dados['a005_id_empresa_select'],
        ],[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a013_finalidade_fornecedor',
            'a030_valor' => $dados['a013_finalidade_fornecedor'] ?? "",
            'a005_id_empresa' => $dados['a005_id_empresa_cli_for'],
        ],[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a013_referencia_cliente',
            'a030_valor' => $dados['a013_referencia_cliente'] ?? "",
            'a005_id_empresa' => $dados['a005_id_empresa_select'],
        ],[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a013_referencia_fornecedor',
            'a030_valor' => $dados['a013_referencia_fornecedor'] ?? "",
            'a005_id_empresa' => $dados['a005_id_empresa_cli_for'],
        ],[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a013_obs_contrato_cliente',
            'a030_valor' => $dados['a013_obs_contrato_cliente'] ?? "",
            'a005_id_empresa' => $dados['a005_id_empresa_select'],
        ],[
            'a030_secao' => 'contratos',
            'a030_identificador' => 'a013_id_contrato',
            'a030_valor_identificador' => $contrato->a013_id_contrato,
            'a030_campo' => 'a013_obs_contrato_fornecedor',
            'a030_valor' => $dados['a013_obs_contrato_fornecedor'] ?? "",
            'a005_id_empresa' => $dados['a005_id_empresa_cli_for'],
        ]]);
    }

    public function show($id)
    {
        $contrato = Contrato::findOrFail($id);
        $comboResponsavel = $this->optionResponsavel();
        $comboUsuario = $this->optionTodosUsuario();
		$comboEmpresa = $this->optionEmpresa();
		$comboCategoria_contrato = $this->optionCategoria_contrato();
		$comboTipo_contrato = $this->optionTipo_contrato();
		$comboTipo_vencimento = $this->optionTipo_vencimento();
		$comboArea_contrato = $this->optionArea_contrato();
		$comboClassificacao = $this->optionClassificacao();

        return view('sistema.contrato.show', compact('contrato','comboResponsavel','comboEmpresa','comboCategoria_contrato','comboTipo_contrato','comboArea_contrato','comboClassificacao','comboTipo_vencimento','comboUsuario'));
    }

    public function permissaoUsuarioContrato($contrato)
    {
        $id_user = Auth::user()->id;
        
        //verifica se usuario é o criador do contrato
        if ($id_user != $contrato->a001_id_usuario && $id_user != $contrato->created_at_user)
        {
            //verifica se usuario tem permissão para editar ou visualizar
            if ($contrato->a013_usuarios_acesso) {
                $usuarios_acesso = json_decode($contrato->a013_usuarios_acesso);
                foreach ($usuarios_acesso as $key => $usuario) {
                    if ($usuario->a001_id_usuario == $id_user) {
                        return $usuario->admin;
                    }
                }
                abort(401);
            }

            return true;
        }

        // usuario é o criador, entao verifica inadimplencia
        return !Auth::user()->isInadimplente();
    }

    public function edit($id)
    {
        $contrato = Contrato::findOrFail($id);
        $id_contratante = $contrato->a013_empresa_contratante;
        $contrato->a013_empresa_contratante = $contrato->a013_empresa_contratante == $contrato->a005_id_empresa ? 1 : 2;
        $contrato->a005_id_empresa_select = $contrato->a005_id_empresa;

        $this->validaAcessoEdit($contrato->a005_id_empresa, 'empresa', $contrato->a005_id_empresa_cli_for);
        $permission_user = $this->permissaoUsuarioContrato($contrato);

        $comboResponsavel = $this->optionResponsavel($contrato->a005_id_empresa);
        $comboUsuario = $this->optionTodosUsuario();
		$comboEmpresa = $this->optionEmpresa(0, $contrato);
		$comboCategoria_contrato = $this->optionCategoria_contrato();
		$comboTipo_contrato = $this->optionTipo_contrato([0]);
        
        $id_empresas = Auth::user()->Usuario_belongsTo->empresas->pluck('a005_id_empresa')->toArray();
		$comboTipo_vencimento = $this->optionTipo_vencimento($id_empresas);
		$comboArea_contrato = $this->optionArea_contrato([0]);
		$comboClassificacao = $this->optionClassificacao();
        $comboEmpresaClieFor = $this->optionEmpresaCliFor($contrato->a005_id_empresa);
        $comboTipo_cliente = app(EmpresaController::class)->optionTipo_cliente();
        $comboTipo_empresa = app(EmpresaController::class)->optionTipo_empresa();
        $comboCidade = app(EmpresaController::class)->optionCidade(0);
        $comboEstado = app(EmpresaController::class)->optionEstado();
        $comboUsuarios = $this->optionUsuariosEmpresas($contrato);

        $contratoTipoVencimento = Contrato_tipo_vencimento::query()->where('a013_id_contrato', $id)->get();

        $contratoTipoVencimento->map(function($row){
            $row->a017_valor = $this->converteMoney($row->a017_valor);
        });

        $contrato->a013_data_inicio = Carbon::createFromFormat('Y-m-d',$contrato->a013_data_inicio)->format('d/m/Y');
        $contrato->a013_data_fim = Carbon::createFromFormat('Y-m-d',$contrato->a013_data_fim)->format('d/m/Y');
        if($contrato->a013_data_cancelado != null) {
            $contrato->a013_data_cancelado = Carbon::createFromFormat('Y-m-d H:i:s', $contrato->a013_data_cancelado)->format('d/m/Y H:i');
        }

        $contrato->a013_data_renovacao = "";

        $columnsHistorico = $contrato->getColumn();

        $historico = Contrato_hist_alteracoes::query()
            ->where('a013_id_contrato',$id)
            ->get();



        $financeiro = ContratoFinanceiro::where('a013_id_contrato', $id)->orderByDesc('a028_data_cobranca')->with('Empresa_belongsTo', 'Email_hasMany')->get();
        // quem visualizou a parcela por email
        foreach ($financeiro as $key => $parcela) {
            $financeiro[$key]->visualizadores_email = implode(", ", $parcela->Email_hasMany->map(function($item){
                return $item->a997_email_visualizado;
            })->toArray());
        };
        // é um usuário da empresa que pode mudar status de parcelas
        foreach ($financeiro as $fin) {
            $fin->da_minha_empresa = Auth::user()->Usuario_belongsTo->empresas->whereIn('a005_id_empresa', $fin->a005_id_empresa)->count();
        }

        $pendencias = ContratoPendencia::where('a013_id_contrato', $id)->with('Empresa_belongsTo')->get();
        // é um usuário da empresa que pode aceitar pendências
        foreach ($pendencias as $pendencia) {
            $pendencia->da_minha_empresa = Auth::user()->Usuario_belongsTo->empresas->whereIn('a005_id_empresa', $pendencia->a005_id_empresa)->count();
        }

        $anotacoes = ContratoAnotacao::where('a013_id_contrato', $id)->get();
        // é um usuário da empresa que precisa aceitar a anotação de negociação
        foreach ($anotacoes as $key => $anotacao) {
            $anotacao_id_empresas = $anotacao->Usuario_belongsTo->empresas->whereIn('a005_id_empresa', [$contrato->a005_id_empresa, $contrato->a005_id_empresa_cli_for])->pluck('a005_id_empresa')->toArray();
			
            $anotacao->da_minha_empresa = Auth::user()->Usuario_belongsTo->empresas->whereIn('a005_id_empresa', $anotacao_id_empresas)->count();
        }

    

        foreach ($historico as $key => $item) {
            $campos_alterados = json_decode($item->a016_campos_alterados);
            $log = json_decode($item->a016_log);
            
            if ($log) {
                $historico[$key]->a016_log = $this->formatDateInJson($log);
            }
            if ($campos_alterados) {
                $historico[$key]->a016_campos_alterados = $this->formatDateInJson($campos_alterados);
            }
        }
        
        $renovacoes = Contrato_hist_renovacao::query()
            ->where('a013_id_contrato',$id)
            ->get();

        $attributes = $contrato->getAliases();
        $cli_for = $contrato->Empresa_CliFor_belongsTo;

        $isFornecedor = Auth::user()->Usuario_belongsTo->isFornecedor($id_contratante);
        $isFornecedorOrAdmin = $permission_user ?? $isFornecedor;

        $documentos = $contrato->Contrato_documento_hasMany()->whereNull('a009_id_cat_contr_doc')->get();

        $contatos = $contrato->Contrato_contato_hasMany;
        $optionTipo_contato = $this->optionTipoContato($isFornecedorOrAdmin);

        $contrato = $this->getCamposExclusivos($contrato, $id_empresas);

        return view('sistema.contrato.edit', compact('isFornecedor','id_empresas','financeiro','pendencias','anotacoes','permission_user', 'comboUsuarios', 'isFornecedorOrAdmin', 'cli_for', 'comboTipo_cliente','comboTipo_empresa','comboCidade','comboEstado','documentos','contrato','comboResponsavel','comboEmpresa','comboCategoria_contrato','comboTipo_contrato','comboArea_contrato','comboClassificacao','comboEmpresaClieFor','comboTipo_vencimento','contratoTipoVencimento','columnsHistorico','historico','attributes','comboUsuario','renovacoes','contatos','optionTipo_contato'));
    }

    private function getCamposExclusivos($contrato, $id_empresas)
    {
        $id_empresas = Auth::user()->Usuario_belongsTo->empresas->pluck('a005_id_empresa')->toArray();
        $campos_exclusivos = CamposExclusivos::contrato($contrato->a013_id_contrato, $id_empresas)->get();
        $campos_visiveis = CamposExclusivos::contrato($contrato->a013_id_contrato, [$contrato->a005_id_empresa_select, $contrato->a005_id_empresa_cli_for], true)->get();
        
        foreach ($campos_exclusivos as $key => $value) {
            $contrato[$value->a030_campo] = $value->a030_valor;
        }
        foreach ($campos_visiveis as $key => $value) {
            $contrato[$value->a030_campo] = $value->a030_valor;
        }
        
        return $contrato;
    }

    private function optionTipoContato($isFornecedorOrAdmin)
    {
        return [
            '' => '', 
            'RG' => 'Responsável Geral', 
            'T' => 'Técnico', 
            'F' => 'Financeiro', 
            'C' => 'Comercial',
        ];
    }

    private function formatDateInJson($json)
    {
        foreach ($json as $chave => $value) {
            if (!in_array($value, ['P','S']) && strtotime($value))
                $json->$chave = \Carbon\Carbon::parse($value)->format('d/m/Y');
            else
                $json->$chave;
        }
        
        return json_encode($json);
    }

    public function showFornecedor($id)
    {
        $contrato = Contrato::findOrFail($id);

        $this->validaAcessoEdit(0, 'empresa',$contrato->a005_id_empresa_cli_for);

        $comboResponsavel = $this->optionResponsavel($contrato->a005_id_empresa,$contrato->a001_id_usuario);
        $comboUsuario = $this->optionTodosUsuario();
        $comboEmpresa = $this->optionEmpresa($contrato->a005_id_empresa);
        $comboCategoria_contrato = $this->optionCategoria_contrato($contrato->a005_id_empresa,$contrato->Categoria_contrato_belongsTo);
        $comboTipo_contrato = $this->optionTipo_contrato($contrato->a005_id_empresa,$contrato->a010_id_tipo_contrato);
        $comboTipo_cliente = app(EmpresaController::class)->optionTipo_cliente();
        $comboTipo_empresa = app(EmpresaController::class)->optionTipo_empresa();


        $comboArea_contrato = $this->optionArea_contrato($contrato->a005_id_empresa,$contrato->a011_id_area);
        $comboClassificacao = $this->optionClassificacao();
        $comboEmpresaClieFor = $this->optionEmpresaCliFor($contrato->a005_id_empresa);

        $contratoTipoVencimento = Contrato_tipo_vencimento::query()->where('a013_id_contrato', $id)->get();

        $contratoTipoVencimento->map(function($row){
            $row->a017_valor = $this->converteMoney($row->a017_valor);
        });

        ///
        $comboTipo_vencimento = $this->optionTipo_vencimento($contrato->a005_id_empresa,$contratoTipoVencimento->pluck('a012_id_tipo_vencimento')->values()->toArray());
        ///

        $contrato->a013_data_inicio = Carbon::createFromFormat('Y-m-d',$contrato->a013_data_inicio)->format('d/m/Y');
        $contrato->a013_data_fim = Carbon::createFromFormat('Y-m-d',$contrato->a013_data_fim)->format('d/m/Y');
        if($contrato->a013_data_cancelado != null) {
            $contrato->a013_data_cancelado = Carbon::createFromFormat('Y-m-d H:i:s', $contrato->a013_data_cancelado)->format('d/m/Y H:i');
        }

        $columnsHistorico = $contrato->getColumn();

        $historico = Contrato_hist_alteracoes::query()
            ->where('a013_id_contrato',$id)
            ->get();

        $attributes = $contrato->getAliases();

        $documentos = $contrato->Contrato_documento_hasMany()->whereNull('a009_id_cat_contr_doc')->get();

        $showFornecedor = 1;

        return view('sistema.contrato.edit', compact('documentos','comboTipo_empresa','comboTipo_cliente','contrato','comboResponsavel','comboEmpresa','comboCategoria_contrato','comboTipo_contrato','comboArea_contrato','comboClassificacao','comboEmpresaClieFor','comboTipo_vencimento','contratoTipoVencimento','columnsHistorico','historico','attributes','comboUsuario','showFornecedor'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'a005_id_empresa' => 'required',
			'a005_id_empresa_cli_for' => 'required',
			// 'a010_id_tipo_contrato' => 'required',
			'a013_numero_contrato' => 'required',
			// 'a013_classificacao' => 'required',
			'a013_data_inicio' => 'required',
			'a013_data_fim' => 'required',
        ]);
        
        $requestData = $request->except('a008_id_cat_contrato');
        
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a013_status'] = $requestData['a013_status']??'C';
        $requestData['a013_aceita_termo'] = $requestData['a013_aceita_termo']??0;
        $requestData['a013_data_inicio'] = Carbon::createFromFormat('d/m/Y',$requestData['a013_data_inicio'])->format('Y-m-d');
        
        $requestData['a013_data_fim'] = Carbon::createFromFormat('d/m/Y',$requestData['a013_data_fim'])->format('Y-m-d');
        $requestData['a013_valor_total_contrato'] = $requestData['a013_valor_total_contrato'] ? $this->converteDecimalDB($requestData['a013_valor_total_contrato']) : '0,00';
        $requestData['a013_valor_extra'] = $requestData['a013_valor_extra'] ? $this->converteDecimalDB($requestData['a013_valor_extra']) : '0,00';
        // $requestData['a013_valor_comissao'] = $requestData['a013_valor_comissao'] ? $this->converteDecimalDB($requestData['a013_valor_comissao']) : '0,00';
        // $requestData['a013_custo_recisao_antecipada'] = $requestData['a013_custo_recisao_antecipada'] ? $this->converteDecimalDB($requestData['a013_custo_recisao_antecipada']) : '0,00';
        $requestData['a013_valor_fracao'] = $requestData['a013_valor_fracao'] ? $this->converteDecimalDB($requestData['a013_valor_fracao']) : '0.00';
        
        if($requestData['a013_data_renovacao'] != "")
        $requestData['a013_data_renovacao'] = Carbon::createFromFormat('d/m/Y',$requestData['a013_data_renovacao'])->format('Y-m-d');
        
        if($requestData['a013_aceita_termo'] == 1)
        {
            $requestData['a013_data_cancelado'] = Carbon::now();
            $requestData['a001_id_usuario_cancelou'] = Auth::user()->a001_id_usuario;
        }

        $requestData['a013_empresa_contratante'] = $requestData['a013_empresa_contratante'] == 1 ? $requestData['a005_id_empresa'] : $requestData['a005_id_empresa_cli_for'];
        
        $contrato = Contrato::findOrFail($id);
        $old_contrato = $contrato->replicate();


        // salvar categorias para cada usuario
        $id_empresas = $this->getEmpresasUsuarioContrato($contrato);
        
        foreach ($request->a008_id_cat_contrato as $key => $value) {
            $categorias[$value] = ['a005_id_empresa'=> $id_empresas[0]];
        }
    
        $categorias_da_empresa = $contrato->Categoria_contrato_belongsTo()->wherePivot('a005_id_empresa', $id_empresas[0]);
      
        if (count($categorias_da_empresa->get())) {
            $categorias_da_empresa->sync($categorias);
        }
        else {
            $categorias_da_empresa->syncWithoutDetaching($categorias);
        }
        
        ///////validar se esta cancelado pra nao deixar salvar
        ///////validar se tem autorização pra poder salvar
        if(($contrato->a013_status??'C') == 'C')
        {
            DB::rollBack();
            Session::flash('flash_message', 'Contrato Cancelado, Não foi possível Alterá-lo!');
            return redirect('contrato');
        }
        
        $this->validaAcessoEdit($contrato->a005_id_empresa, 'empresa', $contrato->a005_id_empresa_cli_for);
        
        DB::beginTransaction();
        try {
            
            ///// criando log de renovação ////////////////////////////////
            if($requestData['a013_data_renovacao'] != "")
            {
                $requestData['a013_data_inicio'] = $requestData['a013_data_renovacao'];
                $txtDtIni = Carbon::createFromFormat('Y-m-d',$contrato->a013_data_inicio)->format('d/m/Y'). ' -> ' .Carbon::createFromFormat('Y-m-d',$requestData['a013_data_inicio'])->format('d/m/Y');
                $txtDias = $contrato->a013_prazo_contrato. ' -> ' .$requestData['a013_prazo_contrato'];
                $txtDtFin = Carbon::createFromFormat('Y-m-d',$contrato->a013_data_fim)->format('d/m/Y'). ' -> ' .Carbon::createFromFormat('Y-m-d',$requestData['a013_data_fim'])->format('d/m/Y');
                $txtTotal = $contrato->a013_valor_total_contrato. ' -> ' .$requestData['a013_valor_total_contrato'];
                $txtObs = $contrato->a013_obs_contrato. ' -> ' .$requestData['a013_obs_contrato'];
                
                $histRenova =  new Contrato_hist_renovacao();
                $histRenova->a015_data_renovacao = Carbon::now();
                $histRenova->a013_id_contrato = $contrato->a013_id_contrato;
                $histRenova->a001_id_usuario = Auth::user()->a001_id_usuario;
                $histRenova->a015_nome_usuario = Auth::user()->name ." (".Auth::user()->email.")";
                $histRenova->a015_data_inicio = $txtDtIni;
                $histRenova->a015_dias = $txtDias;
                $histRenova->a015_data_fim = $txtDtFin;
                $histRenova->a015_valor_total_contrato = $txtTotal;
                $histRenova->a015_obs = $txtObs;
                $histRenova->created_at_user = Auth::user()->id;
                $histRenova->updated_at_user = Auth::user()->id;
                $histRenova->save();
            }
            //////////////////////////////////////////////////////////
            
            
            //upload de arquivos
            if($request->hasFile('a013_assinatura')) {
                
                Storage::disk('public')->delete($empresa->a005_logo??"");
                $arquivo = $request->file('a013_assinatura');
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/contrato', $fileName, 'public');
                $requestData['a013_assinatura'] = '/uploads/contrato/' . $fileName;
            }
            else{
                $requestData['a013_assinatura'] = $contrato['a013_assinatura'];
            }
            
            
            $contrato->update($requestData);

            $this->gravaTipoVencimento($id, $requestData);
            
            $this->gravaDocumentos($id, $request);

            $this->gravaOutrosDocumentos($id, $request);
            
            $this->gravaContato($id, $request);

            $this->gravaCamposExclusivos($contrato, $requestData);

            $this->gravaHistorico( $contrato, $old_contrato);

            $this->notificarUsuarios($contrato, 'alterado');

            Session::flash('flash_message', 'Contrato atualizado!');
            DB::commit();

            return redirect('contrato');

        } catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage());

            Session::flash('flash_message', 'Não foi possível atualizar o Contrato!');
            return redirect('contrato');
        }
    }

    public function gravaContato($id_contrato, $requestData)
    {
        $id_empresa_logada = Empresa_usuario::query()->where('a001_id_usuario', Auth::user()->a001_id_usuario)->first()->a005_id_empresa??0;

        Contrato_contato::query()
            ->where('a013_id_contrato', '=', $id_contrato)
            ->delete();

        for ($x = 0; $x < count($requestData['a029_nome'] ?? []); $x++) {

            // $id_empresa_criou = $requestData["a005_id_empresa_criou"][$x]??$id_empresa_logada;

            $EmpresaContato = new Contrato_contato();
            $EmpresaContato->a013_id_contrato = $id_contrato;
            // $EmpresaContato->a005_id_empresa_criou = $id_empresa_criou;
            $EmpresaContato->a029_tipo_contato = $requestData["a029_tipo_contato"][$x];
            $EmpresaContato->a029_nome = $requestData["a029_nome"][$x];
            $EmpresaContato->a029_fone = $this->retiraCaracter($requestData["a029_fone"][$x]);
            $EmpresaContato->a029_email = $requestData["a029_email"][$x];
            $EmpresaContato->a029_status = json_decode($requestData["a029_status"][$x]) ? 1 : 0;
            $EmpresaContato->created_at_user = $requestData["created_at_user"][$x] ?? Auth::user()->a001_id_usuario;
            $EmpresaContato->save();
        }
    }

    public function notificarUsuarios($contrato, $criacao_alteracao)
    {
        $id_empresa_alterando = Auth::user()->id_empresa_principal;

        if ($id_empresa_alterando != $contrato->a005_id_empresa) {
            $id_empresa_notificacao = $contrato->a005_id_empresa;
        }
        else {
            $id_empresa_notificacao = $contrato->a005_id_empresa_cli_for;
        }

        $empresa_alterando = Empresa::find($id_empresa_alterando);
        $empresa_notificada = Empresa::find($id_empresa_notificacao);
        
        $empresa_users = $empresa_notificada->Empresa_usuario_hasMany;
        $id_users = $empresa_users->map(function ($user) { return $user->Usuario_belongsTo->a001_id_usuario; })->toArray();

        $nome_empresa_alterando = $empresa_alterando->a005_nome_completo ?? $empresa_alterando->a005_nome_fantasia ?? $empresa_alterando->a005_razao_social;
        $conteudo = "Um contrato com a empresa $nome_empresa_alterando foi $criacao_alteracao.<br><br><a href=".route('contrato.edit', $contrato->a013_id_contrato).">Clique aqui</a> para visualizar o contrato.";
        
        foreach ($id_users as $key => $id_user) {
            $this->notificacaoPadrao(0, $id_user, "Contrato com $nome_empresa_alterando foi $criacao_alteracao", $conteudo, 0, 'contrato');
        }
    }

    public function notificar()
    {

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Contrato::findOrFail($id)->delete();

            $user = Auth::user();
            $user->save();

            Session::flash('flash_message', 'Contrato excluído!');
            DB::commit();
            return redirect('contrato');

        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Contrato!');
            return redirect('contrato');
        }
    }


    private function optionEmpresa($idEmpresa=0, $contrato = null)
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where('a005_status', 1)
            ->where('a005_ind_empresa', 1)
            ->where(function($where)use($idEmpresa, $contrato){
                if(Auth::user()->ind_super_adm<=0) {
                    if ($contrato) {
                        $where->whereIn('t004_empresa_usuario.a005_id_empresa', [$contrato->a005_id_empresa, $contrato->a005_id_empresa_cli_for]);
                    }
                    else {
                        $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                        $where->where('t004_empresa_usuario.a004_dono_cadastro', '=', 1);
                    }

                    if(is_array($idEmpresa) ){
                        if($idEmpresa[0] != '0')
                            $where->wherein('t004_empresa_usuario.a005_id_empresa', $idEmpresa);
                    }
                    else {
                        if($idEmpresa!='0')
                            $where->where('t004_empresa_usuario.a005_id_empresa', $idEmpresa);
                    }
                }
            })
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,''), ' - ', ifnull(nullif(INSERT( INSERT( INSERT( INSERT( a005_cnpj, 13, 0, '-' ), 9, 0, '/' ), 6, 0, '.' ), 3, 0, '.'),''), INSERT( INSERT( INSERT( a005_cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ))) as nome"))
            ->orderByRaw("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,''))")
            ->pluck('nome','t005_empresa.a005_id_empresa');

        return $ret;
    }

    private function optionEmpresaCliFor($idEmpresa = 0, $tipo = '')
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where(function($where){
                $where->orwhere('a005_ind_cliente', '1')->orwhere('a005_ind_fornecedor', '1');
            })
            ->where(function($where) use ($tipo){
                if($tipo == "C")
                    $where->orwhere('a005_ind_cliente', 1);
                if($tipo == "F")
                    $where->orwhere('a005_ind_fornecedor', 1);
            })
            ->where('a005_status', 1)
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0)
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
            })

            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,''),case when a005_ind_cliente = 1 then case when a005_ind_fornecedor = 1 then ' (Cliente/Fornecedor)' else ' (Cliente)' end else case when a005_ind_fornecedor = 1 then ' (Fornecedor)' else '' end end) as nome"))
            ->orderByRaw("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,''))")
            ->pluck('nome','t005_empresa.a005_id_empresa');
        //->get();


        if(count($ret)>1)
        {
            $ret->prepend('','');
        }

        return $ret;
    }

    private function optionCategoria_contrato($idEmpresa=0, $idCategoria=0)
    {
        $ret = Categoria_contrato::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't008_categoria_contrato.a005_id_empresa')
            ->where('a008_status', 1)
            ->where(function($where) use($idCategoria){
                if(Auth::user()->ind_super_adm<=0) {
                    //$where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    /////adicionado esse or abaixo pra quando acesso do fornecedor trazer tb o $idCategoria da combo empresa
                    //$where->orwhere('t008_categoria_contrato.a008_id_cat_contrato', $idCategoria);
                }
            })
            ->where(function($where) use ($idEmpresa){
                    //$where->where('t008_categoria_contrato.a005_id_empresa',$idEmpresa);


                if(is_array($idEmpresa) ){
                    if($idEmpresa[0] != '0') {
                        $where->wherein('t008_categoria_contrato.a005_id_empresa', $idEmpresa);
                    }
                }
                else {
                    if($idEmpresa!='') {
                        $where->where('t008_categoria_contrato.a005_id_empresa', $idEmpresa);
                    }
                }
            })
            ->pluck('a008_descricao','a008_id_cat_contrato');

        if(count($ret)>1)
        {
            $ret->prepend('','');
        }
        return $ret;
    }

    private function optionTipo_contrato($idEmpresa=0, $idTipo=0)
    {
        $ret = Tipo_contrato::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't010_tipo_contrato.a005_id_empresa')
            ->where('a010_status', 1)
            // ->where(function($where) use($idTipo){
            //     if(Auth::user()->ind_super_adm<=0) {
            //         $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
            //         ///adicionado esse or abaixo pra quando acesso do fornecedor trazer tb o tipo da combo empresa
            //         $where->orwhere('t010_tipo_contrato.a010_id_tipo_contrato', $idTipo);
            //     }
            // })
            ->where(function($where) use ($idEmpresa){
                if(is_array($idEmpresa) ){
                    if($idEmpresa[0] != '0')
                        $where->wherein('t010_tipo_contrato.a005_id_empresa', $idEmpresa);
                }
                else {
                    $where->where('t010_tipo_contrato.a005_id_empresa', $idEmpresa);
                }
            })
            ->pluck('a010_descricao','a010_id_tipo_contrato');

        if(count($ret)>1)
        {
            $ret->prepend('','');
        }

        return $ret;
    }

    private function optionTipo_vencimento($idEmpresa=0, $id_tipo_vencimento = [])
    {
        $ret = Tipo_vencimento::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't012_tipo_vencimento.a005_id_empresa')
            ->where('a012_status', 1)
            ->where(function($where) use($id_tipo_vencimento){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    ///adicionado esse or abaixo pra quando acesso do fornecedor trazer tb o emrpesa fornec da combo
                    $where->orwherein('t012_tipo_vencimento.a012_id_tipo_vencimento', $id_tipo_vencimento);
                }
            })
            ->where(function($where) use ($idEmpresa, $id_tipo_vencimento){

                if(is_array($idEmpresa) ){
                    if($idEmpresa[0] != '0')
                        $where->wherein('t012_tipo_vencimento.a005_id_empresa', $idEmpresa);
                }
                else {
                    $where->where('t012_tipo_vencimento.a005_id_empresa', $idEmpresa);
                }
                 ///adicionado esse or abaixo pra quando acesso do fornecedor trazer tb o emrpesa fornec da combo
                $where->orwherein('t012_tipo_vencimento.a012_id_tipo_vencimento', $id_tipo_vencimento);
            })->pluck('a012_descricao','a012_id_tipo_vencimento');

        if(count($ret)>1)
        {
            $ret->prepend('','');
        }

        return $ret;
    }

    private function optionArea_contrato($idEmpresa=0, $idArea = 0)
    {
        $ret = Area_contrato::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't011_area_contrato.a005_id_empresa')
            ->where('a011_status', 1)
            // ->where(function($where) use($idArea){
            //     if(Auth::user()->ind_super_adm<=0) {
            //         $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
            //         ///adicionado esse or abaixo pra quando acesso do fornecedor trazer tb o area ca combo empresa
            //         $where->orwhere('t011_area_contrato.a011_id_area', $idArea);
            //     }
            // })
            ->where(function($where) use ($idEmpresa){

                if(is_array($idEmpresa) ){
                    if($idEmpresa[0] != '0')
                        $where->wherein('t011_area_contrato.a005_id_empresa', $idEmpresa);
                }
                else {
                    if($idEmpresa!='') {
                        $where->where('t011_area_contrato.a005_id_empresa', $idEmpresa);
                    }
                }
            })
            ->pluck('a011_descricao','a011_id_area');

        if(count($ret)>1)
        {
            $ret->prepend('','');
        }
        return $ret;
    }

    private function optionUsuariosEmpresas($contrato)
    {
        $usuarios_empresa = $contrato->Empresa_belongsTo->Empresa_usuario_hasMany->map(function($user){
            return $user->Usuario_belongsTo;
        })->pluck('a001_nome', 'a001_id_usuario')->toArray();
        
        $usuarios_cli_for = $contrato->Empresa_CliFor_belongsTo->Empresa_usuario_hasMany->map(function($user){
            return $user->Usuario_belongsTo;
        })->pluck('a001_nome', 'a001_id_usuario')->toArray();

        return $usuarios_empresa + $usuarios_cli_for;
    }

    private function optionClassificacao()
    {
        $ret = [''=>'','P'=>'Produto','S'=>'Serviço'];
        return $ret;
    }

    private function optionStatus()
    {
        $ret = [''=>'','A'=>'Ativo','D'=>'Inativo','C'=>'Cancelado','V'=>'Vencido'];
        return $ret;
    }

    private function optionResponsavel($idEmpresa=0, $idResponsavel=0)
    {
        ///busca todos os ids das empresas que o usuario logado tem relação
        $idsEmpresaUsuarioLogado = Empresa_usuario::query()->where('a001_id_usuario', '=', Auth::user()->a001_id_usuario)->pluck('a005_id_empresa')->toArray();

        ///busca todos os usuarios de todas as empresas que o usuario logado tem acesso
        $idsUsuarioDasEmpresas = Empresa_usuario::query()->wherein('a005_id_empresa', $idsEmpresaUsuarioLogado)->pluck('a001_id_usuario')->toArray();



        $ret =  Usuario::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a001_id_usuario', '=', 't001_usuario.a001_id_usuario')
            ->where('a001_status', 1)
            ->where(function($where) use ($idsUsuarioDasEmpresas,$idResponsavel){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->wherein('t004_empresa_usuario.a001_id_usuario', $idsUsuarioDasEmpresas);
                    ///adicionado esse or abaixo pra quando acesso do fornecedor trazer tb o responsavel ca combo empresa
                    $where->orwhere('t004_empresa_usuario.a001_id_usuario', $idResponsavel);

                }
            })
            ->where(function($where) use ($idEmpresa){


                if(is_array($idEmpresa) ){
                    if($idEmpresa[0] != '0')
                        $where->wherein('t004_empresa_usuario.a005_id_empresa', $idEmpresa);
                }
                else {
                    $where->where('t004_empresa_usuario.a005_id_empresa', $idEmpresa);
                }
            })
            ->select('t001_usuario.a001_id_usuario','a001_nome','a001_email','a001_status','a001_cpf','a001_telefone','a001_cargo','a001_cep','a001_endereco','a001_numero_end','a047_id_cidade','a001_complemento','a001_bairro','a001_foto')
            ->groupBy('t001_usuario.a001_id_usuario','a001_nome','a001_email','a001_status','a001_cpf','a001_telefone','a001_cargo','a001_cep','a001_endereco','a001_numero_end','a047_id_cidade','a001_complemento','a001_bairro','a001_foto')

            ->pluck('a001_nome','t001_usuario.a001_id_usuario');


        if(count($ret)>1)
        {
            $ret->prepend('','');
        }
        //dump($ret);

        return $ret;
    }

    private function optionTodosUsuario($idEmpresa=0)
    {
        $ret =  Usuario::query()
            ->select('t001_usuario.a001_id_usuario','a001_nome','a001_email','a001_status','a001_cpf','a001_telefone','a001_cargo','a001_cep','a001_endereco','a001_numero_end','a047_id_cidade','a001_complemento','a001_bairro','a001_foto')
            ->groupBy('t001_usuario.a001_id_usuario','a001_nome','a001_email','a001_status','a001_cpf','a001_telefone','a001_cargo','a001_cep','a001_endereco','a001_numero_end','a047_id_cidade','a001_complemento','a001_bairro','a001_foto')
            ->pluck('a001_nome','t001_usuario.a001_id_usuario');

        if(count($ret)>1)
        {
            $ret->prepend('','');
        }


        return $ret;
    }

    public function carregaOptionsEmpresa(Request $request)
    {
        $requestData = $request->all();
        $idEmpresa = $requestData["idEmpresa"];



        $comboTipo_contrato = $this->optionTipo_contrato($idEmpresa);
        $tipo_vencimento = $this->optionTipo_vencimento($idEmpresa);

        $comboCategoria_contrato = $this->optionCategoria_contrato($idEmpresa);
        $comboArea_contrato = $this->optionArea_contrato($idEmpresa);

        $comboEmpresaClieFor = $this->optionEmpresaCliFor($idEmpresa);
        $comboEmpresaClie = $this->optionEmpresaCliFor($idEmpresa, 'C');
        $comboEmpresaFor = $this->optionEmpresaCliFor($idEmpresa, 'F');
        $comboResponsavel = $this->optionResponsavel($idEmpresa);

        unset($comboEmpresaClie['']);
        unset($comboEmpresaFor['']);

        $retorno = json_encode([
            'comboCategoria_contrato'=>$comboCategoria_contrato,
            'comboTipo_contrato'=>$comboTipo_contrato,
            'comboTipo_vencimento'=>$tipo_vencimento,
            'comboArea_contrato'=>$comboArea_contrato,
            'comboEmpresaClieFor'=>$comboEmpresaClieFor,
            'comboEmpresaClie'=>$comboEmpresaClie,
            'comboEmpresaFor'=>$comboEmpresaFor,
            'comboResponsavel'=>$comboResponsavel
        ]);

        //$columns = Schema::getColumnListing('t013_contrato');


        return $retorno;
    }

    public function carregaCategoriaDocumentos(Request $request)
    {
        $requestData = $request->all();
        $idCategoria = $requestData["idCategoria"];
        $idContrato = $requestData["idContrato"]??0;

        $documentos = Categoria_contrato_doc::query()
            ->Join('t008_categoria_contrato','t008_categoria_contrato.a008_id_cat_contrato','=','t009_categoria_contrato_doc.a008_id_cat_contrato')
            ->leftJoin('t014_contrato_documento', function($join) use($idContrato){
                $join->on('t014_contrato_documento.a009_id_cat_contr_doc','=','t009_categoria_contrato_doc.a009_id_cat_contr_doc')
                ->where('a013_id_contrato',$idContrato);
            })
            ->where('t009_categoria_contrato_doc.a008_id_cat_contrato', $idCategoria)
            ->where('a009_status', 1)
            ->where('a008_status', 1)
            ->select('t009_categoria_contrato_doc.a009_id_cat_contr_doc','t009_categoria_contrato_doc.a008_id_cat_contrato','a009_descricao','a009_ind_obrigatorio','a009_dias_alerta_vencimento','a009_status', 'a014_id_documento','a013_id_contrato','a014_data','a014_documento','a014_data_vencimento','a014_obs','a008_termo_cancelamento')
            ->get();

        $documentos->map(function($row,$value){
            if($row->a014_data != null)
                $row->a014_data = Carbon::createFromFormat('Y-m-d',$row->a014_data)->format('d/m/Y')??null;
            if($row->a014_data_vencimento != null)
                $row->a014_data_vencimento = Carbon::createFromFormat('Y-m-d',$row->a014_data_vencimento)->format('d/m/Y')??null;

            $row->a014_obs = $row->a014_obs??"";
            $row->a014_data_vencimento = $row->a014_data_vencimento??"";
            $row->a014_documento = $row->a014_documento??"";

        });



        $retorno = json_encode([
            'documentos'=>$documentos
        ]);
        return $retorno;
    }

    public function gravaTipoVencimento($a013_id_contrato, $requestData)
    {
        Contrato_tipo_vencimento::query()->where('a013_id_contrato', '=', $a013_id_contrato)->delete();

        for ($x = 0; $x < count($requestData['a012_id_tipo_vencimento'] ?? []); $x++) {
            $ContratoTpoVenc = new Contrato_tipo_vencimento();
            $ContratoTpoVenc->a013_id_contrato = $a013_id_contrato;
            $ContratoTpoVenc->a012_id_tipo_vencimento = $requestData["a012_id_tipo_vencimento"][$x];
            $ContratoTpoVenc->a017_valor = $this->converteDecimalDB($requestData["a017_valor"][$x]);
            $ContratoTpoVenc->created_at_user = Auth::user()->id;
            $ContratoTpoVenc->updated_at_user = Auth::user()->id;
            $ContratoTpoVenc->save();
        }
    }

    public function gravaDocumentos($a013_id_contrato, $request)
    {
        ///mudou de categoria entao precisa Excluir os registros da categoria anterior
        $contrato_doc_anterior = Contrato_documento::query()
            ->where('a013_id_contrato',$a013_id_contrato)
            ->whereNotIn('a009_id_cat_contr_doc',$request->id_cat_contrato??[])
            ->get();

        $contrato_doc_anterior->map(function($row){
            Storage::disk('public')->delete($row->a014_documento??"");
            $row->delete();

        });

        $id_cat_contrato = $request->id_cat_contrato??[];

        for ($x = 0; $x < count($id_cat_contrato ?? []); $x++) {
            $id = $id_cat_contrato[$x];

            $contrato_doc = Contrato_documento::query()
                ->where('a013_id_contrato',$a013_id_contrato)
                ->where('a009_id_cat_contr_doc', $id)->first();


            $caminhoUpload = "";
            $id_documento_del = explode(',',$request->id_documento_del??"");
            if (!in_array($id, $id_documento_del)) {
                $caminhoUpload = $contrato_doc->a014_documento??"";
            }

            $arquivoSalvo = $contrato_doc['a014_documento']??"";


            //deletando o arquivo do banco
            if($contrato_doc != null)
                $contrato_doc->delete();

            if($request->hasFile('a014_documento'.$id))
            {
                //deletando o arquivo fisico
                Storage::disk('public')->delete($arquivoSalvo??"");

                //readicionando o arquivo
                $arquivo = $request->file('a014_documento'.$id);
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/contrato_documento', $fileName, 'public');
                $caminhoUpload = '/uploads/contrato_documento/' . $fileName;
            }

            $contrato_doc_new = new Contrato_documento();
            $contrato_doc_new->a009_id_cat_contr_doc = $id_cat_contrato[$x];
            $contrato_doc_new->a013_id_contrato = $a013_id_contrato;
            $contrato_doc_new->a014_data = Carbon::now()->format('Y-m-d');
            if($request->a014_data_vencimento[$x] != null)
                $contrato_doc_new->a014_data_vencimento = Carbon::createFromFormat('d/m/Y',$request->a014_data_vencimento[$x])->format('Y-m-d');
            $contrato_doc_new->a014_obs = $request->a014_obs[$x];
            $contrato_doc_new->a014_documento = $caminhoUpload;
            $contrato_doc_new->created_at_user = Auth::user()->id;
            $contrato_doc_new->updated_at_user = Auth::user()->id;

            $contrato_doc_new->save();
        }
    }

    public function gravaOutrosDocumentos($a013_id_contrato, $request)
    {
        $docs_anteriores = Contrato_documento::where('a013_id_contrato', $a013_id_contrato)
                ->whereNull('a009_id_cat_contr_doc');

        // exclusão
        if ($request->a014_id_outros_doc_delete) {
            $delete_ids = explode(',', $request->a014_id_outros_doc_delete);
            
            $delete_docs = $docs_anteriores->whereIn('a014_id_documento', $delete_ids)->get();
            
            foreach ($delete_docs as $key => $doc) {
                Storage::disk('public')->delete($doc->a014_documento??"");
                $doc->delete();
            }
        }

        // atualização
        if ($request->a014_outro_doc_obs) {
            $update_docs = $docs_anteriores->whereIn('a014_id_documento', array_keys($request->a014_outro_doc_obs))->get();
            foreach ($update_docs as $key => $value) {
                $observacao = $request->a014_outro_doc_obs[$value->a014_id_documento];

                if ($observacao) { 
                    $value->a014_obs = $observacao;
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
                $path = $file->storeAs('uploads/contrato_outros_documentos', $fileName, 'public');
                $caminhoUpload = '/uploads/contrato_outros_documentos/' . $fileName;

                $contrato_doc_new = new Contrato_documento();
                $contrato_doc_new->a013_id_contrato = $a013_id_contrato;
                $contrato_doc_new->a014_data = Carbon::now()->format('Y-m-d');
                $contrato_doc_new->a014_documento = $caminhoUpload;
                $contrato_doc_new->created_at_user = Auth::user()->id;
                $contrato_doc_new->updated_at_user = Auth::user()->id;
                $contrato_doc_new->a014_obs = $request->a014_outro_doc_obs[$key] ?? null;
                $contrato_doc_new->save();
            }
        }
    }

    public function gravaHistorico($contrato, $old_contrato = null)
    {
        $columns = collect($contrato->getColumn());

        $a013_id_contrato = $contrato->a013_id_contrato;

        $values = $columns->map(function($row,$val) use( $contrato){
            return $contrato[$row]??null;;
        });
        $resultCollection = $columns->combine($values);

        $Contrato_documento = Contrato_documento::query()->where('a013_id_contrato',$a013_id_contrato)->get();
        $jsonDocs = "";
        $contador = 0;
        $Contrato_documento->map(function($row) use(&$jsonDocs, &$contador){
            $contador++;

            $colunas = $row->getColumn();
            $aliascolunas = $row->getAliases();
            $ret = $contador."- ";

            collect($colunas)->map(function($coluna) use($aliascolunas,$row,&$ret){

                if(($coluna != 'created_at_user')&&($coluna != 'updated_at_user')) {
                    $ret .= $aliascolunas[$coluna] . ":" . $row[$coluna] . "; ";
                }
            });
            $jsonDocs .= $ret."      ";
        });
        $resultCollection["list_documentos"] = $jsonDocs;


        $Contrato_tipo_vencimento = Contrato_tipo_vencimento::query()->where('a013_id_contrato',$a013_id_contrato)->get();
        $tipoVencimento = Tipo_vencimento::query()->get()->pluck('a012_descricao','a012_id_tipo_vencimento');
        $jsonDocs = "";
        $contador = 0;
        $Contrato_tipo_vencimento->map(function($row) use(&$jsonDocs, &$contador,$tipoVencimento){
            $contador++;
            $colunas = $row->getColumn();
            $aliascolunas = $row->getAliases();
            $ret = $contador."- ";

            collect($colunas)->map(function($coluna) use($aliascolunas,$row,&$ret,$tipoVencimento){

                if(($coluna != 'created_at_user')&&($coluna != 'updated_at_user')) {
                    if ($coluna == "a012_id_tipo_vencimento") {
                        $ret .= $aliascolunas[$coluna] . ":" . $tipoVencimento[$row[$coluna]] . "; ";
                    } else {
                        $ret .= $aliascolunas[$coluna] . ":" . $row[$coluna] . "; ";
                    }
                }
            });
            $jsonDocs .= $ret."      ";
        });
        $resultCollection["list_vencimentos"] = $jsonDocs;


        $json = json_encode($resultCollection);



        $changes = null;
        if ($old_contrato) {
            $changes = $contrato->getChanges();

            //salvar no historico apenas colunas permitidas
            foreach ($changes as $key => $change){
                if (in_array($key, $contrato->getHideColumns())){
                    unset($changes[$key]);
                }
            }

            foreach ($changes as $key => $value) {
                $changes[$key] = $old_contrato->$key;
            }
        }
        if ($changes) {
            $Contrato_hist_alteracoes = new Contrato_hist_alteracoes();
            $Contrato_hist_alteracoes->a016_campos_alterados = json_encode($changes);
            $Contrato_hist_alteracoes->a013_id_contrato = $a013_id_contrato;
            $Contrato_hist_alteracoes->a016_data_alteracao = Carbon::now();
            $Contrato_hist_alteracoes->a001_id_usuario = Auth::user()->a001_id_usuario??0;
            $Contrato_hist_alteracoes->created_at_user = Auth::user()->id??0;
            $Contrato_hist_alteracoes->updated_at_user = Auth::user()->id??0;
            $Contrato_hist_alteracoes->a016_log = $json;
            $Contrato_hist_alteracoes->save();
        }

    }

    public function salvarUsuarios(Request $request)
    {
        $contrato = Contrato::find($request->route('id'));
        $old_users = json_decode($contrato->a013_usuarios_acesso);
        $user = $request->all();
        $new_users = [];

        if ($old_users) {
            foreach ($old_users as $key => $old) {
                if ($old->a001_id_usuario == $user['a001_id_usuario'])
                    return ['success' => false, 'message' => "Usuário já cadastrado"];
            }
            $new_users = $old_users;
        }

        array_push($new_users, $user);
        $contrato->a013_usuarios_acesso = json_encode($new_users);
        $contrato->save();

        return ['success' => true];
    }

    public function salvarAnotacao(Request $request)
    {
        try {
            $data = $request->all();
            $data['a013_id_contrato'] = $request->route('id');
            $data['a001_id_usuario'] = Auth::user()->a001_id_usuario;
            $data['a026_nome_usuario'] = Auth::user()->name ." (".Auth::user()->email.")";
            $anotacao = ContratoAnotacao::create($data);
    
            return ['success' => true, 'data' => $anotacao];

        } catch (\Exception $e) {
            return ['success' => true, 'message' => $e->getMessage()];
        }
    }

    public function salvarComentarioAnotacao(Request $request)
    {
        try {
            $id_anotacao = $request->route('id');
            $anotacao = ContratoAnotacao::find($id_anotacao);
            $anotacao->update($request->all());

            if ($anotacao->a028_id_contrato_financeiro) {
                $financeiro = ContratoFinanceiro::find($anotacao->a028_id_contrato_financeiro);
                $financeiro->a028_status = $request->a026_anotacao_aceite ? null : 3;
                $financeiro->save();
            }
    
            return ['success' => true, 'data' => $anotacao];

        } catch (\Exception $e) {
            return ['success' => true, 'message' => $e->getMessage()];
        }
    }

    public function salvarPendencia(Request $request)
    {
        try {
            $data = $request->all();
            $data['a013_id_contrato'] = $request->route('id');
            $data['a001_id_usuario'] = Auth::user()->a001_id_usuario;
            $data['a027_nome_usuario'] = Auth::user()->name ." (".Auth::user()->email.")";
            $pendencia = ContratoPendencia::create($data);
            $nome_empresa = $pendencia->Empresa_belongsTo->a005_nome_fantasia ?? $pendencia->Empresa_belongsTo->a005_razao_social ?? $pendencia->Empresa_belongsTo->a005_nome_completo;
            $pendencia->nome_empresa = $nome_empresa;
    
            return ['success' => true, 'data' => $pendencia];

        } catch (\Exception $e) {
            return ['success' => true, 'message' => $e->getMessage()];
        }
    }

    public function salvarStatusPendencia(Request $request)
    {
        try {
            $id_pendencia = $request->route('id');
            $pendencia = ContratoPendencia::find($id_pendencia);
            $pendencia->update($request->all());
            $nome_empresa = $pendencia->Empresa_belongsTo->a005_nome_fantasia ?? $pendencia->Empresa_belongsTo->a005_razao_social ?? $pendencia->Empresa_belongsTo->a005_nome_completo;
            $pendencia->nome_empresa = $nome_empresa;
    
            return ['success' => true, 'data' => $pendencia];

        } catch (\Exception $e) {
            return ['success' => true, 'message' => $e->getMessage()];
        }
    }

    public function salvarNovaParcelaFinanceiro(Request $request)
    {
        try {
            $data = $request->except('a028_documento');
            $id_contrato = $request->route('id');
            $contrato = Contrato::find($id_contrato);

            // emails dos usuarios da empresa alvo
            $id_empresas_usuario_logado = Auth::user()->Usuario_belongsTo->empresas->pluck('a005_id_empresa')->toArray();
            $id_empresa_alvo = in_array($contrato->a005_id_empresa, $id_empresas_usuario_logado) ? 
                                $contrato->a005_id_empresa_cli_for : $contrato->a005_id_empresa;
            
            $usuarios = Empresa::find($id_empresa_alvo)->Empresa_usuario_hasMany->map(function($item){
                return $item->Usuario_belongsTo;
            });
            $emails = $usuarios->pluck('a001_email')->toArray();
            //

            $data['a013_id_contrato'] = $id_contrato;
            $data['a005_id_empresa'] = $contrato->a005_id_empresa;
            $data['a028_data_cobranca'] = Carbon::createFromFormat('d/m/Y',$data['a028_data_cobranca'])->format('Y-m-d');
            $data['a028_valor_fracao'] = $this->converteDecimalDB($data['a028_valor_fracao'] ?? 0);
            $data['a028_valor_comissao'] = $this->converteDecimalDB($data['a028_valor_comissao'] ?? 0);
            $data['a028_valor_extra'] = $this->converteDecimalDB($data['a028_valor_extra'] ?? 0);
            $data['a028_status'] = 2;
            $data['a028_valor_total_contrato'] = $contrato->a013_valor_total_contrato;// + $data['a028_valor_fracao'] + $data['a028_valor_comissao'] + $data['a028_valor_extra'];
            $data['a028_created_by_email'] = Auth::user()->email;
            
            if ($request->hasFile('a028_documento')){
                $a028_documento_path = $request->file('a028_documento')->store("contrato/${id_contrato}/parcelas");
                $data['a028_documento'] = $a028_documento_path;
            }
            $new_financeiro = ContratoFinanceiro::create($data);
            
            $nome_empresa = $new_financeiro->Empresa_belongsTo->a005_nome_fantasia ?? $new_financeiro->Empresa_belongsTo->a005_razao_social ?? $new_financeiro->Empresa_belongsTo->a005_nome_completo;
            $new_financeiro->nome_empresa = $nome_empresa;


            // cria uma anotação de negociação pendente. Após aceitá-la, será possível mudar o status desta parcela
            $anotacao = ContratoAnotacao::create([
                'a013_id_contrato' => $id_contrato,
                'a001_id_usuario' => Auth::user()->a001_id_usuario,
                'a026_anotacao_titulo' => 'Parcela adicional',
                'a026_nome_usuario' => Auth::user()->name ." (".Auth::user()->email.")",
                'a026_anotacao_descricao' => $data['a028_justificativa'],
                'a028_id_contrato_financeiro' => $new_financeiro->a028_id_contrato_financeiro,
            ]);
            //
            
            foreach ($emails as $key => $email) {
                $this->enviaEmailPadraoView('sistema.email.novaParcela', [
                        'mensagem' => 'Uma nova parcela foi lançada no sistema Dealix.',
                        'data' => $data,
                        'a028_id_contrato_financeiro' => $new_financeiro->a028_id_contrato_financeiro,
                        'a997_email_visualizado' => $email
                    ], 
                    null, null,'Prezado', $email,'Nova parcela'
                );
            }
    
            return ['success' => true, 'data' => $new_financeiro];

        } catch (\Exception $e) {
            return ['success' => true, 'message' => $e->getMessage()];
        }
    }

    public function salvarStatusFinanceiro(Request $request)
    {
        try {
            $id_financeiro = $request->route('id');
            $financeiro = ContratoFinanceiro::find($id_financeiro);
            $financeiro->update($request->all());
            $nome_empresa = $financeiro->Empresa_belongsTo->a005_nome_fantasia ?? $financeiro->Empresa_belongsTo->a005_razao_social ?? $financeiro->Empresa_belongsTo->a005_nome_completo;
            $financeiro->nome_empresa = $nome_empresa;
    
            return ['success' => true, 'data' => $financeiro];

        } catch (\Exception $e) {
            return ['success' => true, 'message' => $e->getMessage()];
        }
    }


    // *****************************    Duplica Produto    *******************************
    public function copy($id)
    {
        DB::beginTransaction();
        try {
            $contrato = Contrato::findOrFail($id);

            $replica = $contrato->replicate();
            $replica->a013_numero_contrato = "";
            //$replica->a005_id_empresa = null;
            //$replica->a005_id_empresa_cli_for = null;
            //$replica->a008_id_cat_contrato = null;
            //$replica->a010_id_tipo_contrato = null;
            //$replica->a011_id_area = null;
            $replica->a013_status = 'D';
            $replica->a013_aceita_termo = null;
            $replica->a013_data_cancelado = null;
            $replica->a001_id_usuario_cancelou = null;
            $replica->a001_id_usuario = Auth::user()->a001_id_usuario;
            $replica->created_at_user = Auth::user()->id;
            $replica->updated_at_user = Auth::user()->id;
            $replica->save();

            $this->gravaHistorico( $replica);

            DB::commit();
            Session::flash('flash_message', 'Contrato Duplicada!');
            return redirect('contrato');
        } catch (\Exception $e) {

            DB::rollBack();

            Session::flash('flash_message', 'Erro ao Duplicar Contrato!');
        }

    }

    public function relatorio(Request $request)
    {
        $comboEmpresa = $this->optionEmpresa([0]);
        $comboStatus = $this->optionStatus();
        $comboUsuario = $this->optionTodosUsuario();
        $comboCategoria_contrato = $this->optionCategoria_contrato([0]);
        $comboTipo_contrato = $this->optionTipo_contrato([0]);
        $comboTipo_vencimento = $this->optionTipo_vencimento([0]);
        $comboArea_contrato = $this->optionArea_contrato([0]);
        $comboClassificacao = $this->optionClassificacao();
        $comboEmpresaClie = $this->optionEmpresaCliFor(0, 'C');
        $comboEmpresaFor = $this->optionEmpresaCliFor(0, 'F');

        unset($comboEmpresa['']);
        unset($comboEmpresaClie['']);
        unset($comboEmpresaFor['']);

        //$comboEmpresa->prepend('Todas','0');

        return view('sistema.contrato.relatorio', compact('comboEmpresa','comboUsuario','comboCategoria_contrato','comboTipo_contrato','comboTipo_vencimento','comboArea_contrato','comboClassificacao','comboEmpresaClie','comboEmpresaFor','comboStatus'));
    }

    public function relatoriodatatable(Request $request)
    {
        $Classificacao = $this->optionClassificacao();
        $area = $this->optionArea_contrato($request->a005_id_empresa);
        $categoria = $this->optionCategoria_contrato($request->a005_id_empresa);

        $requestData = $request->all();

        return Datatables::of(
            Contrato::query()
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't013_contrato.a005_id_empresa')
                ->leftjoin('t005_empresa', 't013_contrato.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->leftjoin('t005_empresa as t005_empresaCliFor', 't013_contrato.a005_id_empresa_cli_for', '=', 't005_empresaCliFor.a005_id_empresa')
                ->leftjoin('t024_relacao_categorias_contrato', 't013_contrato.a013_id_contrato', '=', 't024_relacao_categorias_contrato.a013_id_contrato')
                ->where(function($where) use ($request){

                    if($request->a005_ind_cliente??"0" == "1") {
                        $where->where('t005_empresa.a005_ind_cliente', '=', 1);
                    }
                    if($request->a005_ind_estrangeiro??"0" == "1") {
                        $where->where('t005_empresa.a005_ind_estrangeiro', '=', 1);
                    }
                    if($request->a013_ind_assinatura??"0" == "1") {
                        $where->where('t013_contrato.a013_assinatura', '!=', '');
                    }

                    if(Auth::user()->ind_super_adm<=0) {
                        $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    }
                    if($request->a005_id_empresa??"" != "") {
                        if(is_array($request->a005_id_empresa) ){
                            if($request->a005_id_empresa[0] != '0')
                                $where->wherein('t013_contrato.a005_id_empresa', $request->a005_id_empresa);
                        }
                        else {
                            if($request->a005_id_empresa != "") {
                                $where->where('t013_contrato.a005_id_empresa', $request->a005_id_empresa);
                            }
                        }
                    }
                    $where->where(function($w) use($request){
                        if($request->a005_id_empresa_cli??"" != "") {
                            //$where->where('t013_contrato.a005_id_empresa_cli_for', '=', $request->a005_id_empresa_cli);
                            if(is_array($request->a005_id_empresa_cli) ){
                                if($request->a005_id_empresa_cli[0] != '0')
                                    $w->orwherein('t013_contrato.a005_id_empresa_cli_for', $request->a005_id_empresa_cli);
                            }
                            else {
                                if($request->a005_id_empresa_cli != "") {
                                    $w->orwhere('t013_contrato.a005_id_empresa_cli_for', $request->a005_id_empresa_cli);
                                }
                            }
                        }
                        if($request->a005_id_empresa_for??"" != "") {
                            //$where->where('t013_contrato.a005_id_empresa_cli_for', '=', $request->a005_id_empresa_for);
                            if(is_array($request->a005_id_empresa_for) ){
                                if($request->a005_id_empresa_for[0] != '0')
                                    $w->orwherein('t013_contrato.a005_id_empresa_cli_for', $request->a005_id_empresa_for);
                            }
                            else {
                                if($request->a005_id_empresa_for != "") {
                                    $w->orwhere('t013_contrato.a005_id_empresa_cli_for', $request->a005_id_empresa_for);
                                }
                            }
                        }
                    });
                    if($request->a013_numero_contrato??"" != "") {
                        $where->where('t013_contrato.a013_numero_contrato', '=', $request->a013_numero_contrato);
                    }
                    if($request->a010_id_tipo_contrato??"" != "") {
                        $where->where('t013_contrato.a010_id_tipo_contrato', '=', $request->a010_id_tipo_contrato);
                    }
                    if($request->a008_id_cat_contrato??"" != "") {
                        $where->whereIn('t024_relacao_categorias_contrato.a008_id_cat_contrato', $request->a008_id_cat_contrato);
                    }
                    if($request->a011_id_area??"" != "") {
                        $where->whereIn('t013_contrato.a011_id_area', $request->a011_id_area);
                    }
                    if($request->a013_status??"" != "") {
                        $where->where('t013_contrato.a013_status', '=', $request->a013_status);
                    }
                    if($request->a013_valor_total_contrato_de??"" != "") {
                        $where->where('t013_contrato.a013_valor_total_contrato', '>=', $this->converteDecimalDB($request->a013_valor_total_contrato_de));
                    }
                    if($request->a013_valor_total_contrato_ate??"" != "") {
                        $where->where('t013_contrato.a013_valor_total_contrato', '<=', $this->converteDecimalDB($request->a013_valor_total_contrato_ate));
                    }
                    if($request->a013_data_inicio??"" != "") {
                        $request->a013_data_inicio = Carbon::createFromFormat('d/m/Y',$request->a013_data_inicio)->format('Y-m-d');
                        //$where->where('t013_contrato.a013_data_inicio', '<=', $request->a013_data_inicio);
                        $where->where('t013_contrato.a013_data_fim', '>=', $request->a013_data_inicio);
                    }
                    if($request->a013_data_fim??"" != "") {
                        $request->a013_data_fim = Carbon::createFromFormat('d/m/Y',$request->a013_data_fim)->format('Y-m-d');
                        $where->where('t013_contrato.a013_data_inicio', '<=', $request->a013_data_fim);
                        //$where->where('t013_contrato.a013_data_fim', '<=', $request->a013_data_fim);
                    }
                })
                ->select('t013_contrato.a013_id_contrato','t013_contrato.a005_id_empresa','a005_id_empresa_cli_for','t024_relacao_categorias_contrato.a008_id_cat_contrato','a010_id_tipo_contrato','a011_id_area','a013_numero_contrato','a013_classificacao','a013_finalidade','a013_prazo_contrato','a013_data_inicio','a013_data_fim','a013_dias_vencimento','a013_valor_total_contrato', 'a013_valor_fracao', 'a013_valor_extra','a013_valor_comissao','a013_periodicidade_reajuste','a013_indice_reajuste','a013_prazo_recisao','a013_custo_recisao_antecipada','a013_obs_custo_revisao_antec','a013_conta_contabil','a013_centro_custo','t013_contrato.a001_id_usuario','a013_obs_contrato','a013_assinatura','a013_status')
                ->addSelect(DB::RAW("concat(ifnull(t005_empresa.a005_nome_fantasia,''),ifnull(t005_empresa.a005_nome_completo,'')) as nomeEmpresa"))

                ->groupBy('t013_contrato.a013_id_contrato','t013_contrato.a005_id_empresa','a005_id_empresa_cli_for','t024_relacao_categorias_contrato.a008_id_cat_contrato','a010_id_tipo_contrato','a011_id_area','a013_numero_contrato','a013_classificacao','a013_finalidade'
                    ,'a013_prazo_contrato','a013_data_inicio','a013_data_fim','a013_dias_vencimento','a013_valor_total_contrato','a013_valor_extra','a013_valor_comissao','a013_periodicidade_reajuste','a013_indice_reajuste'
                    ,'a013_prazo_recisao','a013_custo_recisao_antecipada','a013_obs_custo_revisao_antec','a013_conta_contabil','a013_centro_custo','t013_contrato.a001_id_usuario','a013_obs_contrato','a013_assinatura','a013_status'
                    ,'t005_empresa.a005_nome_fantasia','t005_empresa.a005_nome_completo','t005_empresaCliFor.a005_nome_fantasia','t005_empresaCliFor.a005_nome_completo','t005_empresaCliFor.a005_ind_cliente','t005_empresaCliFor.a005_ind_fornecedor','a013_valor_fracao')
                ->addSelect(DB::RAW("concat(ifnull(t005_empresaCliFor.a005_nome_fantasia,''),ifnull(t005_empresaCliFor.a005_nome_completo,''),case when t005_empresaCliFor.a005_ind_cliente = 1 then case when t005_empresaCliFor.a005_ind_fornecedor = 1 then ' (Cliente/Fornecedor)' else ' (Cliente)' end else case when t005_empresaCliFor.a005_ind_fornecedor = 1 then ' (Fornecedor)' else '' end end) as nomeCliFor"))
        )

            ->addColumn('visualizar', function ($row) {
                $acoes = "";
                $acoes .= '<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="$.alert(\'Em desenvolvimento de definição\')" ><span class="fa fa-eye" aria-hidden="true"></span></a> ';
                return $acoes;
            })
            ->editColumn('a013_status', function ($row) {

                if (isset($row->a013_status)) {
                    if ($row->a013_status == 'A') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;

                    } elseif ($row->a013_status == 'D') {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }elseif ($row->a013_status == 'C') {
                        $labelStatus = '<span class="label label-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Cancelado </span>';
                        return $labelStatus;
                    }elseif ($row->a013_status == 'V') {
                        $labelStatus = '<span class="label label-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Vencido </span>';
                        return $labelStatus;
                    }
                }
            })
            ->addColumn('classificacao', function ($row) use ($Classificacao) {
                return $Classificacao[$row->a013_classificacao];
            })
            ->addColumn('a013_assinatura', function ($row) {
                return '<a class="btn btn-xs btn-primary" href="'.$row->a013_assinatura.'" ><span class="fa fa-lock" aria-hidden="true"></span></a> ';
            })
            ->addColumn('area', function ($row) use ($area) {
                return $area[$row->a011_id_area]??$row->a011_id_area;
            })
            ->addColumn('categoria', function ($row) use ($categoria) {
                return $categoria[$row->a008_id_cat_contrato]??$row->a008_id_cat_contrato;
            })
            ->addColumn('dataInicio',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->a013_data_inicio)->format('d/m/Y');
            })
            ->addColumn('dataFim',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->a013_data_fim)->format('d/m/Y');
            })
            ->addColumn('dataInicioFim',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->a013_data_inicio)->format('d/m/Y') . " " .Carbon::createFromFormat('Y-m-d',$row->a013_data_fim)->format('d/m/Y');
            })
            ->escapeColumns(['*'])
            ->make(true);
    }
}
