<?php
/**
 * Hooks for frontend display
 *
 * @package Toffedassen
 */


/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function toffedassen_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	$header_layout = toffedassen_get_option( 'header_layout' );
	$custom_header = toffedassen_get_post_meta( 'custom_header' );

	if ( is_page_template( 'template-home-left-sidebar.php' ) ) {
		$classes[] = 'header-left-sidebar';
	} else {
		$classes[] = 'header-layout-' . $header_layout;
	}

	if ( is_singular( 'post' ) ) {
		$classes[] = toffedassen_get_option( 'single_post_layout' );

	} elseif ( toffedassen_is_blog() ) {
		$classes[] = 'supro-blog-page';
		$classes[] = 'blog-' . toffedassen_get_option( 'blog_style' );
		$classes[] = toffedassen_get_option( 'blog_layout' );

	} else {
		$classes[] = toffedassen_get_layout();
	}

	if ( toffedassen_is_catalog() ) {
		$classes[] = 'supro-catalog-page';

		$view      = isset( $_COOKIE['shop_view'] ) ? $_COOKIE['shop_view'] : toffedassen_get_option( 'shop_view' );
		$classes[] = 'shop-view-' . $view;

		if ( intval( toffedassen_get_option( 'catalog_ajax_filter' ) ) ) {
			$classes[] = 'catalog-ajax-filter';
		}

		if ( intval( toffedassen_get_option( 'catalog_full_width' ) ) ) {
			$classes[] = 'catalog-full-width-layout';
		}

		if ( intval( toffedassen_get_option( 'catalog_filter_mobile' ) ) ) {
			$classes[] = 'filter-mobile-enable';
		}
	}

	if ( function_exists( 'is_product' ) && is_product() ) {
		$classes[] = 'single-product-layout-' . toffedassen_get_option( 'single_product_layout' );

		if ( '1' == toffedassen_get_option( 'single_product_layout' ) ) {
			$classes[] = toffedassen_get_option( 'single_product_sidebar' );
		}
	}

	if ( toffedassen_header_transparent() ) {
		$classes[] = 'header-transparent';

		if ( $custom_header ) {
			$text_color = toffedassen_get_post_meta( 'header_text_color' );
		} else {
			$text_color = toffedassen_get_option( 'header_text_color' );
		}

		$classes[] = 'header-color-' . $text_color;
	}

	if ( toffedassen_header_sticky() ) {
		$classes[] = 'header-sticky';
	}

	$header_border = toffedassen_get_post_meta( 'header_border' );

	if (
		( toffedassen_is_home() && ! is_page_template( 'template-home-left-sidebar.php' ) ) ||
		( $custom_header && $header_border )
	) {
		$classes[] = 'header-no-border';
	}

	if ( is_page_template( 'template-home-boxed.php' ) ) {
		$id       = get_post_meta( get_the_ID(), 'image', true );
		$bg_color = get_post_meta( get_the_ID(), 'color', true );

		if ( ! $id && ! $bg_color ) {
			$classes[] = 'no-background';
		}
	}

	$p_style    = toffedassen_get_option( 'portfolio_layout' );
	$p_nav_type = toffedassen_get_option( 'portfolio_nav_type' );

	if ( toffedassen_is_portfolio() ) {
		$classes[] = 'portfolio-' . $p_style;
		$classes[] = 'portfolio-' . $p_nav_type;
		$classes[] = 'supro-portfolio-page';
	}

	return $classes;
}

add_filter( 'body_class', 'toffedassen_body_classes' );
