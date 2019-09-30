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

    // Registro de proveedores por parte del clientes y proveedores
    public function listRegProveedor(){
        $p = Session::get('perfiles');
        $idperfil = $p['idPerfil'];
        switch ($idperfil) {
            case 2:
                return DB::table('v_clientes_tienen_proveedores')
                        ->select('idUser','usrUserName','usrNombreFull','usrEmail','usrEstado','des_estado','usrUltimaVisita','creador','modificador','idPerfil','des_Perfil','auCreadoEl','auCreadoPor','auModificadoEl','auModificadoPor','EstadoBloqueo','DescripcionBloqueo','NombreProveedor')
                        ->where('IdCliente',$p['v_detalle'][0]->IdCliente)
                        ->groupBy('idUser','usrUserName','usrNombreFull','usrEmail','usrEstado','des_estado','usrUltimaVisita','creador','modificador','idPerfil','des_Perfil','auCreadoEl','auCreadoPor','auModificadoEl','auModificadoPor','EstadoBloqueo','DescripcionBloqueo','NombreProveedor')
                        ->get();
            break;
            case 3:
                return DB::table('v_proveedores_tienen_usuarios')
                    ->where('IdProveedor',$p['v_detalle'][0]->IdProveedor)->get();
            break;
        }

    }

    public function listRegEstados(){
        return DB::table('v_estados')->get();
    }

    public function listRegProveedorCombo(){
        $p = Session::get('perfiles');
        $idperfil = $p['idPerfil'];
        
        switch ($idperfil) {
            case 2:
                return DB::table('v_proveedores_combo')
                            ->select('id', 'text')
                            ->where('Idcliente', $p['v_detalle'][0]->IdCliente)
                            ->groupBy('id','text')
                            ->get();
                break;
            case 3:
                $idUser = Auth::id();
                // return DB::table('v_proveedores_combo')
                return DB::table('v_proveedores_tienen_usuarios')
                    ->select('IdProveedor as id','NombreProveedor as text')
                    ->where('idUser',$idUser)
                    ->groupBy('IdProveedor','NombreProveedor')    
                    ->get();
                break;
        }
    }

    public function listEmpresasProveedor($datos){
        $p = Session::get('perfiles');
        $idperfil = $p['idPerfil'];
        switch ($idperfil) {
            case 2:
                return DB::table('v_clientes_tienen_proveedores')
                    ->where('IdCliente',$p['v_detalle'][0]->IdCliente)
                    ->where('idUser',$datos['idUser'])->get();
                break;
            case 3:
                return DB::table('v_proveedores_tienen_usuarios')->where('idUser',$datos['idUser'])->get();
                break;
        }
    }

    public function regEmpresa($datos){
        $p = Session::get('perfiles');
        $idAdmin = Auth::id();
        $idperfil = $p['idPerfil'];
        switch ($idperfil) {
            case 2:
                $idClienteProveedor=$p['v_detalle'][0]->IdCliente;
                $caso= 3;
            break;
            case 3:
                $idClienteProveedor=$p['v_detalle'][0]->IdProveedor;
                $caso= 4;
            break;
        }
        $sql="select f_registro_empresa(".$datos['idUser'].",".$idClienteProveedor.",".$datos['idProveedor'].",".$idAdmin.",".$caso.")";
        // log::info($datos);
        // log::info($sql);
        $execute=DB::select($sql);
        $result['v_empresas'] = $this->listEmpresasProveedor($datos);
        foreach ($execute[0] as $key => $value) {
            $result['f_registro_empresa']=$value;
        }
        return $result;
    }

    // Activar / Desactivar Empresas en usuario proveedor
    public function activarEmpresa($datos){
        $idAdmin = Auth::id();
        $p = Session::get('perfiles');
        $idperfil = $p['idPerfil'];
        switch ($idperfil) {
            case 2:
                if ($datos['EstadoProveedor']>0){
                    $values=array('EstadoProveedor'=>0,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
                }else{
                    $values=array('EstadoProveedor'=>1,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
                }
                return DB::table('clientes_tienen_proveedores')
                    ->where('IdProveedor',$datos['IdProveedor'])
                    ->where('IdCliente', $p['v_detalle'][0]->IdCliente)
                    ->update($values);
                break;
            case 3:
                if ($datos['EstadoUsuario']>0){
                    $values=array('EstadoUsuario'=>0,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
                }else{
                    $values=array('EstadoUsuario'=>1,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
                }
                return DB::table('proveedores_tienen_usuarios')
                    ->where('IdProveedor',$datos['IdProveedor'])
                    ->where('idUser', $datos['idUser'])
                    ->update($values);
            break;
        }

    }
}