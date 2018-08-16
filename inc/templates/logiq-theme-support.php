<h1><?php _e('Theme Support', 'logiq'); ?></h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="logiq-general-form">
	<?php settings_fields( 'logiq-theme-support' ); ?>
	<?php do_settings_sections( 'logiq_theme' ); ?>
	<?php submit_button(); ?>
</form>
