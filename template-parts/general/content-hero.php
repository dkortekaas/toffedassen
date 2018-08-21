<?php
/**
 * Template part for displaying content hero
 *
 * @package Logiq
 */

?>

    <section class="container-fluid hero">

        <div class="row hero_video">

            <img class="hero_video_poster" src="<?php bloginfo('template_directory'); ?>/uploads/hero.jpg" alt="">

        </div>
        
        <div class="hero_overlay"></div>

        <article class="hero_slogan">

            <header class="hero_slogan_content">

                <?php the_title( '<h3 class="hero_slogan_content_title">', '</h2>' ); ?>

            </header>

        </article>

    </section>
