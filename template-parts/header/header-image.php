<?php
/**
 * Template part for displaying header media
 *
 * @package Logiq
 */

?>

	<div class="row">

		<div class="custom-header">

			<div class="custom-header-media">
				<?php the_custom_header_markup(); ?>
			</div>

			<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

		</div>

	</div>
