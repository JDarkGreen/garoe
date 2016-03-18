<?php 
/*
	Template Name: Testimonios Page
*/
?>

<!-- Header -->
<?php get_header(); ?>

<!-- Seccion de Contenido principal -->
<main class="mainContent main-wrapper">

	<!-- Seccion de presentacion -->
	<section class="mainContent__container">
		<h2 class="mainContent__container__title"><?= the_title() ?></h2>

		<!-- GALERPIA DE TESTIMONIOS -->
		<?php 
			//the query 
			$args = array(
				'post_type' => 'testimonio'
			);

			$the_query = new Wp_Query($args);

			//si tiene posts 
			if( $the_query->have_posts() ) :
		?>
		<section class="mainContent__gallery">
			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<article class="mainContent__gallery__article text-center">
					<!-- video -->
					<?php  
						$video = get_post_meta( get_the_id() , 'mb_garoe_url_video_text' , true ); 
						if ( !empty($video) ) :
							$video = str_replace("watch?v=", "embed/", $video );
					?>
						<iframe width="100%" height="200" src="<?= $video; ?>" allowfullscreen></iframe>
					<?php endif; ?>
					<!-- titulo -->
					<h3> <?php the_title(); ?> </h3>
				</article> <!-- /.mainContent__gallery__article -->
			<?php endwhile; ?>
		</section><!-- /.mainContent__gallery -->
		
		<!-- Seccion Citas y comentarios -->
		<h2 class="mainContent__container__title text-left"><?php _e('Qué dicen nuestros clientes','garoe-framework'); ?></h2>
		<section class="mainContent__quote">
			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<!-- blockquote  -->
				<blockquote class="mainContent__quote__blockquote">
					<!-- Imagen  -->
					<?php if( has_post_thumbnail() ) : ?>
						<figure><?php the_post_thumbnail('full',array('class'=>'img-responsive')); ?></figure>
						<div class="separator"></div> <!-- /separator -->
					<?php else: ?>
						<figure><img src="<?= IMAGES ?>/user.jpg" alt="user" class="img-responsive"></figure>
					<?php endif; ?>
					<!-- Cita -->
					<p><?= ucfirst( get_the_content() ); ?></p>
  					<small>Frase célebre de <cite title="Nombre Apellidos">Nombre Apellidos</cite></small>
				</blockquote>
			<?php endwhile;  ?>
		</section> <!-- /.mainContent__quote -->
		
		<?php endif; wp_reset_postdata(); ?>
	
	</section> <!-- /.mainContent__container -->

</main> <!-- /.mainContent main-wrapper -->

<!-- Sidebar prefooter -->
<aside class="sidebarPreFooter main-wrapper">
	<!-- Sidebar prefooter  -->
	<?php get_sidebar('pre-footer'); ?>
</aside> <!-- /.sidebarPreFooter -->


<!-- Footer -->
<?php get_footer(); ?>