<?php 
/***********************************************************************************************/
/* Widget that displays an embeddable video */
/***********************************************************************************************/

	class Garoe_Interesting_Widget extends WP_Widget {
	
		public function __construct() {
			parent::__construct(
				'garoe_interesting-posts_w',
				'Widget Personalizado: Articulos Interesantes',
				array('description' => __('Muestra 3 últimos articulos destacados', 'garoe-framework'))
			); 
		}
		
		public function form($instance) {
			$defaults = array(
				'title' => __('Artículos Interesantes', 'garoe-framework')
			);
			
			$instance = wp_parse_args((array) $instance, $defaults);
			
			?>
			<!-- The Title -->
			<p>
				<label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Titulo:', 'garoe-framework'); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>

			
			<?php
		}
		
		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
			
			// The Title
			$instance['title'] = strip_tags($new_instance['title']);
			

			return $instance;
		}
		
		public function widget($args, $instance) {
			extract($args);
			
			// Get the title and prepare it for display
			$title = apply_filters('widget_title', $instance['title']);
			
			// Get the ad
			
			echo $before_widget;
			
			//Mostrar titulo
			echo "<h3 class='sidebar-widget__title'>" ;
			echo !empty($title) ? $title : '';
			echo "</h3>";

			//Hacemos la consulta WP QUERY
			$args = array(
				'post_type'           => 'post',
				'posts_per_page'      => 3,
				'post__in'            => get_option( 'sticky_posts' ),
				'ignore_sticky_posts' => false,
			);

			$the_query = new WP_Query($args);

			if ( $the_query->have_posts() ):
			while( $the_query->have_posts() ) : $the_query->the_post(); 

		?>

			<!-- Mostrar el articulo   -->
			<article class="sidebar-widget-article">
				<h2 class="sidebar-widget-article__title"><?= the_title(); ?></h2>
				<p class="sidebar-widget-article__text">
					<?= get_the_content( __( '...Leer Más', 'garoe-framework' ) , true );
					?>
				</p>
			</article> <!-- /.sidebar-widget-article -->

		<?php
			//cerrar consultas
			endwhile; wp_reset_postdata(); endif;
			
			echo $after_widget; 
		}
	}

	register_widget('Garoe_Interesting_Widget');

?>