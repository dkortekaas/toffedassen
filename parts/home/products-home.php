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
                                        <li role="presentation"><a href="#mostsold" aria-controls="mostsold" role="tab" data-toggle="tab">
                                            <?php _e('Most Sold', 'toffedassen'); ?>
                                        </a></li>
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
                                                $args_latest = array(
                                                    'post_type' => 'product',
                                                    'stock' => 1,
                                                    'posts_per_page' => 10,
                                                    'category' => 39,
                                                    'orderby' =>'date',
                                                    'order' => 'DESC',
                                                    'suppress_filters' => true
                                                );
                                                $loop_latest = new WP_Query( $args_latest );
                                                $count_latest = 0;
                                                $class_latest = '';
                                                while ( $loop_latest->have_posts() ) : $loop_latest->the_post();
                                                    $total_latest = $loop_latest->found_posts;
                                                    if ( $count_latest == 0 ) :
                                                        $class_latest = ' first';
                                                    elseif ( $count_latest == ($total_latest - 1) ) :
                                                        $class_latest = ' last';
                                                    else :
                                                        $class_latest = '';
                                                    endif; 
                                                    $count_latest++;

                                                    $_product_latest = wc_get_product( get_the_ID() );
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class_latest; ?>">
                                                        <div class="product-inner clearfix">
                                                        <?php toffedassen_product( $_product_latest ); ?>
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
 
                                    <div role="tabpanel" class="tab-pane" id="mostsold">

                                        <div class="woocommerce columns-5">
                                            <ul class="products columns-5">
                                                <?php
                                                $args_mostsold = array(
                                                    'post_type' => 'product',
                                                    'stock' => 1,
                                                    'meta_key' => 'total_sales',
                                                    'orderby' => 'meta_value_num',
                                                    'posts_per_page' => 10,
                                                );
                                                $loop_mostsold = new WP_Query( $args_mostsold );
                                                $count_mostsold = 0;
                                                $class_mostsold = '';
                                                while ( $loop_mostsold->have_posts() ) : $loop_mostsold->the_post();
                                                    $total_mostsold = $loop_mostsold->found_posts;
                                                    if ( $count_mostsold == 0 ) :
                                                        $class_mostsold = ' first';
                                                    elseif ( $count_mostsold == ($total_mostsold - 1) ) :
                                                        $class_mostsold = ' last';
                                                    else :
                                                        $class_mostsold = '';
                                                    endif; 
                                                    $count_mostsold++;

                                                    $_product_mostsold = wc_get_product( get_the_ID() );
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class_mostsold; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php toffedassen_product( $_product_mostsold ); ?>
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
