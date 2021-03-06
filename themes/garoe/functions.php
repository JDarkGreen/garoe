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
	//slidebars
	wp_enqueue_script('slidebars', THEMEROOT . '/js/slidebars.min.js', array('jquery'), '0.13.3', true);
	//bootstrap
	wp_enqueue_script('bootstrap', THEMEROOT . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true);
	//fancybox
	wp_enqueue_script('fancybox', THEMEROOT . '/js/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true);
	//valitate
	wp_enqueue_script('validate', THEMEROOT . '/js/jquery.validate.min.js', array('jquery'), '1.15', true);
	
	//script
	wp_enqueue_script('custom_script', THEMEROOT . '/js/scripts.js', array('jquery'), false, true);
}

add_action('wp_enqueue_scripts', 'load_custom_scripts');

/* Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links */
/***********************************************************************************************/
	add_theme_support('post-formats', array('link', 'quote', 'gallery', 'video'));
	add_theme_support('post-thumbnails', array('post','banner','testimonio','page','product','galeria-imagen','servicio'));
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
		'taxonomies'  => array('post-tag','testimonio_category'),
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

	/*|>>>>>>>>>>>>>>>>>>>> SERVICIO  <<<<<<<<<<<<<<<<<<<<|*/
	$labels5 = array(
		'name'               => __('Servicios'),
		'singular_name'      => __('Servicio'),
		'add_new'            => __('Nuevo Servicio'),
		'add_new_item'       => __('Agregar nuevo Servicio'),
		'edit_item'          => __('Editar Servicio'),
		'view_item'          => __('Ver Servicio'),
		'search_items'       => __('Buscar Servicio'),
		'not_found'          => __('Testimonio no encontrado'),
		'not_found_in_trash' => __('Testimonio no encontrado en la papelera'),
	);

	$args5 = array(
		'labels'      => $labels5,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag'),
		'menu_icon'   => 'dashicons-portfolio'
	);
	
	/*|>>>>>>>>>>>>>>>>>>>> REGISTRAR  <<<<<<<<<<<<<<<<<<<<|*/
	register_post_type('banner',$args);
	register_post_type('testimonio',$args2);
	register_post_type('galeria-imagen',$args3);
	register_post_type('galeria-video',$args4);
	register_post_type('servicio',$args5);
}

add_action( 'init', 'garoe_create_post_type' );



/***********************************************************************************************/
/* Registrar nueva taxomomia para  nuevos tipos de post  */
/***********************************************************************************************/	

//create a custom taxonomy 
add_action( 'init', 'create_garoe_taxonomy', 0 );

function create_garoe_taxonomy() {

	/*>>>>>>>>>>>> categorias banner */
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
	/*>>>>>>>>>>>> categorias testimonios */
	$labels2 = array(
	    'name'             => __( 'Categoría Testimonio'),
	    'singular_name'    => __( 'Categoría Testimonio'),
	    'search_items'     => __( 'Buscar Categoría Testimonio'),
	    'all_items'        => __( 'Todas Categorías del Testimonio' ),
	    'parent_item'      => __( 'Categoría padre del Testimonio' ),
	    'parent_item_colon'=> __( 'Categoría padre:' ),
	    'edit_item'        => __( 'Editar categoría de Testimonio' ), 
	    'update_item'      => __( 'Actualizar categoría de Testimonio' ),
	    'add_new_item'     => __( 'Agregar nueva categoría de Testimonio' ),
	    'new_item_name'    => __( 'Nuevo nombre categoría de Testimonio' ),
	    'menu_name'        => __( 'Categoria Testimonio' ),
	); 	

  //registrar taxonomía
  	register_taxonomy('banner_category',array('banner'), array(
	    'hierarchical'     => true,
	    'labels'           => $labels,
	    'show_ui'          => true,
	    'show_admin_column'=> true,
	    'query_var'        => true,
	    'rewrite'          => array( 'slug' => 'banner-category' ),
  	));  	
  	register_taxonomy('testimonio_category',array('testimonio'), array(
	    'hierarchical'     => true,
	    'labels'           => $labels2,
	    'show_ui'          => true,
	    'show_admin_column'=> true,
	    'query_var'        => true,
	    'rewrite'          => array( 'slug' => 'testimonio-category' ),
  	));

}

