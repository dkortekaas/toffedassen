<?php
/**
 * Hooks for template archive
 *
 * @package Toffedassen
 */


/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @since 1.0
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function toffedassen_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}

add_action( 'wp', 'toffedassen_setup_author' );

/**
 * Add CSS classes to posts
 *
 * @param array $classes
 *
 * @return array
 */
function toffedassen_post_class( $classes ) {

	$classes[] = has_post_thumbnail() ? '' : 'no-thumb';

	return $classes;
}

add_filter( 'post_class', 'toffedassen_post_class' );

/**
 * Open tag after start site content
 */

 function toffedassen_site_content_open() {
	$container       = 'container';
	$product_layout  = toffedassen_get_option( 'single_product_layout' );
	$portfolio_style = toffedassen_get_option( 'portfolio_layout' );

	if ( is_front_page() ) {
		$container = 'container-fluid';
	}

	if ( toffedassen_is_page_template() ) {
		$container = 'container-fluid';
	}

	if (  function_exists( 'is_product' ) && is_product() ) {
		if ( in_array( $product_layout, array( '2', '5' ) ) ) {
			$container = 'container-fluid';
		}
	}

	if ( toffedassen_is_catalog() && intval( toffedassen_get_option( 'catalog_full_width' ) ) ) {
		$container = 'supro-catalog-container';
	}

	if ( is_singular( 'portfolio' ) ) {
		$container = 'container-fluid';
	}

	if ( toffedassen_is_portfolio() && $portfolio_style == 'masonry' ) {
		$container = 'container-fluid';
	}

	echo '<div class="' . esc_attr( apply_filters( 'toffedassen_site_content_container_class', $container ) ) . '">';
	echo '<div class="row">';
}

add_action( 'toffedassen_site_content_open', 'toffedassen_site_content_open', 20 );

/**
 * Close tag before end site content
 */
if ( ! function_exists( 'toffedassen_site_content_close' ) ) :

	function toffedassen_site_content_close() {
		echo '</div>';
		echo '</div>';
	}

endif;

add_action( 'toffedassen_site_content_close', 'toffedassen_site_content_close', 100 );


/**
 * Add blog categories
 *
 * @since  1.0
 *
 *
 */
if ( ! function_exists( 'toffedassen_blog_text_categories' ) ) :
	function toffedassen_blog_text_categories() {
		$blog_style = toffedassen_get_option( 'blog_style' );
		$cat_filter = intval( toffedassen_get_option( 'blog_cat_filter' ) );

		if ( ! $cat_filter ) {
			return;
		}

		if ( $blog_style == 'masonry' ) {
			echo '<div class="container">';
		}

		toffedassen_taxs_list();

		if ( $blog_style == 'masonry' ) {
			echo '</div>';
		}
	}
endif;

add_action( 'toffedassen_before_post_list', 'toffedassen_blog_text_categories' );
add_action( 'toffedassen_before_archive_post_list', 'toffedassen_blog_text_categories' );

/**
 * Add blog categories
 *
 * @since  1.0
 *
 *
 */
if ( ! function_exists( 'toffedassen_portfolio_categories' ) ) :
	function toffedassen_portfolio_categories() {
		$p_style = toffedassen_get_option( 'portfolio_layout' );
		$cat_filter = intval( toffedassen_get_option( 'portfolio_category_filter' ) );

		if ( ! $cat_filter ) {
			return;
		}

		toffedassen_taxs_list( 'portfolio_category' );
	}

endif;

add_action( 'toffedassen_before_portfolio_list', 'toffedassen_portfolio_categories' );
add_action( 'toffedassen_before_taxonomy_portfolio_list', 'toffedassen_portfolio_categories' );

/**
 * Add Coming Soon Newsletter
 *
 * @since  1.0
 *
 *
 */
if ( ! function_exists( 'toffedassen_coming_soon_newsletter' ) ) :
	function toffedassen_coming_soon_newsletter() {
		$newsletter = intval( toffedassen_get_option( 'coming_soon_newsletter' ) );
		$form       = do_shortcode( wp_kses( toffedassen_get_option( 'coming_soon_newsletter_form' ), wp_kses_allowed_html( 'post' ) ) );
		if ( ! intval( $newsletter ) ) {
			return;
		};

		?>
        <div class="coming-soon-newsletter">
            <div class="container">
                <div class="coming-soon-form"><?php echo '' . $form; ?></div>
            </div>
        </div>
		<?php
	}
endif;

add_action( 'toffedassen_coming_soon_page_content', 'toffedassen_coming_soon_newsletter', 10 );


