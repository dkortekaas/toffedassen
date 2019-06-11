<?php
/**
 * Template part for displaying content hero
 *
 * @package Toffe Dassen
 */

?>

    <div class="slider">
        <div class="slider-wrapper">
            <ul>
                <li>
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/slide01.jpg'; ?>" alt="Toffe Dassen - Logo" title="<?php _e('Buy the coolest ties at Toffe Dassen!', 'toffedassen'); ?>" width="1920" height="960" class="slide">
                    <div class="slider-caption">
                        <?php _e('Buy the coolest ties at Toffe Dassen!', 'toffedassen'); ?><br/>
                        <a class="btn btn-primary slider-btn" href="/collectie" title="<?php _e('To Collection', 'toffedassen'); ?>"><?php _e('To Collection', 'toffedassen'); ?></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
