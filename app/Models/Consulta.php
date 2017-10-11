<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\QueryException;
use App\Exceptions\Handler;

use DB;
use Crypt;
use Hash;
use Log;
use DateTime;
use Session;
use Mail;
use Storage;
use Exception;


class Consulta extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */

    protected $table = 'gpp_usuarios';

    protected $primaryKey = 'idUser';

    protected $fillable = [
        'auCreadoPor','auModificadoPor','idPerfil','usrEstado','usrNombreFull','usrUserName','usrEmail','usrUrlimage'
    ];

    protected $hidden = ['usrPassInit','usrPassword', 'remember_token'];

    protected $dates = [
        'auCreadoEl','auModificadoEl','usrUltimaVisita'
    ];

    public function BuscarUsuario($d){
        $var = 0;
        $sql = "select * from v_usuarios where ";
        if ($d['f_desde'] <>null && $d['f_hasta'] <>null){
            $desde = $this->formatearFecha($d['f_desde']);
            $hasta = $this->formatearFecha($d['f_hasta']);
            $pre1= "auCreadoEl >= '".$desde."' and auCreadoEl <= '".$hasta."' ";
            $sql .= $pre1;
            $var = 1;
        }
        if ($d['Selectcampo'] <>null){  
            $pre2="";
            if ($var >0){
                $pre2 = "and "; 
            }      
            $pre2 .= $d['Selectcampo']." like '%".$d['descripcion']."%'";
            $sql .= $pre2; 
        }
        log::info($sql);
        return DB::select($sql);
    }

    public function formatearFecha($d){
        $formato = explode("-", $d);
        $fecha = $formato[2]."-".$formato[1]."-".$formato[0];
        return $fecha;
    }
}