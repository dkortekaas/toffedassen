<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Logiq
 */

get_header();
?>

	<section class="container">

		<div class="row">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/post/', get_post_type() );

			the_post_navigation();

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

		</div>

	</section>

<?php
get_footer();
