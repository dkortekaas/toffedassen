<?php
/**
 * Toffe Dassen Setup
 *
 * @package toffedassen
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */	
function toffedassen_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on toffedassen WP, use a find and replace
		* to change 'toffedassen' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'toffedassen', get_template_directory() . '/languages' );

	/*
	* Add default posts and comments RSS feed links to head.
	*/
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 125, 125, true );
	add_image_size( 'featured-image', 2000, 1200, true );

	/*
		* This theme uses wp_nav_menu() in one location.
		*/		
	register_nav_menus( array(
		'main-menu'   => esc_html__( 'Primary', 'toffedassen' ),
		'top-menu'    => esc_html__( 'Top', 'toffedassen' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'toffedassen' ),			
	) );

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
	 * Set up the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'toffedassen_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Add theme support for selective refresh for widgets.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/**
	 * Adding post format support.
	 */
	add_theme_support( 'post-formats',
		array(
			'aside',   // title less blurb
			'gallery', // gallery of images
			'link',    // quick link to other site
			'image',   // an image
			'quote',   // a quick quote
			'status',  // a Facebook like status update
			'video',   // video
			'audio',   // audio
			'chat',    // chat transcript
		)
	);

}
add_action( 'after_setup_theme', 'toffedassen_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function toffedassen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'toffedassen_content_width', 1200 );
}
add_action( 'after_setup_theme', 'toffedassen_content_width', 0 );


function toffedassen_init() {
	global $toffedassen_woocommerce;
	$toffedassen_woocommerce = new Toffedassen_WooCommerce;
}
add_action( 'wp_loaded', 'toffedassen_init' );
