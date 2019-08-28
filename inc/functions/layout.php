<?php
/**
 * Hooks for frontend display
 *
 * @package Toffe Dassen
 */

if ( ! function_exists( 'toffedassen_get_layout' ) ) :
	/**
	 * Get layout base on current page
	 *
	 * @return string
	 */
	function toffedassen_get_layout() {
		$layout = 'full-content';

		if ( toffedassen_is_catalog() ) {
			$layout = 'catalog_layout'; //toffedassen_get_option( 'catalog_layout' );
		} elseif ( is_singular( 'post' ) ) {
			if ( get_post_meta( get_the_ID(), 'custom_page_layout', true ) ) {
				$layout = get_post_meta( get_the_ID(), 'layout', true );
			} else {
				$layout = toffedassen_get_option( 'single_post_layout' );
			}
		} elseif ( is_page() ) {
			$layout = 'full-content';

			if ( get_post_meta( get_the_ID(), 'page_header_custom_layout', true ) ) {
				$layout = get_post_meta( get_the_ID(), 'layout', true );
			}

			if ( toffedassen_is_page_template() ) {
				$layout = 'full-content';
			}

		} elseif ( toffedassen_is_blog() ) {
			$layout = 'full-content';

			if ( 'grid' == toffedassen_get_option( 'blog_style' ) ) {
				$layout = toffedassen_get_option( 'blog_layout' );
			}
		} elseif ( is_singular( 'product' ) && toffedassen_get_option( 'single_product_layout' ) == '1' ) {
			$layout = toffedassen_get_option( 'single_product_sidebar' );
		} elseif ( is_404() ) {
			$layout = 'full-content';
		} elseif ( is_singular( 'portfolio' ) || toffedassen_is_portfolio() ) {
			$layout = 'full-content';
		}

		return apply_filters( 'toffedassen_site_layout', $layout );
	}

endif;

if ( ! function_exists( 'toffedassen_get_content_columns' ) ) :
	/**
	 * Get CSS classes for content columns
	 *
	 * @param string $layout
	 *
	 * @return array
	 */
	function toffedassen_get_content_columns( $layout = null ) {
		$layout = $layout ? $layout : toffedassen_get_layout();

		if ( 'full-content' == $layout ) {
			return array( 'col-md-12', 'col-sm-12', 'col-xs-12' );
		}

		if ( is_singular( 'post' ) ) {
			if ( 'sidebar-content' == $layout ) {
				return array( 'col-md-8', 'col-md-offset-1', 'col-sm-12', 'col-xs-12' );
			}
		}

		return array( 'col-md-9', 'col-sm-12', 'col-xs-12' );
	}

endif;


if ( ! function_exists( 'toffedassen_content_columns' ) ) :

	/**
	 * Display CSS classes for content columns
	 *
	 * @param string $layout
	 */
	function toffedassen_content_columns( $layout = null ) {
		echo implode( ' ', toffedassen_get_content_columns( $layout ) );
	}

endif;
