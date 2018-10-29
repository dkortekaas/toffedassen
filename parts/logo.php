<?php
/**
 * Hooks for template logo
 *
 * @package Solo
 */

$logo  = toffedassen_get_option( 'logo' );

if ( ! $logo ) {
	$logo = get_template_directory_uri() . '/assets/svg/logo.svg';
}

if ( is_page_template( 'template-coming-soon-page.php' ) ) {
	$logo = toffedassen_get_option( 'coming_soon_logo' );

	if ( ! $logo ) {
		$logo = get_template_directory_uri() . '/assets/svg/logo.svg';
	}
}

?>
	<a href="<?php echo esc_url( home_url() ) ?>" class="logo">
		<img type="image/svg+xml" src="<?php echo esc_url( $logo ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" class="logo">
	</a>
<?php

printf(
	'<%1$s class="site-title"><a href="%2$s" rel="home">%3$s</a></%1$s>',
	is_home() || is_front_page() ? 'h1' : 'p',
	esc_url( home_url( '' ) ),
	get_bloginfo( 'name' )
);
?>
<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
