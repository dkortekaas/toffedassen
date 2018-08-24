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
    </div><!-- #content -->

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

                <!--
                <div class="footer-widget columns-5">
                    <div class="container">
                        <div class="row">

							<?php //get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

                        </div>
                    </div>
                </div>

                <div class="footer-copyright columns-3 style-1">
                    <div class="container">
                        <div class="row footer-copyright-row">

                            <div class="footer-sidebar footer-1 col-md-12 col-lg-4">

								<?php //get_template_part( 'template-parts/footer/footer', 'copyright' ); ?>

                            </div>

                            <div class="footer-sidebar footer-2 col-md-12 col-lg-4">

								<?php //get_template_part( 'template-parts/footer/footer', 'social' ); ?>

                            </div>

                            <div class="footer-sidebar footer-3 col-md-12 col-lg-4">

								<?php //get_template_part( 'template-parts/footer/footer', 'info' ); ?>

                            </div>

                        </div>
                    </div>
                </div>
                -->

            </nav>
        </footer>

        <?php do_action( 'toffedassen_after_footer' ) ?>

    </main>

    <a id="scroll-top" class="backtotop" href="#">
        <i class="icon-arrow-up"></i>
    </a>

	<?php wp_footer(); ?>

</body>
</html>
