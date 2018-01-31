// Habilitar token para todos los ajax.
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Formatear rut en inputs
var formatoRut = function(rut){
    var response = "";
    var ced = rut.substring(0, 8);
    var ver = rut.substring(rut.length-1);
    rut.length < 9 ? response = "" : response = ced+"-"+ver;   
    return response;
}

// Combo desplegable de datatable
DataTableLengthMenu = [[5,10, 25, 50, 100, -1],[5,10, 25, 50, 100, "Todos"]]

//Idioma Español para DataTable
var LenguajeTabla = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Ver listado de _MENU_",
    "sZeroRecords": "No se encontraron registros...",
    "sInfo": "_START_ al _END_ de _TOTAL_ registros",
    "sInfoEmpty": "0 al 0 de 0 registros",
    "sInfoFiltered": "(filtrado de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Filtrar : ",
    "sUrl": "",
    "oPaginate": {
        "sFirst":    "<i class='la la-angle-double-left'></i>",
        "sPrevious": "<i class='la la-angle-left'></i>",
        "sNext":     "<i class='la la-angle-right'></i>",
        "sLast":     "<i class='la la-angle-double-right'></i>",
    }
}

// Arreglo para el orden de las noticias
var orden_combo = [
    {"id":"1","text":"1"},
    {"id":"2","text":"2"},
    {"id":"3","text":"3"},
    {"id":"4","text":"4"},
    {"id":"5","text":"5"},
    {"id":"6","text":"6"},
    {"id":"7","text":"7"},
    {"id":"8","text":"8"},
    {"id":"9","text":"9"},
    {"id":"10","text":"10"},
    {"id":"11","text":"11"},
    {"id":"12","text":"12"}
];

// blockUi Metronic
var MyblockPage = function(){
    mApp.blockPage({
        overlayColor: "#000000",
        type: "loader",
        state: "success",
        message: "Please wait..."
    })
}
// UnblockUi Metronic
var MyunblockPage = function(){
        mApp.unblockPage();  
}
//Fotmato de moneda
function number_format(amount, decimals) {
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
    decimals = decimals || 0; // por si la variable no fue fue pasada
    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);
    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);
    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;
    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');
    return amount_parts.join('.');
}

//Jquery
var crearfecha = function(control){
    $(control).datepicker({
        format: "dd/mm/yyyy",
        onRender: function(date) {
                // return date.valueOf() < now.valueOf() ? 'disabled' : '';
            },
        }).on('changeDate', function(e){
        });
    }
//////////////////////////////////////crear select 2 jquery /////////////////////////////////////////////////////
var crearcombo = function(control, data){
    $(control).select2({
        placeholder: "Seleccione...",
        allowClear: true,
        data: data
    }).on("change",function(e){
        $(this).blur();
    });
}
///////////////////////////////////////////////////// FILTRAR OBJECTO //////////////////////////////////////////////////////
function filtrar_objeto(my_object, my_criteria){
  return my_object.filter(function(obj) {
    return Object.keys(my_criteria).every(function(c) {
      return obj[c] == my_criteria[c];
  });
});
}
///////////////////////////////////////////////////// AJAX //////////////////////////////////////////////////////
var procesarajax = function(datos){
    MyblockPage();
    var resp = '';
    $.ajax({
        url:datos.ruta,
        headers: {'X-CSRF-TOKEN': datos.token},
        type:datos.tipo,
        async: datos.async,
        dataType: 'JSON',
        data: datos.data,
    })
    .done(function(response) {
        resp = {'code': '200', 'respuesta':response};
    })
    .fail(function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 422){
            msg = 'Validación';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500]. Si el error persiste comuníquese con informática.';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        resp = {'code': 'error', 'mensaje': msg, 'detalle':jqXHR};
        // mensajesAlerta('Error',msg, 'error');
    });
    MyunblockPage();
    return resp;
};

