<?php

function wpt_theme_styles()
{ //wpt es un nombre dado por nosotros para diferenciar con otros plugins
    wp_enqueue_style('date_picker_css', get_template_directory_uri() . '/css/jquery.datetimepicker.min.css');
    wp_enqueue_style('reset_css', get_template_directory_uri() . '/css/reset.css');
    wp_enqueue_style('fuentegoogle', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&display=swap');
    wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'wpt_theme_styles');

function wpt_theme_js()
{
    wp_enqueue_script('fontawesome_js', get_template_directory_uri() . '/js/fontawesome.js', '', '', false); //el ultimo parametro es dependence , version y si debe aparecer en el footer(false)
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


?>
