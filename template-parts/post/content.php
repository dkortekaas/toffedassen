<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Logiq
 */

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header>
			<?php
			if ( is_singular() ) :
				the_title( '<h1>', '</h1>' );
			else :
				the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					logiq_wp_posted_on();
					logiq_wp_posted_by();
					?>
				</div>
			<?php endif; ?>
		</header>

		<?php logiq_wp_post_thumbnail(); ?>

		<section>

			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'logiq' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'logiq' ),
				'after'  => '</div>',
			) );
			?>

		</section>

		<footer>
			<?php logiq_wp_entry_footer(); ?>
		</footer>

	</article>
