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
        mensajesAlerta('Error','No se ejecuto la consultam contacte al personal informático', 'error');
    };
}

var ManejoRespuestaD = function(respuesta){
    if (respuesta.code = '200'){
            pintarDatos(respuesta.respuesta.v_proveedor[0]);
            cargartablaDTE(respuesta.respuesta.v_dtes);
            cargartablaClientes(respuesta.respuesta.v_clientes_proveedores);
            cargartablaUsuarios(respuesta.respuesta.v_proveedores_usuarios);
    }else{
        mensajesAlerta('Error','No se ejecuto la consultam contacte al personal informático', 'error');
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
                {"title": "Fecha de recepción","data": "FechaRecepcion"},
                {"title": "Tipo DTE","data": "TipoDTE"},
                {"title": "Folio DTE","data": "FolioDTE"},
                {"title": "Fecha de emisión","data": "FechaEmision"},
                {"title": "Rut Proveedor","data": "RutProveedor"},
                {"title": "Nombre Proveedor","data": "NombreProveedor"},
                {"title": "Rut Cliente","data": "RutCliente"},
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Monto Total DTE","data": "MontoExentoCLP"},
                {"title": "Monto total OM","data": "MontoExentoOM"},
                {"title": "Estado Actual de Pago","data": "EstadoActualDTE"},
                {"title": "Fecha de Estado Actual","data": "FechaEstadoActualDTE"}
            ],
        });
        limpiarDte=1;
    }else{
        limpiarDte=0;
    }
}

var cargartablaClientes = function(data){
    if(limpiarClientes==1){destruirTabla('#tablaClientes');}
    if (data.length>0){
        $("#tablaClientes").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            'bSort': false,
            "language": {
                    "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "IdCliente","data": "IdCliente",visible:0},
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
                {"title": "Rut Cliente","data": "RutCliente"},
                {"title": "Nombre Cliente","data": "NombreCliente"},
                {"title": "Razon Social","data": "RazonSocial"}
            ],
        });
        limpiarClientes=1;
    }else{
        limpiarClientes=0;
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
                {"title": "IdProveedor","data": "IdProveedor",visible:0},
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
    if(data.NombreProveedor!=null){$("#NombreProveedor").text(data.NombreProveedor);}
    if(data.RutProveedor!=null){$("#RutProveedor").text(data.RutProveedor);}
    if(data.RazonSocial!=null){$("#RazonSocial").text(data.RazonSocial);}
    if(data.NombreFantasia!=null){$("#NombreFantasia").text(data.NombreFantasia);}
    if(data.banco!=null){$("#banco").text(data.banco);}
    if(data.cuenta!=null){$("#cuenta").text(data.cuenta);}
    if(data.RutTitular!=null){$("#RutTitular").text(data.RutTitular);}
    if(data.sucursal!=null){$("#sucursal").text(data.sucursal);}
    if(data.PersonaContacto!=null){$("#PersonaContacto").text(data.PersonaContacto);}
    if(data.TelefonoContacto!=null){$("#TelefonoContacto").text(data.TelefonoContacto);}
}

var cargartablaProveedores = function(data){
    if (limpiar>0){destruirTabla('#tablaProveedores');}
    if (data.length>0){
        $("#tablaProveedores").dataTable({
            'aLengthMenu': [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            "language": {
                "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
                {"title": "Id","data": "IdProveedor",visible:0},
                {"title": "RUT Proveedor","data": "RutProveedor"},
                {"title": "Persona de Contacto","data": "PersonaContacto"},
                {"title": "Teléfono de Contacto","data": "TelefonoContacto"},
                {"title": "Datos Pago Registrado","data": "DatosPago"},
                {"title": "Estado","data": "EstadoProveedor"}
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
        limpiar=1;
    }else{
        limpiar=0;
        mensajesAlerta('Info','No se encontraron resultados', 'info');
    }
};

var ProcesarConsulta = function(){
    var Selectcampo = $('#Selectcampo').val();
    if (Selectcampo.length<1){
        mensajesAlerta('Error','Desde seleccionar un item', 'error');
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
    $(".span").text("Desconocido");
    $("#spanTitulo").text("Listado de proveedores");
    cargartablaProveedores(d.v_proveedores);
    crearcombo('#Selectcampo');
    if (d.v_proveedores.length>0){    
        var tableB = $('#tablaProveedores').dataTable();
        $('#tablaProveedores tbody').on('click', 'tr', function (e) {
            tableB.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        });
        $('#tablaProveedores tbody').on('dblclick', 'tr', function () {
            RegistroProveedor = TablaTraerCampo('tablaProveedores',this);
            cargarFormularioVisualizacion(RegistroProveedor);
        });
        tableB.on('dblclick', 'tr', function () {
            $('#close').trigger('click');
        });
    }
    $(document).on('click','#consultar',ProcesarConsulta);
    $(document).on('click','#volver',BotonVolver);
});