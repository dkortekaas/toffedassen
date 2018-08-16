<?php
/**
 * Template part for displaying services
 *
 * @package Logiq
 */

$plan = get_field("plan");
$create = get_field("create");
$support = get_field("support");
if ($plan && $create && $support) :

?>

    <section class="services">

        <div class="services_grid">

            <div class="service">
            
                <div class="service_icon">

                    <a class="service_link" href="<?php echo esc_url( get_permalink(187) ); ?>"><i class="fa <?php echo $plan["plan_class"]; ?>"></i></a>

                </div>
            
                <h3 class="service_title"><a href="<?php echo esc_url( get_permalink(187) ); ?>"><?php echo $plan["plan_title"]; ?></a></h3>

                <div class="service_text">

                    <p><?php echo $plan["plan_content"]; ?></p>

                </div>

            </div>

            <div class="service">

                <div class="service_icon">

                    <a class="service_link" href="<?php echo esc_url( get_permalink(173) ); ?>"><i class="fa <?php echo $create["create_class"]; ?>"></i></a>

                </div>

                <h3 class="service_title"><a href="<?php echo esc_url( get_permalink(173) ); ?>"><?php echo $create["create_title"]; ?></a></h3>

                <div class="service_text">

                    <p><?php echo $create["create_content"]; ?></p>

                </div>

            </div>

            <div class="service">

                <div class="service_icon">

                    <a class="service_link" href="<?php echo esc_url( get_permalink(185) ); ?>"><i class="fa <?php echo $support["support_class"]; ?>"></i></a>

                </div>

                <h3 class="service_title"><a href="<?php echo esc_url( get_permalink(185) ); ?>"><?php echo $support["support_title"]; ?></a></h3>

                <div class="service_text">

                    <p><?php echo $support["support_content"]; ?></p>

                </div>

            </div>

        </div>

    </section>
    <?php endif; ?>
    