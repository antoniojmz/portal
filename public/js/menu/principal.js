var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'GET',
    'data': {},
    'ruta': '',
    'async': false
};
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
				$("#href1").attr("href","/consultas?IdDTE="+v_widget2[i].id_dtes+"");
				$("#spanDes1").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
			break;
			case "2":
				$("#spanMonto2").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
				$("#progress2").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
				$("#href2").attr("href","/consultas?IdDTE="+v_widget2[i].id_dtes+"");
				$("#spanDes2").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
			break;
			case "6":
				$("#spanMonto3").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
				$("#progress3").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
				$("#href3").attr("href","/consultas?IdDTE="+v_widget2[i].id_dtes+"");
				$("#spanDes3").text(v_widget2[i].cantidad+" "+v_widget2[i].EstadoActualDTE);
			break;                       
			case "9":
				$("#spanMonto4").text("$ "+number_format(v_widget2[i].MontoTotal, '0'));
				$("#progress4").attr("style","width:"+v_widget2[i].Porcentaje+"%;");
				$("#href4").attr("href","/consultas?IdDTE="+v_widget2[i].id_dtes+"");
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
});
