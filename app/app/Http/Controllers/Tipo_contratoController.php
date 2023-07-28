<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use Yajra\DataTables\DataTables;

use App\Tipo_contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class Tipo_contratoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:tipo_contrato-show|tipo_contrato-create|tipo_contrato-edit|tipo_contrato-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('tipo_contrato-edit');
        $delete = Entrust::can('tipo_contrato-delete');
        return Datatables::of(
            Tipo_contrato::query()
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't010_tipo_contrato.a005_id_empresa')
                ->join('t005_empresa', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->where(function($where){
                    if(Auth::user()->ind_super_adm<=0) {
                        $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                        $where->where('a004_dono_cadastro', 1);
                    }
                })
                ->select('a010_id_tipo_contrato','t010_tipo_contrato.a005_id_empresa','a010_descricao','a010_status')
                ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nomeEmpresa"))
                ->groupBy('a010_id_tipo_contrato','t010_tipo_contrato.a005_id_empresa','a010_descricao','a010_status','a005_nome_fantasia','a005_nome_completo')
        )
        ->addColumn('action', function ($row) use ($edit,$delete) {
            $acoes = "";
            if($edit){
                $acoes .= '<a class="btn btn-xs btn-primary"title="Editar Tipo de Contrato"  href="/tipo_contrato/'.$row->a010_id_tipo_contrato.'/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
            }
            if($delete){
                $acoes .= '<form method="POST" action="/tipo_contrato/'.$row->a010_id_tipo_contrato.'" style="display:inline">
                    <input name="_method" value="DELETE" type="hidden">
                    '. csrf_field() .'
                    <button type="button" class="btn btn-xs btn-danger" title="Excluir Tipo de Contrato" onclick="ConfirmaExcluir(\'Confirma Excluir Tipo de Contrato?\',this)">
                       <span class="fa fa-trash"></span>
                    </button>
                </form>';
            }
            return $acoes;
        })

            ->editColumn('a010_status', function ($status) {

                if (isset($status->a010_status)) {
                    if ($status->a010_status == '1') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;

                    } else {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }
                }
            })
            ->filterColumn('a010_status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Ativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a010_status', '1');
                    }
                    if (strpos(strtoupper('Inativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a010_status', '0');
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
        return view('sistema.tipo_contrato.index', compact('comboEmpresa'));
    }

    public function create()
    {
        $comboEmpresa = $this->optionEmpresa();

        return view('sistema.tipo_contrato.create', compact('comboEmpresa'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'a005_id_empresa' => 'required',
			'a010_descricao' => 'required',
		]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a010_status'] = $requestData['a010_status']??0;


        DB::beginTransaction();
        try {

            $tipo_contrato = Tipo_contrato::create($requestData);
            Session::flash('flash_message', 'Tipo de Contrato adicionado!');
            DB::commit();

            if ($request->expectsJson()) {
                return ['success' => 'true', 'content' => $tipo_contrato];
            }

            return redirect('tipo_contrato');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return ['success' => 'false', 'error' => $e->getMessage()];
            }

            dd($e);
            Session::flash('flash_message', 'Não foi possível atualizar o Tipo de Contrato!');
            return redirect('tipo_contrato');
        }
    }

    public function show($id)
    {
        $tipo_contrato = Tipo_contrato::findOrFail($id);
        $comboEmpresa = $this->optionEmpresa();


        return view('sistema.tipo_contrato.show', compact('tipo_contrato','comboEmpresa'));
    }

    public function edit($id)
    {
        $tipo_contrato = Tipo_contrato::findOrFail($id);
        $this->validaAcessoEdit($tipo_contrato->a005_id_empresa, 'empresa');
        $comboEmpresa = $this->optionEmpresa();


        return view('sistema.tipo_contrato.edit', compact('tipo_contrato','comboEmpresa'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'a005_id_empresa' => 'required',
			'a010_descricao' => 'required',

		]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a010_status'] = $requestData['a010_status']??0;


        DB::beginTransaction();
        try {

            $tipo_contrato = Tipo_contrato::findOrFail($id);
            $tipo_contrato->update($requestData);

            Session::flash('flash_message', 'Tipo de Contrato atualizado!');
            DB::commit();
            return redirect('tipo_contrato');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível atualizar o Tipo de Contrato!');
            return redirect('tipo_contrato');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Tipo_contrato::findOrFail($id)->delete();

            Session::flash('flash_message', 'Tipo de Contrato excluído!');
            DB::commit();
            return redirect('tipo_contrato');

        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Tipo de Contrato!');
            return redirect('tipo_contrato');
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
