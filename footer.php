<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Toffedassen
 */
?>

        <footer class="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
            <nav class="footer-layout footer-layout-1 light-skin">

                <div class="footer-widget columns-5">
                    <div class="container">
                        <div class="row">

							<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

                        </div>
                    </div>
                </div>

                <div class="footer-copyright columns-3 style-1">
                    <div class="container">
                        <div class="row footer-copyright-row">

                            <div class="footer-sidebar footer-1 col-md-12 col-lg-4">

								<?php get_template_part( 'template-parts/footer/footer', 'copyright' ); ?>

                            </div>

                            <div class="footer-sidebar footer-2 col-md-12 col-lg-4">

								<?php get_template_part( 'template-parts/footer/footer', 'social' ); ?>

                            </div>

                            <div class="footer-sidebar footer-3 col-md-12 col-lg-4">

								<?php get_template_part( 'template-parts/footer/footer', 'info' ); ?>

                            </div>

                        </div>
                    </div>
                </div>

            </nav>
        </footer>

    </main>

    <a id="scroll-top" class="backtotop" href="#">
        <i class="icon-arrow-up"></i>
    </a>

	<?php wp_footer(); ?>

</body>
</html>
