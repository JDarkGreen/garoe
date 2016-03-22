
var j = jQuery.noConflict();

(function($){

	j(document).on('ready',function(){

		//##################### MENUS #######################//

		var main_menu     = j('nav.mainNav');
		var main_menu_pos = main_menu.offset().top;

		j(window).on('scroll', function(){
			if( j(this).scrollTop() > main_menu_pos ) {
				main_menu.css({position: 'fixed', top: '0px', 'z-index' : '99'});
			}else{
				main_menu.css({position: 'static', top: '0px'});
			}
		});

		//##################### CAROUSELES #######################//

		//# Banner Home - libreria bootstrap #
		j('#carousel-banner-home').carousel({
			interval: 5000
		});

		/****************** GALERIA  ************************/
		//Imagenes en la seccion servicios
		j("a.grouped_elements").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	false
		});

		//##################### VALIDACION  #######################//

		j('#register').submit(function(e) {
            e.preventDefault();
        }).validate({
            debug: false,
            rules: {
                "garoe_name": {
                    minlength: 4,
                },
                "garoe_lastname": {
                    minlength: 4,
                },
                "garoe_message": {
                    minlength: 10,
                }
            },
            messages: {
                "garoe_name": {
                    required: "Introduce tus nombres.",
                    minlength: "Debe contener al menos 4 caracteres.",
                },
                "garoe_lastname": {
                    required: "Introduce tus apellidos.",
                    minlength: "Debe contener al menos 4 caracteres.",
                },
                "garoe_email": {
                    required: "Introduce tu email.",
                    email   : "Introduce un email válido",
                },
                "garoe_message": {
                    required: "Introduce tu mensaje.",
                    minlength: "Debe contener al menos 10 caracteres.",
                },
            }
        });






	});

})(jQuery)