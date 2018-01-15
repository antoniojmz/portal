var errorLoad = errorLoadAll = refreshMessage = VarIdChat = 0;

var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var parametroAjaxGET = {
    'token': $('input[name=_token]').val(),
    'tipo': 'GET',
    'data': {},
    'ruta': '',
    'async': false
};

var ManejoRespuestaC = function(respuesta,idChat){
    if (respuesta.code = '200'){
        var res = respuesta.respuesta
        if (refreshMessage == 0){$(".divForm").toggle();}
        refreshMessage = 1;
        var arrayC = [];
        var valuechat = 0;
        for (i = 0; i < res.length; i++) {
            if (valuechat == 0){
                $("#idChat").val(res[i].idChat);valuechat = 1
                $("#NombreUsuario").text(res[i].Usuario+" - "+res[i].Proveedor);
                var image = '/img/default.png'
                var foto = res[i].imageUsuario
                if ( foto != null){if (foto.length > 13){ image = res[i].imageUsuario;}}
                $('#imgUserChat').attr('src',image)+ '?' + Math.random();
            }
            if (res[i].id_creador==d['idUser']){
                arrayC[i]='<div class="row"><div class="col-md-12"><div class="m-messenger__message m-messenger__message--out"><div class="m-messenger__message-body"><div class="m-messenger__message-arrow"></div><div class="m-messenger__message-content"><div class="m-messenger__message-text">'+res[i].message+'</div><div class="m-messenger__message-username" style="color:#FFF;text-align:right;">'+moment(res[i].FechaMessage, 'YYYY-MM-DD HH:mm:ss',true).format("mm:ss")+'</div></div></div></div></div></div></div>';
            }else{
                arrayC[i]='<div class="row"><div class="col-md-12"><div class="m-messenger__message m-messenger__message--in"><div class="m-messenger__message-body"><div class="m-messenger__message-arrow"></div><div class="m-messenger__message-content"><div class="m-messenger__message-username">'+res[i].Usuario+'</div><div class="m-messenger__message-text">'+res[i].message+'</div><div class="m-messenger__message-username" style="text-align:right;">'+moment(res[i].FechaMessage, 'YYYY-MM-DD HH:mm:ss',true).format("mm:ss")+'</div></div></div></div></div></div>';
            }
            $("#ChatBodyC").html(arrayC);
        }
        VarIdChat = idChat
    }else{
        toastr.error("Error al cargar la conversación, contacte al personal informático", "Error!");
    };
}

var enviarMessage = function(){
    var message = $("#message").val();
    var id_chat = $("#idChat").val();
    if (message.length > 1){    
        if (id_chat == 0){
            toastr.warning("No fue posible identificar el origen del chat. Por favor, intente nuevamente", "Error!");
            return;
        }else{
            parametroAjax.ruta = rutaGetChat;
            parametroAjax.data = $("#FormChatC").serialize();
            respuesta=procesarajaxChat(parametroAjax);
            ManejoRespuestaProcesarChat(respuesta);
        }
    }    
};

var cargarFormulario = function(idChat){
    parametroAjax.ruta=rutaC;
    parametroAjax.data = {"idChat":idChat};
    respuesta=procesarajaxChat(parametroAjax);
    ManejoRespuestaC(respuesta,idChat);
}

var volverChat = function(){
    $(".divForm").toggle();
    $("#FormChatC")[0].reset();
    refreshMessage = 0; 
    $('#imgUserChat').attr('src','/img/default.png')+ '?' + Math.random();    
}

var cargarBuzon = function(res){
    var array = [];
    for (i = 0; i < res.length; i++) {    
        var image = '/img/default.png'
        var foto = res[i].imageUsuario; 
        var operador = "No asignado";
        if (foto != null){if (foto.length > 13){ image = res[i].imageUsuario;}}
        if (res[i].Operador != null){ operador=res[i].Operador}
        var message = res[i].message;
        var cadena =150;
        if (message.length > cadena ){message = message.substr(0,cadena)+"...";} 
        if (res[i].statusMessage==1){
            array[i] = '<div onclick="cargarFormulario('+res[i].idChat+');" class="m-widget3__item" style="background-color:#FDF2A0"><div class="m-widget3__header"><div class="m-widget3__user-img"><img class="m-widget3__img" src="'+image+'" alt=""></div><div class="m-widget3__info"><div class="row"><div class="col-md-3"><span class="m-widget3__username">'+res[i].Usuario+'</span><br><span class="m-widget3__time">'+moment(res[i].FechaMessage).fromNow()+'</span></div><div class="col-md-9"><div class="row"><div class="col-md-9"><span class="m-widget3__username">'+message+'</span></div><div class="col-md-3"><span style="float:right;padding-right:20px;" class="m-widget3__time">'+operador+'</span></div></div></div></div></div></div></div>';
        }else{
            array[i] = '<div onclick="cargarFormulario('+res[i].idChat+');" class="m-widget3__item" style="background-color:#FFFFFF"><div class="m-widget3__header"><div class="m-widget3__user-img"><img class="m-widget3__img" src="'+image+'" alt=""></div><div class="m-widget3__info"><div class="row"><div class="col-md-3"><span class="m-widget3__username">'+res[i].Usuario+'</span><br><span class="m-widget3__time">'+moment(res[i].FechaMessage).fromNow()+'</span></div><div class="col-md-9"><div class="row"><div class="col-md-9"><span class="m-widget3__username">'+message+'</span></div><div class="col-md-3"><span style="float:right;padding-right:20px;" class="m-widget3__time">'+operador+'</span></div></div></div></div></div></div></div>';
        }
    } 
    $("#divBandejaMensaje").html(array);
}

var LoadBuzon = function(){
    parametroAjaxGET.ruta = RutabR;
    respuesta=procesarajaxChat(parametroAjaxGET);
    if (respuesta.code == 200){
        cargarBuzon(respuesta.respuesta);
    }else{
        if(errorLoadAll==0){
            toastr.warning("Ocurrio un error al refrescar el buzon de mensajes", "Error!");
            errorLoadAll=1;
        }
    }
}

var selected = function(){
    if (refreshMessage == 0){
        LoadBuzon();           
    }else{
        if (VarIdChat != 0){cargarFormulario(VarIdChat);}
    }
}

$(document).ready(function(){
    cargarBuzon(d.v_chat);  
    setInterval("selected()", 500);
    // selected();
    $(document).on('click','#ChatSubmitC',enviarMessage);
    $(document).on('click','#volverChat',volverChat);
});