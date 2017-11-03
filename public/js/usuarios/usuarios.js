var RegistroUsuario = '';
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var ManejoRespuestaProcesarI = function(respuesta){
    if(respuesta.code==200){
        if(respuesta.respuesta.activar>0){
            if(respuesta.respuesta.v_usuarios.length>1){
                toastr.success('Proceso con exito.', "Procesado!");
                destruirTabla('#tablaUsuarios');
                cargarTablaUsuarios(respuesta.respuesta.v_usuarios);
            }
        }else{
            toastr.warning("Debe seleccionar un registro", "Info!");
        }
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }
}

var ManejoRespuestaProcesarR = function(respuesta){
    if(respuesta.code==200){
        var res = respuesta.respuesta;
        switch(res.code) {
            case '200':
                toastr.success(res.des_code, "Procesado!");
                break;
            case '500':
                toastr.error(res.des_code, "Error!");
                break;
            default:
                toastr.error("Comuniquese con el personal de sopore técnico", "Error!");
        } 
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }
}

var ManejoRespuestaProcesar = function(respuesta){
    if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.f_registro_usuario);
        switch(res.code) {
            case '200':
                toastr.success(res.des_code, "Procesado!");
                destruirTabla('#tablaUsuarios');
                cargarTablaUsuarios(respuesta.respuesta.v_usuarios);
                $(".divForm").toggle();
                $('#FormUsuario')[0].reset();
                break;
            case '2':
                toastr.error(res.des_code, "Error!");
                break;
            default:
                toastr.error("Comuniquese con el personal de sopore técnico", "Error!");
                break;
        } 
    }else{
        toastr.error("Comuniquese con el personal de sopore técnico", "Error!");
    }
};

