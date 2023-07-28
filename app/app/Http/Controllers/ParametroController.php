<?php

namespace App\Http\Controllers;

use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use App\Permission;
use Yajra\DataTables\DataTables;

use App\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class ParametroController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:parametro-show|parametro-create|parametro-edit|parametro-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('parametro-edit');
        $delete = Entrust::can('parametro-delete');

        return Datatables::of(
            Parametro::query()
        )
        ->addColumn('action', function ($row) use ($edit,$delete) {
            $acoes = "";
            if($edit){
                $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Parametro"  href="/parametro/'.$row->a000_id_parametro.'/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
            }

            if($delete){
                if($row->a000_ind_adm == 0) {
                    $acoes .= '<form method="POST" action="/parametro/' . $row->a000_id_parametro . '" style="display:inline">
                    <input name="_method" value="DELETE" type="hidden">
                    ' . csrf_field() . '
                    <button type="button" class="btn btn-xs btn-danger" title="Excluir Parametro" onclick="ConfirmaExcluir(\'Confirma Excluir Parametro?\', this)">
                       <span class="fa fa-trash"></span>
                    </button>
                </form>';
                }
            }
            return $acoes;
        })
        ->escapeColumns(['*'])
        ->make(true);
    }

    public function index(Request $request)
    {
        return view('sistema.parametro.index');
    }

    public function create()
    {
        return view('sistema.parametro.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'a000_sigla' => 'required',
			'a000_nome' => 'required',
			'a000_descricao' => 'required',
			'a000_valor' => 'required'
		]);
        $requestData = $request->all();


        DB::beginTransaction();
        try {

            $validator = $this->validacaoCustomizada(0,$requestData);
            if(count($validator->errors())>0) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }

            Parametro::create($requestData);
            DB::commit();
            Session::flash('flash_message', 'Parametro adicionado!');
            return redirect('parametro');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Não foi possível atualizar o Parametro!');
            return redirect('parametro');
        }
    }

    public function show($id)
    {
        $parametro = Parametro::findOrFail($id);


        return view('sistema.parametro.show', compact('parametro'));
    }

    public function edit($id)
    {
        $parametro = Parametro::findOrFail($id);


        return view('sistema.parametro.edit', compact('parametro'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'a000_sigla' => 'required',
			'a000_nome' => 'required',
			'a000_descricao' => 'required',
			'a000_valor' => 'required',
		]);
        $requestData = $request->all();


        DB::beginTransaction();
        try {

            $validator = $this->validacaoCustomizada($id,$requestData);
            if(count($validator->errors())>0) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }

            $parametro = Parametro::findOrFail($id);
            $parametro->update($requestData);

            Session::flash('flash_message', 'Parametro atualizado!');
            DB::commit();
            return redirect('parametro');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível atualizar o Parametro!');
            return redirect('parametro');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Parametro::findOrFail($id)->delete();

            Session::flash('flash_message', 'Parametro excluído!');
            DB::commit();
            return redirect('parametro');

        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Parametro!');
            return redirect('parametro');
        }
    }


    public function validacaoCustomizada($id,$requestData)
    {
        $validator = validator([], []);

        ///validando se ja exite a sigla ou nome duplicado diferente do id
        $depositoJaCadastrado = Parametro::query()->where('a000_id_parametro' ,'!=',$id)->get();
        $sigla = $depositoJaCadastrado->where('a000_sigla',$requestData['a000_sigla']);

        if(count($sigla)) {
            $validator->errors()->add('a000_sigla', 'Sigla já Existente');
        }

        return $validator;

    }


}
