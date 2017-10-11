var limpiar=0;
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};
var ManejoRespuestaC = function(respuesta){
    if (respuesta.code = '200'){
        $(".divForm").toggle();
        cargartablaReportes(respuesta.respuesta);
    }else{
        mensajesAlerta('Error','No se ejecuto la consultam contacte al personal informático', 'error');
    };
}
var cargartablaReportes = function(data){
    if (data.length>0){
        $("#tablaReportes").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
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
                {"title": "Última visita","data": "usrUltimaVisita"}
            ],
        });
        limpiar=1;
    }else{
        limpiar=0;
        mensajesAlerta('Info','No se encontraron resultados', 'info');
    }
};

var Boton_cancelar = function(){
    $(".divForm").toggle();
    if(limpiar==1){destruirTablaS('tablaReportes');$('#tablaReportes thead').empty();}
}

var ProcesarConsulta = function(){
    var desde = $('#f_desde').val();
    var Selectcampo = $('#Selectcampo').val();
    if (desde.length<1 && Selectcampo.length<1){
        mensajesAlerta('Error','Desde seleccionar al menos un campo', 'error');
        return;
    }
    parametroAjax.ruta=ruta;
    parametroAjax.data = $("#FormConsultas").serialize();
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaC(respuesta);
};

var validarC=function(){$('#FormConsultas').formValidation('validate');};
var cal1 = function (){$("#fecha").click();};
$(document).ready(function(){
    // console.log("Hola desde las consultas");   
    // var v_reporte = '[{"id": 1,"name": "Aceptadas"},{"id": 2,"name": "Rechazadas"},{"id": 3, "name": "Anuladas"}]';
    crearcombo('#Selectcampo');
    // console.log(v_reporte);
    // var res = JSON.parse(v_reporte);
    // crearallcombos(v_reporte);
    // console.log(res);
    // crearcombo('#Selectconsulta',res);
    // $('#Selectconsulta').append( '<option value="1">Aceptadas</option>' );
    // $('#Selectconsulta').append( '<option value="2">Rechazadas</option>' );
    // $('#Selectconsulta').append( '<option value="3">Anuladas</option>' );

    $('#fecha').daterangepicker({}, function(start, end, label) {
        $('#fecha').text(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY")+" al "+moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_desde').val(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_hasta').val(moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
    });
    // $(document).on('click','#consultar',validarC);
    $(document).on('click','#consultar',ProcesarConsulta);
    $(document).on('click','#volver',Boton_cancelar);
    // $(document).on('click','#agregar',Boton_agregar);
    // $(document).on('click','#nacionalidad',cambioNacionalidad);
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
    //         'f_desde': {
    //             verbose: false,
    //             validators: {
    //                 notEmpty: {
    //                     message: 'El campo es requerido.'
    //                 },
    //             }
    //         },
    //         'Selectcampo': {
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