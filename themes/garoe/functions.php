<?php

/***********************************************************************************************/
/* 	Define Constants */
/***********************************************************************************************/
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT.'/images');

/***********************************************************************************************/
/* Load JS Files */
/***********************************************************************************************/
function load_custom_scripts() {
	wp_enqueue_script('bootstrap', THEMEROOT . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true);
	wp_enqueue_script('custom_script', THEMEROOT . '/js/scripts.js', array('jquery'), false, true);
}

add_action('wp_enqueue_scripts', 'load_custom_scripts');

/* Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links */
/***********************************************************************************************/
	add_theme_support('post-formats', array('link', 'quote', 'gallery', 'video'));
	add_theme_support('post-thumbnails', array('post','banner','testimonio','page','product'));
	set_post_thumbnail_size(210, 210, true);
	add_image_size('custom-blog-image', 784, 350);
	add_theme_support('automatic-feed-links');


/***********************************************************************************************/
/* Add Menus */
/***********************************************************************************************/
function register_my_menus(){
	register_nav_menus(
		array(
			'main-menu' => __('Main Menu', 'garoe-framework'),
		)
	);
}
add_action('init', 'register_my_menus');

/***********************************************************************************************/
/* Agregando nuevos SIDEBARS  */
/***********************************************************************************************/	

if (function_exists('register_sidebar')) {
	register_sidebar(
		array(
			'name'          => __('PreFooter Sidebar', 'garoe-framework'),
			'id'            => 'pre-footer',
			'description'   => __('Contiene los articulos,testimonios,red social y otros widgets', 'garoe-framework'),
			'before_widget' => '<div class="sidebar-widget-prefooter">',
			'after_widget'  => '</div> <!-- end sidebar-widget-prefooter -->',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		)
	);
}


/***********************************************************************************************/
/* Agregando nuevos tipos de post  */
/***********************************************************************************************/	

/*|>>>>>>>>>>>>>>>>>>>> BANNERS  <<<<<<<<<<<<<<<<<<<<|*/

function garoe_create_banner_post_type(){

	$labels = array(
		'name' => __('Banners'),
		'singular_name' => __('Banner'),
		'add_new' => __('Nuevo Banner'),
		'add_new_item' => __('Agregar nuevo Banner'),
		'edit_item' => __('Editar Banner'),
		'view_item' => __('Ver Banner'),
		'search_items' => __('Buscar Banners'),
		'not_found' => __('Banner no encontrado'),
		'not_found_in_trash' => __('Banner no encontrado en la papelera'),
	);

	$args = array(
		'labels'      => $labels,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag','banner_category'),
		'menu_icon'   => 'dashicons-visibility',
	);

	register_post_type('banner',$args);
}

add_action( 'init', 'garoe_create_banner_post_type' );

/*|>>>>>>>>>>>>>>>>>>>> TESTIMONIO  <<<<<<<<<<<<<<<<<<<<|*/

function garoe_create_testimonio_post_type(){

	$labels = array(
		'name'               => __('Testimonios'),
		'singular_name'      => __('Testimonio'),
		'add_new'            => __('Nuevo Testimonio'),
		'add_new_item'       => __('Agregar nuevo Testimonio'),
		'edit_item'          => __('Editar Testimonio'),
		'view_item'          => __('Ver Testimonio'),
		'search_items'       => __('Buscar Testimonios'),
		'not_found'          => __('Testimonio no encontrado'),
		'not_found_in_trash' => __('Testimonio no encontrado en la papelera'),
	);

	$args = array(
		'labels'      => $labels,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag'),
		'menu_icon'   => 'dashicons-megaphone'
	);

	register_post_type('testimonio',$args);
}

add_action( 'init', 'garoe_create_testimonio_post_type' );


/***********************************************************************************************/
/* Registrar nueva taxomomia para  nuevos tipos de post  */
/***********************************************************************************************/	

/* categorias banner */
add_action( 'init', 'create_banner_category_taxonomy', 0 );

//create a custom taxonomy categorias banner
function create_banner_category_taxonomy() {

  $labels = array(
    'name'             => __( 'Categoría Banner'),
    'singular_name'    => __( 'Categoría Banner'),
    'search_items'     => __( 'Buscar Categoría Banner'),
    'all_items'        => __( 'Todas Categorías del Banner' ),
    'parent_item'      => __( 'Categoría padre del banner' ),
    'parent_item_colon'=> __( 'Categoría padre:' ),
    'edit_item'        => __( 'Editar categoría de banner' ), 
    'update_item'      => __( 'Actualizar categoría de banner' ),
    'add_new_item'     => __( 'Agregar nueva categoría de banner' ),
    'new_item_name'    => __( 'Nuevo nombre categoría de banner' ),
    'menu_name'        => __( 'Categoria Banner' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('banner_category',array('banner'), array(
    'hierarchical'     => true,
    'labels'           => $labels,
    'show_ui'          => true,
    'show_admin_column'=> true,
    'query_var'        => true,
    'rewrite'          => array( 'slug' => 'banner-category' ),
  ));

}

/***********************************************************************************************/
/* Agregar nuevo CAMPOS PERSONALIZADOS */
/***********************************************************************************************/

//>>>>>>>>> META BOX URL VIDEO <<<<<<<<<<<<<<< 

add_action( 'add_meta_boxes', 'cd_meta_box_garoe_url_video_add' );

//llamar funcion 
function cd_meta_box_garoe_url_video_add()
{	
	//solo en testimonios
	add_meta_box( 'mb-video-garoe-url', 'Link - Url del Video', 'cd_meta_box_garoe_url_video_cb', 'testimonio', 'normal', 'high' );
}
//customizar box
function cd_meta_box_garoe_url_video_cb( $post )
{
	// $post is already set, and contains an object: the WordPress post
    global $post;

	$values = get_post_custom( $post->ID );
	$text   = isset( $values['mb_garoe_url_video_text'] ) ? $values['mb_garoe_url_video_text'][0] : '';

	// We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

    ?>
    <p>
        <label for="mb_garoe_url_video_text">Escribe la url del video : Testimonio </label>
        <input size="45" type="text" name="mb_garoe_url_video_text" id="mb_garoe_url_video_text" value="<?php echo $text; ?>" />
    </p>
    <?php    
}
//guardar la data
add_action( 'save_post', 'cd_meta_box_garoe_url_video_save' );

function cd_meta_box_garoe_url_video_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['mb_garoe_url_video_text'] ) )
        update_post_meta( $post_id, 'mb_garoe_url_video_text', wp_kses( $_POST['mb_garoe_url_video_text'], $allowed ) );
}


/***********************************************************************************************/
/* Localization Support */
/***********************************************************************************************/
function custom_theme_localization() {
	$lang_dir = THEMEROOT . '/lang';
	
	load_theme_textdomain('garoe-framework', $lang_dir);
}

add_action('after_theme_setup', 'custom_theme_localization');


/***********************************************************************************************/
/* Cargas opciones de la página y customizar widgets  */
/***********************************************************************************************/
require_once('functions/garoe-theme-customizer.php');
require_once('functions/widget-video.php');
require_once('functions/widget-facebook.php');
require_once('functions/widget-interesting-posts.php');
?>