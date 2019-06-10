<?php
/*
Template Name: SignUp
 */
get_header();
if (!is_user_logged_in()):
global $wpdb;

if ($_POST) {

    // Hacemos escape de los datos para prevenir inyecciones de codigo
    $nombre = $wpdb->escape($_POST['nombre']);
    $apellido = $wpdb->escape($_POST['apellido']);
    $dni = $wpdb->escape($_POST['dni']);
    $username = $wpdb->escape($_POST['username']);
    $email = $wpdb->escape($_POST['email']);
    $password = $wpdb->escape($_POST['pwd']);
    $ConfPassword = $wpdb->escape($_POST['confpwd']);

    // El array contendrá los errores a mostrar
    $error = array();

    // Chequeamos los campos que no contengan errores
    if (strpos($username, ' ') !== false) {
        array_push($error, "El usuario no puede tener espacios");
    }

    if (empty($nombre) || empty($username) || empty($apellido) || empty($dni)) {
        array_push($error, "Faltan completar campos , por favor complete todos");
    }

    if (username_exists($username)) {
        array_push($error, "El usuario ya existe, por favor escriba otro");
    }

    if (!empty($dni) && !is_numeric($dni)) {
        array_push($error, "El DNI debe contener numeros solamente");
    }

    if (!is_email($email)) {
        array_push($error, "El email no es válido");
    }

    if (email_exists($email)) {
        array_push($error, "El email ya existe");
    }

    if (strcmp($password, $ConfPassword) !== 0) {
        array_push($error, "Las contraseñas no coinciden");
    }

    if (count($error) == 0) {
        
        // Array a pasar a la funcion wp_insert_user con datos de usuario
        $userdata = array(
            'user_login' => $username,
            'user_pass' => $password, // When creating a new user, `user_pass` is expected.
            'user_email' => $email,
            'first_name' => $nombre,
            'last_name' => $apellido,
            'description' => $dni
        );

        // La funcion devuelve el user_id
        $user_id = wp_insert_user($userdata);

        // Si no existe error o si existe error
        if (!is_wp_error($user_id)) {
            echo "Usuario Creado correctamente";
        } else {
            echo "Hubo errores al crear el usuario";
        }
    } else {

        print_r($error);

    }
}
?>
<?php

?>

<form name="registerform" id="registerform" method="post">

			<p class="register-nombre">
				<label for="user_nombre">Nombre</label>
				<input type="text" name="nombre" id="user_nombre" class="input" value="" size="50" />
			</p>
            <p class="register-apellido">
				<label for="user_apellido">Apellido</label>
				<input type="text" name="apellido" id="user_apellido" class="input" value="" size="50" />
			</p>
            <p class="register-dni">
				<label for="user_dni">DNI</label>
				<input type="text" name="dni" id="user_dni" class="input" value="" size="8" />
			</p>
            <p class="register-username">
				<label for="user_username">Nombre de Usuario</label>
				<input type="text" name="username" id="user_username" class="input" value="" size="30" />
			</p>
            <p class="register-email">
				<label for="user_email">E-mail</label>
				<input type="email" name="email" id="user_email" class="input" value="" size="30" />
			</p>
			<p class="register-password">
				<label for="user_pass">Contraseña</label>
				<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" />
			</p>
            <p class="register-confpassword">
				<label for="user_confpass">Escriba de nuevo la contraseña</label>
				<input type="password" name="confpwd" id="user_confpass" class="input" value="" size="20" />
			</p>

			<p class="register-submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Registrarse" />
			</p>

</form>

<?php else:?>
    <p>Ya iniciaste Sesión (debes cerrar sesión para crear una cuenta nueva)</p>
<?php endif;?>

<?php get_footer();?>