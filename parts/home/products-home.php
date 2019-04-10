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
                                        <li role="presentation" class="active"><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab">Meest verkocht</a></li>
                                        <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Nieuwe producten</a></li>
                                        <li role="presentation"><a href="#onsale" aria-controls="onsale" role="tab" data-toggle="tab">Aanbiedingen</a></li>
                                    </ul>
                                </div>

                                <div class="product-wrapper tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="sales">

                                        <div class="woocommerce columns-5">
                                            <ul class="products columns-5">
                                                <?php
                                                $args_sales = array(
                                                    'post_type' => 'product',
                                                    'stock' => 1,
                                                    'meta_key' => 'total_sales',
                                                    'orderby' => 'meta_value_num',
                                                    'posts_per_page' => 10,
                                                );
                                                $loop_sales = new WP_Query( $args_sales );
                                                $count_sales = 0;
                                                $class_sales = '';
                                                while ( $loop_sales->have_posts() ) : $loop_sales->the_post();
                                                    $total_sales = $loop_sales->found_posts;
                                                    //global $product;
                                                    if ( $count_sales == 0 ) :
                                                        $class_sales = ' first';
                                                    elseif ( $count_sales == ($total_sales - 1) ) :
                                                        $class_sales = ' last';
                                                    else :
                                                        $class_sales = '';
                                                    endif; 
                                                    $count_sales++;
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class_sales; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php toffedassen_product(); ?>
                                                        </div>
                                                    </li>
                                                <?php endwhile; ?>
                                                <?php wp_reset_query(); ?>
                                            </ul>
                                        </div>

                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="new">

                                        <div class="woocommerce columns-5">
                                            <ul class="products columns-5">
                                                <?php
                                                $args_new = array(
                                                    'post_type' => 'product',
                                                    'stock' => 1,
                                                    'posts_per_page' => 10,
                                                    'orderby' =>'date',
                                                    'order' => 'DESC'
                                                );
                                                $loop_new = new WP_Query( $args_new );
                                                $count_new = 0;
                                                $class_new = '';
                                                while ( $loop_new->have_posts() ) : $loop_new->the_post();
                                                    $total_new = $loop_new->found_posts;
                                                    //global $product;
                                                    if ( $count_new == 0 ) :
                                                        $class_new = ' first';
                                                    elseif ( $count_new == ($total_new - 1) ) :
                                                        $class_new = ' last';
                                                    else :
                                                        $class_new = '';
                                                    endif; 
                                                    $count_new++;
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class_new; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php toffedassen_product(); ?>
                                                        </div>
                                                    </li>
                                                <?php endwhile; ?>
                                                <?php wp_reset_query(); ?>
                                            </ul>
                                        </div>

                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="onsale">

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
                                                    $count++;

                                                    global $product;
                                                    $attachment_ids  = $product->get_gallery_image_ids();
                                                    $secondary_thumb = intval( toffedassen_get_option( 'disable_secondary_thumb' ) );
                                                    $shop_view       = toffedassen_get_option( 'shop_view' );
                                                    $new_duration = toffedassen_get_option( 'product_newness' );
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class_sale; ?>">
                                                        <div class="product-inner clearfix">
                                                            <div class="un-product-thumbnail">
		                                                        <a href ="'. esc_url( get_the_permalink() ) .'" class="">
                                                                <?php
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
                                                                                //$outofstock = toffedassen_get_option( 'outofstock_text' );
                                                                                //if ( ! $outofstock ) :
                                                                                    $outofstock = esc_html__( 'Out Of Stock', 'toffedassen' );
                                                                                //endif;
                                                                                $output[] = '<span class="out-of-stock ribbon">' . esc_html( $outofstock ) . '</span>';
                                                                            elseif ( $product->is_on_sale() && in_array( 'sale', $badges ) ) :
                                                                                //$sale = toffedassen_get_option( 'sale_text' );
                                                                                //if ( ! $sale ) :
                                                                                    $sale = esc_html__( 'Sale', 'toffedassen' );
                                                                                //endif;

                                                                                $output[] = '<span class="onsale ribbon">' . esc_html( $sale ) . '</span>';

                                                                            elseif ( $product->is_featured() && in_array( 'hot', $badges ) ) :
                                                                                //$hot = toffedassen_get_option( 'hot_text' );
                                                                                //if ( ! $hot ) :
                                                                                    $hot = esc_html__( 'Hot', 'toffedassen' );
                                                                                //endif;
                                                                                $output[] = '<span class="featured ribbon">' . esc_html( $hot ) . '</span>';
                                                                            elseif ( ( time() - ( 60 * 60 * 24 * $new_duration ) ) < strtotime( get_the_time( 'Y-m-d' ) ) && in_array( 'new', $badges ) ||
                                                                                    get_post_meta( $product->get_id(), '_is_new', true ) == 'yes'
                                                                            ) :
                                                                                //$new = toffedassen_get_option( 'new_text' );
                                                                                //if ( ! $new ) :
                                                                                    $new = esc_html__( 'New', 'toffedassen' );
                                                                                //endif;
                                                                                $output[] = '<span class="newness ribbon">' . esc_html( $new ) . '</span>';
                                                                            endif;
                                                                        endif;

                                                                        if ( $output ) :
                                                                            printf( '<span class="ribbons">%s</span>', implode( '', $output ) );
                                                                        endif;

                                                                    endif;
                                                                    ?>
                                                                </a>

                                                                <div class="footer-button">
                                                                    <?php
                                                                        if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) :
                                                                            woocommerce_template_loop_add_to_cart();
                                                                        endif;

                                                                        echo '<div class="actions-button">';

                                                                            if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) :
                                                                                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                                                                            endif;

                                                                            echo '<a href="' . $product->get_permalink() . '" data-id="' . esc_attr( $product->get_id() ) . '"  class="toffedassen-product-quick-view hidden-sm hidden-xs" data-original-title="' . esc_attr__( 'Quick View', 'toffedassen' ) . '" data-rel="tooltip"><i class="icon-frame-expand"></i></a>';

                                                                        echo '</div>';
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <div class="un-product-details">
                                                                <?php
                                                                    printf( '<h3><a href="%s">%s</a></h3>', esc_url( get_the_permalink() ), get_the_title() );
                                                                    ?>
                                                                    <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
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
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endwhile; ?>
                                                <?php wp_reset_query(); ?>
                                            </ul>
                                        </div>

                                    </div>

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
