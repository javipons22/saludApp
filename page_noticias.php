<?php
/*
Template Name: Noticias
 */
?>
<?php get_header();?>
<?php if (is_user_logged_in()): ?>
<?php $args = array(
    'post_type' => 'noticias',
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC',
);

$query = new WP_Query($args);
?>
<?php if ($query->have_posts()): while ($query->have_posts()): $query->the_post();?>
				<?php the_title();
        the_content();
        echo get_the_date();
        ?>
				<?php endwhile;else: ?>
	<p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
<?php endif;?>
<?php else: ?>
    <p>Debes iniciar sesion</p>
<?php endif;?>
<?php get_footer();?>