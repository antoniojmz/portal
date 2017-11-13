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
            toastr.error("Ocurrio un error mientras se cargaba su perfíl", "Info!");
        }
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }
}

var cargarTablaAccesos = function(data){
    $("#tablaAccesos").dataTable({ 
        "aLengthMenu": [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
        "scrollCollapse": false,
        "paging": false,
        "searching": false,
		// "info": false,
    	"language": {
	    	"info": "Seleccione un perfíl con doble click..."
	  	},
        "columnDefs": [
        {
            "targets": [ 1 ],
            "searchable": false
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
};

var seleccionarAcceso = function(data){
    parametroAjax.ruta=ruta;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesar(respuesta);
}

$(document).ready(function(){
	$("#spanTitulo").text("Elige acceso");
	cargarTablaAccesos(d.v_accesos);
	var tableB = $('#tablaAccesos').dataTable();
    $('#tablaAccesos tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        RegistroAcceso = TablaTraerCampo('tablaAccesos',this);
    });
    tableB.on('dblclick', 'tr', function () {
    	seleccionarAcceso(RegistroAcceso);
    });
});
