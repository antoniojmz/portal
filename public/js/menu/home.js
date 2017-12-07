var object = [];
var countObject=0;
var countObject2=0;
$(document).ready(function(){
	switch(d['v_perfil']) {
    case "1":
        console.log("Soy administrador home");
        break;
    case "2":
        console.log("Soy cliente home");
        break;
    case "3":
        console.log("Soy prveedor home");
		if (d['v_nombres'].length > 2){
			var res = d['v_nombres'].replace("[", "");
			res = res.replace("]", "");
			res = res.split(",");
			$.each(res, function( key, value ) {
			  	$('div#'+value).expander({
			    	slicePoint: 400,
			    	widow: 2,
			    	expandSpeed: 0,
						expandText: '<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">Leer mas...</button><br />',
			    	userCollapseText: '<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">Leer menos...</button><br />'
			  	});
			});
		}
        break;
	}	
});