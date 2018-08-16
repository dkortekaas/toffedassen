<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'logiq_wp_body_classes' ) ) :

	function logiq_wp_body_classes( $classes ) {

		// Add class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) :
			$classes[] = 'group-blog';
		endif;

		// Add class of hfeed to non-singular pages.
		if ( ! is_singular() ) :
			$classes[] = 'hfeed';
		endif;

		// Add class if we're viewing the Customizer for easier styling of theme options.
		if ( is_customize_preview() ) :
			$classes[] = 'logiq-customizer';
		endif;

		// Add class on front page.
		if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) :
			$classes[] = 'logiq-front-page';
		endif;

		// Add a class if there is a custom header.
		if ( has_header_image() ) :
			$classes[] = 'has-header-image';
		endif;

		// Add class if sidebar is used.
		if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) :
			$classes[] = 'has-sidebar';
		endif;

		// Add class for one or two column page layouts.
		if ( is_page() || is_archive() ) :
			if ( 'one-column' === get_theme_mod( 'page_layout' ) ) :
				$classes[] = 'page-one-column';
			else :
				$classes[] = 'page-two-column';
			endif;
		endif;

		// Add class if the site title and tagline is hidden.
		if ( 'blank' === get_header_textcolor() ) :
			$classes[] = 'title-tagline-hidden';
		endif;

		return $classes;

	}

	add_filter( 'body_class', 'logiq_wp_body_classes' );

endif;

/**
* Add a pingback url auto-discovery header for single posts, pages, or attachments.
*/
if ( ! function_exists( 'logiq_wp_pingback_header' ) ) :

	function logiq_wp_pingback_header() {

		if ( is_singular() && pings_open() ) :
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		endif;

	}

	add_action( 'wp_head', 'logiq_wp_pingback_header' );

endif;

/**
 * Checks to see if we're on the homepage or not.
 */
if ( ! function_exists( 'logiq_is_frontpage' ) ) :

	function logiq_is_frontpage() {

		return ( is_front_page() && ! is_home() );

	}

endif;

/**
 * Adds title to the images.
 */
if ( ! function_exists( 'logiq_add_img_title' ) ) :

	function logiq_add_img_title( $attr, $attachment = null ) {

    	$img_title = trim( strip_tags( $attachment->post_title ) );

    	$attr['title'] = $img_title;
    	$attr['alt'] = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

		return $attr;

	}

	add_filter( 'wp_get_attachment_image_attributes','logiq_add_img_title', 10, 2 );

endif;

/**
 * Gets Post slug.
 */
if ( ! function_exists( 'logiq_get_post_slug' ) ) :

	function logiq_get_post_slug( ) {
 
		$slug = get_post_field( 'post_name', get_post() );

		return $slug;

	}

endif;

/**
 * Adds Google Tagmanager support.
 */
if ( ! function_exists( 'logiq_gtm_scripts' ) ) :

	function logiq_gtm_scripts() {

		$tagmanager = get_option( 'google_tagmanager' );

		if( @$tagmanager == 1 ) : ?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-XXXXXXXXXX');</script>
		<!-- End Google Tag Manager -->
		<?php
		endif;

	}

endif;

/**
 * Paging.
 */
if ( ! function_exists( 'logiq_page_navi' ) ) :

	function logiq_page_navi() {

		global $wp_query;

		$big            = 999999999; // This needs to be an unlikely integer
		$paginate_links = paginate_links( array(
			'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'mid_size'  => 5,
			'prev_next' => true,
			'prev_text' => __( '&laquo;', 'logiq' ),
			'next_text' => __( '&raquo;', 'logiq' ),
			'type'      => 'list',
		) );

		$paginate_links = str_replace( '<ul class="page-numbers">', '<ul class="pagination">', $paginate_links );
		$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
		$paginate_links = str_replace( '<li><span class="page-numbers current">', '<li class="current">', $paginate_links );
		$paginate_links = str_replace( '</span>', '</a>', $paginate_links );
		$paginate_links = str_replace( '<li><a href="#">&hellip;</a></li>', '<li><span class="dots">&hellip;</span></li>', $paginate_links );
		$paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );

		// Display the pagination if more than one page is found.
		if ( $paginate_links ) :
			echo '<div class="page-navigation">';
				echo esc_html( $paginate_links );
			echo '</div>';
		endif;

	}

endif;

/**
 * Schema.org JSON for Yoast breadcrumbs.
 */
if ( ! function_exists( 'logiq_add_crumb_schema' ) ) :

	function logiq_add_crumb_schema($crumbs) {

    	if( ! is_array( $crumbs ) || $crumbs === array()) :
        	return $crumbs;
		endif;

		$last = count ( $crumbs );
		$listItems = [];
		$j = 1;

		foreach ( $crumbs as $i => $crumb ) :

			$item = [];
			$nr = ( $i + 1 );

			if ( isset ( $crumb['id'] ) ) :
				$item = [
					'@id' => get_permalink ( $crumb['id'] ),
					'name' => html_entity_decode( get_the_title( $crumb['id'] ) )
				];
			endif;

			if ( isset ( $crumb['term'] ) ) :
				$term = $crumb['term'];

				$item = [
					'@id' => get_term_link ( $term ),
					'name' => $term->name
				];
			endif;

			if ( isset ( $crumb['ptarchive'] ) ) :
				$postType = get_post_type_object ( $crumb['ptarchive'] );

				$item = [
					'@id' => get_post_type_archive_link ( $crumb['ptarchive'] ),
					'name' => $postType->label
				];
			endif;

			/* READ NOTE BELOW: */

			if ( $nr == $last ) :
				if ( is_author() && !isset( $crumb['url'] ) ) $crumb['url'] = esc_url ( get_author_posts_url ( get_queried_object_id() ) );
			endif;

			/* The 'text' indicates the current (last) or start-path crumb (home)*/
			if ( isset( $crumb['url'] ) ) :
				if ( $crumb['text'] !== '' ) :
					$title = $crumb['text'];
				else :
					$title = get_bloginfo('name');
				endif;

				$item = [
					'@id' => $crumb['url'],
					'name' => $title
				];
			endif;

			$listItem = [
				'@type' => 'ListItem',
				'position' => $j,
				'item' => $item
			];

			$listItems[] = $listItem;
			$j++;

		endforeach;

		$schema = [
			'@context' => 'http://schema.org',
			'@type' => 'BreadcrumbList',
			'itemListElement' => $listItems
		];

		$html = '<script type="application/ld+json">' . stripslashes ( json_encode ( $schema, JSON_UNESCAPED_UNICODE ) ) . '</script>';
		echo $html;

		remove_filter('wpseo_breadcrumb_links', 'entex_add_crumb_schema', 10, 1);

		return $crumbs;

	}

	add_filter('wpseo_breadcrumb_links', 'logiq_add_crumb_schema', 10, 1);

endif;
