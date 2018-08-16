<?php
/**
 * Template part for displaying header site branding
 *
 * @package Logiq
 */

?>

	<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
		<?php
		if ( has_custom_logo() ) :
			the_custom_logo();
		else :
			//echo file_get_contents( get_stylesheet_directory() . '/assets/images/eco-chat.svg' );
		endif;
		?>
		<span class="screen-reader-text"><?php esc_html_e( 'Home', 'logiq' ); ?></span>
	</a>
