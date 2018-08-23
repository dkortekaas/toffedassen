<?php
/**
 * Logiq WP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Logiq
 */

/**
 * Set site owner for custom login.
 */
define( 'LOGIN_WEBLOGIQ', true );

if ( LOGIN_WEBLOGIQ === true ) :
	$developer     = 'internetbureau Weblogiq';
	$developer_url = 'https://weblogiq.nl';
else :
	$developer     = 'BMC Internetmarketing';
	$developer_url = 'https://bmcinternetmarketing.nl';
endif;

/**
 * Theme setup and custom theme supports.
 */
require get_parent_theme_file_path( '/inc/setup.php' );

/**
 * Sets up theme scripts and styles.
 */
require get_parent_theme_file_path( '/inc/enqueue.php' );

/**
 * Theme plugin activation.
 */
if ( is_admin() ) :
	require get_parent_theme_file_path( '/inc/tgm/class-tgm-plugin-activation.php' );
	require get_parent_theme_file_path( '/inc/tgm/plugins.php' );
endif;

/**
 * Configure WP Admin.
 */
require get_parent_theme_file_path( '/inc/admin.php' );

/**
 * Load functions to cleanup and secure WP.
 */
require get_parent_theme_file_path( '/inc/cleanup.php' );

/**
 * Setup theme widgets.
 */
require get_parent_theme_file_path( '/inc/widgets.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Load custom WordPress nav walker.
 */
require get_parent_theme_file_path( '/inc/bootstrap-wp-navwalker.php' );

/**
 * Load Custom login.
 */
require get_parent_theme_file_path( '/inc/custom-login.php' );

/**
 * Create Custom Post Types.
 */
require get_parent_theme_file_path( '/inc/custom-posts/portfolio.php' );

/**
 * Support Rich Snippets - Schema.org
 */
require get_parent_theme_file_path( '/inc/rich-snippets.php' );

/**
 * Theme Admin options.
 */
require get_parent_theme_file_path( '/inc/theme-options.php' );

/**
 * Load Yoast functions.
 */
if ( in_array( 'wordpress-seo/wp-seo.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) : 

	//require get_parent_theme_file_path( '/inc/plugins/yoast.php' );

endif;

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) :

	require get_parent_theme_file_path( '/inc/plugins/jetpack.php' );

endif;

/**
 * Load WooCommerce functions.
 */
// if ( class_exists( 'WooCommerce' ) ) :

// 	require get_parent_theme_file_path( '/inc/plugins/woocommerce/woocommerce.php' );

// 	/**
// 	 * Enhanced E-commerce for Woocommerce store.
// 	 */
// 	require get_parent_theme_file_path( '/inc/plugins/woocommerce/enhanced-ecommerce.php' );

// 	/**
// 	 * Disable messages.
// 	 */
// 	require get_parent_theme_file_path( '/inc/plugins/woocommerce/disable-messages.php' );

// 	/**
// 	 * Table Rate Shipping Plugin Amendments.
// 	 */
// 	require get_parent_theme_file_path( '/inc/plugins/woocommerce/table-rate-shipping.php' );

// endif;
