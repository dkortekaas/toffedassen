<?php
/**
 * @package Toffedassen
 */

$size = 'toffedassen-blog-list';
$excerpt_length = intval( toffedassen_get_option( 'excerpt_length' ) );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-wrapper">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<a class="blog-thumb" href="<?php the_permalink() ?>"><?php the_post_thumbnail( $size ) ?></a>
			</div>
		<?php endif; ?>

		<div class="entry-summary">
			<div class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<?php toffedassen_entry_meta() ?>
			</div>
			<div class="entry-excerpt"><?php echo toffedassen_content_limit( $excerpt_length, '' ); ?></div>

		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
