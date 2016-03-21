
<?php $options = get_option('garoe_custom_settings'); ?>

	<footer class="mainFooter">
		
		<!-- Contenedor -->
		<section class="main-wrapper">
			<article class="mainFooter__content__item">
				<h2 class="text-uppercase"><?php _e( 'garoe sanación' , 'garoe-framework' ); ?></h2>
				
				<div class="item__text">
					<?php $contenido_nosotros = $options['widget_nosotros']; 
						echo $contenido_nosotros;
					?>
				</div> <!-- /.item__Text -->

				<figure class="item__figure">
					
				</figure> <!-- /.item__figure -->

			</article> <!-- /.mainFooter__content__item -->

			<article class="mainFooter__content__item"></article>
			<article class="mainFooter__content__item"></article>
		</section> <!-- /main-wrapper -->

	</footer> <!-- /.mainFooter -->
	
	<?php wp_footer(); ?>

</body>
</html>