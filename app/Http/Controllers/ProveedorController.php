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
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getProveedores(){
        $data['title'] = 'Consulta de Proveedores';
        $model= new Proveedor();
        $data['v_proveedores'] = $model->listProveedor();
        return View::make('proveedores.proveedores',$data);
    }

    protected function postProveedores(Request $request){
        $datos = $request->all();
        $model= new Proveedor();
        $result = $model->BuscarProveedor($datos);
        return $result;
    }
    
    protected function postBuscardetalleP(Request $request){
        $datos = $request->all();
        $model= new Proveedor();
        $result = $model->BuscarDetalleP($datos['IdProveedor']);
        return $result;
    } 
}
