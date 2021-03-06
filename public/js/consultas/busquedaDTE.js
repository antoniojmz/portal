var limpiar=limpiarEstados=limpiarDetalles=limpiarTrazas=limpiarReferencias=printCounter=ajax=0;
var RegistroDTE = RegistroDTE2='';
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var ManejoRespuestaC = function(respuesta){
    if (respuesta.code = '200'){
        var res = JSON.parse(respuesta.respuesta.status);
            if (res.code=="-1"){
                toastr.warning(res.des_code, "Aviso!");
            }
            if (res.code=="204"){
                cargartablaReportes(respuesta.respuesta.data);
            }
    }else{
        toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
    };
}

var ManejoRespuestaT = function(respuesta){
    if (respuesta.code = '200'){
        cargartablaTrazas(respuesta.respuesta.v_dte_estados);
    }else{
        toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
    };
}

var cargartablaReportes = function(data){
    if (limpiar>0){
        destruirTabla('#tablaReportes');
    }

    var columnReport = [[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24]];       
    $("#tablaReportes").dataTable({
        "language": LenguajeTabla,
        "searching": true, 
        "paging": true, 
        "info": true,
        "order": [[ 2, "desc" ]], 
        "data": data,
        "pagingType": "full_numbers",
        "pageLength": 25, 
        "columns":
        [
            {"title": "IdDTE","data": "IdDTE",visible:0},
            {"title": "IdProveedor","data": "IdProveedor",visible:0},
            {"title": "IdCliente","data": "IdCliente",visible:0},
            {"title": "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", 
                    "data": {"PdfDTE":"PdfDTE","XmlDTE":"XmlDTE"},
                    "orderable":false,
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<center><a target="_blank" class="m-menu__link" data-toggle="tooltip" title="XML" href="' + data.XmlDTE + '"><i class="fa fa-file-code-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a target="_blank" class="m-menu__link" data-toggle="tooltip" title="PDF" href="' + data.PdfDTE + '"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a id="LinkTrazas" class="m-menu__link" data-toggle="tooltip" title="Traza DTE" href="#"><i class="fa fa-history" aria-hidden="true"></i></a></center>';
                        }
                        return data;
                    }
            },
            {"title": "Tipo DTE", "data": "TipoDTE", className: "text-center"},
            {"title": "Folio DTE","data": "FolioDTE", className: "text-center", render: $.fn.dataTable.render.number( '.', ',', 0)},
            {"title": "Fecha Emisión", "data": "FechaEmision", className: "text-center", width: 100, 
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                    }
                    return data;
                }
            },
            {"title": "Fecha Recepción", "data": "FechaRecepcion", className: "text-center", width: 100, 
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                    }
                    return data;
                }
            },
            {"title": "RUT Proveedor", "data": "RutProveedor", className: "text-center",
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = formateaRut(data, true)
                    }
                    return data;
                }
            },
            {"title": "Nombre Proveedor","data": "NombreProveedor"},
            {"title": "RUT Receptor", "data": "RutCliente", className: "text-center", 
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = formateaRut(data, true)
                    }
                    return data;
                }
            },
            {"title": "Receptor DTE","data": "NombreCliente"},
            {"title": "Monto Neto DTE","data": "MontoNetoCLP",  visible:false},
            {"title": "Monto Exento DTE","data": "MontoExentoCLP",  visible:false},
            {"title": "Monto IVA DTE","data": "MontoIVACLP",  visible:false},
            {"title": "Fecha Autorizacion SII",  visible:false, "data": "FechaAutorizacionSII",
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                    }
                    return data;
                }
            },
            {"title": "Fecha OC",  visible:false, "data": "FechaOC", className: "text-center",
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                    }
                    return data;
                }
            },
            {"title": "Monto Total DTE","data": "MontoTotalCLP", className: "text-right", width: 80, 
                render: $.fn.dataTable.render.number( '.', ',', 0)
            },
            {"title": "Fecha Pago", "data": "FechaPago", className: "text-center", width: 80, 
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        if(data != null){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }else{
                            data = "-"; 
                        }
                    }
                    return data;
                }
            },
            {"title": "Fecha Vencimiento", "data": "FechaVencimiento", className: "text-center", width: 80, 
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        if(data != null){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }else{
                            data = "-"; 
                        }
                    }
                    return data;
                }
            },
            {"title": "Tipo Acuse","data": "DesTipoAcuse",  visible:false},
            {"title": "Existencia SII","data": "DesExistenciaSII",  visible:false},
            {"title": "Existencia Paperles","data": "DesExistenciaPaperles",  visible:false},
            {"title": "Fecha de Estado Actual",  "data": "FechaEstadoActualDTE", visible:false, 
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                    }
                    return data;
                }
            },
            {"title": "Estado Actual de Pago","data": "EstadoActualDTE", width: 100, className: "text-center"}
        ],
    dom: 'lBfrtip', 
    buttons: 
                [
                {   extend: 'print',
                    text: 'Imprimir',
                    className: 'btn m-btn--pill btn-accent btn-sm m-btn m-btn--custom',
                    orientation:'landscape',
                    pageSize:'TABLOID',
                    title:'Listado de DTEs',
                    exportOptions: {
                        columns: columnReport,
                        modifier: {
                            page: 'all'
                        }
                    },
                    customize: function (win) {
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size','11px');
                    }
                },
                {   extend: 'excel',
                    text: 'Exportar',
                    className: 'btn m-btn--pill btn-accent btn-sm m-btn m-btn--custom',
                    title:'Listado DTEs',
                    exportOptions: {
                        columns: columnReport,
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {   extend: 'pdf',
                    text: 'PDF',
                    className: 'btn m-btn--pill btn-accent btn-sm m-btn m-btn--custom',
                    orientation:'landscape',
                    pageSize:'TABLOID',
                    title:'Listado de DTEs',
                    exportOptions: {
                        columns: columnReport,
                        modifier: {
                            page: 'all',
                        }
                    },
                    customize : function(doc){
                        doc.defaultStyle.fontSize = 8; 
                        var colCount = new Array();
                        $($("#tablaReportes").dataTable()).find('tbody tr:first-child td').each(function(){
                            if($(this).attr('colspan')){
                                for(var i=1;i<=$(this).attr('colspan');$i++){
                                    colCount.push('*');
                                }
                            }else{ colCount.push('*'); }
                        });
                        doc.content[1].table.widths = colCount;
                    }
                }
                ]
    });
    
    limpiar=1;

    if (data != null && data.length > 0){
        SeleccionarTablaReportes();
    }
};

