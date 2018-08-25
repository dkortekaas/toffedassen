<?php
$css = '';
$image = toffedassen_get_option( 'blog_page_header_background' );
$parallax = toffedassen_get_option( 'blog_page_header_parallax' );
$text_color = toffedassen_get_option( 'blog_page_header_text_color' );

if ( ! $image ) {
	$css .= ' no-bg';
} else {
	if ( intval( $parallax ) ) {
		$css .= ' parallax';
	}
}

$css .= ' text-' . $text_color;

?>
<div class="page-header blog-page-header layout-2 text-center <?php echo esc_attr( $css ); ?>">
	<div class="feature-image" style="background-image:url( <?php echo esc_url( $image ) ?> );"></div>
	<div class="container">
		<?php
		the_archive_title( '<h1>', '</h1>' );
		toffedassen_get_breadcrumbs();
		?>
	</div>
</div>