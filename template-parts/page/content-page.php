<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Logiq
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page_header">

		<?php the_title( '<h1>', '</h1>' ); ?>

	</header>

	<?php logiq_wp_post_thumbnail(); ?>

	<section class="page_content">

		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<nav class="page_links">' . esc_html__( 'Pages:', 'logiq' ),
			'after'  => '</nav>',
		) );
		?>

	</section>

	<?php if ( get_edit_post_link() ) : ?>

		<footer class="page_footer">

			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'logiq' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>

		</footer>

	<?php endif; ?>

</article>