/***********************************************************************************************/
/* Agregar nuevo CAMPOS PERSONALIZADOS */
/***********************************************************************************************/

//>>>>>>>>> META BOX URL VIDEO  <<<<<<<<<<<<<<<

$arr_pstype_video = array('testimonio','galeria-video'); 

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

//>>>>>>>>> META BOX PROMOCION PRODUCTO  <<<<<<<<<<<<<<<
$arr_pstype = array('product'); 

add_action( 'add_meta_boxes', 'cd_meta_box_garoe_promotion_add' );

//llamar funcion 
function cd_meta_box_garoe_promotion_add()
{	
	//solo en productos
	add_meta_box( 'mb-garoe-promotion-product', 'Promoción Producto', 'cd_meta_box_garoe_prom_product_cb', 'product' , 'side', 'high' );
}
//customizar box
function cd_meta_box_garoe_prom_product_cb( $post )
{
	// $post is already set, and contains an object: the WordPress post
    global $post;

	$values = get_post_custom( $post->ID );
	$check  = isset( $values['mb_garoe_prom_product'] ) ? $values['mb_garoe_prom_product'][0] : '';

	// We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

    ?>
    <p>
		<input type="checkbox" id="mb_garoe_prom_product" name="mb_garoe_prom_product" <?php checked( $check, 'on' ); ?> />
        <label for="mb_garoe_prom_product">Dale check si es producto Promocionado:</label>
    </p>
    <?php    
}
//guardar la data
add_action( 'save_post', 'cd_meta_box_garoe_prom_product_save' );

function cd_meta_box_garoe_prom_product_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // Make sure your data is set before trying to save it
	$chk = isset( $_POST['mb_garoe_prom_product'] ) && $_POST['mb_garoe_prom_product'] ? 'on' : 'off';
    update_post_meta( $post_id, 'mb_garoe_prom_product', $chk );
}

//>>>>>>>>> META BOX SELECT ADJUNTAR PROMOCION PRODUCTO AL BANNER PRINCIPAL <<<<<<<<<<<<<<<

add_action( 'add_meta_boxes', 'cd_meta_box_garoe_banner_promotion_add' );

//llamar funcion 
function cd_meta_box_garoe_banner_promotion_add()
{	
	//adjunto en banner
	add_meta_box( 'mb-garoe-banner-promotion-product', 'Banner Adjunto Promoción Producto', 'cd_meta_box_garoe_banner_prom_product_cb', 'banner' , 'side', 'high' );
}
//customizar box
function cd_meta_box_garoe_banner_prom_product_cb( $post )
{
	// $post is already set, and contains an object: the WordPress post
   global $post;
	$values   = get_post_custom( $post->ID );
	$selected = isset( $values['mb_garoe_banner_prom_product'] ) ? esc_attr( $values['mb_garoe_banner_prom_product'][0] ) : 'none';

	// We'll use this nonce field later on when saving.
  wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' ); ?>

	<p>
  	<label for="mb_garoe_banner_prom_product">Selecciona Producto Promoción adjunto al banner:</label>
  	<br />
    <select name="mb_garoe_banner_prom_product" id="mb_garoe_banner_prom_product">
      <option value="none" <?php selected( $selected, 'none' ); ?>>Ninguno</option>
      <!-- Mostrar todos los productos  -->
      <?php  
      	$args = array('post_type'=>'product','posts_per_page'=>-1,'order'=>'ASC','orderby'=>'name');
      	$productos = get_posts( $args );

      	foreach( $productos as $product ) :
      ?>
    		<option value="<?= $product->post_name ?>" <?php selected( $selected, $product->post_name ); ?> ><?= $product->post_title ?></option>
    	<?php endforeach; ?>
    </select>
  </p>

<?php 
}

