<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use Yajra\DataTables\DataTables;
use Auth;
use Entrust;

class PermissionsController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['permission:permissions-show|permissions-create|permissions-edit|permissions-delete']);
    }

    public function index(Request $request)
    {

        return view('sistema.permissions.index');
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('permissions-edit');
        $delete = Entrust::can('permissions-delete');

        return Datatables::of(
            Permission::where('tipo','MENU')
            )
            ->addColumn('display_name', function ($row) {
                $name = "";

                $contador = 0;
                if(intval(substr($row->ordem,0,2))>0)
                {
                    $contador++;
                }
                if(intval(substr($row->ordem,2,2))>0)
                {
                    $contador++;
                }
                if(intval(substr($row->ordem,4,2))>0)
                {
                    $contador++;
                }
                if(intval(substr($row->ordem,6,2))>0)
                {
                    $contador++;
                }
                if(intval(substr($row->ordem,8,2))>0)
                {
                    $contador++;
                }
                if(intval(substr($row->ordem,10,2))>0)
                {
                    $contador++;
                }

                for ($i = 1; $i < $contador; $i++) {

                    $name .=  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }


                $name .= $row->display_name;
                // dump($name);
                return $name;
            })
            ->addColumn('action', function ($row) use($edit,$delete){
                $acoes = "";
                if($edit){
                    $acoes .= '<a class="btn btn-xs btn-primary"  title="Editar Menu"  href="/permissions/'.$row->id.'/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
                }

                if($delete){
                    $acoes .= '<form method="POST" action="/permissions/'.$row->id.'" style="display:inline">
                        <input name="_method" value="DELETE" type="hidden">
                        '. csrf_field() .'
                        <button type="button" class="btn btn-xs btn-danger" title="Excluir Menu" onclick="ConfirmaExcluir(\'Confirma Excluir Permissions?\',this)">
                           <span class="fa fa-trash"></span>
                        </button>
                    </form>';
                }

                return $acoes;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function create()
    {


        //where('idassociado',Auth::user()->idassociado)->
        $menus = Permission::where('tipo','=','MENU')
            ->pluck('display_name','id')
            ->prepend('', '');

        $menuspai = Permission::where('tipo','=','MENU')
            //->where('idparent',202)
            ->orderBy('ordem')->get();

        $menuspai->map(function($value){
            $ordemSplit = str_split($value["ordem"],2 );
            $ordemMaiorZero = array_filter($ordemSplit, function($v, $k) {
                return $v>0;
            }, ARRAY_FILTER_USE_BOTH);

            $qtdOrdem = count($ordemMaiorZero)-1;


            $strRepeat = "";
            if($qtdOrdem>=0)
                $strRepeat = str_repeat ( "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" , $qtdOrdem ) ;

            $value["espacamento"] = $strRepeat ;
        });


        return view('sistema.permissions.create', compact('menus','menuspai'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();


        DB::beginTransaction();
        try {

            $requestData['idassociado'] = 0;
            $requestData['created_at_user'] = Auth::user()->id;

            $requestData['description'] = $requestData["display_name"];

            $requestData['ordem'] = str_replace("__",$requestData['ordemDigitado'],$requestData['ordem']);


            Permission::create($requestData);

            $tipos = ['-show', '-create', '-edit', '-delete'];

            foreach ($tipos as $tipo) {
                $perm = new Permission();
                $perm->name = $requestData['name'] . $tipo;
                $perm->display_name = $requestData['name'] . $tipo;
                $perm->description = $requestData['description'];
                $perm->tipo = "PERM";
                $perm->save();
            }




            Session::flash('flash_message', 'Permissions adicionado!');
            DB::commit();
        }
        catch (\Exception $e) {

            dd($e);
            Session::flash('flash_message', 'Erro ao Criar a Permissions !');
            DB::rollBack();
        }
         // $requestData['idassociado'] = Auth::user()->idassociado;


        return redirect('permissions');
    }


    public function show($id)
    {
        //where('idassociado','=',Auth::user()->idassociado)->
        $permission = Permission::findOrFail($id);

        return view('sistema.permissions.show', compact('permission'));
    }


    public function edit($id)
    {
        //where('idassociado','=',Auth::user()->idassociado)->
        $permission = Permission::findOrFail($id);
        $menus = Permission::where('tipo','=','MENU')
                ->where('id','<>',$permission->id)
                ->pluck('display_name','id');
        $menus->prepend('', '');

        $menuspai = Permission::where('tipo','=','MENU')->orderBy('ordem')->get();

        $menuspai->map(function($value){
            $ordemSplit = str_split($value["ordem"],2 );
            $ordemMaiorZero = array_filter($ordemSplit, function($v, $k) {
                return $v>0;
            }, ARRAY_FILTER_USE_BOTH);

            $qtdOrdem = count($ordemMaiorZero)-1;


            $strRepeat = "";
            if($qtdOrdem>=0)
                $strRepeat = str_repeat ( "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" , $qtdOrdem ) ;

            $value["espacamento"] = $strRepeat ;
        });

        return view('sistema.permissions.edit', compact('permission','menus','menuspai'));
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();
        // $requestData['idassociado'] = Auth::user()->idassociado;
        $requestData['idassociado'] = 0;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['description'] = $requestData["display_name"];



        $posIniReplace = strpos($requestData['ordem'],"__");
        $requestData['ordem'] = str_replace("__",$requestData['ordemDigitado'],$requestData['ordem']);

        //dump($posIniReplace);

        DB::beginTransaction();
        try {

            $nivelAtualMenu = 0;
            $valorOrdemNivel = $this->nivelMenuOrdemOriginal($requestData["ordem"],0,2,$nivelAtualMenu);
            $valorOrdemSemZeros0 = substr($requestData["ordem"],0,$nivelAtualMenu*2);
            //dump([$requestData["ordem"],$nivelAtualMenu, $valorOrdemSemZeros0]);

            $menuFilhos = Permission::where('idparent', $id)->get();
            //dump('filhos=' . count($menuFilhos));
            foreach ($menuFilhos as $menuFilho) {

                $valorOrdemSemZeros1 = $this->retornaOrdem($menuFilho["ordem"],$valorOrdemSemZeros0);
                $menuNetos = Permission::where('idparent', $menuFilho['id'])->get();
                //dump('netos=' . count($menuNetos));
                foreach ($menuNetos as $menuNeto) {

                    $valorOrdemSemZeros2 = $this->retornaOrdem($menuNeto["ordem"],$valorOrdemSemZeros1);
                    $menuBisNetos = Permission::where('idparent', $menuNeto['id'])->get();
                    //dump('BisNetos=' . count($menuBisNetos));
                    foreach ($menuBisNetos as $menuBisNeto) {

                        $valorOrdemSemZeros3 = $this->retornaOrdem($menuBisNeto["ordem"],$valorOrdemSemZeros2);
                        $menuTriNetos = Permission::where('idparent', $menuBisNeto['id'])->get();
                        //dump('triNetos=' . count($menuBisNetos));
                        foreach ($menuTriNetos as $menuTriNeto) {

                            $valorOrdemSemZeros4 = $this->retornaOrdem($menuTriNeto["ordem"],$valorOrdemSemZeros3);
                            $menuFourNetos = Permission::where('idparent', $menuTriNeto['id'])->get();
                            //dump('FourNetos=' . count($menuBisNetos));
                            foreach ($menuFourNetos as $menuFourNeto) {

                                $valorOrdemSemZeros5 = $this->retornaOrdem($menuFourNeto["ordem"],$valorOrdemSemZeros4);
                                $menuFiveNetos = Permission::where('idparent', $menuFourNetos['id'])->get();
                                //dump('FourNetos=' . count($menuBisNetos));
                                foreach ($menuFiveNetos as $menuFiveNeto) {

                                    $valorOrdemSemZeros6 = $this->retornaOrdem($menuFiveNeto["ordem"],$valorOrdemSemZeros5);

                                    $novaOrdem =  substr($valorOrdemSemZeros6."000000000000",0,12);
                                    ////$ordemMenu = (substr($menuFiveNeto->ordem, 0, $posIniReplace)) . ($requestData['ordemDigitado']) . (substr($menuFiveNeto->ordem, ($posIniReplace + 2)));
                                    //dump(['6',$menuFiveNeto->ordem,$novaOrdem]);
                                    $menuFiveNeto->update(array('ordem' => $novaOrdem));
                                }
                                $novaOrdem =  substr($valorOrdemSemZeros5."000000000000",0,12);
                                ////$ordemMenu = (substr($menuFourNeto->ordem, 0, $posIniReplace)) . ($requestData['ordemDigitado']) . (substr($menuFourNeto->ordem, ($posIniReplace + 2)));
                                //dump(['5',$menuFourNeto->ordem,$novaOrdem]);
                                $menuFourNeto->update(array('ordem' => $novaOrdem));
                            }
                            $novaOrdem =  substr($valorOrdemSemZeros4."000000000000",0,12);
                            ////$ordemMenu = (substr($menuTriNeto->ordem, 0, $posIniReplace)) . ($requestData['ordemDigitado']) . (substr($menuTriNeto->ordem, ($posIniReplace + 2)));
                            //dump(['4',$menuTriNeto->ordem,$novaOrdem]);
                            $menuTriNeto->update(array('ordem' => $novaOrdem));
                        }
                        $novaOrdem =  substr($valorOrdemSemZeros3."000000000000",0,12);
                        ////$ordemMenu = (substr($menuBisNeto->ordem, 0, $posIniReplace)) . ($requestData['ordemDigitado']) . (substr($menuBisNeto->ordem, ($posIniReplace + 2)));
                        //dump(['3',$menuBisNeto->ordem,$novaOrdem]);
                        $menuBisNeto->update(array('ordem' => $novaOrdem));
                    }
                    $novaOrdem =  substr($valorOrdemSemZeros2."000000000000",0,12);
                    ////$ordemMenu = (substr($menuNeto->ordem, 0, $posIniReplace)) . ($requestData['ordemDigitado']) . (substr($menuNeto->ordem, ($posIniReplace + 2)));
                    //dump(['2',$menuNeto->ordem,$novaOrdem]);
                    $menuNeto->update(array('ordem' => $novaOrdem));
                }
                $novaOrdem =  substr($valorOrdemSemZeros1."000000000000",0,12);
                ////$ordemMenu = (substr($menuFilho->ordem, 0, $posIniReplace)) . ($requestData['ordemDigitado']) . (substr($menuFilho->ordem, ($posIniReplace + 2)));
                //dump(['1',$menuFilho->ordem,$novaOrdem]);
                $menuFilho->update(array('ordem' => $novaOrdem));
            }

            //dump(['0',$requestData["ordemAtual"],$requestData["ordem"]]);
            //where('idassociado','=',Auth::user()->idassociado)->
            $permission = Permission::findOrFail($id);

            // dd($requestData);
            $permission->update($requestData);


            $tipos = ['-show', '-create', '-edit', '-delete'];
            $permicaoMenu = Permission::query()->where('name', '=', $requestData['name'] . '-show')->get();

            if (count($permicaoMenu) <= 0) {
                foreach ($tipos as $tipo) {
                    $perm = new Permission();
                    $perm->name = $requestData['name'] . $tipo;
                    $perm->display_name = $requestData['name'] . $tipo;
                    $perm->description = $requestData['description'];
                    $perm->tipo = "PERM";
                    $perm->save();
                }//*/
            }

            //DB::rollBack();
            //dd();

            DB::commit();
            Session::flash('flash_message', 'Permissions atualizado!');
        }
        catch (\Exception $e)
        {

            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Erro ao Excluir Permissions!');
        }



        return redirect('permissions');
    }

    public function retornaOrdem($ordemOriginal,$ordemNivelAnterior){

        $nivelAtualMenu = 0;
        $valorOrdemNivel = $this->nivelMenuOrdemOriginal($ordemOriginal,0,2,$nivelAtualMenu);
        $ordemRetorno = $ordemNivelAnterior.$valorOrdemNivel;
        return $ordemRetorno;
    }

    public function nivelMenuOrdemOriginal($ordemOriginal,$ini,$fim,&$nivelAtualMenu)
    {
        $valorOrdemNivel = substr($ordemOriginal,$ini,$fim);
        if(intval($valorOrdemNivel)>0){

            //dump([$valorOrdemNivel,$nivelAtualMenu]);
            $valorOrdemNivel = $this->nivelMenuOrdemOriginal($ordemOriginal,$ini+2,$fim,$nivelAtualMenu);
            $nivelAtualMenu++;

        }
        else{
            $valorOrdemNivel = substr($ordemOriginal,$ini-2,$fim);
        }
        return $valorOrdemNivel;
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DB::table("permission_role")->where("permission_role.permission_id",$id)->delete();
            Permission::findOrFail($id)->delete();

            DB::commit();
            Session::flash('flash_message', 'Permissions deletado!');
        }
        catch (\Exception $e) {

            //dd($e);
            //Gera Log
            $log                       = Permission::findOrFail($id);
            $log['a999_tipo_log']      = 'Permissions - Error Delete';
            $log['a999_cod_registro']  = $id;
            $log = (new LogController)->geraLog($log);

            DB::rollBack();
            Session::flash('flash_message', 'Erro ao Excluir Permissions!');
        }

        return redirect('permissions');
    }

    public function acertaMenuPermition()
    {
        DB::beginTransaction();
        try {
            $menusQuery =  DB::select("SELECT * FROM ceqnep.permissions s where tipo = 'Menu' AND NOT EXISTS (SELECT * FROM ceqnep.permissions p WHERE p.name = CONCAT(s.name,'-show')) limit 5");
            //dump($menusQuery);
            $tipos =['-show','-create','-edit','-delete'];
            foreach ($menusQuery as $item) {
                dump($item);
                try {
                    foreach ($tipos as $tipo) {
                        $perm = new Permission();
                        $perm->name = $item->name . $tipo;
                        $perm->display_name = $item->display_name . $tipo;
                        $perm->description = $item->description;
                        $perm->created_at = $item->created_at;
                        $perm->updated_at = $item->updated_at;
                        $perm->created_at_user = $item->created_at_user;
                        $perm->updated_at_user = $item->updated_at_user;
                        $perm->tipo = "PERM";
                        $perm->save();
                        dump($tipo);
                    }
                }catch (\Exception $e) {
                    DB::rollBack();

                    dump("!erro no :".$tipo);
                    dd($e);
                }

            }
            DB::commit();
        }
        catch (\Exception $e) {

            DB::rollBack();
            dd($e);

        }

        dd('FIM');
    }

    public function retornaMenu(){

        return ['menu' => [
            [
                'search' => false,
                'href' => 'test',  //form action
                'method' => 'POST', //form method
                'input_name' => 'menu-search-input', //input name
                'text' => 'Search333', //input placeholder
            ],
            [
                'text' => 'blogqqqq4',
                'url'  => 'admin/blog',
                'can'  => 'manage-blog',
            ],
            [
                'text'        => 'pageswwwww5',
                'url'         => 'admin/pages',
                'icon'        => 'far fa-fw fa-file',
                'label'       => 4,
                'label_color' => 'success',
            ],
            ['header' => 'account_settings'],
            [
                'text' => 'profile',
                'url'  => 'admin/settings',
                'icon' => 'fas fa-fw fa-user',
            ],
            [
                'text' => 'change_password',
                'url'  => 'admin/settings',
                'icon' => 'fas fa-fw fa-lock',
            ],
            [
                'text'    => 'multilevel',
                'icon'    => 'fas fa-fw fa-share',
                'submenu' => [
                    [
                        'text' => 'level_one',
                        'url'  => '#',
                    ],
                    [
                        'text'    => 'level_one',
                        'url'     => '#',
                        'submenu' => [
                            [
                                'text' => 'level_two',
                                'url'  => '#',
                            ],
                            [
                                'text'    => 'level_two',
                                'url'     => '#',
                                'submenu' => [
                                    [
                                        'text' => 'level_three',
                                        'url'  => '#',
                                    ],
                                    [
                                        'text' => 'level_three',
                                        'url'  => '#',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'text' => 'level_one',
                        'url'  => '#',
                    ],
                ],
            ],
            ['header' => 'labels'],
            [
                'text'       => 'important',
                'icon_color' => 'red',
            ],
            [
                'text'       => 'warning',
                'icon_color' => 'yellow',
            ],
            [
                'text'       => 'information',
                'icon_color' => 'aqua',
            ],
        ]];

    }
}
