<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait; // add this trait to your user model

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'foto', 'ativo', 'idfacebook', 'api_token','username','create_password','primeiro_acesso', 'ind_super_adm', 'ind_adm','a001_id_usuario','created_at_user','updated_at_user', 'cadastro_completo','creditos'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isInadimplente()
    {
        $user_site = \App\User_site::where('email', $this->email)->first();
        $assinatura = \App\Assinatura::where('customer_id', $user_site->pagarme_customer_id)->first();

        if ($assinatura && !in_array($assinatura->status, ['paid', 'trialing'])) {
            return true;
        }

        return false;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token,$this->email));
    }


    public function Role_user_hasMany()
    {
        return $this->belongsToMany('App\Role_user','role_user','user_id','role_id');
    }

    public function Usuario_belongsTo()
    {
        return $this->belongsTo('App\Usuario', 'email', 'a001_email');
    }

}
