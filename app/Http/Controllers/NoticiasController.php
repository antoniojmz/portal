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
use App\Models\Noticia;

class NoticiasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getNoticias(){
        $p = Session::get('perfiles');
        $model= new Noticia();
        $data=[];
        return View::make('noticias.noticias',$data);
    }

    protected function postNoticias(Request $request){
        $datos = $request->all();
        $model= new Cliente();
        $result = $model->BuscarCliente($datos);
        return $result;
    }
}