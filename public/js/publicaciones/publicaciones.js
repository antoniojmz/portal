var RegistroPublicacion = '';
var limpiarPublicaciones=0;

var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var ManejoRespuestaProcesar = function (respuesta){
    if(respuesta.code==200){
		var res = JSON.parse(respuesta.respuesta.f_registro_publicacion);
		if (res.code==200){
            cargarTablaPublicaciones(respuesta.respuesta.v_publicaciones);
            $("#idNoticia").val(res.idNoticia);
			var res2 = JSON.parse(respuesta.respuesta.urlImage);
            toastr.success(res.des_code, "Procesado!");
			if (res2.code=="-3"){
            	toastr.warning(res2.des_code, "Aviso!");
			}else{
				$("#urlImage").val(res2.des_code);
                $("#divImagen").show();
                if (res2.des_code.length>4){
                    $('#imgPublicacion').attr('src',res2.des_code)+ '?' + Math.random();
                }
				volverForm();
			}
		}else{
            toastr.error("Contacte al personal informatico", "Error!");
		}
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }

}

// Manejo Activar / Desactivar publicaciones
var ManejoRespuestaProcesarA = function(respuesta){
    if(respuesta.code==200){
        if(respuesta.respuesta.activar>0){
            if(respuesta.respuesta.v_publicaciones.length>0){
                toastr.success('Proceso con exito.', "Procesado!");
                cargarTablaPublicaciones(respuesta.respuesta.v_publicaciones);
            }
        }else{
            toastr.warning("Debe seleccionar un registro", "Info!");
        }
    }else{
        toastr.error("Contacte al personal informatico", "Error!");
    }
}

var cargarTablaPublicaciones = function(data){
    console.log(data);
    if(limpiarPublicaciones==1){destruirTabla('#tablaPublicaciones');$('#tablaPublicaciones thead').empty();}
    if (data.length>0){
        $("#spanNoReg").text("");
        $("#tablaPublicaciones").dataTable({ 
            "aLengthMenu": [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            "scrollX": true,
            "scrollY": '45vh',
            "order": [[0,'desc'],[2,'desc']],
            "scrollCollapse": false,
            "columnDefs": [
                {
                    "targets": [ 1 ],
                    "searchable": false
                },
                {"sWidth": "26%", "aTargets": [1]},
                {"sWidth": "14%", "aTargets": [2]},
                {"sWidth": "14%", "aTargets": [3]},
                {"sWidth": "16%", "aTargets": [4]},
                {"sWidth": "16%", "aTargets": [5]},
                {"sWidth": "10%", "aTargets": [6]}
            ],
            "language": {
                "url": "/plugins/DataTables-1.10.10/de_DE-all.txt"
            },
            "data": data,
            "columns":[
            {"title": "Id","data": "idNoticia",visible:0},
            {"title": "Titulo","data": "titulo"},
            {"title": "Fecha inicio","data": "fechaInicio"},
            {"title": "Fecha fin","data": "fechaFin"},
            {"title": "Creado por","data": "usrNombreFull"},
            {"title": "Fecha creacion","data": "auFechaCreacion"},
            {"title": "Estado","data": "desEstado"},
            {"title": "principal","data": "idPrincipal",visible:0},
            {"title": "Estado","data": "idEstado",visible:0},
            {"title": "Descripcion","data": "descripcion",visible:0},
            {"title": "Detalle","data": "detalle",visible:0},
            {"title": "Proveedores","data": "idProveedor",visible:0},
            {"title": "idPrincipal","data": "idPrincipal",visible:0},
            {"title": "idOrden","data": "idOrden",visible:0}
            ],
        });
        seleccionarTablaPublicaciones();
        limpiarPublicaciones=1;
    }else{
        $("#spanNoReg").text("No hay publicaciones registradas.");
        limpiarPublicaciones=0;
    }
};

var seleccionarTablaPublicaciones = function(data){
    var tableB = $('#tablaPublicaciones').dataTable();
    $('#tablaPublicaciones tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        RegistroPublicacion = TablaTraerCampo('tablaPublicaciones',this);
    });
    tableB.on('dblclick', 'tr', function () {
        $('#close').trigger('click');
    });
    $(function(){
        $.contextMenu({
            selector: '#tablaPublicaciones',
            // selector: '.dataTable tbody tr',
            callback: function(key, options) {
                switch(key) {
                    case "1":
                        cargarForm();
                        pintarDatosActualizar(RegistroPublicacion);
                        break;
                    case "2":
                        cambiarEstatusPublicacion(RegistroPublicacion);
                    break;
                }
            },
            items: {
                "1": {name: "Editar", icon: "fa-pencil-square-o"},
                "2": {name: "Activar / Desactivar", icon: "fa-toggle-on"}
            }
        });
    });
}

