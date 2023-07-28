<?php namespace Dealix\Faqs\Models;

use \Model;

/**
 * Model para controlar os Emails cadastrados pelo sistema de nesletter
 * Class Faqs
 * @package Dealix\Newsletters\Models
 */
class Faq extends Model
{
    use \October\Rain\Database\Traits\Validation;

    // Prop para configurar de qual tabela estamos falando
    public $table       = 'dealix_faqs_faqs';

    //Regras de valida��o
    public $rules           = [
        'pergunta'                => 'required',
        'resposta'              => 'required',
    ];

    // E quem se relaciona com ela.
    public $attachMany   = [
        'imagens'  => ['System\Models\File']
    ];

    public function __construct(){
        parent::__construct();
        $this->published_at = date('Y-m-d H:i:s');
    }
}
