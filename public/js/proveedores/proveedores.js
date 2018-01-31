var limpiar=limpiarDte=limpiarClientes=limpiarUsuarios=printCounter=0;
var RegistroProveedor ='';
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var ManejoRespuestaC = function(respuesta){
    if (respuesta.code = '200'){
        cargartablaProveedores(respuesta.respuesta);
    }else{
        toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
    };
}

var ManejoRespuestaD = function(respuesta){
    if (respuesta.code = '200'){
            pintarDatos(respuesta.respuesta.v_proveedor[0]);
            cargartablaDTE(respuesta.respuesta.v_dtes);
            cargartablaClientes(respuesta.respuesta.v_clientes_proveedores);
            cargartablaUsuarios(respuesta.respuesta.v_proveedores_usuarios);
    }else{
        toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");        
    };
}

var cargartablaDTE = function(data){
    if(limpiarDte==1){destruirTabla('#tablaDTE');}
        $("#tablaDTE").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {"title": "IdCliente","data": "IdCliente",visible:0},
                {
                    "title": "Fecha de recepción", 
                    "data": "FechaRecepcion",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {"title": "Tipo DTE","data": "TipoDTE"},
                {"title": "Folio DTE","data": "FolioDTE"},
                {
                    "title": "Fecha de emisión", 
                    "data": "FechaEmision",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                },
                {
                    "title": "RUT Proveedor", 
                    "data": "RutProveedor",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = formateaRut(data, true)
                        }
                        return data;
                    }
                },
                {"title": "Nombre Proveedor","data": "NombreProveedor"},
                {
                    "title": "RUT Cliente", 
                    "data": "RutCliente",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = formateaRut(data, true)
                        }
                        return data;
                    }
                },
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Monto Total DTE","data": "MontoExentoCLP"},
                {"title": "Monto total OM","data": "MontoExentoOM"},
                {"title": "Estado Actual de Pago","data": "EstadoActualDTE"},
                {
                    "title": "Fecha de Estado Actual", 
                    "data": "FechaEstadoActualDTE",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = moment(data, 'YYYY-MM-DD HH:mm:ss',true).format("DD-MM-YYYY");
                        }
                        return data;
                    }
                }
            ],
        });
        limpiarDte=1;
}

var cargartablaClientes = function(data){
    if(limpiarClientes==1){destruirTabla('#tablaClientes');}
        $("#tablaClientes").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "data": data,
            "columns":[
                {"title": "IdCliente","data": "IdCliente",visible:0},
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {
                    "title": "RUT Cliente", 
                    "data": "RutCliente",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = formateaRut(data, true)
                        }
                        return data;
                    }
                },
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Razon Social","data": "RazonSocial"}
            ],
        });
        limpiarClientes=1;
}

var cargartablaUsuarios = function(data){
    if(limpiarUsuarios==1){destruirTabla('#tablaUsuarios');}
        $("#tablaUsuarios").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "data": data,
            "columns":[
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {
                    "title": "Login", 
                    "data": "usrUserName",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = formateaRut(data, true)
                        }
                        return data;
                    }
                },
                {"title": "Nombre","data": "usrNombreFull"},
                {"title": "Email","data": "usrEmail"}
            ],
        });
        limpiarUsuarios=1;
}

var pintarDatos = function(data){
    if(data.IdProveedorSAP!=null){$("#IdProveedorSAP").text(data.IdProveedorSAP);}
    if(data.RutProveedor!=null){$("#RutProveedor").text(data.RutProveedor);}
    if(data.NombreProveedor!=null){$("#NombreProveedor").text(data.NombreProveedor);}
    if(data.RazonSocialProveedor!=null){$("#RazonSocialProveedor").text(data.RazonSocialProveedor);}
    if(data.NombreFantasia!=null){$("#NombreFantasia").text(data.NombreFantasia);}
    if(data.Giro!=null){$("#Giro").text(data.Giro);}
    if(data.PersonaContacto!=null){$("#PersonaContacto").text(data.PersonaContacto);}
    if(data.TelefonoContacto!=null){$("#TelefonoContacto").text(data.TelefonoContacto);}
    if(data.TelefonoProveedor!=null){$("#TelefonoProveedor").text(data.TelefonoProveedor);}
    if(data.CorreoElectronico!=null){$("#CorreoElectronico").text(data.CorreoElectronico);}
    if(data.banco!=null){$("#banco").text(data.banco);}
    if(data.Cuenta!=null){$("#Cuenta").text(data.Cuenta);}
    if(data.RutTitular!=null){$("#RutTitular").text(data.RutTitular);}
    if(data.Sucursal!=null){$("#Sucursal").text(data.Sucursal);}
}

