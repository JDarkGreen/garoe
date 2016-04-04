<?php
/*
 * add option page
 */
add_action('admin_menu', 'fra_plugin_settings');
function fra_plugin_settings(){
    add_menu_page(__('Forest Admin','leafcolor'), __('Forest Admin','leafcolor'), 'read', 'fra_settings', 'fra_display_settings'); //read or administrator
}
function register_fra_setting() {
	register_setting( 'fra_options_group', 'fra_options_group', 'fra_options_validate' );
	//General settings
	add_settings_section('fra_settings_general','','fra_settings_general_html','fra_settings');
	add_settings_field('fra_style',__('Admin Style','forestadmin'),'fra_style_html','fra_settings','fra_settings_general');
	add_settings_field('fra_background',__('Background','forestadmin'),'fra_background_html','fra_settings','fra_settings_general');
	add_settings_field('fra_darkness',__('Darkness Level','forestadmin'),'fra_darkness_html','fra_settings','fra_settings_general');
	add_settings_field('fra_main_color',__('Main Color','forestadmin'),'fra_main_color_html','fra_settings','fra_settings_general');
	add_settings_field('fra_link_color',__('Link Color','forestadmin'),'fra_link_color_html','fra_settings','fra_settings_general');
	
	//Font settings
	add_settings_section('fra_settings_font','','fra_settings_font_html','fra_settings');
	add_settings_field('fra_menu_font',__('Menu font','forestadmin'),'fra_menu_font_html','fra_settings','fra_settings_font');
	add_settings_field('fra_content_font',__('Content font','forestadmin'),'fra_content_font_html','fra_settings','fra_settings_font');
	
	//Quick Panel settings
	add_settings_section('fra_settings_panel','','fra_settings_panel_html','fra_settings');
	add_settings_field('fra_enable_panel',__('Enable Quick Panel','forestadmin'),'fra_enable_panel_html','fra_settings','fra_settings_panel');
	add_settings_field('fra_enable_panel_button',__('Use Default Buttons','forestadmin'),'fra_enable_buttons_html','fra_settings','fra_settings_panel');
	add_settings_field('fra_panel_color',__('Panel Text Color','forestadmin'),'fra_panel_color_html','fra_settings','fra_settings_panel');
	add_settings_field('fra_panel_bg',__('Panel Background Color','forestadmin'),'fra_panel_bg_html','fra_settings','fra_settings_panel');
	
	//Login settings
	add_settings_section('fra_settings_login','','fra_settings_login_html','fra_settings');
	add_settings_field('fra_login_logo',__('Login Logo','forestadmin'),'fra_login_logo_html','fra_settings','fra_settings_login');
	add_settings_field('fra_login_logo_size',__('Logo Size','forestadmin'),'fra_login_logo_size_html','fra_settings','fra_settings_login');
	add_settings_field('fra_login_bg',__('Login Background','forestadmin'),'fra_login_bg_html','fra_settings','fra_settings_login');
	
	//WP settings
	add_settings_section('fra_settings_wp','','fra_settings_wp_html','fra_settings');
	add_settings_field('fra_hide_wp',__('Hide Elements','forestadmin'),'fra_hide_wp_html','fra_settings','fra_settings_wp');
	add_settings_field('fra_footer_text',__('Custom Footer Text','forestadmin'),'fra_footer_text_html','fra_settings','fra_settings_wp');
	
	//other settings
	add_settings_section('fra_settings_other','','fra_settings_other_html','fra_settings');
	add_settings_field('fra_fontawesome',__('Turn off Font Awesome','forestadmin'),'fra_fontawesome_html','fra_settings','fra_settings_other');
	add_settings_field('fra_custom_css',__('Custom Admin CSS','forestadmin'),'fra_custom_css_html','fra_settings','fra_settings_other');
} 
add_action( 'admin_init', 'register_fra_setting' );

/*
 * render option page
 */
function fra_display_settings(){
wp_enqueue_script('jscolor', FRA_PATH.'js/jscolor/jscolor.js', array('jquery'));
$fra_options = get_option('fra_options_group');
$fra_menu_font = isset($fra_options['menu_font'])?$fra_options['menu_font']:'';
$fra_content_font = isset($fra_options['content_font'])?$fra_options['content_font']:'';
?>
</pre>
<div class="wrap">
  <div class="mip-setting-page">
    <h1 class="mip-head"><i class="fa fa-cog"></i> <?php _e('Forest Admin Settings','forestadmin'); ?></h1>
    <div class="mip-setting-content">
    <?php if(isset($_GET['settings-updated'])&&$_GET['settings-updated']==true) {?>
    	<div class="form-group">
            <div class="form-label"></div>
            <div class="form-control">
            	<i class="fa fa-check"></i> <?php _e('Settings were saved.','forestadmin'); ?>
            </div>
         </div>
    <?php } ?>
    <form action="options.php" method="post" name="options" id="mip-form" class="waq-data">
    	<?php settings_errors('med-settings-errors'); ?>
        <?php
			settings_fields('fra_options_group');
			do_settings_sections('fra_settings');
		?>
      	<div class="form-group">
            <div class="form-label"></div>
            <div class="form-control">
            	<button type="submit" title="Update Default Setting" name="submit" class="button"><i class="fa fa-check"></i> <?php _e('Update','forestadmin'); ?></button>
                <br />
            </div>
      	</div>
        <script type="text/javascript">
		jQuery(document).ready(function(){ 
			jQuery.getJSON('<?php echo FRA_PATH ?>core/googlefont.php', function(data){
				var item1 = item2 = item3 = item4 ='';
				jQuery.each(data.items, function(key, val){
					if(val.family=='<?php echo $fra_menu_font ?>'){
						item1 += '<option value="'+ val.family + '" selected="selected">'+val.family+'</option>';
					}else{
						item1 += '<option value="'+ val.family + '">'+val.family+'</option>';
					}
					if(val.family=='<?php echo $fra_content_font ?>'){
						item2 += '<option value="'+ val.family + '" selected="selected">'+val.family+'</option>';
					}else{
						item2 += '<option value="'+ val.family + '">'+val.family+'</option>';
					}
				});
				jQuery('select.font1').append(item1);
				jQuery('select.font2').append(item2);
				jQuery('select.font3').append(item3);
				jQuery('select.font4').append(item4);
				jQuery('.loading-font').remove();
				}); 
			});
		</script>
    </form>
    </div>
  </div>
</div>
<pre>
<?php
}

