<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\QueryException;
use App\Exceptions\Handler;

use DB;
use Crypt;
use Hash;
use Log;
use DateTime;
use Session;
use Mail;
use Storage;
use Exception;

class Consulta extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    // Carga inicial de dte y buqueda en pantalla de consultas
    public function listDtes(){
        $p = Session::get('perfiles');
        switch ($p['idPerfil']) {
            // Perfil ad[ministrador]
            case 1:
                $result = DB::table('v_dtes')->get();
                break;
            // Perfil Cliente
            case 2:
                $result = DB::table('v_dtes')->where('IdCliente',$p['v_detalle'][0]->IdCliente)->get();
                break;
            // Perfil Proveedor
            case 3:
                $result = DB::table('v_dtes')->where('IdProveedor',$p['v_detalle'][0]->IdProveedor)->get();
                break;
            default:
                log::info("Se requieren permisos");
                $result = "Se requieren permisos";
            break;
        }
        return $result;
    }

    // Busqueda segun los graficos
    public function BusDtesGraf($IdDTE){
        $p = Session::get('perfiles');
        if($p['idPerfil']==3){
            $sql= "select * from v_dtes where IdDTE in (".$IdDTE.") and IdProveedor=".$p['v_detalle'][0]->IdProveedor;
            return DB::select($sql);
        }  
    }


    public function listBusquedaDte(){
        return DB::table('v_busq_consulta')->get();
    }
    
    public function listTipoDTE(){
        return DB::table('v_tipo_dte')->get();
    }

    public function BuscarDtes($d){
        $var = 0;
        $p = Session::get('perfiles');
        $sql = "select * from v_dtes where ";
        if ($d['f_desde'] <>null && $d['f_hasta'] <>null){
            $desde = $this->formatearFecha($d['f_desde']);
            $hasta = $this->formatearFecha($d['f_hasta']);
            $pre1= "CAST(FechaEmision AS DATE) >= '".$desde."' and CAST(FechaEmision AS DATE) <= '".$hasta."' ";
            $sql .= $pre1;
            $var = 1;
        }

        if ($d['Selectcampo'] <>null){  
            $pre2="";
            if ($var >0){
                $pre2 = "and "; 
            }
            $var = 1;      
            $pre2 .= "upper(".$d['Selectcampo'].") like '%".$d['descripcion']."%'";
            $sql .= $pre2; 
        }

        if ($d['SelectDTE'] <>null){
            $pre3="";
            if ($var >0){
                $pre3 = "and "; 
            }         
            $pre3 .= "TipoDTE=".$d['SelectDTE'];
            $sql .= $pre3; 
        }
        switch ($p['idPerfil']){
            // Perfil Cliente
            case 2:
                $pre4 = " and IdCliente=".$p['v_detalle'][0]->IdCliente;
                $sql .= $pre4;
                break;
            // Perfil Proveedor
            case 3:
                $pre4 = " and IdProveedor=".$p['v_detalle'][0]->IdProveedor;
                $sql .= $pre4;
                break;
        }
        return DB::select($sql);
    }

    public function BuscarDetalle($id){
        $result['v_dte_detalles'] = DB::table('v_dte_detalles')->where('IdDTE',$id)->get();
        $result['v_dte_estados'] = DB::table('v_dte_estados')->where('IdDTE',$id)->get();
        $result['v_dte_referencias'] = DB::table('v_dte_referencias')->where('IdDTE',$id)->get();
        return $result;
    }

    public function BuscarTraza($id){
        $result['v_dte_estados'] = DB::table('v_dte_estados')->where('IdDTE',$id)->get();
        return $result;
    }

    
    public function formatearFecha($d){
        $formato = explode("-", $d);
        $fecha = $formato[2]."-".$formato[1]."-".$formato[0];
        return $fecha;
    }

    public function filtrarFecha($caso){
        $p = Session::get('perfiles');
        switch ($caso) {
            case 13:
                $result['v_info'] = '{"code":"204", "des_code":"No content."}';  
                $sql1="SELECT date_FORMAT(FechaEmision, '%m') MesGrupo, date_FORMAT(FechaEmision, '%m') as IdMesGrupo, date_FORMAT(FechaEmision, '%M') NombreMesGrupo, SUM(montoTotalCLP) MontoTotalMesGrupo, COUNT(1) NroDTEGrupo, (SELECT SUM(montoTotalCLP) FROM v_dtes where idProveedor = ".$p['v_detalle'][0]->IdProveedor.") AS MontoVentaTotal ,(SELECT COUNT(1) FROM v_dtes where idProveedor = ".$p['v_detalle'][0]->IdProveedor.") AS NroTotalDTE FROM v_dtes where idProveedor = ".$p['v_detalle'][0]->IdProveedor." and YEAR(FechaEmision) = YEAR(NOW()) and DATE_FORMAT(FechaEmision, '%Y') = DATE_FORMAT(NOW(), '%Y') GROUP BY MesGrupo, IdMesGrupo, NombreMesGrupo";
                $sql2="select group_concat(IdDTE) as id_dtes, IdEstadoDTE,EstadoActualDTE, idProveedor, SUM(montoTotalCLP) as MontoTotal, COUNT(1) as cantidad, ROUND( SUM(montoTotalCLP) / (SELECT SUM(d.montoTotalCLP) FROM v_dtes d where d.idProveedor = ".$p['v_detalle'][0]->IdProveedor." and YEAR(FechaEmision) = YEAR(NOW())) * 100) AS Porcentaje FROM v_dtes where idProveedor =".$p['v_detalle'][0]->IdProveedor." and YEAR(FechaEmision) = YEAR(NOW()) GROUP BY IdEstadoDTE, EstadoActualDTE, idProveedor";
                $sql4="select count(1) as Cantidad, t1.IdEstadoDTE, t1.NombreEstado, t1.IdProveedor from (select * from v_dte_estados where YEAR(FechaEstado) = YEAR(NOW()) ORDER BY FechaEstado DESC) t1 where IdProveedor=".$p['v_detalle'][0]->IdProveedor." group by t1.IdEstadoDTE,t1.NombreEstado,t1.IdProveedor limit 50";
                $result['v_widget1']=DB::select($sql1);
                $result['v_widget2']=DB::select($sql2);
                $result['v_widget4']=DB::select($sql4);
            break;
            case 1: case 3: case 6: case 12:
                $result['v_info'] = '{"code":"204", "des_code":"No content."}';
                $sql1="SELECT date_FORMAT(FechaEmision, '%m') MesGrupo, date_FORMAT(FechaEmision, '%m') as IdMesGrupo, date_FORMAT(FechaEmision, '%M') NombreMesGrupo, SUM(montoTotalCLP) MontoTotalMesGrupo, COUNT(1) NroDTEGrupo, (SELECT SUM(montoTotalCLP) FROM v_dtes where idProveedor = ".$p['v_detalle'][0]->IdProveedor.") AS MontoVentaTotal ,(SELECT COUNT(1) FROM v_dtes where idProveedor = ".$p['v_detalle'][0]->IdProveedor.") AS NroTotalDTE FROM v_dtes where idProveedor = ".$p['v_detalle'][0]->IdProveedor." and FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW() GROUP BY MesGrupo, IdMesGrupo, NombreMesGrupo";
                $sql2="select group_concat(IdDTE) as id_dtes, IdEstadoDTE,EstadoActualDTE, idProveedor, SUM(montoTotalCLP) as MontoTotal, COUNT(1) as cantidad, ROUND( SUM(montoTotalCLP) / (SELECT SUM(d.montoTotalCLP) FROM v_dtes d where d.idProveedor = ".$p['v_detalle'][0]->IdProveedor." and FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW()) * 100) AS Porcentaje FROM v_dtes where idProveedor =".$p['v_detalle'][0]->IdProveedor." and FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW()GROUP BY IdEstadoDTE, EstadoActualDTE, idProveedor";
                $sql4="select count(1) as Cantidad, t1.IdEstadoDTE, t1.NombreEstado, t1.IdProveedor from (select * from v_dte_estados where FechaEstado BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW() ORDER BY FechaEstado DESC) t1 where IdProveedor=".$p['v_detalle'][0]->IdProveedor." group by t1.IdEstadoDTE,t1.NombreEstado,t1.IdProveedor limit 50";
                $result['v_widget1']=DB::select($sql1);
                $result['v_widget2']=DB::select($sql2);
                $result['v_widget4']=DB::select($sql4); 
            break;
            default:
                $result['v_info']='{"code":"-2", "des_code":"Se esperaban resultados"}'; 
            break;
        }           
        return $result;
    }
}