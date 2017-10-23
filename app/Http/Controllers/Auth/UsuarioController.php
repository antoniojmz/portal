<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;


use Form;
use Lang;
use View;
use Redirect;
use SerializesModels;
use Log;
use Session;
use Config;
use Mail;
use Storage;
use DB;

// Modelo
use App\Models\User;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getUsuarios(){
        $data['title'] = 'Listado de usuarios';
        $model= new User();
        $data['v_usuarios'] = $model->listUsuario();
        $data['v_perfiles'] = $model->listPerfiles();
        $data['v_estados'] = $model->listEstados();
        // return $data;
        return View::make('usuarios.usuarios',$data);
    }

    protected function postUsuarios(Request $request){
        $datos = $request->all();
        // Todos los datos del usuario loggeado
        // $user = Auth::user();
        // El id del usuario logeado
        $datos['idLoggeo'] = Auth::id();
        $model= new User();
        $result = $model->regUsuario($datos);
        return $result;
    }

    protected function getPassword (){
        $data['title'] = 'Cambio de password';
        $idUser = Auth::id();
        return View::make('auth.passwords.cambioPassword',$data);
    }

    protected function postPassword (Request $request){
        $datos = $request->all();
        $datos['idUser'] = Auth::id();
        $model= new User();
        $result= $model->cambiarClave($datos);
        return $result;
    }

    protected function getPerfil (){
        $data['title'] = 'Mi Perfíl';
        $data['v_datos'] = Auth::user();
        return View::make('perfiles.perfiles',$data);
    }

    protected function postPerfil (Request $request){
        $datos = $request->all();
        $model= new User();
        $result= $model->actualizarDatos($datos);
        return $result;
    }

    protected function postCargarfoto (Request $request){
        $idUser=$request->input('idUser');
        $archivo = $request->file('foto');
        $input  = array('foto' => $archivo) ;
        $reglas = array('foto' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:5000');
        $validacion = Validator::make($input,  $reglas);
        if ($validacion->fails()){
          return '{"code":"-2","des_code":"Debe cargar una imagen"}';
        }else{
            $nombre_original=$archivo->getClientOriginalName();
            $extension=$archivo->getClientOriginalExtension();
            $nuevo_nombre="idUser-".$idUser.".".$extension;
            $r1=Storage::disk('imgUsuarios')->put($nuevo_nombre,  \File::get($archivo) );
            $rutadelaimagen="/imgUsuarios/".$nuevo_nombre;
            if ($r1){
                $model= new User();
                $result= $model->actualizarFoto($idUser,$rutadelaimagen);
                return '{"code":"200","des_code":"'.$rutadelaimagen.'"}';
            }else{
                return '{"code":"-3","des_code":"Ocurrio un erro al cargar la imagen"}';
            }
        } 

    }

    protected function postEliminarfoto (Request $request){
        $datos = $request->all();
        if ($datos['usrUrlimage']<>null){
            $array= explode('/', $datos['usrUrlimage']);
            Storage::disk($array[1])->delete($array[2]);
        } 
        $model= new User();
        $result=$model->eliminarFoto($datos);
        return $result;
    }

    protected function postReiniciar (Request $request){
        $datos = $request->all();
        $datos['email']=$datos['usrEmail'];
        $model= new User();
        $result = $model->cambiarPassword($datos);
        return $result;
    }

}