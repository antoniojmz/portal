<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Session;
use Log;
use Auth;

// Modelo
use App\Models\Home;
use App\Models\Consulta;
use App\Models\Proveedor;


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
        // $data['user'] = Auth::user();
        // $idUser = Auth::id();
        // $data['idPerfil'] = $data['user']->idPerfil;
        $model= new Home();
        $data['v_publicaciones'] = $model->listPublicacionesHome();
        return view('menu.home', $data);
    }

    public function getDashboard(Request $request){
        //$model= new Consulta();
        $usuario = Auth::user();

        //$data = $model->filtrarFecha("12");
        //$data['idPerfil'] = $usuario->idPerfil;

        $modelPRV = new Proveedor();
        $data['v_proveedores'] = $modelPRV->listRegProveedorCombo();
        $data['v_clientes'] = $modelPRV->lisClientesProveedorCombo();

        log::info( $data['v_clientes'] );

        

        $modelTD= new Consulta();
        $data['v_tipo_dte'] = $modelTD->listTipoDTE();        

        //return view('menu.dasboard', $data);
        return view('menu.dasboard', $data);
    }

    public function postFacturacion(Request $request){
        $datos = $request->all();
        $model = new Consulta();
        
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
        log::info($datos);

        $model= new Consulta();
        $result = $model->filtrarFecha($datos);

        return $result;
    }

    public function postKeep(Request $request){
        return "refresh session";
    }
}