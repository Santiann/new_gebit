<?php namespace Dealix\Register\Models;

use Model;

use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User_Auth extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mysql_system';

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'foto', 'ativo', 'idfacebook', 'api_token','username','create_password','primeiro_acesso', 'ind_super_adm', 'ind_adm','a001_id_usuario','created_at_user','updated_at_user', 'cadastro_completo'
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


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token,$this->email));
    }

    public function scopeFindByEmail($query, $email)
    {
        $query->where('email', $email);
    }


    // public function Role_user_hasMany()
    // {
    //     return $this->belongsToMany('App\Role_user','role_user','user_id','role_id');
    // }

}
