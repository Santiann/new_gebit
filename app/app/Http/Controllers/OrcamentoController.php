<?php

namespace App\Http\Controllers;

use App\Cotacao_fornecedor;
use App\Cotacao_log;
use App\Cotacao_upload;
use App\Empresa;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
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

class OrcamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:orcamento-show|orcamento-create|orcamento-edit|orcamento-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('orcamento-edit');

        return Datatables::of(

            Empresa::query()
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->join('t020_cotacao_fornecedor','t020_cotacao_fornecedor.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->join('t018_cotacao','t018_cotacao.a018_id_contacao', '=', 't020_cotacao_fornecedor.a018_id_contacao')
                ->join('t005_empresa as empresaSolicitou', 'empresaSolicitou.a005_id_empresa', '=', 't018_cotacao.a005_id_empresa')
                ->where(function($where){
                    if(Auth::user()->ind_super_adm<=0) {
                        $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                        $where->where('t004_empresa_usuario.a004_dono_cadastro', 1);
                    }
                })


                ->select('t018_cotacao.a018_id_contacao','t005_empresa.a005_id_empresa','a018_o_que','a018_descricao','a018_porque','a018_para_quem','a018_data_prevista','a018_entrega','a018_forma_pagamento','a018_onde','a018_notificar','a018_status','a020_status')
                ->addSelect(DB::RAW("concat(ifnull(t005_empresa.a005_nome_fantasia,''),ifnull(t005_empresa.a005_nome_completo,'')) as nomeEmpresa"))
                ->addSelect(DB::RAW("concat(ifnull(empresaSolicitou.a005_nome_fantasia,''),ifnull(empresaSolicitou.a005_nome_completo,'')) as nomeCliFor"))
                ->groupBy('t018_cotacao.a018_id_contacao','t005_empresa.a005_id_empresa','a018_o_que','a018_descricao','a018_porque','a018_para_quem','a018_data_prevista','a018_entrega','a018_forma_pagamento','a018_onde','a018_notificar','a018_status','empresaSolicitou.a005_nome_fantasia','empresaSolicitou.a005_nome_completo','t005_empresa.a005_nome_fantasia','t005_empresa.a005_nome_completo','a020_status')
        )
        ->addColumn('action', function ($row) use ($edit) {
            $acoes = "";
            if($edit){
                //$acoes .= '<a class="btn btn-xs btn-primary" href="/orcamento/'.$row->a018_id_contacao.'/edit" ><span class="fa fa-edit " aria-hidden="true"></span></a> ';
                $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Orçamento" href="/orcamento/'.$row->a018_id_contacao.'/'.$row->a005_id_empresa.'" ><span class="fa fa-calculator" aria-hidden="true"></span></a> ';
            }
            return $acoes;
        })

            ->filterColumn('nomeEmpresa', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    $where->orwhere(DB::RAW("concat(ifnull(t005_empresa.a005_nome_fantasia,''),ifnull(t005_empresa.a005_nome_completo,''))"), 'like', '%'.$keyword.'%');
                });
            })
            ->filterColumn('nomeCliFor', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    $where->orwhere(DB::RAW("concat(ifnull(empresaSolicitou.a005_nome_fantasia,''),ifnull(empresaSolicitou.a005_nome_completo,''))"), 'like', '%'.$keyword.'%');
                });
            })
            ->editColumn('a020_status', function ($row) {

                if (isset($row->a020_status)) {
                    if ($row->a020_status == 'O') {
                        $labelStatus = '<span class="label bg-info"><i class="glyphicon glyphicon-ok"></i> &ensp;Orçamento </span>';
                        return $labelStatus;
                    } elseif ($row->a020_status == 'A') {
                        $labelStatus = '<span class="label bg-orange"><i class="glyphicon glyphicon-ok"></i> &ensp;Aprovação </span>';
                        return $labelStatus;
                    }elseif ($row->a020_status == 'E') {
                        $labelStatus = '<span class="label bg-warning"><i class="glyphicon glyphicon-ok"></i> &ensp;Aguardando Entrega </span>';
                        return $labelStatus;
                    }elseif ($row->a020_status == 'F') {
                        $labelStatus = '<span class="label bg-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Finalizado </span>';
                        return $labelStatus;
                    }elseif ($row->a020_status == 'S') {
                        $labelStatus = '<span class="label bg-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Sem Aprovacao </span>';
                        return $labelStatus;
                    }elseif ($row->a020_status == 'C') {
                        $labelStatus = '<span class="label bg-danger"><i class="glyphicon glyphicon-remove"></i> &ensp;Cancelado </span>';
                        return $labelStatus;
                    }
                }
                else{
                    $labelStatus = '<span class="label bg-info"><i class="glyphicon glyphicon-ok"></i> &ensp;Orçamento </span>';
                    return $labelStatus;
                }
            })
            ->filterColumn('a020_status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Orçamento'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a020_status', 'O');
                    }
                    if (strpos(strtoupper('Aprovação'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a018_status', 'A');
                    }
                    if (strpos(strtoupper('Aguardando Entrega'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a020_status', 'E');
                    }
                    if (strpos(strtoupper('Sem Aprovação'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a020_status', 'S');
                    }
                    if (strpos(strtoupper('Finalizado'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a020_status', 'F');
                    }
                    if (strpos(strtoupper('Cancelado'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a020_status', 'C');
                    }
                });
            })
            ->addColumn('a018_data_prevista',function($row){
                return Carbon::createFromFormat('Y-m-d',$row->a018_data_prevista)->format('d/m/Y');
            })
        ->escapeColumns(['*'])
        ->make(true);
    }

    public function index(Request $request)
    {
        return view('sistema.orcamento.index');
    }

    public function orcar($id, $idEmpresa)
    {
        $cotacao = Cotacao::findOrFail($id);
        $comboUsuario = $this->optionTodosUsuario();

        $this->validaAcessoEdit($idEmpresa, 'empresa');


        $comboStatus = $this->optionStatus();
        $comboEmpresa = $this->optionEmpresa($idEmpresa);
        $comboFornecedor = $this->optionFornecedor();
        $fornecedor = $this->Fornecedor();
        $arquivos = Cotacao_upload::query()
            ->where('a018_id_contacao',$cotacao->a018_id_contacao)
            ->get();

        $fornecedorList = Cotacao_fornecedor::query()
            ->where("a005_id_empresa",$idEmpresa)
            ->where("a018_id_contacao",$cotacao->a018_id_contacao)
            ->first();

        $cotacao->a018_data_prevista = Carbon::createFromFormat('Y-m-d',$cotacao->a018_data_prevista)->format('d/m/Y');
        if(isset($fornecedorList->a020_data_entrega)) {
            $cotacao->a020_data_entrega = Carbon::createFromFormat('Y-m-d', $fornecedorList->a020_data_entrega)->format('d/m/Y');
        }
        $cotacao->a020_valor = $fornecedorList->a020_valor;
        $cotacao->a020_obs = $fornecedorList->a020_obs;
        $cotacao->a020_status = $fornecedorList->a020_status;

        $columnsHistorico = $cotacao->getColumn();

        $historico = Cotacao_log::query()
            ->where('a018_id_contacao',$id)
            ->get();

        $attributes = $cotacao->getAliases();



        return view('sistema.orcamento.edit', compact('cotacao','comboStatus','comboEmpresa','arquivos', 'comboFornecedor', 'fornecedor', 'fornecedorList','columnsHistorico','historico','attributes','comboUsuario'));
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
        $requestData['a020_data_entrega'] = Carbon::createFromFormat('d/m/Y',$requestData['a020_data_entrega'])->format('Y-m-d');
        $requestData["a020_valor"] = $this->converteDecimalDB($requestData["a020_valor"]);
        $requestData['a018_status'] = "A";
        $requestData['a020_status'] = "A";

        //dump($id,$requestData);
        //dd();

        DB::beginTransaction();
        try {

            $cotacao = Cotacao::findOrFail($id);
            $cotacao->a018_status = $requestData['a018_status'];
            $cotacao->save();

            $this->salvaUploadArquivo($request, $cotacao, $requestData);

            $this->salvaFornecedores($request, $cotacao, $requestData);

            $this->gravaHistorico($requestData, $cotacao);

            //$this->enviaEmailFornecedores($cotacao->a018_id_contacao, "Nova Cotação Dealix");

            Session::flash('flash_message', 'Cotação atualizada!');
            DB::commit();

            return redirect('orcamento');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Não foi possível atualizar a Cotação!');
            return redirect('orcamento');
        }
    }



    private function salvaFornecedores($request, $cotacao, $requestData)
    {
        //deletando fornecedores
        $cotacaoFornecedor = Cotacao_fornecedor::query()
            ->where("a005_id_empresa",$request["a005_id_empresa"])
            ->where("a018_id_contacao",$cotacao->a018_id_contacao)
            ->first();

        $cotacaoFornecedor->a020_data_entrega = $requestData["a020_data_entrega"];
        $cotacaoFornecedor->a020_valor = $requestData["a020_valor"];
        $cotacaoFornecedor->a020_obs = $requestData["a020_obs"];
        $cotacaoFornecedor->a020_status = $requestData["a020_status"];
        $cotacaoFornecedor->save();

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

    private function optionEmpresa($idEmpresa=0)
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where('a005_status', 1)
            ->where('a005_ind_fornecedor', 1)
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    $where->where('t004_empresa_usuario.a004_dono_cadastro', '=', 1);
                }
            })
            ->where('t005_empresa.a005_id_empresa',$idEmpresa)
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

    private function optionFornecedor($idEmpresa=0)
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
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                }
            })
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"))
            ->get();

        return $ret;
    }

    public function gravaHistorico($requestData, $cotacao)
    {
        $columns = collect($cotacao->getColumn());

        $a018_id_contacao = $cotacao->a018_id_contacao;

        $values = $columns->map(function($row,$val) use($requestData, $cotacao){
            return $requestData[$row]??null;;
        });
        $resultCollection = $columns->combine($values);


        $Cotacao_fornecedor = Cotacao_fornecedor::query()->where('a018_id_contacao',$a018_id_contacao)
            ->where('a005_id_empresa',$requestData["a005_id_empresa"])
            ->get();

        $fornec = $this->optionEmpresa($requestData["a005_id_empresa"]);
        $jsonDocs = "";
        $contador = 0;

        $Cotacao_fornecedor->map(function($row) use(&$jsonDocs, &$contador, $fornec){
            $contador++;

            $colunas = $row->getColumn();
            $aliascolunas = $row->getAliases();
            $ret = $contador."- ";

            //dump($colunas,$aliascolunas,$row,$ret,$fornec);
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

        $Cotacao_upload = Cotacao_upload::query()->where('a018_id_contacao',$a018_id_contacao)->get();

        $jsonDocs = "";
        $contador = 0;
        $Cotacao_upload->map(function($row) use(&$jsonDocs, &$contador){
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
        $hist->a001_id_usuario = Auth::user()->a001_id_usuario;
        $hist->created_at_user = Auth::user()->id;
        $hist->updated_at_user = Auth::user()->id;
        $hist->a021_log = $json;
        $hist->save();

    }

    protected  function enviaEmailFornecedores($idCotacao, $assunto)
    {
        $parametro = Parametro::query()
            ->where('a000_sigla','TEXTOCOTACAO')
            ->first();

        $cotacao = Cotacao::query()->where('a018_id_contacao',$idCotacao)->firstOrFail();
        $cotacaoFornc = Cotacao_fornecedor::query()->where('a018_id_contacao',$idCotacao)->get();

        //envia email de para os forecedores
        $parametrosView['mensagem'] = $parametro->a000_valor;
        $this->enviaEmailPadraoView('sistema.email.aviso'
            ,$parametrosView
            ,'Dealix'
            ,'naoresponda@Dealix.com.br'
            ,$cotacao->a018_notificar
            ,$cotacao->a018_notificar
            ,$assunto??'Nova Cotação Dealix');

        $cotacaoFornc->map(function($value) use($parametrosView){
            $this->enviaEmailPadraoView('sistema.email.aviso'
                ,$parametrosView
                ,'Dealix'
                ,'naoresponda@Dealix.com.br'
                ,$value->a020_email_outro_fornecedor
                ,$value->a020_email_outro_fornecedor
                ,$assunto??'Nova Cotação Dealix');
        });

    }

}
