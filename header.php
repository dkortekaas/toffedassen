<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Logiq
 */
?>

<!doctype html>
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
	logiq_gtm_scripts();
	?>
</head>

<body <?php body_class( logiq_get_post_slug() ); ?> <?php logiq_html_tag_schema(); ?>>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'logiq' ); ?></a>

	<header role="banner" itemscope itemtype="http://schema.org/WPHeader">

		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

			<?php get_template_part( 'template-parts/navigation/navigation', 'main' ); ?>

		</nav>

	</header>

	<main id="content" role="main">
