<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


/**
 * Enqueue script for handling actions with meta boxes
 *
 * @since 1.0
 *
 * @param string $hook
 */
function toffedassen_meta_box_scripts( $hook ) {
	// Detect to load un-minify scripts when WP_DEBUG is enable
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_script( 'toffedassen-meta-boxes', get_template_directory_uri() . "/js/backend/meta-boxes$min.js", array( 'jquery' ), '20161025', true );
	}
}

add_action( 'admin_enqueue_scripts', 'toffedassen_meta_box_scripts' );

/**
 * Registering meta boxes
 *
 * Using Meta Box plugin: http://www.deluxeblogtips.com/meta-box/
 *
 * @see http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 *
 * @param array $meta_boxes Default meta boxes. By default, there are no meta boxes.
 *
 * @return array All registered meta boxes
 */
function toffedassen_register_meta_boxes( $meta_boxes ) {
	$post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : false;

	// Post format's meta box
	$meta_boxes[] = array(
		'id'       => 'post-format-settings',
		'title'    => esc_html__( 'Format Details', 'toffedassen' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__( 'Image', 'toffedassen' ),
				'id'               => 'image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Gallery', 'toffedassen' ),
				'id'    => 'images',
				'type'  => 'image_advanced',
				'class' => 'gallery',
			),
			array(
				'name'  => esc_html__( 'Video', 'toffedassen' ),
				'id'    => 'video',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'video',
			),
		),
	);

	// Header Setting
	$meta_boxes[] = array(
		'id'       => 'header-settings',
		'title'    => esc_html__( 'Header Settings', 'toffedassen' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Custom Header', 'toffedassen' ),
				'id'   => 'custom_header',
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name'  => esc_html__( 'Disable Header Transparent', 'toffedassen' ),
				'id'    => 'disable_header_transparent',
				'type'  => 'checkbox',
				'std'   => false,
				'class' => 'disable-header-transparent',
			),
			array(
				'name'  => esc_html__( 'Disable Header Sticky', 'toffedassen' ),
				'id'    => 'disable_header_sticky',
				'type'  => 'checkbox',
				'std'   => false,
				'class' => 'disable-header-sticky',
			),
			array(
				'name'  => esc_html__( 'Hide Border', 'toffedassen' ),
				'id'    => 'header_border',
				'type'  => 'checkbox',
				'std'   => false,
				'class' => 'header-border',
			),
			array(
				'name'    => esc_html__( 'Header Text Color', 'toffedassen' ),
				'id'      => 'header_text_color',
				'type'    => 'select',
				'std'     => 'dark',
				'options' => array(
					'dark'   => esc_html__( 'Dark', 'toffedassen' ),
					'light'  => esc_html__( 'Light', 'toffedassen' ),
					'custom' => esc_html__( 'Custom', 'toffedassen' ),
				),
				'class'   => 'header-text-color',
			),
			array(
				'name'  => esc_html__( 'Color', 'toffedassen' ),
				'id'    => 'header_color',
				'type'  => 'color',
				'class' => 'header-color',
			),
		),
	);

	// Home Left Sidebar
	$meta_boxes[] = array(
		'id'       => 'home-left-sidebar-settings',
		'title'    => esc_html__( 'Header Left Sidebar Settings', 'toffedassen' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Header Account Text', 'toffedassen' ),
				'id'   => 'header_account_text',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Header Wishlist Text', 'toffedassen' ),
				'id'   => 'header_wishlist_text',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Header Cart Text', 'toffedassen' ),
				'id'   => 'header_cart_text',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Header Copyright', 'toffedassen' ),
				'id'   => 'header_copyright',
				'type' => 'textarea',
			),
			array(
				'type' => 'heading',
				'name' => esc_html__( 'Socials', 'toffedassen' ),
			),
			array(
				'name'  => esc_html__( 'Header Socials', 'toffedassen' ),
				'id'    => 'header_socials',
				'type'  => 'text',
				'clone' => true,
				'desc'  => esc_html__( 'Enter socials URL', 'toffedassen' ),
			),
		),
	);

	// Home Full Slider
	$meta_boxes[] = array(
		'id'       => 'home-full-slider-settings',
		'title'    => esc_html__( 'Newsletter Settings', 'toffedassen' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Hide Newsletter', 'toffedassen' ),
				'id'   => 'hide_newsletter',
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Form Title', 'toffedassen' ),
				'id'   => 'form_title',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Form Subtitle', 'toffedassen' ),
				'id'   => 'form_subtitle',
				'type' => 'textarea',
			),
			array(
				'name' => esc_html__( 'Newsletter Form', 'toffedassen' ),
				'id'   => 'form',
				'type' => 'textarea',
				'desc' => esc_html__( 'Go to MailChimp for WP &gt; Form to get shortcode', 'toffedassen' )
			),
		),
	);

	if ( ! $post_id || ( 'page' == get_option( 'show_on_front' ) && $post_id != get_option( 'page_for_posts' ) ) ) {
		// Page Background Settings
		$meta_boxes[] = array(
			'id'       => 'page-background-settings',
			'title'    => esc_html__( 'Page Background Settings', 'toffedassen' ),
			'pages'    => array( 'page' ),
			'context'  => 'normal',
			'priority' => 'high',
			'autosave' => true,
			'fields'   => array(
				array(
					'name' => esc_html__( 'Background Color', 'toffedassen' ),
					'id'   => 'color',
					'type' => 'color',
				),
				array(
					'name'             => esc_html__( 'Background Image', 'toffedassen' ),
					'id'               => 'image',
					'type'             => 'image_advanced',
					'class'            => 'image',
					'max_file_uploads' => 1,
				),
				array(
					'name'    => esc_html__( 'Background Horizontal', 'toffedassen' ),
					'id'      => 'background_horizontal',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''       => esc_html__( 'None', 'toffedassen' ),
						'left'   => esc_html__( 'Left', 'toffedassen' ),
						'center' => esc_html__( 'Center', 'toffedassen' ),
						'right'  => esc_html__( 'Right', 'toffedassen' ),
					),
				),
				array(
					'name'    => esc_html__( 'Background Vertical', 'toffedassen' ),
					'id'      => 'background_vertical',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''       => esc_html__( 'None', 'toffedassen' ),
						'top'    => esc_html__( 'Top', 'toffedassen' ),
						'center' => esc_html__( 'Center', 'toffedassen' ),
						'bottom' => esc_html__( 'Bottom', 'toffedassen' ),
					),
				),
				array(
					'name'    => esc_html__( 'Background Repeat', 'toffedassen' ),
					'id'      => 'background_repeat',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''          => esc_html__( 'None', 'toffedassen' ),
						'no-repeat' => esc_html__( 'No Repeat', 'toffedassen' ),
						'repeat'    => esc_html__( 'Repeat', 'toffedassen' ),
						'repeat-y'  => esc_html__( 'Repeat Vertical', 'toffedassen' ),
						'repeat-x'  => esc_html__( 'Repeat Horizontal', 'toffedassen' ),
					),
				),
				array(
					'name'    => esc_html__( 'Background Attachment', 'toffedassen' ),
					'id'      => 'background_attachment',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''       => esc_html__( 'None', 'toffedassen' ),
						'scroll' => esc_html__( 'Scroll', 'toffedassen' ),
						'fixed'  => esc_html__( 'Fixed', 'toffedassen' ),
					),
				),
				array(
					'name'    => esc_html__( 'Background Size', 'toffedassen' ),
					'id'      => 'background_size',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''        => esc_html__( 'None', 'toffedassen' ),
						'auto'    => esc_html__( 'Auto', 'toffedassen' ),
						'cover'   => esc_html__( 'Cover', 'toffedassen' ),
						'contain' => esc_html__( 'Contain', 'toffedassen' ),
					),
				),
			),
		);

		//Page Header Settings
		$meta_boxes[] = array(
			'id'       => 'page-header-settings',
			'title'    => esc_html__( 'Page Header Settings', 'toffedassen' ),
			'pages'    => array( 'page' ),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'name'  => esc_html__( 'Hide Page Header', 'toffedassen' ),
					'id'    => 'hide_page_header',
					'type'  => 'checkbox',
					'std'   => false,
					'class' => 'hide-page-header',
				),
				array(
					'name'  => esc_html__( 'Hide Breadcrumbs', 'toffedassen' ),
					'id'    => 'hide_breadcrumbs',
					'type'  => 'checkbox',
					'std'   => false,
					'class' => 'hide-breadcrumbs',
				),
				array(
					'name' => esc_html__( 'Custom Layout', 'toffedassen' ),
					'id'   => 'page_header_custom_layout',
					'type' => 'checkbox',
					'std'  => false,
				),
				array(
					'name'    => esc_html__( 'Text Color', 'toffedassen' ),
					'id'      => 'text_color',
					'type'    => 'select',
					'std'     => 'dark',
					'options' => array(
						'dark'  => esc_html__( 'Dark', 'toffedassen' ),
						'light' => esc_html__( 'Light', 'toffedassen' ),
					),
					'class'   => 'page-header-text-color',
				),
				array(
					'name'             => esc_html__( 'Background Image', 'toffedassen' ),
					'id'               => 'page_header_bg',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
					'std'              => false,
					'class'            => 'page-header-bg',
				),
				array(
					'name'  => esc_html__( 'Enable Parallax', 'toffedassen' ),
					'id'    => 'parallax',
					'type'  => 'checkbox',
					'std'   => false,
					'class' => 'page-header-parallax',
				),
			),
		);
	}

	// Product Videos
	$meta_boxes[] = array(
		'id'       => 'product-videos',
		'title'    => esc_html__( 'Product Video', 'toffedassen' ),
		'pages'    => array( 'product' ),
		'context'  => 'side',
		'priority' => 'low',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Video URL', 'toffedassen' ),
				'id'   => 'video_url',
				'type' => 'oembed',
				'std'  => false,
				'desc' => esc_html__( 'Enter URL of Youtube or Vimeo or specific filetypes such as mp4, m4v, webm, ogv, wmv, flv.', 'toffedassen' ),
			),
			array(
				'name' => esc_html__( 'Video Width(px)', 'toffedassen' ),
				'id'   => 'video_width',
				'type' => 'number',
				'desc' => esc_html__( 'Enter the width of video.', 'toffedassen' ),
				'std'  => 1024
			),
			array(
				'name' => esc_html__( 'Video Height(px)', 'toffedassen' ),
				'id'   => 'video_height',
				'type' => 'number',
				'desc' => esc_html__( 'Enter the height of video.', 'toffedassen' ),
				'std'  => 768
			),
		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'toffedassen_register_meta_boxes' );
