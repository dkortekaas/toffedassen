<?php
/**
 * Setup Default Dashboard Widgets
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
 * Remove widgets from the dashboard.
 */
if ( ! function_exists( 'logiq_disable_default_dashboard_widgets' ) ) :
	function logiq_disable_default_dashboard_widgets() {

		global $wp_meta_boxes;

		// WP Default
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );          // Activity
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );         // At a Glance
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );   // Recent Comments
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );    // Incoming Links
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );           // Plugins Widget
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );             // WordPress News
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );         // Quick Press
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );       // Recent Drafts

		// Plugin Widgets
		if ( class_exists( 'bbPress' ) ) :

			unset( $wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now'] ); // BBPress Plugin Widget

		endif;

		if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) :

			unset( $wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget'] );         // Yoast's SEO Plugin Widget

		endif;

		if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) :

			unset( $wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard'] );      // Gravity Forms Plugin Widget

		endif;

	}

	add_action( 'wp_dashboard_setup', 'logiq_disable_default_dashboard_widgets', 999 );

endif;

/**
 * Add a Support widget to the dashboard.
 */
if ( ! function_exists( 'logiq_add_dashboard_support' ) ) :
	function logiq_add_dashboard_support() {

		wp_add_dashboard_widget(
			'logiq_dashboard_support',       // Widget slug.
			'logiq Support',                 // Title.
			'logiq_support_dashboard_widget' // Display function.
		);

	}

	add_action( 'wp_dashboard_setup', 'logiq_add_dashboard_support' );

endif;

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
if ( ! function_exists( 'logiq_support_dashboard_widget' ) ) :
	function logiq_support_dashboard_widget() {

		// Display Support mail link.
		echo esc_html( __( 'Need Support? <a href="mailto:support@logiq.nl">Mail Us</a>', 'logiq' ) );

	}

endif;

/**
 * RSS Dashboard Widget.
 */
if ( ! function_exists( 'logiq_rss_dashboard_widget' ) ) :
	function logiq_rss_dashboard_widget() {

		if ( function_exists( 'fetch_feed' ) ) :

			include_once ABSPATH . WPINC . '/feed.php';             // include the required file
			$feed  = fetch_feed( 'http://jointswp.com/feed/rss/' ); // specify the source feed
			$limit = $feed->get_item_quantity( 5 );                 // specify number of items
			$items = $feed->get_items( 0, $limit );                 // create an array of items

		endif;

		if ( 0 === $limit ) :

			echo '<div>' . esc_html__( 'The RSS Feed is either empty or unavailable.', 'logiq' ) . '</div>';   // fallback message

		else :

			foreach ( $items as $item ) :

			?>
			<h4 style="margin-bottom: 0;">
				<a href="<?php echo esc_url( $item->get_permalink() ); ?>" title="<?php echo esc_html( mysql2date( __( 'j F Y @ g:i a', 'logiq' ) ), $item->get_date( 'Y-m-d H:i:s' ) ); ?>" target="_blank">
					<?php echo esc_html( $item->get_title() ); ?>
				</a>
			</h4>
			<p style="margin-top: 0.5em;">
				<?php echo esc_html( substr( $item->get_description(), 0, 200 ) ); ?>
			</p>
			<?php

			endforeach;

		endif;

	}

endif;

/**
 * Call custom Dashboard Widget.
 */
if ( ! function_exists( 'logiq_custom_dashboard_widgets' ) ) :
	function logiq_custom_dashboard_widgets() {

		wp_add_dashboard_widget( 'joints_rss_dashboard_widget', esc_html__( 'Custom RSS Feed (Customize in admin.php)', 'logiq' ), 'logiq_rss_dashboard_widget' );

	}

	add_action( 'wp_dashboard_setup', 'logiq_custom_dashboard_widgets' );

endif;

/**
 * Custom WP Admin footer.
 */
if ( ! function_exists( 'logiq_add_dashboard_support' ) ) :
	function logiq_admin_footer() {

		/* translators: %s: developer name + url variable (defined in functions.php) */
		printf( esc_html__( '<span id="footer-thankyou">Developed by <a href="%1$c" target="_blank">%1$d</a></span>.', 'logiq' ), esc_html( $developer_url ), esc_html( $developer ) );

	}

	add_filter( 'admin_footer_text', 'logiq_admin_footer' );

endif;
