<?php
/**
 * Template part for displaying footer widgets if assigned
 *
 * @package Logiq
 */

?>

<?php
if ( is_active_sidebar( 'footer-1' ) ||
	 is_active_sidebar( 'footer-2' ) ||
	 is_active_sidebar( 'footer-3' ) ||
	 is_active_sidebar( 'footer-4' ) ) :
?>

	<aside class="row" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'logiq' ); ?>">
		<?php
		if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<section class="col-6 col-md">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</section>
		<?php 
		endif;
		if ( is_active_sidebar( 'footer-2' ) ) : ?>
			<section class="col-6 col-md">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</section>
		<?php
		endif;
		if ( is_active_sidebar( 'footer-3' ) ) : ?>
			<section class="col-6 col-md">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</section>
		<?php
		endif;
		if ( is_active_sidebar( 'footer-4' ) ) : ?>
			<section class="col-6 col-md">
				<?php dynamic_sidebar( 'footer-4' ); ?>
			</section>
		<?php
		endif;
		?>
	</aside>

<?php endif; ?>
