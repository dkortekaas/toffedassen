<h1>Custom CSS</h1>
<?php settings_errors(); ?>

<form id="save-custom-css-form" method="post" action="options.php" class="logiq-general-form">
	<?php settings_fields( 'logiq-custom-css-options' ); ?>
	<?php do_settings_sections( 'logiq_css' ); ?>
	<?php submit_button(); ?>
</form>