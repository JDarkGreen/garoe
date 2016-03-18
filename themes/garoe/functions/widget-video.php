<?php 
/***********************************************************************************************/
/* Widget that displays an embeddable video */
/***********************************************************************************************/

	class Garoe_Video_Widget extends WP_Widget {
	
		public function __construct() {
			parent::__construct(
				'garoe_video_w',
				'Custom Widget: Video',
				array('description' => __('Muestra un video embebido', 'garoe-framework'))
			); 
		}
		
		public function form($instance) {
			$defaults = array(
				'title' => __('Video', 'garoe-framework'),
				'video_embed' => 'http://www.youtube.com/embed/3Rxuu_4XpEM',
				'video_description' => 'Un video de ejemplo'
			);
			
			$instance = wp_parse_args((array) $instance, $defaults);
			
			?>
			<!-- The Title -->
			<p>
				<label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Titulo:', 'garoe-framework'); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>

			<!-- Video Embed -->
			<p>
				<label for="<?php echo $this->get_field_id('video_embed') ?>"><?php _e('Link del Video:', 'garoe-framework'); ?></label>
				<textarea class="widefat" id="<?php echo $this->get_field_id('video_embed'); ?>" name="<?php echo $this->get_field_name('video_embed'); ?>"><?php echo $instance['video_embed']; ?></textarea>
			</p>

			<!-- Video Description -->
			<p>
				<label for="<?php echo $this->get_field_id('video_description') ?>"><?php _e('Descripción:', 'garoe-framework'); ?></label>
				<textarea class="widefat" id="<?php echo $this->get_field_id('video_description'); ?>" name="<?php echo $this->get_field_name('video_description'); ?>"><?php echo $instance['video_description']; ?></textarea>
			</p>
			
			<?php
		}
		
		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
			
			// The Title
			$instance['title'] = strip_tags($new_instance['title']);
			
			// The Ad
			$instance['video_embed'] = $new_instance['video_embed'];
			$instance['video_description'] = $new_instance['video_description'];

			return $instance;
		}
		
		public function widget($args, $instance) {
			extract($args);
			
			// Get the title and prepare it for display
			$title = apply_filters('widget_title', $instance['title']);
			
			// Get the ad
			$video_embed = $instance['video_embed'];
			$video_description = $instance['video_description'];
			
			echo $before_widget;
			
			//Mostrar titulo
			echo "<h3 class='sidebar-widget__title'>" ;
			echo !empty($title) ? $title : '';
			echo "</h3>";

			//Mostrar video
			echo "<iframe width='100%' height='200' ";
			echo !empty($video_embed) ? "src='" . $video_embed . "' " : '';
			echo "frameborder='0' allowfullscreen></iframe>";

			//Mostrar description
			echo "<p class='sidebar-widget__description'>" ;
			echo !empty($video_description) ? $video_description : '';
			echo "</p>";

			
			echo $after_widget; 
		}
	}

	register_widget('Garoe_Video_Widget');

?>