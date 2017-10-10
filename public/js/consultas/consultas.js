// var RegistroExperto = '';
var limpiar=0;
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};
var ManejoRespuestaC = function(respuesta,id_reporte){
    if (respuesta.code = '200'){
        cargarTabla();
        cargartablaReportes(respuesta.respuesta,id_reporte);
    }else{
        mensajesAlerta('Error','No se ejecuto la consultam contacte al personal informático', 'error');
    };
}
var cargartablaReportes = function(data,id_reporte){
    // console.log(data);
    switch (id_reporte){
        case '1':
            $("#titulo").text("Videoconferencias próximas");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "id_agenda","data": "id_agenda", "width": "90%",visible:0},
                    {"title": "fecha","data": "fecha_agenda", "width": "90%",visible:0},
                    {"title": "Asunto","data": "caso"},
                    {"title": "Número de expediente","data": "nroexp"},
                    {"title": "Tipo de videoconferencia","data":"des_tipo_videoconferencia"},
                    {"title": "Fecha de audiencia","data": "fecha_agenda_ver"},
                    {"title": "Hora Audiencia","data": "des_turno"},
                    {"title": "Número experticia","data": "experticia"},
                    {"title": "Tipo experticia","data": "tipo_experticia"},
                    {"title": "Observaciones","data": "obs_agenda"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '2':
            $("#titulo").text("Videoconferencias realizadas");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "id_agenda","data": "id_agenda", "width": "90%",visible:0},
                    {"title": "fecha","data": "fecha_agenda", "width": "90%",visible:0},
                    {"title": "Asunto","data": "caso"},
                    {"title": "Número de expediente","data": "nroexp"},
                    {"title": "Tipo de videoconferencia","data": "des_tipo_videoconferencia"},
                    {"title": "Fecha de audiencia","data": "fecha_agenda_ver"},
                    {"title": "Hora Audiencia","data": "des_turno"},
                    {"title": "Nombre del interprete","data": "interpretes"},
                    {"title": "Número experticia","data": "experticia"},
                    {"title": "Tipo experticia","data": "tipo_experticia"},
                    {"title": "Resultado","data": "resultado", "width": "10%"},
                    {"title": "Motivo del diferimiento","data": "des_motivo_dif"},
                    {"title": "Observaciones","data": "obs_resultado"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '3':
            $("#titulo").text("Videoconferencias próximas generales");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "id_agenda","data": "id_agenda",visible:0},
                    {"title": "Tribunal","data": "des_tribunal"},
                    {"title": "Asunto","data": "caso"},
                    {"title": "Número de expediente","data": "nroexp"},
                    {"title": "Tipo de videoconferencia","data": "des_tipo_videoconferencia"},
                    {"title": "Fecha de audiencia","data": "fecha_agenda_ver"},
                    {"title": "Hora Audiencia","data": "des_turno"},
                    {"title": "Número experticia","data": "experticia"},
                    {"title": "Tipo experticia","data": "tipo_experticia"},
                    {"title": "Observaciones","data": "obs_agenda"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '4':
            $("#titulo").text("Videoconferencias realizadas generales");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "id_agenda","data": "id_agenda", visible:0},
                    {"title": "fecha_agenda","data": "fecha_agenda", visible:0},
                    {"title": "Tribunal","data": "des_tribunal", "width": "20%"},
                    {"title": "Asunto","data": "caso", "width": "10%"},
                    {"title": "Número de expediente","data": "nroexp", "width": "10%"},
                    {"title": "Tipo de videoconferencia","data": "des_tipo_videoconferencia", "width": "10%"},
                    {"title": "Fecha de audiencia","data": "fecha_agenda_ver", "width": "10%"},
                    {"title": "Hora Audiencia","data": "des_turno", "width": "10%"},
                    {"title": "Nombre del interprete","data": "interpretes", "width": "20%"},
                    {"title": "Número experticia","data": "experticia", "width": "10%"},
                    {"title": "Tipo experticia","data": "tipo_experticia", "width": "20%"},
                    {"title": "Resultado","data": "resultado", "width": "10%"},
                    {"title": "Motivo del diferimiento","data": "des_motivo_dif", "width": "20%"},
                    {"title": "Observaciones","data": "obs_resultado", "width": "10%"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '5':
            $("#titulo").text("Videoconferencias pendientes generales");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "id_agenda","data": "id_agenda", visible:0},
                    {"title": "fecha_agenda","data": "fecha_agenda", visible:0},
                    {"title": "Tribunal","data": "des_tribunal"},
                    {"title": "Responsable","data": "nombre"},
                    {"title": "Asunto","data": "caso"},
                    {"title": "Tipo de videoconferencia","data": "des_tipo_videoconferencia"},
                    {"title": "Fecha de audiencia","data": "fecha_agenda_ver"},
                    {"title": "Hora Audiencia","data": "des_turno"},
                    {"title": "Número experticia","data": "experticia"},
                    {"title": "Tipo experticia","data": "tipo_experticia"},
                    {"title": "Observaciones","data": "obs_agenda"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '6':
            $("#titulo").text("Videoconferencias por rango de fecha");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "Total","data": "total"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '7':
            $("#titulo").text("Videoconferencias negativas por tribunal");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "Tribunal","data": "des_tribunal"},
                    {"title": "Total","data": "total"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '8':
            $("#titulo").text("Videoconferencias positivas por tribunal");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "Tribunal","data": "des_tribunal"},
                    {"title": "Total","data": "total"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '9':
            $("#titulo").text("Videoconferencias pendientes por tribunal");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "Tribunal","data": "des_tribunal"},
                    {"title": "Total","data": "total"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '10':
            $("#titulo").text("Videoconferencias diferidas general");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "Motivo de diferimiento","data": "des_motivo_dif"},
                    {"title": "Total","data": "total"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '11':
            $("#titulo").text("Videoconferencias diferidas por tribunal");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "Tribunal","data": "des_tribunal"},
                    {"title": "Motivo de diferimiento","data": "des_motivo_dif"},
                    {"title": "Total","data": "total"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        case '12':
            $("#titulo").text("Total por estatus");
            if (data.length>0){
                $("#tablaReportes").dataTable({
                    'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
                    "language": {
                            "url": "/DataTables-1.10.10/de_DE-all.txt"
                    },
                    "data": data,
                    "columns":[
                    {"title": "Estatus","data": "des_estatus"},
                    {"title": "Total","data": "total"},
                    ],
                });
                limpiar=1;
            }else{
                limpiar=0;
                mensajesAlerta('Info','No se encontraron resultados', 'info');
            }
        break;
        default:
            limpiar=0;
        break;
    }
};

