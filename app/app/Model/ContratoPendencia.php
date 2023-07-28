<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;

class ContratoPendencia extends Model
{
    protected $table = 't027_contrato_pendencias';

    public $timestamps = true;

    protected $primaryKey = 'a027_id_pendencia';

    protected $fillable = [
        'a013_id_contrato',
        'a001_id_usuario',
        'a005_id_empresa',
        'a027_pendencia',
        'a027_nome_usuario',
        'a027_pendencia_aceite',
    ];

    public static function getUsuarioPendencias($user_id)
    {
        $id_empresas = Usuario::find($user_id)->empresas->pluck('a005_id_empresa')->toArray();

        return ContratoPendencia::whereIn('a005_id_empresa', $id_empresas)->where(function($query) {
                $query->whereNull('a027_pendencia_aceite')
                    ->orWhereNotIn('a027_pendencia_aceite', [1]);
            })->with('Empresa_belongsTo')->get();
    }

    public function Usuario_belongsTo()
    {
        return $this->belongsTo('App\Usuario', 'a001_id_usuario');
    }
    public function Contrato_belongsTo()
    {
        return $this->belongsTo('App\Contrato');
    }
    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa', 'a005_id_empresa');
    }
}
