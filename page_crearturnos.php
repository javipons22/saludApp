<?php
/*
Template Name: Crear Turnos
*/

?>
<?php get_header();?>
<?php if (is_user_logged_in()): ?>
<?php
global $wpdb;

// Array con servicios disponibles , se podrian obtener tambien de un custom post type
$servicios = array('ALERGIA', 'CARDIOLOGIA', 'CIRUGIA', 'CIRUGIA ORL', 'CLINICA MEDICA', 'DERMATOLOGIA', 'DIABETOLOGIA', 'ENDOCRINOLOGIA', 'FLEBOLOGIA', 'GASTROENTEROLOGIA', 'GINECOLOGIA', 'GINECOLOGIA - CIRUGIA', 'MEDICINA FAMILIAR/GENERALISTA', 'NEFROLOGIA', 'NEUMONOLOGIA', 'NEUROCIRUGIA', 'NEUROLOGIA', 'NUTRICION', 'OFTALMOLOGIA', 'OFTALMOLOGIA PEDIATRICA', 'OTORRINOLARINGOLOGIA', 'PEDIATRIA', 'REUMATOLOGIA', 'TRAUMATOLOGIA', 'UROLOGIA');

// Array con doctores disponibles , se tienen que agregar despues desde un post type
$doctores = array('CARRANZA', 'LOPEZ', 'PONS');

// Creamos un array error para almacenar errores y mostrarlos en pantalla
$error = array();

// Cuando hacemos submit:
if ($_POST) {

    // Hacemos escape para prevenir cross site scripting
    $fecha = $wpdb->escape($_POST['fecha']);
    $hora = $wpdb->escape($_POST['hora']);
    $servicio = $wpdb->escape($_POST['servicio']);
    $doctor = $wpdb->escape($_POST['doctor']);
    $user_id = get_current_user_id();

    // Obtenemos fecha y hora como numero para despues ordenarlos en page_turnos.php
    $fecha_hora = $fecha . ' ' . $hora . ':00';
    $format = "d/m/Y H:i:s";
    $dateobj = DateTime::createFromFormat($format, $fecha_hora);
    $iso_datetime = $dateobj->format(Datetime::ATOM);
    $fecha_numero = strtotime($iso_datetime);


    // Obtenemos el objeto current user para pasar nombre y apellido de paciante en titulo del turno
    $current_user = wp_get_current_user();

    if (empty($fecha) || empty($hora) || empty($servicio) || empty($doctor)) {
        array_push($error, "Faltan completar campos , por favor complete todos");
    }

    // Si no hay errores proceder a la creacion del turno
    if (count($error) == 0) {

        $my_post = array(
            'post_title' => '( PACIENTE: ' . $current_user->user_lastname . ' ' . $current_user->user_firstname . ') - ' . $servicio . ' - ' . $doctor . ' - ' . $fecha . ' ' . $hora,
            'post_type' => 'turnos',
            'post_status' => 'publish',
        );

        // Insertamos el post en wordpress
        $post_id = wp_insert_post($my_post);

        update_field('servicio', $servicio, $post_id);
        update_field('doctor', $doctor, $post_id);
        update_field('fecha', $fecha, $post_id);
        update_field('hora', $hora, $post_id);
        update_field('userid', $user_id, $post_id);
        update_field('fechahoranum', $fecha_numero, $post_id);
        

        // Si no existe error o si existe error
        if (!is_wp_error($post_id)) {
            echo "<script>window.location.href = '". home_url() ."/turnos'</script>";
        } else {
            echo "Hubo errores al crear el turno";
        }

    } else {
        echo $error[0];
    }
}
?>
<form method="post" autocomplete="off">
<select name="servicio">
<?php
// iteramos en el array servicios y creamos una opcion para cada uno
foreach ($servicios as $servicio) {
    echo "<option value='" . $servicio . "'>" . $servicio . "</option>";
}
?>
</select>
<select name="doctor">
<?php
// iteramos en el array servicios y creamos una opcion para cada uno
foreach ($doctores as $doctor) {
    echo "<option value='" . $doctor . "'>" . $doctor . "</option>";
}
?>
</select>
<input id="datepicker" type="text" name="fecha" >
<input id="timepicker" type="text" name="hora" >
<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Registrarse" />

</form>
<?php else: ?>
    <p>Debes iniciar sesion</p>
<?php endif;?>
<?php get_footer();?>