var RegistroUsuario = '';
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

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
        console.log(res);
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

var cargarTablaUsuarios = function(d){
console.log(d);
$(".m_datatable").mDatatable({
                data: {
                    type: "local",
                    source: d,
                    pageSize: 10
                },
                layout: {
                    theme: "default",
                    class: "",
                    scroll: !1,
                    height: 450,
                    footer: !1
                },
                sortable: !0,
                filterable: !1,
                pagination: !0,
                columns: [{
                    field: "idUser",
                    title: "#",
                    width: 50,
                    sortable: !1,
                    selector: !1,
                    textAlign: "center"
                }, {
                    field: "idUser",
                    title: "idUser"
                }, {
                    field: "usrNombreFull",
                    title: "usrNombreFull",
                    responsive: {
                        visible: "lg"
                    }
                }, {
                    field: "usrUserName",
                    title: "usrUserName",
                    width: 100
                }, {
                    field: "idPerfil",
                    title: "idPerfil",
                    responsive: {
                        visible: "lg"
                    }
                }, {
                    field: "des_perfil",
                    title: "des_perfil"
                }, {
                    field: "Status",
                    title: "Status",
                    template: function(e) {
                        var a = {
                            1: {
                                title: "Pending",
                                class: "m-badge--brand"
                            },
                            2: {
                                title: "Delivered",
                                class: " m-badge--metal"
                            },
                            3: {
                                title: "Canceled",
                                class: " m-badge--primary"
                            },
                            4: {
                                title: "Success",
                                class: " m-badge--success"
                            },
                            5: {
                                title: "Info",
                                class: " m-badge--info"
                            },
                            6: {
                                title: "Danger",
                                class: " m-badge--danger"
                            },
                            7: {
                                title: "Warning",
                                class: " m-badge--warning"
                            }
                        };
                        return '<span class="m-badge ' + d.des_estado + ' m-badge--wide">' + d.des_estado + "</span>"
                    }
                }, {
                    field: "Type",
                    title: "Type",
                    template: function(d) {
                        var a = {
                            1: {
                                title: "Online",
                                state: "danger"
                            },
                            2: {
                                title: "Retail",
                                state: "primary"
                            },
                            3: {
                                title: "Direct",
                                state: "accent"
                            }
                        };
                        return '<span class="m-badge m-badge--' + d.Type + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + d.Type + '">' + d.Type + "</span>"
                    }
                }, {
                    field: "Actions",
                    width: 110,
                    title: "Actions",
                    sortable: !1,
                    overflow: "visible",
                    template: function(d) {
                        return '<div class="dropdown ' + (d.getDatatable().getPageSize() - d.getIndex() <= 4 ? "dropup" : "") + '"><a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i class="la la-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a><a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a><a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a></div></div><a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="View "><i class="la la-edit"></i></a>'
                    }
                }]
            })
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
                }
            },
            items: {
                "1": {name: "Editar", icon: "edit"},
                "2": {name: "Reiniciar clave", icon: "quit"},
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