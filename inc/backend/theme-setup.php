<?php
/**
 * Toffedassen theme Setup
 *
 * @package Toffe Dassen
 */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0
 *
 * @return void
 */
function toffedassen_setup() {
	// Sets the content width in pixels, based on the theme's design and stylesheet.
	$GLOBALS['content_width'] = apply_filters( 'toffedassen_content_width', 840 );

	// Make theme available for translation.
	load_theme_textdomain( 'toffedassen', get_template_directory() . '/lang' );

	// Supports WooCommerce plugin.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );
	// Theme supports
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'gallery', 'video' ) );
	add_theme_support(
		'html5', array(
			'comment-list',
			'search-form',
			'comment-form',
			'gallery',
		)
	);

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors.
 	 */
	add_editor_style( array( 'css/editor-style.css' ) );

	add_image_size( 'toffedassen-blog-grid', 666, 540, true );
	add_image_size( 'toffedassen-blog-grid-2', 555, 375, true );
	add_image_size( 'toffedassen-blog-list', 1170, 500, true );
	add_image_size( 'toffedassen-blog-masonry-1', 450, 450, true );
	add_image_size( 'toffedassen-blog-masonry-2', 450, 300, true );
	add_image_size( 'toffedassen-blog-masonry-3', 450, 600, true );

	// Register theme nav menu
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'toffedassen' ),
		)
	);

	// if ( is_admin() ) {
	// 	new Toffe_Dassen_Meta_Box_Product_Data;
	// }

}

add_action( 'after_setup_theme', 'toffedassen_setup', 100 );

function toffedassen_init() {
	global $toffedassen_woocommerce;
	$toffedassen_woocommerce = new Toffe_Dassen_WooCommerce;
}

add_action( 'wp_loaded', 'toffedassen_init' );

// Change image size product gallery thumbnail
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width'  => 135,
        'height' => 135,
        'crop'   => 0,
    );
} );