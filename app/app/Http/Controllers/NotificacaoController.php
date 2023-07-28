<?php

namespace App\Http\Controllers;

use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use App\Usuario;
use Yajra\DataTables\DataTables;

use App\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class NotificacaoController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['permission:notificacao-show|notificacao-create|notificacao-edit|notificacao-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('notificacao-edit');
        $show = Entrust::can('notificacao-show');
        $delete = Entrust::can('notificacao-delete');

        return Datatables::of(
            Notificacao::query()->where("a001_id_usuario",Auth::user()->a001_id_usuario)
        )
        ->addColumn('action', function ($row) use ($edit,$show,$delete) {
            $acoes = "";

            $acoes .= '<a href="javascript:void(0);" style="'.($row->a996_ind_lido==0?"font-weight: bold;":"").'" onclick="fLerNotificacao(\''.$row->a996_id_notificacao .'\',\''. str_replace('\'','´',str_replace('"','´',$row->a996_assunto)) .'\',\''. str_replace('\'','´',str_replace('"','´',$row->a996_conteudo)) .'\',\''.$row->a996_ind_lido.'\',this)">
                        <i class="'.$row->a996_nome_icone.'"></i> <span> Ler </span>
                    </a> ';

            return $acoes;
        })
            ->editColumn('a996_ind_lido', function ($row) {

                if (isset($row->a996_ind_lido)) {
                    if ($row->a996_ind_lido == '1') {
                        $labelStatus = '<span class="label label-success">&ensp;Sim </span>';
                        return $labelStatus;

                    } elseif ($row->a996_ind_lido == '0') {
                        $labelStatus = '<span class="label label-default"> &ensp;Não </span>';
                        return $labelStatus;
                    }else {

                        return "";
                    }
                }
            })
        ->escapeColumns(['*'])
        ->make(true);
    }

    public function index(Request $request)
    {
        return view('sistema.notificacao.index');
    }

    public function create()
    {
        $comboUsuario = $this->optionUsuario();

        return view('sistema.notificacao.create', compact('','comboUsuario'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'a001_id_usuario' => 'required',
			'a996_assunto' => 'required',
			'a996_conteudo' => 'required',
			'a996_ind_lido' => 'required'
		]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;


        DB::beginTransaction();
        try {

            Notificacao::create($requestData);
            Session::flash('flash_message', 'Notificacao adicionado!');
            DB::commit();
            return redirect('notificacao');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível atualizar o Notificacao!');
            return redirect('notificacao');
        }
    }

    public function show($id)
    {
        $notificacao = Notificacao::findOrFail($id);
        $comboUsuario = $this->optionUsuario();


        return view('sistema.notificacao.show', compact('notificacao','comboUsuario'));
    }

    public function edit($id)
    {
        $notificacao = Notificacao::findOrFail($id);
        $comboUsuario = $this->optionUsuario();


        return view('sistema.notificacao.edit', compact('notificacao','comboUsuario'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'a001_id_usuario' => 'required',
			'a996_assunto' => 'required',
			'a996_conteudo' => 'required',
			'a996_ind_lido' => 'required'
		]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;


        DB::beginTransaction();
        try {

            $notificacao = Notificacao::findOrFail($id);
            $notificacao->update($requestData);

            Session::flash('flash_message', 'Notificacao atualizado!');
            DB::commit();
            return redirect('notificacao');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível atualizar o Notificacao!');
            return redirect('notificacao');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Notificacao::findOrFail($id)->delete();

            Session::flash('flash_message', 'Notificacao excluído!');
            DB::commit();
            return redirect('notificacao');

        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Notificacao!');
            return redirect('notificacao');
        }
    }

    private function optionUsuario()
    {
        $ret = Usuario::query()->pluck('a001_nome','a001_id_usuario')->prepend('','');
        return $ret;
    }

}
