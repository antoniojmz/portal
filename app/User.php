<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'gpp_usuarios';
    
    protected $fillable = [
        'usrUserName','usrEmail', 'usrNombreFull', 'usrPassInit','idPerfil', 'usrEstado', 'usrUltimaVisita','auCreadoEl','auCreadoPor','auModificadoEl','auModificadoPor', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'usrPassword', 'remember_token',
    ];
}
