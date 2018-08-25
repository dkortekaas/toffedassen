<?php
/**
 * Toffe Dassen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Toffedassen
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
require get_template_directory() . '/inc/setup.php';

/**
 * Sidebars
 */
require get_template_directory() . '/inc/sidebars.php';

/**
 * Widgets
 */ 
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Cleanup and secure WP
 */
require get_template_directory() . '/inc/cleanup.php';

/**
 * Sets up theme scripts and styles.
 */
//require get_template_directory() . '/inc/enqueue.php';

if ( is_admin() ) :
	/**
 	* Theme plugin activation.
 	*/
	require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
	require get_template_directory() . '/inc/tgm/plugins.php';

	require get_template_directory() . '/inc/backend/meta-boxes.php';
	require get_template_directory() . '/inc/mega-menu/class-mega-menu.php';
	require get_template_directory() . '/inc/backend/product-meta-box-data.php';

else :

	// Frontend functions and shortcodes
	require get_template_directory() . '/inc/functions/media.php';
	require get_template_directory() . '/inc/functions/nav.php';
	require get_template_directory() . '/inc/functions/entry.php';
	require get_template_directory() . '/inc/functions/header.php';
	require get_template_directory() . '/inc/functions/comments.php';
	require get_template_directory() . '/inc/functions/breadcrumbs.php';
	require get_template_directory() . '/inc/functions/footer.php';

	// Frontend hooks
	require get_template_directory() . '/inc/frontend/layout.php';
	require get_template_directory() . '/inc/frontend/header.php';
	require get_template_directory() . '/inc/frontend/footer.php';
	require get_template_directory() . '/inc/frontend/nav.php';
	require get_template_directory() . '/inc/frontend/entry.php';
	require get_template_directory() . '/inc/mega-menu/class-mega-menu-walker.php';

	require get_template_directory() . '/inc/frontend/woo_functions.php';

endif;

/**
 * Configure WP Admin.
 */
//require get_template_directory() . '/inc/admin.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
//require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/backend/customizer.php';
require get_template_directory() . '/inc/functions/layout.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Load custom WordPress nav walker.
 */
//require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Load Custom login.
 */
require get_template_directory() . '/inc/backend/custom-login.php';

/**
 * Create Custom Post Types.
 */
//require get_template_directory() . '/inc/custom-posts/portfolio.php';

/**
 * Support Rich Snippets - Schema.org
 */
//require get_template_directory() . '/inc/rich-snippets.php';

/**
 * Theme Admin options.
 */
require get_template_directory() . '/inc/backend/theme-options.php';

/**
 * Load Yoast functions.
 */
//if ( in_array( 'wordpress-seo/wp-seo.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) : 

	//require get_parent_theme_file_path( '/inc/plugins/yoast.php' );

//endif;

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) :

// 	require get_template_directory() . '/inc/plugins/jetpack.php';

// endif;

/**
 * Load WooCommerce functions.
 */
require get_template_directory() . '/inc/frontend/woocommerce.php';

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
