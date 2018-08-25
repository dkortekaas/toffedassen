
<?php
/**
 * The template for displaying 404 pages (Not Found).
 * 
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Toffedassen
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<section class="error-404 not-found">
			<div class="page-content col-md-12 col-xs-12 col-sm-12">
				<span class="icon-confused error-icon"></span>
				<h1 class="page-title"><?php esc_html_e( 'ohh! page not found', 'toffedassen' ); ?></h1>

				<p>
					<?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help or go back to ", 'toffedassen' ); ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'toffedassen' ); ?></a>
				</p>

				<?php get_search_form(); ?>

				<aside class="widget widget_categories">
					<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'logiq' ); ?></h2>
					<ul>
						<?php
						wp_list_categories( array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 10,
						) );
						?>
					</ul>
				</aside>

			</div>
			<!-- .page-content -->
		</section>
		<!-- .error-404 -->

	</main>
	<!-- #main -->
</div><!-- #primary -->

<?php get_footer();
