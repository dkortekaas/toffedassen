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
                                        <li role="presentation" class="active"><a href="#onsale" aria-controls="onsale" role="tab" data-toggle="tab">Aanbiedingen</a></li>
                                        <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Nieuwe producten</a></li>
                                        <li role="presentation"><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab">Meest verkocht</a></li>
                                    </ul>
                                </div>

                                <div class="product-wrapper tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="onsale">
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

                                                $_product_onsale = wc_get_product( get_the_ID() );
                                            ?>
                                                <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class_sale; ?>">
                                                    <div class="product-inner clearfix">
                                                        <?php toffedassen_product( $_product_onsale ); ?>
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


                                    <div role="tabpanel" class="tab-pane" id="new">

                                        <div class="woocommerce columns-5">
                                            <ul class="products columns-5">
                                            <?php
                                                $args_new = array(
                                                    'post_type' => 'product',
                                                    'stock' => 1,
                                                    'posts_per_page' => 10,
                                                    'category' => 39,
                                                    'orderby' =>'date',
                                                    'order' => 'DESC'
                                                );
                                                $loop_new = new WP_Query( $args_new );
                                                $count_new = 0;
                                                $class_new = '';
                                                while ( $loop_new->have_posts() ) : $loop_new->the_post();
                                                    $total_new = $loop_new->found_posts;
                                                    if ( $count_new == 0 ) :
                                                        $class_new = ' first';
                                                    elseif ( $count_new == ($total_new - 1) ) :
                                                        $class_new = ' last';
                                                    else :
                                                        $class_new = '';
                                                    endif; 
                                                    $count_new++;

                                                    $_product_new = wc_get_product( get_the_ID() );
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class_sale; ?>">
                                                        <div class="product-inner clearfix">
                                                        <?php toffedassen_product( $_product_new ); ?>
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
 
                                    <div role="tabpanel" class="tab-pane" id="sales">

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
                                                    if ( $count_sales == 0 ) :
                                                        $class_sales = ' first';
                                                    elseif ( $count_sales == ($total_sales - 1) ) :
                                                        $class_sales = ' last';
                                                    else :
                                                        $class_sales = '';
                                                    endif; 
                                                    $count_sales++;

                                                    $_product_sales = wc_get_product( get_the_ID() );
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class_sales; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php toffedassen_product( $_product_sales ); ?>
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
