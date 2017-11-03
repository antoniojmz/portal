var limpiar=limpiarEstados=limpiarDetalles=limpiarReferencias=printCounter=ajax=0;
var RegistroDTEEstadisticos ='';
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

/////////////////////////////////////////
// Mostrar los dte de las estadisticas //
/////////////////////////////////////////
var cambiarTabla = function (){
    $("#divBienvenida").show();
	$(".divTablaFacP").toggle();
} 

var ManejoRespuestaE = function(respuesta){
	if(respuesta.code==200){
		var res = JSON.parse(respuesta.respuesta.v_info);
		switch(res.code) {
            case "204":
                cargartablaReportesEstadisticos(respuesta.respuesta.v_dtes);
                break;
            default:
                toastr.error(res.des_code, "Error!");
            break;
        } 
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }
}

var ManejoRespuestaD = function(respuesta){
    if (respuesta.code = '200'){
    		$("#divFormTabla").hide();
    		$("#divFormTab").show();
            pintarDatos(RegistroDTEEstadisticos);
            // cargartablaDetalles(respuesta.respuesta.v_dte_detalles);
            // cargartablaReferencias(respuesta.respuesta.v_dte_referencias);
            cargartablaEstados(respuesta.respuesta.v_dte_estados);
    }else{
        toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
    };
}

var cargartablaReportesEstadisticosAjax = function(data){
	parametroAjax.ruta=ruta;
    parametroAjax.data = {"IdDTE": data}
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaE(respuesta);
}

var pintarDatos = function(data){
    if(data.TipoDTE!=null){$("#TipoDTE").text(data.TipoDTE);}
    if(data.FolioDTE!=null){$("#FolioDTE").text(data.FolioDTE);}
    if(data.FechaEmision!=null){$("#FechaEmision").text(data.FechaEmision);}
    if(data.FechaRecepcion!=null){$("#FechaRecepcion").text(data.FechaRecepcion);}
    if(data.RutProveedor!=null){$("#RutProveedor").text(data.RutProveedor);}
    if(data.NombreProveedor!=null){$("#NombreProveedor").text(data.NombreProveedor);}
    if(data.RutCliente!=null){$("#RutCliente").text(data.RutCliente);}
    if(data.NombreCliente!=null){$("#NombreCliente").text(data.NombreCliente);}
    if(data.MontoNetoCLP!=null){$("#MontoNetoCLP").text(data.MontoNetoCLP);}
    if(data.MontoExentoCLP!=null){$("#MontoExentoCLP").text(data.MontoExentoCLP);}
    if(data.MontoIVACLP!=null){$("#MontoIVACLP").text(data.MontoIVACLP);}
    if(data.MontoTotalCLP!=null){$("#MontoTotalCLP").text(data.MontoTotalCLP);}
    // if(data.MontoNetoOM!=null){$("#MontoNetoOM").text(data.MontoNetoOM);}
    // if(data.MontoExentoOM!=null){$("#MontoExentoOM").text(data.MontoExentoOM);}
    // if(data.MontoIVAOM!=null){$("#MontoIVAOM").text(data.MontoIVAOM);}
    // if(data.MontoTotalOM!=null){$("#MontoTotalOM").text(data.MontoTotalOM);}
    if(data.EstadoActualDTE!=null){$("#EstadoActualDTE").text(data.EstadoActualDTE);}
    if(data.FechaEstadoActualDTE!=null){$("#FechaEstadoActualDTE").text(data.FechaEstadoActualDTE);}
}

var cargartablaDetalles = function(data){
    if(limpiarDetalles==1){destruirTabla('#tablaDetalles');}
    if (data.length>0){
        $("#tablaDetalles").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            'bSort': false,
            "language": {
                    "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "Código Producto","data": "CodigoProducto"},
                {"title": "Nombre Producto","data": "NombreProducto"},
                {"title": "Valor Unitario","data": "ValorUnitario"},
                {"title": "Cantidad","data": "Cantidad"},
                {"title": "Total Linea","data": "TotalLinea"}
            ],
        });
        limpiarDetalles=1;
    }else{
        limpiarDetalles=0;
    }
}

var cargartablaReferencias = function(data){
    if (limpiarReferencias>0){destruirTabla('#tablaReferencias');}
    if (data.length>0){
        $("#tablaReferencias").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            'bSort': false,
            "language": {
                    "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdReferencia","data": "IdReferencia",visible:0},
                {"title": "Tipo de Referencia","data": "TipoReferencia"},
                {"title": "Folio de Referencia","data": "FolioReferencia"},
                {"title": "Fecha de Referencia","data": "FechaReferencia"}
            ],
        });
        limpiarReferencias=1;
    }else{
        limpiarReferencias=0;
    }
}