var pintarDatosActualizar= function(data){
    $("#divImagen").show();
    if(data.idNoticia!=null){$("#idNoticia").val(data.idNoticia);}
    if(data.fechaInicio!=null){$("#fechaInicio").val(moment(data.fechaInicio,"YYYY-MM-DD").format("DD-MM-YYYY"));}
    if(data.usrNombreFull!=null){$("#usrNombreFull").val(data.usrNombreFull);}
    if(data.fechaFin!=null){$("#fechaFin").val(moment(data.fechaFin,"YYYY-MM-DD").format("DD-MM-YYYY"));}
    if(data.idOrden!=null){$("#idOrden").val(data.idOrden).trigger("change");}
    if(data.idProveedor!=null){
        var proveedores = data.idProveedor.split(",");
        $("#idProveedor").val(proveedores).trigger("change");
    }
    if(data.idPrincipal==1){
        $('#idPrincipal')[0].checked = true;
        $("#idPrincipal").val(data.idPrincipal);
    }
    if(data.titulo!=null){$("#titulo").val(data.titulo);}
    if(data.descripcion!=null){$("#descripcion").val(data.descripcion);}
    if(data.detalle!=null){$("#divDetalle").summernote("code", data.detalle);}
    if(data.urlImage!=null){
        $("#urlImage").val(data.urlImage);
        $('#imgPublicacion').attr('src',data.urlImage)+ '?' + Math.random();
    }
}


var validarFecha = function(){
	var fecha_i=$("#fechaInicio").val();
	if (fecha_i.length < 1){
		$("#spanFechaI").show();
		return;
	}else{
		$("#spanFechaI").hide();
	}	
}

var validarDetalle = function(){
	var detalle = $("#divDetalle").summernote("code"); 
	if (detalle.length < 12){
		$("#spanDetalleE").show();
		return;		
	}else{
		$("#spanDetalleE").hide();
	}
}

var cambiarEstatusPublicacion = function(data){
    parametroAjax.ruta=rutaA;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarA(respuesta);
}

var ProcesarPublicacion = function (){
    var fecha_i=$("#fechaInicio").val();
    var fecha_f=$("#fechaFin").val();
    var f = new Date();
    var now = f.getDate() + "-" + (f.getMonth() +1) + "-" + f.getFullYear();
    var fecha_now= moment(now,"DD-MM-YYYY").format("YYYY-MM-DD");
    var fecha_ini= moment(fecha_i,"DD-MM-YYYY").format("YYYY-MM-DD");
    if(fecha_ini < fecha_now){
        toastr.warning("La Fecha de Publicación no puede ser menor a la fecha actual.", "Aviso!");
        return;
    }
    if (fecha_f.length>3){
        var fecha_fin= moment(fecha_f,"DD-MM-YYYY").format("YYYY-MM-DD");
        if(fecha_fin  < fecha_ini){
            toastr.warning("La Fecha Fin de la Publicación no puede ser menor a la fecha de Inicio.", "Aviso!");
            return;
        }
    }
    var detalle = $("#divDetalle").summernote("code"); 
	if (detalle.length < 12){$("#spanDetalleE").show();return;}
	if (fecha_i.length < 1){$("#spanFechaI").show();return;}
    var idProveedor = $("#idProveedor").val()
	var proveedores = idProveedor.toString();
    parametroAjax.ruta=ruta;
	var form = $('#Formpublicaciones').get(0);
    var formData = new FormData(form);
    formData.append("detalle", detalle);
    formData.append("proveedores", proveedores);
    parametroAjax.ruta=ruta;
    parametroAjax.data=formData;
    respuesta=procesarajaxfile(parametroAjax);
    ManejoRespuestaProcesar(respuesta);
}

