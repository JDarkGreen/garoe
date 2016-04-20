
<!-- Header -->
<?php get_header(); 
	global $post; #var_dump($post);
?>

<!-- Seccion de Contenido principal -->
<main class="mainContent main-wrapper">

	<!-- Seccion de presentacion -->
	<section class="mainContent__container">
		<h2 class="mainContent__container__title"><?php _e( $post->post_title , 'garoe-framework' ); ?></h2>

		<!-- Boton ver más articulos solo visible en mobile - abre menu de navegacion lateral derecho -->
		<a href="#" class="btn-more-to-aside-right text-uppercase visible-xs-inline-block js-toggle-right" data-section="section-categories-blog">
			<?php _e('ver más artículos' , 'garoe-framework' ); ?>
		</a> <!-- /.btn-more-to-aside-right -->


		<!-- contenedor de la galería de productos -->
		<section class="sectionBlogPage col-xs-12 col-sm-8">

			<!-- Datos del Post -->
			<p class="mainContent__container__info-post"><small><em>
				<span class="pull-left"><?= mysql2date('M j, Y', $post->post_date) ?></span>
				<span class="pull-right">
					<?php 
						$autor = get_the_author_meta( 'user_nicename' , $post->post_author );
						_e('Por:' . $autor ,'garoe-framework'); ?>
				</span>
				<!-- Clearfix --><span class="clearfix"></span> </em></small>
			</p>

			<article class="sectionBlogPage__main-article">
				<!-- Image -->
				<figure class="sectionBlogPage__article__main-image">
					<?php  
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						$url_image = $thumb[0];
						if( !empty($url_image) ) :
					?>
					<img src="<?= $url_image ?>" alt="<?= $post->post_title ?>" class="img-responsive" />
					<?php else: ?>
						<img class="img-responsive" src="http://lorempixel.com/980/600" alt="" />
					<?php endif; ?>

				</figure><!-- /.article-producto__main-image -->

				<!-- Texto  -->
				<br/>
				<div class="sectionBlogPage__article__text text-justify">
					<?= apply_filters('the_content', $post->post_content); ?>
				</div> <!-- /.sectionBlogPage__article__text -->

			</article><!-- /.sectionBlogPage__main-article -->
		</section> <!-- /.sectionProducts__gallery col-xs-12 col-sm-8 -->

		<!-- Barra lateral con las categorias de los productos -->
		<aside class="sectionBlog__categories col-xs-4 hidden-xs">

			<!-- Incluir template categorias -->
			<?php include( locate_template('partials/content-category-post.php') ) ?>

		</aside><!-- /.sectionProducts__categories col-xs-4 hidden-xs -->

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