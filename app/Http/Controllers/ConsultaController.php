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

// Modelo
use App\Models\Consulta;

class ConsultaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getConsultas(){
       $data['title'] = 'Consultas DTE';
       return View::make('consultas.consultas',$data);
    }

    protected function postConsultas(Request $request){
        $datos = $request->all();
        $model= new Consulta();
        $result = $model->BuscarUsuario($datos);
        return $result;
    }
    
}
