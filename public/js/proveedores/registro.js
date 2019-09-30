var RegistroUsuario = RegistroPerfiles = '';
var manejoRefresh=limpiarPerfiles=limpiarUsuarios=errorRut=0;

var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var parametroAjaxGet = {
    'token': $('input[name=_token]').val(),
    'tipo': 'GET',
    'data': {},
    'ruta': '',
    'async': false
};

// Manejo Desbloquear cuenta de usuario
var ManejoRespuestaDesbloquearcuenta = function(respuesta){
    if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.v_desbloqueo);
        if(res.code==200){
            toastr.success('Cuenta desbloqueada con exito.', "Procesado!");
            cargarTablaUsuarios(respuesta.respuesta.v_usuarios);
        }else{
            toastr.warning("Ocurrio un error al tratar de desbloquear la cuenta.", "Info!");
        }
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }
}

// Manejo Activar Desactivar perfil
var ManejoRespuestaProcesarP = function(respuesta){
    if(respuesta.code==200){
        cargarTablaEmpresas(respuesta.respuesta.v_empresas);
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }
}

// Manejo Activar / Desactivar usuarios
var ManejoRespuestaProcesarI = function(respuesta){
    if(respuesta.code==200){
        if(respuesta.respuesta.activar>0){
            if(respuesta.respuesta.v_usuarios.length>0){
                toastr.success('Proceso con exito.', "Procesado!");
                // destruirTabla('#tablaUsuarios');
                cargarTablaUsuarios(respuesta.respuesta.v_usuarios);
            }
        }else{
            toastr.warning("Debe seleccionar un registro", "Info!");
        }
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }
}

// Manejo Reinicio de contraseña
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

// Manejo Registro o actualizacion de usuario
var ManejoRespuestaProcesar = function(respuesta){
    if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.f_registro_usuario);
        switch(res.code) {
            case '200':
                toastr.success(res.des_code, "Procesado!");
                cargarTablaUsuarios(respuesta.respuesta.v_usuarios);
                $(".divForm").toggle();
                $('#FormUsuario')[0].reset();
                break;
            case '-2':
                toastr.warning(res.des_code, "Error!");
                break;
            default:
                toastr.error("Comuniquese con el personal de sopore técnico", "Error!");
                break;
        } 
    }else{
        toastr.error("Comuniquese con el personal de sopore técnico", "Error!");
    }
};

// Manejo agregar perfil
var ManejoRespuestaProcesarPerfil = function(respuesta){
    if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.f_registro_empresa);
        switch(res.code) {
            case '200':
                toastr.success(res.des_code, "Procesado!");
                $(".comboclear").val('').trigger("change");  
                cargarTablaEmpresas(respuesta.respuesta.v_empresas);
                manejoRefresh=1;
                break;
            case '-2':
                toastr.warning(res.des_code, "Error!");
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
    if(limpiarUsuarios==1){destruirTabla('#tablaUsuarios');$('#tablaUsuarios thead').empty();}
        $("#tablaUsuarios").dataTable({ 
            "aLengthMenu": DataTableLengthMenu,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "scrollX": true,
            "scrollY": '45vh',
            "scrollCollapse": true,
            "data": data,
            "columns":[
            {"title": "Id","data": "idUser",visible:0},
            {"title": "Empresa","data": "NombreProveedor"},
            {"title": "Nombres","data": "usrNombreFull"},
            {"title": "Login", "data": "usrUserName",
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = formateaRut(data, true)
                    }
                    return data;
                }
            },
            {"title": "fecha de creacion","data": "auCreadoEl",visible:0},
            {"title": "Creado id","data": "auCreadoPor",visible:0},
            {"title": "Creado por","data": "creador"},
            {"title": "Teléfono","data": "auModificadoEl",visible:0},
            {"title": "Modificado id","data": "auModificadoPor",visible:0},
            {"title": "Modificado por","data": "modificador"},
            {"title": "Estado","data": "des_estado"},
            {"title": "Última visita","data": "usrUltimaVisita"},
            {"title": "Estatus Bloqueo","data": "DescripcionBloqueo"}   
            ],
        });
        limpiarUsuarios=1;
    if (data.length>0){  
        seleccionarTablaUsuarios();
    }
};

var seleccionarTablaUsuarios = function(data){
    var tableB = $('#tablaUsuarios').dataTable();
    
    $('#tablaUsuarios tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        RegistroUsuario = TablaTraerCampo('tablaUsuarios',this);
    });

    tableB.on('dblclick', 'tr', function () {
        $('#close').trigger('click');
    });

    if (d.v_perfil.perfil==2 || d.v_perfil.perfil==3){
        $(function(){
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
                        case "4":
                            administrarEmpresas(RegistroUsuario);
                        break;
                        case "5":
                            desbloquearCuenta(RegistroUsuario);
                        break;

                    }
                },
                items: {
                    "1": {name: "Editar", icon: "fa-pencil-square-o"},
                    "2": {name: "Reiniciar clave", icon: "fa-refresh"},
                    "3": {name: "Activar / Desactivar", icon: "fa-toggle-on"},
                    "4": {name: "Administrar empresas", icon: "fa-cubes"},
                    "5": {name: "Desbloquear cuenta", icon: "fa-user"}
                }
            });
        });
    }
}

