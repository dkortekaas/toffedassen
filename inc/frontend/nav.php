<?php
/**
 * Hooks for template nav menus
 *
 * @package Toffedassen
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since 1.0
 * @param array $args Configuration arguments.
 * @return array
 */
function toffedassen_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'toffedassen_page_menu_args' );


