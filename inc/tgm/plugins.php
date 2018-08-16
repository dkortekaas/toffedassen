<?php
/**
 * Register plugins.
 *
 * @link https://github.com/TGMPA/TGM-Plugin-Activation
 *  
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
 * Register the required plugins for this theme.
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
if ( ! function_exists( 'logiq_register_required_plugins' ) ) :

	function logiq_register_required_plugins() {
		/*
		* Array of plugin arrays. Required keys are name and slug.
		* If the source is NOT from the .org repo, then source is also required.
		*/
		$plugins = array(

			// PREMIUM Plugins - bundled
			array(
				'name'               => 'WP Rocket', // The plugin name.
				'slug'               => 'wp-rocket', // The plugin slug (typically the folder name).
				'source'             => get_stylesheet_directory() . '/inc/tgm/plugins/wp-rocket_2.10.5.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '2.10.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			array(
				'name'               => 'Advanced Custom Fields PRO', // The plugin name.
				'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
				'source'             => get_stylesheet_directory() . '/inc/tgm/plugins/advanced-custom-fields-pro.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '5.5.14', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),

			// Woocommerce combo only
			array(
				'name'               => 'WooCommerce Nice Urls', // The plugin name.
				'slug'               => 'woocommerce-nice-urls', // The plugin slug (typically the folder name).
				'source'             => get_stylesheet_directory() . '/inc/tgm/plugins/woocommerce-nice-urls.zip', // The plugin source.
				'required'           => false, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),

			// WordPress Plugin Repository
			array(
				'name'               => 'Contact Form 7',
				'slug'               => 'contact-form-7',
				'required'           => true,
				'force_activation'   => true,
				'force_deactivation' => false,
			),
			array(
				'name'               => 'Yoast SEO',
				'slug'               => 'wordpress-seo',
				'required'           => true,
				'force_activation'   => true,
				'force_deactivation' => false,
			),
			array(
				'name'               => 'Title and Nofollow For Links',
				'slug'               => 'title-and-nofollow-for-links',
				'required'           => true,
				'force_activation'   => true,
				'force_deactivation' => true,
			),
			array(
				'name'               => 'Simple Page Ordering',
				'slug'               => 'simple-page-ordering',
				'required'           => true,
				'force_activation'   => true,
				'force_deactivation' => true,
			),
			array(
				'name'               => 'Post Types Order',
				'slug'               => 'post-types-order',
				'required'           => true,
				'force_activation'   => true,
				'force_deactivation' => true,
			),
			array(
				'name'               => 'Anti-spam',
				'slug'               => 'anti-spam',
				'required'           => true,
				'force_activation'   => true,
				'force_deactivation' => true,
			),			
			array(
				'name'     => 'ShortPixel Image Optimizer',
				'slug'     => 'shortpixel-image-optimiser',
				'required' => false,
			),
			array(
				'name'     => 'Regenerate Thumbnails',
				'slug'     => 'regenerate-thumbnails',
				'required' => false,
			),
			array(
				'name'     => 'MCE Table Buttons',
				'slug'     => 'mce-table-buttons',
				'required' => false,
			),
			array(
				'name'     => 'Tabby Responsive Tabs',
				'slug'     => 'tabby-responsive-tabs',
				'required' => false,
			),
			array(
				'name'     => '404page – your smart custom 404 error page',
				'slug'     => '404page',
				'required' => false,
			),
			array(
				'name'     => 'Wordfence Security – Firewall & Malware Scan',
				'slug'     => 'wordfence',
				'required' => true,
			),

			// Woocommerce combo only
			array(
				'name'     => 'Enhanced Ecommerce Google Analytics Plugin for WooCommerce',
				'slug'     => 'enhanced-e-commerce-for-woocommerce-store',
				'required' => false,
			),

		);

		$config = array(
			'id'           => 'logiq',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.

		);

		tgmpa( $plugins, $config );

	}

	add_action( 'tgmpa_register', 'logiq_register_required_plugins' );

endif;
