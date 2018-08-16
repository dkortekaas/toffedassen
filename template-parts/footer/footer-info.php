<?php
/**
 * Template part for displaying footer site info
 *
 * @package Logiq
 */

?>

	<div class="site-info col-12 col-md">

		<?php
		if ( function_exists( 'the_privacy_policy_link' ) ) :
			the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
		endif;
		?>

		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'logiq' ) ); ?>" class="imprint">
			<?php printf( __( 'Proudly powered by %s', 'logiq' ), 'WordPress' ); ?>
		</a>

	</div>
