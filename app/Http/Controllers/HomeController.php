<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Log;
use Auth;

// Modelo
use App\Models\Home;
use App\Models\Consulta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getHome()
    {   
        $usuario = Auth::user();
        $data['idPerfil'] = $usuario->idPerfil;
        $model= new Home();
        $data['v_publicaciones'] = $model->listPublicacionesHome();
        return view('menu.home', $data);
    }

    public function getDashboard()
    {   
        $usuario = Auth::user();
        $data['idPerfil'] = $usuario->idPerfil;
        return view('menu.dasboard', $data);
    }

    public function postFacturacion(Request $request){
        $datos = $request->all();
        $model= new Consulta();
        if(isset($datos['IdDTE'])){ 
            $result['v_dtes'] = $model->BusDtesGraf($datos['IdDTE']);
            $result['v_info'] = '{"code":"204", "des_code":"No content."}';  
        }else{
            $result['v_info'] = '{"code":"-2", "des_code":"Se esperaban parametros de entrada."}';  
            $result['v_dtes'] = '';  
        }
        return $result;
    }

    
    public function postNoticia(Request $request){
        $datos = $request->all();
        $model= new Home();
        if(isset($datos['IdNoticia'])){ 
            $result['v_publicaciones'] = $model->BusNoticia($datos['IdNoticia']);
            $result['v_info'] = '{"code":"204", "des_code":"No content."}';  
        }else{
            $result['v_info'] = '{"code":"-2", "des_code":"Se esperaban parametros de entrada."}';  
            $result['v_publicaciones'] = '';  
        }
        return $result;
    }

    public function postFiltrarwidget(Request $request){
        $datos = $request->all();
        $model= new Consulta();
        $result = $model->filtrarFecha($datos['caso']);
        return $result;
    }
}