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
                            <div class="supro-products-grid supro-products style-4 border-bottom">

                                <div class="product-header">
                                    <ul class="nav nav-tabs nav-filter filter" role="tablist">
                                        <li role="presentation"><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab">Meest verkocht</a></li>
                                        <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Nieuwe producten</a></li>
                                        <li role="presentation"><a href="#popular" aria-controls="popular" role="tab" data-toggle="tab">Meest populair</a></li>
                                    </ul>
                                </div>

                                <div class="product-wrapper tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="sales">

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
<?php
		global $product;
		$attachment_ids  = $product->get_gallery_image_ids();
		$secondary_thumb = intval( toffedassen_get_option( 'disable_secondary_thumb' ) );
        $shop_view       = toffedassen_get_option( 'shop_view' );
        $new_duration = toffedassen_get_option( 'product_newness' );

		printf( '<div class="un-product-thumbnail">' );

		printf( '<a href ="%s" class="">', esc_url( get_the_permalink() ) );

		if ( function_exists( 'woocommerce_get_product_thumbnail' ) ) {
			echo woocommerce_get_product_thumbnail();
		}

		if ( ! $secondary_thumb && $attachment_ids ) {
			echo wp_get_attachment_image( $attachment_ids[0], 'shop_catalog', '', array( 'class' => 'image-hover' ) );
		}

		if ( intval( toffedassen_get_option( 'show_badges' ) ) ) {
			$output = array();
			$badges = toffedassen_get_option( 'badges' );
			// Change the default sale ribbon

			$custom_badges = maybe_unserialize( get_post_meta( $product->get_id(), 'custom_badges_text', true ) );
			if ( $custom_badges ) {
				$output[] = '<span class="custom ribbon">' . esc_html( $custom_badges ) . '</span>';

			} else {

				if ( $product->get_stock_status() == 'outofstock' && in_array( 'outofstock', $badges ) ) {
					$outofstock = toffedassen_get_option( 'outofstock_text' );
					if ( ! $outofstock ) {
						$outofstock = esc_html__( 'Out Of Stock', 'toffedassen' );
					}
					$output[] = '<span class="out-of-stock ribbon">' . esc_html( $outofstock ) . '</span>';
				} elseif ( $product->is_on_sale() && in_array( 'sale', $badges ) ) {
					$sale = toffedassen_get_option( 'sale_text' );
					if ( ! $sale ) {
						$sale = esc_html__( 'Sale', 'toffedassen' );
					}

					$output[] = '<span class="onsale ribbon">' . esc_html( $sale ) . '</span>';

				} elseif ( $product->is_featured() && in_array( 'hot', $badges ) ) {
					$hot = toffedassen_get_option( 'hot_text' );
					if ( ! $hot ) {
						$hot = esc_html__( 'Hot', 'toffedassen' );
					}
					$output[] = '<span class="featured ribbon">' . esc_html( $hot ) . '</span>';
				} elseif ( ( time() - ( 60 * 60 * 24 * $new_duration ) ) < strtotime( get_the_time( 'Y-m-d' ) ) && in_array( 'new', $badges ) ||
				           get_post_meta( $product->get_id(), '_is_new', true ) == 'yes'
				) {
					$new = toffedassen_get_option( 'new_text' );
					if ( ! $new ) {
						$new = esc_html__( 'New', 'toffedassen' );
					}
					$output[] = '<span class="newness ribbon">' . esc_html( $new ) . '</span>';
				}
			}


			if ( $output ) {
				printf( '<span class="ribbons">%s</span>', implode( '', $output ) );
			}


		}

		echo '</a>';

		echo '<div class="footer-button">';

		if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {
			woocommerce_template_loop_add_to_cart();
		}

		echo '<div class="actions-button">';

		if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}

		echo '<a href="' . $product->get_permalink() . '" data-id="' . esc_attr( $product->get_id() ) . '"  class="toffedassen-product-quick-view hidden-sm hidden-xs" data-original-title="' . esc_attr__( 'Quick View', 'toffedassen' ) . '" data-rel="tooltip"><i class="icon-frame-expand"></i></a>';

		echo '</div>'; // .actions-button
		echo '</div>'; // .footer-button
        echo '</div>'; // .un-product-thumbnail
        ?>

                                                        <!-- <div class="product-inner clearfix">
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
                                                        </div> -->
                                                    </li>
                                                <?php endwhile; ?>
                                                <?php wp_reset_query(); ?>
                                            </ul>
                                        </div>
                                        <!-- #Best selling -->

                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="new">
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
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="popular">
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
                                    </div>

                                    <div class="load-more text-center">
                                        <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="ajax-load-products">
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