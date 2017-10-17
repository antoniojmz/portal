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
        $model= new Cliente();
        $idUser = Auth::id();
        $data['v_clientes'] = $model->listCliente($idUser);
        return View::make('clientes.clientes',$data);
    }

    protected function postClientes(Request $request){
        // $datos = $request->all();
        // $model= new Cliente();
        // $result = $model->BuscarUsuario($datos);
        // return $result;
    }
    
}
