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

    // Registro de proveedores por parte del cliente
    public function listRegProveedor(){
        $p = Session::get('perfiles');
        return DB::table('v_clientes_tienen_proveedores')
                ->select('idUser','usrUserName','usrNombreFull','usrEmail','usrEstado','des_estado','usrUltimaVisita','creador','modificador','idPerfil','des_Perfil','auCreadoEl','auCreadoPor','auModificadoEl','auModificadoPor')
                ->where('IdCliente',$p['v_detalle'][0]->IdCliente)
                ->groupBy('idUser','usrUserName','usrNombreFull','usrEmail','usrEstado','des_estado','usrUltimaVisita','creador','modificador','idPerfil','des_Perfil','auCreadoEl','auCreadoPor','auModificadoEl','auModificadoPor')
                ->get();
    }

    public function listRegEstados(){
        return DB::table('v_estados')->get();
    }

    public function listRegProveedorCombo(){
        $p = Session::get('perfiles');
        return DB::table('v_proveedores_combo')
            ->where('Idcliente',$p['v_detalle'][0]->IdCliente)->get();
    }

    public function listEmpresasProveedor($datos){
        $p = Session::get('perfiles');
        return DB::table('v_clientes_tienen_proveedores')
            ->where('IdCliente',$p['v_detalle'][0]->IdCliente)
            ->where('idUser',$datos['idUser'])->get();
    }


    public function regUsuarioProveedor($idUser,$datos){
        $idAdmin = Auth::id();
        $p = Session::get('perfiles');
        try{
            $count = DB::select("select count(1) as count from clientes_tienen_proveedores where IdCliente=".$p['v_detalle'][0]->IdCliente." and IdProveedor = ".$datos['idEmpresa']); 

            $values=array('IdProveedor'=>$datos['idEmpresa'],'idUser'=>$idUser,'auUsuarioCreacion'=>$idAdmin);
            $insert = DB::table('proveedores_tienen_usuarios')
                ->insert($values);
            
            if ($count[0]->count<1){
                $values2=array(
                    'Idcliente'=>$p['v_detalle'][0]->IdCliente,
                    'IdProveedor'=>$datos['idEmpresa'],
                    'auUsuarioCreacion'=>$idAdmin
                );
                $insert2 = DB::table('clientes_tienen_proveedores')
                    ->insert($values2);
            }
            $result = 1;
        } catch (Exception $e) {
            DB::rollback();
            $result=0;
            log::info("##########################################################################");
            log::info("Ocurrio un error al tratar de asignar un usuario a un proveedor : ".$idUser);
            log::info("Error: ".$e->getMessage());
            log::info("##########################################################################");
        }
        return $result;   
    }

    public function regEmpresa($datos){
        $p = Session::get('perfiles');
        $idAdmin = Auth::id();
        $sql="select f_registro_empresa(".$p['v_detalle'][0]->IdCliente.",".$datos['idProveedor'].",".$idAdmin.")";
        log::info($datos);
        log::info($sql);

        
        // $execute=DB::select($sql);
        // $result['v_perfiles'] = $this->listPerfilesAdministrador($datos['idUser']);
        // // $result['v_usuarios']=$this->listUsuario();
        // foreach ($execute[0] as $key => $value) {
        //     $result['f_registro_perfil']=$value;
        // }
        // return $result;
    }


    





}