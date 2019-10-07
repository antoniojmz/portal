var ajax = 0;
var filtroFecha = 12;
var filtroTipoDTE = 0;

var nombreProveedor = "Todos los Proveeres";

var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var verDtes = function(data){

	$("body").addClass("loading");

    setTimeout(function(){
    	try{	
		    if (data!=null){
		        MyblockPage();
		        $("#idSubmitDtes").val(data);
		        $("#formIdDtes").submit();

		    }else{
		        toastr.warning("Se esperaban parametros de entrada", "Error!");
		    }

		}catch(err) {
            toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
            console.log("No se ejecuto la consulta, contacte al personal informático: " + err.message);
        }

	  	$("body").removeClass("loading"); 

    }, 8);
}

var ManejoRespuestaF = function(respuesta){
    ajax=0;

    if (respuesta.code = '200'){
        var res = JSON.parse(respuesta.respuesta.v_info);
        if (res.code = '204'){
            widget1(respuesta.respuesta.v_widget1);
            widget2(respuesta.respuesta.v_widget2);
            widget3(respuesta.respuesta.v_widget2);

            widget_pp_1(respuesta.respuesta.v_widget_pp_1);
            //widget4(respuesta.respuesta.v_widget4);
        }else{
            toastr.error(res.des_code, "Error!");   
        }
    }else{
        toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
    };
}

var FiltrarwidgetsProveedor = function(caso){

	$("body").addClass("loading");

    setTimeout(function(){
    	try{
    		
    		var nombreProveedor =  $("#IdProveedor option:selected").text();
    		nombreProveedor = nombreProveedor ?  " por " + nombreProveedor : "";

    		var nombreDTE =  $("#IdTipoDTE option:selected").text();
    		nombreDTE = nombreDTE ? nombreDTE : " DTE ";

    		filtroTipoDTE = $("#IdTipoDTE").val();

    		if(caso == 13){
    			$("#widget14__title").text(nombreDTE + " Recibidos en el año actual");
    			$("#widget14__desc").text("DTE emitidos al Cliente " + nombreCliente + " " + nombreProveedor + " éste año.");

    		}else if(caso == 1){
    			$("#widget14__title").text(nombreDTE + " Recibidos este mes");
    			$("#widget14__desc").text("DTE emitidos al Cliente " + nombreCliente + " " + nombreProveedor + " este mes.");
    			
    		}else if(caso == 3){
    			$("#widget14__title").text(nombreDTE + " Recibidos en los últimos 3 meses");
    			$("#widget14__desc").text("DTE emitidos al Cliente " + nombreCliente + " " + nombreProveedor + " los últimos 3 meses.");
    			
    		}else if(caso == 6){
    			$("#widget14__title").text(nombreDTE + " Recibidos en los últimos 6 meses");
    			$("#widget14__desc").text("DTE emitidos al Cliente " + nombreCliente + " " + nombreProveedor + " los últimos 6 meses.");
    			
    		}else if(caso == 12){
    			$("#widget14__title").text(nombreDTE + " Recibidos en los últimos 12 meses");
    			$("#widget14__desc").text("DTE emitidos al Cliente " + nombreCliente + " " + nombreProveedor + " los últimos 12 meses.");
    			
    		}

		    if(ajax == 0){
			    ajax=1;
			    parametroAjax.ruta=rutaF;
			    parametroAjax.data = {"caso":caso, "IdProveedor":$("#IdProveedor").val(), "IdTipoDTE":filtroTipoDTE, "IdCliente":$("#IdCliente").val()};
			    respuesta=procesarajax(parametroAjax);
			    ManejoRespuestaF(respuesta);
		    }

		}catch(err) {
            toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
            console.log("No se ejecuto la consulta, contacte al personal informático: " + err.message);
        }

	  	$("body").removeClass("loading"); 

    }, 8);
};

