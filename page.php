<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Toffedassen
 */

get_header();
?>

<div id="primary" class="content-area <?php toffedassen_content_columns(); ?>">
	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/page/content', 'page' );
			//get_template_part( 'parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer();
