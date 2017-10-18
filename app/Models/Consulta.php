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

    public function listDtes($id){
        $result = DB::table('v_dtes')->where('IdProveedor',$id)->get();
        return $result;
    }

    public function BuscarDtes($d){
        log::info($d);
        $var = 0;
        $sql = "select * from v_dtes where ";
        if ($d['f_desde'] <>null && $d['f_hasta'] <>null){
            $desde = $this->formatearFecha($d['f_desde']);
            $hasta = $this->formatearFecha($d['f_hasta']);
            $pre1= "CAST(FechaEmision AS DATE) >= '".$desde."' and CAST(FechaEmision AS DATE) <= '".$hasta."' ";
            $sql .= $pre1;
            $var = 1;
        }
        if ($d['Selectcampo'] <>null){  
            $pre2="";
            if ($var >0){
                $pre2 = "and "; 
            }      
            $pre2 .= "upper(".$d['Selectcampo'].") like '%".$d['descripcion']."%'";
            $sql .= $pre2; 
        }
        if ($d['SelectDTE'] <>null){       
            $pre3 = "and TipoDTE=".$d['SelectDTE'];
            $sql .= $pre3; 
        }
        return DB::select($sql);
    }

    public function formatearFecha($d){
        $formato = explode("-", $d);
        $fecha = $formato[2]."-".$formato[1]."-".$formato[0];
        return $fecha;
    }
}