var cargartablaEstados = function(data){
    if (limpiarEstados>0){destruirTabla('#tablaEstados');}
    if (data.length>0){
        $("#tablaEstados").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            'bSort': false,
            "language": {
                    "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdEstadoDTE","data": "IdEstadoDTE",visible:0},
                {"title": "Fecha de Estado","data": "FechaEstado"},
                {"title": "Comentario de Estado","data": "ComentarioEstado"}
            ],
        });
        limpiarEstados=1;
    }else{
        limpiarEstados=0;
    }
}

var cargartablaReportesEstadisticos = function(data){
    if (limpiar>0){destruirTabla('#tablaReportesEstadisticos');}
    if (data.length>0){
    	$("#divBienvenida").hide();
		$(".divTablaFacP").toggle();
        $("#tablaReportesEstadisticos").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            "scrollX": true,
            "scrollY": '50vh',
            "language": {
                "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {"title": "IdCliente","data": "IdCliente",visible:0},
                {"title": "Tipo DTE","data": "TipoDTE"},
                {"title": "Folio DTE","data": "FolioDTE"},
                {"title": "Fecha Emisión","data": "FechaEmision"},
                {"title": "Fecha Recepción Cliente","data": "FechaRecepcion"},
                {"title": "RUT Proveedor","data": "RutProveedor"},
                {"title": "Nombre Proveedor","data": "NombreProveedor"},
                {"title": "RUT Cliente","data": "RutCliente"},
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Monto Neto DTE","data": "MontoNetoCLP"},
                {"title": "Monto Exento DTE","data": "MontoExentoCLP"},
                {"title": "Monto IVA DTE","data": "MontoIVACLP"},
                {"title": "Monto Total DTE","data": "MontoTotalCLP"},
                {"title": "Estado Actual de Pago","data": "EstadoActualDTE"},
                {"title": "Fecha de Estado Actual","data": "FechaEstadoActualDTE"}
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn m-btn--pill',
                    title:'Listado DTEs',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'excel',
                    text: 'Exportar',
                    className: 'btn m-btn--pill',
                    title:'Listado DTEs',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    className: 'btn m-btn--pill',
                    orientation:'landscape',
                    pageSize:'LETTER',
                    title:'Listado DTEs',
                    exportOptions: {
                        modifier: {
                            page: 'current',
                        }
                    }
                }
            ]
        });
        limpiar=1;
        seleccionartablaReportesEstadisticos();
    }else{
        limpiar=0;
        toastr.warning("No se encontraron resultados", "Info!");
    }
};

