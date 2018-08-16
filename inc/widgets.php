<?php
/**
 * Register widget areas.
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
 * Register widget area.
 */
if ( ! function_exists( 'logiq_widgets_init' ) ) :

	function logiq_widgets_init() {

		// Set up our array of widgets
		$widgets = array(
			esc_html__( 'Header', 'logiq' )           => 'header',
			esc_html__( 'Left Sidebar', 'logiq' )     => 'left-sidebar',
			esc_html__( 'Right Sidebar', 'logiq' )    => 'right-sidebar',
			esc_html__( 'Footer Sidebar 1', 'logiq' ) => 'footer-1',
			esc_html__( 'Footer Sidebar 2', 'logiq' ) => 'footer-2',
			esc_html__( 'Footer Sidebar 3', 'logiq' ) => 'footer-3',
			esc_html__( 'Footer Sidebar 4', 'logiq' ) => 'footer-4',
			esc_html__( 'Footer Full', 'logiq' )      => 'footerfull',
		);

		// Loop through them to create our widget areas
		foreach ( $widgets as $widget => $id ) :
			if ( 'statichero' === $id ) :
				$before_widget = '<section id="%1$s" class="static-hero-widget %2$s ' . logiq_count_widgets( 'statichero' ) . '">';
				$after_widget  = '</section>';
			elseif ( 'footerfull' === $id ) :
				$before_widget = '<section id="%1$s" class="footer-widget %2$s ' . logiq_count_widgets( 'footerfull' ) . '">';
				$after_widget  = '</section>';
			else :
				$before_widget = '<aside id="%1$s" class="widget %2$s">';
				$after_widget  = '</aside>';
			endif;

			register_sidebar( array(
				'name'          => $widget,
				'id'            => $id,
				'description'   => esc_html__( 'Add widgets here.', 'logiq' ),
				'before_widget' => $before_widget,
				'after_widget'  => $after_widget,
				'before_title'  => apply_filters( 'generate_start_widget_title', '<h4 class="widget-title">' ),
				'after_title'   => apply_filters( 'generate_end_widget_title', '</h4>' ),
			) );

		endforeach;

	}

	add_action( 'widgets_init', 'logiq_widgets_init' );

endif;

/**
 * Count widgets.
 */
function logiq_count_widgets( $sidebar_id, $echo = true ) {

	// $the_sidebars = wp_get_sidebars_widgets();

    // if( !isset( $the_sidebars[$sidebar_id] ) ) :
	// 	return __( 'Invalid sidebar ID' );
	// endif;

    // if( $echo ) :
    //     echo count( $the_sidebars[$sidebar_id] );
    // else :
	// 	return count( $the_sidebars[$sidebar_id] );
	// endif;

}
