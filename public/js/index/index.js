var imgProgreso = '<img alt="" src="/img/giphy.gif" height="50" width="50"/>';
var errorLoad = errorLoadAll = stopload = stopRead = 0;
var salir = "{{ URL::route('logout') }}";
var cambiarSalir = function(){
	v_salir = 1;
}

var parametroAjaxGET = {
    'token': $('input[name=_token]').val(),
    'tipo': 'GET',
    'data': {},
    'ruta': '',
    'async': false
};

var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

var ManejoRespuestaCambiarStatusChat = function (respuesta){	
	if(respuesta.code==200){
		$("#divChatMin").stop();
		stopRead = 0;	
    }
}

var ManejoRespuestaProcesarChat = function (respuesta){	
	if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.f_registro_chat);
        if(res.code==200){
			stopRead = 0;
			$("#divChatMin").stop();	
        	$("#idChat").val(res.idChat);
        	$('#message').focus();
        	$("#message").val("");
        }else{
            toastr.warning(respuesta.respuesta.des_code, "Info!");
        }
    }else{
        toastr.error("Disculpe, No conseguimos enviar su mensaje", "Error!");
    }
}

var ManejoRespuestaProcesarGetChat = function (respuesta){
	// if(respuesta.code==200){
	if(respuesta!=null){
	// 	var idChat = respuesta.respuesta.idChat;
		var idChat = respuesta.idChat;
		idChat == null ? $("#idChat").val(0) : $("#idChat").val(idChat);
		var res = respuesta.chat
	// 	var res = respuesta.respuesta.chat
		var array = [];
	    if(res!=null){
			for (i = 0; i < res.length; i++) { 
	            if (res[i].IdPerfil==3){
					array[i]='<div class="m-messenger__message m-messenger__message--out"><div class="m-messenger__message-body"><div class="m-messenger__message-arrow"></div><div class="m-messenger__message-content" style="width: 280px;"><div class="m-messenger__message-text">'+res[i].message+'</div><div class="m-messenger__message-username" style="color:#FFF;text-align:right;">'+moment(res[i].FechaMessage, 'YYYY-MM-DD HH:mm:ss',true).format("HH:mm")+'</div></div></div></div>';
				}else{
					array[i]='<div class="m-messenger__message m-messenger__message--in"><div class="m-messenger__message-body"><div class="m-messenger__message-arrow" style="color:#FFF"></div><div class="m-messenger__message-content" style="background-color:#FFF;width:280px;"><div class="m-messenger__message-username">Ejecutivo</div><div class="m-messenger__message-text">'+res[i].message+'</div><div class="m-messenger__message-username" style="text-align:right;">'+moment(res[i].FechaMessage, 'YYYY-MM-DD HH:mm:ss',true).format("HH:mm")+'</div></div></div></div>';
					if(res[i].statusAdmin==1){stopRead = 1;}
				}
				$("#ChatBody").html(array);
			}
		}
		var top = $("#styleScroll").prop("scrollHeight");
		$("#styleScroll").scrollTop(top);
    }	
}

var ManejoRespuestaProcesarGetAllChat = function (respuesta){
	if(respuesta!=null){
		var res = respuesta;
		var array = [];
		var count = 0;
		// if(respuesta.code==200){
	    if(res!=null){
			// var res = respuesta.respuesta
	        if (res.length > 0){
				for (i = 0; i < res.length; i++) { 
					var operador = '';
					var usuario = '';
					res[i]['Operador'] == null ? operador = "No asignado" : operador = res[i]['Operador']; 
					if (res[i].statusMessage==1){
						count++;
						array[i]='<div onclick="LoadConversation('+res[i].idChat +')" style="background-color:#FDF2A0;" class="m-list-timeline__item" data-toggle="tooltip" title="'+res[i].Proveedor+'"><span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span><span class="m-list-timeline__text">'+res[i].Usuario+'</span><span class="m-list-timeline__text">'+operador+' </span><span class="m-list-timeline__time">'+moment(res[i].FechaMessage).fromNow()+'</span></div>';
					}else{
						array[i]='<div onclick="LoadConversation('+res[i].idChat +')" class="m-list-timeline__item" data-toggle="tooltip" title="'+res[i].Proveedor+'"><span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span><span class="m-list-timeline__text">'+res[i].Usuario+'</span><span class="m-list-timeline__text">'+operador+'</span><span class="m-list-timeline__time">'+moment(res[i].FechaMessage).fromNow()+'</span></div>';
					}
					
					$("#divBuzon").html(array);
				}
				if (count > 0){
					$("#notificacionPri").html('<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>');
					$("#notificacionSec").html('<span class="m-badge m-badge--success">'+count+'</span>');
				}else{
					$("#notificacionPri").html('');
					$("#notificacionSec").html('');
				}
			}	
		}	
    }
}

