<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Toffedassen
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<?php echo toffedassen_gtm_head(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php 
	get_template_part( 'template-parts/header/header', 'favicons' );
	wp_head();
	?>
</head>

<body <?php body_class( 'header-no-border header-transparent' ); ?> <?php //toffedassen_html_tag_schema(); ?>>

	<?php echo toffedassen_gtm_body(); ?>

	<div id="page" class="hfeed site">

		<div id="su-header-minimized" class="su-header-minimized su-header-1"></div>

		<header id="masthead" class="site-header" itemscope itemtype="http://schema.org/WPHeader">

			<div class="header-container">
				<div class="header-main">
					<div class="header-row">
						<div class="menu-logo s-left">
							<div class="site-logo">
								<?php get_template_part( 'template-parts/header/header', 'branding' ); ?>
							</div>
						</div>
						<div class="container s-center menu-main">
							<div class="menu-nav">
								<nav class="primary-nav nav">
									<?php toffedassen_nav_menu(); ?>
								</nav>
								<div class="menu-extra menu-extra-au">
									<ul class="no-flex">
										<?php toffedassen_extra_search(); ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="menu-extra s-right">
							<ul>
								<?php toffedassen_extra_search(); ?>
								<?php toffedassen_extra_account(); ?>
								<?php toffedassen_extra_wishlist(); ?>
								<?php toffedassen_extra_cart(); ?>
								<?php toffedassen_extra_sidebar(); ?>
								<?php toffedassen_menu_mobile(); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>

		</header>

		<?php
		/*
		*  toffedassen_show_page_header - 20
		*/
		do_action( 'toffedassen_after_header' );
		?>

		<main id="content" class="site-content" role="main">
		<?php
			/*
			*	toffedassen_single_post_format - 10
			*  toffedassen_site_content_open - 20
			*
			*/
			do_action( 'toffedassen_site_content_open' );
		?>
