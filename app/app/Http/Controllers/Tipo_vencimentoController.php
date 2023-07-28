<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use Yajra\DataTables\DataTables;

use App\Tipo_vencimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class Tipo_vencimentoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:tipo_vencimento-show|tipo_vencimento-create|tipo_vencimento-edit|tipo_vencimento-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('tipo_vencimento-edit');
        $delete = Entrust::can('tipo_vencimento-delete');
        return Datatables::of(
            Tipo_vencimento::query()
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't012_tipo_vencimento.a005_id_empresa')
                ->join('t005_empresa', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
                ->where(function($where){
                    if(Auth::user()->ind_super_adm<=0)
                    {
                        $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                        $where->where('a004_dono_cadastro', 1);
                    }
                })
                ->select('a012_id_tipo_vencimento','t012_tipo_vencimento.a005_id_empresa','a012_descricao','a012_status')
                ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nomeEmpresa"))
                ->groupBy('a012_id_tipo_vencimento','t012_tipo_vencimento.a005_id_empresa','a012_descricao','a012_status','a005_nome_fantasia','a005_nome_completo')
        )
        ->addColumn('action', function ($row) use ($edit,$delete) {
            $acoes = "";
            if($edit){
                $acoes .= '<a class="btn btn-xs btn-primary"  title="Editar Tipo de Vencimento" href="/tipo_vencimento/'.$row->a012_id_tipo_vencimento.'/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
            }

            if($delete){
                $acoes .= '<form method="POST" action="/tipo_vencimento/'.$row->a012_id_tipo_vencimento.'" style="display:inline">
                    <input name="_method" value="DELETE" type="hidden">
                    '. csrf_field() .'
                    <button type="button" class="btn btn-xs btn-danger" title="Excluir Tipo de Vencimento" onclick="ConfirmaExcluir(\'Confirma Excluir Tipo de Vencimento?\',this)">
                       <span class="fa fa-trash"></span>
                    </button>
                </form>';
            }
            return $acoes;
        })
            ->editColumn('a012_status', function ($status) {

                if (isset($status->a012_status)) {
                    if ($status->a012_status == '1') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;

                    } else {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }
                }
            })
            ->filterColumn('a012_status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Ativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a012_status', '1');
                    }
                    if (strpos(strtoupper('Inativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a012_status', '0');
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
        return view('sistema.tipo_vencimento.index', compact('comboEmpresa'));
    }

    public function create()
    {
        $comboEmpresa = $this->optionEmpresa();
        return view('sistema.tipo_vencimento.create', compact('comboEmpresa'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'a005_id_empresa' => 'required',
			'a012_descricao' => 'required'
		]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a012_status'] = $requestData['a012_status']??0;


        DB::beginTransaction();
        try {

            Tipo_vencimento::create($requestData);
            Session::flash('flash_message', 'Tipo de Vencimento adicionado!');
            DB::commit();
            return redirect('tipo_vencimento');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível atualizar o Tipo de Vencimento!');
            return redirect('tipo_vencimento');
        }
    }

    public function show($id)
    {
        $tipo_vencimento = Tipo_vencimento::findOrFail($id);
        $comboEmpresa = $this->optionEmpresa();


        return view('sistema.tipo_vencimento.show', compact('tipo_vencimento','comboEmpresa'));
    }

    public function edit($id)
    {
        $tipo_vencimento = Tipo_vencimento::findOrFail($id);
        $this->validaAcessoEdit($tipo_vencimento->a005_id_empresa, 'empresa');
        $comboEmpresa = $this->optionEmpresa();


        return view('sistema.tipo_vencimento.edit', compact('tipo_vencimento','comboEmpresa'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'a005_id_empresa' => 'required',
            'a012_descricao' => 'required'
        ]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a012_status'] = $requestData['a012_status']??0;


        DB::beginTransaction();
        try {

            $tipo_vencimento = Tipo_vencimento::findOrFail($id);
            $tipo_vencimento->update($requestData);

            Session::flash('flash_message', 'Tipo de Vencimento atualizado!');
            DB::commit();
            return redirect('tipo_vencimento');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível atualizar o Tipo de Vencimento!');
            return redirect('tipo_vencimento');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Tipo_vencimento::findOrFail($id)->delete();

            Session::flash('flash_message', 'Tipo de Vencimento excluído!');
            DB::commit();
            return redirect('tipo_vencimento');

        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Tipo de Vencimento!');
            return redirect('tipo_vencimento');
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
