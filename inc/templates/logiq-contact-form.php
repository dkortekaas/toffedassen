<h1>Contact Form</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="logiq-general-form">
	<?php settings_fields( 'logiq-contact-options' ); ?>
	<?php do_settings_sections( 'logiq_theme_contact' ); ?>
	<?php submit_button(); ?>
</form>