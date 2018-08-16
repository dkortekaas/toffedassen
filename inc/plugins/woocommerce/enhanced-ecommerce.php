<?php
/**
 * Logiq Enhanced E-commerce for Woocommerce store functions
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

if ( ! function_exists( 'logiq_add_wpmr_ga_price' ) ) :
	/**
	* Enhanced E-commerce for Woocommerce store
	* De id moet _wpmr hebben anders pakt de plugin het niet op.
	* Er zijn nog enkele die ook werken maar _wpmr werkt voor custom post fields.
	*
	* @return mixed
	*/
	function logiq_add_wpmr_ga_price() {

		global $woocommerce, $post;

		echo '<div class="options_group">';
			woocommerce_wp_text_input(
				array(
					'id'                => '_wpmr_ga_price',
					'label'             => __( 'GA Price', 'logiq' ),
					'placeholder'       => '',
					'description'       => __( 'Enter the custom GA Price here.', 'logiq' ),
					'type'              => 'number',
					'desc_tip'          => 'true',
					'custom_attributes' => array(
						'step' 	=> 'any',
						'min'	=> '0',
					),
				)
			);
		echo '</div>';

	}

	add_action( 'woocommerce_product_options_general_product_data', 'logiq_add_wpmr_ga_price' );

endif;

if ( ! function_exists( 'logiq_save_wpmr_ga_price' ) ) :
	/**
	* Save WPMR GA_Price Field.
	*/	
	function logiq_save_wpmr_ga_price( $post_id ) {

		$woocommerce_number_field = $_POST['_wpmr_ga_price'];

		if ( ! empty( $woocommerce_number_field ) ) :
			update_post_meta( $post_id, '_wpmr_ga_price', esc_attr( $woocommerce_number_field ) );
		endif;

	}

	add_action( 'woocommerce_process_product_meta', 'logiq_save_wpmr_ga_price' );

endif;