//header for setting section
function fra_settings_general_html(){ ?>
	<h2 class="option-group"><i class="fa fa-laptop"></i> <?php _e('General settings','forestadmin'); ?></h2>
<?php 

}

//header for setting section
function fra_settings_font_html(){ ?>
	<h2 class="option-group"><i class="fa fa-font"></i> <?php _e('Font settings','forestadmin'); ?></h2>
<?php 
}

//header for setting section
function fra_settings_panel_html(){ ?>
	<h2 class="option-group"><i class="fa fa-chevron-circle-left"></i> <?php _e('Quick Panel settings','forestadmin'); ?></h2>
<?php 
}

//header for setting section
function fra_settings_login_html(){ ?>
	<h2 class="option-group"><i class="fa fa-user"></i> <?php _e('Login settings','forestadmin'); ?></h2>
<?php 
}

//header for setting section

function fra_settings_wp_html(){ ?>
	<h2 class="option-group"><i class="fa fa-gear"></i> <?php _e('Wordpress settings','forestadmin'); ?></h2>
<?php 
}

//header for setting section
function fra_settings_other_html(){ ?>
	<h2 class="option-group"><i class="fa fa-plus-circle"></i> <?php _e('Other settings','forestadmin'); ?></h2>
<?php 

}

$fra_options = get_option('fra_options_group');

$fra_font_array=array('Arial','Tahoma','Verdana','Times New Roman','Lucida Sans Unicode');

//render options fields
function fra_style_html(){
	global $fra_options;
	$style = isset($fra_options['style'])?$fra_options['style']:'0';
	$array = array(
		array(
			'name'=>'fra_options_group[style]',
			'value' => '0',
			'label' => 'Default Light',
			'icon' => 'fa fa-bookmark-o fa-3x',
		),
		array(
			'name'=>'fra_options_group[style]',
			'value' => '1',
			'label' => 'Dark Flat',
			'icon' => 'fa fa-bookmark fa-3x',
		)
	);
	fra_image_radio($style,$array);?>
    <span>&nbsp; <?php _e('Choose admin style','forestadmin'); ?></span>
<?php
}
function fra_background_html() {
    global $fra_options;
	$background = isset($fra_options['background'])?$fra_options['background']:'';
    ?>
    <span class='upload'>
        <input type='text' id='fra-background' class='regular-text text-upload' name='fra_options_group[background]' value='<?php echo esc_url( $background ); ?>' placeholder="<?php _e('Image URL','forestadmin'); ?>"/>
        <button class="button button-upload" ><i class="fa fa-upload"></i> <?php _e('Upload','forestadmin'); ?></button></br>
        <img style='max-width: 300px; display: block;' src='<?php echo esc_url( $background ); ?>' class='preview-upload' />
    </span>
    <?php
}

//render options fields
function fra_darkness_html(){
	global $fra_options;
	$darkness = isset($fra_options['darkness'])?$fra_options['darkness']:''; ?>
    <input type="number" name="fra_options_group[darkness]" title="Darkness level" placeholder="%" value="<?php echo $darkness ?>" max="99" min="0" />
    <span><?php _e('% (Only number, ex: 15) Uses to make the background darker','forestadmin'); ?></span>
<?php
}

function fra_main_color_html(){
	global $fra_options;
	$main_color = isset($fra_options['main_color'])?$fra_options['main_color']:'';?>
    <input class="color {required:false}" placeholder="Main Color" name="fra_options_group[main_color]" value="<?php echo $main_color ?>" title="Main Color">
    <span>&nbsp;<?php _e('Choose highlight color scheme (Leave blank to use wp default profile color)','forestadmin'); ?></span>
    <?php
}

function fra_link_color_html(){
	global $fra_options;
	$link_color = isset($fra_options['link_color'])?$fra_options['link_color']:'';?>
    <input class="color {required:false}" placeholder="Link Color" name="fra_options_group[link_color]" value="<?php echo $link_color ?>" title="Link Color">
    <span>&nbsp;<?php _e('Choose link color (almost &lt;a&gt; tag, leave blank to use wp default color)','forestadmin'); ?></span>
    <?php
}

