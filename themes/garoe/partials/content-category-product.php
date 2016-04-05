<!--TITULO  -->
<h3 class="sectionProducts__categories__title text-capitalize"><?php _e('Categorías','garoe-framework'); ?></h3>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<!-- Obtener todas las categorias -->
	<?php $args = array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'orderby'    => 'title',
		'order'      => 'ASC',
		'parent'     => 0,
		);

	$all_categories = get_categories( $args ); #var_dump($all_categories);
    //variable control
	$control = 0;

	foreach ($all_categories as $cat ) :
		?>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="heading<?= $cat->slug ?>">
			<h4 class="panel-title">
				<a role="button" href="<?= get_term_link($cat->slug , 'product_cat') ?>"> <strong><?= ucfirst( $cat->name ) ?></strong>
				</a> <!-- /./buttom -->
			</h4> <!-- /.paqnel-title -->
		</div> <!-- /.panel-heading -->
		<div id="collapse<?= $cat->slug ?>" class="panel-collapse collapse in ?>" role="tabpanel" aria-labelledby="heading<?= $cat->slug ?>">
			<div class="panel-body"> 
				<?php  
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    =>  $cat->slug,
							),
						),
					);
            		//conseguir las categorias hijas
				$child_products = get_posts( $args ); #var_dump($child_products);
				
				echo "<ul class='toggle-category__menu'>";
				
				if( count($child_products) > 0 ) :
					foreach ($child_products as $child ) :
						?>
					<li>
						<a href="<?= $child->guid; ?>">
							<?= $child->post_title; ?>
						</a>
					</li> <!-- end categoria hija -->
				<?php endforeach; ?>
			<?php else: ?> <li>No hay Productos Disponibles</li>
			<?php endif; echo "</ul>" ; ?>
		</div> <!-- /.panel-bpody -->
	</div><!-- /.panel-collapse collapse -->
	<?php $control++; endforeach; ?>
</div> <!-- ./panel-group -->