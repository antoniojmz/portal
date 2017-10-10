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

// Modelo
use App\Models\User;


class Password extends Authenticatable{

    public function recuperarPassword($datos){
    	$model= new User();
        $result = $model->cambiarPassword($datos);
        return $result; 
    }

    public function regUsuario($datos){
        $datos['idUser']==null ? $idUser=0 : $idUser= $datos['idUser'];
        $pass = substr($datos['usrUserName'], 0,6);
        $usrPassword=bcrypt($pass);
        $pusrPassInit=md5($pass);
        $sql="select f_registro_usuario(".$idUser.",'".$datos['usrUserName']."','".$usrPassword."','".$datos['usrNombreFull']."','".$pusrPassInit."',".$datos['idPerfil'].",".$datos['usrEstado'].",".$datos['idLoggeo'].",'".$datos['_token']."','".$datos['usrEmail']."')";
        $execute=DB::select($sql);
        $result['v_usuarios']=$this->listUsuario();
        foreach ($execute[0] as $key => $value) {
            $result['f_registro_usuario']=$value;
        }
        return $result;
    }
}