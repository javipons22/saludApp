<?php
/*
Template Name: Lista Turnos
 */

?>
<?php get_header();?>

<?php if (is_user_logged_in()):?>

<?php

$current_user = wp_get_current_user();

// Hacemos un query que filtre por User ID y ordene por fechahoranum creado en page_crearturnos.php
$args = array(
    'post_type' => 'turnos',
    'posts_per_page' => -1,
    'meta_query' =>
        array(
            'key'       => 'userid',
            'compare'   => '=',
            'value'     => get_current_user_id()
        ),
    'meta_key'          => 'fechahoranum',
    'type'              => 'numeric', 
    'orderby'           => 'meta_value',
    'order'             => 'ASC'
);



$query = new WP_Query($args);
?>
<h1 class="tituloTurnos">Próximos turnos del paciente: <span><?php echo $current_user->user_lastname . ' ' . $current_user->user_firstname;?></span></h1>
<p>NOTA: Los turnos estan ordenados de más recientes a menos recientes.</p>
<table width="100%" class="tabla">
  <tr>
    <th>FECHA</th>
    <th>HORA</th>
    <th>SERVICIO</th>
    <th>MEDICO</th>
  </tr>

<?php if ($query->have_posts()): while ($query->have_posts()): $query->the_post(); ?>
		        <?php
        echo "<tr>";
        echo "<td>"; the_field('fecha'); echo "</td>";
        echo "<td>"; the_field('hora'); echo "</td>";
        echo "<td>"; the_field('servicio'); echo "</td>";
        echo "<td>"; the_field('doctor'); echo "</td>";
        echo "</tr>";
        ?>
				<?php endwhile;else: ?>
	<?php echo '<tr><td colspan="4" class="noTurno">No tienes ningun turno aún.</td></tr>';?>
<?php endif;?>
</table>

<a class="ctaTurnos" href="<?php echo get_site_url(); ?>/crear-turnos">SOLICITAR TURNO</a>
<?php else:?>
    <p>Debes iniciar sesion</p>
<?php endif;?>

<?php get_footer();?>