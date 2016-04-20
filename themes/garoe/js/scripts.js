
var j = jQuery.noConflict();

(function($){

	j(document).on('ready',function(){

    //##################### LIBRERIA SLIDEBAR VERSION MOBILE  ####################//
    var mySlidebars = new j.slidebars({
      siteClose         : true, // true or false
      disableOver       : 480, // integer or false
      hideControlClasses: true, // true or false
      scrollLock        : false // true or false
    });

    //Abrir con el boton de navegacion
    j("#btn-toggle-menu-left").on('click',function(){
      //abrir slidebar
      mySlidebars.slidebars.toggle('left');
      //cambiar clase
      if( j(this).hasClass('glyphicon-th-list') ){ 
        j(this).removeClass('glyphicon-th-list').addClass('glyphicon-screenshot'); 
      }else{
        j(this).removeClass('glyphicon-screenshot').addClass('glyphicon-th-list'); 
      }

    });

    //##################### LIBRERIA SLIDEBAR VERSION MOBILE  ####################//
    // ============>>>> Nota: segun el atributo seccion del boton , muestra el contenido
    // si es un producto o si es un articulo de blog 
    j(".js-toggle-right").on('click',function(e){
      //prevenir evento por defecto
      e.preventDefault();

      //CAPTURAR SECCION A MOSTRAR POR ATRIBUTO
      var open_section = j(this).attr('data-section');
      //ocultar todas las secciones de la barra lateral derecha 
      j(".sidebarMobile__content").addClass('hide');

      //mostrar la seccion
      j("#"+open_section).removeClass('hide');

      //abrir slidebar lateral derecho 
      mySlidebars.slidebars.toggle('right');

    });


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