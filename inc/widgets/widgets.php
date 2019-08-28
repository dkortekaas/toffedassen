<?php
/**
 * Load and register widgets
 *
 * @package Toffe Dassen
 */

require_once get_template_directory() . '/inc/widgets/product-sort-by.php';
require_once get_template_directory() . '/inc/widgets/filter-price-list.php';
require_once get_template_directory() . '/inc/widgets/popular-posts.php';
require_once get_template_directory() . '/inc/widgets/socials.php';
require_once get_template_directory() . '/inc/widgets/language-currency.php';


/**
 * Register widgets
 *
 * @since  1.0
 *
 * @return void
 */
if ( ! function_exists( 'toffedassen_register_widgets' ) ) :

	function toffedassen_register_widgets() {
		if ( class_exists( 'WC_Widget' ) ) {
			require_once get_template_directory() . '/inc/widgets/woo-attributes-filter.php';
			require_once get_template_directory() . '/inc/widgets/product-tag.php';
			require_once get_template_directory() . '/inc/widgets/product-cat.php';
			require_once get_template_directory() . '/inc/widgets/widget-layered-nav-filters.php';

			$wc_widgets = array(
				'Toffe_Dassen_Widget_Attributes_Filter',
				'Toffe_Dassen_Widget_Product_Tag_Cloud',
				'Toffe_Dassen_Widget_Product_Cat',
				'Toffe_Dassen_Widget_Layered_Nav_Filters'
			);

			foreach ( $wc_widgets as $widget ) {
				if ( class_exists( $widget ) ) {
					register_widget( $widget );
				}
			}
		}

		$widgets = array(
			'Toffe_Dassen_Product_SortBy_Widget',
			'Toffe_Dassen_Price_Filter_List_Widget',
			'Toffe_Dassen_PopularPost_Widget',
			'Toffe_Dassen_Social_Links_Widget',
			'Toffe_Dassen_Language_Currency_Widget'
		);

		foreach ( $widgets as $widget ) {
			if ( class_exists( $widget ) ) {
				register_widget( $widget );
			}
		}
	}

	add_action( 'widgets_init', 'toffedassen_register_widgets' );

endif;

/**
 * Change markup of archive and category widget to include .count for post count
 *
 * @param string $output
 *
 * @return string
 */
if ( ! function_exists( 'toffedassen_widget_archive_count' ) ) :

	function toffedassen_widget_archive_count( $output ) {
		$output = preg_replace( '|\((\d+)\)|', '<span class="count">(\\1)</span>', $output );

		return $output;
	}

	add_filter( 'wp_list_categories', 'toffedassen_widget_archive_count' );
	add_filter( 'get_archives_link', 'toffedassen_widget_archive_count' );

endif;
