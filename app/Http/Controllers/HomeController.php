<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Log;
use Auth;

// Modelo
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
    public function getIndex()
    {   
        $usuario = Auth::user();
        $data['idPerfil'] = $usuario->idPerfil;
        return view('menu.principal', $data);
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
    
    public function postFiltrarwidget(Request $request){
        $datos = $request->all();
        $model= new Consulta();
        $result = $model->filtrarFecha($datos['caso']);
        return $result;
    }
}