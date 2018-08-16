<?php
/**
 * Sets up theme scripts and styles.
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
 * Enqueue css.
 */
if ( ! function_exists( 'logiq_enqueue_styles' ) ) :

	function logiq_enqueue_styles() {
		
		$the_theme = wp_get_theme(); // Get the theme data.

		wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/assets/css/theme.css', array(), $the_theme->get( 'Version' ) );

	}

	add_action( 'wp_enqueue_scripts', 'logiq_enqueue_styles' );

endif;

/**
 * Enqueue scripts.
 */
if ( ! function_exists( 'logiq_scripts' ) ) :

	function logiq_scripts() {

		$the_theme = wp_get_theme(); // Get the theme data.

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), $the_theme->get( 'Version' ), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
			wp_enqueue_script( 'comment-reply' );
		endif;

	}

	add_action( 'wp_enqueue_scripts', 'logiq_scripts' );

endif;

/**
 * Enqueue Admin css.
 */
// if ( ! function_exists( 'logiq_enqueue_admin_styles' ) ) :
//
// 	function logiq_enqueue_admin_styles() {
//	
// 		$the_theme = wp_get_theme(); // Get the theme data.
//
// 		wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/assets/css/admin.min.css', array(), $the_theme->get( 'Version' ) );
//
// 	}
//
// 	add_action( 'admin_enqueue_scripts', 'logiq_enqueue_admin_styles' );
//
// endif;

/**
 * Adds your styles to the WordPress editor.
 */
// if ( ! function_exists( 'logiq_add_editor_styles' ) ) :
//
// 	function logiq_add_editor_styles() {
//
// 		add_editor_style( get_template_directory_uri() . '/assets/css/style.min.css' );
//
// 	}
//
// 	add_action( 'init', 'logiq_add_editor_styles' );
//
// endif;
