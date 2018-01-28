var RegistroAcceso = '';
var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var ManejoRespuestaProcesar = function(respuesta){
    if(respuesta.code==200){
        if(respuesta.respuesta.code==200){
            window.location.href = "/"+respuesta.respuesta.des_code;
        }else{
            toastr.warning(respuesta.respuesta.des_code, "Info!");
        }
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }
}

var cargarTablaAccesos = function(data){
    $("#tablaAccesos").dataTable({ 
        'bSort': false,
        "scrollCollapse": false,
        "paging": false,
        "searching": false,
        "pagingType": "full_numbers",
        "language": LenguajeTabla,
        "columnDefs": [{
            "targets": [1]
        }],
        "data": data,
        "columns":[
            {"title": "Id","data": "IdUser",visible:0},
            {"title": "Nombres","data": "usrNombreFull"},
            {"title": "Login","data": "usrUserName"},
            {"title": "idPerfil","data": "idPerfil",visible:0},
            {"title": "Perfíl","data": "des_perfil"},
            {"title": "Estado","data": "estado_perfil"},
        ],
    });
    SeleccionarTablaAccesos();
};

var SeleccionarTablaAccesos = function(){
    var tableB = $('#tablaAccesos').dataTable();
    $('#tablaAccesos tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        RegistroAcceso = TablaTraerCampo('tablaAccesos',this);
    });
    tableB.on('dblclick', 'tr', function () {
        seleccionarAcceso(RegistroAcceso);
    });
}

var seleccionarAcceso = function(data){
    parametroAjax.ruta=ruta;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesar(respuesta);
}

$(document).ready(function(){
    setTimeout(function(){Salir();}, 600000);
    $("#spanTitulo").text("Elige acceso");
    cargarTablaAccesos(d.v_accesos);
    $(document).on('click','#btn-logout',Salir);
});
