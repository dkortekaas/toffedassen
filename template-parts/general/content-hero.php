<?php
/**
 * Template part for displaying content hero
 *
 * @package Logiq
 */

?>

    <section class="hero">

        <div class="hero_video">

            <img class="hero_video_poster" src="<?php bloginfo('template_directory'); ?>/assets/images/bg/video-bg.jpg" style="display:none;" alt="Webdesign- &amp; internetbureau Weblogiq">

            <video class="hero_video_back" preload="auto" loop autoplay muted>
                <source type="video/mp4" src="<?php bloginfo('template_directory'); ?>/assets/videos/Working-Space.mp4">
                <source type="video/webm" src="<?php bloginfo('template_directory'); ?>/assets/videos/Working-Space.webm">
                <source type="video/ogg" src="<?php bloginfo('template_directory'); ?>/assets/videos/Working-Space.ogv">
            </video>

        </div>
        
        <div class="hero_overlay"></div>

        <article class="hero_slogan">

            <header class="hero_slogan_content">

                <?php the_title( '<h3 class="hero_slogan_content_title">', '</h2>' ); ?>

                <h6><?php _e('#logisch', 'weblogiq'); ?></h6>

                <a href="#" class="btn btn--primary" id="btn-scroll"><?php _e('Read more', 'weblogiq'); ?></a>

            </header>

        </article>

    </section>
