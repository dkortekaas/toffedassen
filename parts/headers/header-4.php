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
			<div class="menu-socials s-left">
				<?php
				$header_social = toffedassen_get_option( 'header_socials' );

				ob_start();
				toffedassen_get_socials_html( $header_social, 'icon' );
				$socials = ob_get_clean();

				echo apply_filters('toffedassen_menu_socials',$socials);
				?>
			</div>
			<div class="container s-center menu-main">
				<div class="menu-nav">
					<div class="menu-extra menu-search">
						<ul>
							<?php toffedassen_extra_search(); ?>
						</ul>
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

						</ul>
					</div>
				</div>
			</div>
			<div class="menu-extra s-right">
				<ul>
					<?php toffedassen_extra_sidebar(); ?>
					<?php toffedassen_menu_mobile(); ?>
				</ul>
			</div>
		</div>
	</div>
</div>
