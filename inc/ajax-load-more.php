<?php
/**
 * Custom login setup.
 *
 * @package Weblogiq
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'weblogiq_more_post_ajax' ) ) :
function weblogiq_ajax_pagination() {

    $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );
    
    $query_vars['ppp'] = $_POST['ppp'];
    $query_vars['pageNumber'] = $_POST['pageNumber'];


    //$ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 6;
    //$page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    header("Content-Type: text/html");

    $args = array(
        'suppress_filters'  => true,
        'post_type'         => 'portfolio',
        'posts_per_page'    => $query_vars['ppp'],
        'paged'             => $query_vars['pageNumber'],
    );

    $loop = new WP_Query($args);

    $out = '';

    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            $term_list = wp_get_post_terms(get_the_ID());
            $terms = '';
            $term_names = '';
            foreach ($term_list as $term_single) :
                $terms .= $term_single->slug . ' ';
                $term_names .= '<span>'. $term_single->name .'</span>';
            endforeach;

            $image = get_field('overview_image');
        
            if( !empty($image) ) :
                $url = $image['url'];
                $title = $image['title'];
                $alt = $image['alt'];

                $size = 'portfolio-overview';
                $thumb = $image['sizes'][ $size ];
                $width = $image['sizes'][ $size . '-width' ];
                $height = $image['sizes'][ $size . '-height' ];
            endif;

            $out .= '<article class="project col col--1-2 mix '. $terms .'">
                <a href="'. get_the_permalink() .'" class="project-link" title="'.get_the_title().'">
                    <div class="project-thumb">
                        <img src="'. $thumb .'" alt="'. $alt .'" width="'. $width .'" height="'. $height .'" />
                    </div>
                    <div class="project-content">
                        <h2>'.get_the_title().'</h2>
                        <p class="project-tags">' . $term_names. '</p>
                    </div>
                </a>
            </article>';
        endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}
add_action( 'wp_ajax_nopriv_ajax_pagination', 'weblogiq_ajax_pagination' );
add_action( 'wp_ajax_ajax_pagination', 'weblogiq_ajax_pagination' );
endif;