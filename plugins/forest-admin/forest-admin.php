<?php
   /*
   Plugin Name: Forest Admin
   Plugin URI: http://leafcolor.com/forest-admin/
   Description: A plugin to make your admin dashboard more beautiful.
   Version: 1.2.5
   Author: Leafcolor
   Author URI: http://leafcolor.com
   License: GPL2
   */
define( 'FRA_PATH', plugin_dir_url( __FILE__ ) );

require_once ('core/plugin-options.php');

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class forestAdmin{
	public function __construct()
    {
		add_action('wp_enqueue_scripts', array( $this, 'fra_frontend_scripts' ) );
		add_action('admin_enqueue_scripts', array( $this, 'fra_admin_scripts' ) );
		add_action('login_enqueue_scripts', array( $this, 'fra_admin_scripts' ) );
		add_action('wp_ajax_wp_ajax_query', array( $this, 'fra_admin_ajax' ) );
		add_action('wp_ajax_nopriv_wp_ajax_query', array( $this, 'fra_admin_ajax' ) );
		add_action('in_admin_footer', array( $this, 'fra_admin_footer' ) );
		add_action('widgets_init', array( $this, 'fra_widgets_init' ), 100 );
		add_action('admin_bar_menu', array( $this, 'remove_wp_logo'), 999);
		add_filter('admin_footer_text', array( $this, 'change_footer_admin'), 9999);
		add_filter('update_footer', array( $this, 'change_footer_version'), 9999);
		
		$fra_options = $this->get_all_option();
		if($fra_options['hide_admin_bar']){
			add_action('show_admin_bar', array( $this, 'remove_admin_bar'));
		}
    }

	public function fra_frontend_scripts(){
		//frontend
	}
	
	/*
	 * enqueue admin scripts
	 */
	public function fra_admin_scripts() {
		$fra_options = $this->get_all_option();
		wp_enqueue_script('jquery');
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script('forest-admin', plugins_url( 'core/admin.js', __FILE__ ), array('jquery'));
		wp_enqueue_style('forest-admin-setting', plugins_url( 'core/admin.css', __FILE__ ));
		wp_enqueue_style('forest-admin-style', plugins_url( 'style.css', __FILE__ ));
		if($fra_options['style']==1){
			wp_enqueue_style('forest-admin-style-dark-flat', plugins_url( 'dark-flat.css', __FILE__ ));
		}
		wp_enqueue_style('forest-admin-style-custom', plugins_url( 'style.custom.php', __FILE__ ));
		if($fra_options['fontawesome']==0){
			wp_enqueue_style('font-awesome', FRA_PATH.'font-awesome/css/font-awesome.min.css');
		}
	}
	
	/*
	 * Get all plugin options
	 */
	public static function get_all_option(){
		$fra_options = get_option('fra_options_group');
		$fra_options['enable_panel'] = isset($fra_options['enable_panel'])?$fra_options['enable_panel']:1;
		$fra_options['enable_buttons'] = isset($fra_options['enable_buttons'])?$fra_options['enable_buttons']:1;
		$fra_options['panel_bg'] = isset($fra_options['panel_bg'])?$fra_options['panel_bg']:'ffffff';
		$fra_options['panel_opacity'] = isset($fra_options['panel_opacity'])?$fra_options['panel_opacity']:80;
		$fra_options['hide_admin_bar'] = isset($fra_options['hide_admin_bar'])?$fra_options['hide_admin_bar']:0;
		$fra_options['hide_wp_item'] = isset($fra_options['hide_wp_item'])?$fra_options['hide_wp_item']:0;
		$fra_options['fontawesome'] = isset($fra_options['fontawesome'])?$fra_options['fontawesome']:0;
		$fra_options['footer_text'] = isset($fra_options['footer_text'])?$fra_options['footer_text']:0;
		$fra_options['hide_version'] = isset($fra_options['hide_version'])?$fra_options['hide_version']:0;
		return $fra_options;
	}
	
	public function fra_admin_footer(){
		$fra_options = $this->get_all_option();
		if($fra_options['enable_panel']){
		?>
    <div id="forest-admin">
    	<div class="fra-quick-panel">
        	<div class="fra-quick-panel-inner">
            <?php if($fra_options['enable_buttons']){ ?>
        	<div class="fra-icon-button-wrap">
            	<ul class="fra-icon-buttons">
                	<h3 class="fra-in-effect"><?php _e('Add new','leafcolor') ?></h3>
                	<li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'post-new.php' ) ?>" title="New post"><i class="fa fa-file-text-o"></i></a></li>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'post-new.php?post_type=page' ) ?>" title="New page"><i class="fa fa-file"></i></a></li>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'media-new.php' ) ?>" title="Media"><i class="fa fa-picture-o"></i></a></li>
                    
                    <h3 class="fra-in-effect"><?php _e('Designs','leafcolor') ?></h3>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'themes.php' ) ?>" title="Themes"><i class="fa fa-magic"></i></a></li>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'widgets.php' ) ?>" title="Widgets"><i class="fa fa-list-alt"></i></a></li>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'nav-menus.php' ) ?>" title="Menus"><i class="fa fa-th-list"></i></a></li>
                    
                    <h3 class="fra-in-effect"><?php _e('Manages','leafcolor') ?></h3>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'edit-comments.php' ) ?>" title="Comments"><i class="fa fa-comment-o"></i></a></li>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'users.php' ) ?>" title="Users"><i class="fa fa-user"></i></a></li>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'options-general.php' ) ?>" title="Wordpress Settings"><i class="fa fa-cogs"></i></a></li>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'plugins.php' ) ?>" title="Plugins"><i class="fa fa-puzzle-piece"></i></a></li>
                    <li class="fra-icon-button fra-in-effect"><a href="<?php echo admin_url( 'admin.php?page=fra_settings' ) ?>" title="Forest Admin Settings"><i class="fa fa-cog"></i></a></li>
                </ul>
            </div><!--/fra-icon-button-->
            <?php }//if enable button
			if(is_active_sidebar('forest_panel_sidebar')){
				dynamic_sidebar('forest_panel_sidebar');
			}
			?>
            <div class="clear"></div>
            </div>
        </div><!--/fra-quick-panel-->
    </div>
    <?php 
		}//if enable panel
    }
	
	public function fra_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Forest Panel Sidebar', 'leafcolor' ),
			'id' => 'forest_panel_sidebar',
			'description' => __( 'Appears in Forest Admin - Quick Panel', 'leafcolor' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}
	//ajax
	public function fra_admin_ajax($atts=''){
		$html = '';
		ob_start();
	
		$html = ob_get_clean();
	}
	
	//admin bar
	public function remove_admin_bar() {
		$fra_options = $this->get_all_option();
		if($fra_options['hide_admin_bar']){
			if(!is_admin()) {
				return false;
			}
		}
	}
	//wp item
	public function remove_wp_logo( $wp_admin_bar ) {
		$fra_options = $this->get_all_option();
		if($fra_options['hide_wp_item']){
			$wp_admin_bar->remove_node('wp-logo');
		}
	}
	function change_footer_admin($footer_text){
		$fra_options = $this->get_all_option();
		if($fra_options['footer_text']){
			return $fra_options['footer_text'];
		}else{
			return $footer_text;
		}
	}
	function change_footer_version($footer_version){
		$fra_options = $this->get_all_option();
		if($fra_options['hide_version']){
			return ' ';
		}else{
			return $footer_version;
		}
	}
	
	
	public static function hex2rgba($hex,$opacity) {
		if(!$hex){$hex='ffffff';}
		if(!$opacity){$opacity=80;}
	   $hex = str_replace("#", "", $hex);
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $opacity = $opacity/100;
	   $rgba = array($r, $g, $b, $opacity);
	   return implode(",", $rgba); // returns the rgb values separated by commas
	   //return $rgba; // returns an array with the rgb values
	}
}
$forestAdmin_class = new forestAdmin();