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
use App\Models\Proveedor;
use App\Models\User;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getProveedores(){
        $data['title'] = 'Consulta de Proveedores';
        $p = Session::get('perfiles');
        $data['idPerfil']=$p['idPerfil'];
        $model= new Proveedor();
        $data['v_proveedores'] = $model->listProveedor();
        $data['v_busq_proveedor'] = $model->listBusquedaProveedor();
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

    // Registro de proveedores por los clientes
    protected function getRegProveedores(){
        $p = Session::get('perfiles');
        $model= new Proveedor();
        $data['v_usuarios'] = $model->listRegProveedor();
        $data['v_estados'] = $model->listRegEstados();
        $data['v_proveedores_combos'] = $model->listRegProveedorCombo();
        $result["perfil"] = $p["idPerfil"];
        $data['v_perfil']=json_encode($result);
        return View::make('proveedores.registro',$data);
    }

    // Activar o Desactivar Proveedores
    protected function postProveedoractivo (Request $request){
        $datos = $request->all();
        $model= new User();
        $result['activar'] = $model->activarUsuario($datos);
        $model= new Proveedor();
        $result['v_usuarios'] = $model->listRegProveedor();
        return $result;
    }

    // Asignar empresa usuarios registrados como proveedor por el cliente. (Administracion)
    protected function getEmpresas(Request $request){
        $datos = $request->all();
        $model= new Proveedor();
        $result['v_empresas'] = $model->listEmpresasProveedor($datos);
        return $result;
    }

    protected function postEmpresas(Request $request){
        $datos = $request->all();
        $model = new Proveedor();
        $result = $model->regEmpresa($datos);
        return $result;
    }

}
