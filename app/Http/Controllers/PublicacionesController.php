<?php

namespace App\Http\Controllers;

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
use Storage;
use DB;

// Modelo
use App\Models\Publicacion;
use App\Models\Proveedor;

class PublicacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getPublicaciones(){
        $model= new Proveedor();
        $data['v_proveedores'] = $model->listRegProveedorCombo();
        return View::make('publicaciones.publicaciones',$data);
    }

    protected function getListpublicaciones(){
        $model= new Publicacion();
        $data['v_publicaciones'] = $model->listPublicaciones();
        return $data;
    }

    protected function postPublicaciones(Request $request){
        $archivo = $request->file('img');
        $datos = $request->all();
        $model= new Publicacion();
        $result = $model->regPublicacion($datos);
        $var = $model->extractCodeJoson($result['f_registro_publicacion']);
        if ($var[1]==200){
            $idNoticia=$var[5];
            $fotoOld = $request->input('urlImage');
            $input  = array('foto' => $archivo) ;
            if (isset($archivo)){
                if ($fotoOld<>null){
                    $array= explode('/', $fotoOld);
                    Storage::disk($array[1])->delete($array[2]);
                } 
                $reglas = array('foto' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:10000');
                $validacion = Validator::make($input,  $reglas);
                if ($validacion->fails()){
                  $result['urlImage'] = '{"code":"-3","des_code":"Debe cargar una imagen"}';
                }else{
                    $nombre_original=$archivo->getClientOriginalName();
                    $extension=$archivo->getClientOriginalExtension();
                    $nuevo_nombre="idNoticia-".$idNoticia.".".$extension;
                    $r1=Storage::disk('imgNoticias')->put($nuevo_nombre,  \File::get($archivo) );
                    $rutadelaimagen="/imgNoticias/".$nuevo_nombre;
                    if ($r1){
                        // sleep(5); 
                        $result2 = $model->actualizarFotoPublicacion($idNoticia,$rutadelaimagen);
                        $result['urlImage']='{"code":"200","des_code":"'.$rutadelaimagen.'"}';
                    }else{
                        $result['urlImage']='{"code":"-3","des_code":"Ocurrio un erro al cargar la imagen"}';
                    }
                }    
            }else{
                $result['urlImage']='{"code":"200","des_code":""}';
            }
        }else{
            $result['urlImage']='{"code":"-3","des_code":""}';
        }
        $result['v_publicaciones'] = $model->listPublicaciones();
        return $result;
    }

    // Activar / Desactivar publicaciones
    protected function postPublicacionactivo(Request $request){
        $datos = $request->all();
        $model= new Publicacion();
        $result['activar'] = $model->activarPublicacion($datos);
        $result['v_publicaciones'] = $model->listPublicaciones();
        return $result;
    }
}