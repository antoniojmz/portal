<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\QueryException;
use App\Exceptions\Handler;

use DB;
use Log;
use DateTime;
use Session;
use Exception;
use Auth;

class Proveedor extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */

    public function listProveedor(){
        $idUser = Auth::id();
        $p = Session::get('perfiles');

        switch ($p['idPerfil']) {
            // Perfil administrador
            case 1:
                $result = DB::table('v_proveedores_clientes')
                ->select('IdProveedor','RutProveedor','RazonSocialProveedor','TelefonoProveedor','CorreoElectronico','PersonaContacto','TelefonoContacto','DatosPago','EstadoProveedor','NombreFantasia')
                ->groupBy('IdProveedor','RutProveedor','RazonSocialProveedor','TelefonoProveedor','CorreoElectronico','PersonaContacto','TelefonoContacto','DatosPago','EstadoProveedor','NombreFantasia')
                ->get();
                break;
            // Perfil Cliente
            case 2:
            $sql= "";
                $result = DB::table('v_proveedores_clientes')
                ->select('IdProveedor','RutProveedor','RazonSocialProveedor','TelefonoProveedor','CorreoElectronico','PersonaContacto','TelefonoContacto','DatosPago','EstadoProveedor','NombreFantasia')
                ->where('idUserCliente',$idUser)
                ->groupBy('IdProveedor','RutProveedor','RazonSocialProveedor','TelefonoProveedor','CorreoElectronico','PersonaContacto','TelefonoContacto','DatosPago','EstadoProveedor','NombreFantasia')
                ->get();
                break; 
            // Perfil Proveedor
            case 3:
                $result = DB::table('v_proveedores_clientes')
                ->select('IdProveedor','RutProveedor','RazonSocialProveedor','TelefonoProveedor','CorreoElectronico','PersonaContacto','TelefonoContacto','DatosPago','EstadoProveedor','NombreFantasia')
                ->where('idUserProveedor',$idUser)
                ->groupBy('IdProveedor','RutProveedor','RazonSocialProveedor','TelefonoProveedor','CorreoElectronico','PersonaContacto','TelefonoContacto','DatosPago','EstadoProveedor','NombreFantasia')
                ->get();
                break; 
            default:
                log::info("Se requieren permisos");
                $result = "Se requieren permisos";
            break;
        }
        return $result;
    }

    public function listBusquedaProveedor(){
        return DB::table('v_busq_proveedor')->get();
    }

    public function BuscarProveedor($d){
        $idUser = Auth::id();
        $var = 0;
        $p = Session::get('perfiles');
        $sql = "select IdProveedor,RutProveedor,RazonSocialProveedor,TelefonoProveedor,CorreoElectronico,PersonaContacto,TelefonoContacto,DatosPago, EstadoProveedor, NombreFantasia from v_proveedores_clientes where upper(".$d['Selectcampo'].") like '%".$d['descripcion']."%' ";
        switch ($p['idPerfil']){
            // Perfil Cliente
            case 2:
                $sql .= "and idUserCliente=".$idUser;
                break;
            // Perfil Proveedor
            case 3:
                $sql .= "and idUserProveedor=".$idUser;
                break;
        }
        $sql .=" group by IdProveedor,RutProveedor,RazonSocialProveedor,TelefonoProveedor,CorreoElectronico,PersonaContacto,TelefonoContacto,DatosPago, EstadoProveedor, NombreFantasia";
        return DB::select($sql);
    }

    public function BuscarDetalleP($id){
    	$result['v_proveedor'] = DB::table('v_proveedores_clientes')
                ->where('IdProveedor',$id)
                ->limit(1)
                ->get();
        $result['v_dtes'] = DB::table('v_dtes')->where('IdProveedor',$id)->get();
        $result['v_clientes_proveedores'] = DB::table('v_clientes_tienen_proveedores')->where('IdProveedor',$id)->get();
        $result['v_proveedores_usuarios'] = DB::table('v_proveedores_tienen_usuarios')->where('IdProveedor',$id)->get();
        return $result;	
    }

}