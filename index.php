<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Logiq
 */

get_header();
?>

	<section class="container">

		<div class="row">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>

				<header>

					<h1 class="screen-reader-text"><?php single_post_title(); ?></h1>

				</header>

				<?php
			endif;

			while ( have_posts() ) :

				the_post();
				
				get_template_part( 'template-parts/page/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else:

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>

		</div>

	</section>

<?php
get_footer();
