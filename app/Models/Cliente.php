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

class Cliente extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */

    public function listCliente(){
        $idUser = Auth::id();
        $p = Session::get('perfiles');
        switch ($p['idPerfil']) {
            // Perfil administrador
            case 1:
                $result = DB::table('v_proveedores_clientes')
                ->select('IdCliente', 'RutCliente', 'NombreCliente', 'RazonSocial', 'PersonaContactoCliente', 'TelefonoContactoCliente','NombreFantasiaCliente')
                ->whereNotNull('IdCliente')
                ->groupBy('IdCliente', 'RutCliente', 'NombreCliente', 'RazonSocial', 'PersonaContactoCliente', 'TelefonoContactoCliente','NombreFantasiaCliente')
                ->get();
                break;
            // Perfil Cliente
            case 2:
                $result = DB::table('v_proveedores_clientes')
                ->select('IdCliente', 'RutCliente', 'NombreCliente', 'RazonSocial', 'PersonaContactoCliente', 'TelefonoContactoCliente','NombreFantasiaCliente')
                ->where('idUserCliente',$idUser)
                ->whereNotNull('IdCliente')
                ->groupBy('IdCliente', 'RutCliente', 'NombreCliente', 'RazonSocial', 'PersonaContactoCliente', 'TelefonoContactoCliente','NombreFantasiaCliente')
                ->get();
                break; 
            // Perfil Proveedor
            case 3:
                $result = DB::table('v_proveedores_clientes')
                ->select('IdCliente', 'RutCliente', 'NombreCliente', 'RazonSocial', 'PersonaContactoCliente', 'TelefonoContactoCliente','NombreFantasiaCliente')
                ->where('idUserProveedor',$idUser)
                ->whereNotNull('IdCliente')
                ->groupBy('IdCliente', 'RutCliente', 'NombreCliente', 'RazonSocial', 'PersonaContactoCliente', 'TelefonoContactoCliente','NombreFantasiaCliente')
                ->get();
                break; 
            default: 
                log::info("Se requieren permisos");
                $result = "Se requieren permisos";
            break;
        }
        return $result;
    }

    public function listBusquedaCliente(){
        return DB::table('v_busq_cliente')->get();
    }

    public function BuscarCliente($d){
        $idUser = Auth::id();
        $var = 0;
        $p = Session::get('perfiles');
        $sql = "select IdCliente, RutCliente, NombreCliente, RazonSocial, PersonaContactoCliente, TelefonoContactoCliente, NombreFantasiaCliente from v_proveedores_clientes where upper(".$d['Selectcampo'].") like '%".$d['descripcion']."%' ";
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
        $sql .=" group by IdCliente, RutCliente, NombreCliente, RazonSocial, PersonaContactoCliente, TelefonoContactoCliente, NombreFantasiaCliente";
        return DB::select($sql);
    }

    public function BuscarDetalleC($id){
    	$result['v_cliente'] = DB::table('v_proveedores_clientes')
                ->where('IdCliente',$id)
                ->limit(1)
                ->get();
        $result['v_dtes'] = DB::table('v_dtes')->where('IdCliente',$id)->get();
        $result['v_clientes_proveedores'] = DB::table('v_clientes_tienen_proveedores')->where('IdCliente',$id)->get();
        $result['v_clientes_usuarios'] = DB::table('v_clientes_tienen_usuarios')->where('IdCliente',$id)->get();
        return $result;	
    }

}