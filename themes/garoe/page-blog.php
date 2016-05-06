<?php /* Template Name: Página Blog Plantilla */ ?>


<!-- Header -->
<?php get_header(); ?>

<!-- Seccion de Contenido principal -->
<main class="mainContent main-wrapper">

	<!-- Seccion de presentacion -->
	<section class="mainContent__container">
		<h2 class="mainContent__container__title"><?php _e('Nuestro Blog: ', 'garoe-framework' ); ?></h2>
		
		<?php /*  
			<p><?php _e('Estos son nuestros artículos', 'garoe-framework' ); ?></p>
			*/
		?>

		<!-- ARTICULOS  -->
		<?php 
			//query
			$args = array(
				'order'          => 'ASC',
				'orderby'        => 'menu_order',
				'post_type'      => 'post',
				'posts_per_page' => -1
			);

			$all_posts = get_posts( $args ); #var_dump($articulos);
		?>

		<!-- Boton ver más articulos solo visible en mobile - abre menu de navegacion lateral derecho -->
		<a href="#" class="btn-more-to-aside-right text-uppercase visible-xs-inline-block js-toggle-right" data-section="section-categories-blog">
			<?php _e('ver más artículos' , 'garoe-framework' ); ?>
		</a> <!-- /.btn-more-to-aside-right -->

		<!-- contenedor de la galería de productos -->
		<section class="sectionBlogPage col-xs-12 col-sm-8">
			<div class="row">
			<?php foreach ($all_posts as $articulo ): ?>
				<article class="sectionBlogPage__article col-xs-12">
					<a href="<?= $articulo->guid ?>" class="sectionBlogPage__article__link">

						<!-- Image -->
						<figure class="sectionBlogPage__article__image pull-left">
							<?php  
								$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $articulo->ID ), 'full' );
								$url_image = $thumb[0];
								if( !empty($url_image) ) :
							?>
							<img src="<?= $url_image ?>" alt="<?= $articulo->post_title ?>" class="img-responsive" />
							<?php else: ?>
								<img class="img-responsive" src="http://lorempixel.com/980/600" alt="" />
							<?php endif; ?>

						</figure><!-- /.article-producto__image -->

						<!-- Title -->
						<h2 class="sectionBlogPage__article__title"><?= $articulo->post_title ?></h2>
						<!-- Extracto -->
						<p class="sectionBlogPage__article__text">
							<?php 
								$contenido = $articulo->post_content; 
								$contenido = preg_replace( '/\s+?(\S+)?$/' , '' , substr( $contenido , 0 , 150 ) );
								echo $contenido . "...";
							?>
							<a class="link-to-post" href="<?= $articulo->guid ?>">Leer más</a> <!-- btn more -->
						</p> 

						<!-- Limpiar Floats --> <span class="clearfix"></span>				
					</a> <!-- /.rticle-producto__link -->
				</article><!-- /.article-producto -->
			<?php endforeach ?>
			</div> <!-- /.row -->
		</section> <!-- /.sectionProducts__gallery col-xs-8 -->

		<!-- Barra lateral con las categorias de los productos -->
		<aside class="sectionBlog__categories col-xs-4 hidden-xs">

			<!-- Incluir template categorias -->
			<?php include( locate_template('partials/content-category-post.php') ) ?>

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