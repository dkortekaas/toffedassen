<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Toffedassen
 */

?>
	<?php

	/*
	 *  toffedassen_site_content_close - 100
	 */
	do_action( 'toffedassen_site_content_close' );
	?>
</div><!-- #content -->

	<?php
	/*
	 * toffedassen_footer_newsletter - 10
	 * toffedassen_footer_newsletter_fix -20
	 */
	do_action( 'toffedassen_before_footer' );
	?>

	<footer id="colophon" class="site-footer">
		<?php do_action( 'toffedassen_footer' ) ?>
	</footer><!-- #colophon -->

	<?php do_action( 'toffedassen_after_footer' ) ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
