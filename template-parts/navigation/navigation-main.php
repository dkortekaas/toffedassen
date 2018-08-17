<?php
/**
 * Partial template displays top navigation
 *
 * @package Logiq
 */

?>

	<section class="container">

		<div class="row">

			<?php get_template_part( 'template-parts/header/header', 'branding' ); ?>

			<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label=<?php esc_attr_e( 'Toggle navigation', 'logiq'); ?>>
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="navbar-collapse collapse" id="navbarMain" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

			<?php
			wp_nav_menu( array(
				'theme_location'  => 'main-menu',
				'container'       => '',
				'menu_class'      => 'navbar-nav mr-auto',
				'walker'          => new WP_Bootstrap_Navwalker(),
			) );
			?>

			<?php get_template_part( 'template-parts/header/header', 'search' ); ?>

			<?php get_template_part( 'template-parts/navigation/menu', 'right' ); ?>

		</div>

	</section>
