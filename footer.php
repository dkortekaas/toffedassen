<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
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
    </main>

	<?php
	/*
	 * toffedassen_footer_newsletter - 10
	 * toffedassen_footer_newsletter_fix -20
	 */
	do_action( 'toffedassen_before_footer' );
	?>

        <footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
            <nav class="footer-layout footer-layout-1 light-skin">

            	<?php toffedassen_footer_widgets(); ?>
	            <?php toffedassen_footer_copyright(); ?>

            </nav>
        </footer>

        <?php do_action( 'toffedassen_after_footer' ) ?>

    </div>

	<?php wp_footer(); ?>

</body>
</html>
