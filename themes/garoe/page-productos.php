<?php /* Template Name: Página Productos Plantilla */ ?>


<!-- Header -->
<?php get_header(); ?>

<!-- Seccion de Contenido principal -->
<main class="mainContent main-wrapper">

	<!-- Seccion de presentacion -->
	<section class="mainContent__container">
		<h2 class="mainContent__container__title"><?php _e('Nuestros Productos: ', 'garoe-frameworks' ); ?></h2>

		<!-- GALERIA DE PRODUCTOS  -->
		<?php 
			//query
			$args = array(
				'order'          => 'ASC',
				'orderby'        => 'menu_order',
				'post_type'      => 'product',
				'posts_per_page' => -1
			);

			$productos = get_posts( $args ); #var_dump($productos);
		?>
		<!-- contenedor de la galería de productos -->
		<section class="sectionProducts__gallery col-xs-8">
			<?php foreach ($productos as $producto ): ?>
				<article class="article-producto col-xs-4">
					<a href="<?= $producto->guid ?>" class="article-producto__link">
						<!-- Image -->
						<figure class="article-producto__image">
							<?php  
								$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $producto->ID ), 'full' );
								$url_image = $thumb[0];
								if( !empty($url_image) ) :
							?>
							<img src="<?= $url_image ?>" alt="<?= $producto->post_title ?>" class="img-responsive" />
							<?php endif; ?>

							<!-- Span oscurece la image -->
							<span class="figure-layout"></span>
						</figure><!-- /.article-producto__image -->
						<!-- Title -->
						<h2 class="article-producto__title"><?= $producto->post_title ?></h2>
					</a> <!-- /.rticle-producto__link -->
				</article><!-- /.article-producto -->
			<?php endforeach ?>
		</section> <!-- /.sectionProducts__gallery col-xs-8 -->

		<!-- Barra lateral con las categorias de los productos -->
		<aside class="sectionProducts__categories col-xs-4">

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