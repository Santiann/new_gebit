<?php

namespace App\Notifications;

use App\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token,$email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail($notifiable)
    {
        //Salvando na tabela de log de e-mail
        $requestData                    = array();
        $requestData['a997_de_nome']    = 'dealix';
        $requestData['a997_de_email']   = 'naoresponda@dealix.com.br';
        $requestData['a997_para_nome']  = $notifiable->getEmailForPasswordReset();
        $requestData['a997_para_email'] = $notifiable->getEmailForPasswordReset();
        $requestData['a997_assunto']    = config('app.name').' - Recuperar senha';
        $requestData['a997_conteudo']   = ' Este e-mail foi enviado com base em sua solicitação para redefinir a senha de sua conta. Clique aqui ' .url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], true)). " " .' Este link de redefinição de senha expirará em 60  ' ;
        $cadastroEmail                  = Email::create($requestData);

        return (new MailMessage)
            ->subject(config('app.name').' - Recuperar senha')
            ->line('Este e-mail foi enviado com base em sua solicitação para redefinir a senha de sua conta.')
            ->action('Clique aqui', url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], true)))
            ->line('Este link de redefinição de senha expirará em 60 minutos');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}
