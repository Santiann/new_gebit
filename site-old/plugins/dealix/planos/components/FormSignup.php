<?php namespace Dealix\Planos\Components;

use Dealix\Planos\Models\Email;
use Cms\Classes\ComponentBase;
use Redirect;
use Flash;
use Validator;
use ValidationException;
use ApplicationException;

class FormSignup extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Formulario Cadastro',
            'description' => 'Listagem de Newsletter'
        ];
    }

    public function defineProperties()
    {
        return [
            'pageNumber' => [
                'title'       => 'rainlab.blog::lang.settings.posts_pagination',
                'description' => 'rainlab.blog::lang.settings.posts_pagination_description',
                'type'        => 'string',
                'default'     => '{{ :page }}'
            ]
        ];
    }

    public function onSubmitSignup()
    {
        $rules = [
            'email' => 'required|email|min:2|max:200'
        ];

//        $messages = [
//            'required'      => 'O campo :attribute � obrigat�rio.',
//            'email'         => 'O campo :attribute n�o � um email v�lido',
//            'min'           => 'O campo :attribute pode ter no m�nimo :min.',
//            'max'           => 'O campo :attribute pode ter no m�ximo :max',
//        ];

        //Para a execu��o se a valida��o n�o passsar.
        $validation = Validator::make(post(), $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        //Para a execu��o se o email existir
        if (Email::emailExists(post('email'))) {
            throw new ApplicationException('Email ja esta cadastrado');
        }

        $newEmail = new Email();
        $newEmail->email = post('email');
        if(!$newEmail->save()){
            throw new ApplicationException('Nao foi possivel salvar');
        }
    }
}