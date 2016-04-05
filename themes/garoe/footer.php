
<?php $options = get_option('garoe_custom_settings'); ?>

	<footer class="mainFooter">
		
		<!-- Contenedor -->
		<section class="main-wrapper mainFooter__content">
			<article class="mainFooter__content__item mainFooter__content__item--nosotros">
				<!-- Title -->
				<h2 class="text-uppercase"><?php _e( 'garoe sanación' , 'garoe-framework' ); ?></h2>
				
				<div class="item-flexbox">
					<div class="item__text">
						<?php $contenido_nosotros = $options['widget_nosotros']; if( !empty($contenido_nosotros) ) : ?>
							<p class="text-justify"><?= $contenido_nosotros; ?></p>
						<?php endif; ?>
					</div> <!-- /.item__Text -->

					<figure class="item__figure">
						<?php $image_nosotros = $options['image_nosotros']; 
							if( !empty($image_nosotros) ) :
						?>
							<img src="<?= $image_nosotros; ?>" alt="nosotros-garoe" class="img-responsive" />
						<?php endif; ?>
					</figure> <!-- /.item__figure -->
					
				</div><!-- /.item-flexbox -->

			</article> <!-- /.mainFooter__content__item -->
			
			<!-- Redes Sociales -->
			<article class="mainFooter__content__item mainFooter__content__item--sociales">
				<div class="">
					<!-- Titulo  -->
					<h2 class="text-uppercase text-center"><?php _e( 'Redes Sociales' , 'garoe-framework' ); ?></h2>

					<!-- Contenedor -->
					<div class="item-centrado">
						<?php $facebook = $options['red_social_fb']; if( !empty($facebook) ) : ?>
							<a href="<?= $facebook ?>" target="_blank">
								<img src="<?= IMAGES ?>/redes-sociales/facebook.png" alt="facebook" class="img-responsive" />
							</a><!-- /a - facebook -->
						<?php endif; ?>
						<?php $youtube = $options['red_social_ytube']; if( !empty($youtube) ) : ?>
							<a href="<?= $youtube ?>" target="_blank">
								<img src="<?= IMAGES ?>/redes-sociales/youtube.png" alt="youtube" class="img-responsive" />
							</a><!-- /a - youtiube -->
						<?php endif; ?>
						<?php $twitter = $options['red_social_twitter']; if( !empty($twitter) ) : ?>
							<a href="<?= $twitter ?>" target="_blank">
								<img src="<?= IMAGES ?>/redes-sociales/twitter.png" alt="twitter" class="img-responsive" />
							</a><!-- /a - twitter -->
						<?php endif; ?>
					</div> <!-- /.item-centrado -->
				</div> <!-- /. -->
			</article>

			<!-- Sección de Información -->
			<article class="mainFooter__content__item mainFooter__content__item--information">
				<!-- Titulo -->
				<h2 class="text-uppercase"><?php _e( 'Mas Información' , 'garoe-framework' ); ?></h2>
				<!-- Lista -->
				<ul>
					<!-- Celular -->
					<?php $cel = $options['contact_cel']; if( !empty($cel) ) : ?>
					<li> 
						<i><img src="<?= IMAGES ?>/iconos/icono_whatsapp.png" alt="celular" class="img-responsive" /></i>
						<?= $cel ?>
					</li>
					<?php endif; ?>
					<!-- Correo -->
					<?php $mail = $options['contact_email']; if( !empty($mail) ) : ?>
					<li>
						<i><img src="<?= IMAGES ?>/iconos/icono_mail.png" alt="mail" class="img-responsive" /></i>
						<?= $mail ?>
					</li>
					<?php endif; ?>
					<!-- Facebook -->
					<?php $facebook = $options['red_social_fb']; if( !empty($facebook) ) : ?>
					<li>
						<i><img src="<?= IMAGES ?>/iconos/icono_facebook.png" alt="facebook" class="img-responsive" /></i>
						<?php 
							$facebook = str_replace( "https://www.", "", $facebook );
							$facebook = str_replace( "http://www.", "", $facebook );
							$facebook = str_replace( "http://", "", $facebook );
							echo $facebook; 
						?>
					</li>
					<?php endif; ?>
				</ul> <!-- &/.ul -->

				<!-- Direccion web -->
				<h2 class="title-web text-uppercase">www.garoesanacion.com</h2>
			</article>
		</section> <!-- /main-wrapper -->

	</footer> <!-- /.mainFooter -->
	
	<?php wp_footer(); ?>

</body>
</html>