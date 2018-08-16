<?php
/**
 * Add WooCommerce support
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

if ( ! function_exists( 'logiq_woo_support' ) ) :
	/**
	 * Declares WooCommerce theme support.
	 */	
	function logiq_woo_support() {

		add_theme_support( 'woocommerce' );

		// hook in and customizer form fields.
		//add_filter( 'woocommerce_form_field_args', 'logiq_woocommerce_form_field_args', 10, 3 );

	}

	add_action( 'after_setup_theme', 'logiq_woo_support' );

endif;

if ( ! function_exists( 'logiq_add_free_label' ) ) :
	/**
	 * Add Text 'Free' when shipping = 0.
	 */	
	function logiq_add_free_label( $label, $method ) {

		if ( 0 === $method->cost ) :
			$label .= __( 'Free', 'logiq' );
		endif;

		return $label;

	}

endif;

/**
 * Only for: Enhanced E-commerce for Woocommerce store.
 */
if ( is_plugin_active( 'enhanced-e-commerce-for-woocommerce-store/woocommerce-enhanced-ecommerce-google-analytics-integration.php' ) ) :
	require get_template_directory() . '/inc/woocommerce/enhanced-ecommerce.php';
endif;

/**
 * Only for: Table Rate Shipping Plugin.
 */
if ( is_plugin_active( 'table-rate-shipping-for-woocommerce/mh-wc-table-rate.php' ) ) :
	require get_template_directory() . '/inc/woocommerce/table-rate-shipping.php';
endif;
