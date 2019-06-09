<?php
/*
Template Name: Lista Turnos
 */

?>
<?php get_header();?>

<?php

$current_user = wp_get_current_user();

$args = array(
    'numberposts' => -1,
    'post_type' => 'turnos',
    'meta_key' => 'userid',
    'meta_value' => get_current_user_id(),
);

$query = new WP_Query($args);
?>
<h1 class="tituloTurnos">Próximos turnos del paciente: <span><?php echo $current_user->user_lastname . ' ' . $current_user->user_firstname;?></span></h1>
<table width="100%" class="tabla">
  <tr>
    <th>FECHA</th>
    <th>HORA</th>
    <th>SERVICIO</th>
    <th>DOCTOR</th>
  </tr>

<?php if ($query->have_posts()): while ($query->have_posts()): $query->the_post();?>
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

<?php get_footer();?>