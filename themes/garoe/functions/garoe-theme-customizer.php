<?php
/***********************************************************************************************/
/* Add a menu option to link to the customizer */
/***********************************************************************************************/
add_action('admin_menu', 'display_custom_options_link');
function display_custom_options_link() {
	add_theme_page('Garoe Options', 'Garoe Options', 'edit_theme_options', 'customize.php');
}

/***********************************************************************************************/
/* Add options in the theme customizer page */
/***********************************************************************************************/
add_action('customize_register', 'garoe_customize_register');
function garoe_customize_register($wp_customize) {
	// Logo 
	$wp_customize->add_section('garoe_logo', array(
		'title' => __('Logo', 'garoe-framework'),
		'description' => __('Permite subir tu logo personalizado.', 'garoe-framework'),
		'priority' => 35
	));
	
	$wp_customize->add_setting('garoe_custom_settings[logo]', array(
		'default' => IMAGES . '/logo.png',
		'type' => 'option'
	));
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
		'label' => __('Carga tu Logo', 'garoe-framework'),
		'section' => 'garoe_logo',
		'settings' => 'garoe_custom_settings[logo]'
	)));
	
	// Top Ad
	$wp_customize->add_section('garoe_ad', array(
		'title' => __('Top Ad', 'garoe-framework'),
		'description' => __('Allows you to upload an ad banner to display on the top of the page.', 'garoe-framework'),
		'priority' => 36
	));
	
	
	// Contact Email
	$wp_customize->add_section('garoe_contact_email', array(
		'title' => __('Correo Contacto de Formulario', 'garoe-framework'),
		'description' => __('Escribe el Correo Contacto de Formulario', 'garoe-framework'),
		'priority' => 37
	));
	
	$wp_customize->add_setting('garoe_custom_settings[contact_email]', array(
		'default' => '',
		'type' => 'option'
	));
	
	$wp_customize->add_control('garoe_custom_settings[contact_email]', array(
		'label'    => __('Dirección Contacto de Formulario', 'garoe-framework'),
		'section'  => 'garoe_contact_email',
		'settings' => 'garoe_custom_settings[contact_email]',
		'type'     => 'text'
	));

	//Customizar telefono
	$wp_customize->add_section('garoe_contact_tel', array(
		'title' => __('Teléfono de Contacto', 'garoe-framework'),
		'description' => __('Teléfono de Contacto', 'garoe-framework'),
		'priority' => 38
	));
	
	$wp_customize->add_setting('garoe_custom_settings[contact_tel]', array(
		'default' => '',
		'type' => 'option'
	));
	
	$wp_customize->add_control('garoe_custom_settings[contact_tel]', array(
		'label'    => __('Escribe el o los números de teléfono del contacto separados por comas', 'garoe-framework'),
		'section'  => 'garoe_contact_tel',
		'settings' => 'garoe_custom_settings[contact_tel]',
		'type'     => 'text'
	));

	//Customizar celular
	$wp_customize->add_section('garoe_contact_cel', array(
		'title' => __('Celular de Contacto', 'garoe-framework'),
		'description' => __('Celular de Contacto', 'garoe-framework'),
		'priority' => 39
	));
	
	$wp_customize->add_setting('garoe_custom_settings[contact_cel]', array(
		'default' => '',
		'type' => 'option'
	));
	
	$wp_customize->add_control('garoe_custom_settings[contact_cel]', array(
		'label'    => __('Escribe el o los números de celular del contacto separados por comas', 'garoe-framework'),
		'section'  => 'garoe_contact_cel',
		'settings' => 'garoe_custom_settings[contact_cel]',
		'type'     => 'text'
	));

	//Customizar WIDGET NOSOTROS
	$wp_customize->add_section('garoe_widget_nosotros', array(
		'title' => __('Sección WIDGET NOSOTROS', 'garoe-framework'),
		'description' => __('Sección WIDGET NOSOTROS', 'garoe-framework'),
		'priority' => 40
	));
	
	$wp_customize->add_setting('garoe_custom_settings[widget_nosotros]', array(
		'default' => '',
		'type' => 'option'
	));
	
	$wp_customize->add_control('garoe_custom_settings[widget_nosotros]', array(
		'label'    => __('Escribe contenido que ira en widget nosotros en el footer', 'garoe-framework'),
		'section'  => 'garoe_widget_nosotros',
		'settings' => 'garoe_custom_settings[widget_nosotros]',
		'type'     => 'textarea'
	));


}	
?>