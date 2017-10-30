var imgProgreso = '<img alt="" src="/img/giphy.gif" height="50" width="50"/>';
var cambiarSalir = function(){
	v_salir = 1;
}

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

var Salir = function(){
	var parametroAjax = {
	    'token': $('input[name=_token]').val(),
	    'tipo': 'POST',
	    'data': {},
	    'ruta': '',
	    'async': false
	};
	parametroAjax.ruta=salir;
	parametroAjax.data = $("#formLogout").serialize();
	procesarajax(parametroAjax);
}

$(document).ready(function() {
	window.onbeforeunload = function (e) {
    	if (v_salir == 0){
    		Salir();
        }
    	v_salir = 0;
    }
    $(document).ajaxStart(function (){
        mApp.blockPage({
	        overlayColor: "#000000",
	        type: "loader",
	        state: "success",
	        message: "Please wait..."
        })
	});
	$(document).ajaxStop(function() {
		mApp.unblockPage();	 
	}); 
    $(document).on('click','.m-menu__link',cambiarSalir);
    $(document).on('click','.m-nav__link',cambiarSalir);
	$(document.body).on("keydown", this, function (event) {
	    if (event.keyCode == 116) {
	        cambiarSalir();
	    }
	});
}); 