function fra_menu_font_html(){
	global $fra_options;
	$menu_font = isset($fra_options['menu_font'])?$fra_options['menu_font']:'0';
	$menu_size = isset($fra_options['menu_size'])?$fra_options['menu_size']:''; ?>
    <select class="font font1" name="fra_options_group[menu_font]" title="Font">
        <option value="0"><?php _e('Choose Font','forestadmin'); ?></option>
        <?php
		global $fra_font_array;
		foreach($fra_font_array as $font){ ?>
			<option value="<?php echo $font ?>" <?php echo $font==$menu_font?'selected="selected"':'' ?> ><?php echo $font ?></option>
		<?php } ?>
        <option class="loading-font" disabled="disabled">Loading google font list...</option>
    </select>&nbsp;
    <i class="fa fa-text-height"></i>
    <input type="number" class="mini" name="fra_options_group[menu_size]" title="Font Size" placeholder="13" value="<?php echo $menu_size ?>" min="0" />
    <span>px</span>
<?php
}

function fra_content_font_html(){
	global $fra_options;
	$content_font = isset($fra_options['content_font'])?$fra_options['content_font']:'0';
	$content_size = isset($fra_options['content_size'])?$fra_options['content_size']:''; ?>
    <select class="font font2" name="fra_options_group[content_font]" title="Font">
        <option value="0"><?php _e('Choose Font','forestadmin'); ?></option>
        <?php
		global $fra_font_array;
		foreach($fra_font_array as $font){ ?>
			<option value="<?php echo $font ?>" <?php echo $font==$content_font?'selected="selected"':'' ?> ><?php echo $font ?></option>
		<?php } ?>
        <option class="loading-font" disabled="disabled">Loading google font list...</option>
    </select>&nbsp;
    <i class="fa fa-text-height"></i>
    <input type="number" class="mini" name="fra_options_group[content_size]" title="Font Size" placeholder="13" value="<?php echo $content_size ?>" min="0" />
    <span>px</span>
<?php
}

function fra_enable_panel_html(){
	global $fra_options;
	$enable_panel = isset($fra_options['enable_panel'])?$fra_options['enable_panel']:'1';
	$array = array(
		array(
			'name'=>'fra_options_group[enable_panel]',
			'value' => '1',
			'label' => 'Enable',
			'icon' => 'fa fa-chevron-circle-left fa-3x',
		),
		array(
			'name'=>'fra_options_group[enable_panel]',
			'value' => '0',
			'label' => 'Disable',
			'icon' => 'fa fa-ban fa-3x',
		)
	);
	fra_image_radio($enable_panel,$array);?>
    <span>&nbsp; <?php _e('Enable Quick Panel','forestadmin'); ?></span>
<?php
}

function fra_enable_buttons_html(){
	global $fra_options;
	$enable_buttons = isset($fra_options['enable_buttons'])?$fra_options['enable_buttons']:'1';
	$array = array(
		array(
			'name'=>'fra_options_group[enable_buttons]',
			'value' => '1',
			'label' => 'Use',
			'icon' => 'fa fa-check fa-2x',
		),
		array(
			'name'=>'fra_options_group[enable_buttons]',
			'value' => '0',
			'label' => 'No',
			'icon' => 'fa fa-ban fa-2x',
		)
	);
	fra_image_radio($enable_buttons,$array);?>
    <span>&nbsp; <?php _e('Use Quick Panel default buttons or Use only your widgets','forestadmin'); ?></span>
<?php
}

function fra_panel_color_html(){
	global $fra_options;
	$panel_color = isset($fra_options['panel_color'])?$fra_options['panel_color']:'';?>
    <input class="color {required:false}" placeholder="Text Color" name="fra_options_group[panel_color]" value="<?php echo $panel_color ?>" title="Panel Text Color">
    <span>&nbsp;<?php _e("Choose Panel's text color",'forestadmin'); ?></span>
    <?php
}

function fra_panel_bg_html(){
	global $fra_options;
	$panel_bg = isset($fra_options['panel_bg'])?$fra_options['panel_bg']:'';
	$panel_opacity = isset($fra_options['panel_opacity'])?$fra_options['panel_opacity']:'';?>
    <input class="color {required:false}{required:false}" placeholder="Background Color" name="fra_options_group[panel_bg]" value="<?php echo $panel_bg ?>" title="Background Color">
    <span>&nbsp;<i class="fa fa-adjust"></i> <?php _e('Opacity','forestadmin'); ?> </span><input type="number" name="fra_options_group[panel_opacity]" title="Background Opacity" placeholder="%" value="<?php echo $panel_opacity ?>" max="99" min="0" /><span> <?php _e('% &nbsp; Choose background color & opacity <i>(Default is FFFFFF | 80%)</i>','forestadmin'); ?></span>
    <?php
}