var SeleccionarTablaReportes = function(){
    var tableB = $('#tablaReportes').dataTable();

    $('#tablaReportes tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    });

    $('#tablaReportes tbody').on('dblclick', 'tr', function () {
        RegistroDTE = TablaTraerCampo('tablaReportes',this);
        cargarFormularioVisualizacion(RegistroDTE);
        $("#ahref1").click();
        $('html,body').animate({ scrollTop: $("#divSeparacion").offset().top });
    });

    var table = $('#tablaReportes').DataTable();
    $('#tablaReportes tbody').on('click', 'tr', function () {
        RegistroDTE2 = table.row(this).data();
    });
}

var ProcesarCargaDTE = function() {
    ///ProcesarConsulta();
}

var ProcesarConsulta = function(){

    $("body").addClass("loading");

    setTimeout(function(){
        try{ 
            parametroAjax.ruta=ruta;
            parametroAjax.data = $("#FormConsultas").serialize();
            respuesta=procesarajax(parametroAjax);
            ManejoRespuestaC(respuesta);

        }catch(err) {
            toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
            console.log("No se ejecuto la consulta, contacte al personal informático: " + err.message);
        }

        $("body").removeClass("loading"); 

    }, 8);

};

var BotonVolver = function(){
    $(".divForm").toggle();
    $(".span").text("Desconocido");
}

var crearAllcombos = function(d){
    var acuse = [{"id":"1","text":"Recibido"},{"id":"2","text":"Por recibir"}];
    var estado = [{"id":"1","text":"Emitido por el proveedor"},{"id":"2","text":"Recepcionado por el cliente"},{"id":"6","text":"Contabilizado por el cliente"},{"id":"9","text":"Programado para pago"}];

    crearcombo('#Selectcampo',d.v_busq_consulta);
    crearcombo('#SelectDTE',d.v_tipo_dte);
    crearcombo('#TipoAcuse',acuse);
    crearcombo('#selectEstado', estado);
}

var CargarTrazas = function(){
    parametroAjax.ruta=rutaT;
    parametroAjax.data = RegistroDTE2;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaT(respuesta);
    $('#ModalTrazas').modal("show");
}

var toggleFiltros = function(){
    $("#divForm").slideToggle("fast");
}

var cal1 = function (){$("#fecha").click();};
var cal2 = function (){$("#fechaA").click();};
var cal3 = function (){$("#fechaO").click();};
var cal4 = function (){$("#fechaP").click();};
var cal5 = function (){$("#fechaV").click();};
var cal6 = function (){$("#fechaR").click();};

$(document).ready(function(){
    ClassActive("LiDtes");
    
    cargartablaReportes(d.v_dtes);
    crearAllcombos(d);


    $(".span").text("Desconocido");
    $("#spanTitulo").text("Busqueda de DTEs");

    $('#RutCliente').rut();
    $('#RutProveedor').rut();
    $('#fecha').daterangepicker({}, function(start, end, label) {
        $('#fecha').text(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY")+" al "+moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_desde').val(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_hasta').val(moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
    });
    $('#fechaA').daterangepicker({}, function(start, end, label) {
        $('#fechaA').text(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY")+" al "+moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_desdeA').val(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_hastaA').val(moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
    });
    $('#fechaO').daterangepicker({}, function(start, end, label) {
        $('#fechaO').text(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY")+" al "+moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_desdeO').val(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_hastaO').val(moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
    });
    $('#fechaP').daterangepicker({}, function(start, end, label) {
        $('#fechaP').text(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY")+" al "+moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_desdeP').val(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_hastaP').val(moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
    });
    $('#fechaV').daterangepicker({}, function(start, end, label) {
        $('#fechaV').text(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY")+" al "+moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_desdeV').val(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_hastaV').val(moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
    });
    $('#fechaR').daterangepicker({}, function(start, end, label) {
        $('#fechaR').text(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY")+" al "+moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_desdeR').val(moment(start._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
        $('#f_hastaR').val(moment(end._d, 'MM-DD-YYYY HH:mm:ss',true).format("DD-MM-YYYY"));
    });

    $(document).on('click','#consultar', ProcesarConsulta);
    $(document).on('click','#volver',BotonVolver);
    $(document).on('click','#LinkTrazas',CargarTrazas);
    $(document).on('click','#ahrefFiltros',toggleFiltros);
    $(document).on('click', '#btnSimularPP', CalcularSimulacionPP);
    $(document).on('click', '#btnSolicitarPP', SolicitarPP);
    $(document).on('click', '#btnConfirmarPP', ConfirmarPP);

    $(document).on('click','#btnCal1',cal1);
    $(document).on('click','#btnCal2',cal2);
    $(document).on('click','#btnCal3',cal3);
    $(document).on('click','#btnCal4',cal4);
    $(document).on('click','#btnCal5',cal5);
    $(document).on('click','#btnCal6',cal6);

    if(d.method == 2) $("#ahrefFiltros").click();

    $("#FechaPagoSolicitadaPP").change(function() {
        var fecha1 = moment(this.value, 'YYYY-MM-DD', true);
        var fecha2 = moment($("#FechaVencimientoPP").text(), 'DD-MM-YYYY', true);
        $("#formViewDTE #DiasAnticipoSolicitadaPP").text( fecha2.diff(fecha1, 'days')  );
        $("#divBtnSimularPP").show();
        $("#divTituloSimularPP").hide();
        $("#divSimulacion1").hide();
        $("#divSimulacion2").hide();
        $("#divBtnSolicitarPP").hide();
    });

});