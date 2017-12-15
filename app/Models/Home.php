<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\QueryException;
use App\Exceptions\Handler;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

use DB;
use Log;
use DateTime;
use Session;
use Exception;
use Auth;

class Home extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */

    public function listPublicacionesHome(){
        $idUser = Auth::id();
        $p = Session::get('perfiles');
        switch ($p['idPerfil']) {
            // Perfil administrador
            case 1:
                $result = '';
                break;
            // Perfil Cliente
            case 2:
                $result = '';
                break; 
            // Perfil Proveedor
            case 3:
                $sql = DB::select('select * from v_publicaciones where IdCliente = 3 and idEstado=1 and fechaInicio <= now() and fechaFin >= now() order by idPrincipal desc,idOrden asc,idNoticia desc');
                $var=[];
                $v=0;
                for ($i=0; $i <count($sql) ; $i++) {
                    $arr = explode(",", $sql[$i]->idProveedor);
                    for ($j=0; $j < count($arr); $j++) {
                        if ($arr[$j]==1){
                            $var[$v]=$sql[$i];
                        } 
                    
                    }
                    $v++;
                }
                $var;
                $nombres=[];
                $principal=[];
                $noticias=[];
                $dato=0;
                $w = 0;
                foreach ($var as $key => $value) {
                    if($key==0 && $dato < 1){
                        $principal[$key]=$value;
                    }else{
                        $noticias[$w]=$value;
                    }
                    $dato=1;
                    $w++;
                }
                $result['principal']=$principal; 
                $result['noticias']=$noticias; 
                break; 
            default: 
                $result = "Se requieren permisos";
            break;
        }
        return $result;
    }

    // Busqueda segun los graficos
    public function BusNoticia($IdNoticia){
        $p = Session::get('perfiles');
        if($p['idPerfil']==3){
            $sql= "select * from v_publicaciones where idEstado=1 and idNoticia=".$IdNoticia;
            return DB::select($sql);
        }  
    }
}