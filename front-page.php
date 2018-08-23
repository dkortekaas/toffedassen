<?php
/**
 * Template part for displaying front page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Toffedassen
 */

get_header();

?>

	<div class="container-fluid">
		<div class="row">

			<?php get_template_part( 'template-parts/general/content', 'hero' ); ?>

			<?php get_template_part( 'template-parts/shop/products', 'home' ); ?>

		</div>
	</div>

<?php
get_footer();
