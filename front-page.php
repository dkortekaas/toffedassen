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

	<?php get_template_part( 'parts/home/content', 'hero' ); ?>

	<?php get_template_part( 'parts/home/content', 'cta' ); ?>

	<?php get_template_part( 'parts/home/products', 'home' ); ?>

	<?php get_template_part( 'parts/home/content', 'instagram' ); ?>

<?php
get_footer();
