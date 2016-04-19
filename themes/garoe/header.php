<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="author" content="">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Google Web Font -->
	<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet'>

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	
	<!-- Pingbacks -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicon and Apple Icons -->
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php $options = get_option('garoe_custom_settings'); ?>
	
	<!-- HEADER PRINCIPAL  -->
	<header class="mainHeader hidden-xs">

		<section class="mainHeader__pre-container main-wrapper main-wrapper--align-center">
			<div class="main-wrapper__middle">
				<!-- Logo -->
				<h1 class="logo">
					<?php $options['logo'] == '' ? $logo = IMAGES . '/logo.png' : $logo = $options['logo']; ?>
					<a class="logo__container" href="<?= home_url(); ?>">
						<img class="img-responsive" src="<?= $logo; ?>" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>" />
					</a>
				</h1>
			</div>
			<div class="main-wrapper__middle">
				<section class="mainHeader__widget-info text-right">
					<!-- Telefonos -->
					<p class="text-phone--green">
						<?= !empty($options['contact_tel']) ? "Tel.: " . $options['contact_tel'] : '' ?>
						<?= !empty($options['contact_cel']) ? " Cel.: " . $options['contact_cel'] : '' ?>
					</p>
					<!-- Correo -->
					<p class="text-email--red">
						<?= !empty($options['contact_email']) ? $options['contact_email'] : get_option( 'admin_email' ); ?> 
					</p>
				</section>
			</div>
			<div class="clearfix"></div>
		</section> <!-- /main-wrapper -->
		
		<!-- MENU DE NAVEGACION PRINCIPAL  -->
		<nav class="mainNav">
			<div class="main-wrapper">
				
			<?php wp_nav_menu(
				array(
					'theme_location' => 'main-menu'
				));
			?>
			</div> <!-- /main-wrapper -->
		</nav> <!-- /.mainNav -->

	</header> <!-- /.mainHeader -->

	<!-- HEADER MOBILE solo visible en mobiles  -->
	<header class="mainHeader__small visible-xs-block sb-slide">
		<!-- Icono abrir menu de navegación -->
		<span id="btn-toggle-menu-left" class="icon-header pull-left glyphicon glyphicon-th-list"></span>
		<!-- Logo Centrado -->
		<h1 class="logo">
			<?php $options['logo'] == '' ? $logo = IMAGES . '/logo.png' : $logo = $options['logo']; ?>
			<a class="logo__container" href="<?= home_url(); ?>">
				<img class="img-responsive" src="<?= $logo; ?>" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>" />
			</a>
		</h1> <!-- /logo -->		 
	</header><!-- /.mainHeader__small -->


	<!-- ASIDE BARRA SOLO MOBILE libreria slidebar-->
	<aside class="sidebarMobile sb-slidebar sb-left">
  	<!-- Your left Slidebar content. -->
  	<!-- Logo -->
		<h1 class="logo">
			<?php $options['logo'] == '' ? $logo = IMAGES . '/logo.png' : $logo = $options['logo']; ?>
			<a class="logo__container" href="<?= home_url(); ?>">
				<img class="img-responsive" src="<?= $logo; ?>" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>" />
			</a>
		</h1> <!-- /logo -->

		<!-- MENU DE NAVEGACION PRINCIPAL  -->
		<nav class="mainNav">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'main-menu'
				));
			?>
		</nav> <!-- /.mainNav -->

	</aside> <!-- /.sidebarMobile sb-slidebar sb-left -->


	<!-- Inicio de Contenedor responsive Design libreria slidebar -->
	<div id="sb-site">