function fra_login_logo_html() {
    global $fra_options;
	$login_logo = isset($fra_options['login_logo'])?$fra_options['login_logo']:'';
    ?>
    <span class='upload'>
        <input type='text' id='fra-login_logo' class='regular-text text-upload' name='fra_options_group[login_logo]' value='<?php echo esc_url( $login_logo ); ?>'/>
        <button class="button button-upload" ><i class="fa fa-upload"></i> <?php _e('Upload','forestadmin'); ?></button></br>
        <img style='max-width: 300px; display: block;' src='<?php echo esc_url( $login_logo ); ?>' class='preview-upload' />
    </span>
    <?php
}
function fra_login_logo_size_html(){
	global $fra_options;
	$logo_w = isset($fra_options['logo_w'])?$fra_options['logo_w']:'';
	$logo_h = isset($fra_options['logo_h'])?$fra_options['logo_h']:''; ?>
    <span><i class="fa fa-arrows-h"></i> Width </span><input type="number" name="fra_options_group[logo_w]" title="Width" value="<?php echo $logo_w ?>" max="9999" min="0" />
    <span> &nbsp; <i class="fa fa-arrows-v"></i> <?php _e('Height','forestadmin'); ?> </span><input type="number" name="fra_options_group[logo_h]" title="Height" value="<?php echo $logo_h ?>" max="9999" min="0" />
    <span><?php _e('px (Only number, ex: 150)','forestadmin'); ?></span>
<?php
}
function fra_login_bg_html() {
    global $fra_options;
	$login_bg = isset($fra_options['login_bg'])?$fra_options['login_bg']:'';
    ?>
    <span class='upload'>
        <input type='text' id='fra-login-bg' class='regular-text text-upload' name='fra_options_group[login_bg]' value='<?php echo esc_url( $login_bg ); ?>'/>
        <button class="button button-upload" ><i class="fa fa-upload"></i> <?php _e('Upload','forestadmin'); ?></button></br>
        <img style='max-width: 300px; display: block;' src='<?php echo esc_url( $login_bg ); ?>' class='preview-upload' />
    </span>
    <?php
}

function fra_hide_wp_html(){
	global $fra_options;
	$hide_admin_bar = isset($fra_options['hide_admin_bar'])?$fra_options['hide_admin_bar']:0;
	$hide_wp_item = isset($fra_options['hide_wp_item'])?$fra_options['hide_wp_item']:0;
	$hide_version = isset($fra_options['hide_version'])?$fra_options['hide_version']:0;
	$hide_forest = isset($fra_options['hide_forest'])?$fra_options['hide_forest']:0;
	?>
    <input type="checkbox" name="fra_options_group[hide_admin_bar]" value="1" <?php if($hide_admin_bar) echo 'checked'; ?> /><span><?php _e('Hide Admin bar on Front End','forestadmin'); ?></span><br /><br />
    <input type="checkbox" name="fra_options_group[hide_wp_item]" value="1" <?php if($hide_wp_item) echo 'checked'; ?> /><span><?php _e('Hide Wordpress item on Admin bar','forestadmin'); ?></span><br /><br />
    <input type="checkbox" name="fra_options_group[hide_version]" value="1" <?php if($hide_version) echo 'checked'; ?> /><span><?php _e('Hide Wordpress version in Footer','forestadmin'); ?></span><br /><br />
    <input type="checkbox" name="fra_options_group[hide_forest]" value="1" <?php if($hide_forest) echo 'checked'; ?> /><span><?php _e('Hide Forest Admin on Sidebar menu','forestadmin'); ?> <i class="fa fa-exclamation-circle"></i> <i><?php _e('(You still access via url /wp-admin/admin.php?page=fra_settings)','forestadmin'); ?></i></span>
<?php
}

function fra_footer_text_html(){
	global $fra_options;
	$footer_text = isset($fra_options['footer_text'])?$fra_options['footer_text']:'';
	?>
    <textarea name="fra_options_group[footer_text]" cols="55" rows="3"><?php echo $footer_text; ?></textarea>
<?php
}

function fra_post_type_html(){
	global $fra_options;
	$fra_post_type = isset($fra_options['post_type'])?$fra_options['post_type']:array();
	$pargs = array(
		'public'   => true,
		'publicly_queryable' => true,
		'_builtin' => false
	);
	$output = 'names'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'
	$post_types = get_post_types( $pargs, $output, $operator ); 
	$post_types[] = 'post';
	$post_types[] = 'attachment';
	sort($post_types);
	echo '<div class="fra_posttype_checkbox">';
	foreach ( $post_types  as $post_type ) {
		$checked = in_array($post_type,$fra_post_type)?'checked':'';
		echo '<div class="checkbox-item"><input type="checkbox" name="fra_options_group[post_type][]" value="'.$post_type.'" '.$checked.'/><span> '.$post_type.' </span></div>';
	}
	echo '</div>';
}


function fra_posts_per_page_html(){
	global $fra_options;
	$fra_posts_per_page = isset($fra_options['posts_per_page'])?$fra_options['posts_per_page']:'12';
	?>
    <input type="number" value="<?php echo $fra_posts_per_page ?>" name="fra_options_group[posts_per_page]" placeholder="Default = 12" />
<?php
}

function fra_custom_css_html(){
	global $fra_options;
	$custom_css = isset($fra_options['custom_css'])?$fra_options['custom_css']:'';
	?>
    <textarea name="fra_options_group[custom_css]" cols="55" rows="5"><?php echo $custom_css; ?></textarea>
<?php
}

function fra_fontawesome_html(){
	global $fra_options;
	$fra_fontawesome = isset($fra_options['fontawesome'])?$fra_options['fontawesome']:'0';
	?>
    <div class="fra_fontawesome_checkbox">
    <input type="checkbox" <?php echo $fra_fontawesome?'checked':'' ?> name="fra_options_group[fontawesome]" value="1" /><span> <?php _e("Turn off loading plugin's Font Awesome. Check if your theme has already loaded this library",'forestadmin'); ?></span>
    </div>
<?php
}

//validate
function fra_options_validate( $input ) {
    return $input;  
}

/*
 * build radio image select
 */
