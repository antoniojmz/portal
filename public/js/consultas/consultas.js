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

var ManejoRespuestaD = function(respuesta){
    if (respuesta.code = '200'){
            pintarDatos(RegistroDTE);
            cargartablaDetalles(respuesta.respuesta.v_dte_detalles);
            cargartablaReferencias(respuesta.respuesta.v_dte_referencias);
            cargartablaEstados(respuesta.respuesta.v_dte_estados);
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

var pintarDatos = function(data){
    if(data.TipoDTE!=null){$("#TipoDTE").text(data.TipoDTE);}
    if(data.FolioDTE!=null){$("#FolioDTE").text(data.FolioDTE);}
    if(data.FechaEmision!=null){$("#FechaEmision").text(data.FechaEmision);}
    if(data.FechaRecepcion!=null){$("#FechaRecepcion").text(data.FechaRecepcion);}
    if(data.RutProveedor!=null){$("#RutProveedor").text(data.RutProveedor);}
    if(data.NombreProveedor!=null){$("#NombreProveedor").text(data.NombreProveedor);}
    if(data.RutCliente!=null){$("#RutCliente").text(data.RutCliente);}
    if(data.NombreCliente!=null){$("#NombreCliente").text(data.NombreCliente);}
    if(data.MontoNetoCLP!=null){$("#MontoNetoCLP").text(data.MontoNetoCLP);}
    if(data.MontoExentoCLP!=null){$("#MontoExentoCLP").text(data.MontoExentoCLP);}
    if(data.MontoIVACLP!=null){$("#MontoIVACLP").text(data.MontoIVACLP);}
    if(data.MontoTotalCLP!=null){$("#MontoTotalCLP").text(data.MontoTotalCLP);}
    // if(data.MontoNetoOM!=null){$("#MontoNetoOM").text(data.MontoNetoOM);}
    // if(data.MontoExentoOM!=null){$("#MontoExentoOM").text(data.MontoExentoOM);}
    // if(data.MontoIVAOM!=null){$("#MontoIVAOM").text(data.MontoIVAOM);}
    // if(data.MontoTotalOM!=null){$("#MontoTotalOM").text(data.MontoTotalOM);}
    if(data.EstadoActualDTE!=null){$("#EstadoActualDTE").text(data.EstadoActualDTE);}
    if(data.FechaEstadoActualDTE!=null){$("#FechaEstadoActualDTE").text(data.FechaEstadoActualDTE);}

}

var cargartablaDetalles = function(data){
    if(limpiarDetalles==1){destruirTabla('#tablaDetalles');}
    if (data.length>0){
        $("#tablaDetalles").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            // 'bSort': false,
            // "scrollX": true,
            // "scrollY": '45vh',
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "Código Producto","data": "CodigoProducto"},
                {"title": "Nombre Producto","data": "NombreProducto"},
                {"title": "Valor Unitario","data": "ValorUnitario"},
                {"title": "Cantidad","data": "Cantidad"},
                {"title": "Total Linea","data": "TotalLinea"}
            ],
        });
        limpiarDetalles=1;
    }else{
        limpiarDetalles=0;
    }
}

var cargartablaReferencias = function(data){
    if (limpiarReferencias>0){destruirTabla('#tablaReferencias');}
    if (data.length>0){
        $("#tablaReferencias").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            // 'bSort': false,
            // "scrollX": true,
            // "scrollY": '45vh',
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdReferencia","data": "IdReferencia",visible:0},
                {"title": "Tipo de Referencia","data": "TipoReferencia"},
                {"title": "Folio de Referencia","data": "FolioReferencia"},
                {
                    "title": "Fecha de Referencia", 
                    "data": "FechaReferencia",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
            ],
        });
        limpiarReferencias=1;
    }else{
        limpiarReferencias=0;
    }
}

var cargartablaEstados = function(data){
    if (limpiarEstados>0){destruirTabla('#tablaEstados');}
    if (data.length>0){
        $("#tablaEstados").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            // 'bSort': false,
            // "scrollX": true,
            // "scrollY": '45vh',
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdEstadoDTE","data": "IdEstadoDTE",visible:0},
                {
                    "title": "Fecha de Estado", 
                    "data": "FechaEstado",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {"title": "Comentario de Estado","data": "ComentarioEstado"}
            ],
        });
        limpiarEstados=1;
    }else{
        limpiarEstados=0;
    }
}



var cargartablaTrazas = function(data){
    if (limpiarTrazas>0){destruirTabla('#tablaTrazas');}
    if (data.length>0){
        $("#tablaTrazas").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            // 'bSort': false,
            // "scrollX": true,
            // "scrollY": '45vh',
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdEstadoDTE","data": "IdEstadoDTE",visible:0},
                {
                    "title": "Fecha de Estado", 
                    "data": "FechaEstado",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {"title": "Comentario de Estado","data": "ComentarioEstado"}
            ],
        });
        limpiarTrazas=1;
    }else{
        limpiarTrazas=0;
    }
}

