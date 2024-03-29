<?php

function wpt_theme_styles()
{ //wpt es un nombre dado por nosotros para diferenciar con otros plugins
    wp_enqueue_style('date_picker_css', get_template_directory_uri() . '/css/jquery.datetimepicker.min.css');
    wp_enqueue_style('reset_css', get_template_directory_uri() . '/css/reset.css');
    wp_enqueue_style('hamb_icon_css', get_template_directory_uri() . '/css/hamb-icon.css');
    wp_enqueue_style('fuentegoogle', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&display=swap');
    wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('laptop_css', get_template_directory_uri() . '/css/laptop.css');
}
add_action('wp_enqueue_scripts', 'wpt_theme_styles');

function wpt_theme_js()
{
    wp_enqueue_script('fontawesome_js', get_template_directory_uri() . '/js/all.js', '', '', false); //el ultimo parametro es dependence , version y si debe aparecer en el footer(false)
    wp_enqueue_script('date_picker_js', get_template_directory_uri() . '/js/jquery.datetimepicker.full.min.js', array('jquery'), '', true);
    wp_enqueue_script('app_js', get_template_directory_uri() . '/js/app.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'wpt_theme_js');

// Borra el admin bar para usuarios que no son admin
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

// Agregar thumbnails a los posts
add_theme_support('post-thumbnails');

//Esta funcion hace que se redireccione a la pagina de login cuando haya un error
add_action('wp_login_failed', 'custom_login_fail'); // hook login fallido
function custom_login_fail($username)
{
    $referrer = $_SERVER['HTTP_REFERER']; // de donde vino la sumision de login?
    // si hay un refferer valido y esta no es la ventana de login de wordpress
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        wp_redirect(home_url() . '/login/?login=failed'); // ponemos un querystring que agarramos con $_GET en el sitio por si hay error
        exit;
    }
}

// Si alguno o todos los campos estan vacios redireccionar a pantalla de login en vez de abrir wp-login.php
add_filter('authenticate','custom_authenticate', 31, 3);
function custom_authenticate( $user, $username, $password ) {
 
    if ( is_wp_error( $user ) && isset( $_SERVER[ 'HTTP_REFERER' ] ) && !strpos( $_SERVER[ 'HTTP_REFERER' ], 'wp-admin' ) && !strpos( $_SERVER[ 'HTTP_REFERER' ], 'wp-login.php' ) ) {
      $referrer = $_SERVER[ 'HTTP_REFERER' ];
      foreach ( $user->errors as $key => $error ) {
         if ( in_array( $key, array( 'empty_password', 'empty_username') ) ) {
            unset( $user->errors[ $key ] );
            $user->errors[ 'custom_'.$key ] = $error;
         }
      }
    }
 
    return $user;
}


add_action('wp_logout', 'auto_redirect_after_logout');
function auto_redirect_after_logout()
{
    wp_redirect(home_url());
    exit();
}

add_action('wp_login', 'auto_redirect_after_login');
function auto_redirect_after_login()
{
    wp_redirect(home_url());
    exit();
}

// Si el usuario no es admin , prohibir la entrada al dashboard
add_action('init', 'blockusers_init');

function blockusers_init()
{
    if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
        wp_redirect(home_url());
        exit;
    }
}
