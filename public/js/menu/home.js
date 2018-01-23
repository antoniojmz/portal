// var parametroAjax = {
//     'token': $('input[name=_token]').val(),
//     'tipo': 'POST',
//     'data': {},
//     'ruta': '',
//     'async': false
// };

// var manejoRespuestaNoticia = function(respuesta){
// 	if(respuesta.code==200){
//         var res = JSON.parse(respuesta.respuesta.v_info);
//         switch(res.code) {
//             case '204':
// 	    		var data = respuesta.respuesta.v_publicaciones[0];
// 	    		console.log(data);
// 				$("#tituloNoticia").text(data.titulo);
// 				$("#descripcionNoticia").text(data.descripcion);
// 				$("#detalleNoticia").text(data.detalle);
// 	    		var res = data.urlImage;
// 				var image = '';
// 				res.length < 13 ? image = 'img/default-img.png' : image=res;
// 				$('#imageNoticia').attr('src',res)+ '?' + Math.random();
// 				$(".FormNoticias").toggle();
//             break;
//             case '-2':
//                 toastr.warning(res.des_code, "Error!");
//             break;
//             default:
//                 toastr.error("Comuniquese con el personal de sopore técnico", "Error!");
//             break;
//         } 
//     }else{
//         toastr.error("Comuniquese con el personal de sopore técnico", "Error!");
//     }
// }

var cargarNoticias = function(data){
    // parametroAjax.ruta = ruta;
    // parametroAjax.data = {'IdNoticia': data} ;
    // respuesta=procesarajax(parametroAjax);
    // manejoRespuestaNoticia(respuesta);
	var detalle = $('#DetalleForm'+data).val()
	$("#tituloNoticia").text($('#tituloForm'+data).val());
	$("#descripcionNoticia").text($('#descripcionForm'+data).val());
	document.getElementById('detalleNoticia').innerHTML = detalle;
	var res = $('#urlImageForm'+data).val();
	var image = '';
	res.length < 13 ? image = 'img/default-img.png' : image=res;
	$('#imageNoticia').attr('src',res)+ '?' + Math.random();
	$(".FormNoticias").toggle();
	$('html,body').animate({ scrollTop: $("#divSeparacion").offset().top });
}

var volverNoticias = function(data){
	$(".FormNoticias").toggle();
	datos = {};
	$('#imageNoticia').attr('src','img/default-img.png')+ '?' + Math.random();
}

var paginacion = function (data,total){
	// var result = d['v_count'] / total;
	// console.log(data);
	// if (data.length > result){ data.pop(); }
	// console.log(data);
	$.each(data, function(index,value) {
		$("#href"+value).click(function(){
			Principio();		
			$(".hrefactive").removeClass("active");
			$("#href"+value).addClass("active");
			$(".divNoticias").hide();
			$("#divNoticias"+value).show();
			$("#divPrincipal").hide();
		});
	});
	$("#hrefPrincipio").click(function(){
		Principio();		
		$(".hrefactive").removeClass("active");
		$("#href1").addClass("active");
		$(".divNoticias").hide();
		$("#divNoticias1").show();
		$("#divPrincipal").show();
	});
	$("#hrefFinal").click(function(){
		Principio();		
		$(".hrefactive").removeClass("active");
		$("#href"+total).addClass("active");
		$(".divNoticias").hide();
		$("#divNoticias"+total).show();
		$("#divPrincipal").hide();
	});
}

var Principio = function (){
	$('html,body').animate({
		scrollTop: $("#divSeparacion").offset().top
	});
	$("#href1").click(function(){
		$("#divPrincipal").show();
	});
}

$(document).ready(function(){
    ClassActive("LiHome");    	
	switch(d['v_perfil']) {
	case "1":
	    // console.log("Soy administrador home");
	break;
	case "2":
	    // console.log("Soy cliente home");
	break;
	case "3":
	    // console.log("Soy prveedor home");
		Principio();
	    $(document).on('click','#volverHome',volverNoticias);
	    $( ".idForm" ).click(function() {
	    	cargarNoticias(this.value);
		});
		if (d['v_nombres'].length > 2){
			var res = d['v_nombres'].replace("[", "");
			res = res.replace("]", "");
			res = res.split(",");
			$.each(res, function( key, value ) {
			  	$('div#'+value).expander({
			    	slicePoint: 500,
			    	widow: 2,
			    	expandSpeed: 0
					// expandText: '<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">Leer mas...</button><br />',
			    	// userCollapseText: '<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">Leer menos...</button><br />'
			  	});
			});
		}
		if (d['v_nombresHref'].length > 2){
			var res = d['v_nombresHref'].replace("[", "");
			res = res.replace("]", "");
			res = res.split(",");
			paginacion(res,d.v_total);
		}
	break;
	}
});