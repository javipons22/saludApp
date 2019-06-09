<?php get_header();?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<h1 class="tituloNoticia"><?php the_title();?></h1>
<div class="containerNavegadorNoticias">
<?php previous_post_link('%link','Noticia Anterior'); ?> <?php next_post_link('%link','Noticia Siguiente');?>
</div>
<div class="containerContenidoNoticias">
	<div class="noticiaImagen"><?php the_post_thumbnail(); ?></div>
	<p><?php the_content();?></p>
</div>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer();?>