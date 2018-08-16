<?php
/**
 * Template part for displaying projects
 *
 * @package Logiq
 */

?>

    <section class="projects">

        <div class="container">

            <h1 class="projects_header"><?php _e('Recent projects', 'weblogiq'); ?></h1>

            <div class="projects-text">
                <p></p>
            </div>

            <section class="projects_grid">

            <?php
            $args = array( 'post_type' => 'portfolio', 'posts_per_page' => 6 );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <div class="project" itemscope itemtype="http://schema.org/Thing">

                    <div class="project_overlay"></div>

                    <a class="project_url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" itemprop="url">

                        <?php
                        $image = get_field('overview_image');
                        if( !empty($image) ) :
                            $url = $image['url'];
                            $title = $image['title'];
                            $alt = $image['alt'];
                            $size = 'portfolio-home';
                            $thumb = $image['sizes'][ $size ];
                            $width = $image['sizes'][ $size . '-width' ];
                            $height = $image['sizes'][ $size . '-height' ];
                        ?>

                        <img class="project_image" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" itemprop="image" />

                        <?php endif; ?>

                        <div class="project_text">

                            <h2 class="project_title" itemprop="name"><?php the_title(); ?></h2>

                            <p class="project_tags">
                                <?php
                                $term_list = wp_get_post_terms($post->ID);
                                foreach ($term_list as $term_single) :
                                    echo '<span>'. $term_single->slug . '</span>';
                                endforeach;
                                ?>
                            </p>

                        </div>

                    </a>

                </div>

            <?php endwhile;
            wp_reset_postdata();
            ?>

            </section>

        </div>

    </section>