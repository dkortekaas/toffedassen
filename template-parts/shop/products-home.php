<?php
/**
 * Template part for displaying products on front page
 *
 * @package Toffedassen
 */

?>

    <!-- products -->
    <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid supro-no-padding-left supro-no-padding-right vc_custom_1531299284109 supro-row-full-width">
        <div class="container-fluid">
            <div class="row">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="supro-products-grid supro-products style-4 border-bottom  load-more-enabled filter-by-group" data-attr="{&quot;limit&quot;:15,&quot;columns&quot;:5,&quot;orderby&quot;:&quot;title&quot;,&quot;order&quot;:&quot;ASC&quot;}"
                                data-load_more="1" data-nonce="180bd6f8ed">

                                <div class="product-header">
                                    <ul class="nav-filter filter">
                                        <li class="" data-filter="best_selling_products">Meest verkocht</li>
                                        <li class="" data-filter="recent_products">Nieuwe producten</li>
                                        <li class="" data-filter="featured_products">Meest populair</li>
                                    </ul>
                                </div>

                                <div class="product-wrapper">

                                    <!-- Best selling -->
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

                                                global $woocommerce;
                                                $currency = get_woocommerce_currency_symbol();
                                                $price = get_post_meta( get_the_ID(), '_regular_price', true);
                                                $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                                            ?>
                                                <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class; ?>">
                                                    <div class="product-inner clearfix">
                                                        <div class="un-product-thumbnail">
                                                            <a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">
                                                            <?php if (has_post_thumbnail( $loop->post->ID )) 
                                                                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
                                                                else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="'. the_title() .'" width="400px" height="400px" />'; ?>
                                                                <?php if( $sale ) : ?>
                                                                <span class="ribbons">
                                                                    <span class="onsale ribbon"><?php _e('Sale', 'toffedassen'); ?></span>
                                                                </span>
                                                                <?php endif; ?>
                                                                <?php if( $featured ) : ?>
                                                                <span class="ribbons">
                                                                    <span class="featured ribbon"><?php _e('Hot', 'toffedassen'); ?></span>
                                                                </span>
                                                                <?php endif; ?>
                                                            </a>
                                                            <div class="footer-button">
                                                                <a href="#" data-quantity="1" data-title="Floral Short Jumpsuit" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                                        data-product_id="60" data-product_sku="AB123456780" aria-label="Add &ldquo;Floral Short Jumpsuit&rdquo; to your cart" rel="nofollow">
                                                                        Add to cart
                                                                </a>
                                                            </div>

                                                            <div class="un-product-details">
                                                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                                <?php if( $sale ) : ?>
                                                                <span class="price"><del><?php echo $currency; echo $price; ?></del> <?php echo $currency; echo $sale; ?></span>    
                                                                <?php elseif($price) : ?>
                                                                <span class="price"><?php echo $currency; echo $price; ?></span>    
                                                                <?php endif; ?>                                                            

                                                                <div class="woocommerce-product-details__short-description">
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                        elit, sed do eiusmod tempor incididunt ut
                                                                        labore et dolore.</p>
                                                                </div>                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endwhile; ?>
                                            <?php wp_reset_query(); ?>
                                        </ul>
                                    </div>
                                    <!-- #Best selling -->

                                    <!-- New -->
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

                                                global $woocommerce;
                                                $currency = get_woocommerce_currency_symbol();
                                                $price = get_post_meta( get_the_ID(), '_regular_price', true);
                                                $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                                            ?>
                                                <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class; ?>">
                                                    <div class="product-inner clearfix">
                                                        <div class="un-product-thumbnail">
                                                            <a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">
                                                            <?php if (has_post_thumbnail( $loop->post->ID )) 
                                                                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
                                                                else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="'. the_title() .'" width="400px" height="400px" />'; ?>
                                                                <?php if( $sale ) : ?>
                                                                <span class="ribbons">
                                                                    <span class="onsale ribbon"><?php _e('Sale', 'toffedassen'); ?></span>
                                                                </span>
                                                                <?php endif; ?>
                                                                <?php if( $featured ) : ?>
                                                                <span class="ribbons">
                                                                    <span class="featured ribbon"><?php _e('Hot', 'toffedassen'); ?></span>
                                                                </span>
                                                                <?php endif; ?>
                                                            </a>
                                                            <div class="footer-button">
                                                                <a href="#" data-quantity="1" data-title="Floral Short Jumpsuit" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                                        data-product_id="60" data-product_sku="AB123456780" aria-label="Add &ldquo;Floral Short Jumpsuit&rdquo; to your cart" rel="nofollow">
                                                                        Add to cart
                                                                </a>
                                                            </div>

                                                            <div class="un-product-details">
                                                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                                <?php if( $sale ) : ?>
                                                                <span class="price"><del><?php echo $currency; echo $price; ?></del> <?php echo $currency; echo $sale; ?></span>    
                                                                <?php elseif($price) : ?>
                                                                <span class="price"><?php echo $currency; echo $price; ?></span>    
                                                                <?php endif; ?>                                                            

                                                                <div class="woocommerce-product-details__short-description">
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                        elit, sed do eiusmod tempor incididunt ut
                                                                        labore et dolore.</p>
                                                                </div>                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endwhile; ?>
                                            <?php wp_reset_query(); ?>
                                        </ul>
                                    </div>
                                    <!-- #New -->

                                    <!-- Most populair -->
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

                                                global $woocommerce;
                                                $currency = get_woocommerce_currency_symbol();
                                                $price = get_post_meta( get_the_ID(), '_regular_price', true);
                                                $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                                            ?>
                                                <li class="product type-product col-xs-6 col-sm-4 col-md-1-5 un-5-cols<?php echo $class; ?>">
                                                    <div class="product-inner clearfix">
                                                        <div class="un-product-thumbnail">
                                                            <a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">
                                                            <?php if (has_post_thumbnail( $loop->post->ID )) 
                                                                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
                                                                else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="'. the_title() .'" width="400px" height="400px" />'; ?>
                                                                <?php if( $sale ) : ?>
                                                                <span class="ribbons">
                                                                    <span class="onsale ribbon"><?php _e('Sale', 'toffedassen'); ?></span>
                                                                </span>
                                                                <?php endif; ?>
                                                                <?php if( $featured ) : ?>
                                                                <span class="ribbons">
                                                                    <span class="featured ribbon"><?php _e('Hot', 'toffedassen'); ?></span>
                                                                </span>
                                                                <?php endif; ?>
                                                            </a>
                                                            <div class="footer-button">
                                                                <a href="#" data-quantity="1" data-title="Floral Short Jumpsuit" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                                        data-product_id="60" data-product_sku="AB123456780" aria-label="Add &ldquo;Floral Short Jumpsuit&rdquo; to your cart" rel="nofollow">
                                                                        Add to cart
                                                                </a>
                                                            </div>

                                                            <div class="un-product-details">
                                                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                                <?php if( $sale ) : ?>
                                                                <span class="price"><del><?php echo $currency; echo $price; ?></del> <?php echo $currency; echo $sale; ?></span>    
                                                                <?php elseif($price) : ?>
                                                                <span class="price"><?php echo $currency; echo $price; ?></span>    
                                                                <?php endif; ?>                                                            

                                                                <div class="woocommerce-product-details__short-description">
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                        elit, sed do eiusmod tempor incididunt ut
                                                                        labore et dolore.</p>
                                                                </div>                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endwhile; ?>
                                            <?php wp_reset_query(); ?>
                                        </ul>
                                    </div>
                                    <!-- #Most populair -->

                                    <div class="load-more text-center">
                                        <a href="#" class="ajax-load-products">
                                            <span class="button-text">Alle producten</span>
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
    <!-- #products -->

    <div class="vc_row-full-width vc_clearfix"></div>
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="container">
            <div class="row">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="supro-empty-space " style="">
                                <div class="supro_empty_space_lg" style="height: 60px"></div>
                                <div class="supro_empty_space_md" style="height: 60px"></div>
                                <div class="supro_empty_space_xs" style="height: 60px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>