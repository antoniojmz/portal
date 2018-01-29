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
    public function listChat($caso,$IdChat){
        switch ($caso) {
            case 1:
            // caso 1 proveedor
                $idUser = Auth::id();
                $sql = "select c.* from v_chat c where c.idUser=".$idUser." and DATE_FORMAT(fechaChat, '%Y %M %d') = DATE_FORMAT(NOW(), '%Y %M %d') and idChat = (SELECT MAX(vc.idchat) FROM v_chat vc where vc.idUser=".$idUser.") order by idChatMessage ASC";
            break;
            case 2:
            // caso 2 cliente
                $sql = "select c.* from v_chat c where c.idChat=".$IdChat." and DATE_FORMAT(fechaChat, '%Y %M %d') = DATE_FORMAT(NOW(), '%Y %M %d') order by idChatMessage ASC";
            break;
        }
       return DB::select($sql);
    }
    
    // Chat para proveedores(Enviar mensajes)
    public function regChat($datos){
        $idUser = Auth::id();
        $p = Session::get('perfiles');
        $IdProveedor = 0;
        if ($datos['caso'] == 1){$IdProveedor = $p['v_detalle'][0]->IdProveedor;}
        $sql="select f_registro_chat(".$datos['caso'].",".$datos['idChat'].",".$idUser.",".$IdProveedor.",'".$datos['message']."')";
        $execute=DB::select($sql);
        foreach ($execute[0] as $key => $value) {
            $result['f_registro_chat']=$value;
        }
        $data = json_decode($result['f_registro_chat']);
        $result['IdChat'] = $data->idChat;
        $result['chat'] = $this->listChat($datos['caso'],$result['IdChat']);
        return $result;
    }

    // Cambiar status (Leido)
    public function statusChat($datos){
        $values=array('statusAdmin'=>0);
        return DB::table('chatmessage')
            ->where('idChat',$datos['idChat'])
            ->update($values);
    }
    
    // Chat para proveedores(bandeja de entrada Clientes)
    public function listChatCliente(){
        $sql = "select * from v_chat c where c.idChatMessage = (SELECT MAX(idChatMessage) FROM chatmessage cm where c.idChat=cm.idChat) and DATE_FORMAT(fechaChat, '%Y %M %d') = DATE_FORMAT(NOW(), '%Y %M %d') order by FechaMessage DESC";
        return DB::select($sql);
    }

    // Cargar historial de conversacion entre el cliente y el proveedor
    public function listConversacion($idChat){
        $sql = " select * from v_chat where idChat=".$idChat." order by idChatMessage ASC;";
        return DB::select($sql);
    }

}