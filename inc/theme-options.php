<?php
/**
 * CMB Tabbed Theme Options
 *
 * @author    Arushad Ahmed <@dash8x, contact@arushad.org>
 * @link      https://arushad.org/how-to-create-a-tabbed-options-page-for-your-wordpress-theme-using-cmb
 * @version   0.1.0
 */
class my_Admin {

    /**
     * Default Option key
     * @var string
     */
    private $key = 'logiq_options';

    /**
     * Array of metaboxes/fields
     * @var array
     */
    protected $option_metabox = array();

    /**
     * Options Page title
     * @var string
     */
    protected $title = '';

    /**
     * Options Tab Pages
     * @var array
     */
    protected $options_pages = array();

    /**
     * Constructor
     * @since 0.1.0
     */
    public function __construct() {
        // Set our title
        $this->title = __( 'Theme Options', 'logiq' );
    }

    /**
     * Initiate our hooks
     * @since 0.1.0
     */
    public function hooks() {
        add_action( 'admin_init', array( $this, 'init' ) );
        add_action( 'admin_menu', array( $this, 'add_options_page' ) ); //create tab pages
    }

    /**
     * Register our setting tabs to WP
     * @since  0.1.0
     */
    public function init() {

		$option_tabs = self::option_fields();

		foreach ($option_tabs as $index => $option_tab) :

			register_setting( $option_tab['id'], $option_tab['id'] );

		endforeach;

    }

    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_options_page() {

		$option_tabs = self::option_fields();

		foreach ($option_tabs as $index => $option_tab) :

        	if ( $index == 0) :
				$this->options_pages[] = add_menu_page( $this->title, $this->title, 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) ); //Link admin menu to first tab
				add_submenu_page( $option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) ); //Duplicate menu link for first submenu page
			else :
				$this->options_pages[] = add_submenu_page( $option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) );
			endif;

		endforeach;

    }

    /**
     * Admin page markup. Mostly handled by CMB
     * @since  0.1.0
     */
    public function admin_page_display() {

		$option_tabs = self::option_fields(); //get all option tabs
		$tab_forms = array();

        ?>

        <div class="wrap cmb_options_page <?php echo $this->key; ?>">

            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

            <!-- Options Page Nav Tabs -->
            <h2 class="nav-tab-wrapper">

				<?php foreach ($option_tabs as $option_tab) :

					$tab_slug = $option_tab['id'];
					$nav_class = 'nav-tab';

					if ( $tab_slug == $_GET['page'] ) :

            			$nav_class .= ' nav-tab-active'; //add active class to current tab
						$tab_forms[] = $option_tab; //add current tab to forms to be rendered

            		endif;
            	?>
            	<a class="<?php echo $nav_class; ?>" href="<?php menu_page_url( $tab_slug ); ?>"><?php esc_attr_e($option_tab['title']); ?></a>
            	<?php endforeach; ?>
            </h2>
            <!-- End of Nav Tabs -->

            <?php foreach ($tab_forms as $tab_form) : //render all tab forms (normaly just 1 form) ?>
            <div id="<?php esc_attr_e($tab_form['id']); ?>" class="group">
				<?php
				echo create_header( $tab_form );

				echo '<table class="form-table">';
					echo '<tbody>';
						foreach ( $tab_form['fields'] as $field ) :

							echo create_input_field( $field );

						endforeach;
					echo '</tbody>';
				echo '</table>';
				?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    /**
     * Defines the theme option metabox and field configuration
     * @since  0.1.0
     * @return array
     */
    public function option_fields() {

        // Only need to initiate the array once per page-load
        if ( ! empty( $this->option_metabox ) ) :
            return $this->option_metabox;
		endif;

		// General Options
        $this->option_metabox[] = array(
            'id'         => 'general_options', //id used as tab page slug, must be unique
            'title'      => 'General Options',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'general_options' ), ), //value must be same as id
            'show_names' => true,
            'fields'     => array(
				array(
					'name' => __('Header Logo', 'theme_textdomain'),
					'desc' => __('Logo to be displayed in the header menu.', 'theme_textdomain'),
					'id' => 'header_logo', //each field id must be unique
					'default' => '',
					'type' => 'file',
				),		
				array(
					'name' => __('Login Logo', 'theme_textdomain'),
					'desc' => __('Logo to be displayed in the login page. (320x120)', 'theme_textdomain'),
					'id' => 'login_logo',
					'default' => '',
					'type' => 'file',
				),
				array(
					'name' => __('Favicon', 'theme_textdomain'),
					'desc' => __('Site favicon. (32x32)', 'theme_textdomain'),
					'id' => 'favicon',
					'default' => '',
					'type' => 'file',
				),
				array(
					'name' => __( 'SEO', 'theme_textdomain' ),
					'desc' => __( 'Search Engine Optimization Settings.', 'theme_textdomain' ),
					'id'   => 'branding_title', //field id must be unique
					'type' => 'title',
				),
				array(
					'name' => __('Site Keywords', 'theme_textdomain'),
					'desc' => __('Keywords describing this site, comma separated.', 'theme_textdomain'),
					'id' => 'site_keywords',
					'default' => '',				
					'type' => 'textarea_small',
				),
			)
        );		

		// Social Media Settings
        $this->option_metabox[] = array(
            'id'         => 'social_options',
            'title'      => 'Social Media Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'social_options' ), ),
            'show_names' => true,
            'fields'     => array(
				array(
					'name' => __('Facebook Username', 'theme_textdomain'),
					'desc' => __('Username of Facebook page.', 'theme_textdomain'),
					'id' => 'facebook',
					'default' => '',					
					'type' => 'text'
				),
				array(
					'name' => __('Twitter Username', 'theme_textdomain'),
					'desc' => __('Username of Twitter profile.', 'theme_textdomain'),
					'id' => 'twitter',
					'default' => '',					
					'type' => 'text'
				),
				array(
					'name' => __('Youtube Username', 'theme_textdomain'),
					'desc' => __('Username of Youtube channel.', 'theme_textdomain'),
					'id' => 'youtube',
					'default' => '',					
					'type' => 'text'
				),
				array(
					'name' => __('Flickr Username', 'theme_textdomain'),
					'desc' => __('Username of Flickr profile.', 'theme_textdomain'),
					'id' => 'flickr',
					'default' => '',					
					'type' => 'text'
				),
				array(
					'name' => __('Google+ Profile ID', 'theme_textdomain'),
					'desc' => __('ID of Google+ profile.', 'theme_textdomain'),
					'id' => 'google_plus',
					'default' => '',					
					'type' => 'text'
				),
			)
        );

		// Advanced Settings
        $this->option_metabox[] = array(
            'id'         => 'advanced_options',
            'title'      => 'Advanced Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'advanced_options' ), ),
            'show_names' => true,
            'fields'     => array(
            	array(
					'name' => __('Color Scheme', 'theme_textdomain'),
					'desc' => __('Main theme color.', 'theme_textdomain'),
					'id' => 'color_scheme',
					'default' => '',				
					'type' => 'colorpicker',
				),
				array(
					'name' => __('Custom CSS', 'theme_textdomain'),
					'desc' => __('Enter any custom CSS you want here.', 'theme_textdomain'),
					'id' => 'new_custom_css',
					'default' => '',				
					'type' => 'textarea',
				),
			)
        );

        return $this->option_metabox;
    }

    /**
     * Returns the option key for a given field id
     * @since  0.1.0
     * @return array
     */
    public function get_option_key( $field_id ) {

		$option_tabs = $this->option_fields();

		foreach ($option_tabs as $option_tab) : //search all tabs

			foreach ($option_tab['fields'] as $field) : //search all fields

    			if ($field['id'] == $field_id) :

					return $option_tab['id'];

				endif;

			endforeach;

		endforeach;

    	return $this->key; //return default key if field id not found
    }

    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get( $field ) {

        // Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'fields', 'title', 'options_pages' ), true ) ) :
			return $this->{$field};
		endif;

        if ( 'option_metabox' === $field ) :
            return $this->option_fields();
		endif;

		throw new Exception( 'Invalid property: ' . $field );

	}
	
}

// Get it started
$my_Admin = new my_Admin();
$my_Admin->hooks();

/**
 * Wrapper function around cmb_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function my_option( $key = '' ) {

	global $my_Admin;

	return cmb_get_option( $my_Admin->get_option_key($key), $key );

}

function create_header( $field ) {

	// /echo $field['id'] .'<br/>';
	echo '<h3>' . $field['title'] .'</h3>';

}

function create_input_field( $field ) {

	//echo $field['id'] .' - ';
	//echo $field['name'] .' - ';
	//echo $field['desc'] .' - ';
	//echo $field['type'] .'<br/>';
	//if () :

	echo '<tr>';
		echo '<th scope="row">'. $field['name'] .'</th>';

		echo '<td>';
			echo '<input class="textinput" placeholder="" type="'. $field['type'] .'" id="'. $field['id'] .'" name="wpseo['. $field['id'] .']" value="">';
			echo '<p class="description" id="'. $field['id'] .'-description">'. $field['desc'] .'</p>';
		echo '</td>';

	//echo '<label for="'. $field['id'] .'">'. $field['name'] .':</label>';
	echo '</tr>';

}