var cargarTabla= function(){
    $('#divTabla').show();
    $('#divForm').hide();
}
var cargarFormulario= function(){
    $('#divTabla').hide();
    $('#divForm').show();
}
var Boton_cancelar = function(){
    $('#divForm').show();
    $('#divTabla').hide();
    if(limpiar==1){destruirTablaS('tablaReportes');$('#tablaReportes thead').empty();}
}
var Boton_agregar = function(){
    cargarFormulario();
    $('#FormConsultas')[0].reset();
    $(".comboclear").val('').trigger("change");
}
var cambioNacionalidad = function(){
    if ($('#nacionalidad').text()=='V'){$('#nacionalidad').text('E');}else{$('#nacionalidad').text('V');}
};
var ProcesarConsulta = function(){
    var id_reporte=$('#Selectconsulta').val();
    parametroAjax.ruta=ruta;
    parametroAjax.data = $("#FormConsultas").serialize();
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaC(respuesta,id_reporte);
};


var crearallcombos = function(data){
    crearcombo('#Selectconsulta',data.v_perfiles);
}

var validarC=function(){$('#FormConsultas').formValidation('validate');};
var cal1 = function (){$("#fecha").click();};
$(document).ready(function(){
    var v_reporte = ' [{"id": 1,"name": "Aceptadas"},{"id": 2,"name": "Rechazadas"},{"id": 3, "name": "Anuladas"}]';
    // console.log(v_reporte);
    var res = JSON.parse(v_reporte);
    // crearallcombos(v_reporte);
    // console.log(res);
    // crearcombo('#Selectconsulta',res);
    $('#Selectconsulta').append( '<option value="1">Aceptadas</option>' );
    $('#Selectconsulta').append( '<option value="2">Rechazadas</option>' );
    $('#Selectconsulta').append( '<option value="3">Anuladas</option>' );

    $('#fecha').daterangepicker({}, function(start, end, label) {
        $('#fecha').text(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY")+" al "+moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_desde').val(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_hasta').val(moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
    });
    $(document).on('click','#consultar',validarC);
    $(document).on('click','#volver',Boton_cancelar);
    $(document).on('click','#agregar',Boton_agregar);
    $(document).on('click','#nacionalidad',cambioNacionalidad);
    $(document).on('click','#btnCal',cal1);
    // $('#FormConsultas').formValidation({
    //     // message: 'El módulo le falta un campo para ser completado',
    //     fields: {
    //         'f_hasta': {
    //             verbose: false,
    //             validators: {
    //                 notEmpty: {
    //                     message: 'El campo es requerido.'
    //                 },
    //             }
    //         },
    //         'Selectconsulta': {
    //             validators: {
    //                 notEmpty: {
    //                     message: 'El campo es requerido.'
    //                 },
    //             }
    //         },
    //     }
    // })
    // .on('success.form.fv', function(e){
    //     ProcesarConsulta();
    // })
    // .on('status.field.fv', function(e, data){
    //     data.element.parents('.form-group').removeClass('has-success');
    // });
});