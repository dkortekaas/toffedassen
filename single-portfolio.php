<?php
/**
 * Template for displaying single portfolio
 *
 * @package Toffe Dassen
 */

get_header();

$socials = toffedassen_get_option( 'single_portfolio_show_socials' );

$classes = 'portfolio-wrapper single-portfolio-wrapper';
$size = 'toffedassen-single-portfolio';
?>

<div id="primary" class="content-area <?php toffedassen_content_columns() ?>">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
				<header class="entry-header">
					<div class="single-portfolio-title container">
						<h2 class="entry-title"><?php the_title() ?></h2>
					</div>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="entry-thumbnail toffedassen-catalog-container"><?php the_post_thumbnail( $size ) ?></div>
					<?php endif; ?>

					<div class="single-portfolio-entry-meta container">
						<div class="row">
							<div class="col-md-6 col-sm-12 col-xs-12">
								<?php toffedassen_entry_meta_single_portfolio(); ?>
							</div>

							<div class="col-md-6 col-sm-12 col-xs-12">
								<?php
								if ( intval( $socials ) ) :
									toffedassen_get_socials_html( toffedassen_get_option( 'single_portfolio_socials' ) );?>
									<div class="social-label"><?php echo apply_filters( 'toffedassen_social_label_single_portfolio', esc_html__( 'Share:', 'toffedassen' ) ); ?></div>

								<?php endif; ?>

							</div>
						</div>

					</div>

				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</article>

			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php endwhile; ?>

		<?php toffedassen_single_portfolio_nav(); ?>

	<!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
