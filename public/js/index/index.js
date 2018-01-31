var imgProgreso = '<img alt="" src="/img/giphy.gif" height="50" width="50"/>';
var stopRead = 0;
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
			$("#message").val("");
			pintarChat(respuesta.respuesta.IdChat,respuesta.respuesta.chat);
        }
    }
}

var ManejoRespuestaProcesarGetChat = function (respuesta){
	if(respuesta!=null){
		if(respuesta.code==200){
			var res = respuesta.respuesta;
			var IdChat = 0
			if (res.length > 0){IdChat = respuesta.respuesta[0].idChat;}
			pintarChat(IdChat,respuesta.respuesta);
    	}	
	}	
}

var pintarChat = function (IdChat,chat){
	var idChat = IdChat;
	idChat == null ? $("#idChat").val(0) : $("#idChat").val(idChat);
	var res = chat
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
	var top = $("#styleScroll").prop("scrollHeight");
	$("#styleScroll").scrollTop(top);
	}
}

var ManejoRespuestaProcesarGetAllChat = function (respuesta){
	if(respuesta!=null){
		var res = respuesta;
		var arrayAlert = [];
    	var arrayBuzon = [];
    	var AlertPrincipal = '';
		var AlertSecundario = '';
		var count = 0;
		if(respuesta.code==200){
			var res = respuesta.respuesta
	        if (res.length > 0){
				for (i = 0; i < res.length; i++) { 
					// var operador = '';
					// var usuario = '';
					res[i]['Operador'] == null ? operador = "No asignado" : operador = res[i]['Operador']; 
	                var image = '/img/default.png'
	                var foto = res[i].imageUsuario; 
	                if (foto != null){if (foto.length > 13){ image = res[i].imageUsuario;}}
	                var message = res[i].message;
	                var cadena =60;
	                if (message.length > cadena ){message = message.substr(0,cadena)+"...";} 
					if (res[i].statusMessage==1){
						count++;
                    	arrayBuzon[i] = '<div onclick="cargarFormulario('+res[i].idChat+');" class="m-widget3__item" style="background-color:#FDF2A0"><div class="m-widget3__header"><div class="m-widget3__user-img"><img class="m-widget3__img" src="'+image+'" alt=""></div><div class="m-widget3__info"><div class="row"><div class="col-md-3"><span class="m-widget3__username">'+res[i].Usuario+'</span><br><span class="m-widget3__time">'+moment(res[i].FechaMessage).fromNow()+'</span></div><div class="col-md-9"><div class="row"><div style="padding-top: 10px;" class="col-md-9"><span class="m-widget3__username">'+message+'</span></div><div class="col-md-3"><span style="float:right;padding-right:20px;" class="m-widget3__time">'+operador+'</span></div></div></div></div></div></div></div>';
						arrayAlert[i]='<div onclick="LoadConversation('+res[i].idChat +')" style="background-color:#FDF2A0;" class="m-list-timeline__item" data-toggle="tooltip" title="'+res[i].Proveedor+'"><span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span><span class="m-list-timeline__text">'+res[i].Usuario+'</span><span class="m-list-timeline__text">'+operador+' </span><span class="m-list-timeline__time">'+moment(res[i].FechaMessage).fromNow()+'</span></div>';
					}else{
                    	arrayBuzon[i] = '<div onclick="cargarFormulario('+res[i].idChat+');" class="m-widget3__item" style="background-color:#FFFFFF"><div class="m-widget3__header"><div class="m-widget3__user-img"><img class="m-widget3__img" src="'+image+'" alt=""></div><div class="m-widget3__info"><div class="row"><div class="col-md-3"><span class="m-widget3__username">'+res[i].Usuario+'</span><br><span class="m-widget3__time">'+moment(res[i].FechaMessage).fromNow()+'</span></div><div class="col-md-9"><div class="row"><div style="padding-top: 10px;" class="col-md-9"><span class="m-widget3__username">'+message+'</span></div><div class="col-md-3"><span style="float:right;padding-right:20px;" class="m-widget3__time">'+operador+'</span></div></div></div></div></div></div></div>';
						arrayAlert[i]='<div onclick="LoadConversation('+res[i].idChat +')" class="m-list-timeline__item" data-toggle="tooltip" title="'+res[i].Proveedor+'"><span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span><span class="m-list-timeline__text">'+res[i].Usuario+'</span><span class="m-list-timeline__text">'+operador+'</span><span class="m-list-timeline__time">'+moment(res[i].FechaMessage).fromNow()+'</span></div>';
					}
				}
				if (count > 0){
					AlertPrincipal = '<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>';
					AlertSecundario = '<span class="m-badge m-badge--success">'+count+'</span>';
				}
			}else{
				arrayAlert = '<br />No hay mensajes pendientes...';
            	arrayBuzon ='<div style="font-size:12px;color:#898b96"><br><center>No hay mensajes pendientes...</center></div>';
			}
			$("#notificacionPri").html(AlertPrincipal);
			$("#notificacionSec").html(AlertSecundario);
			$("#divBuzon").html(arrayAlert);
			$("#divBandejaMensaje").html(arrayBuzon);				
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
	if (message.length > 0){	
	    parametroAjax.ruta = rutaGetChat;
	    parametroAjax.data = $("#FormChat").serialize();
	    respuesta=procesarajaxChat(parametroAjax);
	    ManejoRespuestaProcesarChat(respuesta);
	}
	$("#message").blur();
}

// Cambiar el status de los mensajes enviados por el administrador 
//(Marcar como leido)
var cambiarStatusMessage = function(){
	parametroAjaxGET.ruta = rutaStatusChat;
    parametroAjaxGET.data = $("#FormChat").serialize();
    respuesta=procesarajaxChat(parametroAjaxGET);
    ManejoRespuestaCambiarStatusChat(respuesta);
}

// Carga de mensajes
var LoadMessage = function(){
	parametroAjaxGET.ruta = rutaGetChat;
	respuesta=procesarajaxChat(parametroAjaxGET);
	ManejoRespuestaProcesarGetChat(respuesta); 
}

//Carga de buzon de mensajes
var LoadMailbox = function(){
	parametroAjaxGET.ruta = rutaGetAllChat;
	respuesta=procesarajaxChat(parametroAjaxGET);
	ManejoRespuestaProcesarGetAllChat(respuesta);
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

var SessionTimeout = function() {
	$.sessionTimeout({
        title: "Notificación de cierre de sesión",
        message: "Tu sesión esta por experirar, deseas continuar?",
        keepAliveUrl:"/keep",
        redirUrl:"/home?logout=1",
        logoutUrl: "/home?logout=1",
        warnAfter: 600000,
        redirAfter: 615000,
        ignoreUserActivity: !0,
        countdownMessage: "La sesión finalizará en {timer} segundos.",
        countdownBar: !0,
        logoutButton: "Cerrar sesión",
        keepAliveButton: "Mantener en linea",
    });
}

$(document).ready(function() {
	// moment en idioma español
	moment.locale('es');
	//Datos de usuario para cargar el contenido dependiendo del perfil
	v['v_perfil'] = $("#idPerfiltext").val();
	v['idUser'] = $("#idUsertext").val();
	switch(v['v_perfil']) {
		case "1":
		    // console.log("Soy administrador home");
		break;
		case "2":
		    // console.log("Soy cliente home");
		    LoadMailbox();
			setInterval("LoadMailbox()", 5000);
		break; 
		case "3":
		    // console.log("Soy proveedor home");
		    LoadMessage();
			setInterval("LoadMessage()", 5000);	
			setInterval("notificacionChat()", 3200);
		    $(document).on('click','#divChatMin',ShowMessage);
		    $(document).on('click','#divButtonChat',HideMessage);
		    $(document).on('click','#ChatSubmit',SendMessage);
		    $("#message").on('keypress',function(e){
				if(e.which == 13){
					SendMessage();
				}
			});
		break;
	}
	//Cierre de sesion despues de 10 min de inactividad
	SessionTimeout();
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