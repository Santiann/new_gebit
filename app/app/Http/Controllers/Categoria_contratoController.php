<?php

namespace App\Http\Controllers;

use App\Categoria_contrato_doc;
use App\Empresa;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use Yajra\DataTables\DataTables;

use App\Categoria_contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class Categoria_contratoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:categoria_contrato-show|categoria_contrato-create|categoria_contrato-edit|categoria_contrato-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('categoria_contrato-edit');
        $delete = Entrust::can('categoria_contrato-delete');

        return Datatables::of(
            Categoria_contrato::query()
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't008_categoria_contrato.a005_id_empresa')
                ->join('t005_empresa', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->where(function($where){
                    if(Auth::user()->ind_super_adm<=0) {
                        $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                        $where->where('a004_dono_cadastro', 1);
                    }
                })
                ->select('a008_id_cat_contrato','t008_categoria_contrato.a005_id_empresa','a008_descricao','a008_termo_cancelamento','a008_status')
                ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nomeEmpresa"))
                ->groupBy('a008_id_cat_contrato','t008_categoria_contrato.a005_id_empresa','a008_descricao','a008_termo_cancelamento','a008_status','a005_nome_fantasia','a005_nome_completo')
        )
            ->addColumn('action', function ($row) use ($edit, $delete) {
                $acoes = "";
                if ($edit) {
                    $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Categoria de Contrato" href="/categoria_contrato/' . $row->a008_id_cat_contrato . '/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
                }

                if ($delete) {
                    $acoes .= '<form  method="POST" action="/categoria_contrato/' . $row->a008_id_cat_contrato . '" style="display:inline">
                    <input name="_method" value="DELETE" type="hidden">
                    ' . csrf_field() . '
                    <button type="button" class="btn btn-xs btn-danger" title="Excluir Categoria de Contrato" onclick="ConfirmaExcluir(\'Confirma Excluir Categoria_contrato?\',this)">
                       <span class="fa fa-trash"></span>
                    </button>
                </form>';
                }
                return $acoes;
            })
            ->editColumn('a008_status', function ($status) {

                if (isset($status->a008_status)) {
                    if ($status->a008_status == '1') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;

                    } else {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }
                }
            })
            ->filterColumn('a008_status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Ativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a008_status', '1');
                    }
                    if (strpos(strtoupper('Inativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a008_status', '0');
                    }
                });
            })
            ->filterColumn('nomeEmpresa', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    $where->orwhere(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,''))"), 'like', '%'.$keyword.'%');
                });
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function index(Request $request)
    {
        $comboEmpresa = $this->optionEmpresa();
        return view('sistema.categoria_contrato.index', compact('comboEmpresa'));
    }

    public function create()
    {
        $comboEmpresa = $this->optionEmpresa();
        return view('sistema.categoria_contrato.create', compact( 'comboEmpresa'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'a005_id_empresa' => 'required',
            'a008_descricao' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a008_status'] = $requestData['a008_status']??0;

        DB::beginTransaction();
        try {

            $categoria_contrato = Categoria_contrato::create($requestData);

            $this->gravaDocumento($categoria_contrato->a008_id_cat_contrato, $requestData);

            Session::flash('flash_message', 'Categoria de Contrato adicionado!');
            DB::commit();

            if ($request->expectsJson()) {
                return ['success' => 'true', 'content' => $categoria_contrato];
            }

            return redirect('categoria_contrato');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return ['success' => 'false', 'error' => $e->getMessage()];
            }
            Session::flash('flash_message', 'Não foi possível atualizar o Categoria de Contrato!');
            return redirect('categoria_contrato');
        }
    }

    public function show($id)
    {
        $categoria_contrato = Categoria_contrato::findOrFail($id);
        $comboEmpresa = $this->optionEmpresa();


        return view('sistema.categoria_contrato.show', compact('categoria_contrato', 'comboEmpresa'));
    }

    public function edit($id)
    {
        $categoria_contrato = Categoria_contrato::findOrFail($id);

        $this->validaAcessoEdit($categoria_contrato->a005_id_empresa, 'empresa');

        $comboEmpresa = $this->optionEmpresa();

        $CategoriaDocumentos = Categoria_contrato_doc::query()
            ->leftJoin('t014_contrato_documento','t014_contrato_documento.a009_id_cat_contr_doc','=','t009_categoria_contrato_doc.a009_id_cat_contr_doc')
            ->where('t009_categoria_contrato_doc.a008_id_cat_contrato', '=', $id)
            ->select('t009_categoria_contrato_doc.a009_id_cat_contr_doc','a008_id_cat_contrato','a009_descricao','a009_ind_obrigatorio','a009_dias_alerta_vencimento','a009_status','a014_id_documento')
            ->get();

        //dump($CategoriaDocumentos);

        return view('sistema.categoria_contrato.edit', compact('categoria_contrato', 'comboEmpresa','CategoriaDocumentos'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'a005_id_empresa' => 'required',
            'a008_descricao' => 'required',

        ]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a008_status'] = $requestData['a008_status']??0;
        //dump($requestData);

        DB::beginTransaction();
        try {

            $categoria_contrato = Categoria_contrato::findOrFail($id);

            if(($categoria_contrato[0]->a014_id_documento??0) != 0)
            {
                DB::rollBack();
                Session::flash('flash_message', 'Catergoria Utilizada em Contrato, não é possível alterar!');
                return redirect('categoria_contrato');
            }



            $categoria_contrato->update($requestData);

            $this->gravaDocumento($categoria_contrato->a008_id_cat_contrato, $requestData);

            Session::flash('flash_message', 'Categoria de Contrato atualizado!');
            DB::commit();
            return redirect('categoria_contrato');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Não foi possível atualizar o Categoria de Contrato!');
            return redirect('categoria_contrato');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Categoria_contrato::findOrFail($id)->delete();

            Session::flash('flash_message', 'Categoria de Contrato excluído!');
            DB::commit();
            return redirect('categoria_contrato');

        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Categoria de Contrato!');
            return redirect('categoria_contrato');
        }
    }

    public function gravaDocumento($a008_id_cat_contrato, $requestData)
    {
        Categoria_contrato_doc::query()->where('a008_id_cat_contrato', '=', $a008_id_cat_contrato)->delete();

        for ($x = 0; $x < count($requestData['a009_descricao'] ?? []); $x++) {
            $EmpresaContato = new Categoria_contrato_doc();
            $EmpresaContato->a008_id_cat_contrato = $a008_id_cat_contrato;
            $EmpresaContato->a009_descricao = $requestData["a009_descricao"][$x];
            $EmpresaContato->a009_dias_alerta_vencimento = $requestData["a009_dias_alerta_vencimento"][$x];
            $EmpresaContato->a009_ind_obrigatorio = $requestData["a009_ind_obrigatorio"][$x];
            $EmpresaContato->a009_status = $requestData["a009_status"][$x];
            $EmpresaContato->created_at_user = Auth::user()->id;
            $EmpresaContato->updated_at_user = Auth::user()->id;

            $EmpresaContato->save();
        }
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
        //dump($ret);

        return $ret;
    }

}
