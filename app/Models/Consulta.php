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
use Auth;

//Modelos
use App\Models\User;

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
                $result = DB::table('v_dtes')->whereRaw('YEAR(FechaEmision) = YEAR(NOW()) ')->get();
                break;
                
            // Perfil Cliente
            case 2:
                $result = DB::table('v_dtes')->whereRaw('IdCliente = '. $p['v_detalle'][0]->IdCliente . ' AND YEAR(FechaEmision) = YEAR(NOW()) ')->get();
                break;

            // Perfil Proveedor
            case 3:
                $result = DB::table('v_dtes')->whereRaw('IdProveedor = ' . $p['v_detalle'][0]->IdProveedor . '')->get();
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

        log::info("Perfil: " . $p['idPerfil']);

        if($p['idPerfil'] == 2){
            $sql= "SELECT * FROM v_dtes WHERE IdDTE IN (".$IdDTE.") AND IdCliente = ".$p['v_detalle'][0]->IdCliente;

            log::info($sql);
            return DB::select($sql);

        }else if($p['idPerfil'] == 3){
            $sql= "SELECT * FROM v_dtes WHERE IdDTE IN (".$IdDTE.") AND IdProveedor = ".$p['v_detalle'][0]->IdProveedor;

            log::info($sql);
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
        $user= new User();
        $caso = 0;

        $d['RutCliente'] =  $user->LimpiarRut($d['RutCliente']);
        $d['RutProveedor'] =  $user->LimpiarRut($d['RutProveedor']);
        
        $p = Session::get('perfiles');
        $sql = "SELECT * FROM v_dtes WHERE  ";

        switch ($p['idPerfil']){
            case 2:
                $sql .= "IdCliente=".$p['v_detalle'][0]->IdCliente;
                break;

            case 3:
                $sql .= "IdProveedor=".$p['v_detalle'][0]->IdProveedor;
                break;
        }

        foreach ($d as $key => $value){
            if ($key<>'_token'){
                if ($value <>null){
                    $caso += 1;
                    switch ($key) {
                        case 'f_desde':
                            $f_desde = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaEmision AS DATE) >= '".$f_desde."'";
                        break;
                        case 'f_hasta':
                            $f_hasta = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaEmision AS DATE) <= '".$f_hasta."' ";
                        break;
                        case 'f_desdeR':
                            $f_desde = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaRecepcion AS DATE) >= '".$f_desde."'";
                        break;
                        case 'f_hastaR':
                            $f_hasta = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaRecepcion AS DATE) <= '".$f_hasta."' ";
                        break;                        
                        case 'f_desdeA':
                            $f_desde = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaAutorizacionSII AS DATE) >= '".$f_desde."'";
                        break;
                        case 'f_hastaA':
                            $f_hasta = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaAutorizacionSII AS DATE) <= '".$f_hasta."' ";
                        break;
                        case 'f_desdeO':
                            $f_desde = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaOC AS DATE) >= '".$f_desde."'";
                        break;
                        case 'f_hastaO':
                            $f_hasta = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaOC AS DATE) <= '".$f_hasta."' ";
                        break;
                        case 'f_desdeP':
                            $f_desde = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaPago AS DATE) >= '".$f_desde."'";
                        break;
                        case 'f_hastaP':
                            $f_hasta = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaPago AS DATE) <= '".$f_hasta."'";
                        break;
                        case 'f_desdeV':
                            $f_desde = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaVencimiento AS DATE) >= '".$f_desde."'";
                        break;
                        case 'f_hastaV':
                            $f_hasta = $this->formatearFecha($value);
                            $sql .= " AND CAST(FechaVencimiento AS DATE) <= '".$f_hasta."'";
                        break;
                        case 'existencia':
                            if ($value==1){
                                $sql .= " AND ExistenciaSII=1";
                            }
                            if ($value==2){
                                $sql .= " AND ExistenciaSII=1 AND ExistenciaPaperles=1";
                            }
                        break;
                        case 'TipoAcuse':
                                $sql .= " AND TipoAcuse=".$value."";
                        break;
                        case 'SelectDTE':
                                $sql .= " AND TipoDTE=".$value."";
                        break;
                        case 'selectEstado':
                                $sql .= " AND IdEstadoDTE=".$value."";
                        break;
                        default:
                            $sql .= " AND upper(".$key.") LIKE '%".$value."%'";
                        break;
                    }
                }  
            }   
        }

        $sql .= "; ";
        //log::info("Consulta: " . $sql);

        if ($caso == 0){
            $result['status']='{"code":"-1","des_code":"Debe seleccionar al menos un item."}';
            return $result;
        }

        $result['status']='{"code":"204","des_code":"No cotent"}';

        log::info("ConsultaSQL: " . $sql);
        $result['data']= DB::select($sql);
        return $result;
    }

    public function BuscarDetalle($id){
        $result['v_dte'] = DB::table('v_dtes')->where('IdDTE',  $id)->first();
        $result['v_dte_detalles'] = DB::table('v_dte_detalles')->where('IdDTE', $id)->get();
        $result['v_dte_estados'] = DB::table('v_dte_estados')->where('IdDTE', $id)->get();
        $result['v_dte_referencias'] = DB::table('v_dte_referencias')->where('IdDTE', $id)->get();
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

    public function filtrarFecha($datos){
        $perfil = "0";
        $p = Session::get('perfiles');

        $perfil = $p['idPerfil'];
        log::info("Perfil: " . $p['idPerfil']);

        $caso = $datos['caso'];
        log::info("Caso: " . $caso);

        $tipo = $datos['IdTipoDTE'];
        $tipo = $tipo ? ' AND TipoDTE = ' . $tipo . ' ' : ''; 
        log::info("TipoDTE: " . $tipo);


        switch ($perfil) {
            case "1":
                break;

            case "2":
                $result['v_info'] = '{"code":"204", "des_code":"No content."}';
                
                $IdProveedor = $datos['IdProveedor'] ? " AND IdProveedor = " . $datos['IdProveedor'] . "" : ""; 
                $IdCliente = $p['v_detalle'][0]->IdCliente;

                switch ($caso) {
                    case 1: 
                    case 3: 
                    case 6: 
                    case 12:
                        $sql1 = "SELECT DATE_FORMAT(FechaEmision, '%m') MesGrupo, 
                                            DATE_FORMAT(FechaEmision, '%m') as IdMesGrupo,
                                            DATE_FORMAT(FechaEmision, '%M') NombreMesGrupo, 
                                            SUM(montoTotalCLP) MontoTotalMesGrupo, 
                                            COUNT(1) NroDTEGrupo, 
                                            (SELECT SUM(montoTotalCLP) 
                                                FROM dtes 
                                                WHERE IdCliente = " . $IdCliente . " 
                                                        AND FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW() 
                                                        " . $IdProveedor . " " . $tipo . " ) AS MontoVentaTotal, 
                                            (SELECT COUNT(1) FROM dtes 
                                                WHERE IdCliente = " . $IdCliente . " 
                                                        AND FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW() 
                                                        " . $IdProveedor . " " . $tipo . " ) AS NroTotalDTE 
                                    FROM dtes 
                                    WHERE IdCliente = " . $IdCliente . " 
                                                AND FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW() 
                                                " . $IdProveedor . " " . $tipo . " 
                                    GROUP BY MesGrupo, IdMesGrupo, NombreMesGrupo";

                        //log::info($sql1);
                        $result['v_widget1']=DB::select($sql1);

                        $sql2 = "SELECT GROUP_CONCAT(IdDTE) as id_dtes, 
                                            IdEstadoDTE, EstadoActualDTE, IdCliente, 
                                            SUM(montoTotalCLP) as MontoTotal, 
                                            COUNT(1) as cantidad, 
                                            ROUND( SUM(montoTotalCLP) / (SELECT SUM(d.montoTotalCLP) FROM dtes d WHERE d.IdCliente = " . $IdCliente . " AND FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW() " . $tipo . " " . $IdProveedor . " ) * 100) AS Porcentaje 
                                        FROM v_dtes 
                                        WHERE IdCliente = " . $IdCliente . " 
                                                AND FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW() 
                                                " . $IdProveedor . " " . $tipo . " 
                                        GROUP BY IdEstadoDTE, EstadoActualDTE, IdCliente";

                        //log::info($sql2);
                        $result['v_widget2']=DB::select($sql2);

                        $sql3 = "SELECT count(1) as Cantidad, t1.IdEstadoDTE, t1.NombreEstado, t1.IdCliente 
                                    FROM (SELECT * FROM v_dte_estados WHERE IdCliente= ". $IdCliente . " " . $IdProveedor . " " . $tipo . "  ORDER BY FechaEstado DESC) t1 
                                    WHERE IdCliente= ". $IdCliente . " " . $IdProveedor . " 
                                    GROUP BY t1.IdEstadoDTE, t1.NombreEstado, t1.IdCliente LIMIT 50";

                        //log::info($sql3);
                        $result['v_widget4']=DB::select($sql3);

                        break;

                    case 13: 
                        $sql1= "SELECT DATE_FORMAT(FechaEmision, '%m') MesGrupo, 
                                        DATE_FORMAT(FechaEmision, '%m') as IdMesGrupo, 
                                        DATE_FORMAT(FechaEmision, '%M') NombreMesGrupo, 
                                        SUM(montoTotalCLP) MontoTotalMesGrupo, COUNT(1) NroDTEGrupo, 
                                        (SELECT SUM(montoTotalCLP) 
                                                FROM dtes 
                                                WHERE IdCliente = " . $IdCliente . " 
                                                        AND YEAR(FechaEmision) = YEAR(NOW()) 
                                                        " . $IdProveedor . " 
                                                        " . $tipo . " ) AS MontoVentaTotal, 
                                        (SELECT COUNT(1) 
                                            FROM dtes 
                                            WHERE IdCliente = " . $IdCliente . " 
                                                AND YEAR(FechaEmision) = YEAR(NOW()) 
                                                " . $IdProveedor . " 
                                                " . $tipo . " ) AS NroTotalDTE 
                                    FROM dtes 
                                    WHERE IdCliente = " . $IdCliente . " 
                                                AND YEAR(FechaEmision) = YEAR(NOW()) 
                                                " . $IdProveedor . " 
                                                " . $tipo . " 
                                    GROUP BY MesGrupo, IdMesGrupo, NombreMesGrupo";

                        //log::info($sql1);
                        $result['v_widget1']=DB::select($sql1);

                        $sql2= "SELECT GROUP_CONCAT(IdDTE) as id_dtes, IdEstadoDTE, EstadoActualDTE, IdProveedor, 
                                            SUM(montoTotalCLP) as MontoTotal, COUNT(1) as cantidad, 
                                            ROUND( SUM(montoTotalCLP) / (SELECT SUM(d.montoTotalCLP) 
                                                                            FROM dtes d
                                                                            WHERE d.IdCliente = " . $IdCliente . " 
                                                                                    AND YEAR(FechaEmision) = YEAR(NOW())  
                                                                                    " . $tipo . " 
                                                                                    " . $IdProveedor . " ) * 100) AS Porcentaje, 
                                            IdCliente 
                                    FROM v_dtes 
                                    WHERE IdCliente = " . $IdCliente . " 
                                            AND YEAR(FechaEmision) = YEAR(NOW()) 
                                            " . $IdProveedor . " 
                                            " . $tipo . " 
                                    GROUP BY IdEstadoDTE, EstadoActualDTE, IdCliente";

                        //log::info($sql2);
                        $result['v_widget2']=DB::select($sql2);


                        $sql3= "SELECT count(1) as Cantidad, t1.IdEstadoDTE, t1.NombreEstado, t1.IdCliente 
                                    FROM (SELECT * 
                                            FROM v_dte_estados 
                                            WHERE IdCliente= ". $IdCliente . " 
                                                    " . $IdProveedor . " 
                                                    " . $tipo . "  
                                            ORDER BY FechaEstado DESC) t1 
                                    WHERE IdCliente= ". $IdCliente . " 
                                            " . $IdProveedor . " 
                                            " . $tipo . " 
                                    GROUP BY t1.IdEstadoDTE, t1.NombreEstado, t1.IdCliente LIMIT 50";

                        //log::info($sql3);
                        $result['v_widget4']=DB::select($sql3);
                    break;
                }

                break;

            case "3":
                $IdProveedor = $p['v_detalle'][0]->IdProveedor;
                $IdCliente = $datos['IdCliente'] ? " AND IdCliente = " . $datos['IdCliente'] . "" : ""; 

                switch ($caso) {
                    case 1: 
                    case 3: 
                    case 6: 
                    case 12:
                        $result['v_info'] = '{"code":"204", "des_code":"No content."}';
                        $fecha = "";

                        $sql1 = "SELECT DATE_FORMAT(FechaEmision, '%m') MesGrupo, DATE_FORMAT(FechaEmision, '%m') as IdMesGrupo, 
                                    DATE_FORMAT(FechaEmision, '%M') NombreMesGrupo, 
                                    SUM(montoTotalCLP) MontoTotalMesGrupo, COUNT(1) NroDTEGrupo, 
                                    (SELECT SUM(montoTotalCLP) FROM dtes WHERE  idProveedor = " . $IdProveedor . " " . $IdCliente . ") AS MontoVentaTotal, 
                                    (SELECT COUNT(1) FROM dtes WHERE idProveedor = " . $IdProveedor . " " . $IdCliente . ") AS NroTotalDTE 
                                FROM dtes 
                                WHERE idProveedor = " . $IdProveedor . " 
                                        AND FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ". $caso ." MONTH) AND NOW() 
                                        " . $tipo . " 
                                        " . $IdCliente . " 
                                GROUP BY MesGrupo, IdMesGrupo, NombreMesGrupo";

                        //log::info($sql1);
                        $result['v_widget1']=DB::select($sql1);

                        $sql2 = "SELECT GROUP_CONCAT(IdDTE) as id_dtes, IdEstadoDTE,EstadoActualDTE, idProveedor,
                                    SUM(montoTotalCLP) as MontoTotal, 
                                    COUNT(1) as cantidad, 
                                    ROUND( SUM(montoTotalCLP) / (SELECT SUM(d.montoTotalCLP) 
                                                                    FROM dtes d 
                                                                    WHERE d.IdProveedor = " . $IdProveedor . " " . $IdCliente . " 
                                                                            AND FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ". $caso ." MONTH) AND NOW() ) * 100) AS Porcentaje 
                                FROM v_dtes 
                                WHERE IdProveedor = ". $IdProveedor . " 
                                        AND FechaEmision BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW() 
                                        " . $tipo . " 
                                        " . $IdCliente . " 
                                GROUP BY IdEstadoDTE, EstadoActualDTE, IdProveedor";
                        
                        log::info($sql2);
                        $result['v_widget2']=DB::select($sql2);

                        $sql4 = "SELECT count(1) as Cantidad, t1.IdEstadoDTE, t1.NombreEstado, t1.IdProveedor 
                                    FROM v_dte_estados t1 
                                    WHERE FechaEstado BETWEEN DATE_SUB(NOW(), INTERVAL ".$caso." MONTH) AND NOW()  
                                            AND IdProveedor = " . $IdProveedor . " 
                                            " . $tipo . " 
                                            " . $IdCliente . " 
                                    GROUP BY t1.IdEstadoDTE, t1.NombreEstado, t1.IdProveedor LIMIT 50"; 

                        log::info($sql4);
                        $result['v_widget4']=DB::select($sql4); 

                        break;

                    case 13:
                        $result['v_info'] = '{"code":"204", "des_code":"No content."}';

                        $sql1="SELECT DATE_FORMAT(FechaEmision, '%m') MesGrupo, DATE_FORMAT(FechaEmision, '%m') AS IdMesGrupo, 
                                        DATE_FORMAT(FechaEmision, '%M') NombreMesGrupo, SUM(montoTotalCLP) MontoTotalMesGrupo, 
                                        COUNT(1) NroDTEGrupo, 
                                        (SELECT SUM(montoTotalCLP) FROM dtes WHERE idProveedor = ".$IdProveedor.") AS MontoVentaTotal,
                                        (SELECT COUNT(1) FROM dtes where idProveedor = ".$IdProveedor.") AS NroTotalDTE 
                                    FROM dtes 
                                    WHERE IdProveedor = ".$IdProveedor." 
                                            AND YEAR(FechaEmision) = YEAR(NOW()) AND DATE_FORMAT(FechaEmision, '%Y') = DATE_FORMAT(NOW(), '%Y') 
                                            " . $tipo . " 
                                            " . $IdCliente . " 
                                    GROUP BY MesGrupo, IdMesGrupo, NombreMesGrupo";

                        //log::info($sql1);
                        $result['v_widget1']=DB::select($sql1);

                        $sql2 = "SELECT GROUP_CONCAT(IdDTE) as id_dtes, IdEstadoDTE, EstadoActualDTE, idProveedor, SUM(montoTotalCLP) AS MontoTotal, 
                                        COUNT(1) AS cantidad, 
                                        ROUND( SUM(montoTotalCLP) / (SELECT SUM(d.montoTotalCLP) FROM dtes d WHERE d.idProveedor = " . $IdProveedor . " and YEAR(FechaEmision) = YEAR(NOW())) * 100) AS Porcentaje 
                                    FROM v_dtes 
                                    WHERE IdProveedor =" . $IdProveedor . " 
                                            AND YEAR(FechaEmision) = YEAR(NOW()) 
                                            " . $tipo . " 
                                            " . $IdCliente . " 
                                    GROUP BY IdEstadoDTE, EstadoActualDTE, IdProveedor";

                        //log::info($sql2);
                        $result['v_widget2']=DB::select($sql2);

                        $sql4="SELECT COUNT(1) as Cantidad, t1.IdEstadoDTE, t1.NombreEstado, t1.IdProveedor 
                                FROM (SELECT * FROM v_dte_estados WHERE YEAR(FechaEstado) = YEAR(NOW()) " . $IdCliente . " ORDER BY FechaEstado DESC) t1 
                                WHERE IdProveedor= ".$IdProveedor." 
                                            " . $tipo . "  
                                            " . $IdCliente . " 
                                GROUP BY t1.IdEstadoDTE,t1.NombreEstado,t1.IdProveedor LIMIT 50";

                        //log::info($sql4);
                        $result['v_widget4']=DB::select($sql4);

                        break;

                    default:
                        $result['v_info']='{"code":"-2", "des_code":"Se esperaban resultados"}'; 
                        break;

                }

                break;

            default:
                break;

        }
        

        return $result;
    }

    public function SolicitarProntoPago($datos){
        $IdUsario = Auth::id();
        log::info($datos);

        $consultaSQL = "CALL sp_solictarPP(1, '" . $datos["KeyDTE"] . "', '" . $datos["FechaPagoSolicitadaPP"] . "', " . $IdUsario . ")";
        $result['status'] = DB::select(DB::raw($consultaSQL));

        log::info($result['status']);

        //$result['status']='{"code":"200"," des_code":"Solicitud de Pronto Pago enviada con éxtio"}';
        return $result;
    }
}