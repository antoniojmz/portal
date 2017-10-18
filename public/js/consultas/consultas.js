var limpiar=printCounter=0;
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};
var ManejoRespuestaC = function(respuesta){
    if (respuesta.code = '200'){
        cargartablaReportes(respuesta.respuesta);
    }else{
        mensajesAlerta('Error','No se ejecuto la consultam contacte al personal informático', 'error');
    };
}
var cargartablaReportes = function(data){
    if (data.length>0){
        if (limpiar>0){destruirTablaS('tablaReportes');}
        $("#tablaReportes").append("<caption style='caption-side: bottom'>Resultados de la busqueda de DTE</caption>");
        $("#tablaReportes").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            "language": {
                "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {"title": "IdCliente","data": "IdCliente",visible:0},
                {"title": "Fecha de recepción","data": "FechaRecepcion"},
                {"title": "Tipo DTE","data": "TipoDTE"},
                {"title": "Folio DTE","data": "FolioDTE"},
                {"title": "Fecha de emisión","data": "FechaEmision"},
                {"title": "Rut Cliente","data": "RutCliente"},
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Rut Proveedor","data": "RutProveedor"},
                {"title": "Nombre Proveedor","data": "NombreProveedor"},
                {"title": "Monto Total DTE","data": "MontoExentoDTE"},
                {"title": "Monto total OM","data": "MontoExentoOM"}
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn m-btn--pill',
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
                    title:'Busqueda_DTEs',
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
                    title:'Busqueda_DTEs',
                    exportOptions: {
                        modifier: {
                            page: 'current',
                        }
                    }
                }
            ]
        });
        limpiar=1;
    }else{
        limpiar=0;
        mensajesAlerta('Info','No se encontraron resultados', 'info');
    }
};

var ProcesarConsulta = function(){
    var desde = $('#f_desde').val();
    var Selectcampo = $('#Selectcampo').val();
    var SelectDTE = $('#SelectDTE').val();
    if (desde.length<1 && Selectcampo.length<1 && SelectDTE.length<1){
        mensajesAlerta('Error','Desde seleccionar al menos un campo', 'error');
        return;
    }
    parametroAjax.ruta=ruta;
    parametroAjax.data = $("#FormConsultas").serialize();
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaC(respuesta);
};

var BotonVolver = function(){
    $(".divForm").toggle();
}

var cal1 = function (){$("#fecha").click();};
$(document).ready(function(){
    cargartablaReportes(d.v_dtes)
    $("#spanTitulo").text("Consultas DTE");
    crearcombo('#Selectcampo');
    crearcombo('#SelectDTE');
    $('#fecha').daterangepicker({}, function(start, end, label) {
        $('#fecha').text(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY")+" al "+moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_desde').val(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_hasta').val(moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
    });
    var tableB = $('#tablaReportes').dataTable();
    $('#tablaReportes tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    });
    $('#tablaReportes tbody').on('dblclick', 'tr', function () {
        RegistroUsuario = TablaTraerCampo('tablaReportes',this);
        $(".divForm").toggle();
    });
    tableB.on('dblclick', 'tr', function () {
        $('#close').trigger('click');
    });
    $(document).on('click','#consultar',ProcesarConsulta);
    $(document).on('click','#btnCal',cal1);
    $(document).on('click','#volver',BotonVolver);
});