///////////////////////////// AJAX SIN BLOCK UI //////////////////////////////////////////////
var procesarajaxChat = function(datos){
    var resp = '';
    $.ajax({
        url:datos.ruta,
        headers: {'X-CSRF-TOKEN': datos.token},
        type:datos.tipo,
        async: datos.async,
        dataType: 'JSON',
        data: datos.data,
    })
    .done(function(response) {
        resp = {'code': '200', 'respuesta':response};
    })
    .fail(function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 422){
            msg = 'Validación';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500]. Si el error persiste comuníquese con informática.';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        resp = {'code': 'error', 'mensaje': msg, 'detalle':jqXHR};
        // mensajesAlerta('Error',msg, 'error');
    });
    return resp;
};
//////////////////////////////////////////////////////////////////////////
var procesarajaxfile = function(datos){
    MyblockPage();
    var resp = '';
    $.ajax({
        headers: {'X-CSRF-TOKEN': datos.token},
        url: datos.ruta,
        type: datos.tipo,
        async: datos.async,
        data: datos.data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            resp = {'code': '200', 'respuesta':response};
        },
        error: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 422){
                msg = 'Validación';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500]. Si el error persiste comuníquese con informática.';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            resp = {'code': 'error', 'mensaje': msg, 'detalle':jqXHR};
        }

    });
    MyunblockPage();
    return resp;
};

///////////////////////////////////////////////////// DATATABLE //////////////////////////////////////////////////////
var destruirTabla = function(tabla){
    if ($(tabla).dataTable()){
        $(tabla).dataTable().fnClearTable();
        $(tabla).dataTable().fnDraw();
        $(tabla).dataTable().fnDestroy();
        $(tabla).empty();
        // $(tabla).dataTable().fnClearTable();
    }
};

var TabalRegistroSelected = [];
var lenguajeTabla = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Ver listado de _MENU_",
    "sZeroRecords": "No hay registros seleccionados",
    "sInfo": "_START_ al _END_ de _TOTAL_ registros",
    "sInfoEmpty": "0 al 0 de 0 registros",
    "sInfoFiltered": "(filtrado de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Filtrar : ",
    "sUrl": "",
    "oPaginate": {
        "sFirst":    "Primero",
        "sPrevious": "Anterior",
        "sNext":     "Siguiente",
        "sLast":     "\u00daltimo"
    }
};

var cambionacionalidad = function(){
    ($("#nacionalidad").text() == "V")?$("#nacionalidad").text("E"):$("#nacionalidad").text("V");
};

// Selección Multiple
var TablaSeleccionRegitro = function(id_tabla, campo){
    $('#'+id_tabla+' tbody').on( 'click', 'tr', function() {
        var oTable = $('#'+id_tabla).dataTable();
        var iPos = oTable.fnGetPosition(this);
        var datacampo = oTable.fnGetData(iPos);
        var index = $.inArray(datacampo[campo], TabalRegistroSelected);
        if ( index === -1 ) {
            TabalRegistroSelected.push(datacampo[campo]);
        } else {
            TabalRegistroSelected = jQuery.grep(TabalRegistroSelected, function(value) {
              return value != datacampo[campo];
          });
        }
        $(this).toggleClass('selected');
    });
}

var TablaDesSelAll = function(id_tabla){
    var oTable = $('#'+id_tabla).dataTable();
    oTable.$('tr.selected').removeClass('selected');
    TabalRegistroSelected = [];
};

var TablaSelAll = function(id_tabla, campo){
    var oTable = $('#'+id_tabla).dataTable();
    TabalRegistroSelected = [];
    $(oTable.fnGetNodes()).each(function(i) {
        var iPos = oTable.fnGetPosition(this);
        var datacampo = oTable.fnGetData(iPos);
        $(this).addClass('selected');
        TabalRegistroSelected.push(datacampo[campo]);
    });
};

var TablaNroSeleccionado = function(id_tabla){
    var ta = $('#'+id_tabla).DataTable();
    return ta.rows('.selected').data().length;
}

var TablaNroRegistro = function(id_tabla){
    var ta = $('#'+id_tabla).DataTable();
    return ta.data().count();
}

var TablaNroRegistroFil = function(id_tabla){
    var table = $('#'+id_tabla).DataTable();
    var info = table.page.info();
    return info.recordsDisplay;
}

var TablaTraerCampo = function(id_tabla, instancia){
    var oTable = $('#'+id_tabla).dataTable();
    var iPos = oTable.fnGetPosition(instancia);
    var datacampo = oTable.fnGetData(iPos);
    return datacampo;
}

var creartablaMostrarDatos = function(id_tabla,titulos,data){
    $("#" + id_tabla).dataTable({
        "orderCellsTop": true,
        "columnDefs": [
        { "targets": [1], "defaultContent": '' }
        ],
        responsive: true,
        paging:   false,
        ordering: false,
        info:     false,
        bFilter: false,
        bSort:0,
        data: data,
        columns: titulos,
    });
};

