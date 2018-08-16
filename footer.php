<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Logiq
 */
?>

	</main>

	<footer class="container-fluid" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

		<div class="row">

			<div class="container">

				<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

				<div class="row">

					<?php get_template_part( 'template-parts/footer/footer', 'menu' ); ?>

					<?php get_template_part( 'template-parts/footer/footer', 'info' ); ?>

				</div>

			</div>

		</div>

	</footer>

	<?php wp_footer(); ?>

</body>
</html>
