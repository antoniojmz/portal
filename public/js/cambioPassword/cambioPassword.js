var RegistroUsuario = '';
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};
var ManejoRespuesta = function(respuesta){
    if (respuesta.code=!'200'){
        toastr.error("Comuniquese con el personal de sopore técnico", "Error!");
        return 0;
    }else{
            if (respuesta.respuesta.code!='200'){
                toastr.error(respuesta.respuesta.des_code, "Error!");
                return 0;
            }else{
                toastr.success(respuesta.respuesta.des_code, "Procesado.!");
                Boton_cancelar();
                return 0;
            }
    }
};
var Boton_cancelar = function(){
     $('#Formclave')[0].reset();
}
var cambiarClave = function(){
    parametroAjax.ruta=ruta;
    parametroAjax.data = $("#Formclave").serialize();
    respuesta=procesarajax(parametroAjax);
    ManejoRespuesta(respuesta);
};
var validador = function(){
 $('#Formclave').formValidation('validate');
};
var boton_cancelar = function(){
    $(".inputClear").val("");
};

$(document).ready(function(){
    $(document).on('click','#aceptar',validador);
    $(document).on('click','#cancelar',boton_cancelar);
    $('#Formclave').formValidation({
        excluded:[':disabled'],
        // message: 'El módulo le falta un campo para ser completado',
        fields: {
            'password_old': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },
            'password': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },
            'password_confirmation': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },
        }
    })
    .on('success.form.fv', function(e){
        cambiarClave();
    })
    .on('status.field.fv', function(e, data){
        data.element.parents('.form-group').removeClass('has-success');
    });
});