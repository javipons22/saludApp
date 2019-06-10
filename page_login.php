<?php 
/* 
	Template Name: LogIn
*/
get_header(); ?>
<?php

if (is_user_logged_in() == true) {
    echo "ya iniciaste sesion!";
} else {
    if ($_GET['login'] == 'failed') {
        echo '<p class="error">Error , intente nuevamente</p>';
    }
    
    $args = array(
        'echo'           => true,
        'remember'       => true,
        'form_id'        => 'loginform',
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'label_username' => __( 'Nombre de usuario o Email' ),
        'label_password' => __( 'Contraseña' ),
        'label_remember' => __( 'Recordarme' ),
        'label_log_in'   => __( 'Log In' ),
        'value_username' => '',
        'value_remember' => false
    );
    wp_login_form( $args );
    
}

?>
<?php get_footer(); ?>