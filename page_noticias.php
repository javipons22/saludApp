<?php
/*
Template Name: Noticias
 */
?>
<?php get_header();?>
<?php $args = array(
    'post_type' => 'noticias',
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC',
);

$query = new WP_Query($args);
?>
<h1 class="tituloTurnos">Portal de noticias</h1>
<?php if ($query->have_posts()): while ($query->have_posts()): $query->the_post();?>
<div class="noticia">
  <div class="imagen"><img src="<?php the_field('imagen');?>" alt="imagen <?php the_title(); ?>"></div>
  <div class="contenido-noticia">
    <div class="noticia-top">
      <h1><?php the_title(); ?></h1>
      <p><?php the_excerpt(); ?></p>
    </div>
    <div class="noticia-info"><span><?php echo get_the_date();?></span><a href="<?php echo get_post_permalink(get_the_ID());?>">Ver Noticia Completa</a></div>
  </div>
</div>
						
						<?php endwhile;else: ?>
	<p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
<?php endif;?>

<?php get_footer();?>