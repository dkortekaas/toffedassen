<?php
/**
 * Template part for displaying content for front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Logiq
 */

?>

	<section class="front-page">

		<article class="front-page_content">

			<header class="front-page_content_header">

				<?php the_title( '<h2 class="front-page_content_header_title">', '</h2>' ); ?>

			</header>

			<div class="front-page_content_text">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'logiq' ),
						get_the_title()
					) );
				?>
			</div>

		</article>

	</section>