<?php
/**
 * Template part for displaying header left sidebar.
 *
 * @package Toffe Dassen
 */

$header_copyright = get_post_meta( get_the_ID(), 'header_copyright', true );

?>
<div class="header-main menu-sidebar-panel">
	<div class="menu-panel-header">
		<div class="menu-logo">
			<div class="site-logo">
				<?php get_template_part( 'parts/logo' ); ?>
			</div>
			<div class="menu-extra menu-sidebar">
				<ul>
					<?php toffedassen_extra_sidebar(); ?>
					<?php toffedassen_menu_mobile(); ?>
				</ul>
			</div>
		</div>
		<div class="menu-extra menu-search">
			<ul><?php toffedassen_extra_search(); ?></ul>
		</div>
	</div>

	<div class="menu-panel-body">
		<div class="menu-main">
			<nav class="primary-nav nav">
				<?php toffedassen_nav_menu(); ?>
				<?php toffedassen_extra_language_switcher(); ?>
			</nav>
		</div>
	</div>
	<div class="menu-panel-extra">
		<div class="menu-extra">
			<ul>
				<?php toffedassen_extra_account(); ?>
				<?php toffedassen_extra_wishlist(); ?>
				<?php toffedassen_extra_cart(); ?>
			</ul>
		</div>
	</div>
	<div class="menu-panel-footer">
		<div class="header-social">
			<?php
			$header_social = get_post_meta( get_the_ID(), 'header_socials', true );

			toffedassen_get_socials_html( $header_social, 'icon' );
			?>
		</div>
		<div class="copyright"><?php echo wp_kses( $header_copyright, wp_kses_allowed_html( 'post' ) ); ?></div>
	</div>
</div>
