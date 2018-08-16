<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
if ( ! function_exists( 'logiq_wp_jetpack_setup' ) ) :

	function logiq_wp_jetpack_setup() {

		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'logiq_wp_infinite_scroll_render',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );

		// Add theme support for Content Options.
		add_theme_support( 'jetpack-content-options', array(
			'post-details'    => array(
				'stylesheet' => 'logiq-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive'    => true,
				'post'       => true,
				'page'       => true,
			),
		) );
	}

	add_action( 'after_setup_theme', 'logiq_wp_jetpack_setup' );

endif;

/**
 * Custom render function for Infinite Scroll.
 */
if ( ! function_exists( 'logiq_wp_jetpack_setup' ) ) :

	function logiq_wp_infinite_scroll_render() {

		while ( have_posts() ) :
			the_post();
			if ( is_search() ) :
				get_template_part( 'template-parts/content', 'search' );
			else :
				get_template_part( 'template-parts/content', get_post_type() );
			endif;
		endwhile;

	}

endif;