if ( ! function_exists( 'toffedassen_coming_soon_socials' ) ) :
	function toffedassen_coming_soon_socials() {

		if ( ! intval( toffedassen_get_option( 'show_coming_soon_social_share' ) ) ) {
			return;
		}

		$project_social = (array) toffedassen_get_option( 'coming_soon_socials' );

		if ( $project_social ) {

			$socials = (array) toffedassen_get_socials();

			printf( '<div class="supro-coming-soon-socials-share">' );
			printf( '<div class="container">' );
			printf( '<ul class="socials-inline">' );
			foreach ( $project_social as $social ) {
				foreach ( $socials as $name => $label ) {
					$link_url = $social['link_url'];

					if ( preg_match( '/' . $name . '/', $link_url ) ) {

						if ( $name == 'google' ) {
							$name = 'googleplus';
						}

						printf( '<li><a href="%s" target="_blank"><i class="social_%s"></i></a></li>', esc_url( $link_url ), esc_attr( $name ) );
						break;
					}
				}
			}
			printf( '</ul>' );
			printf( '</div>' );
			printf( '</div>' );
		}

	}

endif;

add_action( 'toffedassen_coming_soon_page_content', 'toffedassen_coming_soon_socials', 40 );

/**
 * Filter to archive title and add page title for singular pages
 *
 * @param string $title
 *
 * @return string
 */
function toffedassen_the_archive_title( $title ) {
	if ( is_search() ) {
		$title = esc_html__( 'Search Results', 'supro' );

	} elseif ( is_404() ) {
		$title = esc_html__( 'Page Not Found', 'supro' );

	} elseif ( is_page() ) {
		$title = get_the_title();
	} elseif ( is_home() && is_front_page() ) {
		$title = esc_html__( 'The Latest Posts', 'supro' );

	} elseif ( is_home() && ! is_front_page() ) {
		$title = wp_kses_post( toffedassen_get_option( 'blog_page_header_title' ) );

		if ( empty( $title ) ) {
			$title = get_the_title( get_option( 'page_for_posts' ) );
		}

	} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
		$title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );

	} elseif ( function_exists( 'is_product' ) && is_product() ) {
		$cats = get_the_terms( get_the_ID(), 'product_cat' );
		if ( ! is_wp_error( $cats ) && $cats ) {
			$title = $cats[0]->name;
		} else {
			$title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
		}

	} elseif ( is_tax() || is_category() ) {
		$title = single_term_title( '', false );

	} elseif ( is_singular( 'post' ) ) {
		$terms = get_the_category();
		if ( $terms && ! is_wp_error( $terms ) ) {
			$title = $terms[0]->name;
		} else {
			$title = get_the_title( get_option( 'page_for_posts' ) );
		}
	} elseif ( toffedassen_is_portfolio() ) {
		$title = wp_kses( toffedassen_get_option( 'portfolio_page_header_title' ), wp_kses_allowed_html( 'post' ) );
		if ( ! $title ) {
			if ( get_option( 'toffedassen_portfolio_page_id' ) ) {
				$title = get_the_title( get_option( 'toffedassen_portfolio_page_id' ) );
			} else {
				$title = esc_html__( 'Portfolio', 'supro' );
			}
		}
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'toffedassen_the_archive_title' );

/**
 * Open wrapper for catalog content sidebar
 */
function toffedassen_open_wrapper_catalog_content_sidebar() {
	if ( ! toffedassen_is_catalog() ) {
		return;
	}

	?>
	<div class="widget-canvas-content">
		<div class="widget-panel-header hidden-lg">
			<a href="#" class="close-canvas-panel"><span class="icon-cross2"></span></a>
		</div>
		<div class="widget-panel-content">
	<?php
}

add_action( 'toffedassen_before_sidebar_content', 'toffedassen_open_wrapper_catalog_content_sidebar', 10 );

/**
 * Close wrapper for catalog content sidebar
 */
function toffedassen_close_wrapper_catalog_content_sidebar() {
	if ( ! toffedassen_is_catalog() ) {
		return;
	}

	?>
	</div> <!-- .widget-panel-content -->
	</div> <!-- .widget-canvas-content -->
	<?php
}

add_action( 'toffedassen_after_sidebar_content', 'toffedassen_close_wrapper_catalog_content_sidebar', 100 );

/**
 * Footer Portfolio Carousel
 */
function toffedassen_footer_portfolio_carousel() {
	$p_style = toffedassen_get_option( 'portfolio_layout' );

	if ( 'carousel' != $p_style ) {
		return;
	}

	?>
	<!-- If we need navigation buttons -->
	<div class="swiper-button-prev"><span class="icon-chevron-left"></span></div>
	<div class="swiper-button-next"><span class="icon-chevron-right"></span></div>

	<!-- If we need scrollbar -->
	<div class="swiper-scrollbar container"></div>

	<?php
}

add_action( 'toffedassen_after_portfolio_content', 'toffedassen_footer_portfolio_carousel' );