var cargartablaReportes = function(data){
    if (limpiar>0){destruirTabla('#tablaReportes');}
    if (data.length>0){
        var columnReport = [[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24]];       
        $("#tablaReportes").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            // 'bSort': false,
            "scrollX": true,
            "scrollY": '45vh',
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {"title": "IdCliente","data": "IdCliente",visible:0},
                {
                    "title": "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", 
                    "data": {"PdfDTE":"PdfDTE","XmlDTE":"XmlDTE"},
                    "orderable":false,
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<center><a target="_blank" class="m-menu__link" data-toggle="tooltip" title="XML" href="' + data.XmlDTE + '"><i class="fa fa-file-code-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a target="_blank" class="m-menu__link" data-toggle="tooltip" title="PDF" href="' + data.PdfDTE + '"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a id="LinkTrazas" class="m-menu__link" data-toggle="tooltip" title="Traza DTE" href="#"><i class="fa fa-history" aria-hidden="true"></i></a></center>';
                        }
                        return data;
                    }
                },
                {"title": "Tipo DTE","data": "TipoDTE"},
                {"title": "Folio DTE","data": "FolioDTE"},
                {
                    "title": "Fecha Emisión", 
                    "data": "FechaEmision",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {
                    "title": "Fecha Recepción", 
                    "data": "FechaRecepcion",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {"title": "RUT Proveedor","data": "RutProveedor"},
                {"title": "Nombre Proveedor","data": "NombreProveedor"},
                {"title": "RUT Cliente","data": "RutCliente"},
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Monto Neto DTE","data": "MontoNetoCLP"},
                {"title": "Monto Exento DTE","data": "MontoExentoCLP"},
                {"title": "Monto IVA DTE","data": "MontoIVACLP"},
                {"title": "Monto Total DTE","data": "MontoTotalCLP"},
                {
                    "title": "Fecha Autorizacion SII", 
                    "data": "FechaAutorizacionSII",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {
                    "title": "Fecha OC", 
                    "data": "FechaOC",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {
                    "title": "Fecha Pago", 
                    "data": "FechaPago",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {
                    "title": "Fecha Vencimiento", 
                    "data": "FechaVencimiento",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {"title": "Tipo Acuse","data": "DesTipoAcuse"},
                {"title": "Existencia SII","data": "DesExistenciaSII"},
                {"title": "Existencia Paperles","data": "DesExistenciaPaperles"},
                {
                    "title": "Fecha de Estado Actual", 
                    "data": "FechaEstadoActualDTE",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {"title": "Estado Actual de Pago","data": "EstadoActualDTE"}
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
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
                {
                    extend: 'excel',
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
                {
                    extend: 'pdf',
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
        SeleccionarTablaReportes();
        limpiar=1;
    }else{
        limpiar=0;
        toastr.warning("No se encontraron resultados", "Info!");
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

var ProcesarConsulta = function(){
    parametroAjax.ruta=ruta;
    parametroAjax.data = $("#FormConsultas").serialize();
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaC(respuesta);
};

var cargarFormularioVisualizacion = function(data){
    $(".divForm").toggle();
    parametroAjax.ruta=rutaD;
    parametroAjax.data = {"IdDTE":data.IdDTE};
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaD(respuesta);
};

var BotonVolver = function(){
    $(".divForm").toggle();
    $(".span").text("Desconocido");
}

var crearAllcombos = function(d){
    var acuse = [{"id":"1","text":"Recibido"},{"id":"2","text":"Por recibir"}];
    var estado = [{"id":"1","text":"Emitido por el proveedor"},{"id":"2","text":"Recepcionado por el cliente"},{"id":"2","text":"Contabilizado por el cliente"},{"id":"2","text":"Programado para pago"}];
    crearcombo('#Selectcampo',d.v_busq_consulta);
    crearcombo('#SelectDTE',d.v_tipo_dte);
    crearcombo('#TipoAcuse',acuse);
    crearcombo('#selectEstado',estado);
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
    cargartablaReportes(d.v_dtes)
    $(".span").text("Desconocido");
    $("#spanTitulo").text("Consultas DTE");
    crearAllcombos(d)
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
    $(document).on('click','#consultar',ProcesarConsulta);
    $(document).on('click','#volver',BotonVolver);
    $(document).on('click','#LinkTrazas',CargarTrazas);
    $(document).on('click','#ahrefFiltros',toggleFiltros);
    $(document).on('click','#btnCal1',cal1);
    $(document).on('click','#btnCal2',cal2);
    $(document).on('click','#btnCal3',cal3);
    $(document).on('click','#btnCal4',cal4);
    $(document).on('click','#btnCal5',cal5);
    $(document).on('click','#btnCal6',cal6);
});