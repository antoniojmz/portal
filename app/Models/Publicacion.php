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

use App\Models\Consulta;

class Publicacion extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */

    public function listPublicaciones(){
        $idUser = Auth::id();
        $p = Session::get('perfiles');
        return DB::table('v_publicaciones')
                ->where('IdCliente',$p['v_detalle'][0]->IdCliente)
                ->get();
    }

    // Activar / Desactivar Usuario
    public function activarPublicacion($datos){
        $idAdmin = Auth::id();
        if ($datos['idEstado']>0){
            $values=array('idEstado'=>0,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
        }else{
            $values=array('idEstado'=>1,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
        }
        return DB::table('publicaciones')
                ->where('idNoticia', $datos['idNoticia'])
                ->update($values);
    }

    // registrar una nueva publicacion
    public function regPublicacion($datos){
        $p = Session::get('perfiles');
        $idAdmin = Auth::id();
        $idPrincipal = 0;
        $idNoticia = 0;
        $idOrden = 0;
        $fechaInicio = null;
        $fechaFin = null;
        if (isset($datos['idPrincipal'])){
            if ($datos['idPrincipal']=='on')
                $idPrincipal = 1;
        }
        if (isset($datos['idNoticia']))
            $idNoticia=$datos['idNoticia'];
        $model= new Consulta();
        if (isset($datos['fechaInicio']))
            $fechaInicio = $model->formatearFecha($datos['fechaInicio']);
        if (isset($datos['idOrden']))
            $idOrden=$datos['idOrden'];
        if (isset($datos['fechaFin'])){
            $fechaFin = $model->formatearFecha($datos['fechaFin']);
            $sql="select f_registro_publicacion(".$idNoticia.",'".$datos['titulo']."','".$datos['descripcion']."','".$datos['detalle']."','".$datos['proveedores']."',".$idOrden.",".$idPrincipal.",".$p['v_detalle'][0]->IdCliente.",STR_TO_DATE('".$fechaInicio."', '%Y-%m-%d'),STR_TO_DATE('".$fechaFin."', '%Y-%m-%d'),".$idAdmin.")";
        }else{
            $sql="select f_registro_publicacion(".$idNoticia.",'".$datos['titulo']."','".$datos['descripcion']."','".$datos['detalle']."','".$datos['proveedores']."',".$idOrden.",".$idPrincipal.",".$p['v_detalle'][0]->IdCliente.",STR_TO_DATE('".$fechaInicio."', '%Y-%m-%d'),STR_TO_DATE(null, '%Y-%m-%d'),".$idAdmin.")";

        }
        $execute=DB::select($sql);
        foreach ($execute[0] as $key => $value) {
            $result['f_registro_publicacion']=$value;
        }
        return $result;
    }

    // actualizar imagen de publicacion
    public function actualizarFotoPublicacion($idNoticia,$rutadelaimagen){
        try{
            DB::beginTransaction();
            $result=DB::table('publicaciones')
                ->where('idNoticia', $idNoticia)
                ->update(['urlImage' => $rutadelaimagen ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $result=0;
            log::info("##########################################################################");
            log::info("Ocurrio un error al tratar de actualizar la imagen de perfil del usuario: ".$idNoticia);
            log::info("Error: ".$e->getMessage());
            log::info("##########################################################################");
        }
        return $result;   
    }

    public function extractCodeJoson($string){
        $var = $string; 
        $var = str_replace('"','',$var); 
        $var = str_replace('{','',$var); 
        $var = str_replace('}','',$var); 
        $var = str_replace(':',',',$var);
        return explode(",",$var); 
    }
}