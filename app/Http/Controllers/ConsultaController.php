<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Form;
use Lang;
use View;
use Redirect;
use SerializesModels;
use Log;
use Auth;
use Session;

// Modelo
use App\Models\Consulta;

class ConsultaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getConsultas(Request $request){
        $datos = $request->all();
        $data['title'] = 'Consultas DTE';
        $model= new Consulta();
        $data['v_busq_consulta'] = $model->listBusquedaDte();
        $data['v_tipo_dte'] = $model->listTipoDTE();
        // if(isset($datos['IdDTE'])){
            // $data['v_dtes'] = $model->BusDtesGraf($datos['IdDTE']);
        // }else{
            $data['v_dtes'] = $model->listDtes();
        // }
        return View::make('consultas.consultas',$data);
    }

    protected function postConsultas(Request $request){
        $datos = $request->all();
        $model= new Consulta();
        $result = $model->BuscarDtes($datos);
        return $result;
    }
    
    protected function postBuscardetalle(Request $request){
        $datos = $request->all();
        $model= new Consulta();
        $result = $model->BuscarDetalle($datos['IdDTE']);
        return $result;
    }
}
