<?php
/**
 * Template part for displaying header v1.
 *
 * @package Toffe Dassen
 */

?>
<div class="toffedassen-container">
	<div class="header-main">
		<div class="header-row">
			<div class="menu-logo s-left">
				<div class="site-logo">
					<?php get_template_part( 'parts/logo' ); ?>
				</div>
			</div>
			<div class="container s-center menu-main">
				<div class="menu-nav">
					<nav class="primary-nav nav">
						<?php toffedassen_nav_menu(); ?>
					</nav>
					<div class="menu-extra menu-extra-au">
						<ul class="no-flex">
							<?php toffedassen_extra_search(); ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="menu-extra s-right">
				<ul>
					<?php toffedassen_extra_search(); ?>
					<?php toffedassen_extra_language_switcher( 'hidden-md hidden-sm hidden-xs' ); ?>
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
