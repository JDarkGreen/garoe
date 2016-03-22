<?php /* Template Name: Página Servicios Plantilla */ ?>

<!-- Header -->
<?php get_header(); ?>

<!-- Incluir seccion de banner -->
<?php  
	$terms = "servicios"; //el termino a pasar

	//template
	include(locate_template('content-banner.php'));
?>

<!-- Seccion de Contenido principal -->
<main class="mainContent main-wrapper">
	
	<!-- Seccion de presentacion -->
	<section class="mainContent__container">
		<!-- Titulo -->
		<h2 class="mainContent__container__title text-center"><?php _e( 'Nuestros Servicios' , 'garoe-framework' ); ?></h2>

		<!-- Contenedor de servicios  -->
		<section class="mainContent__containerService">
			<!-- THE QUERY -->
			<?php  
				$args = array(
					'order'    => 'ASC',
					'orderby'  => 'menu_order',
					'post_type'=> 'servicio',
				);

				$query = new WP_Query( $args );

				$number_post = $query->found_posts; //numero total de posts

				//variable control
				$i = 0;

				if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
			?>
				<!-- Artículos -->
				<article class="mainContent__containerService__article">
					<!-- Imagen -->
					<figure style="order:<?= $i%2 == 0 ? '0' : '1' ?>">
						<?php has_post_thumbnail() ? the_post_thumbnail('full', array('class'=>'img-responsive') ) : '' ; ?>
					</figure>
					<!-- Texto -->
					<div class="mainContent__containerService__article__text">
						<!-- titulo -->
						<h2 class="text-uppercase"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div> <!-- /.mainContent__containerService__article__text -->

				</article> <!-- /.mainContent__containerService__article -->

				<!-- Linea separacion -->
				<?php if( $i+1 != $number_post ) : ?>
				<span class="separator-line"></span>
				<?php endif; ?>

			<?php $i++; endwhile; wp_reset_postdata(); endif; ?> <!-- /end query -->

		</section><!-- /.mainContent__containerService -->

	</section> <!-- /.mainContent__container -->

</main> <!-- /. mainContent main-wrapper-->

<!-- Sidebar prefooter -->
<aside class="sidebarPreFooter main-wrapper">
	<!-- Sidebar prefooter  -->
	<?php get_sidebar('pre-footer'); ?>
</aside> <!-- /.sidebarPreFooter -->

<!-- Footer -->
<?php get_footer(); ?>