var cargarTablaEmpresas = function(data){
    if(limpiarPerfiles==1){destruirTabla('#tablaEmpresas');}
        $("#spanAlert").text("");
       $("#divTablaPerfiles").show();
       $("#tablaEmpresas").dataTable({ 
            "aLengthMenu": DataTableLengthMenu,
            "scrollCollapse": true,
            "paging": false,
            "searching": false,
            "columnDefs": [
            {"targets": [ 1 ], "searchable": false}],
            "data": data,
            "columns":[
                {"title": "Nombres","data": "usrNombreFull"},
                {"title": "Login","data": "usrUserName"},
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {"title": "Empresa","data": "NombreProveedor"},
                {"title": "Estado","data": "des_estadoProveedor"},
            ],
        });
        limpiarPerfiles=1;
    if (data.length>0){
        seleccionarTablaEmpresas();
    }else{
       $("#divTablaPerfiles").hide();  
    }   
};

var seleccionarTablaEmpresas = function(data){
    var tableC = $('#tablaEmpresas').dataTable();
    $('#tablaEmpresas tbody').on('click', 'tr', function (e) {
        tableC.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        RegistroPerfiles = TablaTraerCampo('tablaEmpresas',this);
    });
    tableC.on('dblclick', 'tr', function () {
        $('#close').trigger('click');
    });
     $(function() {
        $.contextMenu({
            selector: '#tablaEmpresas',
            // selector: '.dataTable tbody tr',
            callback: function(key, options) {
                switch(key) {
                    case "1":
                        cambiarEstatusPerfil(RegistroPerfiles);
                        // cambiarEstatusUsuario(RegistroUsuario);
                    break;
                }
            },
            items: {
                "1": {name: "Activar / Desactivar", icon: "fa-toggle-on"},
            }
        });
    });
};

var crearallcombos = function(data){
    crearcombo('#idProveedor',data.v_proveedores_combos);
    crearcombo('#idEmpresa',data.v_proveedores_combos);
    crearcombo('#usrEstado',data.v_estados);
};

var cargarFormulario= function(){
    $(".divForm").toggle();
};

var volverPerfiles = function(){
    if (manejoRefresh==1){
        cambiarSalir();
        location.reload();
    }else{
        $(".divPerfiles").toggle();
        $("#spanAlert").text("");
        $("#divTablaPerfiles").hide();
        $(".comboclear").val('').trigger("change");  
        $("#idUser2").val("")
    }
};

var administrarEmpresas= function(data){
    manejoRefresh=0;
    $("#idUser2").val(data.idUser);
    $("#idProveedor").val(data.IdProveedor)
    buscarEmpresas(data);
    $(".divPerfiles").toggle();
}

var desbloquearCuenta = function(data){
    if(data.EstadoBloqueo==1){
        toastr.warning("Esta cuenta de usuario no se encuentra bloqueada", "Aviso!");
        return 0;
    }else{
        parametroAjax.ruta=rutaDC;
        parametroAjax.data = data;
        respuesta=procesarajax(parametroAjax);
        ManejoRespuestaDesbloquearcuenta(respuesta);
    }
}

var pintarDatosActualizar= function(data){
    console.log("divConsulta: " + $('#divConsulta').is(":visible"));
    console.log("divInfoUsuario: " + $('#divInfoUsuario').is(":visible"));

    $("#divEmpresa").hide();
    $("#perfiles").text("N/A o Inactivo")

    $('#divConsulta').show();
    $('#divInfoUsuario').show();
    
    $('#divSpanPerfiles').show();

    $('#spanTituloFormulario').html("<h4>Visualización de datos del Usuario</h4>");

    $("#idUser").val(data.idUser);
    $("#usrUserName").val(data.usrUserName);
    $("#usrEmail").val(data.usrEmail);
    $("#usrNombreFull").val(data.usrNombreFull);
    $("#usrEstado").val(data.usrEstado).trigger("change");

    if(data.usrUltimaVisita!=null){
        $("#usrUltimaVisita").text(data.usrUltimaVisita);
    }
    if(data.auCreadoEl!=null){
        $("#auCreadoEl").text(data.auCreadoEl);
    }
    if(data.creador!=null){
        $("#creador").text(data.creador);
    }
    if(data.auModificadoEl!=null){
        $("#auModificadoEl").text(data.auModificadoEl);
    }
    if(data.modificador!=null){
        $("#modificador").text(data.modificador);
    }

    if(data.des_Perfil!=null){
        var res = data.des_Perfil.split(",");
        var des='';
        res.length>1 ? des="Perfiles" : des="Perfil"
        $("#labelPerfil").text(des);
        $("#perfiles").text(res);
    }

    console.log("divConsulta: " + $('#divConsulta').is(":visible"));
    console.log("divInfoUsuario: " + $('#divInfoUsuario').is(":visible"));

}

