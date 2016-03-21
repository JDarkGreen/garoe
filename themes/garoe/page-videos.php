<?php 
/*
	Template Name: Página de Video Plantilla
*/
?>

<!-- Header -->
<?php get_header(); ?>

<!-- Seccion de Contenido principal -->
<main class="mainContent main-wrapper">

	<!-- Seccion de presentacion -->
	<section class="mainContent__container">
		<!-- Titulo -->
		<h2 class="mainContent__container__title"><?php _e('Galería de Videos', 'garoe-frameworks' ); ?></h2>

		<!-- GALERPIA DE VIDEOS -->
		<?php 
			//query
			$args = array(
				'order'          => 'ASC',
				'orderby'        => 'menu_order',
				'post_type'      => 'galeria-video',
				'posts_per_page' => -1
			);

			$the_query = new WP_Query($args);

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