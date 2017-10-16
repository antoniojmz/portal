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


class User extends Authenticatable
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

    public function verificarUsuario($data){
        $user = DB::table('gpp_usuarios')->where('usrUserName',$data['usrUserName'])->get();
        $result=0;
        if(isset($user[0]->usrPassword) && Hash::check($data['usrPassword'],$user[0]->usrPassword)){
            $result=$user[0]->idUser;
            // Guardar todo el menu del usuario en Session
            Session::put('key', array(1,2,3,4,5));
        }
        return $result;
    }

    public function listUsuario(){
        $result = DB::table('v_usuarios')->get();
        return $result;
    }

    public function listPerfiles(){
        return DB::table('v_perfiles')->get();
    }

    public function listEstados(){
        return DB::table('v_estados')->get();
    }

    public function regUsuario($datos){
        $datos['idUser']==null ? $idUser=0 : $idUser= $datos['idUser'];
        $pass = substr($datos['usrUserName'], 0,6);
        log::info("Mi pass de inicio es: ".$pass);
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

    public function registrarVisita($idUser){
        $now = new DateTime();
        DB::table('gpp_usuarios')->where('idUser', $idUser)->update(['usrUltimaVisita' => $now]);
    }

    public function cambiarClave($data){
        $data= $data;
        $pass = DB::table('gpp_usuarios')->where('idUser',$data['idUser'])->value('usrPassword');
        if ($data['password_old']==$data['password']){
          $return='{"code":"-1","des_code":"La contraseña nueva no puede ser igual a la actual"}';
        }
        if(isset($pass) && Hash::check($data['password_old'],$pass)){
                if($data['password']==$data['password_confirmation']){
                    $data['password']=bcrypt($data['password']);
                    try{
                            DB::beginTransaction();
                            DB::update('update gpp_usuarios set usrPassword = ? where idUser = ?', [$data['password'],$data['idUser']]);
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
    
    public function actualizarDatos($data){
        try{
            DB::beginTransaction();
            $values=array('usrNombreFull'=>$data['usrNombreFull'],'usrEmail'=>$data['usrEmail']);
            $result=DB::table('gpp_usuarios')
                ->where('idUser', $data['idUser'])
                ->update($values);
             DB::commit();
        }catch (Exception $e) {
            DB::rollback();
            $result=$e;
        }
        Log::info("Este es el result");
        Log::info($result);
        return $result;
    }

    public function actualizarFoto($idUser,$rutadelaimagen){
        try{
            DB::beginTransaction();
            $result=DB::table('gpp_usuarios')
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
    
    public function eliminarFoto($datos){
        try{
            DB::beginTransaction();
            $result=DB::table('gpp_usuarios')
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

    public function cambiarPassword($datos){
        $count = DB::table('gpp_usuarios')
            ->where('usrEmail', $datos['email'])
            ->count();
        if($count<1){
            return '{"code":"404","des_code":"Lo sentimos, este email no se encuetra registrado"}';
        }
        $pass=$this->generarPassword();
        $Password=bcrypt($pass);
        Log::info("Mi nuevo password: ".$pass);
        try{
            DB::beginTransaction();
            $result=DB::table('gpp_usuarios')
                ->where('usrEmail', $datos['email'])
                ->update(['usrPassword' => $Password ]);
            DB::commit();
        } catch (Throwable $t) {
            DB::rollback();
            throw $t;
            return '{"code":"500","des_code":"Ocurrio un error al intentar recuperar el password"}';
        }
        $usrNombreFull = DB::table('gpp_usuarios')
                        ->where('usrEmail',$datos['email'])->value('usrNombreFull');
        $notificacion = $this->enviarEmail($datos['email'],$usrNombreFull,$pass);
        return $notificacion;
    }

    public function generarPassword(){
        return str_random(10);
    }

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