<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Logiq
 */

get_header();
?>

	<section class="container">

		<div class="row">

		<?php if ( have_posts() ) : ?>

			<header>

				<h1>
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'logiq' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>

			</header>

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/post/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>

		</div>

	</section>

<?php
get_sidebar();
get_footer();
