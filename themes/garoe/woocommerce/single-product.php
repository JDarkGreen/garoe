
<!-- Header -->
<?php get_header(); 
	global $post; 

	//almacenar id de categorias del producto
	$cats_product = array();
	$post_categories = wp_get_post_terms( $post->ID, 'product_cat' ); #var_dump($post_categories);

	foreach ($post_categories as $post_cat ) {
		array_push( $cats_product , $post_cat->term_id );
	}
?>

<!-- Seccion de Contenido principal -->
<main class="mainContent main-wrapper">

	<!-- Seccion de presentacion -->
	<section class="mainContent__container">
		<h2 class="mainContent__container__title text-capitalize"><?= $post->post_title ?></h2>

		<!-- Boton ver más articulos solo visible en mobile - abre menu de navegacion lateral derecho -->
		<a href="#" class="btn-more-to-aside-right text-uppercase visible-xs-inline-block js-toggle-right" data-section="section-categories-product">
			<?php _e('ver más productos' , 'garoe-framework' ); ?>
		</a> <!-- /.btn-more-to-aside-right -->

		<!-- contenedor de la galería de productos -->
		<section class="sectionProducts__gallery col-xs-12 col-sm-8">
			<!-- Imagen del Producto -->
			<?php $thumb = get_the_post_thumbnail($post->ID ,'full', array('class'=>'img-responsive') ); 
				if ( !empty( $thumb ) ) :
			?>
			<figure class="mainArticleProduct__image">
				<!-- Mostrar la imagen -->
				<?= $thumb; ?>

				<?php 
					$oferta = get_post_meta( $post->ID , 'mb_garoe_prom_product', true ); 
					//si está activa la oferta o promoción
					if( $oferta == "on" ) :
				?>
					<!-- Span Añade la oferta imagen-->
					<span class="oferta-img-product"></span><!-- /oferta-img-product -->
				<?php endif; ?>

			</figure><!-- /.mainArticleProduct__image -->
			<?php endif; ?>

			<!-- Descripción  -->
			<h3 class="mainArticleProduct__subtitle"><?php _e('Descripción del Producto: ','garoe-framework'); ?></h3>
			<div class="mainArticleProduct__text text-justify">
				<?= $post->post_content; ?>
			</div><!-- /.text-justify -->

			<!-- Sección Productos relacionados -->
			<section class="mainArticleProduct__related">
				<h3 class="mainArticleProduct__subtitle"><?php _e('Productos Relacionados: ','garoe-framework'); ?></h3>

				<?php  
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => -1,
						'post__not_in'   => array( $post->ID ),
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'term_id',
								'terms'    => $cats_product,
							),
						),
					);
					//posts
					$related = get_posts( $args ); #var_dump($related);

					foreach ($related as $producto ): 
				?>
					<article class="article-producto col-xs-12 col-sm-4">
						<a href="<?= $producto->guid ?>" class="article-producto__link">
							<!-- Image -->
							<figure class="article-producto__image">
								<?php
									$thumb = get_the_post_thumbnail( $producto->ID ,'full', array('class'=>'img-responsive') ); 
									if ( !empty( $thumb ) ){
										echo $thumb;
									}
								?>

								<?php 
									$oferta = get_post_meta( $producto->ID , 'mb_garoe_prom_product', true ); 

									//si está activa la oferta o promoción
									if( $oferta == "on" ) :
								?>
									<!-- Span Añade la oferta imagen-->
									<span class="oferta-img-product"></span><!-- /oferta-img-product -->
								<?php endif; ?>

								<!-- Span oscurece la image -->
								<span class="figure-layout"></span>
							</figure><!-- /.article-producto__image -->
							<!-- Title -->
							<h2 class="article-producto__title"><?= $producto->post_title ?></h2>
						</a> <!-- /.rticle-producto__link -->
					</article><!-- /.article-producto -->
				<?php endforeach ?>

				<!-- Cleafix --> <div class="clearfix"></div>
			</section><!-- /.mainArticleProduct__related -->

		</section> <!-- /.sectionProducts__gallery col-xs-8 -->

		<!-- Barra lateral con las categorias de los productos -->
		<aside class="sectionProducts__categories col-xs-4 hidden-xs">
			
			<!-- Incluir template categorias -->
			<?php include( locate_template('partials/content-category-product.php') ) ?>

		</aside><!-- /.sectionProducts__categories col-xs-4 -->

		<!-- Clearfix --> <div class="clearfix"></div>
	
	</section> <!-- /.mainContent__container -->

</main> <!-- /.mainContent main-wrapper -->

<!-- Sidebar prefooter -->
<aside class="sidebarPreFooter main-wrapper">
	<!-- Sidebar prefooter  -->
	<?php get_sidebar('pre-footer'); ?>
</aside> <!-- /.sidebarPreFooter -->


<!-- Footer -->
<?php get_footer(); ?>