//guardar la data
add_action( 'save_post', 'cd_meta_box_garoe_banner_prom_product_save' );

function cd_meta_box_garoe_banner_prom_product_save( $post_id )
{
  // Bail if we're doing an auto save
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
   
  // if our nonce isn't there, or we can't verify it, bail
  if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
   
  // if our current user can't edit this post, bail
  if( !current_user_can( 'edit_post' ) ) return;
   
  // Make sure your data is set before trying to save it
  if( isset( $_POST['mb_garoe_banner_prom_product'] ) )
    update_post_meta( $post_id, 'mb_garoe_banner_prom_product', esc_attr( $_POST['mb_garoe_banner_prom_product'] ) );
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
		"destination"    => "Destination",
		'tags'           => 'Tags',
		'comments'       => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
		'date'           => 'Date'
    );
    return $columns;
}

function inox_add_thumbnail_columns_data( $column, $post_id ) {
    switch ( $column ) {

	    //>>>CASO THUMBNAIL
	    case 'featured_thumb':
	        echo '<a href="' . get_edit_post_link() . '">';

	        //tipo de post 
	        $post_type = get_post_type( $post_id );

	        switch (  $post_type ) {
	        	case 'testimonio': //caso testimonio
	        		//conseguir el video
	        		$video = get_post_meta( $post_id , 'mb_garoe_url_video_text' , true ); 
						if ( !empty($video) && has_term( 'video' , 'testimonio_category' ,  $post_id ) ) : //si tiene video y pertenece a la categoria video
							$video = str_replace("watch?v=", "embed/", $video );
						?>
							<iframe width="100%" height="100" src="<?= $video; ?>" allowfullscreen></iframe>
					<?php endif;
	        		echo the_post_thumbnail(array(80,80));
	        	break;

	        	case 'galeria-video': //caso video galerias
	        		//conseguir el video
	        		$video = get_post_meta( $post_id , 'mb_garoe_url_video_text' , true ); 
						if ( !empty($video)  ) : //si tiene video y pertenece a la categoria video
							$video = str_replace("watch?v=", "embed/", $video );
						?>
							<iframe width="100%" height="100" src="<?= $video; ?>" allowfullscreen></iframe>
					<?php endif;
	        	break;
	        	
	        	default:
	        		echo the_post_thumbnail(array(100,100));
	        		break;
	        }

	        echo '</a>';
	    break;

	    //>>>CASO CATEGORIAS
		case "destination":
	  		$post_type = get_post_type( $post_id );

	  		switch (  $post_type ) {
	        	case 'testimonio': //caso testimonio
	        		$terms = get_the_terms( $post_id , 'testimonio_category' );
	        		echo  "<p style='text-align:left;'>";
	        		if( !empty($terms) ){
	        			foreach ($terms as $term ) { echo $term->name . " "; }
	        		}else{
	        			echo "sin categoria";
	        		}
	        		echo "</p>";
	        	break;
	        }
	    break;
    }
}

if ( function_exists( 'add_theme_support' ) ) {
    //add_filter( 'manage_posts_columns' , 'inox_add_thumbnail_columns' );
    //add_action( 'manage_posts_custom_column' , 'inox_add_thumbnail_columns_data', 10, 2 );

    //add_filter( 'manage_pages_columns' , 'inox_add_thumbnail_columns' );
    //add_action( 'manage_pages_custom_column' , 'inox_add_thumbnail_columns_data', 10, 2 );
}

/***********************************************************************************************/
/* Cargas opciones de la página y customizar widgets  */
/***********************************************************************************************/
require_once('functions/garoe-theme-customizer.php');
require_once('functions/widget-video.php');
require_once('functions/widget-facebook.php');
require_once('functions/widget-interesting-posts.php');
?>