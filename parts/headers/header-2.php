<?php
/**
 * Template part for displaying header v2.
 *
 * @package Toffedassen
 */

?>
<div class="container">
	<div class="header-main">
		<div class="header-row">
			<div class="menu-extra menu-search">
				<ul><?php toffedassen_extra_search(); ?></ul>
			</div>
			<div class="menu-logo">
				<div class="site-logo">
					<?php get_template_part( 'parts/logo' ); ?>
				</div>
			</div>
			<div class="menu-extra">
				<ul>
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