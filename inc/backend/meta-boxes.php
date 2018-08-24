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
function supro_meta_box_scripts( $hook ) {
	// Detect to load un-minify scripts when WP_DEBUG is enable
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_script( 'supro-meta-boxes', get_template_directory_uri() . "/js/backend/meta-boxes$min.js", array( 'jquery' ), '20161025', true );
	}
}

add_action( 'admin_enqueue_scripts', 'supro_meta_box_scripts' );

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
function supro_register_meta_boxes( $meta_boxes ) {
	$post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : false;

	// Post format's meta box
	$meta_boxes[] = array(
		'id'       => 'post-format-settings',
		'title'    => esc_html__( 'Format Details', 'supro' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__( 'Image', 'supro' ),
				'id'               => 'image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Gallery', 'supro' ),
				'id'    => 'images',
				'type'  => 'image_advanced',
				'class' => 'gallery',
			),
			array(
				'name'  => esc_html__( 'Video', 'supro' ),
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
		'title'    => esc_html__( 'Header Settings', 'supro' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Custom Header', 'supro' ),
				'id'   => 'custom_header',
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name'  => esc_html__( 'Disable Header Transparent', 'supro' ),
				'id'    => 'disable_header_transparent',
				'type'  => 'checkbox',
				'std'   => false,
				'class' => 'disable-header-transparent',
			),
			array(
				'name'  => esc_html__( 'Disable Header Sticky', 'supro' ),
				'id'    => 'disable_header_sticky',
				'type'  => 'checkbox',
				'std'   => false,
				'class' => 'disable-header-sticky',
			),
			array(
				'name'  => esc_html__( 'Hide Border', 'supro' ),
				'id'    => 'header_border',
				'type'  => 'checkbox',
				'std'   => false,
				'class' => 'header-border',
			),
			array(
				'name'    => esc_html__( 'Header Text Color', 'supro' ),
				'id'      => 'header_text_color',
				'type'    => 'select',
				'std'     => 'dark',
				'options' => array(
					'dark'   => esc_html__( 'Dark', 'supro' ),
					'light'  => esc_html__( 'Light', 'supro' ),
					'custom' => esc_html__( 'Custom', 'supro' ),
				),
				'class'   => 'header-text-color',
			),
			array(
				'name'  => esc_html__( 'Color', 'supro' ),
				'id'    => 'header_color',
				'type'  => 'color',
				'class' => 'header-color',
			),
		),
	);

	// Home Left Sidebar
	$meta_boxes[] = array(
		'id'       => 'home-left-sidebar-settings',
		'title'    => esc_html__( 'Header Left Sidebar Settings', 'supro' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Header Account Text', 'supro' ),
				'id'   => 'header_account_text',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Header Wishlist Text', 'supro' ),
				'id'   => 'header_wishlist_text',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Header Cart Text', 'supro' ),
				'id'   => 'header_cart_text',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Header Copyright', 'supro' ),
				'id'   => 'header_copyright',
				'type' => 'textarea',
			),
			array(
				'type' => 'heading',
				'name' => esc_html__( 'Socials', 'supro' ),
			),
			array(
				'name'  => esc_html__( 'Header Socials', 'supro' ),
				'id'    => 'header_socials',
				'type'  => 'text',
				'clone' => true,
				'desc'  => esc_html__( 'Enter socials URL', 'supro' ),
			),
		),
	);

	// Home Full Slider
	$meta_boxes[] = array(
		'id'       => 'home-full-slider-settings',
		'title'    => esc_html__( 'Newsletter Settings', 'supro' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Hide Newsletter', 'supro' ),
				'id'   => 'hide_newsletter',
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Form Title', 'supro' ),
				'id'   => 'form_title',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Form Subtitle', 'supro' ),
				'id'   => 'form_subtitle',
				'type' => 'textarea',
			),
			array(
				'name' => esc_html__( 'Newsletter Form', 'supro' ),
				'id'   => 'form',
				'type' => 'textarea',
				'desc' => esc_html__( 'Go to MailChimp for WP &gt; Form to get shortcode', 'supro' )
			),
		),
	);

	if ( ! $post_id || ( 'page' == get_option( 'show_on_front' ) && $post_id != get_option( 'page_for_posts' ) ) ) {
		// Page Background Settings
		$meta_boxes[] = array(
			'id'       => 'page-background-settings',
			'title'    => esc_html__( 'Page Background Settings', 'supro' ),
			'pages'    => array( 'page' ),
			'context'  => 'normal',
			'priority' => 'high',
			'autosave' => true,
			'fields'   => array(
				array(
					'name' => esc_html__( 'Background Color', 'supro' ),
					'id'   => 'color',
					'type' => 'color',
				),
				array(
					'name'             => esc_html__( 'Background Image', 'supro' ),
					'id'               => 'image',
					'type'             => 'image_advanced',
					'class'            => 'image',
					'max_file_uploads' => 1,
				),
				array(
					'name'    => esc_html__( 'Background Horizontal', 'supro' ),
					'id'      => 'background_horizontal',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''       => esc_html__( 'None', 'supro' ),
						'left'   => esc_html__( 'Left', 'supro' ),
						'center' => esc_html__( 'Center', 'supro' ),
						'right'  => esc_html__( 'Right', 'supro' ),
					),
				),
				array(
					'name'    => esc_html__( 'Background Vertical', 'supro' ),
					'id'      => 'background_vertical',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''       => esc_html__( 'None', 'supro' ),
						'top'    => esc_html__( 'Top', 'supro' ),
						'center' => esc_html__( 'Center', 'supro' ),
						'bottom' => esc_html__( 'Bottom', 'supro' ),
					),
				),
				array(
					'name'    => esc_html__( 'Background Repeat', 'supro' ),
					'id'      => 'background_repeat',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''          => esc_html__( 'None', 'supro' ),
						'no-repeat' => esc_html__( 'No Repeat', 'supro' ),
						'repeat'    => esc_html__( 'Repeat', 'supro' ),
						'repeat-y'  => esc_html__( 'Repeat Vertical', 'supro' ),
						'repeat-x'  => esc_html__( 'Repeat Horizontal', 'supro' ),
					),
				),
				array(
					'name'    => esc_html__( 'Background Attachment', 'supro' ),
					'id'      => 'background_attachment',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''       => esc_html__( 'None', 'supro' ),
						'scroll' => esc_html__( 'Scroll', 'supro' ),
						'fixed'  => esc_html__( 'Fixed', 'supro' ),
					),
				),
				array(
					'name'    => esc_html__( 'Background Size', 'supro' ),
					'id'      => 'background_size',
					'type'    => 'select',
					'std'     => '',
					'options' => array(
						''        => esc_html__( 'None', 'supro' ),
						'auto'    => esc_html__( 'Auto', 'supro' ),
						'cover'   => esc_html__( 'Cover', 'supro' ),
						'contain' => esc_html__( 'Contain', 'supro' ),
					),
				),
			),
		);

		//Page Header Settings
		$meta_boxes[] = array(
			'id'       => 'page-header-settings',
			'title'    => esc_html__( 'Page Header Settings', 'supro' ),
			'pages'    => array( 'page' ),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'name'  => esc_html__( 'Hide Page Header', 'supro' ),
					'id'    => 'hide_page_header',
					'type'  => 'checkbox',
					'std'   => false,
					'class' => 'hide-page-header',
				),
				array(
					'name'  => esc_html__( 'Hide Breadcrumbs', 'supro' ),
					'id'    => 'hide_breadcrumbs',
					'type'  => 'checkbox',
					'std'   => false,
					'class' => 'hide-breadcrumbs',
				),
				array(
					'name' => esc_html__( 'Custom Layout', 'supro' ),
					'id'   => 'page_header_custom_layout',
					'type' => 'checkbox',
					'std'  => false,
				),
				array(
					'name'    => esc_html__( 'Text Color', 'supro' ),
					'id'      => 'text_color',
					'type'    => 'select',
					'std'     => 'dark',
					'options' => array(
						'dark'  => esc_html__( 'Dark', 'supro' ),
						'light' => esc_html__( 'Light', 'supro' ),
					),
					'class'   => 'page-header-text-color',
				),
				array(
					'name'             => esc_html__( 'Background Image', 'supro' ),
					'id'               => 'page_header_bg',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
					'std'              => false,
					'class'            => 'page-header-bg',
				),
				array(
					'name'  => esc_html__( 'Enable Parallax', 'supro' ),
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
		'title'    => esc_html__( 'Product Video', 'supro' ),
		'pages'    => array( 'product' ),
		'context'  => 'side',
		'priority' => 'low',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Video URL', 'supro' ),
				'id'   => 'video_url',
				'type' => 'oembed',
				'std'  => false,
				'desc' => esc_html__( 'Enter URL of Youtube or Vimeo or specific filetypes such as mp4, m4v, webm, ogv, wmv, flv.', 'supro' ),
			),
			array(
				'name' => esc_html__( 'Video Width(px)', 'supro' ),
				'id'   => 'video_width',
				'type' => 'number',
				'desc' => esc_html__( 'Enter the width of video.', 'supro' ),
				'std'  => 1024
			),
			array(
				'name' => esc_html__( 'Video Height(px)', 'supro' ),
				'id'   => 'video_height',
				'type' => 'number',
				'desc' => esc_html__( 'Enter the height of video.', 'supro' ),
				'std'  => 768
			),
		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'supro_register_meta_boxes' );
