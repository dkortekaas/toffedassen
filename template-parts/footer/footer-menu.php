<?php
/**
 * Template part for displaying footer menu
 *
 * @package Logiq
 */

?>

    <nav class="col-12 col-md" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'logiq' ); ?>">

        <?php wp_nav_menu( array(
            'theme_location' => 'footer-menu',
            'menu_id'        => 'footer-menu',
        ) ); ?>

    </nav>
