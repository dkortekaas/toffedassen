<?php
/**
 * Table Rate Shipping functions
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

if ( ! function_exists( 'logiq_woo_remove_shipping_label' ) ) :
	/**
	 * Remove Title Table Rate Shipping.
	 */	
	function logiq_woo_remove_shipping_label( $full_label, $method ) {

		$full_label = str_replace( 'Staffel: ', '', $full_label );
		$full_label = str_replace( 'Staffel', '', $full_label );

		return $full_label;

	}

	add_filter( 'woocommerce_cart_shipping_method_full_label', 'logiq_woo_remove_shipping_label', 10, 2 );

endif;

if ( ! function_exists( 'logiq_woo_totals' ) ) :
	/**
	 * Remove the "via" text in shipping method.
	 */	
	function logiq_woo_totals( $totals, $order ) {

		if ( ! isset( $totals['shipping'] ) ) :
			return $totals;
		endif;

		$totals['shipping']['value'] = substr( $totals['shipping']['value'], 0, strpos( $totals['shipping']['value'], '<small' ) );

		return $totals;

	}

	add_filter( 'wpo_wcpdf_woocommerce_totals', 'logiq_woo_totals', 10, 2 );

endif;
