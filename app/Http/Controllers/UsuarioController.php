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
use App\Models\Publicacion;
use App\Models\Proveedor;
use App\Models\User;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getUsuarios(){
        $data['title'] = 'Consulta de Proveedores';
        $p = Session::get('perfiles');
        $data['idPerfil']=$p['idPerfil'];
        $model= new Proveedor();
        $data['v_proveedores'] = $model->listProveedor();
        $data['v_busq_proveedor'] = $model->listBusquedaProveedor();
        return View::make('proveedores.proveedores',$data);
    }

    protected function postUsuarios(Request $request){
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

    protected function postRegProveedores(Request $request){
        $datos = $request->all();
        $p = Session::get('perfiles');
        // caso Cliente registra Usuario proveedor
        if ($p['idPerfil']==2){$datos['caso']=3;}
        // caso Proveedor registra Usuario proveedor
        if ($p['idPerfil']==3){$datos['caso']=4;}
        if ($datos['idEmpresa']==null){$datos['idEmpresa'] = 0;}
        $model= new User();
        $result = $model->regUsuario($datos);
        $model= new Proveedor();
        $result['v_usuarios'] = $model->listRegProveedor();
        return $result;
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

    protected function postEmpresactiva(Request $request){
        $datos = $request->all();
        $model= new Proveedor();
        $result['activar'] = $model->activarEmpresa($datos);
        $result['v_empresas'] = $model->listEmpresasProveedor($datos);
        return $result;
    }

    
    // Desbloquear las cuentas usuarios provedores despues de 3 intentos fallidos
    protected function postDesbloquearcuentaproveedor (Request $request){
        $datos = $request->all();
        $model= new User();
        $result['v_desbloqueo'] = $model->resetIntentosFallidos($datos['idUser']);
        $model= new Proveedor();
        $result['v_usuarios'] = $model->listRegProveedor();
        return $result;
    }

}
