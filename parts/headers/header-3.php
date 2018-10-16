<?php
/**
 * Template part for displaying header v3.
 *
 * @package Toffe Dassen
 */

?>
<div class="toffedassen-container">
	<div class="header-main">
		<div class="row header-row">
			<div class="menu-logo col-lg-2 col-md-6 col-sm-6 col-xs-6">
				<div class="site-logo">
					<?php get_template_part( 'parts/logo' ); ?>
				</div>
			</div>
			<div class="menu-main col-lg-10 col-md-6 col-sm-6 col-xs-6">
				<div class="menu-extra">
					<ul>
						<?php toffedassen_extra_search(); ?>
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
</div>