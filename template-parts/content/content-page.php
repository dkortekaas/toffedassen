<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package toffedassen
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( toffedassen_is_catalog() ) :
		get_template_part( 'template-parts/page-headers/catalog' );
	endif;
	?>

	<h2 class="entry-title hidden"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'toffedassen' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
