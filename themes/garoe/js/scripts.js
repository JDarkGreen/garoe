
var j = jQuery.noConflict();

(function($){

	j(document).on('ready',function(){

		//##################### MENUS #######################//

		var main_menu     = j('nav.mainNav');
		var main_menu_pos = main_menu.offset().top;

		j(window).on('scroll', function(){
			if( j(this).scrollTop() > main_menu_pos ) {
				main_menu.css({position: 'fixed', top: '0px', 'z-index' : '999999'});
			}else{
				main_menu.css({position: 'static', top: '0px'});
			}
		});

		//##################### CAROUSELES #######################//

		//# Banner Home - libreria bootstrap #
		j('#carousel-banner-home').carousel({
			interval: 5000
		});






	});

})(jQuery)