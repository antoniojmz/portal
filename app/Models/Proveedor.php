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


class Proveedor extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */

    public function listProveedor($idCliente){
        $result = DB::table('v_proveedores')->where('IdCliente',$idCliente)->get();
        return $result;
    }
}