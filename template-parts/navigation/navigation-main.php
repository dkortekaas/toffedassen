<?php
/**
 * Partial template displays top navigation
 *
 * @package Toffedassen
 */

?>

	<div class="menu-nav">
		<nav class="primary-nav nav">
		<?php
			$classes = 'menu none';
			wp_nav_menu(
				array(
					'theme_location' => 'main-menu',
					'container'      => false,
					'walker'         => new toffedassen_Mega_Menu_Walker(),
					'menu_class'     => $classes,
				)
			);
		?>
		</nav>

		<?php get_template_part( 'template-parts/header/header', 'search' ); ?>

	</div>
