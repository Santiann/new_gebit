<?php

use Illuminate\Database\Seeder;
use App\Parametro;

class ParametroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // criando os Parametros
        Parametro::create([
            'a000_sigla' => 'BOASVINDAS'
            ,'a000_nome' => 'Boas Vindas'
            ,'a000_descricao' => 'e-mail da empresa que fizer um novo cadastro no sistema.'
            ,'a000_valor' => ''
            ,'a000_status' => 1
            ,'created_at_user' => '1'
            ,'a000_ind_adm' => 1
        ]);

        Parametro::create([
            'a000_sigla' => 'DIASVENCIMENTOCONTRATO'
            ,'a000_nome' => 'Dias Vencimento do contrato'
            ,'a000_descricao' => 'utilizado para enviar e-mail para o responsável do contrato que está preste a vencer'
            ,'a000_valor' => ''
            ,'a000_status' => 1
            ,'created_at_user' => '1'
            ,'a000_ind_adm' => 1
        ]);

        Parametro::create([
            'a000_sigla' => 'TEXTOVENCIMENTOCONTRATO'
            ,'a000_nome' => 'Texto de vencimento do contrato'
            ,'a000_descricao' => 'utilizado para e-mail que o usuário responsável pelo contrato irá receber quando o contrato estiver para vencer, conforme o parametro DIASVENCIMENTOCONTRATO'
            ,'a000_valor' => ''
            ,'a000_status' => 1
            ,'created_at_user' => '1'
            ,'a000_ind_adm' => 1
        ]);

        Parametro::create([
            'a000_sigla' => 'TEXTOVENCIMENTODOCUMENTO'
            ,'a000_nome' => 'Texto de vencimento do documento do contrato'
            ,'a000_descricao' => 'utilizado para e-mail que o usuário responsável pelo contrato irá receber quando algum documento estiver para vencer, data de vencimento (-) tempo de alerta de vencimetno'
            ,'a000_valor' => ''
            ,'a000_status' => 1
            ,'created_at_user' => '1'
            ,'a000_ind_adm' => 1
        ]);

        Parametro::create([
            'a000_sigla' => 'CONTRATOVENCIDO'
            ,'a000_nome' => 'Contrato Vencido'
            ,'a000_descricao' => 'utilizado para e-mail que o usuário responsável pelo contrato irá receber quando o contrato estiver na data de vencimento'
            ,'a000_valor' => ''
            ,'a000_status' => 1
            ,'created_at_user' => '1'
            ,'a000_ind_adm' => 1
        ]);


    }
}
