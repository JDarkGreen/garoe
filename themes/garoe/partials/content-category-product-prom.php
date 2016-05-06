<!--TITULO  -->
<h3 class="sectionProducts__categories__title text-capitalize"><?php _e('Productos','garoe-framework'); ?></h3>

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
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $cat->slug ?>" aria-expanded="true" aria-controls="collapse<?= $cat->slug ?>"> <strong><?= ucfirst( $cat->name ) ?></strong>
				</a> <!-- /./buttom -->
			</h4> <!-- /.paqnel-title -->
		</div> <!-- /.panel-heading -->
		<div id="collapse<?= $cat->slug ?>" class="panel-collapse collapse <?= $control == 0 ? 'in' : '' ?>" role="tabpanel" aria-labelledby="heading<?= $cat->slug ?>">
			<div class="panel-body"> 
				<?php  
            		//conseguir las categorias hijas
				$child_categories = get_categories( array('taxonomy'=>'product_cat','orderby'=>'name','hide_empty' => false, 'parent' => $cat->cat_ID ) );
				
				echo "<ul class='toggle-category__menu'>";

				$primer_link = get_term_link($cat->slug , 'product_cat');
				$primera_categoria = "<li>";
				$primera_categoria .= "<a class='text-capitalize' href='$primer_link'> $cat->name</a>"; 
				$primera_categoria .= "</li>"; 
			
				echo $primera_categoria;
				
				if( count($child_categories) > 0 ) :
					foreach ($child_categories as $child ) :
						?>
					<li>
						<a href="<?= get_term_link($child->slug , 'product_cat'); ?>">
							<?= $child->name; ?>
						</a>
					</li> <!-- end categoria hija -->
				<?php endforeach; ?>
			<?php else: ?> <li><a href="">No hay subcategorias</a></li>
			<?php endif; echo "</ul>" ; ?>
		</div> <!-- /.panel-bpody -->
	</div><!-- /.panel-collapse collapse -->
	<?php $control++; endforeach; ?>
</div> <!-- ./panel-group -->