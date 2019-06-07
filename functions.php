<?php 

function wpt_theme_styles() { //wpt es un nombre dado por nosotros para diferenciar con otros plugins
	wp_enqueue_style( 'reset_css', get_template_directory_uri() . '/css/reset.css' );
	wp_enqueue_style( 'fuentegoogle' , 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&display=swap' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpt_theme_styles' );

function wpt_theme_js() {
	wp_enqueue_script( 'fontawesome_js', get_template_directory_uri() . 'js/fontawesome.js', '' , '' , false );//el ultimo parametro es dependence , version y si debe aparecer en el footer(false)
	wp_enqueue_script('app_js', get_template_directory_uri() . 'js/app.js', array('jquery') , '' , true);
}
add_action( 'wp_enqueue_scripts', 'wpt_theme_js' );

?>