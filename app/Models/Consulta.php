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
        $p = Session::get('perfiles');
        switch ($p['idPerfil']) {
            // Perfil administrador
            case 1:
                $result = DB::table('v_dtes')->get();
                break;
            // Perfil Cliente
            case 2:
                $result = DB::table('v_dtes')->where('IdCliente',$p['IdCliente'])->get();
                break;
            // Perfil Proveedor
            case 3:
                $result = DB::table('v_dtes')->where('IdProveedor',$p['IdProveedor'])->get();
                break;
        }
        return $result;
    }

    public function BuscarDtes($d){
        $var = 0;
        $p = Session::get('perfiles');

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
            $var = 1;      
            $pre2 .= "upper(".$d['Selectcampo'].") like '%".$d['descripcion']."%'";
            $sql .= $pre2; 
        }

        if ($d['SelectDTE'] <>null){
            $pre3="";
            if ($var >0){
                $pre3 = "and "; 
            }         
            $pre3 .= "TipoDTE=".$d['SelectDTE'];
            $sql .= $pre3; 
        }
        Log::info($sql);
        Log::info("antes del case");
        switch ($p['idPerfil']){
            // Perfil Cliente
            case 2:
                $pre4 = " and IdCliente=".$p['IdCliente'];
                $sql .= $pre4;
                break;
            // Perfil Proveedor
            case 3:
                $pre4 = " and IdProveedor=".$p['IdProveedor'];
                $sql .= $pre4;
                break;
        }
        return DB::select($sql);
    }

    public function BuscarDetalle($id){
        log::info($id);
        $result['v_dte_detalles'] = DB::table('v_dte_detalles')->where('IdDTE',$id)->get();
        $result['v_dte_estados'] = DB::table('v_dte_estados')->where('IdDTE',$id)->get();
        $result['v_dte_referencias'] = DB::table('v_dte_referencias')->where('IdDTE',$id)->get();
        return $result;
    }
    

    public function formatearFecha($d){
        $formato = explode("-", $d);
        $fecha = $formato[2]."-".$formato[1]."-".$formato[0];
        return $fecha;
    }
}