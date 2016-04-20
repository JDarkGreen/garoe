<!-- Header -->
<?php get_header(); ?>

<!-- Incluir seccion de banner -->
<?php  
	$terms = ""; //el termino a pasar

	if( is_front_page() ){  
		$terms = 'home';
	} else { 
		$terms = strtolower( get_the_title() );
	}

	//template
	include(locate_template('content-banner.php'));
?>


<!-- Seccion de Contenido principal -->
<main class="mainContent main-wrapper">
	
	<!-- Seccion de presentacion -->
	<section class="mainContent__container">
		<h2 class="mainContent__container__title"><?= the_title() ?></h2>
		<article class="mainContent__container__article">
			<div class="mainContent__container__article__text">
				<?= the_content();  ?>
			</div> <!-- /.mainContent__container__article__text -->
			<!-- Imagen -->
			<figure>
				<?= has_post_thumbnail() ? the_post_thumbnail() : '' ?>
			</figure>
		</article> <!-- /.mainContent__container__article-->
	</section> <!-- /.mainContent__container -->
	
	<!-- Si es la página principal -->
	<?php if( is_front_page() ) : ?>

	<!-- Seccion WOOCOMMERCE -->
	<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
	<section class="productsContent">
		<!-- titulo de la seccion -->
		<h2 class="productsContent__title text-capitalize"><?php _e('Nuestros Productos','garoe-framework'); ?></h2>
		<!-- Contenedor de articulos -->
		<div class="productsContent__productos">
			<!-- Consulta de los ultimos productos  -->
			<?php  
				$args = array(
					'post_type'     => 'product',
					'post_per_page' => 8
				);

				$the_query = new WP_Query($args);

				if( $the_query->have_posts() ) :
				while( $the_query->have_posts() ) : $the_query->the_post();
			?>

			<article class="productsContent__product text-center">
				<!-- Imagen del producto -->
				<figure>
					<?php 
						if( has_post_thumbnail() ) :
							the_post_thumbnail( 'full' , array('class'=>'img-responsive center-block') );
						else:
					?>
					<img src="http://lorempixel.com/163/99" alt="<?php the_title()  ?>" />
					<?php endif; ?>
					<!-- Logo de oferta -->
					<?php 
						$oferta = get_post_meta( get_the_ID() , 'mb_garoe_prom_product', true ); 
						//si está activa la oferta o promoción
						if( $oferta == "on" ) :
					?>
						<!-- Span Añade la oferta imagen-->
						<span class="oferta-img-product"></span><!-- /oferta-img-product -->
					<?php endif; ?>
				</figure> <!-- /figure -->
				<!-- Nombre del producto  -->
				<h3><?php the_title(); ?></h3> 
				<!-- Ver más -->
				<a href="<?php the_permalink() ?>"><?php _e('ver detalles','garoe-framework'); ?></a>
			</article><!-- /.productsContent__product -->

			<?php endwhile; wp_reset_postdata(); endif; ?>
			
		</div> <!-- /. productsContent__productos-->
	</section> <!-- /.productsContent -->
	<?php else: ?>
		<p><?php _e('Actualizando...','garoe-framework'); ?></p>
	<!-- Fin si esta activado woocommerce -->
	<?php endif; ?>
	
	<!-- Fin de si es pagina principal -->
	<?php endif; ?>

	
</main> <!-- /.mainContent -->

<!-- Sidebar prefooter -->
<aside class="sidebarPreFooter main-wrapper">
	<!-- Sidebar prefooter  -->
	<?php get_sidebar('pre-footer'); ?>
</aside> <!-- /.sidebarPreFooter -->


<!-- Footer -->
<?php get_footer(); ?>