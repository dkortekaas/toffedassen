<?php
/**
 * Toffedassen functions and definitions
 *
 * @package Toffedassen
 */

/**
 * Set site owner for custom login.
 */
define( 'LOGIN_WEBLOGIQ', true );

// Load theme
require get_template_directory() . '/inc/backend/theme-setup.php';

// Theme sidebars
require get_template_directory() . '/inc/functions/sidebars.php';

// Cleanup and secure WP
require get_template_directory() . '/inc/functions/cleanup.php';

// Widgets
require get_template_directory() . '/inc/widgets/widgets.php';

// Customizer
require get_template_directory() . '/inc/backend/customizer.php';

require get_template_directory() . '/inc/functions/layout.php';

// Woocommerce hooks
require get_template_directory() . '/inc/frontend/woocommerce.php';

// Custom login
require get_template_directory() . '/inc/backend/custom-login.php';

if ( is_admin() ) {
	require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
	require get_template_directory() . '/inc/tgm/plugins.php';

	require get_template_directory() . '/inc/backend/theme-options.php';
	//require get_template_directory() . '/inc/backend/meta-boxes.php';
	//require get_template_directory() . '/inc/mega-menu/class-mega-menu.php';
	//require get_template_directory() . '/inc/backend/product-meta-box-data.php';
} else {
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
}