<?php
/**
 * Template part for displaying footer widgets if assigned
 *
 * @package Toffedassen
 */

?>

<?php
if ( is_active_sidebar( 'footer-1' ) ||
	 is_active_sidebar( 'footer-2' ) ||
	 is_active_sidebar( 'footer-3' ) ||
	 is_active_sidebar( 'footer-4' ) ||
	 is_active_sidebar( 'footer-5' ) ) :
?>

	<section class="footer-widget columns-5" role="complementary">
		<div class="container">
			<div class="row">

			<?php
			if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<section class="footer-sidebar footer-1 col-xs-12 col-sm-6 col-md-1-5">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</section>
			<?php 
			endif;
			if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<section class="footer-sidebar footer-1 col-xs-12 col-sm-6 col-md-1-5">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</section>
			<?php
			endif;
			if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<section class="footer-sidebar footer-1 col-xs-12 col-sm-6 col-md-1-5">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</section>
			<?php
			endif;
			if ( is_active_sidebar( 'footer-4' ) ) : ?>
				<section class="footer-sidebar footer-1 col-xs-12 col-sm-6 col-md-1-5">
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</section>
			<?php
			endif;
			if ( is_active_sidebar( 'footer-5' ) ) : ?>
				<section class="footer-sidebar footer-1 col-xs-12 col-sm-6 col-md-1-5">
					<?php dynamic_sidebar( 'footer-5' ); ?>
				</section>
			<?php
			endif;
			?>

			</div>
		</div>
	</section>

<?php endif; ?>
