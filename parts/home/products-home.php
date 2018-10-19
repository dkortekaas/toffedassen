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
                                        <li role="presentation"><a href="#popular" aria-controls="popular" role="tab" data-toggle="tab">Meest populair</a></li>
                                    </ul>
                                </div>

                                <div class="product-wrapper tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="sales">

                                        <div class="woocommerce columns-5">
                                            <ul class="products columns-5">
                                                <?php
                                                $args = array(
                                                    'post_type' => 'product',
                                                    'stock' => 1,
                                                    'meta_key' => 'total_sales',
                                                    'orderby' => 'meta_value_num',
                                                    'posts_per_page' => 10,
                                                );
                                                $loop = new WP_Query( $args );
                                                $count = 0;
                                                $class = '';
                                                while ( $loop->have_posts() ) : $loop->the_post();
                                                    $total = $loop->found_posts;
                                                    global $product;
                                                    if ( $count == 0 ) :
                                                        $class = ' first';
                                                    elseif ( $count == ($total - 1) ) :
                                                        $class = ' last';
                                                    else :
                                                        $class = '';
                                                    endif; 
                                                    $count++;
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class; ?>">
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
                                                $args = array(
                                                    'post_type' => 'product',
                                                    'stock' => 1,
                                                    'posts_per_page' => 10,
                                                    'orderby' =>'date',
                                                    'order' => 'DESC'
                                                );
                                                $loop = new WP_Query( $args );
                                                $count = 0;
                                                $class = '';
                                                while ( $loop->have_posts() ) : $loop->the_post();
                                                    $total = $loop->found_posts;
                                                    global $product;
                                                    if ( $count == 0 ) :
                                                        $class = ' first';
                                                    elseif ( $count == ($total - 1) ) :
                                                        $class = ' last';
                                                    else :
                                                        $class = '';
                                                    endif; 
                                                    $count++;
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php toffedassen_product(); ?>
                                                        </div>
                                                    </li>
                                                <?php endwhile; ?>
                                                <?php wp_reset_query(); ?>
                                            </ul>
                                        </div>

                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="popular">

                                        <div class="woocommerce columns-5">
                                            <ul class="products columns-5">
                                                <?php
                                                $args = array(
                                                    'post_type' => 'product',
                                                    'stock' => 1,
                                                    'posts_per_page' => 10,
                                                    'orderby' =>'date',
                                                    'order' => 'DESC'
                                                );
                                                $loop = new WP_Query( $args );
                                                $count = 0;
                                                $class = '';
                                                while ( $loop->have_posts() ) : $loop->the_post();
                                                    $total = $loop->found_posts;
                                                    global $product;
                                                    if ( $count == 0 ) :
                                                        $class = ' first';
                                                    elseif ( $count == ($total - 1) ) :
                                                        $class = ' last';
                                                    else :
                                                        $class = '';
                                                    endif; 
                                                    $count++;
                                                ?>
                                                    <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class; ?>">
                                                        <div class="product-inner clearfix">
                                                            <?php toffedassen_product(); ?>
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