function fra_image_radio($option,$array){
?>
<span class="image-select">
	<?php foreach($array as $item){ ?>
    <input type="radio" name="<?php echo $item['name'] ?>" id="<?php echo $item['name'] ?>-<?php echo $item['value'] ?>" value="<?php echo $item['value'] ?>" <?php echo ($option==$item['value'])?'checked':'' ?> />
    <label for="<?php echo $item['name'] ?>-<?php echo $item['value'] ?>" class="<?php echo ($option==$item['value'])?'selected':'' ?>" ><i class="<?php echo $item['icon'] ?> icon-large"></i><br>
    <?php echo $item['label'] ?></label>
    <?php } ?>
</span>
<?php
}
function fra_image_radio_custom($option,$array){
?>
<span class="image-select">
	<?php foreach($array as $item){ ?>
    <input type="radio" name="<?php echo $item['name'] ?>" id="<?php echo $item['name'] ?>-<?php echo $item['value'] ?>" value="<?php echo $item['value'] ?>" <?php echo ($option==$item['value'])?'checked':'' ?> />
    <label for="<?php echo $item['name'] ?>-<?php echo $item['value'] ?>" class="<?php echo ($option==$item['value'])?'selected':'' ?>" ><?php echo $item['icon'] ?><br>
    <?php echo $item['label'] ?></label>
    <?php } ?>
</span>
<?php
}

/*
 * get list image sizes
 */
function fra_list_thumbnail_sizes(){
	global $_wp_additional_image_sizes;
	$sizes = array();
	foreach( get_intermediate_image_sizes() as $s ){
		$sizes[ $s ] = array( 0, 0 );
		if( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ){
			$sizes[ $s ][0] = get_option( $s . '_size_w' );
			$sizes[ $s ][1] = get_option( $s . '_size_h' );
		}else{
			if( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) )
			$sizes[ $s ] = array( $_wp_additional_image_sizes[ $s ]['width'], $_wp_additional_image_sizes[ $s ]['height'], );
		}
	}
	return $sizes;
}

//add tinyMCE button
// init process for registering our button
add_action('init', 'fra_shortcode_button_init');
function fra_shortcode_button_init() {
	//Abort early if the user will never see TinyMCE
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
	   return;
	//Add a callback to regiser our tinymce plugin   
	add_filter("mce_external_plugins", "fra_register_tinymce_plugin"); 
	// Add a callback to add our button to the TinyMCE toolbar
	add_filter('mce_buttons', 'fra_add_tinymce_button');
}

//This callback registers our plug-in
function fra_register_tinymce_plugin($plugin_array) {
    $plugin_array['fra_button'] = FRA_PATH . 'js/button.js';
    return $plugin_array;
}

//This callback adds our button to the toolbar
function fra_add_tinymce_button($buttons) {
    //Add the button ID to the $button array
    $buttons[] = "fra_button";
    return $buttons;
}

