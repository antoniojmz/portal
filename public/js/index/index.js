var imgProgreso = '<img alt="" src="/img/giphy.gif" height="50" width="50"/>';
var errorLoad = errorLoadAll = stopload =0;
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

var Salir = function(){
	stopload = 1;
	parametroAjax.ruta=salir;
	parametroAjax.data = $("#formLogout").serialize();
	procesarajax(parametroAjax);
	window.location.href = "/";
}

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


var ManejoRespuestaProcesarChat = function (respuesta){	
	if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.f_registro_chat);
        if(res.code==200){
        	$("#idChat").val(res.idChat);
        	$("#message").val("");
        }else{
            toastr.warning(respuesta.respuesta.des_code, "Info!");
        }
    }else{
        toastr.error("Disculpe, No conseguimos enviar su mensaje", "Error!");
    }
}

var ManejoRespuestaProcesarGetChat = function (respuesta){
	if(respuesta.code==200){
		var idChat = respuesta.respuesta.idChat;
		idChat == null ? $("#idChat").val(0) : $("#idChat").val(idChat);
		var res = respuesta.respuesta.chat
		var array = [];
		for (i = 0; i < res.length; i++) { 
			if (res[i].id_creador==v['idUser']){
				array[i]='<div class="m-messenger__message m-messenger__message--out"><div class="m-messenger__message-body"><div class="m-messenger__message-arrow"></div><div class="m-messenger__message-content" style="width: 280px;"><div class="m-messenger__message-text">'+res[i].message+'</div><div class="m-messenger__message-username" style="color:#FFF;text-align:right;">'+moment(res[i].FechaMessage, 'YYYY-MM-DD HH:mm:ss',true).format("mm:ss")+'</div></div></div></div>';
			}else{
				array[i]='<div class="m-messenger__message m-messenger__message--in"><div class="m-messenger__message-body"><div class="m-messenger__message-arrow"></div><div class="m-messenger__message-content" style="width: 280px;"><div class="m-messenger__message-username">Ejecutivo</div><div class="m-messenger__message-text">'+res[i].message+'</div><div class="m-messenger__message-username" style="text-align:right;">'+moment(res[i].FechaMessage, 'YYYY-MM-DD HH:mm:ss',true).format("mm:ss")+'</div></div></div></div>';
			}
			$("#ChatBody").html(array);
		}
		var altura = $("#mCSB_3").prop("scrollHeight");
		$("#mCSB_3").scrollTop(altura);
    }
}

var ManejoRespuestaProcesarGetAllChat = function (respuesta){
	if(respuesta.code==200){
		var res = respuesta.respuesta
		var array = [];
		var count = 0;
		for (i = 0; i < res.length; i++) { 
			var operador = '';
			var usuario = '';
			res[i]['Operador'] == null ? operador = "No asignado" : operador = res[i]['Operador']; 
			if (res[i].statusMessage==1){
				count++;
				array[i]='<div onclick="LoadConversation('+res[i].idChat +')" style="background-color:#FDF2A0;" class="m-list-timeline__item" data-toggle="tooltip" title="'+res[i].Proveedor+'"><span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span><span class="m-list-timeline__text">'+res[i].Usuario+'</span><span class="m-list-timeline__text">'+operador+' </span><span class="m-list-timeline__time">'+moment(res[i].FechaMessage).fromNow()+' </span></div>';
			}else{
				array[i]='<div onclick="LoadConversation('+res[i].idChat +')" class="m-list-timeline__item" data-toggle="tooltip" title="'+res[i].Proveedor+'"><span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span><span class="m-list-timeline__text">'+res[i].Usuario+'</span><span class="m-list-timeline__text">'+operador+' </span><span class="m-list-timeline__time">'+moment(res[i].FechaMessage).fromNow()+' </span></div>';
			}
			
			$("#divBuzon").html(array);
		}
		if (count > 0){
			$("#countChat").html('<span class="m-nav__link-badge m-badge m-badge--accent">'+count+'</span>');
		}else{
			$("#countChat").html('');
		}
    }
}

var LoadConversation = function(data){
	window.location.href = "/buzon?value="+data;
}

var ShowMessage = function(){
	$("#divChatMin").hide("slow");
	$("#divChat").show("fast");
}

var HideMessage = function(){
	$("#divChat").hide("fast");
	$("#divChatMin").show("slow");
}

var SendMessage = function(){
	var message = $("#message").val();
	if (message.length > 1){	
	    parametroAjax.ruta = rutaGetChat;
	    parametroAjax.data = $("#FormChat").serialize();
	    respuesta=procesarajaxChat(parametroAjax);
	    ManejoRespuestaProcesarChat(respuesta);
	}
}

var LoadMessage = function(){
	if (stopload==0){
		parametroAjaxGET.ruta = rutaGetChat;
		respuesta=procesarajaxChat(parametroAjaxGET);
		ManejoRespuestaProcesarGetChat(respuesta); 
	}
}

var LoadMailbox = function(){
	if (stopload==0){
		parametroAjaxGET.ruta = rutaGetAllChat;
		respuesta=procesarajaxChat(parametroAjaxGET);
		ManejoRespuestaProcesarGetAllChat(respuesta);
	}
}
$(document).ready(function() {
	moment.lang('es');
	v['v_perfil'] = $("#idPerfiltext").val();
	v['idUser'] = $("#idUsertext").val();
	switch(v['v_perfil']) {
		case "1":
		    // console.log("Soy administrador home");
		break;
		case "2":
		    // console.log("Soy cliente home");
		    // LoadMailbox();
			setInterval("LoadMailbox()", 500);
		break; 
		case "3":
		    // console.log("Soy proveedor home");
		    // LoadMessage();
			setInterval("LoadMessage()", 500);
		    $(document).on('click','#divChatMin',ShowMessage);
		    $(document).on('click','#divButtonChat',HideMessage);
		    $(document).on('click','#ChatSubmit',SendMessage);
		break;

	}
	// setTimeout(function(){Salir();}, 600000);
	// window.onbeforeunload = function (e) {if (v_salir == 0){Salir();}v_salir = 0;}
    $(document).on('click','.m-menu__link',cambiarSalir);
    $(document).on('click','.m-nav__link',cambiarSalir);
	$(document.body).on("keydown", this, function (event) {
	    if (event.keyCode == 116) {
	        cambiarSalir();
	    }
	});
}); 