var BotonCancelar = function(){
    $("#divEmpresa").hide();
    $(".divForm").toggle();    
    $('#divConsulta').hide();
    $('#divInfoUsuario').hide();
    
    $('#FormUsuario')[0].reset();
    $("#idUser").val("");
    $('#divSpanPerfiles').hide();
    mostrarDesconocidos();
};

var mostrarDesconocidos = function(){
    $("#usrUltimaVisita").text("Nunca");
    $("#auCreadoEl").text("Desconocido");
    $("#creador").text("Desconocido");
    $("#auModificadoEl").text("Desconocido");
    $("#modificador").text("Desconocido");
};

var BotonAgregar = function(){
    cargarFormulario();
    mostrarDesconocidos();
    $("#divEmpresa").show();
    
    $('#spanTituloFormulario').html("<h4>Nuevo Usuario del Proveedor</h4>");

    $("#divConsulta").hide();
    $('#divInfoUsuario').hide();

    $("#divSpanPerfiles").hide();
    $("#idUser").val("");
    $(".comboclear").val('').trigger("change");
    $('#FormUsuario')[0].reset();
};

var BotonAgregarEmpresa = function(){
    var data = {'idProveedor': $('#idProveedor').val(), 'idUser': $('#idUser2').val()};
    parametroAjax.ruta = rutaP;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarPerfil(respuesta);
};

var ProcesarUsuario = function(){
    $("body").addClass("loading");

    setTimeout(function(){
        try{
            if (errorRut==0){
                var camposNuevo = {'usrEstado': $('#usrEstado').val(),'idEmpresa': $('#idEmpresa').val()}
                parametroAjax.ruta=ruta;
                parametroAjax.data = $("#FormUsuario").serialize() + '&' + $.param(camposNuevo);
                respuesta=procesarajax(parametroAjax);
                ManejoRespuestaProcesar(respuesta);
            }
        }catch(err) {
            alert("Error inesperado al realizar la consulta de ordenes de compra: " + err.message);
            console.log("Error inesperado al realizar la consulta de ordenes de compra: " + err.message);
        }

        $("body").removeClass("loading"); 

    }, 1);
};

var buscarEmpresas = function(data){
    parametroAjaxGet.ruta=rutaP;
    parametroAjaxGet.data = data;
    respuesta=procesarajax(parametroAjaxGet);
    ManejoRespuestaProcesarP(respuesta);
};

var reiniciarClave = function(){
    parametroAjax.ruta=rutaR;
    parametroAjax.data = RegistroUsuario;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarR(respuesta);
};

var validador = function(){
    $('#FormUsuario').formValidation('validate');
};

var validadorEmpresa = function(){
    $('#FormEmpresa').formValidation('validate');
};

var cambiarEstatusUsuario = function(data){
    parametroAjax.ruta=rutaA;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarI(respuesta);
};

var cambiarEstatusPerfil = function(data){
    manejoRefresh=1;
    parametroAjax.ruta=rutaAP;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarP(respuesta);
};

var verificarRut = function(control){
    var res = Valida_Rut(control);
    var format = formateaRut(control.val(), res);
    if (format != false){
        errorRut = 0;       
        $("#ErrorRut").text("");
        return format;
    }else{
        errorRut = 1;       
        $("#ErrorRut").text("Rut invalido");
        return control.val();
    }
}

$(document).ready(function(){
    ClassActive("LiProveedores");
    
    $("#usrUserName").focusout(function() {
        var valid = $("#usrUserName").val();
        if (valid.length > 0){
            var res = verificarRut($("#usrUserName"));
            $("#usrUserName").val(res);
        }else{$("#ErrorRut").text("");}
    });

	cargarTablaUsuarios(d.v_usuarios);
    crearallcombos(d);  

    $(document).on('click','#guardar',validador);
    $(document).on('click','#cancelar',BotonCancelar);
    $(document).on('click','#agregar',BotonAgregar);
    $(document).on('click','#agregarP',validadorEmpresa);
    $(document).on('click','#volverPerfiles',volverPerfiles);
    
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

    
    $('#FormEmpresa').formValidation({
        excluded:[':disabled'],
        // message: 'El módulo le falta un campo para ser completado',
        fields: {
            'idProveedor': {
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
        BotonAgregarEmpresa();
    })
    .on('status.field.fv', function(e, data){
        data.element.parents('.form-group').removeClass('has-success');
    });
});