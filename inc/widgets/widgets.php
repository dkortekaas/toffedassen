<?php
/**
 * Load and register widgets
 *
 * @package Toffe Dassen
 */

require_once get_template_directory() . '/inc/widgets/popular-posts.php';
require_once get_template_directory() . '/inc/widgets/socials.php';
require_once get_template_directory() . '/inc/widgets/language-currency.php';
require_once get_template_directory() . '/inc/widgets/woo-attributes-filter.php';
require_once get_template_directory() . '/inc/widgets/product-sort-by.php';
require_once get_template_directory() . '/inc/widgets/filter-price-list.php';
require_once get_template_directory() . '/inc/widgets/product-tag.php';
require_once get_template_directory() . '/inc/widgets/product-cat.php';
require_once get_template_directory() . '/inc/widgets/widget-layered-nav-filters.php';

/**
 * Register widgets
 *
 * @since  1.0
 *
 * @return void
 */
function toffedassen_register_widgets() {
	if ( class_exists( 'WC_Widget' ) ) {
		register_widget( 'Toffe Dassen_Widget_Attributes_Filter' );
		register_widget( 'Toffe Dassen_Widget_Product_Tag_Cloud' );
		register_widget( 'Toffe Dassen_Widget_Product_Cat' );
		register_widget( 'Toffe Dassen_Widget_Layered_Nav_Filters' );
	}

	register_widget( 'Toffe Dassen_Product_SortBy_Widget' );
	register_widget( 'Toffe Dassen_Price_Filter_List_Widget' );
	register_widget( 'Toffe Dassen_PopularPost_Widget' );
	register_widget( 'Toffe Dassen_Social_Links_Widget' );
	register_widget( 'Toffe Dassen_Language_Currency_Widget' );
}
add_action( 'widgets_init', 'toffedassen_register_widgets' );

/**
 * Change markup of archive and category widget to include .count for post count
 *
 * @param string $output
 *
 * @return string
 */
function toffedassen_widget_archive_count( $output ) {
	$output = preg_replace( '|\((\d+)\)|', '<span class="count">(\\1)</span>', $output );

	return $output;
}

add_filter( 'wp_list_categories', 'toffedassen_widget_archive_count' );
add_filter( 'get_archives_link', 'toffedassen_widget_archive_count' );
