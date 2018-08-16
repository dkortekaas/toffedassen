<?php
/**
 * Remove WooCommerce Updater Message.
 *
 * @package Logiq
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit;
endif;

remove_action( 'admin_notices', 'woothemes_updater_notice' );
