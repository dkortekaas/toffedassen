<?php
/**
 * Register Portfolio Post Type.
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

if ( ! function_exists( 'logiq_portfolio_post_type' ) ) :

	function logiq_portfolio_post_type() {

		$labels = array(
			'name'                  => _x( 'Portfolio', 'Post Type General Name', 'logiq' ),
			'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'logiq' ),
			'menu_name'             => __( 'Portfolio', 'logiq' ),
			'name_admin_bar'        => __( 'Portfolio', 'logiq' ),
			'archives'              => __( 'Item Archives', 'logiq' ),
			'attributes'            => __( 'Item Attributes', 'logiq' ),
			'parent_item_colon'     => __( 'Parent Item:', 'logiq' ),
			'all_items'             => __( 'All Items', 'logiq' ),
			'add_new_item'          => __( 'Add New Item', 'logiq' ),
			'add_new'               => __( 'Add New', 'logiq' ),
			'new_item'              => __( 'New Item', 'logiq' ),
			'edit_item'             => __( 'Edit Item', 'logiq' ),
			'update_item'           => __( 'Update Item', 'logiq' ),
			'view_item'             => __( 'View Item', 'logiq' ),
			'view_items'            => __( 'View Items', 'logiq' ),
			'search_items'          => __( 'Search Item', 'logiq' ),
			'not_found'             => __( 'Not found', 'logiq' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'logiq' ),
			'featured_image'        => __( 'Featured Image', 'logiq' ),
			'set_featured_image'    => __( 'Set featured image', 'logiq' ),
			'remove_featured_image' => __( 'Remove featured image', 'logiq' ),
			'use_featured_image'    => __( 'Use as featured image', 'logiq' ),
			'insert_into_item'      => __( 'Insert into item', 'logiq' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'logiq' ),
			'items_list'            => __( 'Items list', 'logiq' ),
			'items_list_navigation' => __( 'Items list navigation', 'logiq' ),
			'filter_items_list'     => __( 'Filter items list', 'logiq' ),
		);

		$args   = array(
			'label'               => __( 'Portfolio', 'logiq' ),
			'description'         => __( 'Portfolio section', 'logiq' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'taxonomies'          => array( 'category', 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-portfolio',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);

		register_post_type( 'portfolio', $args );

	}

	add_action( 'init', 'logiq_portfolio_post_type', 0 );

endif;
