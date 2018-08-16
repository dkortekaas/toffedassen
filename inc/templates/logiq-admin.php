<h1><?php _e('Contact Information', 'logiq'); ?></h1>
<style>input[type="text"] {width: 300px; }</style>
<?php settings_errors(); ?>

	<a href="<?php echo admin_url( 'admin.php?page=logiq' ); ?>" class="nav-tab<?php if ( ! isset( $_GET['action'] ) || isset( $_GET['action'] ) && 'social' != $_GET['action'] ) echo ' nav-tab-active'; ?>">
		<?php esc_html_e( 'Contact Information' ); ?>
	</a>
    <a href="<?php echo esc_url( add_query_arg( array( 'action' => 'social' ), admin_url( 'admin.php?page=logiq' ) ) ); ?>" class="nav-tab<?php if ( $social ) echo ' nav-tab-active'; ?>">
		<?php esc_html_e( 'Social Media' ); ?>
	</a>

<form id="submitForm" method="post" action="options.php" class="logiq-general-form">

	<?php
	if ( $social ) :
		echo '<h3>Social</h3>';
		//settings_fields( 'vaajo_social' );
		//do_settings_sections( 'vaajo-setting-social' );
		//submit_button();
	else :
		settings_fields( 'logiq-company-group' );
		do_settings_sections( 'logiq' );
		submit_button( 'Save Changes', 'primary', 'btnSubmit' );
	endif; ?>

</form>