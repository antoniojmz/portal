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

var pintarDatos = function(data){
    if(data.CodigoSociedadSAP!=null){$("#CodigoSociedadSAP").text(data.CodigoSociedadSAP);}
    if(data.NombreCliente!=null){$("#NombreCliente").text(data.NombreCliente);}
    if(data.RutCliente!=null){$("#RutCliente").text(data.RutCliente);}
    if(data.RazonSocial!=null){$("#RazonSocial").text(data.RazonSocial);}
    if(data.NombreFantasiaCliente!=null){$("#NombreFantasiaCliente").text(data.NombreFantasiaCliente);}
    if(data.PersonaContactoCliente!=null){$("#PersonaContactoCliente").text(data.PersonaContactoCliente);}
    if(data.TelefonoContactoCliente!=null){$("#TelefonoContactoCliente").text(data.TelefonoContactoCliente);}
}


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

var cargarFormulario = function(data){
    console.log(data);
}



var cargarTabla = function(){
    console.log("holas");
    var t = $('#tablaBuzon').DataTable();
    t.row.add( {
        "usuario":       "Tiger Nixon",
        "operador":   "System Architect",
        "tiempo":     "$3,120"
    } ).draw(false);

    // var counter =1;

    //  t.row.add( [
    //         counter +'.1',
    //         counter +'.2',
    //         counter +'.3',
    //         counter +'.4',
    //         counter +'.5'
    //     ] ).draw( false );


  
    console.log("chao");
}
$(document).ready(function(){
    console.log(d);
    $('#tablaBuzon').dataTable({
        "language": {
            "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
        },
        "columnDefs": [
            {orderable:false},
        ],
    });
    cargarTabla();
    // $(".span").text("Desconocido");
    // $("#spanTitulo").text("Listado de Clientes");
    // cargartablaClientes(d.v_clientes);
    // crearcombo('#Selectcampo',d.v_busq_cliente);
    // $(document).on('click','#consultar',ProcesarConsulta);
    // $(document).on('click','#volver',BotonVolver);
});