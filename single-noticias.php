<?php get_header();?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="contenedorNoticia">
<h1 class="tituloNoticia"><?php the_title();?></h1>
<div class="containerNavegadorNoticias">
<?php previous_post_link('%link','Noticia Anterior'); ?> <?php next_post_link('%link','Noticia Siguiente');?>
</div>
<div class="containerContenidoNoticias">
	<p><img src="<?php the_field('imagen');?>" alt="imagen <?php the_title(); ?>"><?php the_content();?></p>
	<p><?php echo get_the_date();?></p>
</div>
</div>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>



<?php get_footer();?>