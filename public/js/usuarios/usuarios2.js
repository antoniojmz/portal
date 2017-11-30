var RegistroUsuario =  '';
var tabla =[];
var limpiarDte = 0;
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
            // $("#tablaUsuarios").empty();
            // $(tabla).mDatatable().fnClearTable();
            // $(tabla).mDatatable().fnDraw();
            tabla.destroy();
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

var cargarTablaUsuarios = function(v){
    tabla = $("#tablaUsuarios").mDatatable({
        data: {type: "local",source: v,pageSize: 5},
        layout: {
            theme: "default",
            class: "",
            scroll: !0,
            height: 450,
            footer: !1
        },
        "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            
        sortable: !0,
        filterable: !0,
        pagination: !0,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn m-btn--pill',
                    title:'Listado de Proveedores',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'excel',
                    text: 'Exportar',
                    className: 'btn m-btn--pill',
                    title:'Listado de Proveedores',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    className: 'btn m-btn--pill',
                    orientation:'landscape',
                    pageSize:'LETTER',
                    title:'Listado de Proveedores',
                    exportOptions: {
                        modifier: {
                            page: 'current',
                        }
                    }
                }
            ],
        columns: [{
            field: "idUser",
            title: "idUser",
            width: 50,
            sortable: !1,
            selector: !1,
            textAlign: "center"
        }, {
            field: "idUser",
            title: "idUser",
            responsive: {
                visible: "0"
            }
        }, {
            field: "usrNombreFull",
            title: "Nombres",
            responsive: {
                visible: "lg"
            }
        }, {
            field: "usrUserName",
            title: "Login",
            width: 100
        }, {
            field: "idPerfil",
            title: "idPerfil",
            responsive: {
                visible: "0"
            }
        }, {
            field: "des_perfil",
            title: "Perfíl"
        },{
            field: "creador",
            title: "Creador por"
        },{
            field: "modificador",
            title: "Modificado por"
        },{
            field: "usrUltimaVisita",
            title: "Última visita"
        },{
            field: "Actions",
            width: 110,
            title: "Actions",
            sortable: !1,
            overflow: "visible",
            template: function(v) {
                return '<a href="#" onclick="pintarDatosActualizar('+JSON.stringify(v).replace(/\"/g,"&quot;")+')\" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Editar"><i class="la la-pencil-square-o"></i></a><a href="#" onclick="reiniciarClave('+JSON.stringify(v).replace(/\"/g,"&quot;")+')\" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Reiniciar Clave"><i class="la la-unlock-alt"></i></a>';
            }
        }],
        translate: {
            records: {
                processing: "Cargando...",
                noRecords: "No se encontrarón archivos"
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: "Primero",
                            prev: "Anterior",
                            next: "Siguiente",
                            last: "Último",
                            more: "Más páginas",
                            input: "Número de página",
                            select: "Seleccionar tamaño de página"
                        },
                        info: "Viendo {{start}} - {{end}} de {{total}} registros"
                    }
                }
            }
        }
    })
};

var editar22 = function(data){
    console.log("hola");
    console.log(data);
}

var crearallcombos = function(data){
    crearcombo('#idPerfil',data.v_perfiles);
    crearcombo('#usrEstado',data.v_estados);
}

var cargarFormulario= function(){
    $(".divForm").toggle();
}

var pintarDatosActualizar= function(data){
    cargarFormulario();
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

var reiniciarClave = function(data){
    parametroAjax.ruta=rutaR;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarR(respuesta);
}

var validador = function(){
 $('#FormUsuario').formValidation('validate');
};

$(document).ready(function(){
    console.log(tabla);
    $("#usrUserName").inputmask({
        mask: "99999999-*", placeholder:"________-_"
    });

    cargarTablaUsuarios(d.v_usuarios);
    console.log(tabla);
    crearallcombos(d);

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