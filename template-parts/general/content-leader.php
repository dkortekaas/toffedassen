<?php
/**
 * Template part for displaying content leader
 *
 * @package Logiq
 */

?>

    <section class="leader">

        <div class="leader_text">
            <?php
            echo '<h1>' . get_field("leader_title") . '</h1>';

            if (get_field("leader_subtitle")) :
                echo '<h2 class="title-large">' . get_field("leader_subtitle") . '</h2>';
            endif;

            if (get_field("leader_content")) :
                echo get_field("leader_content");
            endif;
            ?>
        </div>

    </section>
