var limpiar=limpiarDte=limpiarProveedores=limpiarUsuarios=printCounter=0;
var RegistroClientes ='';
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var ManejoRespuestaC = function(respuesta){
    if (respuesta.code = '200'){
        cargartablaClientes(respuesta.respuesta);
    }else{
        toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");
    };
}

var ManejoRespuestaD = function(respuesta){
    if (respuesta.code = '200'){
            pintarDatos(respuesta.respuesta.v_cliente[0]);
            cargartablaDTE(respuesta.respuesta.v_dtes);
            cargartablaProveedores(respuesta.respuesta.v_clientes_proveedores);
            cargartablaUsuarios(respuesta.respuesta.v_clientes_usuarios);
    }else{
        toastr.error("No se ejecuto la consulta, contacte al personal informático", "Error!");        
    };
}

var cargartablaDTE = function(data){
    if(limpiarDte==1){destruirTabla('#tablaDTE');}
    if (data.length>0){
        $("#tablaDTE").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            'bSort': false,
            "scrollX": true,
            "language": {
                    "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "IdDTE","data": "IdDTE",visible:0},
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {"title": "IdCliente","data": "IdCliente",visible:0},
                {
                    "title": "Fecha de Recepción", 
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
                {"title": "RUT Proveedor","data": "RutProveedor"},
                {"title": "Nombre Proveedor","data": "NombreProveedor"},
                {"title": "RUT Cliente","data": "RutCliente"},
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Monto Total DTE","data": "MontoExentoCLP"},
                {"title": "Monto total OM","data": "MontoExentoOM"},
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
                {"title": "Estado Actual de Pago","data": "EstadoActualDTE"},
            ],
        });
        limpiarDte=1;
    }else{
        limpiarDte=0;
    }
}

var cargartablaProveedores = function(data){
    if(limpiarProveedores==1){destruirTabla('#tablaProveedores');}
    if (data.length>0){
        $("#tablaProveedores").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            'bSort': false,
            "language": {
                    "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "IdCliente","data": "IdCliente",visible:0},
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {"title": "RUT Cliente","data": "RutCliente"},
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Razon Social","data": "RazonSocial"}
            ],
        });
        limpiarProveedores=1;
    }else{
        limpiarProveedores=0;
    }
}

var cargartablaUsuarios = function(data){
    if(limpiarUsuarios==1){destruirTabla('#tablaUsuarios');}
    if (data.length>0){
        $("#tablaUsuarios").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            'bSort': false,
            "language": {
                    "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "IdCliente","data": "IdCliente",visible:0},
                {"title": "Login","data": "usrUserName"},
                {"title": "Nombre","data": "usrNombreFull"},
                {"title": "Email","data": "usrEmail"}
            ],
        });
        limpiarUsuarios=1;
    }else{
        limpiarUsuarios=0;
    }
}

var pintarDatos = function(data){
    if(data.CodigoSociedadSAP!=null){$("#CodigoSociedadSAP").text(data.CodigoSociedadSAP);}
    if(data.NombreCliente!=null){$("#NombreCliente").text(data.NombreCliente);}
    if(data.RutCliente!=null){$("#RutCliente").text(data.RutCliente);}
    if(data.RazonSocial!=null){$("#RazonSocial").text(data.RazonSocial);}
    if(data.NombreFantasiaCliente!=null){$("#NombreFantasiaCliente").text(data.NombreFantasiaCliente);}
    if(data.PersonaContactoCliente!=null){$("#PersonaContactoCliente").text(data.PersonaContactoCliente);}
    if(data.TelefonoContactoCliente!=null){$("#TelefonoContactoCliente").text(data.TelefonoContactoCliente);}
}

var cargartablaClientes = function(data){
    if (limpiar>0){destruirTabla('#tablaClientes');}
    if (data.length>0){
        $("#tablaClientes").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            "language": {
                "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "Id","data": "IdCliente",visible:0},
                {"title": "RUT Cliente","data": "RutCliente"},
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Nombre Fantasia","data": "NombreFantasiaCliente"},
                {"title": "Razon Social","data": "RazonSocial"},
                {"title": "Persona Contacto","data": "PersonaContactoCliente"},
                {"title": "Telefono Contacto","data": "TelefonoContactoCliente"}
            ],
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
            ]
        });
        SeleccionarTablaClientes();
        limpiar=1;
    }else{
        limpiar=0;
        toastr.warning("No se encontraron resultados", "Info!");
    }
};

var SeleccionarTablaClientes = function(){
    var tableB = $('#tablaClientes').dataTable();
    $('#tablaClientes tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    });
    $('#tablaClientes tbody').on('dblclick', 'tr', function () {
        RegistroClientes = TablaTraerCampo('tablaClientes',this);
        cargarFormularioVisualizacion(RegistroClientes);
    });
    tableB.on('dblclick', 'tr', function () {
        $('#close').trigger('click');
    });
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
    parametroAjax.data = {"IdCliente":data.IdCliente};
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaD(respuesta);
};

var BotonVolver = function(){
    $(".divForm").toggle();
    $(".span").text("Desconocido");
}

$(document).ready(function(){
    $(".span").text("Desconocido");
    $("#spanTitulo").text("Listado de Clientes");
    cargartablaClientes(d.v_clientes);
    crearcombo('#Selectcampo',d.v_busq_cliente);
    $(document).on('click','#consultar',ProcesarConsulta);
    $(document).on('click','#volver',BotonVolver);
});