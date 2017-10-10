var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var ManejoRespuestaProcesar = function(respuesta){
    if(respuesta.code==200){
        $(".divBotonera").toggle();
    }else{
        mensajesAlerta('Error','Comuniquese con el personal de sopore técnico', 'error');
    }
};

var ManejoRespuestaProcesarDelPic = function(respuesta){
    if(respuesta.code==200){
        switch(respuesta.respuesta.code) {
            case '204':
                $('.gavatar').attr('src','/img/default.png')+ '?' + Math.random();
                $('.avatar').attr('src','/img/default.png')+ '?' + Math.random();
                $("#usrUrlimage").val("");
            break;
            default:
                mensajesAlerta('Error',res.des_code, 'error');
            break;
        } 
    }else{
        mensajesAlerta('Error','Comuniquese con el personal de sopore técnico', 'error');
    }
}

var ManejoRespuestaProcesarUpPic = function(respuesta){
    if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta);
        switch(res.code) {
            case '200':
                $('.gavatar').attr('src',res.des_code)+ '?' + Math.random();
                $('.avatar').attr('src',res.des_code)+ '?' + Math.random();
                $("#usrUrlimage").val(res.des_code);
            break;
            default:
                mensajesAlerta('Error',res.des_code, 'error');
            break;
        } 
    }else{
        mensajesAlerta('Error','Comuniquese con el personal de sopore técnico', 'error');
    }
}

var ActualizarDatos= function(data){
    parametroAjax.ruta=ruta;
    parametroAjax.data = $("#FormDatos").serialize();
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesar(respuesta);
}

var pintarDatosActualizar= function(data){
    if (data.usrUrlimage!=null){
        if (data.usrUrlimage.length>1){
            $('.gavatar').attr('src',data.usrUrlimage)+ '?' + Math.random();
            $("#usrUrlimage").val(data.usrUrlimage);
        }
    }
    $("#idUser").val(data.idUser);
    $("#usrUserName").text(data.usrUserName);
    $("#usrEmail").val(data.usrEmail);
    $("#usrNombreFull").val(data.usrNombreFull);
    if(data.usrUltimaVisita!=null){$("#usrUltimaVisita").text(data.usrUltimaVisita);}
    if(data.auCreadoEl!=null){$("#auCreadoEl").text(data.auCreadoEl);}
}

var BotonCancelar = function(){
    $(".divBotonera").toggle(); 
    $('.input').prop('readonly', true);
    // $('#FormDatos')[0].reset();
    // $("#idUser").val("");
}

var BotonModificar = function(){
    $(".divBotonera").toggle(); 
    $('.input').prop('readonly', false);
}

var validador = function(){
   $('#FormDatos').formValidation('validate');
};
var validar = function(){
    $('#FormDatos').formValidation({
        excluded:[':disabled'],
        // message: 'El módulo le falta un campo para ser completado',
        fields: {
            'usrNombreFull': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },            
            'usrEmail': {
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                    emailAddress: {
                        message: 'Ingrese una dirección de correo valida'
                    }
                }
            },
        }
    })
    .on('success.form.fv', function(e){
        ActualizarDatos();
    })
    .on('status.field.fv', function(e, data){
        data.element.parents('.form-group').removeClass('has-success');
    });
};

var eliminarFoto = function(){
    parametroAjax.ruta=rutaE;
    parametroAjax.data = {'idUser':$('#idUser').val(), 'usrUrlimage':$("#usrUrlimage").val()};
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarDelPic(respuesta);
}
var actualizarFoto = function(){
    var form = $('#FormDatos').get(0);
    var formData = new FormData(form);
    parametroAjax.ruta=rutaC;
    parametroAjax.data = formData;
    respuesta=procesarajaxfile(parametroAjax);
    ManejoRespuestaProcesarUpPic(respuesta);
};

$(document).ready(function(){
    $('.input').prop('readonly', true);
    validar();
    pintarDatosActualizar(d.v_datos);
    $(document).on('click','#modificar',BotonModificar);
    $(document).on('click','#guardar',validador);
    $(document).on('click','#cancelar',BotonCancelar);
    $(document).on('click','#cargar',actualizarFoto);
    $(document).on('click','#eliminar',eliminarFoto);
});