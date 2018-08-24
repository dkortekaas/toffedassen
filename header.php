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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php 
	get_template_part( 'template-parts/header/header', 'favicons' );
	wp_head();
	toffedassen_gtm_scripts();
	?>
</head>

<body <?php body_class( toffedassen_get_post_slug() ); ?> <?php toffedassen_html_tag_schema(); ?>>

	<div id="page" class="hfeed site">

	<?php do_action( 'toffedassen_before_header' ); ?>

	<div id="su-header-minimized" class="su-header-minimized su-header-1"></div>

	<header id="masthead" class="site-header" itemscope itemtype="http://schema.org/WPHeader">
		
		<?php do_action( 'toffedassen_header' ); ?>

		<div class="supro-container">
			<div class="header-main">
				<div class="header-row">

					<div class="menu-logo s-left">
					
						<?php get_template_part( 'template-parts/header/header', 'branding' ); ?>

					</div>
					<div class="container s-center menu-main">

						<?php get_template_part( 'template-parts/navigation/navigation', 'main' ); ?>

					</div>

					<div class="menu-extra s-right">

						<?php get_template_part( 'template-parts/navigation/navigation', 'right' ); ?>

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