var cargarTablaUsuarios = function(data){
    $("#tablaUsuarios").dataTable({ 
        "aLengthMenu": [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
        "scrollX": true,
        "scrollY": '45vh',
        "scrollCollapse": false,
        "columnDefs": [
        {
            "targets": [ 1 ],
            "searchable": false
        },
        {"sWidth": "15%", "aTargets": [1]},
        {"sWidth": "11%", "aTargets": [2]},
        {"sWidth": "10%", "aTargets": [4]},
        {"sWidth": "15%", "aTargets": [5]},
        {"sWidth": "15%", "aTargets": [7]},
        {"sWidth": "15%", "aTargets": [10]},
        {"sWidth": "8%", "aTargets": [11]},
        {"sWidth": "15%", "aTargets": [12]},
        ],
        "language": {
            "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
        },
        "data": data,
        "columns":[
        {"title": "Id","data": "idUser",visible:0},
        {"title": "Nombres","data": "usrNombreFull"},
        {"title": "Login","data": "usrUserName"},
        {"title": "idPerfil","data": "idPerfil",visible:0},
        {"title": "Perfíl","data": "des_perfil"},
        {"title": "fecha de creacion","data": "auCreadoEl",visible:0},
        {"title": "Creado id","data": "auCreadoPor",visible:0},
        {"title": "Creado por","data": "creador"},
        {"title": "Teléfono","data": "auModificadoEl",visible:0},
        {"title": "Modificado id","data": "auModificadoPor",visible:0},
        {"title": "Modificado por","data": "modificador"},
        {"title": "Estado","data": "des_estado"},
        {"title": "Última visita","data": "usrUltimaVisita"}
        ],
    });
};

var crearallcombos = function(data){
    crearcombo('#idPerfil',data.v_perfiles);
    crearcombo('#usrEstado',data.v_estados);
}

var cargarFormulario= function(){
    $(".divForm").toggle();
}

var pintarDatosActualizar= function(data){
    $('#divConsulta').show();
    $("#idUser").val(data.idUser);
    $("#usrUserName").val(data.usrUserName);
    $("#usrEmail").val(data.usrEmail);
    $("#usrNombreFull").val(data.usrNombreFull);
    $("#idPerfil").val(data.idPerfil).trigger("change");
    $("#usrEstado").val(data.usrEstado).trigger("change");
    if(data.usrUltimaVisita!=null){$("#usrUltimaVisita").text(data.usrUltimaVisita);}
    if(data.auCreadoEl!=null){$("#auCreadoEl").text(data.auCreadoEl);}
    if(data.creador!=null){$("#creador").text(data.creador);}
    if(data.auModificadoEl!=null){$("#auModificadoEl").text(data.auModificadoEl);}
    if(data.modificador!=null){$("#modificador").text(data.modificador);}
}

var BotonCancelar = function(){
    $(".divForm").toggle();    
    $('#divConsulta').hide();
    $('#FormUsuario')[0].reset();
    $("#idUser").val("");
    mostrarDesconocidos();
    $(".comboclear").val('').trigger("change");
}

var mostrarDesconocidos = function(){
    $("#usrUltimaVisita").text("Desconocido");
    $("#auCreadoEl").text("Desconocido");
    $("#creador").text("Desconocido");
    $("#auModificadoEl").text("Desconocido");
    $("#modificador").text("Desconocido");
}

var BotonAgregar = function(){
    cargarFormulario();
    mostrarDesconocidos();
    $("#divConsulta").hide();
    $("#idUser").val("");
    $(".comboclear").val('').trigger("change");
    $('#FormUsuario')[0].reset();
}

var ProcesarUsuario = function(){
    var camposNuevo = {
        'idPerfil': $('#idPerfil').val(),
        'usrEstado': $('#usrEstado').val()
    }
    parametroAjax.ruta=ruta;
    parametroAjax.data = $("#FormUsuario").serialize() + '&' + $.param(camposNuevo);
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesar(respuesta);
};

var reiniciarClave = function(){
    parametroAjax.ruta=rutaR;
    parametroAjax.data = RegistroUsuario;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarR(respuesta);
}

var validador = function(){
 $('#FormUsuario').formValidation('validate');
};

var cambiarEstatusUsuario = function(data){
    parametroAjax.ruta=rutaA;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarI(respuesta);
}

$(document).ready(function(){
    $("#usrUserName").inputmask({
        mask: "99999999-*", placeholder:"________-_"
    });
	cargarTablaUsuarios(d.v_usuarios);
    crearallcombos(d);
    var tableB = $('#tablaUsuarios').dataTable();
    $('#tablaUsuarios tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        RegistroUsuario = TablaTraerCampo('tablaUsuarios',this);
    });
    tableB.on('dblclick', 'tr', function () {
        $('#close').trigger('click');
    });
     $(function() {
        $.contextMenu({
            selector: '#tablaUsuarios',
            // selector: '.dataTable tbody tr',
            callback: function(key, options) {
                switch(key) {
                    case "1":
                        cargarFormulario();
                        pintarDatosActualizar(RegistroUsuario);
                        break;
                    case "2":
                        reiniciarClave();
                    break;
                    case "3":
                        cambiarEstatusUsuario(RegistroUsuario);
                    break;
                }
            },
            items: {
                "1": {name: "Editar", icon: "edit"},
                "2": {name: "Reiniciar clave", icon: "edit"},
                "3": {name: "Activar / Desactivar", icon: "quit"}
            }
        });
    });
    $(document).on('click','#guardar',validador);
    $(document).on('click','#cancelar',BotonCancelar);
    $(document).on('click','#agregar',BotonAgregar);

    $('#FormUsuario').formValidation({
        excluded:[':disabled'],
        // message: 'El módulo le falta un campo para ser completado',
        fields: {
            'usrUserName': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            }, 
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
            'idPerfil': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },
            'usrEstado': {
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
        ProcesarUsuario();
    })
    .on('status.field.fv', function(e, data){
        data.element.parents('.form-group').removeClass('has-success');
    });
});