var AjustarTabla = function(tabla){
    var oTable = $("#"+tabla).dataTable();
    oTable.fnAdjustColumnSizing();
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

var rhtmlspecialchars = function (str) {
    if (typeof(str) == "string") {
        str = str.replace(/&gt;/ig, ">");
        str = str.replace(/&lt;/ig, "<");
        str = str.replace(/&#039;/g, "'");
        str = str.replace(/&quot;/ig, '"');
        str = str.replace(/&amp;/ig, '&'); /* must do &amp; last */
    }
    return str;
}

// OpenWindowWithPost('public/pdf/Digitalización rápida en ByN a archivo PDF_1.pdf','','fgfgdrg',respuesta);
function OpenWindowWithPost(url, windowoption, name, params){
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", url);
    form.setAttribute("target", name);
    for (var i in params) {
        if (params.hasOwnProperty(i)) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = i;
            input.value = params[i];
            form.appendChild(input);
        }
    }
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

// OpenWindowWithGet('public/pdf/Digitalización rápida en ByN a archivo PDF_1.pdf','','fgfgdrg',respuesta);
function OpenWindowWithGet(url, windowoption, name, params){
    var form = document.createElement("form");
    form.setAttribute("method", "get");
    form.setAttribute("action", url);
    form.setAttribute("target", name);
    for (var i in params) {
        if (params.hasOwnProperty(i)) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = i;
            input.value = params[i];
            form.appendChild(input);
        }
    }
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}
// SaveToDisk('public/pdf/Digitalización rápida en ByN a archivo PDF_1.pdf','descarga.pdf');
function SaveToDisk(fileURL, fileName) {
    // for non-IE
    if (!window.ActiveXObject) {
        var save = document.createElement('a');
        save.href = fileURL;
        save.target = '_blank';
        save.download = fileName || 'unknown';
        var evt = new MouseEvent('click', {
            'view': window,
            'bubbles': true,
            'cancelable': false
        });
        save.dispatchEvent(evt);
        (window.URL || window.webkitURL).revokeObjectURL(save.href);
    }
    // for IE < 11
    else if ( !! window.ActiveXObject && document.execCommand)     {
        var _window = window.open(fileURL, '_blank');
        _window.document.close();
        _window.document.execCommand('SaveAs', true, fileName || fileURL)
        _window.close();
    }
}

//Funcion para salir de la aplicacion
var Salir = function(){
    parametroAjax.ruta=RutaSalir;
    parametroAjax.data = $("#formLogout").serialize();
    window.location.href = "/";
    procesarajax(parametroAjax);
}

// Configuracion de los mensajes toast
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

//verificar rut
function formateaRut(rut,value) {
    if (value){    
        var actual = rut.replace(/^0+/, "");
        if (actual != '' && actual.length > 1) {
            var sinPuntos = actual.replace(/\./g, "");
            var actualLimpio = sinPuntos.replace(/-/g, "");
            var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
            var rutPuntos = "";
            var i = 0;
            var j = 1;
            for (i = inicio.length - 1; i >= 0; i--) {
                var letra = inicio.charAt(i);
                rutPuntos = letra + rutPuntos;
                if (j % 3 == 0 && j <= inicio.length - 1) {
                    rutPuntos = "." + rutPuntos;
                }
                j++;
            }
            var dv = actualLimpio.substring(actualLimpio.length - 1);
            rutPuntos = rutPuntos + "-" + dv;
        }
        return rutPuntos;
    }else{

        return false;
    }
}

function Valida_Rut(Objeto){
    var tmpstr = "";
    var intlargo = Objeto.val();
    if (intlargo.length> 0){
        crut = Objeto.val();
        largo = crut.length;
        if ( largo <2 ){return false;}
        for ( i=0; i <crut.length ; i++ )
        if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' ){
            tmpstr = tmpstr + crut.charAt(i);
        }
        rut = tmpstr;
        crut=tmpstr;
        largo = crut.length;
 
        if ( largo> 2 )
            rut = crut.substring(0, largo - 1);
        else
            rut = crut.charAt(0);
        dv = crut.charAt(largo-1);
        if ( rut == null || dv == null )
        return false;
        var dvr = '0';
        suma = 0;
        mul  = 2;
        for (i= rut.length-1 ; i>= 0; i--){
            suma = suma + rut.charAt(i) * mul;
            if (mul == 7)
                mul = 2;
            else
                mul++;
        }
        res = suma % 11;
        if (res==1)
            dvr = 'k';
        else if (res==0)
            dvr = '0';
        else{
            dvi = 11-res;
            dvr = dvi + "";
        }
        if (dvr != dv.toLowerCase()){
            return false;
        }
        return true;
    }
}