<?php
/**
 * Partial template displays top navigation
 *
 * @package Logiq
 */

?>

	<div class="menu-nav">
		<nav class="primary-nav nav">
		<?php
			wp_nav_menu( array(
				'theme_location'  => 'main-menu',
				'container'       => '',
				'menu_class'      => 'navbar-nav mr-auto',
				'walker'          => new WP_Bootstrap_Navwalker(),
			) );
		?>
		</nav>

		<?php get_template_part( 'template-parts/header/header', 'search' ); ?>

	</div>
