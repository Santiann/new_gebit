<?php
namespace App\Http\Controllers;

use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\DevTable;
use App\DevColumn;

class DevController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('dev.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {

        //dd(env('DB_DATABASE', 'new_db'));

        return DataTables::of(DevTable::where('table_schema','=',env('DB_DATABASE', 'new_db')))
            ->addColumn('action', function ($row) {
                return '<a class="btn btn-xs" href="/dev/'.$row->TABLE_NAME.'" ><span class="glyphicon glyphicon-sunglasses" aria-hidden="true">...</span></a>';
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function crud($table_name)
    {
        $campos = DevColumn::where('table_schema','=',env('DB_DATABASE', 'forge'))
        ->where('table_name','=',$table_name)
        ->whereNotIn('column_name',['created_at','updated_at','deleted_at'])
        ->orderBy('ordinal_position')
        ->get();

        $relationships = "";
        $privatePublicFunction ="";
        $pk = $campos->where('COLUMN_KEY','PRI')[0];
        $fks = $campos->where('COLUMN_KEY','MUL');
        $arrfk = $fks->map(function($value,$key){ return $value->COLUMN_NAME; })->values()->all();

        $modelName = ucfirst(substr($campos[0]->TABLE_NAME,5,1000));

        $fillable = "".$campos->map(function($value,$key){
                return $value->COLUMN_NAME;
            });
        $fillable = str_replace('"',"'",$fillable);


        $tableRelation_hasMany = DevColumn::query()
            ->where('table_schema','=',env('DB_DATABASE', 'forge'))
            ->where('COLUMN_NAME','=',$pk->COLUMN_NAME)
            ->where('COLUMN_KEY','!=','PRI')
            ->get();

        $tableRelation_belongsTo = DevColumn::query()
            ->where('table_schema','=',env('DB_DATABASE', 'forge'))
            ->wherein('COLUMN_NAME',$arrfk)
            ->where('COLUMN_KEY','=','PRI')
            ->get();



        $tableRelation_hasMany->map(function($value,$key) use (&$relationships){
            $modelRelacion = ucfirst(substr($value->TABLE_NAME,5,1000));
            $tipoRelacion = "hasMany";
            $nomeFunction = $modelRelacion."_".$tipoRelacion;
            $relationships .= $nomeFunction."#".$tipoRelacion."#App\\".$modelRelacion.";";
        });

        $tableRelation_belongsTo->map(function($value,$key) use (&$relationships,&$privatePublicFunction){
            $modelRelacion = ucfirst(substr($value->TABLE_NAME,5,1000));
            $tipoRelacion = "belongsTo";
            $nomeFunction = $modelRelacion."_".$tipoRelacion;
            $relationships .= $nomeFunction."#".$tipoRelacion."#App\\".$modelRelacion.";";

            $table = DevColumn::query()
                ->where('table_schema','=',env('DB_DATABASE', 'forge'))
                ->where('TABLE_NAME','=',$value->TABLE_NAME)
                ->where('DATA_TYPE','=','varchar')
                ->orderBy('ORDINAL_POSITION')
                ->first();
            $privatePublicFunction .= "Private#".$modelRelacion."#model#".$modelRelacion."::query()->pluck('".$table->COLUMN_NAME."','".$value->COLUMN_NAME."')->prepend('','');||";
        });

        $campos->where('DATA_TYPE' ,'char')->map(function($value,$key) use (&$privatePublicFunction){
            $campo = substr($value->COLUMN_NAME,5,1000);
            $privatePublicFunction .= "Private#".ucfirst($campo)."#option#\$this->".$campo."DefaultChar".$value->CHARACTER_MAXIMUM_LENGTH.";||";
        });

        $privatePublicFunction = substr($privatePublicFunction,0,-2);


        ///Todo: precisa fazer a parte de public da proprio model pra ser usado em outros controller
        ///TODO: fazer isso pra $tableRelation_belongsTo e pegar a public da outra


        $required = $campos->where('IS_NULLABLE','=','NO')
            ->where('COLUMN_KEY','<>','PRI')
            ->whereNotIn('COLUMN_NAME',['created_at','created_at_user','updated_at','updated_at_user']);

        $controllerName = $modelName."Controller";
        $route = substr($campos[0]->TABLE_NAME,5,1000);
        $permissions = [
            ['tipo'=>'MENU','permission'=>''],
            ['tipo'=>'PERM','permission'=>'show'],
            ['tipo'=>'PERM','permission'=>'create'],
            ['tipo'=>'PERM','permission'=>'edit'],
            ['tipo'=>'PERM','permission'=>'delete']
        ];

        $fieldsController = "";
        $campos->map(function($value,$key) use (&$fieldsController){
            $fieldsController .= $value->COLUMN_NAME .'#'. $value->present()->tipocampo.';';
        });
        //$fieldsController.='status#select#options={"A": "Ativo", "B": "Bloqueado", "D": "Inativo"};';
        $fieldsController = substr($fieldsController,0,-1);

        $validationsController = "";
        $required->map(function($value,$key) use (&$validationsController){
            $validationsController .= $value->COLUMN_NAME .'#required;';
        });
        $validationsController = substr($validationsController,0,-1);




        $textModel = 'php artisan crud:model '. $modelName
            .' --table="'.$campos[0]->TABLE_NAME
            .'" --pk="'.$pk->COLUMN_NAME
            .'" --fillable="'.$fillable
            .'" --relationships="'.$relationships;

        $textController = 'php artisan crud:controller '. $controllerName
            .' --crud-name='. $route
            .' --model-name='. $modelName
            .' --model-namespace='. $modelName
            .' --fields="'.$fieldsController.'"'
            .' --pk="'.$pk->COLUMN_NAME.'"'
            .' --validations="'.$validationsController.'"'
            .' --privatePublicFunction="'.$privatePublicFunction.'"'
            .' --view-path="sistema"';

        $textRequest ='php artisan crud:request '.$modelName
            .' --model-name='.$modelName
            .'';

        $envio = compact('campos','required','controllerName','route','permissions','pk','modelName','fillable','relationships','textModel','textController','textRequest');

        //dump($envio);
//dd();
        return view('dev.crud',$envio);
    }
}
