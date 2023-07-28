<?php

namespace App\Http\Controllers;

use App\Categoria_contrato;
use App\Compromisso;
use App\Contrato;
use App\Cotacao;
use App\Cotacao_fornecedor;
use App\Notificacao;
use App\Parametro;
use App\Permission;
use App\Role;
use App\Tipo_contrato;
use App\User;
use App\ContratoFinanceiro;
use App\ContratoPendencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public static function IndicadorContrato()
    {
        $controller = new DashboardController();

        $contratos = $controller->queryIndicadorContratos();

        $permissao = Permission::query()->where('name','contrato')->first();
        $icone = $permissao->icone;





        return view('sistema.dashboard.indicadorContrato',compact('contratos', 'icone'));
    }

    public static function IndicadorCotacao()
    {
        $controller = new DashboardController();

        $permissao = Permission::query()->wherein('name',['cotacao','orcamento'])->get();
        $cotacao = $permissao->where('name', 'cotacao')->first();
        $orcamento = $permissao->where('name', 'orcamento')->first();

        $iconeOrcamento = $orcamento->icone??"";
        $iconeCotacao = $cotacao->icone??"";

        $cotacao = $controller->queryIndicadorCotacao();

        return view('sistema.dashboard.indicadorCotacao',compact('cotacao','iconeOrcamento','iconeCotacao'));
    }

    public static function graficoCustoCategoriaContrato()
    {
        $controller = new DashboardController();

        $contratos = $controller->queryContratosCategoria();
        $arrDesc = "";
        $arrValues = "";
        $total = 0;

        $contratos->map(function($row) use (&$arrDesc, &$arrValues,&$total){
            $arrDesc .="|-|". $row->a008_descricao."";
            $arrValues .="|-|". $row->sumValor."";
            $total += $row->sumValor;
        });
        if(strlen($arrDesc)>0) {
            $arrDesc = substr($arrDesc, 3);
            $arrValues = substr($arrValues, 3);
        }
        return view('sistema.dashboard.graficoCustoCategoriaContrato',compact('contratos','arrDesc','arrValues', 'total'));
    }

    public static function graficoCustoTipoContrato()
    {
        $controller = new DashboardController();

        $contratos = $controller->queryContratosTipo();
        $tarrDesc = "";
        $tarrValues = "";
        $total = 0;

        $contratos->map(function($row) use (&$tarrDesc, &$tarrValues,&$total){
            $tarrDesc .="|-|". $row->a010_descricao."";
            $tarrValues .="|-|". $row->sumValor."";
            $total += $row->sumValor;
        });
        if(strlen($tarrDesc)>0) {
            $tarrDesc = substr($tarrDesc, 3);
            $tarrValues = substr($tarrValues, 3);
        }

        //dump(compact('contratos','tarrDesc','tarrValues'));

        return view('sistema.dashboard.graficoCustoTipoContrato',compact('tarrDesc','tarrValues', 'total'));
    }

    public static function graficoCompromisso()
    {
        $controller = new DashboardController();

        $total = 0;
        $descricoes = [];
        $valores = [];
        $qtdMesesAnterior = 6;
        $meses = ["","Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];

        $compromisso = $controller->queryCompromisso($qtdMesesAnterior);

        $mesCompromisso = collect($compromisso)
            ->groupBy(function($item){
                return Carbon::createFromFormat('Y-m-d',$item->a022_data_vencimento)->format('m');
            })


            ->map(function($value,$key){

            return[
                "mes"=>$key,
                "qtd"=>$value->count(),
                "somaValor"=>$value->sum('a022_valor_pagar'),
            ];
        });

        for($x=$qtdMesesAnterior;$x>=0;$x--)
        {
            $mes = Carbon::now()->subMonths($x)->format('m');
            $year = Carbon::now()->subMonths($x)->format('y');

            array_push( $descricoes,$meses[intval($mes)]."/".$year);

            if(isset($mesCompromisso[intval($mes)]))
            {
                array_push($valores,$mesCompromisso[intval($mes)]["somaValor"]);
                $total += $mesCompromisso[intval($mes)]["somaValor"];
            }
            elseif(isset($mesCompromisso[$mes]))
            {
                array_push($valores,$mesCompromisso[$mes]["somaValor"]);
                $total += $mesCompromisso[$mes]["somaValor"];
            }
            else{
                array_push($valores,'0');
            }
        }

        $total = $controller->converteMoney($total);

        return view('sistema.dashboard.graficoCompromisso',compact( 'total','descricoes','valores', 'qtdMesesAnterior'));
    }

    private function queryContratosCategoria()
    {
        $contratos = $this->queryContratos()->pluck('a013_id_contrato')->toArray();
        //dump($contratos);

        $retornoQuery = Categoria_contrato::query()
            ->join('t024_relacao_categorias_contrato','t024_relacao_categorias_contrato.a008_id_cat_contrato','=','t008_categoria_contrato.a008_id_cat_contrato')
            ->join('t013_contrato','t024_relacao_categorias_contrato.a013_id_contrato','=','t013_contrato.a013_id_contrato')
            ->whereIn('t024_relacao_categorias_contrato.a013_id_contrato',$contratos)
            ->select('t008_categoria_contrato.a008_id_cat_contrato', 'a008_descricao')
            ->addselect(DB::RAW('count(t024_relacao_categorias_contrato.a013_id_contrato) as contrato'))
            ->addselect(DB::RAW('sum(a013_valor_total_contrato) as sumValor'))
            ->groupBy('t008_categoria_contrato.a008_id_cat_contrato', 'a008_descricao')
            ->orderBy('a008_descricao')
            ->get();

        return $retornoQuery;
    }

    private function queryContratosTipo()
    {
        $contratos = $this->queryContratos()->pluck('a013_id_contrato')->toArray();

        $retornoQuery = Tipo_contrato::query()
            ->join('t013_contrato','t013_contrato.a010_id_tipo_contrato','=','t010_tipo_contrato.a010_id_tipo_contrato')
            ->whereIn('a013_id_contrato',$contratos)

            ->select('t010_tipo_contrato.a010_id_tipo_contrato', 'a010_descricao')
            ->addselect(DB::RAW('count(distinct a013_id_contrato) as contrato'))
            ->addselect(DB::RAW('sum(a013_valor_total_contrato) as sumValor'))
            ->groupBy('t010_tipo_contrato.a010_id_tipo_contrato', 'a010_descricao')
            ->orderBy('a010_descricao')
            ->get();

        return $retornoQuery;
    }

    private function queryCompromisso($qtdMesesAnterior)
    {

        $wheredata = Carbon::now()->subMonths($qtdMesesAnterior)->format('Y-m-d');

        $retornoQuery = Compromisso::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't022_compromisso.a005_id_empresa')
            ->join('t004_empresa_usuario as empresa_usuario_cli_for', 'empresa_usuario_cli_for.a005_id_empresa', '=', 't022_compromisso.a005_id_empresa_cli_for')
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    $where->orwhere('empresa_usuario_cli_for.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                }
            })
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a004_dono_cadastro', '=',1);
                    $where->where('empresa_usuario_cli_for.a004_dono_cadastro', '=', 1);
                }
            })
            ->where('a022_data_vencimento','>=',$wheredata)
            ->where('a022_status','A')
            ->where(DB::RAW('ifnull(a022_valor_pago,0)'),'<=',0)
            ->get();



        return $retornoQuery;
    }

    private function queryIndicadorContratos()
    {
        $total = $this->queryContratos();

        $ParamDIASVENCIMENTOCONTRATO = Parametro::query()->where('a000_sigla', 'DIASVENCIMENTOCONTRATO')->first();
        $DiasVencimentoContrato = $this->retiraCaracter($ParamDIASVENCIMENTOCONTRATO->a000_valor??'0');
        $dataLimiteVencimento = Carbon::now()->add($DiasVencimentoContrato, 'day');

        $vencido = $total->where('a013_status','V');
        $ativo = $total->where('a013_status','A');
        $inativo = $total->where('a013_status','D');
        $cancelado = $total->where('a013_status','C');
        $avencer = $total->where('a013_data_fim' ,'<=', $dataLimiteVencimento->format('Y-m-d'))
            ->where('a013_data_fim' ,'>=', Carbon::now()->format('Y-m-d'))
            ->whereNotIn('a013_status',['V','D','C']);

        $empresas = Auth::user()->Usuario_belongsTo->empresas()->where('a005_ind_fornecedor',0)->where('a005_ind_cliente',0)->get();
        $pendencias = ContratoPendencia::getUsuarioPendencias(Auth::user()->Usuario_belongsTo->a001_id_usuario);
        $pendencias_finan = ContratoFinanceiro::whereIn('a005_id_empresa', $empresas->pluck('a005_id_empresa'))->whereIn('a028_status', [0,3]);

        $ret = [
            "total"=>$total->count(),
            "vencido"=>$vencido->count(),
            "ativo"=>$ativo->count(),
            "inativo"=>$inativo->count(),
            "cancelado"=>$cancelado->count(),
            "avencer"=>$avencer->count(),
            "pendencias" => $pendencias->count(),
            "pendencias_finan" => $pendencias_finan->count(),
        ];

        return $ret;
    }

    private function queryIndicadorCotacao()
    {
        $retornoQuery = Cotacao::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't018_cotacao.a005_id_empresa')
            ->join('t020_cotacao_fornecedor','t020_cotacao_fornecedor.a018_id_contacao','=','t018_cotacao.a018_id_contacao')
            ->join('t004_empresa_usuario as empresa_usuario_cli_for', 'empresa_usuario_cli_for.a005_id_empresa', '=', 't020_cotacao_fornecedor.a005_id_empresa')
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    $where->orwhere('empresa_usuario_cli_for.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                }
            })
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a004_dono_cadastro', '=',1);
                    $where->where('empresa_usuario_cli_for.a004_dono_cadastro', '=', 1);
                }
            })
            ->select('t018_cotacao.a018_id_contacao', 'a018_status as status','a018_data_prevista','a018_data_cotacao')
            ->groupBy('t018_cotacao.a018_id_contacao', 'a018_status','a018_data_prevista','a018_data_cotacao')
            ->get();

        $retornoQueryCotacao = Cotacao::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't018_cotacao.a005_id_empresa')
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                }
            })
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a004_dono_cadastro', '=',1);
                }
            })
            ->select('t018_cotacao.a018_id_contacao', 'a018_status as status','a018_data_prevista','a018_data_cotacao')
            ->groupBy('t018_cotacao.a018_id_contacao', 'a018_status','a018_data_prevista','a018_data_cotacao')
            ->get();


        $retornoQueryOrcamento = Cotacao::query()
            ->join('t020_cotacao_fornecedor','t020_cotacao_fornecedor.a018_id_contacao','=','t018_cotacao.a018_id_contacao')
            ->join('t004_empresa_usuario as empresa_usuario_cli_for', 'empresa_usuario_cli_for.a005_id_empresa', '=', 't020_cotacao_fornecedor.a005_id_empresa')
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->orwhere('empresa_usuario_cli_for.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                }
            })
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('empresa_usuario_cli_for.a004_dono_cadastro', '=', 1);
                }
            })
            ->select('t018_cotacao.a018_id_contacao', 'a020_status as status','a018_data_prevista','a018_data_cotacao')
            ->groupBy('t018_cotacao.a018_id_contacao', 'a020_status','a018_data_prevista','a018_data_cotacao')
            ->get();

        $orcamentoPendente = $retornoQueryOrcamento->where('status','O');
        $cotacaoPendente = $retornoQueryCotacao->where('status','O');
        $cancelado = $retornoQueryOrcamento->where('status','C');
        $finalizadoMes = $retornoQueryCotacao->where('a018_data_cotacao','>=',Carbon::now()->format('Y-m-').'01');

        $aprovacao = $retornoQueryCotacao->where('status','A');
        $entrega = $retornoQueryCotacao->where('status','E');
        $finalizado = $retornoQueryCotacao->where('status','F');


        $ret = [
            "total"=>$retornoQuery->groupby('a018_id_contacao')->count(),
            "orcamentoPendente"=>$orcamentoPendente->count(),
            "cotacaoPendente"=>$cotacaoPendente->count(),
            "cancelado"=>$cancelado->count(),
            "finalizadoMes"=>$finalizadoMes->count(),

            "aprovacao"=>$aprovacao->count(),
            "entrega"=>$entrega->count(),
            "finalizado"=>$finalizado->count(),
        ];

        return $ret;
    }

    private function queryContratos()
    {
        $retornoQuery = Contrato::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't013_contrato.a005_id_empresa')
            ->join('t004_empresa_usuario as empresa_usuario_cli_for', 'empresa_usuario_cli_for.a005_id_empresa', '=', 't013_contrato.a005_id_empresa_cli_for')
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    $where->orwhere('empresa_usuario_cli_for.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                }
            })
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a004_dono_cadastro', '=',1);
                    $where->where('empresa_usuario_cli_for.a004_dono_cadastro', '=', 1);
                }
            })

            ->select('a013_id_contrato', 'a013_status','a013_data_inicio','a013_data_fim')
            ->groupBy('a013_id_contrato', 'a013_status','a013_data_inicio','a013_data_fim')
            ->get();



        return $retornoQuery;
    }

}
