<?php /* Template Name: Página Contacto Plantilla */ ?>

<!-- Header -->
<?php get_header(); ?>

<!-- Incluir seccion de banner -->
<?php  
	$terms = "home"; //el termino a pasar

	//template
	include(locate_template('content-banner.php'));
?>


<?php $options = get_option('garoe_custom_settings'); ?>

<!-- Seccion de Contenido principal -->
<main class="mainContent main-wrapper">
	<!-- Seccion de presentacion -->
	<section class="mainContent__container">
		<!-- Titulo -->
		<h2 class="mainContent__container__title text-center"><?php _e( 'Contáctanos' , 'garoe-framework' ); ?></h2>

		<!-- Contenedor de contacto  -->
		<section class="mainContent__containerContacto">
			<!-- Primera Parte Datos  -->
			<section class="mainContent__containerContacto__info">
				<!-- Datos -->
				<article class="info-item">
					<!-- Titulo -->
					<h2 class="text-capitalize center-block text-left"><?php _e( 'Detalles de Contacto' , 'garoe-framework' ); ?></h2>
					<!-- Imagen -->
					<figure class="image_icono_arbol pull-left"><img src="<?= IMAGES ?>/tree_contacto.png" alt="contacto" class="img-responsive"></figure> <!-- /pull-left -->
					<!-- Direccion -->
					<?php $contacto = $options['contact_address']; if( !empty($contacto) ) : ?>
						<p><?= $contacto ?></p>
					<?php endif; ?>
				</article> <!-- /.info-item -->
				<article class="info-item">
					<!-- email  -->
					<?php $mail = $options['contact_email']; if( !empty($mail) ) : ?>
						<p><i class="glyphicon glyphicon-envelope"></i>	<?= $mail; ?></p>
					<?php endif; ?>
					<!-- celular  -->
					<?php $cel = $options['contact_cel']; if( !empty($cel) ) : ?>
						<p><i class="glyphicon glyphicon-phone"></i> <?= $cel; ?></p>
					<?php endif; ?>
					<!-- telefono  -->
					<?php $tel = $options['contact_tel']; if( !empty($tel) ) : ?>
						<p><i class="glyphicon glyphicon-phone-alt"></i> <?= $tel; ?></p>
					<?php endif; ?>
				</article> <!-- /.info-item -->
				<article class="info-item">
					<?php $url_img_contacto = $options['image_contacto']; if( !empty($url_img_contacto) ) : ?>
						<figure class="image_contact">
							<img src="<?= $url_img_contacto ?>" alt="images-contacto" class="img-responsive" />
						</figure> <!-- /.image_contact -->
					<?php endif; ?>
				</article> <!-- /.info-item -->
			</section><!-- /.mainContent__containerContacto__info -->

			<!-- Linea de separacion -->
			<span class="separator-line"></span>
			<div class="clearfix"></div>

			<!-- Seccion de formulario -->
			<form id="register" method="post" action="javascript:void(0)" class="mainContent__containerContacto__form">
				<!-- Nombre -->
				<div class="form-group">
					<label for="garoe_name">Nombres<i>*</i></label>
					<input type="text" id="garoe_name" name="garoe_name" placeholder="Escribe tus nombres" required />
				</div><!-- /.form-group -->
				<!-- Apellidos -->
				<div class="form-group">
					<label for="garoe_lastname">Apellidos<i>*</i></label>
					<input type="text" id="garoe_lastname" name="garoe_lastname" placeholder="Escribe tus apellidos"required />
				</div><!-- /.form-group -->
				<!-- Email -->
				<div class="form-group">
					<label for="garoe_email">Email<i>*</i></label>
					<input type="email" id="garoe_email" name="garoe_email" placeholder="Escribe tu email" required />
				</div><!-- /.form-group -->
				<!-- Mensaje -->
				<div class="form-group">
					<label for="garoe_message">Mensaje<i>*</i></label>
					<textarea name="garoe_message" id="garoe_message" placeholder="Escribe tu mensaje" required></textarea>
				</div><!-- /.form-group -->
				<!-- Button -->
				<div class="form-group">
					<label for="" class="hidden-xs"></label>
					<button type="submit" class="text-uppercase"><?php _e( 'enviar' , 'garoe-framework' ); ?></button>
				</div><!-- /.form-group -->

			</form><!-- /.mainContent__containerContacto__form -->

		</section> <!-- /.mainContent__containerContacto -->

	</section> <!-- /. mainContent__container -->
</main> <!-- /.mainContent main-wrapper -->

<!-- Sidebar prefooter -->
<aside class="sidebarPreFooter main-wrapper">
	<!-- Sidebar prefooter  -->
	<?php get_sidebar('pre-footer'); ?>
</aside> <!-- /.sidebarPreFooter -->

<!-- Footer -->
<?php get_footer(); ?>