// Maximizar ventana de chat
var ShowMessage = function(){
	$("#divChatMin").stop();
	$("#divChatMin").hide("slow");
	$("#divChat").show("fast");
	$('#message').focus();
	cambiarStatusMessage();
}

// Minimizar ventana de chat
var HideMessage = function(){
	$("#divChat").hide("fast");
	$("#divChatMin").show("slow");
}

// Envio a la pantalla de mensajes con el chat seleccionado
var LoadConversation = function(data){
	$("#idSubmitchat").val(data);
	$("#formIdChat").submit();
}

//Enviar mensajes
var SendMessage = function(){
	var message = $("#message").val();
	if (message.length > 1){	
	    parametroAjax.ruta = rutaGetChat;
	    parametroAjax.data = $("#FormChat").serialize();
	    respuesta=procesarajaxChat(parametroAjax);
	    ManejoRespuestaProcesarChat(respuesta);
	}
}

// Cambiar el status de los mensajes enviados por el administrador 
//(Marcar como leido)
var cambiarStatusMessage = function(){
	parametroAjax.ruta = rutaStatusChat;
    parametroAjax.data = $("#FormChat").serialize();
    respuesta=procesarajaxChat(parametroAjax);
    ManejoRespuestaCambiarStatusChat(respuesta);
}

// Carga de mensajes
var LoadMessage = function(){
	if (stopload==0){
		$.get(rutaGetChat, function(data) {ManejoRespuestaProcesarGetChat(data);});
		// ManejoRespuestaProcesarGetChat(data); 
		// parametroAjaxGET.ruta = rutaGetChat;
		// respuesta=procesarajaxChat(parametroAjaxGET);
	}
}

//Carga de buzon de mensajes
var LoadMailbox = function(){
	if (stopload==0){
		$.get(rutaGetAllChat, function(data) {ManejoRespuestaProcesarGetAllChat(data);});
		// parametroAjaxGET.ruta = rutaGetAllChat;
		// respuesta=procesarajaxChat(parametroAjaxGET);
		// ManejoRespuestaProcesarGetAllChat(respuesta);
	}
}

//Funcion que coloca el menu activo (Donde el usuario acaba de hacer click)
var ClassActive = function(id){
	$(".m-menu__item").removeClass("m-menu__item--active");
	$("#"+id).addClass("m-menu__item--active");
}

// Cambio de color en la barra del chat (Nuevo mensaje)
var notificacionChat = function(){
	if (stopRead == 1){
		$("#divChatMin").animate({'background-color': "#00c5dc;"}, 1000);
		$("#divChatMin").animate({'background-color': "#840ad9;"}, 1000);
		$("#divChatMin").animate({'background-color': "#1192f6;"}, 1000);	
	}else{
		$("#divChatMin").animate({'background-color': "#1192f6;"});	
	}
} 

$(document).ready(function() {
	// moment en idioma español
	moment.locale('es');
	// Carga inicial del buzon de notificacones de Chat con Proveedores
	$("#divBuzon").html("<br />No hay mensajes pendientes...");
	$('#divBuzon').css('text-align','center');
	$('#divBuzon').css('font-size','12px');
	$('#divBuzon').css('color','#898b96');
	//Datos de usuario para cargar el contenido dependiendo del perfil
	v['v_perfil'] = $("#idPerfiltext").val();
	v['idUser'] = $("#idUsertext").val();
	switch(v['v_perfil']) {
		case "1":
		    // console.log("Soy administrador home");
		break;
		case "2":
		    // console.log("Soy cliente home");
		    // LoadMailbox();
			setInterval("LoadMailbox()", 2200);
		break; 
		case "3":
		    // console.log("Soy proveedor home");
			// notificacionChat();
		    // LoadMessage();
			setInterval("notificacionChat()", 3200);
			setInterval("LoadMessage()", 2200);
		    $(document).on('click','#divChatMin',ShowMessage);
		    $(document).on('click','#divButtonChat',HideMessage);
		    $(document).on('click','#ChatSubmit',SendMessage);
		break;
	}
	//Cierre de sesion despues de 10 min de inactividad
	// setTimeout(function(){Salir();}, 600000);
	// Cierre de session por manupulacion de url o cierre del navegador
	window.onbeforeunload = function (e) {if (v_salir == 0){Salir();}v_salir = 0;}
    $(document).on('click','.m-menu__link',cambiarSalir);
    $(document).on('click','.btn',cambiarSalir);
    $(document).on('click','.m-nav__link',cambiarSalir);
    $(document).on('click','#btn-logout',Salir);
	$(document.body).on("keydown", this, function (event) {
	    if (event.keyCode == 116) {
	        cambiarSalir();
	    }
	});
});