var simularPP = 0;


var cargarFormularioVisualizacion = function(data){
    if(data.length == 0) return;

    $(".divForm").toggle();

    $("body").addClass("loading");

    setTimeout(function(){
        try{
            parametroAjax.ruta=rutaD;
            parametroAjax.data = {"IdDTE": data};
            respuesta=procesarajax(parametroAjax);
            ManejoRespuestaD(respuesta);

        }catch(err) {
            toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
            console.log("No se ejecuto la consulta, contacte al personal informático: " + err.message);
        }

        $("body").removeClass("loading"); 

    }, 1);
};

var ManejoRespuestaD = function(respuesta){
    if (respuesta.code = '200'){
            console.log(respuesta.respuesta.v_dte);

            pintarDatos(respuesta.respuesta.v_dte);
            cargartablaDetalles(respuesta.respuesta.v_dte_detalles);
            cargartablaReferencias(respuesta.respuesta.v_dte_referencias);
            cargartablaEstados(respuesta.respuesta.v_dte_estados);
    }else{
        toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
    };
}

var pintarDatos = function(data){
    if(data.FolioDTE!=null){
        $("#formViewDTE #FolioDTE").text(new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(data.FolioDTE));
        //$("#FolioDTE").text(data.FolioDTE);
    }
    if(data.FechaEmision!=null){
        $("#formViewDTE #FechaEmision").text( moment(data.FechaEmision, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY") );
        //$("#FechaEmision").text(data.FechaEmision);
    }
    if(data.FechaRecepcion!=null){
        $("#formViewDTE #FechaRecepcion").text(moment(data.FechaRecepcion, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY"));
        //$("#FechaRecepcion").text(data.FechaRecepcion);
    }
    if(data.RutProveedor!=null){
        $("#formViewDTE #RutProveedor").text(data.RutProveedor);
    }
    if(data.NombreProveedor!=null){
        $("#formViewDTE #NombreProveedor").text(data.NombreProveedor);
    }
    if(data.RutCliente!=null){
        $("#formViewDTE #RutCliente").text(data.RutCliente);
    }
    if(data.NombreCliente!=null){
        $("#formViewDTE #NombreCliente").text(data.NombreCliente);
    }
    if(data.EstadoActualDTE!=null){
        $("#formViewDTE #EstadoActualDTE").text(data.EstadoActualDTE);
    }
    if(data.FechaEstadoActualDTE!=null){
        if(data.FechaEstadoActualDTE != "Sin Información"){
            $("#formViewDTE #FechaEstadoActualDTE").text(moment(data.FechaEstadoActualDTE, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY"));
            //$("#FechaEstadoActualDTE").text(data.FechaEstadoActualDTE);
        }else{
            $("#formViewDTE #FechaEstadoActualDTE").text(data.FechaEstadoActualDTE);
        }
    }

    if(data.MontoNetoCLP!=null){
        $("#formViewDTE #MontoNetoCLP").text( "$ " + new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(data.MontoNetoCLP));
        //$("#MontoNetoCLP").text(data.MontoNetoCLP);
    }
    if(data.MontoExentoCLP!=null){
        $("#formViewDTE #MontoExentoCLP").text( "$ " + new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(data.MontoExentoCLP));
        //$("#MontoExentoCLP").text(data.MontoExentoCLP);
    }
    if(data.MontoIVACLP!=null){
        $("#formViewDTE #MontoIVACLP").text( "$ " + new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(data.MontoIVACLP));
        //$("#MontoIVACLP").text(data.MontoIVACLP);
    }
    if(data.MontoTotalCLP!=null){
        $("#formViewDTE #MontoTotalCLP").text( "$ " + new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(data.MontoTotalCLP));
        //$("#MontoTotalCLP").text(data.MontoTotalCLP);
    }
    if(data.KeyDTE != null){
        $("#formViewDTE #KeyDTE").val(data.KeyDTE);
    }

    if(data.TipoDTE != null){
        if(data.TipoDTE == 33 && data.IdEstadoDTE > 2 && data.IdEstadoDTE < 10){
        //if(data.TipoDTE == 33){
            $("#pronto_pago_").show();
            showInfoPP(data);

        }else{
            $("#pronto_pago_").hide();
        }
        $("#formViewDTE #TipoDTE").text(data.TipoDTE);
    }else{
        $("#pronto_pago").hide();
        $("#pronto_pago_").hide();
    }
}

var cargartablaDetalles = function(data){
    if(limpiarDetalles==1){
        destruirTabla('#tablaDetalles');
    }

    $("#tablaDetalles").dataTable({
        'aLengthMenu': DataTableLengthMenu,
        "scrollCollapse": true,
        "pagingType": "full_numbers",
        "language": LenguajeTabla,
        "pageLength": 25,  
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
}

var cargartablaReferencias = function(data){
    if (limpiarReferencias>0){destruirTabla('#tablaReferencias');}
        $("#tablaReferencias").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "pageLength": 25,  
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
}

var cargartablaEstados = function(data){
    if (limpiarEstados>0){
        destruirTabla('#tablaEstados');
    }
    
    $("#tablaEstados").dataTable({
        'aLengthMenu': DataTableLengthMenu,
        "scrollCollapse": true,
        "pagingType": "full_numbers",
        "language": LenguajeTabla,
        "pageLength": 25,  
        "data": data,
        "columns":[
            {"title": "IdDTE","data": "IdDTE",visible:0},
            {"title": "IdEstadoDTE","data": "IdEstadoDTE",visible:0},
            {"title": "Fecha de Estado", "data": "FechaEstado",
                render: function(data, type, row, meta){
                    if(type === 'display'){
                        data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                    }
                    return data;
                }
            },
            {"title": "Estado","data": "NombreEstado"}, 
            {"title": "Comentario de Estado","data": "ComentarioEstado"}
        ],
    });

    limpiarEstados=1;
}

var cargartablaTrazas = function(data){
    if (limpiarTrazas>0){destruirTabla('#tablaTrazas');}
        $("#tablaTrazas").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "pageLength": 25,  
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdEstadoDTE","data": "IdEstadoDTE",visible:0},
                {"title": "Fecha de Estado", "data": "FechaEstado",
                    render: function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {"title": "Estado","data": "NombreEstado"}, 
                {"title": "Comentario de Estado","data": "ComentarioEstado"}
            ],
        });
        limpiarTrazas=1;
}

var showInfoPP = function (data) {
    if(simularPP == 1){
        
    } else {
        simularPP = 1;
    }

    $("#formViewDTE #FolioDTEPP").text(data.DescripcionTipoDTE + " - " + data.FolioDTE);
    $("#formViewDTE #NombreProveedorPP").text(data.NombreProveedor + " - " + data.RutProveedor);
    $("#formViewDTE #MontoTotalCLPPP").text( "$ " + new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(data.MontoTotalCLP) );

    $("#formViewDTE #FechaEmisionPP").text( moment(data.FechaEmision, 'YYYY-MM-DD HH:mm:ss', true).format("DD-MM-YYYY") );
    //$("#formViewDTE #FechaVencimientoPP").text( moment("data.FechaVencimiento", 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY") );
    $("#formViewDTE #FechaVencimientoPP").text( moment('2020-01-05', 'YYYY-MM-DD',true).format("DD-MM-YYYY") );

    if(data.FechaPPSolicitada != null){    
        $("#formViewDTE #FechaPagoSolicitadaPP").val( moment(data.FechaPPSolicitada, 'YYYY-MM-DD HH:mm:ss', true).format("YYYY-MM-DD") );

    }else{
        $("#formViewDTE #FechaPagoSolicitadaPP").val( moment().add(1, 'days').format("YYYY-MM-DD") );
    }

    var fecha1 = moment($("#FechaPagoSolicitadaPP").val(), 'YYYY-MM-DD', true);
    var fecha2 = moment($("#FechaVencimientoPP").text(), 'DD-MM-YYYY', true);
    $("#formViewDTE #DiasAnticipoSolicitadaPP").text( fecha2.diff(fecha1, 'days') );

     if(data.IdEstadoPP == 0){
        $("#divIndicadorPP").hide();

        $("#divBtnSimularPP").show();
        $("#divTituloSimularPP").hide();
        $("#divTituloSimularPP_2").hide();
        $("#divSimulacion1").hide();
        $("#divSimulacion2").hide();
        $("#divBtnSolicitarPP").hide();

        $("#FechaPagoSolicitadaPP").prop( "disabled", false );
        
    }else{
        CalcularSimulacionPP_v1();

        $("#divIndicadorPP").show();

        $("#divBtnSimularPP").hide();
        $("#divTituloSimularPP").hide();
        $("#divTituloSimularPP_2").show();
        $("#divSimulacion1").hide();
        $("#divSimulacion2").show();
        $("#divBtnSolicitarPP").hide();

        $("#FechaPagoSolicitadaPP").prop( "disabled", true );

    }
}

var CalcularSimulacionPP = function () {
    
    CalcularSimulacionPP_v1();

    $("#divBtnSimularPP").hide();
    $("#divTituloSimularPP").show();
    $("#divTituloSimularPP_2").hide();
    $("#divSimulacion1").show();
    $("#divSimulacion2").show();
    $("#divBtnSolicitarPP").show();
}

var CalcularSimulacionPP_v1 = function () {
    var tasaMensual = 0.7;
    var tasaDia = 0.7 / 30;
    var diasAnticipo = $("#DiasAnticipoSolicitadaPP").text();
    var tasaDescuento = tasaDia * diasAnticipo;

    var montoTotalPP = $("#MontoTotalCLP").text().replace("$", "").replace(".", "").replace(".", "").replace(".", "");
    var ivaDescuento = $("#MontoIVACLP").text().replace("$", "").replace(".", "").replace(".", "").replace(".", "");
    var netoDescuento = $("#MontoNetoCLP").text().replace("$", "").replace(".", "").replace(".", "").replace(".", "");

    var netoDescuentoPP = netoDescuento * tasaDescuento / 100;
    var ivaDescuentoPP = ivaDescuento * tasaDescuento / 100;
    var montoDescuentoPP = montoTotalPP * tasaDescuento / 100;
    var diferenciaPP = montoTotalPP - montoDescuentoPP;

    console.log("netoDescuentoPP: " + netoDescuentoPP);
    console.log("ivaDescuentoPP: " + ivaDescuentoPP);
    console.log("montoDescuentoPP: " + montoDescuentoPP);
    console.log("diferenciaPP: " + diferenciaPP);
    
    $("#formViewDTE #TipoCambioPP").text("723,50");
    $("#formViewDTE #TasaDescuentoDiaMensualPP").text(tasaMensual);
    $("#formViewDTE #TasaDescuentoDiaPP").text( tasaDia  );
    $("#formViewDTE #TasaDescuentoPP").text( tasaDia * $("#DiasAnticipoSolicitadaPP").text() );
    //$("#formViewDTE #SaldoFacturaPP").text(data.DescripcionTipoDTE + " - " + data.FolioDTE);

    $("#formViewDTE #NetoDescontadoPP").text( "$ " + new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(netoDescuentoPP) );
    $("#formViewDTE #IVAPP").text( "$ " + new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(ivaDescuentoPP) );
    $("#formViewDTE #DescuentoPP").text( "$ " + new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(montoDescuentoPP) );
    $("#formViewDTE #DiferenciaPagoPP").text( "$ " + new Intl.NumberFormat('es-CL',  { useGrouping: true, minimumFractionDigits: 0, maximumFractionDigits: 0}).format(diferenciaPP) );

}

var SolicitarPP = function () {

    $('#ModalSolicitarPP').modal("show");

}

var ConfirmarPP = function () {

    $('#ModalSolicitarPP').modal("hide");

    $("body").addClass("loading");

    setTimeout(function(){
        try{
            parametroAjax.ruta="solicitarPP";
            parametroAjax.data = $("#formViewDTE").serialize();
            respuesta=procesarajax(parametroAjax);
            var result = respuesta.respuesta.status[0];

            console.log(result.code);

            if (result.code == "200"){
                toastr.success(result.des_code, "Solicitud de Pronto Pago enviada con éxtio!");
                ProcesarCargaDTE();
                BotonVolver();

            }else{
                toastr.warning(result.des_code, "Error!");
            }
            
        }catch(err) {
            toastr.error("No se ejecuto la consulta, contacte al personal informático. <br>" + err.message , "Error!");
            console.log("No se ejecuto la consulta, contacte al personal informático: " + err.message);
        }

        $("body").removeClass("loading"); 

    }, 8);
}
