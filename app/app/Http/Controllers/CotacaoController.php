<?php

namespace App\Http\Controllers;

use App\Cotacao_fornecedor;
use App\Cotacao_log;
use App\Cotacao_upload;
use App\Empresa;
use App\Empresa_usuario;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use App\Parametro;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Cotacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class CotacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:cotacao-show|cotacao-create|cotacao-edit|cotacao-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('cotacao-edit');
        $delete = Entrust::can('cotacao-delete');

        return Datatables::of(
            Cotacao::query()
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't018_cotacao.a005_id_empresa')
                ->leftjoin('t005_empresa', 't018_cotacao.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->leftjoin('t020_cotacao_fornecedor', 't018_cotacao.a018_id_contacao', '=', 't020_cotacao_fornecedor.a018_id_contacao')
                //->leftjoin('t005_empresa as empresaForn', 'empresaForn.a005_id_empresa', '=', 't020_cotacao_fornecedor.a005_id_empresa')
                ->where(function($where){
                    if(Auth::user()->ind_super_adm<=0)
                        $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                })
                ->select('t018_cotacao.a018_id_contacao','t018_cotacao.a005_id_empresa','a018_o_que','a018_descricao','a018_porque','a018_para_quem','a018_data_prevista','a018_entrega','a018_forma_pagamento','a018_onde','a018_notificar','a018_status')
                ->addSelect(DB::RAW("ifnull(t005_empresa.a005_nome_fantasia,ifnull(t005_empresa.a005_nome_completo,'')) as nomeEmpresa"))
                //->addSelect(DB::RAW("concat(ifnull(empresaForn.a005_nome_fantasia,''),ifnull(empresaForn.a005_nome_completo,'')) as nomeCliFor"))
                ->groupBy('t018_cotacao.a018_id_contacao','t018_cotacao.a005_id_empresa','a018_o_que','a018_descricao','a018_porque','a018_para_quem','a018_data_prevista','a018_entrega','a018_forma_pagamento','a018_onde','a018_notificar','a018_status'/*,'empresaForn.a005_nome_fantasia','empresaForn.a005_nome_completo'*/,'t005_empresa.a005_nome_fantasia','t005_empresa.a005_nome_completo')
        )
        ->addColumn('action', function ($row) use ($edit,$delete) {
            $acoes = "";
            if($edit){
                $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Cotação"  href="/cotacao/'.$row->a018_id_contacao.'/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';

            }
            if($delete){
                $acoes .= '<form method="POST" action="/cotacao/'.$row->a018_id_contacao.'" style="display:inline">
                    <input name="_method" value="DELETE" type="hidden">
                    '. csrf_field() .'
                    <button type="button" class="btn btn-xs btn-danger" title="Excluir Cotação" onclick="ConfirmaExcluir(\'Confirma Excluir Cotacao?\',this)">
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
            ->editColumn('a018_status', function ($row) {

                if (isset($row->a018_status)) {
                    if ($row->a018_status == 'O') {
                        $labelStatus = '<span class="label bg-info"><i class="glyphicon glyphicon-ok"></i> &ensp;Orçamento </span>';
                        return $labelStatus;
                    } elseif ($row->a018_status == 'A') {
                        $labelStatus = '<span class="label bg-orange"><i class="glyphicon glyphicon-ok"></i> &ensp;Aprovação </span>';
                        return $labelStatus;
                    }elseif ($row->a018_status == 'E') {
                        $labelStatus = '<span class="label bg-warning"><i class="glyphicon glyphicon-ok"></i> &ensp;Aguardando Entrega </span>';
                        return $labelStatus;
                    }elseif ($row->a018_status == 'F') {
                        $labelStatus = '<span class="label bg-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Finalizado </span>';
                        return $labelStatus;
                    }elseif ($row->a018_status == 'S') {
                        $labelStatus = '<span class="label bg-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Sem Aprovacao </span>';
                        return $labelStatus;
                    }elseif ($row->a018_status == 'C') {
                        $labelStatus = '<span class="label bg-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Cancelado </span>';
                        return $labelStatus;
                    }
                }
            })
            ->filterColumn('a018_status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Orçamento'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a018_status', 'O');
                    }
                    if (strpos(strtoupper('Aprovação'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a018_status', 'A');
                    }
                    if (strpos(strtoupper('Aguardando Entrega'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a018_status', 'E');
                    }
                    if (strpos(strtoupper('Finalizado'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a018_status', 'F');
                    }
                    if (strpos(strtoupper('Cancelado'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a018_status', 'C');
                    }
                });
            })

            ->orderColumn('a018_status', function ($query, $keyword) {

                $query->orderByRaw("case a018_status when 'O' then 'Orcamento' when 'A' then 'Aprovação' when 'E' then 'Aguardando Entrega' when 'F' then 'Finalizado' when 'S' then 'Sem Aprovacao' when 'C' then 'Cancelado' else '' end ".$keyword);
            })
            ->addColumn('a018_data_prevista',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->a018_data_prevista)->format('d/m/Y');
            })

            ->orderColumn('a018_data_prevista', function ($query, $keyword) {
                //dump($keyword);
                $query->orderByRaw("a018_data_prevista ".$keyword);
            })
        ->escapeColumns(['*'])
        ->make(true);
    }

    public function index(Request $request)
    {
        $comboEmpresa = $this->optionEmpresa();
        return view('sistema.cotacao.index', compact('comboEmpresa'));
    }

    public function create()
    {
        $comboStatus = $this->optionStatus();
        $comboEmpresa = $this->optionEmpresa();
        $comboFornecedor = $this->optionFornecedor();
        $fornecedor = $this->Fornecedor();



        return view('sistema.cotacao.create', compact('comboStatus','comboEmpresa', 'comboFornecedor','fornecedor'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'a005_id_empresa' => 'required',
			'a018_o_que' => 'required',
			'a018_descricao' => 'required',
			'a018_porque' => 'required',
			'a018_para_quem' => 'required',
			'a018_data_prevista' => 'required',
			'a018_entrega' => 'required',
			'a018_forma_pagamento' => 'required',
			'a018_onde' => 'required',
			'a018_notificar' => 'required',
		]);
        $requestData = $request->all();
        $requestData['a018_status'] = $requestData['a018_status']??"O";
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a018_data_prevista'] = Carbon::createFromFormat('d/m/Y',$requestData['a018_data_prevista'])->format('Y-m-d');
        $requestData['a018_data_cotacao'] = Carbon::now()->format('Y-m-d');


        DB::beginTransaction();
        try {

            $cotacao = Cotacao::create($requestData);

            $this->salvaUploadArquivo($request, $cotacao, $requestData);

            $this->salvaFornecedores($request, $cotacao, $requestData);

            $this->gravaHistorico( $cotacao);

            $this->enviaEmailFornecedores($cotacao->a018_id_contacao,'TEXTOCOTACAO', "Criada Cotação Dealix nº: ".$cotacao->a018_id_contacao);



            Session::flash('flash_message', 'Cotação adicionado!');
            DB::commit();
            return redirect('cotacao');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Não foi possível Criar o Cotação!');
            return redirect('cotacao');
        }
    }

    public function show($id)
    {
        $cotacao = Cotacao::findOrFail($id);
        $comboStatus = $this->optionStatus();


        return view('sistema.cotacao.show', compact('cotacao','comboStatus'));
    }

    public function edit($id)
    {
        $cotacao = Cotacao::findOrFail($id);

        $this->validaAcessoEdit($cotacao->a005_id_empresa, 'empresa');

        $comboUsuario = $this->optionTodosUsuario();

        $comboStatus = $this->optionStatus();
        $comboEmpresa = $this->optionEmpresa();
        $comboTodasEmpresaCliFor = $this->optionTodasEmpresaCliFor();
        $comboFornecedor = $this->optionFornecedor();
        $fornecedor = $this->Fornecedor();
        $arquivos = Cotacao_upload::query()
            ->where('a018_id_contacao',$cotacao->a018_id_contacao)
            ->get();


        $fornecedorList = Cotacao_fornecedor::where("a018_id_contacao",$cotacao->a018_id_contacao)->get();

        $fornecedorList->map(function($row) use($comboStatus){
            if(($row->a020_data_entrega??"") != "")
                $row->a020_data_entrega = Carbon::createFromFormat('Y-m-d',$row->a020_data_entrega)->format('d/m/Y');
            if(($row->a020_valor??"") != "")
                $row->a020_valor = $this->converteMoney($row->a020_valor??"");

                $row->a020_status_dsc = $comboStatus[$row->a020_status??"O"];

        });

        $cotacao->a018_data_prevista = Carbon::createFromFormat('Y-m-d',$cotacao->a018_data_prevista)->format('d/m/Y');




        $columnsHistorico = $cotacao->getColumn();

        $historico = Cotacao_log::query()
            ->where('a018_id_contacao',$id)
            ->get();

        $attributes = $cotacao->getAliases();



        return view('sistema.cotacao.edit', compact('cotacao','comboStatus','comboEmpresa','arquivos', 'comboFornecedor', 'fornecedor', 'fornecedorList','columnsHistorico','historico','attributes','comboUsuario','comboTodasEmpresaCliFor'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'a005_id_empresa' => 'required',
			'a018_o_que' => 'required',
			'a018_descricao' => 'required',
			'a018_porque' => 'required',
			'a018_para_quem' => 'required',
			'a018_data_prevista' => 'required',
			'a018_entrega' => 'required',
			'a018_forma_pagamento' => 'required',
			'a018_onde' => 'required',
			'a018_notificar' => 'required',
		]);
        $requestData = $request->all();
        //$requestData['a018_status'] = $requestData['a018_status']??"O";
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a018_data_prevista'] = Carbon::createFromFormat('d/m/Y',$requestData['a018_data_prevista'])->format('Y-m-d');
        //dump($requestData);
        //dd();
        DB::beginTransaction();
        try {

            $cotacao = Cotacao::findOrFail($id);
            $cotacao->update($requestData);

            $this->salvaUploadArquivo($request, $cotacao, $requestData);

            $this->salvaFornecedores($request, $cotacao, $requestData);

            $this->gravaHistorico( $cotacao);

            if($requestData['a018_status'] == "E") {
                $this->enviaEmailFornecedores($cotacao->a018_id_contacao, 'APROVCOTACAO',"Cotação Dealix nº:".$cotacao->a018_id_contacao);
            }
            Session::flash('flash_message', 'Cotação atualizada!');
            DB::commit();

            return redirect('cotacao');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Não foi possível atualizar a Cotação!');
            return redirect('cotacao');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Cotacao_log::query()->where('a018_id_contacao',$id)->delete();
            Cotacao::findOrFail($id)->delete();

            Session::flash('flash_message', 'Cotação excluído!');
            DB::commit();
            return redirect('cotacao');

        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Cotação!');
            return redirect('cotacao');
        }
    }

    private function salvaFornecedores($request, $cotacao, $requestData)
    {
        //deletando fornecedores
        Cotacao_fornecedor::where("a018_id_contacao",$cotacao->a018_id_contacao)->delete();



        //inserindo os fornecedores
        for ($x = 0; $x < count($requestData['a005_id_empresa_for'] ?? []); $x++) {
            $forn = new Cotacao_fornecedor();
            $forn->a018_id_contacao = $cotacao->a018_id_contacao;
            if($requestData["a005_id_empresa_for"][$x] != "0")
                $forn->a005_id_empresa = $requestData["a005_id_empresa_for"][$x];
            $forn->a020_email_outro_fornecedor = $requestData["a020_email_outro_fornecedor"][$x];
            if($requestData["a020_data_entrega"][$x] != "")
                $forn->a020_data_entrega = Carbon::createFromFormat('d/m/Y',$requestData["a020_data_entrega"][$x])->format('Y-m-d');
            if($requestData["a020_valor"][$x] != ""){
                $forn->a020_valor = $this->converteDecimalDB($requestData["a020_valor"][$x]);
                $requestData["a020_status"][$x] = $requestData["a020_status"][$x]=='O'?'A':$requestData["a020_status"][$x];
            }

            $forn->a020_obs = $requestData["a020_obs"][$x];

            $forn->a020_status = $requestData["a020_status"][$x];

            if(($requestData['a018_status']=="F")||($requestData['a018_status']=="C")||($requestData['a018_status']=="S"))
            {
                $forn->a020_status = $requestData["a018_status"];
            }

            $forn->save();
        }
    }

    private function salvaUploadArquivo($request, $cotacao, $requestData)
    {
        //dd();
        /////////////////////////////////////////////////////////////////////
        //fazer o each dos id dos hidden da tela e pegar as url que estao salvas e Excluir os arquivos e o registro
        $deleteArquivos = Cotacao_upload::query()
            ->where('a018_id_contacao',$cotacao->a018_id_contacao)
            ->whereNotIn('a019_url',$request->a019_url??[''])
            ->get();

        //Storage::disk('public')->delete("/uploads/cotacao/U1ELlEE2zCVk.PNG");
        foreach ($deleteArquivos as $item) {
            //deleta o arquivo fisico
            Storage::disk('public')->delete($cotacao->a019_url??"");
            //deleta registro banco;
            $item->delete();
        }

        //upload de arquivos
        if($request->hasFile('a019_upload')) {
            $arquivos = $request->file('a019_upload');
            foreach ($arquivos as $arquivo) {
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/cotacao', $fileName, 'public');
                $requestData['a019_url'] = '/uploads/cotacao/' . $fileName;
                $requestData['a018_id_contacao'] = $cotacao->a018_id_contacao;
                Cotacao_upload::create($requestData);
            }
        }

        /////////////////////////////////////////////////////////////////////
    }

    private function optionStatus()
    {
        $ret = [''=>'','O'=>'Orçamento','A'=>'Aprovação','E'=>'Aguardando Entrega','F'=>'Finalizado','S'=>'Sem Aprovação', 'C'=>'Cancelado'];
        return $ret;
    }

    private function optionEmpresa()
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where('a005_status', 1)
            ->where('a005_ind_empresa', 1)
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    $where->where('t004_empresa_usuario.a004_dono_cadastro', '=', 1);
                }
            })
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"))
            ->pluck('nome','t005_empresa.a005_id_empresa');

        if(count($ret)>1)
        {
            $ret->prepend('','');
        }


        return $ret;
    }

    private function optionTodasEmpresaCliFor()
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"))
            ->pluck('nome','t005_empresa.a005_id_empresa');

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

    private function optionFornecedor()
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where('a005_status', 1)
            ->where('a005_ind_fornecedor', 1)
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                }
            })
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"))
            ->pluck('nome','t005_empresa.a005_id_empresa');

        $ret->prepend('Outro Fornecedor','0');

        if(count($ret)>1)
        {
            $ret->prepend('','');
        }


        return $ret;
    }

    private function Fornecedor()
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where('a005_status', 1)
            ->where('a005_ind_fornecedor', 1)
            ->where(function($where){
                if((Auth::user()->ind_super_adm??1)<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario??0);
                }
            })
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"))
            ->get();

        return $ret;
    }

    public function gravaHistorico( $cotacao)
    {
        $columns = collect($cotacao->getColumn());

        $a018_id_contacao = $cotacao->a018_id_contacao;

        $values = $columns->map(function($row,$val) use($cotacao){
            return $cotacao[$row]??null;;
        });
        $resultCollection = $columns->combine($values);

        $Cotacao_fornecedor = Cotacao_fornecedor::query()->where('a018_id_contacao',$a018_id_contacao)->get();
        $fornec = $this->Fornecedor()->pluck('nome','a005_id_empresa');
        $jsonDocs = "";
        $contador = 0;

        $Cotacao_fornecedor->map(function($row) use(&$jsonDocs, &$contador, $fornec){
            $contador++;

            $colunas = $row->getColumn();
            $aliascolunas = $row->getAliases();
            $ret = $contador."- ";

            collect($colunas)->map(function($coluna) use($aliascolunas,$row,&$ret,$fornec){
                if($coluna == "a005_id_empresa")
                {
                    if(($row[$coluna]??"0") == "0")
                    {
                        $ret .= $aliascolunas[$coluna] . ":" . "Outro Fornecedor" . "; ";
                    }
                    else{
                        $ret .= $aliascolunas[$coluna] . ":" . $fornec[$row[$coluna]] . "; ";
                    }
                }
                else {

                    $ret .= $aliascolunas[$coluna] . ":" . $row[$coluna] . "; ";
                }
            });
            $jsonDocs .= $ret."      ";
        });
        $resultCollection["list_fornecedores"] = $jsonDocs;

        $Cotacao_fornecedor = Cotacao_upload::query()->where('a018_id_contacao',$a018_id_contacao)->get();

        $jsonDocs = "";
        $contador = 0;
        $Cotacao_fornecedor->map(function($row) use(&$jsonDocs, &$contador){
            $contador++;

            $colunas = $row->getColumn();
            $aliascolunas = $row->getAliases();
            $ret = $contador."- ";

            collect($colunas)->map(function($coluna) use($aliascolunas,$row,&$ret){
                $ret .= $aliascolunas[$coluna] .":". $row[$coluna]."; ";
            });
            $jsonDocs .= $ret."      ";
        });
        $resultCollection["list_upload"] = $jsonDocs;

        $json = json_encode($resultCollection);

        $hist = new Cotacao_log();
        $hist->a018_id_contacao = $a018_id_contacao;
        $hist->a021_data_alteracao = Carbon::now();
        $hist->a001_id_usuario = Auth::user()->a001_id_usuario??0;
        $hist->created_at_user = Auth::user()->id??0;
        $hist->updated_at_user = Auth::user()->id??0;
        $hist->a021_log = $json;
        $hist->save();

    }

    protected  function enviaEmailFornecedores($idCotacao, $param, $assunto)
    {
        $parametro = Parametro::query()
            ->where('a000_sigla',$param)
            ->first();

        $cotacao = Cotacao::query()->where('a018_id_contacao',$idCotacao)->firstOrFail();
        $cotacaoFornc = Cotacao_fornecedor::query()->where('a018_id_contacao',$idCotacao)->get();


        //envia email de para os forecedores
        $parametrosView['mensagem'] = $parametro->a000_valor;
        $this->enviaEmailPadraoView('sistema.email.aviso'
            ,$parametrosView
            ,'Dealix'
            ,'naoresponda@dealix.com.br'
            ,$cotacao->a018_notificar
            ,$cotacao->a018_notificar
            ,$assunto??'Cotação Dealix ');

        $cotacaoFornc->map(function($value) use($parametrosView, $assunto){
            $this->enviaEmailPadraoView('sistema.email.aviso'
                ,$parametrosView
                ,'Dealix'
                ,'naoresponda@dealix.com.br'
                ,$value->a020_email_outro_fornecedor
                ,$value->a020_email_outro_fornecedor
                ,$assunto??'Cotação Dealix');

            $empresaUsuario = Empresa_usuario::query()
                ->where('a005_id_empresa', $value->a005_id_empresa)
                ->where('a004_dono_cadastro',1)
                ->select('a001_id_usuario')->groupBy('a001_id_usuario')
                ->get();

            $empresaUsuario->map(function($row)use($parametrosView, $assunto){
                $this->notificacaoPadrao(0, $row->a001_id_usuario, $assunto, $parametrosView['mensagem'], 0, 'cotacao');
            });



        });

        //cria notificação para quem criou a cotação
        $this->notificacaoPadrao(0, Auth::user()->a001_id_usuario, $assunto, $parametrosView['mensagem'], 0, 'cotacao');


    }

}
