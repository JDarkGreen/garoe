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
	//bootstrap
	wp_enqueue_script('bootstrap', THEMEROOT . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true);
	//fancybox
	wp_enqueue_script('fancybox', THEMEROOT . '/js/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true);
	//script
	wp_enqueue_script('custom_script', THEMEROOT . '/js/scripts.js', array('jquery'), false, true);
}

add_action('wp_enqueue_scripts', 'load_custom_scripts');

/* Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links */
/***********************************************************************************************/
	add_theme_support('post-formats', array('link', 'quote', 'gallery', 'video'));
	add_theme_support('post-thumbnails', array('post','banner','testimonio','page','product','galeria-imagen'));
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


function garoe_create_post_type(){

	/*|>>>>>>>>>>>>>>>>>>>> BANNERS  <<<<<<<<<<<<<<<<<<<<|*/
	
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

	/*|>>>>>>>>>>>>>>>>>>>> TESTIMONIO  <<<<<<<<<<<<<<<<<<<<|*/
	$labels2 = array(
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

	$args2 = array(
		'labels'      => $labels2,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag'),
		'menu_icon'   => 'dashicons-megaphone'
	);

	/*|>>>>>>>>>>>>>>>>>>>> Galería Imágenes <<<<<<<<<<<<<<<<<<<<|*/
	$labels3 = array(
		'name'               => __('Galería Imagen'),
		'singular_name'      => __('Imagen'),
		'add_new'            => __('Nueva Imagen'),
		'add_new_item'       => __('Agregar nueva Imagen'),
		'edit_item'          => __('Editar Imagen'),
		'view_item'          => __('Ver Imagen'),
		'search_items'       => __('Buscar Imagen'),
		'not_found'          => __('Imagen no encontrado'),
		'not_found_in_trash' => __('Imagen no encontrado en la papelera'),
	);

	$args3 = array(
		'labels'      => $labels3,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag'),
		'menu_icon'   => 'dashicons-format-gallery'
	);

	/*|>>>>>>>>>>>>>>>>>>>> Galería Videos <<<<<<<<<<<<<<<<<<<<|*/
	$labels4 = array(
		'name'               => __('Galería Videos'),
		'singular_name'      => __('Video'),
		'add_new'            => __('Nueva Video'),
		'add_new_item'       => __('Agregar nueva Video'),
		'edit_item'          => __('Editar Video'),
		'view_item'          => __('Ver Video'),
		'search_items'       => __('Buscar Video'),
		'not_found'          => __('Video no encontrado'),
		'not_found_in_trash' => __('Video no encontrado en la papelera'),
	);

	$args4 = array(
		'labels'      => $labels4,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag'),
		'menu_icon'   => 'dashicons-video-alt3'
	);
	
	/*|>>>>>>>>>>>>>>>>>>>> REGISTRAR  <<<<<<<<<<<<<<<<<<<<|*/
	register_post_type('banner',$args);
	register_post_type('testimonio',$args2);
	register_post_type('galeria-imagen',$args3);
	register_post_type('galeria-video',$args4);
}

add_action( 'init', 'garoe_create_post_type' );



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

//>>>>>>>>> META BOX URL VIDEO  <<<<<<<<<<<<<<<

$arr_pstype_video = ['testimonio','galeria-video']; 

add_action( 'add_meta_boxes', 'cd_meta_box_garoe_url_video_add' );

//llamar funcion 
function cd_meta_box_garoe_url_video_add()
{	
	//solo en testimonios
	add_meta_box( 'mb-video-garoe-url', 'Link - Url del Video', 'cd_meta_box_garoe_url_video_cb', $arr_pstype_video , 'normal', 'high' );
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
        <label for="mb_garoe_url_video_text">Escribe la url del video : </label>
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
/* Agregar nuevas columnas en el panel de administracion   */
/***********************************************************************************************/

function inox_add_thumbnail_columns( $columns ) {
    $columns = array(
		'cb'             => '<input type="checkbox" />',
		'featured_thumb' => 'Thumbnail',
		'title'          => 'Title',
		'author'         => 'Author',
		'categories'     => 'Categories',
		'tags'           => 'Tags',
		'comments'       => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
		'date'           => 'Date'
    );
    return $columns;
}

function inox_add_thumbnail_columns_data( $column, $post_id ) {
    switch ( $column ) {
    case 'featured_thumb':
        echo '<a href="' . get_edit_post_link() . '">';
        echo the_post_thumbnail( 'thumbnail' );
        echo '</a>';
        break;
    }
}

if ( function_exists( 'add_theme_support' ) ) {
    add_filter( 'manage_posts_columns' , 'inox_add_thumbnail_columns' );
    add_action( 'manage_posts_custom_column' , 'inox_add_thumbnail_columns_data', 10, 2 );
    add_filter( 'manage_pages_columns' , 'inox_add_thumbnail_columns' );
    add_action( 'manage_pages_custom_column' , 'inox_add_thumbnail_columns_data', 10, 2 );
}

/***********************************************************************************************/
/* Cargas opciones de la página y customizar widgets  */
/***********************************************************************************************/
require_once('functions/garoe-theme-customizer.php');
require_once('functions/widget-video.php');
require_once('functions/widget-facebook.php');
require_once('functions/widget-interesting-posts.php');
?>