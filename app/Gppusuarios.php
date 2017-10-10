<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gppusuarios extends Model
{
    protected $table = 'gpp_usuarios';

    protected $fillable = [
        'usrUserName','usrEmail', 'usrNombreFull', 'usrPassInit','idPerfil', 'usrEstado', 'usrUltimaVisita','auCreadoEl','auCreadoPor','auModificadoEl','auModificadoPor', 
    ];

    protected $hidden = [
        'usrPassword', 'remember_token',
    ];
}
