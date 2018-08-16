<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Logiq
 */

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header>

			<?php the_title( sprintf( '<h2 class="entry_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>

				<div class="entry_meta">

				<?php
					logiq_wp_posted_on();
					logiq_wp_posted_by();
				?>

				</div>

			<?php endif; ?>

		</header>

		<?php logiq_wp_post_thumbnail(); ?>

		<section class="entry_content">

			<?php the_excerpt(); ?>

		</section>

		<footer class="entry_footer">

			<?php logiq_wp_entry_footer(); ?>

		</footer>

	</article>