var cargarForm = function(){
	$(".divForm").toggle();	
    $("#idNoticia").val("");
    $("#urlImage").val("");
    $('#imgPublicacion').attr('src','img/default-img.png')+ '?' + Math.random();    
    $('#Formpublicaciones')[0].reset(); 
    $(".comboclear").val('').trigger("change");
}

var volverForm = function(){
	$(".divForm").toggle();
    $("#divImagen").hide();
    $('#imgPublicacion').attr('src','img/default-img.png')+ '?' + Math.random();    
	$('#Formpublicaciones')[0].reset();	
    $(".comboclear").val('').trigger("change");
    $("#divDetalle").summernote("reset");
}

var toggleDetalle = function(){
	$("#divDetalles").slideToggle("fast");
}

var cargarCalendarios = function(){
	var fecha_i2 = $('#fechaInicio').datepicker({
        language: 'es',
        format: 'dd-mm-yyyy',
		todayHighlight: !0,
	    orientation: "bottom left",
	    templates: {
	        leftArrow: '<i class="la la-angle-left"></i>',
	        rightArrow: '<i class="la la-angle-right"></i>'
	    }
	});
	var fecha_f2 = $('#fechaFin').datepicker({
		language: 'es',
        format: 'dd-mm-yyyy',
		todayHighlight: !0,
	    orientation: "bottom left",
	    templates: {
	        leftArrow: '<i class="la la-angle-left"></i>',
	        rightArrow: '<i class="la la-angle-right"></i>'
	    }
	});
}

var crearallcombos = function(data){
    crearcombo('#idProveedor',data.v_proveedores);
    crearcombo('#idOrden',orden_combo);
}

var validador = function(){
	validarFecha();
	validarDetalle();
    $('#Formpublicaciones').formValidation('validate');
};

var cal1 = function (){
  $("#fechaInicio").focus();
};
var cal2 = function (){
  $("#fechaFin").focus();
};

$(document).ready(function(){
    console.log(d);
    crearallcombos(d);    
    cargarTablaPublicaciones(d.v_publicaciones);
	cargarCalendarios();
	$('#divDetalle').summernote({
		height: 200
	});
	$("#checkProveedor").click(function(){
	    if($("#checkProveedor").is(':checked') ){
	        $("#idProveedor > option").prop("selected","selected");
	        $("#idProveedor").trigger("change");
	    }else{
	        $("#idProveedor > option").removeAttr("selected");
    		$("#idProveedor").val('').trigger("change");
	     }
	});
    $(document).on('click','#agregar',cargarForm);
    $(document).on('click','#cancelar',volverForm);
    $(document).on('click','#volverT',volverForm);
    $(document).on('click','#guardar',validador);
    $(document).on('click','#ahrefDetalle',toggleDetalle);
    $(document).on('click','#btn-fechaInicio',cal1);
	$(document).on('click','#btn-fechaFin',cal2);
	$(document).on('change','#fechaInicio',validarFecha);
    $('#divDetalle').on('summernote.keyup', function(we, e) {
        validarDetalle();            
    });

    $('#Formpublicaciones').formValidation({
        excluded:[':disabled'],
        // message: 'El módulo le falta un campo para ser completado',
        fields: {
            'idProveedor': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },            
            'titulo': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },
            'descripcion': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },
            'divDetalle': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },
            
        }
    })
    .on('success.form.fv', function(e){
        ProcesarPublicacion();
    })
    .on('status.field.fv', function(e, data){
        data.element.parents('.form-group').removeClass('has-success');
    });
});