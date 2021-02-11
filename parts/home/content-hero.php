<?php
/**
 * Template part for displaying content hero
 *
 * @package Toffe Dassen
 */

?>

<style>
@media only screen and (min-width: 1168px) {
.slider-wrapper {height:550px !important;}
}
</style>

    <div class="slider">
        <div class="slider-wrapper">
            <ul>
                <li>
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/valentines-day.jpg'; ?>" alt="Valentijnsdag 2021" title="Vind de tofste stropdassen bij Toffe Dassen!" width="1920" height="960" class="slide">
                    <div class="slider-caption">
                        <?php _e('Deze week 14% korting op het gehele assortiment! Gebruik de code "valentijn"', 'toffedassen'); ?><br/>
                        <a class="btn btn-primary slider-btn" href="/collectie" title="<?php _e('To Collection', 'toffedassen'); ?>"><?php _e('To Collection', 'toffedassen'); ?></a>
                    </div>
                </li>
                <!-- <li>
                    <img src="<?php //echo get_template_directory_uri() . '/assets/images/toffedassen-header.jpg'; ?>" alt="Toffe Dassen - Logo" title="Vind de tofste stropdassen bij Toffe Dassen!" width="1920" height="960" class="slide">
                    <div class="slider-caption">
                        <?php //_e('Buy the coolest ties at Toffe Dassen!', 'toffedassen'); ?><br/>
                        <a class="btn btn-primary slider-btn" href="/collectie" title="<?php //_e('To Collection', 'toffedassen'); ?>"><?php //_e('To Collection', 'toffedassen'); ?></a>
                    </div>
                </li> -->
            </ul>
        </div>
    </div>
