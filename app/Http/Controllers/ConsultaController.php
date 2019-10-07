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
        $data['method'] = 1;

        if( isset($datos['idSubmitDtes']) ){
            $data['v_dtes'] = $model->BusDtesGraf($datos['idSubmitDtes']);
            $data['method'] = 2;

        }else{
            $data['v_dtes'] = $model->listDtes();
        }

        return View::make('consultas.consultas',$data);
    }

    protected function getBusqueda(Request $request){
        $datos = $request->all();
        $data['title'] = 'Consultas DTE';
        $model= new Consulta();
        $data['v_busq_consulta'] = $model->listBusquedaDte();
        $data['v_tipo_dte'] = $model->listTipoDTE();
        $data['method'] = 1;

        log::info("idSubmitDtes: " . isset($datos['idSubmitDtes']) );

        if(isset($datos['idSubmitDtes'])){
            $data['v_dtes'] = $model->BusDtesGraf($datos['idSubmitDtes']);
            $data['method'] = 2;

        }else{
            $data['v_dtes'] = $model->listDtes();
        }
        return View::make('consultas.busqueda',$data);
    }

    protected function getViewXML(Request $request){
        $datos = $request->all();
        $data['title'] = 'ViewXML DTE';

        return View::make('consultas.viewXML', $data);
    }

    protected function getViewPDF(Request $request){
        $datos = $request->all();
        $data['title'] = 'ViewPDF DTE';

        return View::make('consultas.viewPDF', $data);
    }

    protected function postConsultaDTE(Request $request){
        $datos = $request->all();
        $model= new Consulta();

        //$result = $model->BuscarDtes($datos);
        //$result = $model->listDtes();
        $result['status'] ='{"code":"204","des_code":"No cotent"}';
        $result['data'] =  $model->listDtes();

        return $result;
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

    protected function postBuscartraza(Request $request){
        $datos = $request->all();
        $model= new Consulta();
        $result = $model->BuscarTraza($datos['IdDTE']);
        return $result;
    }

    protected function postSolicitarPP(Request $request){
        $datos = $request->all();
        $model= new Consulta();

        $result = $model->SolicitarProntoPago($datos);
        return $result;
    }    
}
