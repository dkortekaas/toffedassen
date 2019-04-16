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
                                            $onsale_products = wc_get_products( array(
                                                'meta_key'  => '_price',
                                                'limit'     => 10,
                                                'include'   => wc_get_product_ids_on_sale(),
                                                'category'  => array( 'stropdassen' ),
                                                'orderby'   => array( 'meta_value_num' => 'DESC', 'title' => 'ASC' ), // order from highest to lowest of top sellers
                                            ) );

                                            if (!empty($onsale_products)) :
                                                foreach ($onsale_products as $onsale_product) : ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php //echo $class_latest; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php toffedassen_product( $onsale_product ); ?>
                                                        </div>
                                                    </li>
                                                <?php
                                                endforeach;
                                            endif;
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
                                            $latest_products = wc_get_products( array(
                                                'limit' => 10,
                                                'category' => array( 'stropdassen' ),
                                                'orderby' => 'date',
                                                'order' => 'DESC',
                                            ) );                                            

                                            if (!empty($latest_products)) :
                                                foreach ($latest_products as $latest_product) : ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php //echo $class_latest; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php toffedassen_product( $latest_product ); ?>
                                                        </div>
                                                    </li>
                                                <?php
                                                endforeach;
                                            endif;
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
                                            $mostsold_products = wc_get_products( array(
                                                'limit' => 10,
                                                'meta_key' => 'total_sales', // our custom query meta_key
                                                'category' => array( 'stropdassen' ),
                                                //'return'   => 'ids', // needed to pass to $post_object
                                                'orderby'  => array( 'meta_value_num' => 'DESC', 'title' => 'ASC' ), // order from highest to lowest of top sellers
                                            ) );

                                            if (!empty($mostsold_products)) :
                                                foreach ($mostsold_products as $mostsold_product) : ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php //echo $class_latest; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php toffedassen_product( $mostsold_product ); ?>
                                                        </div>
                                                    </li>
                                                <?php
                                                endforeach;
                                            endif;
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
