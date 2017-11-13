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
use Auth;


class User extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */

    protected $table = 'usuarios';

    protected $primaryKey = 'idUser';

    protected $fillable = [
        'auCreadoPor','auModificadoPor','idPerfil','usrEstado','usrNombreFull','usrUserName','usrEmail','usrUrlimage'
    ];

    protected $hidden = ['usrPassInit','usrPassword', 'remember_token'];

    protected $dates = [
        'auCreadoEl','auModificadoEl','usrUltimaVisita'
    ];

    // inicio de sesion de usuario
    public function verificarUsuario($data){
        $user = DB::table('v_usuarios')->where('usrUserName',$data['usrUserName'])->get();
        if (strlen($user)>3){
            if ($user[0]->usrEstado>0){
                if(isset($user[0]->usrPassword) && Hash::check($data['usrPassword'],$user[0]->usrPassword)){
                        $result=$user[0]->idUser;
                        (isset($data['remember'])) ? $bool="true" : $bool="false";  
                        Auth::loginUsingId($result,$bool);
                        if (Auth::check()){
                                $usuario = Auth::user();
                                $perfiles = DB::table('v_perfiles_usuarios')
                                ->where('idUser',$usuario->idUser)
                                ->where('activoPerfil',1)->get();
                                $nroPerfiles = count($perfiles);
                                Session::put('nroPerfiles', $nroPerfiles);
                                if ($nroPerfiles>1) {
                                    return '{"code":"200","des_code":"admin/accesos"}';
                                } elseif ($nroPerfiles>0 && $nroPerfiles<2) {
                                    $response = $this->mostrarPanel($perfiles[0]->idPerfil,$perfiles[0]->des_perfil);
                                    return $response;
                                } elseif ($nroPerfiles==0) {
                                    Auth::logout();
                                    return '{"code":"-2","des_code":"Perfil inactivo"}';
                                }
                        }else
                            return '{"code":"-2","des_code":"Ocurrio un error al iniciar la session"}';
                }
                return '{"code":"-2","des_code":"Usuario o contraseña incorrectos"}';
            }else{
                return '{"code":"-2","des_code":"Usuario Inactivo"}';
            }
        }else    
            return '{"code":"-2","des_code":"Usuario no registrado"}';
    }
 
    // cargar panel de control con los widget´s del usuario actual
    public function mostrarPanel($idPerfil,$des_perfil){
        $usuario = Auth::user();
        $result['idPerfil']=$idPerfil;
        $result['desPerfil']=$des_perfil; 
        Session::forget('perfiles');
        Session::forget('widget');
        switch ($idPerfil) {
            case 1:
                $result['v_detalle']=DB::table('v_usuarios')
                ->where('idUser',$usuario->idUser)->get();
                $widget['v_widget1']='';
                $widget['v_widget2']='';
                $widget['v_widget4']='';
                break;
            case 2:
                $result['v_detalle']= DB::table('v_clientes')
                ->where('idUser',$usuario->idUser)->get();
                $widget['v_widget1']='';
                $widget['v_widget2']='';
                $widget['v_widget4']='';
                break;
            case 3:
                $result['v_detalle']= DB::table('v_proveedores')
                ->where('idUser',$usuario->idUser)->get();
                $sql1="SELECT date_FORMAT(FechaEmision, '%m') MesGrupo, date_FORMAT(FechaEmision, '%m') as IdMesGrupo, date_FORMAT(FechaEmision, '%M') NombreMesGrupo, SUM(montoTotalCLP) MontoTotalMesGrupo, COUNT(1) NroDTEGrupo, (SELECT SUM(montoTotalCLP) FROM v_dtes where idProveedor = ".$result['v_detalle'][0]->IdProveedor.") AS MontoVentaTotal ,(SELECT COUNT(1) FROM v_dtes where idProveedor = ".$result['v_detalle'][0]->IdProveedor.") AS NroTotalDTE FROM v_dtes where idProveedor = ".$result['v_detalle'][0]->IdProveedor." and DATE_FORMAT(FechaEmision, '%Y') = DATE_FORMAT(NOW(), '%Y') GROUP BY MesGrupo, IdMesGrupo, NombreMesGrupo";
                // $sql2="select IdEstadoDTE, SUM(montoTotalCLP) as MontoTotal, COUNT(1) as cantidad, EstadoActualDTE, ROUND( SUM(montoTotalCLP) / (SELECT SUM(d.montoTotalCLP) FROM v_dtes d where d.idProveedor = ".$result['v_detalle'][0]->IdProveedor.") * 100) AS Porcentaje from v_dtes  where idProveedor = ".$result['v_detalle'][0]->IdProveedor." GROUP BY IdEstadoDTE,EstadoActualDTE";
                $sql2="select group_concat(IdDTE) as id_dtes, IdEstadoDTE,EstadoActualDTE, idProveedor, SUM(montoTotalCLP) as MontoTotal, COUNT(1) as cantidad, ROUND( SUM(montoTotalCLP) / (SELECT SUM(d.montoTotalCLP) FROM v_dtes d where d.idProveedor = ".$result['v_detalle'][0]->IdProveedor.") * 100) AS Porcentaje FROM v_dtes where idProveedor =".$result['v_detalle'][0]->IdProveedor." GROUP BY IdEstadoDTE, EstadoActualDTE, idProveedor";
                $widget['v_widget1']=DB::select($sql1);
                $widget['v_widget2']=DB::select($sql2);
                $widget['v_widget4']=DB::select("select count(1) as Cantidad, t1.IdEstadoDTE, t1.NombreEstado, t1.IdProveedor from (select * from v_dte_estados order by FechaEstado DESC) t1 where IdProveedor=".$result['v_detalle'][0]->IdProveedor." group by t1.IdEstadoDTE,t1.NombreEstado,t1.IdProveedor limit 50");
                break;
        }
        Session::put('perfiles', $result);
        Session::put('widget', $widget);
        return '{"code":"200","des_code":"home"}';
    }

    // Listar usuarios registrados
    public function listUsuario(){
        $result = DB::table('v_usuarios')->get();
        return $result;
    }

    // Cargar combo de perfiles de usuario
    // public function listPerfilesUsuario($data){
    //     return DB::table('v_perfiles')->get();
    // }

    // Cargar combo de perfiles de usuario
    public function listPerfiles(){
        return DB::table('v_perfiles')->get();
    }

    // Listar los perfiles activos para que el usuario acceso despues de iniciar session
    public function perfilesDisponibles(){
        $idUser = Auth::id();
        $result = DB::table('v_perfiles_usuarios')
                ->where('idUser',$idUser)
                ->where('activoPerfil',1)
                ->orderBy('idPerfil')
                ->get();  
        return $result;            
    }

    // Listar los perfiles del usuario sin importar su estatus (Administrador de perfiles)
    public function listPerfilesAdministrador($idUser){
        $result = DB::table('v_perfiles_usuarios')
                ->where('idUser',$idUser)
                ->orderBy('idPerfil')
                ->get();  
        return $result;            
    }

    // Cargar combo de estados de usuario (Activi / Inactivo)
    public function listEstados(){
        return DB::table('v_estados')->get();
    }

    // registrar un nuevo usuario en la aplicacion
    public function regUsuario($datos){
        $datos['idUser']==null ? $idUser=0 : $idUser= $datos['idUser'];
        $pass = substr($datos['usrUserName'], 0,6);
        $usrPassword=bcrypt($pass);
        $pusrPassInit=md5($pass);
        $sql="select f_registro_usuario(".$idUser.",'".$datos['usrUserName']."','".$usrPassword."','".$datos['usrNombreFull']."','".$pusrPassInit."',".$datos['usrEstado'].",".$datos['idLoggeo'].",'".$datos['_token']."','".$datos['usrEmail']."')";
        $execute=DB::select($sql);
        $result['v_usuarios']=$this->listUsuario();
        foreach ($execute[0] as $key => $value) {
            $result['f_registro_usuario']=$value;
        }
        return $result;
    }

    // Asignar un nuevo perfil a un usuario
    public function regPerfil($datos){
        $idAdmin = Auth::id();
        $sql="select f_registro_perfil(".$datos['idUser'].",".$datos['idPerfil'].",".$idAdmin.")";
        $execute=DB::select($sql);
        $result['v_perfiles'] = $this->listPerfilesAdministrador($datos['idUser']);
        // $result['v_usuarios']=$this->listUsuario();
        foreach ($execute[0] as $key => $value) {
            $result['f_registro_perfil']=$value;
        }
        return $result;
    }

    // Registrar la ultima visita del usuario
    public function registrarVisita($idUser){
        $now = new DateTime();
        DB::table('usuarios')->where('idUser', $idUser)->update(['usrUltimaVisita' => $now]);
    }
    
    // Activar / Desactivar Usuario
    public function activarUsuario($datos){
        $idAdmin = Auth::id();
        if ($datos['usrEstado']>0){
            $values=array('usrEstado'=>0,'auModificadoEl'=>date("Y-m-d H:i:s"),'auModificadoPor'=>$idAdmin);
        }else{
            $values=array('usrEstado'=>1,'auModificadoEl'=>date("Y-m-d H:i:s"),'auModificadoPor'=>$idAdmin);
        }
        return DB::table('usuarios')
                ->where('idUser', $datos['idUser'])
                ->update($values);
    }

    // Activar / Desactivar perfiles de usuario
    public function activarPerfil($datos){
        $idAdmin = Auth::id();
        if ($datos['activoPerfil']>0){
            $values=array('activoPerfil'=>0,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
        }else{
            $values=array('activoPerfil'=>1,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
        }
        return DB::table('usuarios_perfiles')
                ->where('idUsuarioPerfil', $datos['idUsuarioPerfil'])
                ->update($values);
    }


    // actualizacion de datos del usuario por el mismo
    public function actualizarDatos($data){
        try{
            DB::beginTransaction();
            $values=array('usrNombreFull'=>$data['usrNombreFull'],'usrEmail'=>$data['usrEmail']);
            $result=DB::table('usuarios')
                ->where('idUser', $data['idUser'])
                ->update($values);
             DB::commit();
        }catch (Exception $e) {
            DB::rollback();
            $result=$e;
        }
        return $result;
    }

    // actualizar imagen de perfil
    public function actualizarFoto($idUser,$rutadelaimagen){
        try{
            DB::beginTransaction();
            $result=DB::table('usuarios')
                ->where('idUser', $idUser)
                ->update(['usrUrlimage' => $rutadelaimagen ]);
            DB::commit();
        } catch (Throwable $t) {
            DB::rollback();
            throw $t;
            $result= $t;
        }
        return $result;   
    }
    
    // eliminar imagen de perfil
    public function eliminarFoto($datos){
        try{
            DB::beginTransaction();
            $result=DB::table('usuarios')
                ->where('idUser', $datos['idUser'])
                ->update(['usrUrlimage' => null ]);
            DB::commit();
            $res='{"code":"204","des_code":"No content"}';
        } catch (Throwable $t) {
            DB::rollback();
            throw $t;
            $res='{"code":"500","des_code":"'.$t.'"}';
        }
        return $res;
    }

    // cambio de contraseña por el usuario
    public function cambiarClave($data){
        $pass = DB::table('v_usuarios')->where('idUser',$data['idUser'])->value('usrPassword');
        if ($data['password_old']==$data['password']){
          $return='{"code":"-1","des_code":"La contraseña nueva no puede ser igual a la actual"}';
        }
        if(isset($pass) && Hash::check($data['password_old'],$pass)){
                if($data['password']==$data['password_confirmation']){
                    $data['password']=bcrypt($data['password']);
                    try{
                            DB::beginTransaction();
                            DB::update('update usuarios set usrPassword = ? where idUser = ?', [$data['password'],$data['idUser']]);
                            DB::commit();
                            $return='{"code":"200","des_code":"La contraseña se cambio exitosamente"}';
                    }catch (Exception $e) {
                        DB::rollback();
                        return $e->getMessage();
                    }
                }else{
                    $return='{"code":"-1","des_code":"Las contraseñas no coinciden"}';
                }
        }else{
            $return='{"code":"-1","des_code":"La contraseña actual no es correcta"}';
        }
        return $return;
    }

    // Recuperacion de password por el usuario y por el administrador del sistema
    public function cambiarPassword($datos){
        $count = DB::table('v_usuarios')
            ->where('usrEmail', $datos['email'])
            ->count();
        if($count<1){
            return '{"code":"404","des_code":"Lo sentimos, este email no se encuetra registrado"}';
        }
        $pass=$this->generarPassword();
        $Password=bcrypt($pass);
        try{
            DB::beginTransaction();
            $result=DB::table('usuarios')
                ->where('usrEmail', $datos['email'])
                ->update(['usrPassword' => $Password ]);
            DB::commit();
        } catch (Throwable $t) {
            DB::rollback();
            throw $t;
            return '{"code":"500","des_code":"Ocurrio un error al intentar recuperar el password"}';
        }
        $usrNombreFull = DB::table('v_usuarios')
                        ->where('usrEmail',$datos['email'])->value('usrNombreFull');
        $notificacion = $this->enviarEmail($datos['email'],$usrNombreFull,$pass);
        return $notificacion;
    }

    // gererar un pass aleatorio
    public function generarPassword(){
        return str_random(10);
    }

    // Enviar password por email
    public function enviarEmail($email,$usrNombreFull,$pass){
        $pathToFile="";
        $containfile=false; 
        $destinatario=$email;
        $asunto="Recuperación de password";
        $contenido="Estima@ ".$usrNombreFull.". Esta notificación es para informarle que se ha solicitado una recuperación de contraseña por su usuario. Su nueva clave es :<b> ".$pass."</b> <p>Si usted no reconoce esta solicitud contacte al administrador del sistema.</p>";
        $data = array('contenido' => $contenido);
        Mail::send('auth.emails.reinicioClave', $data, function ($message) use ($asunto,$destinatario,$containfile,$pathToFile){
            $message->from('moraanto2017@gmail.com', 'Portal de Proveedores');
            $message->to($destinatario)->subject($asunto);
            if($containfile){
             $message->attach($pathToFile);
            }
        });
        if (!Mail::failures()) {
            return '{"code":"200","des_code":"Su nueva contraseña ha sido enviada via email"}';
        }else{
            return '{"code":"500","des_code":"Ocurrio un error mientras se enviaba el correo"}';
        }
    }
}