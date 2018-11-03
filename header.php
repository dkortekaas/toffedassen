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
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PDZ78S3');</script>
	<!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PDZ78S3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
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
