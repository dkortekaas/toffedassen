<?php
/**
 * @package Toffe Dassen
 */

$category = '';
$fields   = (array) toffedassen_get_option( 'post_entry_meta' );
if ( in_array( 'scat', $fields ) ) {
	$category = get_the_terms( get_the_ID(), 'category' );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-wrapper single-post-wrapper' ); ?>>
	<header class="entry-header">
		<?php
		if ( ! is_wp_error( $category ) && $category ) {
			echo sprintf( '<a href="%s" class="entry-cat">%s</a>', esc_url( get_term_link( $category[0], 'category' ) ), esc_html( $category[0]->name ) );
		} ?>
		<h2 class="entry-title"><?php the_title() ?></h2>
		<?php toffedassen_single_entry_meta(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'toffedassen' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php toffedassen_entry_footer(); ?>

</article><!-- #post-## -->
