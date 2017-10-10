<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use SerializesModels;
use Log;

//Models
use App\Models\Password;

class RecuperarController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('guest');
    }

	protected function postRecuperar(Request $request){
        $datos = $request->all();
        $model= new Password();
        $result = $model->recuperarPassword($datos);
        return $result;
    }
}