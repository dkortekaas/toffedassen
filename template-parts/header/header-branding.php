<?php
/**
 * Template part for displaying header site branding
 *
 * @package Toffedassen
 */

?>

	<div class="site-logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
			<img src="<?php echo get_stylesheet_directory() . '/assets/images/logo.svg'; ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo logo-dark">
			<img src="<?php echo get_stylesheet_directory() . '/assets/images/logo-light.svg'; ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo logo-light">
		</a>
		<p class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</p>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div>