function fra_font_awesome_option($default=''){
	$icons = array(
		'icon-glass' => '&#xf000;',
		'icon-music' => '&#xf001;',
		'icon-search' => '&#xf002;',
		'icon-envelope-alt' => '&#xf003;',
		'icon-heart' => '&#xf004;',
		'icon-star' => '&#xf005;',
		'icon-star-empty' => '&#xf006;',
		'icon-user' => '&#xf007;',
		'icon-film' => '&#xf008;',
		'icon-th-large' => '&#xf009;',
		'icon-th' => '&#xf00a;',
		'icon-th-list' => '&#xf00b;',
		'icon-ok' => '&#xf00c;',
		'icon-remove' => '&#xf00d;',
		'icon-zoom-in' => '&#xf00e;',
		'icon-zoom-out' => '&#xf010;',
		'icon-off' => '&#xf011;',
		'icon-signal' => '&#xf012;',
		'icon-cog' => '&#xf013;',
		'icon-trash' => '&#xf014;',
		'icon-home' => '&#xf015;',
		'icon-file-alt' => '&#xf016;',
		'icon-time' => '&#xf017;',
		'icon-road' => '&#xf018;',
		'icon-download-alt' => '&#xf019;',
		'icon-download' => '&#xf01a;',
		'icon-upload' => '&#xf01b;',
		'icon-inbox' => '&#xf01c;',
		'icon-play-circle' => '&#xf01d;',
		'icon-repeat' => '&#xf01e;',
		'icon-refresh' => '&#xf021;',
		'icon-list-alt' => '&#xf022;',
		'icon-lock' => '&#xf023;',
		'icon-flag' => '&#xf024;',
		'icon-headphones' => '&#xf025;',
		'icon-volume-off' => '&#xf026;',
		'icon-volume-down' => '&#xf027;',
		'icon-volume-up' => '&#xf028;',
		'icon-qrcode' => '&#xf029;',
		'icon-barcode' => '&#xf02a;',
		'icon-tag' => '&#xf02b;',
		'icon-tags' => '&#xf02c;',
		'icon-book' => '&#xf02d;',
		'icon-bookmark' => '&#xf02e;',
		'icon-print' => '&#xf02f;',
		'icon-camera' => '&#xf030;',
		'icon-font' => '&#xf031;',
		'icon-bold' => '&#xf032;',
		'icon-italic' => '&#xf033;',
		'icon-text-height' => '&#xf034;',
		'icon-text-width' => '&#xf035;',
		'icon-align-left' => '&#xf036;',
		'icon-align-center' => '&#xf037;',
		'icon-align-right' => '&#xf038;',
		'icon-align-justify' => '&#xf039;',
		'icon-list' => '&#xf03a;',
		'icon-indent-left' => '&#xf03b;',
		'icon-indent-right' => '&#xf03c;',
		'icon-facetime-video' => '&#xf03d;',
		'icon-picture' => '&#xf03e;',
		'icon-pencil' => '&#xf040;',
		'icon-map-marker' => '&#xf041;',
		'icon-adjust' => '&#xf042;',
		'icon-tint' => '&#xf043;',
		'icon-edit' => '&#xf044;',
		'icon-share' => '&#xf045;',
		'icon-check' => '&#xf046;',
		'icon-move' => '&#xf047;',
		'icon-step-backward' => '&#xf048;',
		'icon-fast-backward' => '&#xf049;',
		'icon-backward' => '&#xf04a;',
		'icon-play' => '&#xf04b;',
		'icon-pause' => '&#xf04c;',
		'icon-stop' => '&#xf04d;',
		'icon-forward' => '&#xf04e;',
		'icon-fast-forward' => '&#xf050;',
		'icon-step-forward' => '&#xf051;',
		'icon-eject' => '&#xf052;',
		'icon-chevron-left' => '&#xf053;',
		'icon-chevron-right' => '&#xf054;',
		'icon-plus-sign' => '&#xf055;',
		'icon-minus-sign' => '&#xf056;',
		'icon-remove-sign' => '&#xf057;',
		'icon-ok-sign' => '&#xf058;',
		'icon-question-sign' => '&#xf059;',
		'icon-info-sign' => '&#xf05a;',
		'icon-screenshot' => '&#xf05b;',
		'icon-remove-circle' => '&#xf05c;',
		'icon-ok-circle' => '&#xf05d;',
		'icon-ban-circle' => '&#xf05e;',
		'icon-arrow-left' => '&#xf060;',
		'icon-arrow-right' => '&#xf061;',
		'icon-arrow-up' => '&#xf062;',
		'icon-arrow-down' => '&#xf063;',
		'icon-share-alt' => '&#xf064;',
		'icon-resize-full' => '&#xf065;',
		'icon-resize-small' => '&#xf066;',
		'icon-plus' => '&#xf067;',
		'icon-minus' => '&#xf068;',
		'icon-asterisk' => '&#xf069;',
		'icon-exclamation-sign' => '&#xf06a;',
		'icon-gift' => '&#xf06b;',
		'icon-leaf' => '&#xf06c;',
		'icon-fire' => '&#xf06d;',
		'icon-eye-open' => '&#xf06e;',
		'icon-eye-close' => '&#xf070;',
		'icon-warning-sign' => '&#xf071;',
		'icon-plane' => '&#xf072;',
		'icon-calendar' => '&#xf073;',
		'icon-random' => '&#xf074;',
		'icon-comment' => '&#xf075;',
		'icon-magnet' => '&#xf076;',
		'icon-chevron-up' => '&#xf077;',
		'icon-chevron-down' => '&#xf078;',
		'icon-retweet' => '&#xf079;',
		'icon-shopping-cart' => '&#xf07a;',
		'icon-folder-close' => '&#xf07b;',
		'icon-folder-open' => '&#xf07c;',
		'icon-resize-vertical' => '&#xf07d;',
		'icon-resize-horizontal' => '&#xf07e;',
		'icon-bar-chart' => '&#xf080;',
		'icon-twitter-sign' => '&#xf081;',
		'icon-facebook-sign' => '&#xf082;',
		'icon-camera-retro' => '&#xf083;',
		'icon-key' => '&#xf084;',
		'icon-cogs' => '&#xf085;',
		'icon-comments' => '&#xf086;',
		'icon-thumbs-up-alt' => '&#xf087;',
		'icon-thumbs-down-alt' => '&#xf088;',
		'icon-star-half' => '&#xf089;',
		'icon-heart-empty' => '&#xf08a;',
		'icon-signout' => '&#xf08b;',
		'icon-linkedin-sign' => '&#xf08c;',
		'icon-pushpin' => '&#xf08d;',
		'icon-external-link' => '&#xf08e;',
		'icon-signin' => '&#xf090;',
		'icon-trophy' => '&#xf091;',
		'icon-github-sign' => '&#xf092;',
		'icon-upload-alt' => '&#xf093;',
		'icon-lemon' => '&#xf094;',
		'icon-phone' => '&#xf095;',
		'icon-check-empty' => '&#xf096;',
		'icon-bookmark-empty' => '&#xf097;',
		'icon-phone-sign' => '&#xf098;',
		'icon-twitter' => '&#xf099;',
		'icon-facebook' => '&#xf09a;',
		'icon-github' => '&#xf09b;',
		'icon-unlock' => '&#xf09c;',
		'icon-credit-card' => '&#xf09d;',
		'icon-rss' => '&#xf09e;',
		'icon-hdd' => '&#xf0a0;',
		'icon-bullhorn' => '&#xf0a1;',
		'icon-bell' => '&#xf0a2;',
		'icon-certificate' => '&#xf0a3;',
		'icon-hand-right' => '&#xf0a4;',
		'icon-hand-left' => '&#xf0a5;',
		'icon-hand-up' => '&#xf0a6;',
		'icon-hand-down' => '&#xf0a7;',
		'icon-circle-arrow-left' => '&#xf0a8;',
		'icon-circle-arrow-right' => '&#xf0a9;',
		'icon-circle-arrow-up' => '&#xf0aa;',
		'icon-circle-arrow-down' => '&#xf0ab;',
		'icon-globe' => '&#xf0ac;',
		'icon-wrench' => '&#xf0ad;',
		'icon-tasks' => '&#xf0ae;',
		'icon-filter' => '&#xf0b0;',
		'icon-briefcase' => '&#xf0b1;',
		'icon-fullscreen' => '&#xf0b2;',
		'icon-group' => '&#xf0c0;',
		'icon-link' => '&#xf0c1;',
		'icon-cloud' => '&#xf0c2;',
		'icon-beaker' => '&#xf0c3;',
		'icon-cut' => '&#xf0c4;',
		'icon-copy' => '&#xf0c5;',
		'icon-paper-clip' => '&#xf0c6;',
		'icon-save' => '&#xf0c7;',
		'icon-sign-blank' => '&#xf0c8;',
		'icon-reorder' => '&#xf0c9;',
		'icon-list-ul' => '&#xf0ca;',
		'icon-list-ol' => '&#xf0cb;',
		'icon-strikethrough' => '&#xf0cc;',
		'icon-underline' => '&#xf0cd;',
		'icon-table' => '&#xf0ce;',
		'icon-magic' => '&#xf0d0;',
		'icon-truck' => '&#xf0d1;',
		'icon-pinterest' => '&#xf0d2;',
		'icon-pinterest-sign' => '&#xf0d3;',
		'icon-google-plus-sign' => '&#xf0d4;',
		'icon-google-plus' => '&#xf0d5;',
		'icon-money' => '&#xf0d6;',
		'icon-caret-down' => '&#xf0d7;',
		'icon-caret-up' => '&#xf0d8;',
		'icon-caret-left' => '&#xf0d9;',
		'icon-caret-right' => '&#xf0da;',
		'icon-columns' => '&#xf0db;',
		'icon-sort' => '&#xf0dc;',
		'icon-sort-down' => '&#xf0dd;',
		'icon-sort-up' => '&#xf0de;',
		'icon-envelope' => '&#xf0e0;',
		'icon-linkedin' => '&#xf0e1;',
		'icon-undo' => '&#xf0e2;',
		'icon-legal' => '&#xf0e3;',
		'icon-dashboard' => '&#xf0e4;',
		'icon-comment-alt' => '&#xf0e5;',
		'icon-comments-alt' => '&#xf0e6;',
		'icon-bolt' => '&#xf0e7;',
		'icon-sitemap' => '&#xf0e8;',
		'icon-umbrella' => '&#xf0e9;',
		'icon-paste' => '&#xf0ea;',
		'icon-lightbulb' => '&#xf0eb;',
		'icon-exchange' => '&#xf0ec;',
		'icon-cloud-download' => '&#xf0ed;',
		'icon-cloud-upload' => '&#xf0ee;',
		'icon-user-md' => '&#xf0f0;',
		'icon-stethoscope' => '&#xf0f1;',
		'icon-suitcase' => '&#xf0f2;',
		'icon-bell-alt' => '&#xf0f3;',
		'icon-coffee' => '&#xf0f4;',
		'icon-food' => '&#xf0f5;',
		'icon-file-text-alt' => '&#xf0f6;',
		'icon-building' => '&#xf0f7;',
		'icon-hospital' => '&#xf0f8;',
		'icon-ambulance' => '&#xf0f9;',
		'icon-medkit' => '&#xf0fa;',
		'icon-fighter-jet' => '&#xf0fb;',
		'icon-beer' => '&#xf0fc;',
		'icon-h-sign' => '&#xf0fd;',
		'icon-plus-sign-alt' => '&#xf0fe;',
		'icon-double-angle-left' => '&#xf100;',
		'icon-double-angle-right' => '&#xf101;',
		'icon-double-angle-up' => '&#xf102;',
		'icon-double-angle-down' => '&#xf103;',
		'icon-angle-left' => '&#xf104;',
		'icon-angle-right' => '&#xf105;',
		'icon-angle-up' => '&#xf106;',
		'icon-angle-down' => '&#xf107;',
		'icon-desktop' => '&#xf108;',
		'icon-laptop' => '&#xf109;',
		'icon-tablet' => '&#xf10a;',
		'icon-mobile-phone' => '&#xf10b;',
		'icon-circle-blank' => '&#xf10c;',
		'icon-quote-left' => '&#xf10d;',
		'icon-quote-right' => '&#xf10e;',
		'icon-spinner' => '&#xf110;',
		'icon-circle' => '&#xf111;',
		'icon-reply' => '&#xf112;',
		'icon-github-alt' => '&#xf113;',
		'icon-folder-close-alt' => '&#xf114;',
		'icon-folder-open-alt' => '&#xf115;',
		'icon-expand-alt' => '&#xf116;',
		'icon-collapse-alt' => '&#xf117;',
		'icon-smile' => '&#xf118;',
		'icon-frown' => '&#xf119;',
		'icon-meh' => '&#xf11a;',
		'icon-gamepad' => '&#xf11b;',
		'icon-keyboard' => '&#xf11c;',
		'icon-flag-alt' => '&#xf11d;',
		'icon-flag-checkered' => '&#xf11e;',
		'icon-terminal' => '&#xf120;',
		'icon-code' => '&#xf121;',
		'icon-reply-all' => '&#xf122;',
		'icon-mail-reply-all' => '&#xf122;',
		'icon-star-half-empty' => '&#xf123;',
		'icon-location-arrow' => '&#xf124;',
		'icon-crop' => '&#xf125;',
		'icon-code-fork' => '&#xf126;',
		'icon-unlink' => '&#xf127;',
		'icon-question' => '&#xf128;',
		'icon-info' => '&#xf129;',
		'icon-exclamation' => '&#xf12a;',
		'icon-superscript' => '&#xf12b;',
		'icon-subscript' => '&#xf12c;',
		'icon-eraser' => '&#xf12d;',
		'icon-puzzle-piece' => '&#xf12e;',
		'icon-microphone' => '&#xf130;',
		'icon-microphone-off' => '&#xf131;',
		'icon-shield' => '&#xf132;',
		'icon-calendar-empty' => '&#xf133;',
		'icon-fire-extinguisher' => '&#xf134;',
		'icon-rocket' => '&#xf135;',
		'icon-maxcdn' => '&#xf136;',
		'icon-chevron-sign-left' => '&#xf137;',
		'icon-chevron-sign-right' => '&#xf138;',
		'icon-chevron-sign-up' => '&#xf139;',
		'icon-chevron-sign-down' => '&#xf13a;',
		'icon-html5' => '&#xf13b;',
		'icon-css3' => '&#xf13c;',
		'icon-anchor' => '&#xf13d;',
		'icon-unlock-alt' => '&#xf13e;',
		'icon-bullseye' => '&#xf140;',
		'icon-ellipsis-horizontal' => '&#xf141;',
		'icon-ellipsis-vertical' => '&#xf142;',
		'icon-rss-sign' => '&#xf143;',
		'icon-play-sign' => '&#xf144;',
		'icon-ticket' => '&#xf145;',
		'icon-minus-sign-alt' => '&#xf146;',
		'icon-check-minus' => '&#xf147;',
		'icon-level-up' => '&#xf148;',
		'icon-level-down' => '&#xf149;',
		'icon-check-sign' => '&#xf14a;',
		'icon-edit-sign' => '&#xf14b;',
		'icon-external-link-sign' => '&#xf14c;',
		'icon-share-sign' => '&#xf14d;',
		'icon-compass' => '&#xf14e;',
		'icon-collapse' => '&#xf150;',
		'icon-collapse-top' => '&#xf151;',
		'icon-expand' => '&#xf152;',
		'icon-eur' => '&#xf153;',
		'icon-gbp' => '&#xf154;',
		'icon-usd' => '&#xf155;',
		'icon-inr' => '&#xf156;',
		'icon-jpy' => '&#xf157;',
		'icon-cny' => '&#xf158;',
		'icon-krw' => '&#xf159;',
		'icon-btc' => '&#xf15a;',
		'icon-file' => '&#xf15b;',
		'icon-file-text' => '&#xf15c;',
		'icon-sort-by-alphabet' => '&#xf15d;',
		'icon-sort-by-alphabet-alt' => '&#xf15e;',
		'icon-sort-by-attributes' => '&#xf160;',
		'icon-sort-by-attributes-alt' => '&#xf161;',
		'icon-sort-by-order' => '&#xf162;',
		'icon-sort-by-order-alt' => '&#xf163;',
		'icon-thumbs-up' => '&#xf164;',
		'icon-thumbs-down' => '&#xf165;',
		'icon-youtube-sign' => '&#xf166;',
		'icon-youtube' => '&#xf167;',
		'icon-xing' => '&#xf168;',
		'icon-xing-sign' => '&#xf169;',
		'icon-youtube-play' => '&#xf16a;',
		'icon-dropbox' => '&#xf16b;',
		'icon-stackexchange' => '&#xf16c;',
		'icon-instagram' => '&#xf16d;',
		'icon-flickr' => '&#xf16e;',
		'icon-adn' => '&#xf170;',
		'icon-bitbucket' => '&#xf171;',
		'icon-bitbucket-sign' => '&#xf172;',
		'icon-tumblr' => '&#xf173;',
		'icon-tumblr-sign' => '&#xf174;',
		'icon-long-arrow-down' => '&#xf175;',
		'icon-long-arrow-up' => '&#xf176;',
		'icon-long-arrow-left' => '&#xf177;',
		'icon-long-arrow-right' => '&#xf178;',
		'icon-apple' => '&#xf179;',
		'icon-windows' => '&#xf17a;',
		'icon-android' => '&#xf17b;',
		'icon-linux' => '&#xf17c;',
		'icon-dribbble' => '&#xf17d;',
		'icon-skype' => '&#xf17e;',
		'icon-foursquare' => '&#xf180;',
		'icon-trello' => '&#xf181;',
		'icon-female' => '&#xf182;',
		'icon-male' => '&#xf183;',
		'icon-gittip' => '&#xf184;',
		'icon-sun' => '&#xf185;',
		'icon-moon' => '&#xf186;',
		'icon-archive' => '&#xf187;',
		'icon-bug' => '&#xf188;',
		'icon-vk' => '&#xf189;',
		'icon-weibo' => '&#xf18a;',
		'icon-renren' => '&#xf18b;',
	);
	ksort($icons);
	foreach($icons as $name=>$icon){
		$selected = $default==$name?'selected="selected"':'';
		echo '<option value="'.$name.'" '.$selected.' >'.$icon.' '.$name.'</option>';
	}
}