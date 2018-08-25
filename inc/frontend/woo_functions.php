<?php

function toffedassen_product() {
    global $product;
    $attachment_ids  = $product->get_gallery_image_ids();
    $secondary_thumb = intval( toffedassen_get_option( 'disable_secondary_thumb' ) );
    $shop_view       = toffedassen_get_option( 'shop_view' );
    $new_duration = toffedassen_get_option( 'product_newness' );

    echo '<div class="un-product-thumbnail">';
        echo '<a href ="'. esc_url( get_the_permalink() ) .'" class="">';

        if ( function_exists( 'woocommerce_get_product_thumbnail' ) ) :
            echo woocommerce_get_product_thumbnail();
        endif;

        if ( ! $secondary_thumb && $attachment_ids ) :
            echo wp_get_attachment_image( $attachment_ids[0], 'shop_catalog', '', array( 'class' => 'image-hover' ) );
        endif;

        if ( intval( toffedassen_get_option( 'show_badges' ) ) ) :
            $output = array();
            $badges = toffedassen_get_option( 'badges' );
            // Change the default sale ribbon

            $custom_badges = maybe_unserialize( get_post_meta( $product->get_id(), 'custom_badges_text', true ) );
            if ( $custom_badges ) :
                $output[] = '<span class="custom ribbon">' . esc_html( $custom_badges ) . '</span>';

            else :

                if ( $product->get_stock_status() == 'outofstock' && in_array( 'outofstock', $badges ) ) :
                    $outofstock = toffedassen_get_option( 'outofstock_text' );
                    if ( ! $outofstock ) :
                        $outofstock = esc_html__( 'Out Of Stock', 'toffedassen' );
                    endif;
                    $output[] = '<span class="out-of-stock ribbon">' . esc_html( $outofstock ) . '</span>';
                elseif ( $product->is_on_sale() && in_array( 'sale', $badges ) ) :
                    $sale = toffedassen_get_option( 'sale_text' );
                    if ( ! $sale ) :
                        $sale = esc_html__( 'Sale', 'toffedassen' );
                    endif;

                    $output[] = '<span class="onsale ribbon">' . esc_html( $sale ) . '</span>';

                elseif ( $product->is_featured() && in_array( 'hot', $badges ) ) :
                    $hot = toffedassen_get_option( 'hot_text' );
                    if ( ! $hot ) :
                        $hot = esc_html__( 'Hot', 'toffedassen' );
                    endif;
                    $output[] = '<span class="featured ribbon">' . esc_html( $hot ) . '</span>';
                elseif ( ( time() - ( 60 * 60 * 24 * $new_duration ) ) < strtotime( get_the_time( 'Y-m-d' ) ) && in_array( 'new', $badges ) ||
                        get_post_meta( $product->get_id(), '_is_new', true ) == 'yes'
                ) :
                    $new = toffedassen_get_option( 'new_text' );
                    if ( ! $new ) :
                        $new = esc_html__( 'New', 'toffedassen' );
                    endif;
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

                echo '<a href="' . $product->get_permalink() . '" data-id="' . esc_attr( $product->get_id() ) . '"  class="toffedassen-product-quick-view hidden-sm hidden-xs" data-original-title="' . esc_attr__( 'Quick View', 'toffedassen' ) . '" data-rel="tooltip"><i class="icon-frame-expand"></i></a>';

            echo '</div>';
        echo '</div>';
    echo '</div>';

    echo '<div class="un-product-details">';
        printf( '<h3><a href="%s">%s</a></h3>', esc_url( get_the_permalink() ), get_the_title() );
        ?>
        <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
        <?php
        if ( $product->get_type() == 'simple' ) :
            echo wc_get_stock_html( $product );
        endif;
        ?>
        <?php
        echo '<div class="footer-button footer-button-shop-list">';

            if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) :
                woocommerce_template_loop_add_to_cart();
            endif;

            echo '<div class="actions-button">';

                if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) :
                    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                endif;

                echo '<a href="' . $product->get_permalink() . '" data-id="' . esc_attr( $product->get_id() ) . '"  class="toffedassen-product-quick-view hidden-sm hidden-xs" data-original-title="' . esc_attr__( 'Quick View', 'toffedassen' ) . '" data-rel="tooltip"><i class="icon-frame-expand"></i></a>';

            echo '</div>';
        echo '</div>';
    echo '</div>';
}
?>