<?php
/**
 * Custom login setup.
 *
 * @package Toffedassen
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
 * Sets the custom login style.
 */
if ( ! function_exists( 'toffedassen_custom_login_style' ) ) :
	function toffedassen_custom_login_style() {

		if ( LOGIN_WEBLOGIQ === true ) :

			echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/login.css" />';

		else :

			echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/login-bmc.css" />';

		endif;

	}

	add_action( 'login_head', 'toffedassen_custom_login_style' );

endif;

/**
 * Sets the custom login Url.
 */	
if ( ! function_exists( 'toffedassen_custom_login_url' ) ) :

	function toffedassen_custom_login_url() {

		if ( LOGIN_WEBLOGIQ === true ) :

			return 'https://weblogiq.nl';

		else :

			return 'https://www.bmcinternetmarketing.nl';

		endif;

	}

	add_filter( 'login_headerurl', 'toffedassen_custom_login_url' );

endif;

/**
 * Sets the custom login Url title.
 */	
if ( ! function_exists( 'toffedassen_custom_login_url_title' ) ) :

	function toffedassen_custom_login_url_title() {

		if ( LOGIN_WEBLOGIQ === true ) :

			return esc_html__( 'Developed by internetbureau Weblogiq', 'toffedassen' );

		else :

			return esc_html__( 'Developed by BMC Internet Marketing', 'toffedassen' );

		endif;

	}

	add_filter( 'login_headertitle', 'toffedassen_custom_login_url_title' );

endif;
