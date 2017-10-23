var imgProgreso = '<img alt="" src="/img/giphy.gif" height="50" width="50"/>';
var cambiarSalir = function(){
	v_salir = 1;
}
$(document).ready(function() {
	window.onbeforeunload = function (e) {
    	if (v_salir == 0){
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
    	v_salir = 0;
    }
    $(document).ajaxStart(function (){
		$.blockUI({ 
			message:'<h6>Cargando...</h6>',
			css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
		        } 
	    }); 
	});
	$(document).ajaxStop(function() {
		setTimeout($.unblockUI, 0); 
	}); 
    $(document).on('click','.m-menu__link',cambiarSalir);
    $(document).on('click','.m-nav__link',cambiarSalir);
	$(document.body).on("keydown", this, function (event) {
	    if (event.keyCode == 116) {
	        cambiarSalir();
	    }
	});
}); 