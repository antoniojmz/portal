<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\QueryException;
use App\Exceptions\Handler;

use DB;
use Log;
use DateTime;
use Session;
use Exception;
use Auth;

class Chat extends Authenticatable
{
    //use Notifiable;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    
    // Chat para proveedores(Cargar mensajes)
    public function listChat(){
        $idUser = Auth::id();
        $sql = "select c.* from v_chat c where c.idUser=".$idUser." and DATE_FORMAT(fechaChat, '%Y %M %d') = DATE_FORMAT(NOW(), '%Y %M %d') and idChat = (SELECT MAX(vc.idchat) FROM v_chat vc) order by idChatMessage ASC";
        $sql2= "select max(idchat) as idChat from v_chat where idUser=".$idUser." and DATE_FORMAT(fechaChat, '%Y %M %d') = DATE_FORMAT(NOW(), '%Y %M %d')";
        $idChat = DB::select($sql2);
        $result ['idChat'] = $idChat[0]->idChat;
        $result['chat'] = DB::select($sql);
        return $result;
    }
    
    // Chat para proveedores(Enviar mensajes)
    public function regChat($datos){
        $idUser = Auth::id();
        $p = Session::get('perfiles');
        $sql="select f_registro_chat(".$datos['idChat'].",".$idUser.",".$p['v_detalle'][0]->IdProveedor.",'".$datos['message']."')";
        $execute=DB::select($sql);
        foreach ($execute[0] as $key => $value) {
            $result['f_registro_chat']=$value;
        }
        $result['listChat'] = $this->listChat();
        return $result;
    }

    // Chat para proveedores(bandeja de entrada Clientes)
    public function listChatCliente(){
        $sql = "select idChat, Usuario, Operador, Proveedor, status, fechaChat from v_chat where DATE_FORMAT(fechaChat, '%Y %M %d') = DATE_FORMAT(NOW(), '%Y %M %d') group by idChat, Usuario, Proveedor,status order by fechaChat DESC";
        $result = DB::select($sql);
        return $result;
    }





}