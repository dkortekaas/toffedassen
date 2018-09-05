<?php
/**
 * Rich Snippets - Schema.org.
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

if ( ! function_exists( 'toffedassen_html_tag_schema' ) ) :

	function toffedassen_html_tag_schema() {

		$schema = 'http://schema.org/';

		if ( is_single() ) :
			$type = 'Article';              // Is single post
		elseif ( is_page( 1 ) ) :
			$type = 'ContactPage';          // Contact form page ID
		elseif ( is_author() ) :
			$type = 'ProfilePage';          // Is author page
		elseif ( is_search() ) :
			$type = 'SearchResultsPage';    // Is search results page
		elseif ( is_singular( 'movies' ) ) :
			$type = 'Movie';                // Is of movie post type
		elseif ( is_singular( 'books' ) ) :
			$type = 'Book';                 // Is of book post type
		else :
			$type = 'WebPage';
		endif;

		echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema . $type ) . '"';

	}

endif;
