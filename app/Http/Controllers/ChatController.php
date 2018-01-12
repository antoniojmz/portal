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
        $result = $model->listChat();
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

    // Buzon de mensajes (Clientes)
    protected function getBuzon(){
        $model= new Chat();
        $data['idUser'] = Auth::id();
        $data['v_chat'] = $model->listChatCliente();
        return View::make('buzon.buzon',$data);
    }

    protected function getBuzonR(){
        $model= new Chat();
        $data['v_chat'] = $model->listChatCliente();
        return $data;
    }

    // Cargar el historial de conversacion en el panel de administrador
    protected function postConversacion(Request $request){
        $datos = $request->all();
        $model= new Chat();
        $result = $model->listConversacion($datos['idChat']);
        return $result;
    }
    


}
