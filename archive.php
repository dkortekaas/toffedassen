<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Logiq
 */

get_header();
?>

	<section class="container">

		<div class="row">

		<?php if ( have_posts() ) : ?>

			<header>
				<?php
				the_archive_title( '<h1>', '</h1>' );
				the_archive_description( '<div>', '</div>' );
				?>
			</header>

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/page/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>

		</div>

	</section>

<?php
get_footer();
