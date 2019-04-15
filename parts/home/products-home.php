<?php
/**
 * Template part for displaying products on front page
 *
 * @package Toffe Dassen
 */

?>

    <div class="vc_row wpb_row vc_row-fluid toffedassen-no-padding-left toffedassen-no-padding-right vc_custom_1531299284109 toffedassen-row-full-width">
        <div class="container-fluid">
            <div class="row">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="toffedassen-products-grid toffedassen-products style-4 border-bottom">

                                <div class="product-header">
                                    <ul class="nav nav-tabs nav-filter filter" role="tablist">
                                        <li role="presentation" class="active"><a href="#sale" aria-controls="sale" role="tab" data-toggle="tab">
                                            <?php _e('Sales', 'toffedassen'); ?>
                                        </a></li>
                                        <li role="presentation"><a href="#latest" aria-controls="latest" role="tab" data-toggle="tab">
                                            <?php _e('Latest Products', 'toffedassen'); ?>
                                        </a></li>
                                        <!-- <li role="presentation"><a href="#mostsold" aria-controls="mostsold" role="tab" data-toggle="tab">
                                            <?php _e('Most Sold', 'toffedassen'); ?>
                                        </a></li> -->
                                    </ul>
                                </div>

                                <div class="product-wrapper tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="sale">
                                        <div class="woocommerce columns-5">
                                            <ul class="products columns-5">
                                            <?php
                                            $args_sale = array(
                                                'posts_per_page' => 10,
                                                'post_type' => 'product',
                                                'meta_key' => '_sale_price',
                                                'meta_value' => '0',
                                                'meta_compare' => '>='
                                            );
                                            $loop_sale = new WP_Query( $args_sale );
                                            $count_sale = 0;
                                            $class_sale = '';
                                            while ( $loop_sale->have_posts() ) : $loop_sale->the_post();
                                                $total_sale = $loop_sale->found_posts;
                                                if ( $count_sale == 0 ) :
                                                    $class_sale = ' first';
                                                elseif ( $count_sale == ($total_sale - 1) ) :
                                                    $class_sale = ' last';
                                                else :
                                                    $class_sale = '';
                                                endif; 
                                                $count_sale++;

                                                $_product_sale = wc_get_product( get_the_ID() );
                                            ?>
                                                <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class_sale; ?>">
                                                    <div class="product-inner clearfix">
                                                        <?php toffedassen_product( $_product_sale ); ?>
                                                    </div>
                                                </li>
                                            <?php endwhile; ?>
                                            <?php 
                                                wp_reset_postdata();
                                                wp_reset_query(); 
                                            ?>
                                            </ul>
                                        </div>
                                    </div>


                                    <div role="tabpanel" class="tab-pane" id="latest">

                                        <div class="woocommerce columns-5">
                                            <ul class="products columns-5">
                                            <?php
                                            $latest_query = new WC_Product_Query( array(
                                                'limit' => 10,
                                                'category' => array( 'stropdassen' ),
                                                'orderby' => 'date_created',
                                                'order' => 'DESC',
                                            ) );
                                            $latest_products = $latest_query->get_products();

                                            if (!empty($latest_products)) :
                                                foreach ($latest_products as $latest_product) : ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php //echo $class_latest; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php  
                                                                $attachment_ids  = $latest_product->get_gallery_image_ids();
                                                                $secondary_thumb = intval( toffedassen_get_option( 'disable_secondary_thumb' ) );
                                                                $shop_view       = toffedassen_get_option( 'shop_view' );
                                                                $new_duration    = toffedassen_get_option( 'product_newness' );
                                                            
                                                                echo '<div class="un-product-thumbnail">';
                                                                    echo '<a href ="'. esc_url( $latest_product->get_permalink() ) .'" class="">';
                                                            
                                                                    echo get_the_post_thumbnail($latest_product->get_id());
                                                            
                                                                    if ( ! $secondary_thumb && $attachment_ids ) :
                                                                        echo wp_get_attachment_image( $attachment_ids[0], 'shop_catalog', '', array( 'class' => 'image-hover' ) );
                                                                    endif;
                                                            
                                                                    if ( intval( toffedassen_get_option( 'show_badges' ) ) ) :
                                                                        $output = array();
                                                                        $badges = toffedassen_get_option( 'badges' );
                                                                        // Change the default sale ribbon
                                                            
                                                                        $custom_badges = maybe_unserialize( get_post_meta( $latest_product->get_id(), 'custom_badges_text', true ) );
                                                                        if ( $custom_badges ) :
                                                                            $output[] = '<span class="custom ribbon">' . esc_html( $custom_badges ) . '</span>';
                                                            
                                                                        else :
                                                            
                                                                            if ( $latest_product->get_stock_status() == 'outofstock' && in_array( 'outofstock', $badges ) ) :
                                                                                $outofstock = esc_html__( 'Out Of Stock', 'toffedassen' );
                                                                                $output[] = '<span class="out-of-stock ribbon">' . esc_html( $outofstock ) . '</span>';
                                                                            elseif ( $latest_product->is_on_sale() && in_array( 'sale', $badges ) ) :
                                                                                $sale = esc_html__( 'Sale', 'toffedassen' );
                                                                                $output[] = '<span class="onsale ribbon">' . esc_html( $sale ) . '</span>';
                                                                            elseif ( $latest_product->is_featured() && in_array( 'hot', $badges ) ) :
                                                                                $hot = esc_html__( 'Hot', 'toffedassen' );
                                                                                $output[] = '<span class="featured ribbon">' . esc_html( $hot ) . '</span>';
                                                                            elseif ( ( time() - ( 60 * 60 * 24 * $new_duration ) ) < strtotime( get_the_time( 'Y-m-d' ) ) && in_array( 'new', $badges ) ||
                                                                                    get_post_meta( $latest_product->get_id(), '_is_new', true ) == 'yes'
                                                                            ) :
                                                                                $new = esc_html__( 'New', 'toffedassen' );
                                                                                $output[] = '<span class="newness ribbon">' . esc_html( $new ) . '</span>';
                                                                            endif;
                                                                        endif;
                                                            
                                                                        if ( $output ) :
                                                                            printf( '<span class="ribbons">%s</span>', implode( '', $output ) );
                                                                        endif;
                                                            
                                                                    endif;
                                                            
                                                                    echo '</a>';
                                                            
                                                                    echo '<div class="footer-button">';
                                                            
                                                                        if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) :
                                                                            woocommerce_template_loop_add_to_cart();
                                                                        endif;
                                                            
                                                                        echo '<div class="actions-button">';
                                                            
                                                                            if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) :
                                                                                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                                                                            endif;
                                                            
                                                                            echo '<a href="' . $latest_product->get_permalink() . '" data-id="' . esc_attr( $latest_product->get_id() ) . '"  class="toffedassen-product-quick-view hidden-sm hidden-xs" data-original-title="' . esc_attr__( 'Quick View', 'toffedassen' ) . '" data-rel="tooltip"><i class="icon-frame-expand"></i></a>';
                                                            
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                echo '</div>';
                                                            
                                                                echo '<div class="un-product-details">';
                                                                    printf( '<h3><a href="%s">%s</a></h3>', esc_url( $latest_product->get_permalink() ), $latest_product->get_title() );
                                                                    ?>
                                                                    <span class="price"><?php echo wp_kses_post($latest_product->get_price_html()); ?></span>
                                                                    <?php
                                                                    echo '<div class="footer-button footer-button-shop-list">';
                                                            
                                                                        if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) :
                                                                            woocommerce_template_loop_add_to_cart();
                                                                        endif;
                                                            
                                                                        echo '<div class="actions-button">';
                                                            
                                                                            if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) :
                                                                                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                                                                            endif;
                                                            
                                                                            echo '<a href="' . $latest_product->get_permalink() . '" data-id="' . esc_attr( $latest_product->get_id() ) . '"  class="toffedassen-product-quick-view hidden-sm hidden-xs" data-original-title="' . esc_attr__( 'Quick View', 'toffedassen' ) . '" data-rel="tooltip"><i class="icon-frame-expand"></i></a>';
                                                            
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                echo '</div>';
                                                            
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php
                                                endforeach;
                                            endif;
                                            wp_reset_query(); 
                                            ?>
                                            </ul>
                                        </div>

                                    </div>
 
                                    <!-- <div role="tabpanel" class="tab-pane" id="mostsold">

                                        <div class="woocommerce columns-5">
                                            <ul class="products columns-5">
                                                <?php
                                                $mostsold_query = new WC_Product_Query( array(
                                                    'limit'         => 10,
                                                    'category'      => array( 'stropdassen' ),
                                                    'total_sales'   => 'meta_value_num',
                                                ) );
                                                $mostsold_products = $mostsold_query->get_products();
    
                                                if (!empty($mostsold_products)) :
                                                    foreach ($mostsold_products as $mostsold_product) : ?>
                                                        <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php //echo $class_latest; ?>">
                                                            <div class="product-inner clearfix">
                                                                <?php  
                                                                    $attachment_ids  = $mostsold_product->get_gallery_image_ids();
                                                                    $secondary_thumb = intval( toffedassen_get_option( 'disable_secondary_thumb' ) );
                                                                    $shop_view       = toffedassen_get_option( 'shop_view' );
                                                                    $new_duration    = toffedassen_get_option( 'product_newness' );
                                                                
                                                                    echo '<div class="un-product-thumbnail">';
                                                                        echo '<a href ="'. esc_url( $mostsold_product->get_permalink() ) .'" class="">';
                                                                
                                                                        echo get_the_post_thumbnail($mostsold_product->get_id());
                                                                
                                                                        if ( ! $secondary_thumb && $attachment_ids ) :
                                                                            echo wp_get_attachment_image( $attachment_ids[0], 'shop_catalog', '', array( 'class' => 'image-hover' ) );
                                                                        endif;
                                                                
                                                                        if ( intval( toffedassen_get_option( 'show_badges' ) ) ) :
                                                                            $output = array();
                                                                            $badges = toffedassen_get_option( 'badges' );
                                                                            // Change the default sale ribbon
                                                                
                                                                            $custom_badges = maybe_unserialize( get_post_meta( $mostsold_product->get_id(), 'custom_badges_text', true ) );
                                                                            if ( $custom_badges ) :
                                                                                $output[] = '<span class="custom ribbon">' . esc_html( $custom_badges ) . '</span>';
                                                                
                                                                            else :
                                                                
                                                                                if ( $mostsold_product->get_stock_status() == 'outofstock' && in_array( 'outofstock', $badges ) ) :
                                                                                    $outofstock = esc_html__( 'Out Of Stock', 'toffedassen' );
                                                                                    $output[] = '<span class="out-of-stock ribbon">' . esc_html( $outofstock ) . '</span>';
                                                                                elseif ( $mostsold_product->is_on_sale() && in_array( 'sale', $badges ) ) :
                                                                                    $sale = esc_html__( 'Sale', 'toffedassen' );
                                                                                    $output[] = '<span class="onsale ribbon">' . esc_html( $sale ) . '</span>';
                                                                                elseif ( $mostsold_product->is_featured() && in_array( 'hot', $badges ) ) :
                                                                                    $hot = esc_html__( 'Hot', 'toffedassen' );
                                                                                    $output[] = '<span class="featured ribbon">' . esc_html( $hot ) . '</span>';
                                                                                elseif ( ( time() - ( 60 * 60 * 24 * $new_duration ) ) < strtotime( get_the_time( 'Y-m-d' ) ) && in_array( 'new', $badges ) ||
                                                                                        get_post_meta( $mostsold_product->get_id(), '_is_new', true ) == 'yes'
                                                                                ) :
                                                                                    $new = esc_html__( 'New', 'toffedassen' );
                                                                                    $output[] = '<span class="newness ribbon">' . esc_html( $new ) . '</span>';
                                                                                endif;
                                                                            endif;
                                                                
                                                                            if ( $output ) :
                                                                                printf( '<span class="ribbons">%s</span>', implode( '', $output ) );
                                                                            endif;
                                                                
                                                                        endif;
                                                                
                                                                        echo '</a>';
                                                                
                                                                        echo '<div class="footer-button">';
                                                                
                                                                            if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) :
                                                                                woocommerce_template_loop_add_to_cart();
                                                                            endif;
                                                                
                                                                            echo '<div class="actions-button">';
                                                                
                                                                                if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) :
                                                                                    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                                                                                endif;
                                                                
                                                                                echo '<a href="' . $mostsold_product->get_permalink() . '" data-id="' . esc_attr( $mostsold_product->get_id() ) . '"  class="toffedassen-product-quick-view hidden-sm hidden-xs" data-original-title="' . esc_attr__( 'Quick View', 'toffedassen' ) . '" data-rel="tooltip"><i class="icon-frame-expand"></i></a>';
                                                                
                                                                            echo '</div>';
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                
                                                                    echo '<div class="un-product-details">';
                                                                        printf( '<h3><a href="%s">%s</a></h3>', esc_url( $mostsold_product->get_permalink() ), $mostsold_product->get_title() );
                                                                        ?>
                                                                        <span class="price"><?php echo wp_kses_post($mostsold_product->get_price_html()); ?></span>
                                                                        <?php
                                                                        echo '<div class="footer-button footer-button-shop-list">';
                                                                
                                                                            if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) :
                                                                                woocommerce_template_loop_add_to_cart();
                                                                            endif;
                                                                
                                                                            echo '<div class="actions-button">';
                                                                
                                                                                if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) :
                                                                                    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                                                                                endif;
                                                                
                                                                                echo '<a href="' . $mostsold_product->get_permalink() . '" data-id="' . esc_attr( $mostsold_product->get_id() ) . '"  class="toffedassen-product-quick-view hidden-sm hidden-xs" data-original-title="' . esc_attr__( 'Quick View', 'toffedassen' ) . '" data-rel="tooltip"><i class="icon-frame-expand"></i></a>';
                                                                
                                                                            echo '</div>';
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                
                                                                ?>
                                                            </div>
                                                        </li>
                                                    <?php
                                                    endforeach;
                                                endif;
                                                wp_reset_query(); 
                                                ?>
                                            </ul>
                                        </div>

                                    </div> -->

                                    <div class="load-more text-center">
                                        <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="ajax-load-products">
                                            <span class="button-text"><?php _e('All Products', 'toffedassen'); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
