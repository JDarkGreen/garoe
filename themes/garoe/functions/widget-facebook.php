<?php 
/***********************************************************************************************/
/* Widget that displays an embeddable video */
/***********************************************************************************************/

	class Garoe_Facebook_Widget extends WP_Widget {
	
		public function __construct() {
			parent::__construct(
				'garoe_facebook_w',
				'Widget Personalizado: Red Social Facebook',
				array('description' => __('Muestra el fan page facebook de la web', 'garoe-framework'))
			); 
		}
		
		public function form($instance) {
			$defaults = array(
				'title' => __('Redes Sociales', 'garoe-framework'),
				'link_embed' => 'https://www.facebook.com/Mafitel-Balanzas-Industriales-Per&#xfa;-449696105220898/?ref=hl',
			);
			
			$instance = wp_parse_args((array) $instance, $defaults);
			
			?>
			<!-- El título -->
			<p>
				<label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Titulo:', 'garoe-framework'); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>

			<!-- Link Embed -->
			<p>
				<label for="<?php echo $this->get_field_id('link_embed') ?>"><?php _e('Link del Video:', 'garoe-framework'); ?></label>
				<textarea class="widefat" id="<?php echo $this->get_field_id('link_embed'); ?>" name="<?php echo $this->get_field_name('link_embed'); ?>"><?php echo $instance['link_embed']; ?></textarea>
			</p>

			<?php
		}
		
		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
			
			// The Title
			$instance['title'] = strip_tags($new_instance['title']);
			
			// The Ad
			$instance['link_embed'] = $new_instance['link_embed'];

			return $instance;
		}
		
		public function widget($args, $instance) {
			extract($args);
			
			// Get the title and prepare it for display
			$title = apply_filters('widget_title', $instance['title']);
			
			// Get the ad
			$link_embed = $instance['link_embed'];
			
			echo $before_widget;
			
			//Mostrar titulo
			echo "<h3 class='sidebar-widget__title'>" ;
			echo !empty($title) ? $title : '';
			echo "</h3>";

		?>
			
		<!-- Contebn -->
		<div id="fb-root"></div>

			<!-- Script -->
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

			<div class="fb-page" data-href="<?= $link_embed ?>" data-tabs="timeline" data-small-header="false"  data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">

			<div class="fb-xfbml-parse-ignore">
				<blockquote cite="<?= $link_embed ?>">
					<a href="<?= $link_embed ?>"><?php bloginfo('name'); ?></a>
				</blockquote>
			</div>
		</div>
			
		<?php
			
			echo $after_widget; 
		}
	}

	register_widget('Garoe_Facebook_Widget');

?>