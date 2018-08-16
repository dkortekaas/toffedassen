<?php
/**
 * Template part for displaying front page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Logiq
 */

get_header();

	get_template_part( 'template-parts/general/content', 'hero' );

	get_template_part( 'template-parts/general/content', 'leader' );

	get_template_part( 'template-parts/page/content', 'front-page' );

	get_template_part( 'template-parts/general/content', 'services' );

	get_template_part( 'template-parts/general/content', 'projects' );

	get_template_part( 'template-parts/general/content', 'partners' );

	get_template_part( 'template-parts/general/content', 'cta' );

get_footer();