//////////////////////////////////////////
/////// widget de Perfil Proveedor ///////
//////////////////////////////////////////
var widget1 = function(v_widget1){
	$("#divFacturacion_por_mes").empty();

	$("#divFacturacion_por_mes").append("<canvas  id='facturacion_por_mes'></canvas>");
	var count =[];
	var mes =[];
	
	if (v_widget1.length>0){
		for (var i = 0; i < v_widget1.length; i++) { 
			var res = v_widget1[i].IdMesGrupo
			count[res-1]= v_widget1[i].NroDTEGrupo;
		}
	}else{
		count = [0,0,0,0,0,0,0,0,0,0,0,0]
	}

	var e = {
		labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		datasets: [
			{
				backgroundColor: mUtil.getColor("success"),
				data: count
			}
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
	$(".m-widget14__legend").hide();

	$(".m-widget14__legend-text").text("");
	$("#spanPorcentaje").text("");
	$("#spanPorcentaje").text("0%");
	if (v_widget2.length>0){
		$("#spanPorcentaje").text("%");
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

				default:
					object['meta']={color: "#F514C7"};
					$("#div99").show();
					$("#span99").text(res.Porcentaje+" % "+res.EstadoActualDTE);
				break;
			}
			var res= JSON.stringify(object);
			res = JSON.parse(res);
			result[i]=res;    
		}
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
	$("#spanMontoTotal").text("$ 0");

	$(".m-widget25__progress-number").text("$ 0");
	$(".progress-bar").attr("style","width:0%;");

	$("#spanDes1").text("0 DTE Emitido por el Proveedor");
	$("#spanDes2").text("0 DTE Recepcionado por el Cliente");
	$("#spanDes3").text("0 DTE Contabilizado por el Cliente");
	$("#spanDes4").text("0 DTE Programado para Pago");

	$("#href1").attr("onclick","verDtes();");
	$("#href2").attr("onclick","verDtes();");
	$("#href3").attr("onclick","verDtes();");
	$("#href4").attr("onclick","verDtes();");

	if (v_widget2.length>0){
		var total=0;
		for (var i = 0; i < v_widget2.length; i++) {
			total += v_widget2[i].MontoTotal;
			console.log("Monto " + v_widget2[i].IdEstadoDTE + ": " +  v_widget2[i].MontoTotal)
		}
		
		$("#spanMontoTotal").text("$ "+number_format(total, '0'));
		var totalOtrosEstadosMonto = 0;
		var totalOtrosEstadosPorcentaje = 0;
		var totalOtrosEstadosCantidad = 0;

		for (var i = 0; i < v_widget2.length; i++) {
			switch(v_widget2[i].IdEstadoDTE){
				case "1":
					$("#spanMonto1").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
					$("#progress1").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
					$("#href1").attr("onclick","verDtes('"+v_widget2[i].id_dtes+"');");
					$("#spanDes1").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
					break;

				case "2":
					$("#spanMonto2").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
					$("#progress2").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
					$("#href2").attr("onclick","verDtes('"+v_widget2[i].id_dtes+"');");
					$("#spanDes2").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
					break;

				case "6":
					$("#spanMonto3").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
					$("#progress3").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
					$("#href3").attr("onclick","verDtes('"+v_widget2[i].id_dtes+"');");
					$("#spanDes3").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
					break;

				case "9":
					$("#spanMonto4").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
					$("#progress4").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
					$("#href4").attr("onclick","verDtes('"+v_widget2[i].id_dtes+"');");
					$("#spanDes4").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
					break;

				case "10":
					$("#spanMonto6").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
					$("#progress6").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
					$("#href6").attr("onclick","verDtes('"+v_widget2[i].id_dtes+"');");
					$("#spanDes6").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
					break;

				default:
					totalOtrosEstadosMonto += v_widget2[i].MontoTotal;
					totalOtrosEstadosPorcentaje += v_widget2[i].Porcentaje;
					totalOtrosEstadosCantidad += v_widget2[i].cantidad;

					$("#spanMonto7").text("$ " + number_format(totalOtrosEstadosMonto, '0'));
					$("#progress7").attr("style","width:" + totalOtrosEstadosPorcentaje + "%;");
					$("#href7").attr("onclick","verDtes('" + v_widget2[i].id_dtes + "');");
					$("#spanDes7").text(totalOtrosEstadosCantidad + " DTE en otros Estados");
					break;
			}
		}
	}
}

var widget_pp_1 = function(data_pp_1){
	$("#spanMontoTotalPP").text("$ 0");

	$(".m-widget25__progress-number-pp").text("$ 0");
	$(".progress-bar-pp").attr("style","width:0%;");

	$("#spanDes11").text("0 Pronto Pago Solicitados");
	$("#spanDes12").text("0 Pronto Pago Aprobados");
	$("#spanDes13").text("0 Pronto Pago Rechazados");

	$("#href11").attr("onclick","verDtes();");
	$("#href12").attr("onclick","verDtes();");
	$("#href13").attr("onclick","verDtes();");

	//alert("Aqui " + data_pp_1.length);
	if (data_pp_1.length > 0){
		var total=0;

		for (var i = 0; i < data_pp_1.length; i++) {
			total += data_pp_1[i].MontoTotal;
			console.log("Monto PP" + data_pp_1[i].IdEstadoPP + ": " +  data_pp_1[i].MontoTotal)
		}

		
		$("#spanMontoTotalPP").text("$ " + number_format(total, '0'));
		var totalOtrosEstadosMonto = 0;
		var totalOtrosEstadosPorcentaje = 0;
		var totalOtrosEstadosCantidad = 0;

		for (var i = 0; i < data_pp_1.length; i++) {
			switch(data_pp_1[i].IdEstadoPP){
				case "1":
					$("#spanMonto11").text("$ "+number_format(data_pp_1[i].MontoTotal, '0'));
					$("#progress11").attr("style","width:"+data_pp_1[i].Porcentaje+"%;");
					$("#href11").attr("onclick","verDtes('"+data_pp_1[i].id_dtes+"');");
					$("#spanDes11").text(data_pp_1[i].Cantidad + " Pronto Pagos Solicitados");
					break;

				case "2":
					$("#spanMonto12").text("$ "+number_format(data_pp_1[i].MontoTotal, '0'));
					$("#progress12").attr("style","width:"+data_pp_1[i].Porcentaje+"%;");
					$("#href12").attr("onclick","verDtes('"+data_pp_1[i].id_dtes+"');");
					$("#spanDes12").text(data_pp_1[i].Cantidad + " Pronto Pago Aprobados");
					break;

				case "3":
					$("#spanMonto13").text("$ "+number_format(data_pp_1[i].MontoTotal, '0'));
					$("#progress13").attr("style","width:"+data_pp_1[i].Porcentaje+"%;");
					$("#href13").attr("onclick","verDtes('"+data_pp_1[i].id_dtes+"');");
					$("#spanDes13").text(data_pp_1[i].Cantidad + " Pronto Pago Rechazados");
					break;

				default:
					totalOtrosEstadosMonto += data_pp_1[i].MontoTotal;
					totalOtrosEstadosPorcentaje += data_pp_1[i].Porcentaje;
					totalOtrosEstadosCantidad += data_pp_1[i].Cantidad;
					console.log("IdEstadoPP: " + data_pp_1[i].IdEstadoPP );
					
					$("#spanMonto13").text("$ " + number_format(totalOtrosEstadosMonto, '0'));
					$("#progress13").attr("style","width:" + totalOtrosEstadosPorcentaje + "%;");
					$("#href13").attr("onclick","verDtes('" + data_pp_1[i].id_dtes + "');");
					$("#spanDes13").text(totalOtrosEstadosCantidad + " Pronto Pago en otros Estados");
					break;
			}
		}
	}
}

var widget4 = function(v_widget4){
	$("#DivCambioEstados").empty();
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

	$("body").addClass("loading");

    setTimeout(function(){
	    var res = parseInt(idPerfil);

	    switch(res){
			case 1:
				// console.log("Soy administrador");
				break;

	        case 2: 
	        case 3:
				// console.log("Soy proveedor o cliente");
				$(".m-widget14__legend").hide();
				widget1(d.v_widget1);
				widget2(d.v_widget2);
				widget3(d.v_widget2);
				widget4(d.v_widget4);
				break;

			default:
				console.log("No tengo perfil definido");
				break;
		}

		$("body").removeClass("loading"); 

    }, 1);
}

var crearSelectProveedores = function(control, data){
    $(control).select2({
        allowClear: false,
        data: data
    }).on("change",function(e){
        FiltrarwidgetsProveedor(filtroFecha);
    });
}

var crearSelectClientes = function(control, data){
    $(control).select2({
        allowClear: false,
        data: data
        //data: [{"id":5,"text":"EMPRESA_2"},{"id":1,"text":"Globas Consulting"}]
    }).on("change",function(e){
        FiltrarwidgetsProveedor(filtroFecha);
    });
}

//{"items": x, "select": itemx}
var crearSelectFiltrosPeriodo = function(){
    $("#IdPeriodo").select2({
        allowClear: false,
        data: [{"id":"1", "text":"Este Mes"}, {"id":"3", "text": "Últimos 3 meses"}, {"id":"6", "text":"Últimos 6 meses"}, {"id":"12", "text":"Últimos 12 meses", "selected": true}, {"id":"13", "text":"Este Año"}]
    }).on("change",function(e){
    	filtroFecha = this.value;
        FiltrarwidgetsProveedor(filtroFecha);
    });
}

var crearSelectTipoDTE = function(control, data){
    $(control).select2({
        allowClear: false,
        data: data
    }).on("change",function(e){
        FiltrarwidgetsProveedor(filtroFecha);
    });
}

$(document).ready(function(){
    ClassActive("LiDashboard");
    crearSelectFiltrosPeriodo();

    if(IdPerfil == 2){
    	crearSelectProveedores('#IdProveedor', v_proveedores);
    	FiltrarwidgetsProveedor(filtroFecha);

    }else if(IdPerfil == 3){
    	crearSelectClientes('#IdCliente', v_clientes);
    	FiltrarwidgetsProveedor(filtroFecha);
    }

    crearSelectTipoDTE('#IdTipoDTE', v_tipodte);

	//cargarPanel(d.idPerfil);
	//FiltrarwidgetsProveedor(filtroFecha);
});