<!--TITULO  -->
<h3 class="sectionProducts__categories__title text-capitalize"><?php _e('Categorías','garoe-framework'); ?></h3>

<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
	<!-- Obtener todas las categorias -->
	<?php $args = array(
		'taxonomy'   => 'category',
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
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $cat->slug ?>" aria-expanded="true" aria-controls="collapse<?= $cat->slug ?>"> <strong><?= ucfirst( $cat->name ) ?></strong>
				</a> <!-- /./buttom -->
			</h4> <!-- /.paqnel-title -->
		</div> <!-- /.panel-heading -->
		<div id="collapse<?= $cat->slug ?>" class="panel-collapse collapse <?= $control == 0 ? 'in' : '' ?>" role="tabpanel" aria-labelledby="heading<?= $cat->slug ?>">
			<div class="panel-body"> 
				<?php  
					$args = array(
						'post_type'      => 'post',
						'posts_per_page' => -1,
						'category_name'  => $cat->slug,
					);
            		//conseguir las categorias hijas
					$child_posts = get_posts( $args ); #var_dump($child_posts);
				
				echo "<ul class='toggle-category__menu'>";

				if( count($child_posts) > 0 ) :
					foreach ($child_posts as $child ) :
						?>
					<li>
						<a href="<?= $child->guid ?>">
							<?= $child->name; ?>
						</a>
					</li> <!-- end categoria hija -->
				<?php endforeach; ?>
			<?php else: ?> <li>No hay posts asociados a esta categoría</li>
			<?php endif; echo "</ul>" ; ?>
		</div> <!-- /.panel-bpody -->
	</div><!-- /.panel-collapse collapse -->
	<?php $control++; endforeach; ?>
</div> <!-- ./panel-group -->