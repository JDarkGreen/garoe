<?php
header('Content-type: text/css');
require '../../../wp-load.php';

/* Get Theme Options here and echo custom CSS */
$fra_options = forestAdmin::get_all_option();

if($fra_options['menu_font']){ ?>
@import url(http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", $fra_options['menu_font']) ?>);
<?php }
if($fra_options['content_font']){ ?>
@import url(http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", $fra_options['content_font']) ?>);
<?php }

if($fra_options['background']){ ?>
#wpwrap, body.login{
	background-image:url(<?php echo $fra_options['background'] ?>);
    background-attachment:fixed;
	background-size:cover;
}
<?php }
if($fra_options['darkness']){ ?>
#wpwrap:before, body.login:before{
	position:absolute;
	top:0;
	bottom:0;
	left:0;
	right:0;
	background: rgba(0,0,0,<?php echo $fra_options['darkness']/100 ?>);
	content:' ';
    z-index: -1;
}
<?php }
if($fra_options['main_color']){ ?>
#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, #adminmenu .wp-menu-arrow div,
.wp-core-ui .button-primary, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:hover, .wp-core-ui .button-primary.focus, .wp-core-ui .button-primary:focus,
.wrap .add-new-h2:hover,
.theme-browser .theme.add-new-theme:hover:after,
.tablenav .tablenav-pages a:hover, .tablenav .tablenav-pages a:focus{
	background: #<?php echo $fra_options['main_color'] ?>;
}
a:hover,
#adminmenu li:hover div.wp-menu-image:before,
#adminmenu a:hover, #adminmenu li.menu-top>a:focus, #adminmenu .wp-submenu a:hover, #rightnow a:hover, #media-upload a.del-link:hover, div.dashboard-widget-submit input:hover, .subsubsub a:hover, .subsubsub a.current:hover, .ui-tabs-nav a:hover,
.theme-browser .theme.add-new-theme:hover span:after,
.wrap div.updated a, .wrap div.error a, .media-upload-form div.error a,
#adminmenu .wp-submenu a:hover, #adminmenu .wp-submenu a:focus, #adminmenu .wp-has-current-submenu .wp-submenu a:hover, #adminmenu .wp-has-current-submenu .wp-submenu a:focus, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu a:hover, #adminmenu .wp-has-current-submenu .wp-submenu.sub-open a:hover, #adminmenu .wp-has-current-submenu .wp-submenu.sub-open a:focus, #adminmenu .wp-has-current-submenu.opensub .wp-submenu a:hover, #adminmenu .wp-has-current-submenu.opensub .wp-submenu a:focus, .no-js li.wp-has-current-submenu:hover .wp-submenu a:hover, .no-js li.wp-has-current-submenu:hover .wp-submenu a:focus, .folded #adminmenu a.wp-has-current-submenu:focus+.wp-submenu a:hover, .folded #adminmenu a.wp-has-current-submenu:focus+.wp-submenu a:focus, .folded #adminmenu .wp-has-current-submenu .wp-submenu a:hover, .folded #adminmenu .wp-has-current-submenu .wp-submenu a:focus, #collapse-menu:hover, #collapse-menu:hover #collapse-button div:after,
#wpadminbar .ab-top-menu>li>.ab-item:focus, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus, #wpadminbar .ab-top-menu>li:hover>.ab-item, #wpadminbar .ab-top-menu>li.hover>.ab-item,
#wpadminbar .quicklinks .menupop ul li a:hover, #wpadminbar .quicklinks .menupop ul li a:focus, #wpadminbar .quicklinks .menupop ul li a:hover strong, #wpadminbar .quicklinks .menupop ul li a:focus strong, #wpadminbar .quicklinks .menupop.hover ul li a:hover, #wpadminbar .quicklinks .menupop.hover ul li a:focus, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus, #wpadminbar li:hover .ab-icon:before, #wpadminbar li:hover .ab-item:before, #wpadminbar li a:focus .ab-icon:before, #wpadminbar li .ab-item:focus:before, #wpadminbar li.hover .ab-icon:before, #wpadminbar li.hover .ab-item:before, #wpadminbar li:hover #adminbarsearch:before,
#wpadminbar>#wp-toolbar li:hover span.ab-label, #wpadminbar>#wp-toolbar li.hover span.ab-label, #wpadminbar>#wp-toolbar a:focus span.ab-label,
.subsubsub a,
.login #nav a:hover, .login #backtoblog a:hover{
	color: #<?php echo $fra_options['main_color'] ?>;
}
.fra-icon-button a:hover{
	border: solid 1px #<?php echo $fra_options['main_color'] ?>;
	color:#<?php echo $fra_options['main_color'] ?>;
}
.wrap div.updated a.button-primary{
	color:#fff;
}
.contextual-help-tabs .active {
	border-color: #<?php echo $fra_options['main_color'] ?>;
}
<?php }
if($fra_options['link_color']){ ?>
a{
	color:#<?php echo $fra_options['link_color'] ?>;
}
<?php }
if($fra_options['menu_font']||$fra_options['menu_size']){ ?>
#adminmenuwrap, #adminmenu a.menu-top, #adminmenu .wp-submenu-head, #adminmenu .wp-submenu a{
	<?php if($fra_options['menu_font']){ ?>
	font-family: '<?php echo $fra_options['menu_font'] ?>', sans-serif;
    <?php } if($fra_options['menu_size']){ ?>
    font-size: <?php echo $fra_options['menu_size'] ?>px;
    <?php } ?>
}
<?php }
if($fra_options['content_font']||$fra_options['content_size']){ ?>
body, p, .postbox .inside, .stuffbox .inside, .wp-core-ui .button, .wp-core-ui .button-primary, .wp-core-ui .button-secondary {
	<?php if($fra_options['content_font']){ ?>
	font-family: '<?php echo $fra_options['content_font'] ?>', sans-serif;
    <?php } if($fra_options['content_size']){ ?>
    font-size: <?php echo $fra_options['content_size'] ?>px;
    <?php } ?>
}
<?php }
if($fra_options['panel_color']){ ?>
.fra-quick-panel, .fra-quick-panel h3, .fra-icon-button a, .fra-icon-button p{
	color:#<?php echo $fra_options['panel_color'] ?>;
}
<?php }
if($fra_options['panel_bg']||$fra_options['panel_opacity']){
$panel_bg = forestAdmin::hex2rgba($fra_options['panel_bg'],$fra_options['panel_opacity']);
?>
.fra-quick-panel:hover{
	background:rgba(<?php echo $panel_bg ?>);
}
<?php }

if($fra_options['login_logo']){ ?>
body.login div#login h1 a {
    background-image: url(<?php echo $fra_options['login_logo'] ?>);
    background-size: contain;
    width:<?php echo $fra_options['logo_w'] ?>px;
    height:<?php echo $fra_options['logo_h'] ?>px;
    <?php if($fra_options['logo_w']>320){ ?>
    margin-left:-<?php echo ($fra_options['logo_w']-320)/2 ?>px;
    <?php } ?>
}
<?php }
if($fra_options['login_bg']){ ?>
body.login{
	background-image:url(<?php echo $fra_options['login_bg'] ?>);
}
<?php }
if($fra_options['hide_forest']){ ?>
li.menu-top.toplevel_page_fra_settings{
	display:none;
}
<?php }
//custom CSS
if($fra_options['custom_css']){
	echo $fra_options['custom_css'];
}