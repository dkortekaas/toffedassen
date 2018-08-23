<?php
/**
 * Template part for displaying footer site info links
 *
 * @package Toffedassen
 */

?>

	<div class="widget widget_nav_menu">
		<div class="menu-footer-menu-container">
        	<?php wp_nav_menu( array(
            	'theme_location' => 'footer-menu',
				'menu_id'        => 'footer-menu',
				'container'       => '',
				'menu_class'      => 'navbar-nav mr-auto',
        	) ); ?>		
		</div>
	</div>
