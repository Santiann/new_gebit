<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use App\Pais;
use Yajra\DataTables\DataTables;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class CidadeController extends Controller
{
    //Carrega Cidades
    public function carregaCidadeEstado(Request $request)
    {

        $requestData = $request->all();

        $Estado = Estado::where('t048_estado.a048_uf', '=', $requestData['idEstado'])->first();

        $cidades = Cidade::where('a048_id_estado', '=', $Estado->a048_id_estado)->where('a047_nome_cidade', '=', $requestData['idcidade'])->first();

        $cidadeEstado = array();

        $cidadeEstado['cidade'] = $cidades->a047_id_cidade??0;
        $cidadeEstado['estado'] = $Estado->a048_id_estado??0;
        $cidadeEstado['pais'] = $Estado->a049_id_pais??0;

        $cidadesEstado = Cidade::where('a048_id_estado', '=', $Estado->a048_id_estado??0)->select('a047_id_cidade', 'a047_nome_cidade')->orderBy('a047_nome_cidade', 'asc')->get();
        $cidadeEstado['cidades'] = $cidadesEstado;

        return $cidadeEstado;
    }

    public function carregaCidade(Request $request)
    {
        $idEstado = $request->get('idEstado');
        $cidades = Cidade::where('a048_id_estado', '=', $idEstado)->select('a047_id_cidade', 'a047_nome_cidade')->orderBy('a047_nome_cidade', 'asc')->get();

        return $cidades;
    }
}
