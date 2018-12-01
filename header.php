<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Toffe Dassen
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'sidebar-content filter-mobile-enable' ); ?>>
<div id="page" class="hfeed site">

	<?php do_action( 'toffedassen_before_header' ); ?>

	<header id="masthead" class="site-header">
		<?php do_action( 'toffedassen_header' ); ?>
	</header><!-- #masthead -->

	<?php
	/*
	 *  toffedassen_show_page_header - 20
	 */
	do_action( 'toffedassen_after_header' );
	?>

	<div id="content" class="site-content">
		<?php
		/*
		 *	toffedassen_single_post_format - 10
		 *  toffedassen_site_content_open - 20
		 *
		 */
		do_action( 'toffedassen_site_content_open' );
		?>
