<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

use Form;
use Lang;
use View;
use Redirect;
use SerializesModels;
use Log;
use Session;
use Config;
use Mail;
use Storage;
use DB;

// Modelo
use App\Models\Chat;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Chat para proveedores(Cargar mensajes)
    protected function getChat(){
        $model= new Chat();
        $IdChat = 0;
        $caso = 1;
        $result = $model->listChat($caso,$IdChat);
        return $result;
    }

    // Chat para proveedores(Enviar mensajes)
    protected function postChat(Request $request){
        $datos = $request->all();
        $model= new Chat();
        $result = $model->regChat($datos);
        return $result;
    }

    // Chat para proveedores(bandeja de entrada Clientes)
    protected function getChatcliente(){
        $model= new Chat();
        $result = $model->listChatCliente();
        return $result;
    }

    // Cambiar status al Chat(Mensaje leido)
    protected function getStatuschat(Request $request){
        $datos = $request->all();
        $model= new Chat();
        $result = $model->statusChat($datos);
        return $result;
    }

    // Buzon de mensajes (Clientes)
    protected function getBuzon(Request $request){
        $datos = $request->all();
        $model= new Chat();
        $data['idUser'] = Auth::id();
        $data['v_chat'] = $model->listChatCliente();
        return View::make('buzon.buzon',$data);
    }

    // Cargar el historial de conversacion en el panel de administrador
    protected function getConversacion(Request $request){
        $datos = $request->all();
        $model= new Chat();
        $result = $model->listConversacion($datos['idChat']);
        return $result;
    }

}
