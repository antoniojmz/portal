var imgProgreso = '<img alt="" src="/img/giphy.gif" height="50" width="50"/>';
$(document).ready(function() { 
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
}); 