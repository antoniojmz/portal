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
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getClientes(){
        $data['title'] = 'Consulta de Clientes';
        $p = Session::get('perfiles');
        $data['idPerfil']=$p['idPerfil'];
        $model= new Cliente();
        $data['v_clientes'] = $model->listCliente();
        $data['v_busq_cliente'] = $model->listBusquedaCliente();
        return View::make('clientes.clientes',$data);
    }

    protected function postClientes(Request $request){
        $datos = $request->all();
        $model= new Cliente();
        $result = $model->BuscarCliente($datos);
        return $result;
    }
    
    protected function postBuscardetalleC(Request $request){
        $datos = $request->all();
        $model= new Cliente();
        $result = $model->BuscarDetalleC($datos['IdCliente']);
        return $result;
    } 
}