var seleccionartablaReportesEstadisticos=function(){
    var tableB = $('#tablaReportesEstadisticos').dataTable();
    limpiar=1;
    $('#tablaReportesEstadisticos tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    });
    $('#tablaReportesEstadisticos tbody').on('dblclick', 'tr', function () {
        RegistroDTEEstadisticos = TablaTraerCampo('tablaReportesEstadisticos',this);
        cargarFormularioVisualizacion(RegistroDTEEstadisticos);
    });
    tableB.on('dblclick', 'tr', function () {
        $('#close').trigger('click');
    });	
};
var cargarFormularioVisualizacion = function(data){
    if(ajax==0){
	    ajax=1
	    parametroAjax.ruta=rutaD;
	    parametroAjax.data = {"IdDTE":data.IdDTE};
	    respuesta=procesarajax(parametroAjax);
	    ManejoRespuestaD(respuesta);
    }
};

var BotonVolver = function(){
    // $(".divForm").toggle();
    $("#divFormTabla").show();
    $("#divFormTab").hide();
    ajax=0;
};

//////////////////////////////////////////
/////// widget de Perfil Proveedor ///////
//////////////////////////////////////////
var widget1 = function(v_widget1){
	var count =[];
	var mes =[];
	for (var i = 0; i < v_widget1.length; i++) { 
		var res = v_widget1[i].IdMesGrupo
		// mes[res] = v_widget1[i].NombreMesGrupo
		count[res-1]= v_widget1[i].NroDTEGrupo;
	}
	var e = {
		labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		datasets: [
		{
			backgroundColor: mUtil.getColor("success"),
			data: count
		}
		// ,
		//  {
		// 	backgroundColor: "#f3f3fb",
		// 	// data: [mes]
		// 	data: [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 5, 5]
		// }
		]
	}

	t = $("#facturacion_por_mes");
	if (0 != t.length) new Chart(t, {
		type: "bar",
		data: e,
		options: {
			title: {
				display: !1
			},
			tooltips: {
				intersect: !1,
				mode: "nearest",
				xPadding: 10,
				yPadding: 10,
				caretPadding: 10
			},
			legend: {
				display: !1
			},
			responsive: !0,
			maintainAspectRatio: !1,
			barRadius: 4,
			scales: {
				xAxes: [{
					display: !1,
					gridLines: !1,
					stacked: !0
				}],
				yAxes: [{
					display: !1,
					stacked: !0,
					gridLines: !1
				}]
			},
			layout: {
				padding: {
					left: 0,
					right: 0,
					top: 0,
					bottom: 0
				}
			}
		}
	})
}

var widget2 = function(v_widget2){
	var object ={};
	var result =[];
	for (var i = 0; i < v_widget2.length; i++) { 
		var res = v_widget2[i]
		object['value']=v_widget2[i].Porcentaje;
		object['className']="custom";
		switch(v_widget2[i].IdEstadoDTE){
			case "1":
				object['meta']={color: mUtil.getColor("brand")};
				$("#div1").show();
				$("#span1").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;
			case "2":
				object['meta']={color:mUtil.getColor("success")};
				$("#div2").show();
				$("#span2").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;
			case "3":
				object['meta']={color:"#FA58F4"};
				$("#div3").show();
				$("#span3").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;
			case "4":
				object['meta']={color: "#F515C7"};
				$("#div4").show();
				$("#span4").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;
			case "5":
				object['meta']={color: mUtil.getColor("danger")};
				$("#div5").show();
				$("#span5").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;
			case "6":
				object['meta']={color: mUtil.getColor("warning")};
				$("#div6").show();
				$("#span6").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;
			case "7":
				object['meta']={color:"#66FEF1"};
				$("#div7").show();
				$("#span7").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;
			case "8":
				object['meta']={color:"#2DF130"};
				$("#div8").show();
				$("#span8").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;                        
			case "9":
				object['meta']={color: mUtil.getColor("info")};
				$("#div9").show();
				$("#span9").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;
			case "99":
				object['meta']={color: "#F514C7"};
				$("#div99").show();
				$("#span99").text(res.Porcentaje+" % "+res.EstadoActualDTE);
			break;
		}
		var res= JSON.stringify(object);
		res = JSON.parse(res);
		result[i]=res;    
	}
	0 != $("#facturacion_por_estado").length && new Chartist.Pie("#facturacion_por_estado", {
		series: result,
		labels: [1, 2, 3]
	}, {
		donut: !0,
		donutWidth: 17,
		showLabel: !1
	}).on("draw", function(e) {
		if ("slice" === e.type) {
			var t = e.element._node.getTotalLength();
			e.element.attr({
				"stroke-dasharray": t + "px " + t + "px"
			});
			var a = {
				"stroke-dashoffset": {
					id: "anim" + e.index,
					dur: 1e3,
					from: -t + "px",
					to: "0px",
					easing: Chartist.Svg.Easing.easeOutQuint,
					fill: "freeze",
					stroke: e.meta.color
				}
			};
			0 !== e.index && (a["stroke-dashoffset"].begin = "anim" + (e.index - 1) + ".end"), e.element.attr({
				"stroke-dashoffset": -t + "px",
				stroke: e.meta.color
			}), e.element.animate(a, !1)
		}
	})
}

var widget3 = function(v_widget2){
	var total=0;
	for (var i = 0; i < v_widget2.length; i++) {
		total += v_widget2[i].MontoTotal;
	}
	$("#spanMontoTotal").text("$ "+number_format(total, '0'))
	for (var i = 0; i < v_widget2.length; i++) {
		switch(v_widget2[i].IdEstadoDTE){
			case "1":
				$("#spanMonto1").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
				$("#progress1").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
				$("#href1").attr("onclick","cargartablaReportesEstadisticosAjax('"+v_widget2[i].id_dtes+"');");
				$("#spanDes1").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
			break;
			case "2":
				$("#spanMonto2").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
				$("#progress2").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
				$("#href2").attr("onclick","cargartablaReportesEstadisticosAjax('"+v_widget2[i].id_dtes+"');");
				$("#spanDes2").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
			break;
			case "6":
				$("#spanMonto3").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
				$("#progress3").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
				$("#href3").attr("onclick","cargartablaReportesEstadisticosAjax('"+v_widget2[i].id_dtes+"');");
				$("#spanDes3").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
			break;                       
			case "9":
				$("#spanMonto4").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
				$("#progress4").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
				$("#href4").attr("onclick","cargartablaReportesEstadisticosAjax('"+v_widget2[i].id_dtes+"');");
				$("#spanDes4").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
			break;
		}
	}
}

var widget4 = function(v_widget4){
	for (var i = 0; i < v_widget4.length; i++) {
		switch(v_widget4[i].IdEstadoDTE){
			case 1:
				$("#DivCambioEstados").append('<div class="m-widget4__item"><div class="m-widget4__ext"><a href="#" class="m-widget4__icon m--font-brand"><i class="flaticon-file"></i></a></div><div class="m-widget4__info"><span class="m-widget4__text">'+v_widget4[i].NombreEstado+'</span></div><div class="m-widget4__ext"><span class="m-widget4__number m--font-accent">'+v_widget4[i].Cantidad+'</span></div></div>');	
			break;
			case 2:
				$("#DivCambioEstados").append('<div class="m-widget4__item"><div class="m-widget4__ext"><a href="#" class="m-widget4__icon m--font-brand"><i class="flaticon-interface-9"></i></a></div><div class="m-widget4__info"><span class="m-widget4__text">'+v_widget4[i].NombreEstado+'</span></div><div class="m-widget4__ext"><span class="m-widget4__number m--font-accent">'+v_widget4[i].Cantidad+'</span></div></div>');	
			break;
			case 3:
				$("#DivCambioEstados").append('<div class="m-widget4__item"><div class="m-widget4__ext"><a href="#" class="m-widget4__icon m--font-brand"><i class="flaticon-list-3"></i></a></div><div class="m-widget4__info"><span class="m-widget4__text">'+v_widget4[i].NombreEstado+'</span></div><div class="m-widget4__ext"><span class="m-widget4__number m--font-accent">'+v_widget4[i].Cantidad+'</span></div></div>');	
			break; 
			case 4:
				$("#DivCambioEstados").append('<div class="m-widget4__item"><div class="m-widget4__ext"><a href="#" class="m-widget4__icon m--font-brand"><i class="flaticon-file-1"></i></a></div><div class="m-widget4__info"><span class="m-widget4__text">'+v_widget4[i].NombreEstado+'</span></div><div class="m-widget4__ext"><span class="m-widget4__number m--font-accent">'+v_widget4[i].Cantidad+'</span></div></div>');	
			break; 
			case 5:
				$("#DivCambioEstados").append('<div class="m-widget4__item"><div class="m-widget4__ext"><a href="#" class="m-widget4__icon m--font-brand"><i class="flaticon-list-1"></i></a></div><div class="m-widget4__info"><span class="m-widget4__text">'+v_widget4[i].NombreEstado+'</span></div><div class="m-widget4__ext"><span class="m-widget4__number m--font-accent">'+v_widget4[i].Cantidad+'</span></div></div>');	
			break; 
			case 6:
				$("#DivCambioEstados").append('<div class="m-widget4__item"><div class="m-widget4__ext"><a href="#" class="m-widget4__icon m--font-brand"><i class="flaticon-clock"></i></a></div><div class="m-widget4__info"><span class="m-widget4__text">'+v_widget4[i].NombreEstado+'</span></div><div class="m-widget4__ext"><span class="m-widget4__number m--font-accent">'+v_widget4[i].Cantidad+'</span></div></div>');	
			break;                       
			case 9:
				$("#DivCambioEstados").append('<div class="m-widget4__item"><div class="m-widget4__ext"><a href="#" class="m-widget4__icon m--font-brand"><i class="flaticon-list-2"></i></a></div><div class="m-widget4__info"><span class="m-widget4__text">'+v_widget4[i].NombreEstado+'</span></div><div class="m-widget4__ext"><span class="m-widget4__number m--font-accent">'+v_widget4[i].Cantidad+'</span></div></div>');	
			break;
		}
	}
}

var cargarPanel = function(idPerfil){
	switch(idPerfil){
		case 1:
			console.log("Soy administrador");
		break;
		case 2:
			console.log("Soy cliente");
		break;                      
		case 3:
			$(".m-widget14__legend").hide();
			widget1(d.v_widget1);
			widget2(d.v_widget2);
			widget3(d.v_widget2);
			widget4(d.v_widget4);
		break;
		default:
			console.log("No tengo perfil definido, debe cerrar session");
		break;
	}
}

$(document).ready(function(){
	cargarPanel(d.idPerfil);
    $(document).on('click','.LinkFacP',cambiarTabla);
    $(document).on('click','#volverTabProv',BotonVolver);
});
