<?php
/**
 * Template part for displaying CTA
 *
 * @package Logiq
 */

$cta = get_option("site_settings");
if ($cta) :

?>

    <section class="cta">

        <div class="cta_text">

            <h3><?php echo $cta['cta_title']; ?></h3>

            <p><?php echo $cta['cta_content']; ?></p>

        </div>

        <div class="cta_link">

            <a href="<?php echo $cta['cta_button_link']; ?>" class="btn"><?php echo $cta['cta_button_text']; ?></a>

        </div>

    </section>

<?php
endif;
?>