var cargartablaProveedores = function(data){
    if (limpiar>0){destruirTabla('#tablaProveedores');}
        var columnReport = [[1],[2],[3],[4],[5],[6],[7],[8],[9]];
        $("#tablaProveedores").dataTable({
            'aLengthMenu': DataTableLengthMenu,
            "scrollX": true,
            "scrollY": '50vh',
            "scrollCollapse": true,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "data": data,
            "columns":[
                {"title": "Id","data": "IdProveedor",visible:0},
                {
                    "title": "RUT Proveedor", 
                    "data": "RutProveedor",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = formateaRut(data, true)
                        }
                        return data;
                    }
                },
                {"title": "Razon Social","data": "RazonSocialProveedor"},
                {"title": "Telefono Proveedor","data": "TelefonoProveedor"},
                {"title": "Correo Electronico","data": "CorreoElectronico"},
                {"title": "Persona Contacto","data": "PersonaContacto"},
                {"title": "Nombre Fantasia","data": "NombreFantasia"},
                {"title": "Teléfono de Contacto","data": "TelefonoContacto"},
                {"title": "Datos Pago Registrado","data": "DatosPago"},
                {"title": "Estado","data": "EstadoProveedor"}
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn m-btn--pill btn-accent btn-sm m-btn m-btn--custom',
                    orientation:'landscape',
                    pageSize:'TABLOID',
                    title:'Listado de Proveedores',
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
                    title:'Listado de Proveedores',
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
                    title:'Listado de Proveedores',
                    exportOptions: {
                        columns: columnReport,
                        modifier: {
                            page: 'all',
                        }
                    },
                    customize : function(doc){
                        doc.defaultStyle.fontSize = 8; 
                        var colCount = new Array();
                        $($("#tablaProveedores").dataTable()).find('tbody tr:first-child td').each(function(){
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
    if (data.length>0){SeleccionarTablaProveedores();}
};

var SeleccionarTablaProveedores = function(){
    var tableB = $('#tablaProveedores').dataTable();
    $('#tablaProveedores tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    });
    $('#tablaProveedores tbody').on('dblclick', 'tr', function () {
        RegistroProveedor = TablaTraerCampo('tablaProveedores',this);
        cargarFormularioVisualizacion(RegistroProveedor);
        $("#ahref1").click();
        $('html,body').animate({ scrollTop: $("#divSeparacion").offset().top });
    });
    tableB.on('dblclick', 'tr', function () { $('#close').trigger('click'); });
}

var ProcesarConsulta = function(){
    var Selectcampo = $('#Selectcampo').val();
    if (Selectcampo.length<1){
        toastr.error("Debe seleccionar al menos un item", "Error!");
        return;
    }
    parametroAjax.ruta=ruta;
    parametroAjax.data = $("#FormProveedores").serialize();
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaC(respuesta);
};

var cargarFormularioVisualizacion = function(data){
    $(".divForm").toggle();
    parametroAjax.ruta=rutaD;
    parametroAjax.data = {"IdProveedor":data.IdProveedor};
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaD(respuesta);
};

var BotonVolver = function(){
    $(".divForm").toggle();
    $(".span").text("Desconocido");
}

$(document).ready(function(){
    ClassActive("LiProveedores");
    $(".span").text("Desconocido");
    $("#spanTitulo").text("Listado de proveedores");
    cargartablaProveedores(d.v_proveedores);
    crearcombo('#Selectcampo',d.v_busq_proveedor);
    $(document).on('click','#consultar',ProcesarConsulta);
    $(document).on('click','#volver',BotonVolver);
});