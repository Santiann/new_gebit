<?php

namespace App\Http\Controllers;

use App\Compromisso_upload;
use App\Contrato;
use App\Empresa;
use App\Empresa_usuario;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use App\Parametro;
use App\Categoria_contrato;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use App\Compromisso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class CompromissoFinanceiroController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:compromisso-show|compromisso-create|compromisso-edit|compromisso-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('compromisso-edit');
        $delete = Entrust::can('compromisso-delete');
        return Datatables::of(
            Compromisso::query()
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't022_compromisso.a005_id_empresa')
                ->join('t004_empresa_usuario as empresa_usuario_cli_for', 'empresa_usuario_cli_for.a005_id_empresa', '=', 't022_compromisso.a005_id_empresa_cli_for')
                ->join('t005_empresa', 't022_compromisso.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->join('t005_empresa as t005_empresaCliFor', 't022_compromisso.a005_id_empresa_cli_for', '=', 't005_empresaCliFor.a005_id_empresa')
                ->leftjoin('t013_contrato','t013_contrato.a013_id_contrato','=','t022_compromisso.a013_id_contrato')
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
                ->where('a022_tipo', 1)->orWhere('a022_tipo', 0)
                ->select('a022_id_compromisso','t022_compromisso.a005_id_empresa','t022_compromisso.a013_id_contrato','t022_compromisso.a005_id_empresa_cli_for','a022_classificacao','a022_finalidade','a022_data_vencimento','a022_valor_pagar','a022_uso_vital','a022_data_pagamento','a022_valor_pago','a022_forma_pagamento','a022_status')
                ->addSelect('a013_numero_contrato')
                ->addSelect(DB::RAW("concat(ifnull(t005_empresa.a005_nome_fantasia,''),ifnull(t005_empresa.a005_nome_completo,'')) as nomeEmpresa"))
                ->addSelect(DB::RAW("concat(ifnull(t005_empresaCliFor.a005_nome_fantasia,''),ifnull(t005_empresaCliFor.a005_nome_completo,'')) as nomeCliFor"))
                ->groupBy('a022_id_compromisso','t022_compromisso.a005_id_empresa','t022_compromisso.a013_id_contrato','t022_compromisso.a005_id_empresa_cli_for','a022_classificacao','a022_finalidade','a022_data_vencimento','a022_valor_pagar','a022_uso_vital','a022_data_pagamento','a022_valor_pago','a022_forma_pagamento','a022_status','t005_empresa.a005_nome_fantasia','t005_empresa.a005_nome_completo','t005_empresaCliFor.a005_nome_fantasia','t005_empresaCliFor.a005_nome_completo','a013_numero_contrato')

        )
        ->addColumn('action', function ($row) use ($edit,$delete) {
            $acoes = "";
            if($edit){
                $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Compromisso"  href="/compromisso_financeiro/'.$row->a022_id_compromisso.'/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
            }

            if($delete){
                $acoes .= '<form method="POST" action="/compromisso_financeiro/'.$row->a022_id_compromisso.'" style="display:inline">
                    <input name="_method" value="DELETE" type="hidden">
                    '. csrf_field() .'
                    <button type="button" class="btn btn-xs btn-danger" title="Excluir Compromisso" onclick="ConfirmaExcluir(\'Confirma Excluir Compromisso?\',this)">
                       <span class="fa fa-trash"></span>
                    </button>
                </form>';
            }
            return $acoes;
            })
            ->filterColumn('nomeEmpresa', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    $where->orwhere(DB::RAW("concat(ifnull(t005_empresa.a005_nome_fantasia,''),ifnull(t005_empresa.a005_nome_completo,''))"), 'like', '%'.$keyword.'%');
                });
            })
            ->editColumn('a022_status', function ($row) {

                if (isset($row->a022_status)) {
                    if ($row->a022_status == 'A') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;
                    } elseif ($row->a022_status == 'I') {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }elseif ($row->a022_status == 'C') {
                        $labelStatus = '<span class="label label-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Cancelado </span>';
                        return $labelStatus;
                    }
                }
            })
            ->filterColumn('a022_status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Ativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a022_status', 'A');
                    }
                    if (strpos(strtoupper('Inativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a022_status', 'I');
                    }
                    if (strpos(strtoupper('Cancelado'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a022_status', 'C');
                    }
                });
            })

            ->editColumn('a022_data_vencimento',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->a022_data_vencimento)->format('d/m/Y');
            })
            ->filterColumn('nomeCliFor', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    $where->orwhere(DB::RAW("concat(ifnull(t005_empresaCliFor.a005_nome_fantasia,''),ifnull(t005_empresaCliFor.a005_nome_completo,''))"), 'like', '%'.$keyword.'%');
                });
            })
            ->editColumn('a022_valor_pagar', function ($row) {
                if (isset($row->a022_valor_pagar)) {
                    return $this->converteMoney($row->a022_valor_pagar);
                } else {
                    return "";
                }

            })
            ->editColumn('a022_valor_pago', function ($row) {
                if (isset($row->a022_valor_pago)) {
                    return $this->converteMoney($row->a022_valor_pago);
                } else {
                    return "";
                }

            })
        ->escapeColumns(['*'])
        ->make(true);
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

    public function index(Request $request)
    {
        $comboEmpresa = $this->optionEmpresa();

        return view('sistema.compromisso_financeiro.index', compact('comboEmpresa'));
    }

    public function create()
    {
        $empresaDono = $this->idsEmpresaDonoCadastro();
        $comboEmpresa = $this->optionEmpresa(0);
        $comboCategoria_contrato = $this->optionCategoria_contrato();

        $idEmpresa = 0;
        if((count($comboEmpresa)??0)==1){
            $comboEmpresa->map(function($row,$key) use(&$idEmpresa){
                $idEmpresa = $key;
            });
        }

		$comboContrato = $this->optionContrato($empresaDono);
		$comboClassificacao = $this->optionClassificacao();
		$comboStatus = $this->optionStatus();
        $comboEmpresaClieFor = $this->optionEmpresaCliFor($idEmpresa,'CF');

        return view('sistema.compromisso_financeiro.create', compact('comboCategoria_contrato', 'comboEmpresa','comboContrato','comboClassificacao','comboStatus','comboEmpresaClieFor'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'a005_id_empresa' => 'required',
			'a005_id_empresa_cli_for' => 'required',
			'a022_classificacao' => 'required',
			'a022_finalidade' => 'required',
			'a022_data_vencimento' => 'required',
			'a022_valor_pagar' => 'required',
            'a022_status' => 'required'
		]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a022_uso_vital'] = $requestData['a022_uso_vital']??0;
        $requestData['a022_valor_pagar'] = $this->converteDecimalDB($requestData['a022_valor_pagar']);
        $requestData['a022_categorias'] = json_encode($requestData['a022_categorias']);
        $requestData['a022_tipo'] = 1;

        if(isset($requestData['a022_valor_pago']))
            $requestData['a022_valor_pago'] = $this->converteDecimalDB($requestData['a022_valor_pago']);
        $requestData['a022_data_vencimento'] = Carbon::createFromFormat('d/m/Y',$requestData['a022_data_vencimento'])->format('Y-m-d');
        if(isset($requestData["a022_data_pagamento"]))
            $requestData['a022_data_pagamento'] = Carbon::createFromFormat('d/m/Y',$requestData['a022_data_pagamento'])->format('Y-m-d');



        DB::beginTransaction();
        try {

            $compromisso = Compromisso::create($requestData);

            $this->salvaUploadArquivo($request, $compromisso, $requestData);

            $this->envia_email_notificacao($compromisso,$requestData);


            Session::flash('flash_message', 'Compromisso adicionado!');
            DB::commit();
            return redirect('compromisso_financeiro');

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível adicionar o Compromisso!');
            return redirect('compromisso_financeiro');
        }
    }

    public function edit($id)
    {
        $compromisso = Compromisso::with('Contrato_belongsTo', 'Empresa_Cli_For_belongsTo')->where('a022_id_compromisso', $id)->first();
        $empresaDono = $this->idsEmpresaDonoCadastro();
        $compromisso->empresa = $compromisso->Empresa_Cli_For_belongsTo->a005_nome_fantasia ?? $compromisso->Empresa_Cli_For_belongsTo->a005_razao_social ?? $compromisso->Empresa_Cli_For_belongsTo->a005_nome_completo;

        $this->validaAcessoEdit($compromisso->a005_id_empresa, 'empresa',$compromisso->a005_id_empresa_cli_for);

        $readonly = "";
        $required = "";
        $idEmpresa = 0;
        if(!in_array($compromisso->a005_id_empresa, $empresaDono, true))
        {
            $readonly = "readonly";
            $required = "required";
            $idEmpresa = $compromisso->a005_id_empresa;
        }

        $comboEmpresa = $this->optionEmpresa($idEmpresa);
		$comboContrato = $this->optionContrato($empresaDono);
		$comboClassificacao = $this->optionClassificacao();
		$comboStatus = $this->optionStatus();
        $comboEmpresaClieFor = $this->optionEmpresaCliFor($compromisso->a005_id_empresa,'CF');
        $comboCategoria_contrato = $this->optionCategoria_contrato();

        $compromisso->a022_data_vencimento = Carbon::createFromFormat('Y-m-d',$compromisso->a022_data_vencimento)->format('d/m/Y');
        if($compromisso->a022_data_pagamento != null) {
            $compromisso->a022_data_pagamento = Carbon::createFromFormat('Y-m-d', $compromisso->a022_data_pagamento)->format('d/m/Y');
        }

        $arquivos = Compromisso_upload::query()
            ->where('a022_id_compromisso',$compromisso->a022_id_compromisso)
            ->get();

        return view('sistema.compromisso_financeiro.edit', compact('comboCategoria_contrato','compromisso','comboEmpresa','comboContrato','comboClassificacao','comboStatus','comboEmpresaClieFor','arquivos','readonly', 'required'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'a005_id_empresa' => 'required',
			'a005_id_empresa_cli_for' => 'required',
			'a022_classificacao' => 'required',
			'a022_finalidade' => 'required',
			'a022_data_vencimento' => 'required',
			'a022_valor_pagar' => 'required',
			'a022_status' => 'required'
		]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a022_uso_vital'] = $requestData['a022_uso_vital']??0;
        $requestData['a022_valor_pagar'] = $this->converteDecimalDB($requestData['a022_valor_pagar']);
        $requestData['a022_categorias'] = json_encode($request->a022_categorias);
        if(isset($requestData['a022_valor_pago']))
            $requestData['a022_valor_pago'] = $this->converteDecimalDB($requestData['a022_valor_pago']);
        $requestData['a022_data_vencimento'] = Carbon::createFromFormat('d/m/Y',$requestData['a022_data_vencimento'])->format('Y-m-d');
        if(isset($requestData["a022_data_pagamento"]))
            $requestData['a022_data_pagamento'] = Carbon::createFromFormat('d/m/Y',$requestData['a022_data_pagamento'])->format('Y-m-d');



        DB::beginTransaction();
        try {

            $compromisso = Compromisso::findOrFail($id);
            $compromisso->update($requestData);

            $this->salvaUploadArquivo($request, $compromisso, $requestData);

            Session::flash('flash_message', 'Compromisso atualizado!');
            DB::commit();
            return redirect('compromisso_financeiro');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Não foi possível atualizar o Compromisso!');
            return redirect('compromisso_financeiro');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Compromisso::findOrFail($id)->delete();

            Session::flash('flash_message', 'Compromisso excluído!');
            DB::commit();
            return redirect('compromisso_financeiro');

        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Compromisso!');
            return redirect('compromisso_financeiro');
        }
    }

    public function carregaOptionsEmpresaCompromisso(Request $request)
    {
        $requestData = $request->all();
        $idEmpresa = $requestData["idEmpresa"];
        $idContrato = $requestData["idContrato"]??0;
        $multi_select = $requestData["ind_multi_select"]??"1";


        $comboEmpresaFor = $this->optionEmpresaCliFor($idEmpresa, 'CF',$idContrato);
        $comboContrato = $this->optionContrato([$idEmpresa]);

        //dump($comboContrato);

        if($multi_select=="1") {
            unset($comboEmpresaFor['']);
        }

        $retorno = json_encode([
            'comboEmpresaFor'=>$comboEmpresaFor,
            'comboContrato'=>$comboContrato
        ]);

        return $retorno;
    }

    private function optionEmpresa($idEmpresa = 0)
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where('a005_status', 1)
            ->where('a005_ind_empresa', 1)
            ->where(function($where) use ($idEmpresa){
                if(Auth::user()->ind_super_adm<=0) {
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
            })
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"))
            ->orderByRaw("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,''))")
            ->pluck('nome','t005_empresa.a005_id_empresa');

        if((count($ret)>1) || ($idEmpresa != 0))
        {
            $ret->prepend('','');
        }
        return $ret;
    }
    private function optionEmpresaCliFor($idEmpresa = 0, $tipo = '', $idContrato=0)
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->leftJoin('t013_contrato','t013_contrato.a005_id_empresa_cli_for','=','t005_empresa.a005_id_empresa')
            ->where(function($where){
                $where->orwhere('a005_ind_cliente', '1')->orwhere('a005_ind_fornecedor', '1');
            })
            ->where(function($where) use ($tipo){
                if ($tipo == "C")
                    $where->orwhere('a005_ind_cliente', 1);
                elseif ($tipo == "F")
                    $where->orwhere('a005_ind_fornecedor', 1);
                elseif ($tipo == "CF") {
                    $where->orwhere('a005_ind_cliente', 1);
                    $where->orwhere('a005_ind_fornecedor', 1);
                }

            })
            ->where('a005_status', 1)
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                }
            })
            ->where(function($where) use($idContrato){
                if($idContrato>0) {
                    $where->where('t013_contrato.a013_id_contrato', '=', $idContrato);
                }
            })

            ->orderByRaw("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) asc")

            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')

            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            //->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"))
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,''),case when a005_ind_cliente = 1 then case when a005_ind_fornecedor = 1 then ' (Cliente/Fornecedor)' else ' (Cliente)' end else case when a005_ind_fornecedor = 1 then ' (Fornecedor)' else '' end end) as nome"))
            ->orderByRaw("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,''))")
            ->pluck('nome','t005_empresa.a005_id_empresa');
        //->get();

        //dd($ret);
        if(count($ret)>1)
        {
            $ret->prepend('','');
        }
        return $ret;
    }


    private function optionContrato($empresaDono = [0])
    {


        $ret = Contrato::query()
            ->where('a013_status', 'A')
            ->wherein('a005_id_empresa', $empresaDono)
            ->pluck('a013_numero_contrato','a013_id_contrato')->prepend('','');
        return $ret;
    }
    private function optionClassificacao()
    {
        $ret = [''=>'','P'=>'Produto','S'=>'Serviço'];
        return $ret;
    }
    private function optionStatus()
    {
        $ret = [''=>'','A'=>'Ativo','I'=>'Inativo'];
        return $ret;
    }


    private function envia_email_notificacao($compromisso,$requestData)
    {
        $id_compromisso = $compromisso->a022_id_compromisso;
        $id_empresa = $requestData["a005_id_empresa"]??0;
        $id_empresa_cli_for = $requestData["a005_id_empresa_cli_for"]??0;

        $empresa = Empresa::query()->find($id_empresa);
        $cli_for = Empresa::query()->find($id_empresa_cli_for);
        $parametro = Parametro::query()->where('a000_sigla','TEXTOCOMPROMISSO')->first();

        $parametrosView['mensagem'] = $parametro->a000_valor;
        $assunto = 'Compromisso '.$id_compromisso;

        $empresaUsuario = Empresa_usuario::query()
            ->join('t001_usuario','t001_usuario.a001_id_usuario','=','t004_empresa_usuario.a001_id_usuario')
            ->where('a005_id_empresa', $empresa->a005_id_empresa)
            ->where('a004_dono_cadastro',1)
            ->select('t001_usuario.a001_id_usuario','a001_email')->groupBy('t001_usuario.a001_id_usuario','a001_email')
            ->get();

        $empresaUsuario->map(function($row)use($parametrosView, $assunto){
            $this->notificacaoPadrao(0, $row->a001_id_usuario, $assunto, $parametrosView['mensagem'], 0, 'compromisso');

            $this->enviaEmailPadraoView('sistema.email.aviso',$parametrosView,'Dealix','naoresponda@dealix.com.br'
                ,$row->a001_email,$row->a001_email,$assunto??'Compromisso');
        });

        $cli_forUsuario = Empresa_usuario::query()
            ->join('t001_usuario','t001_usuario.a001_id_usuario','=','t004_empresa_usuario.a001_id_usuario')
            ->where('a005_id_empresa', $cli_for->a005_id_empresa)
            ->where('a004_dono_cadastro',1)
            ->select('t001_usuario.a001_id_usuario','a001_email')->groupBy('t001_usuario.a001_id_usuario','a001_email')
            ->get();

        $cli_forUsuario->map(function($row)use($parametrosView, $assunto){
            $this->notificacaoPadrao(0, $row->a001_id_usuario, $assunto, $parametrosView['mensagem'], 0, 'compromisso');

            $this->enviaEmailPadraoView('sistema.email.aviso',$parametrosView,'Dealix','naoresponda@dealix.com.br'
                ,$row->a001_email,$row->a001_email,$assunto??'Compromisso');
        });

    }

    private function salvaUploadArquivo($request, $compromisso, $requestData)
    {

        /////////////////////////////////////////////////////////////////////
        //fazer o each dos id dos hidden da tela e pegar as url que estao salvas e Excluir os arquivos e o registro
        $deleteArquivos = Compromisso_upload::query()
            ->where('a022_id_compromisso',$compromisso->a022_id_compromisso)
            ->whereNotIn('a023_url',$request->a023_url??[''])
            ->get();

        //Storage::disk('public')->delete("/uploads/compromisso/U1ELlEE2zCVk.PNG");
        foreach ($deleteArquivos as $item) {
            //deleta o arquivo fisico
            Storage::disk('public')->delete($compromisso->a023_url??"");
            //deleta registro banco;
            $item->delete();
        }

        //upload de arquivos
        if($request->hasFile('a023_upload')) {
            $arquivos = $request->file('a023_upload');
            $contador = 0;
            foreach ($arquivos as $arquivo) {
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/compromisso', $fileName, 'public');

                $uploadSave = new Compromisso_upload();
                $uploadSave->a023_url = '/uploads/compromisso/' . $fileName;
                $uploadSave->a023_descricao = $requestData["a023_descricao"][$contador];
                $uploadSave->a022_id_compromisso = $compromisso->a022_id_compromisso;
                $uploadSave->created_at_user = Auth::user()->id;
                $uploadSave->updated_at_user = Auth::user()->id;
                $uploadSave->save();
                $contador++;
            }
        }
        /////////////////////////////////////////////////////////////////////
    }

    public function relatorio(Request $request)
    {
        $comboEmpresa = $this->optionEmpresa();
        $comboEmpresaFor = $this->optionEmpresaCliFor(0, 'CF');
        $comboClassificacao = $this->optionClassificacao();

        unset($comboEmpresa['']);
        unset($comboEmpresaFor['']);

        return view('sistema.compromisso_financeiro.relatorio', compact('comboEmpresa','comboClassificacao','comboEmpresaFor'));
    }

    public function relatoriodatatable(Request $request)
    {
        $Classificacao = $this->optionClassificacao();
        $requestData = $request->all();

       // $uploads = Compromisso_upload::query()->get();

        return Datatables::of(
            Compromisso::query()
                ->leftJoin('t023_compromisso_upload','t023_compromisso_upload.a022_id_compromisso','=','t022_compromisso.a022_id_compromisso')
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't022_compromisso.a005_id_empresa')
                ->leftjoin('t005_empresa', 't022_compromisso.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->leftjoin('t013_contrato', 't013_contrato.a013_id_contrato', '=', 't022_compromisso.a013_id_contrato')
                ->leftjoin('t005_empresa as t005_empresaCliFor', 't022_compromisso.a005_id_empresa_cli_for', '=', 't005_empresaCliFor.a005_id_empresa')
                ->where(function($where) use ($request){

                    if(Auth::user()->ind_super_adm<=0) {
                        $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                        $where->where('a004_dono_cadastro', 1);
                    }
                    if(($request->a005_id_empresa??"") != "") {
                        //$where->where('t022_compromisso.a005_id_empresa', '=', $request->a005_id_empresa);
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

                    if(($request->a005_id_empresa_for??"") != "") {
                        //$where->where('t022_compromisso.a005_id_empresa_cli_for', '=', $request->a005_id_empresa_for);
                        if(is_array($request->a005_id_empresa_for) ){
                            if($request->a005_id_empresa_for[0] != '0')
                                $where->wherein('t013_contrato.a005_id_empresa_cli_for', $request->a005_id_empresa_for);
                        }
                        else {
                            if($request->a005_id_empresa_for != "") {
                                $where->where('t013_contrato.a005_id_empresa_cli_for', $request->a005_id_empresa_for);
                            }
                        }
                    }

                    if(($request->a022_classificacao??"") != "") {
                        $where->where('t022_compromisso.a022_classificacao', '=', $request->a022_classificacao);
                    }

                    if(($request->a022_data_vencimento_de??"") != "") {
                        $request->a022_data_vencimento_de = Carbon::createFromFormat('d/m/Y',$request->a022_data_vencimento_de)->format('Y-m-d');
                        $where->where('t022_compromisso.a022_data_vencimento', '>=', $request->a022_data_vencimento_de);
                    }
                    if(($request->a022_data_vencimento_ate??"") != "") {
                        $request->a022_data_vencimento_ate = Carbon::createFromFormat('d/m/Y',$request->a022_data_vencimento_ate)->format('Y-m-d');
                        $where->where('t022_compromisso.a022_data_vencimento', '<=', $request->a022_data_vencimento_ate);
                    }

                    if(($request->a022_data_pagamento_de??"") != "") {
                        $request->a022_data_pagamento_de = Carbon::createFromFormat('d/m/Y',$request->a022_data_pagamento_de)->format('Y-m-d');
                        $where->where('t022_compromisso.a022_data_pagamento', '>=', $request->a022_data_pagamento_de);
                    }
                    if(($request->a022_data_pagamento_ate??"") != "") {
                        $request->a022_data_pagamento_ate = Carbon::createFromFormat('d/m/Y',$request->a022_data_pagamento_ate)->format('Y-m-d');
                        $where->where('t022_compromisso.a022_data_pagamento', '<=', $request->a022_data_pagamento_ate);
                    }


                    if(($request->a022_valor_pago_de??"") != "") {
                        $where->where('t022_compromisso.a022_valor_pago', '>=', $this->converteDecimalDB($request->a022_valor_pago_de));
                    }

                    if($request->a022_valor_pago_ate??"" != "") {
                        $where->where('t022_compromisso.a022_valor_pago', '<=', $this->converteDecimalDB($request->a022_valor_pago_ate));
                    }

                })
                ->select('t022_compromisso.a022_id_compromisso','t022_compromisso.a005_id_empresa','t022_compromisso.a013_id_contrato','t022_compromisso.a005_id_empresa_cli_for','a022_classificacao','a022_finalidade','a022_data_vencimento','a022_valor_pagar','a022_uso_vital','a022_data_pagamento','a022_valor_pago','a022_forma_pagamento','a022_status')
                ->addSelect('a013_numero_contrato')
                ->addSelect(DB::RAW("concat(ifnull(t005_empresa.a005_nome_fantasia,''),ifnull(t005_empresa.a005_nome_completo,'')) as nomeEmpresa"))
                ->addSelect(DB::RAW("concat(ifnull(t005_empresaCliFor.a005_nome_fantasia,''),ifnull(t005_empresaCliFor.a005_nome_completo,'')) as nomeCliFor"))
                ->addSelect(DB::RAW('GROUP_CONCAT(concat("http://'.$_SERVER["HTTP_HOST"].'/storage",a023_url)) as arquivos'))
                ->groupBy('t022_compromisso.a022_id_compromisso','t022_compromisso.a005_id_empresa','t022_compromisso.a013_id_contrato','t022_compromisso.a005_id_empresa_cli_for','a022_classificacao','a022_finalidade','a022_data_vencimento','a022_valor_pagar','a022_uso_vital','a022_data_pagamento','a022_valor_pago','a022_forma_pagamento','a022_status'
                ,'a013_numero_contrato'
                    ,'t005_empresa.a005_nome_fantasia','t005_empresa.a005_nome_completo','t005_empresaCliFor.a005_nome_fantasia','t005_empresaCliFor.a005_nome_completo')
        )

            ->editColumn('a022_uso_vital', function ($row) {

                if (isset($row->a022_uso_vital)) {
                    if ($row->a022_uso_vital == 1) {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Sim </span>';
                        return $labelStatus;

                    } else{
                        $labelStatus = '<span class="label label-default"><i class="glyphicon glyphicon-remove"></i> &ensp;Não </span>';
                        return $labelStatus;
                    }
                }
            })

            ->editColumn('a022_status', function ($row) {

                if (isset($row->a022_status)) {
                    if ($row->a022_status == 'A') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;

                    } elseif ($row->a022_status == 'D') {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }elseif ($row->a022_status == 'C') {
                        $labelStatus = '<span class="label label-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Cancelado </span>';
                        return $labelStatus;
                    }
                }
            })

            ->editColumn('a022_forma_pagamento', function ($row) {
                return $row->a022_forma_pagamento??"";
            })
            ->addColumn('classificacao', function ($row) use ($Classificacao) {
                return $Classificacao[$row->a022_classificacao];
            })

            ->editColumn('arquivos', function ($row) {
                return $row->arquivos;
            })

            ->editColumn('a022_data_vencimento',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->a022_data_vencimento)->format('d/m/Y');
            })
            ->editColumn('a022_data_pagamento',function($row){
                if(($row->a022_data_pagamento??"")!="")
                    return Carbon::createFromFormat('Y-m-d',$row->a022_data_pagamento)->format('d/m/Y');
                else
                    return "";
            })

            ->editColumn('a022_valor_pagar',function($row){
                return $this->converteMoney($row->a022_valor_pagar);
            })

            ->editColumn('a022_valor_pago',function($row){
                if(($row->a022_valor_pago??"")!="")
                    return $this->converteMoney($row->a022_valor_pago);
                else
                    return "&ensp;";
            })

            ->escapeColumns(['*'])
            ->make(true);
    }

}
