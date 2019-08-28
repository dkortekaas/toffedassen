<?php
/**
 * Toffe Dassen theme customizer
 *
 * @package Toffe Dassen
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Toffe_Dassen_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {
		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {

		$default = $this->get_option_default( $name );

		return get_theme_mod( $name, $default );
	}

	/**
	 * Get default option values
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default( $name ) {
		if ( ! isset( $this->config['fields'][$name] ) ) {
			return false;
		}

		return isset( $this->config['fields'][$name]['default'] ) ? $this->config['fields'][$name]['default'] : false;
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function toffedassen_get_option( $name ) {
	global $toffedassen_customize;

	if ( empty( $toffedassen_customize ) ) {
		return false;
	}

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( $toffedassen_customize->get_theme(), $name );
	} else {
		$value = $toffedassen_customize->get_option( $name );
	}

	return apply_filters( 'toffedassen_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function toffedassen_get_option_default( $name ) {
	global $toffedassen_customize;

	if ( empty( $toffedassen_customize ) ) {
		return false;
	}

	return $toffedassen_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function toffedassen_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'toffedassen_customize_modify' );


/**
 * Get product attributes
 *
 * @return string
 */
function toffedassen_product_attributes() {
	$output = array();
	if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
		$attributes_tax = wc_get_attribute_taxonomies();
		if ( $attributes_tax ) {
			$output['none'] = esc_html__( 'None', 'toffedassen' );

			foreach ( $attributes_tax as $attribute ) {
				$output[$attribute->attribute_name] = $attribute->attribute_label;
			}

		}
	}

	return $output;
}

function toffedassen_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'toffedassen',
	);

	$panels = array(
		'general'    => array(
			'priority' => 5,
			'title'    => esc_html__( 'General', 'toffedassen' ),
		),
		'typography' => array(
			'priority' => 10,
			'title'    => esc_html__( 'Typography', 'toffedassen' ),
		),
		// Styling
		'styling'    => array(
			'title'    => esc_html__( 'Styling', 'toffedassen' ),
			'priority' => 10,
		),
		'header'     => array(
			'priority' => 10,
			'title'    => esc_html__( 'Header', 'toffedassen' ),
		),
		'page'       => array(
			'title'      => esc_html__( 'Page', 'toffedassen' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
		'blog'       => array(
			'title'      => esc_html__( 'Blog', 'toffedassen' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
		'portfolio'  => array(
			'title'      => esc_html__( 'Portfolio', 'toffedassen' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
		'footer'     => array(
			'title'    => esc_html__( 'Footer', 'toffedassen' ),
			'priority' => 50,
		),
		'mobile'     => array(
			'title'      => esc_html__( 'Mobile', 'toffedassen' ),
			'priority'   => 50,
			'capability' => 'edit_theme_options',
		),
	);

	$sections = array(
		'maintenance'            => array(
			'title'      => esc_html__( 'Maintenance', 'toffedassen' ),
			'priority'   => 5,
			'capability' => 'edit_theme_options',
		),

		'body_typo'              => array(
			'title'       => esc_html__( 'Body', 'toffedassen' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'typography',
		),
		'heading_typo'           => array(
			'title'       => esc_html__( 'Heading', 'toffedassen' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'typography',
		),
		'header_typo'            => array(
			'title'       => esc_html__( 'Header', 'toffedassen' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'typography',
		),
		'footer_typo'            => array(
			'title'       => esc_html__( 'Footer', 'toffedassen' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'typography',
		),
		'topbar'                 => array(
			'title'       => esc_html__( 'Topbar', 'toffedassen' ),
			'description' => '',
			'priority'    => 5,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
		'header'                 => array(
			'title'       => esc_html__( 'Header', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
		'logo'                   => array(
			'title'       => esc_html__( 'Logo', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
		'backtotop'              => array(
			'title'       => esc_html__( 'Back to Top', 'toffedassen' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'styling',
		),
		'preloader'              => array(
			'title'       => esc_html__( 'Preloader', 'toffedassen' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'styling',
		),
		'color_scheme'           => array(
			'title'       => esc_html__( 'Color Scheme', 'toffedassen' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'styling',
		),
		'boxed_layout'           => array(
			'title'       => esc_html__( 'Boxed Layout', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'styling',
		),
		'page_header'            => array(
			'title'       => esc_html__( 'Page Header', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'page',
		),
		'blog_page_header'       => array(
			'title'       => esc_html__( 'Blog Page Header', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'blog_page'              => array(
			'title'       => esc_html__( 'Blog Page', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'single_post'            => array(
			'title'       => esc_html__( 'Single Post', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'shop'                   => array(
			'title'       => esc_html__( 'Shop', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'panel'       => 'woocommerce',
			'capability'  => 'edit_theme_options',
		),
		'my_account'             => array(
			'title'       => esc_html__( 'My Account', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'panel'       => 'woocommerce',
			'capability'  => 'edit_theme_options',
			'panel'       => 'woocommerce',
		),
		'shop_badge'             => array(
			'title'       => esc_html__( 'Badges', 'toffedassen' ),
			'description' => '',
			'priority'    => 40,
			'panel'       => 'woocommerce',
			'capability'  => 'edit_theme_options',
		),
		'catalog_page_header'    => array(
			'title'       => esc_html__( 'Catalog Page Header', 'toffedassen' ),
			'description' => '',
			'priority'    => 40,
			'panel'       => 'woocommerce',
			'capability'  => 'edit_theme_options',
		),
		'single_product'         => array(
			'title'       => esc_html__( 'Single Product', 'toffedassen' ),
			'description' => '',
			'priority'    => 90,
			'panel'       => 'woocommerce',
			'capability'  => 'edit_theme_options',
		),
		'portfolio_page_header'  => array(
			'title'       => esc_html__( 'Portfolio Page Header', 'toffedassen' ),
			'description' => '',
			'priority'    => 90,
			'panel'       => 'portfolio',
			'capability'  => 'edit_theme_options',
		),
		'portfolio'              => array(
			'title'       => esc_html__( 'Portfolio', 'toffedassen' ),
			'description' => '',
			'priority'    => 90,
			'panel'       => 'portfolio',
			'capability'  => 'edit_theme_options',
		),
		'single_portfolio'       => array(
			'title'       => esc_html__( 'Single Portfolio', 'toffedassen' ),
			'description' => '',
			'priority'    => 90,
			'panel'       => 'portfolio',
			'capability'  => 'edit_theme_options',
		),
		'footer_newsletter'      => array(
			'title'       => esc_html__( 'Footer Newsletter', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'footer',
		),
		'footer_layout'          => array(
			'title'       => esc_html__( 'Footer Layout', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'footer',
		),
		'footer_widgets'         => array(
			'title'       => esc_html__( 'Footer Widgets', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'footer',
		),
		'footer_copyright'       => array(
			'title'       => esc_html__( 'Footer Copyright', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'footer',
		),
		'footer_recently_viewed' => array(
			'title'       => esc_html__( 'Footer Recently Viewed', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'footer',
		),
		'menu_mobile'            => array(
			'title'       => esc_html__( 'Menu Sidebar', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'mobile',
		),
		'catalog_mobile'         => array(
			'title'       => esc_html__( 'Catalog Mobile', 'toffedassen' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'mobile',
		),
	);

	$fields = array(
		// Maintenance
		'maintenance_enable'                   => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Enable Maintenance Mode', 'toffedassen' ),
			'description' => esc_html__( 'Put your site into maintenance mode', 'toffedassen' ),
			'default'     => false,
			'section'     => 'maintenance',
		),
		'maintenance_mode'                     => array(
			'type'        => 'radio',
			'label'       => esc_html__( 'Mode', 'toffedassen' ),
			'description' => esc_html__( 'Select the correct mode for your site', 'toffedassen' ),
			'tooltip'     => wp_kses_post( sprintf( __( 'If you are putting your site into maintenance mode for a longer perior of time, you should set this to "Coming Soon". Maintenance will return HTTP 503, Comming Soon will set HTTP to 200. <a href="%s" target="_blank">Learn more</a>', 'toffedassen' ), 'https://yoast.com/http-503-site-maintenance-seo/' ) ),
			'default'     => 'maintenance',
			'section'     => 'maintenance',
			'choices'     => array(
				'maintenance' => esc_attr__( 'Maintenance', 'toffedassen' ),
				'coming_soon' => esc_attr__( 'Coming Soon', 'toffedassen' ),
			),
		),
		'maintenance_page'                     => array(
			'type'    => 'dropdown-pages',
			'label'   => esc_html__( 'Maintenance Page', 'toffedassen' ),
			'default' => 0,
			'section' => 'maintenance',
		),
		'maintenance_textcolor'                => array(
			'type'    => 'radio',
			'label'   => esc_html__( 'Text Color', 'toffedassen' ),
			'default' => 'dark',
			'section' => 'maintenance',
			'choices' => array(
				'dark'  => esc_attr__( 'Dark', 'toffedassen' ),
				'light' => esc_attr__( 'Light', 'toffedassen' ),
			),
		),
		// Typography
		'body_typo'                            => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Body', 'toffedassen' ),
			'section'  => 'body_typo',
			'priority' => 10,
			'default'  => array(
				'font-family'    => 'Cerebri Sans',
				'variant'        => 'regular',
				'font-size'      => '16px',
				'line-height'    => '1.6',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin-ext' ),
				'color'          => '#777777',
				'text-transform' => 'none',
			),
		),
		'heading1_typo'                        => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 1', 'toffedassen' ),
			'section'  => 'heading_typo',
			'priority' => 10,
			'default'  => array(
				'font-family'    => 'Cerebri Sans',
				'variant'        => '700',
				'font-size'      => '36px',
				'line-height'    => '1.2',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin-ext' ),
				'color'          => '#222222',
				'text-transform' => 'none',
			),
		),
		'heading2_typo'                        => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 2', 'toffedassen' ),
			'section'  => 'heading_typo',
			'priority' => 10,
			'default'  => array(
				'font-family'    => 'Cerebri Sans',
				'variant'        => '700',
				'font-size'      => '30px',
				'line-height'    => '1.2',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin-ext' ),
				'color'          => '#222222',
				'text-transform' => 'none',
			),
		),
		'heading3_typo'                        => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 3', 'toffedassen' ),
			'section'  => 'heading_typo',
			'priority' => 10,
			'default'  => array(
				'font-family'    => 'Cerebri Sans',
				'variant'        => '700',
				'font-size'      => '24px',
				'line-height'    => '1.2',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin-ext' ),
				'color'          => '#222222',
				'text-transform' => 'none',
			),
		),
		'heading4_typo'                        => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 4', 'toffedassen' ),
			'section'  => 'heading_typo',
			'priority' => 10,
			'default'  => array(
				'font-family'    => 'Cerebri Sans',
				'variant'        => '700',
				'font-size'      => '18px',
				'line-height'    => '1.2',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin-ext' ),
				'color'          => '#222222',
				'text-transform' => 'none',
			),
		),
		'heading5_typo'                        => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 5', 'toffedassen' ),
			'section'  => 'heading_typo',
			'priority' => 10,
			'default'  => array(
				'font-family'    => 'Cerebri Sans',
				'variant'        => '700',
				'font-size'      => '16px',
				'line-height'    => '1.2',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin-ext' ),
				'color'          => '#222222',
				'text-transform' => 'none',
			),
		),
		'heading6_typo'                        => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 6', 'toffedassen' ),
			'section'  => 'heading_typo',
			'priority' => 10,
			'default'  => array(
				'font-family'    => 'Cerebri Sans',
				'variant'        => '700',
				'font-size'      => '12px',
				'line-height'    => '1.2',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin-ext' ),
				'color'          => '#222222',
				'text-transform' => 'none',
			),
		),
		'menu_typo'                            => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Menu', 'toffedassen' ),
			'section'  => 'header_typo',
			'priority' => 10,
			'default'  => array(
				'font-family'    => 'Cerebri Sans',
				'variant'        => 'regular',
				'subsets'        => array( 'latin-ext' ),
				'font-size'      => '16px',
				'color'          => '#222222',
				'text-transform' => 'none',
			),
		),
		'sub_menu_typo'                        => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Sub Menu', 'toffedassen' ),
			'section'  => 'header_typo',
			'priority' => 10,
			'default'  => array(
				'font-family'    => 'Cerebri Sans',
				'variant'        => 'regular',
				'subsets'        => array( 'latin-ext' ),
				'font-size'      => '15px',
				'color'          => '#999999',
				'text-transform' => 'none',
			),
		),
		'footer_text_typo'                     => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Footer Text', 'toffedassen' ),
			'section'  => 'footer_typo',
			'priority' => 10,
			'default'  => array(
				'font-family' => 'Cerebri Sans',
				'variant'     => 'regular',
				'subsets'     => array( 'latin-ext' ),
				'font-size'   => '15px',
			),
		),

		// Topbar
		'topbar_enable'                        => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show topbar', 'toffedassen' ),
			'section'  => 'topbar',
			'default'  => 1,
			'priority' => 10,
		),
		'topbar_layout'                        => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Topbar Layout', 'toffedassen' ),
			'section'  => 'topbar',
			'default'  => '1',
			'priority' => 10,
			'choices'  => array(
				'1' => esc_html__( 'Layout 1', 'toffedassen' ),
				'2' => esc_html__( 'Layout 2', 'toffedassen' ),
			),
		),
		'topbar_border_bottom'                 => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show border bottom', 'toffedassen' ),
			'section'  => 'topbar',
			'default'  => 0,
			'priority' => 10,
		),
		'topbar_background_color'              => array(
			'type'     => 'color',
			'label'    => esc_html__( 'Background Color', 'toffedassen' ),
			'default'  => '',
			'section'  => 'topbar',
			'priority' => 10,
		),
		'topbar_color'                         => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Color', 'toffedassen' ),
			'section'  => 'topbar',
			'default'  => 'default',
			'priority' => 10,
			'choices'  => array(
				'default' => esc_html__( 'Default', 'toffedassen' ),
				'custom'  => esc_html__( 'Custom', 'toffedassen' ),
			),
		),
		'topbar_custom_color'                  => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Custom Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'topbar',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'topbar_color',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
		'topbar_custom_field_1'                => array(
			'type'    => 'custom',
			'section' => 'topbar',
			'default' => '<hr/>',
		),

		'topbar_mobile_content'                => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Topbar Mobile justify content', 'toffedassen' ),
			'section'  => 'topbar',
			'default'  => 'flex-start',
			'priority' => 10,
			'choices'  => array(
				'flex-start'    => esc_html__( 'Flex Start', 'toffedassen' ),
				'flex-end'      => esc_html__( 'Flex End', 'toffedassen' ),
				'center'        => esc_html__( 'Center', 'toffedassen' ),
				'space-between' => esc_html__( 'Space Between', 'toffedassen' ),
			),
		),

		// Header layout
		'header_layout'                        => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Header Layout', 'toffedassen' ),
			'section'  => 'header',
			'default'  => '1',
			'priority' => 10,
			'choices'  => array(
				'1' => esc_html__( 'Layout 1', 'toffedassen' ),
				'2' => esc_html__( 'Layout 2', 'toffedassen' ),
				'3' => esc_html__( 'Layout 3', 'toffedassen' ),
				'4' => esc_html__( 'Layout 4', 'toffedassen' ),
				'5' => esc_html__( 'Layout 5', 'toffedassen' ),
				'6' => esc_html__( 'Layout 6', 'toffedassen' ),
			),
		),

		'header_sticky'                        => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Header Sticky', 'toffedassen' ),
			'default'  => 1,
			'section'  => 'header',
			'priority' => 10,
		),

		'header_transparent'                   => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Header Transparent', 'toffedassen' ),
			'default'     => 1,
			'section'     => 'header',
			'priority'    => 10,
			'description' => esc_html__( 'Check this to enable header transparent in homepage only.', 'toffedassen' ),
		),

		'header_text_color'                    => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Header Text Color', 'toffedassen' ),
			'description'     => esc_html__( 'This option apply for homepage only', 'toffedassen' ),
			'section'         => 'header',
			'default'         => 'dark',
			'choices'         => array(
				'dark'   => esc_html__( 'Dark', 'toffedassen' ),
				'light'  => esc_html__( 'Light', 'toffedassen' ),
				'custom' => esc_html__( 'Custom', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'header_transparent',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'header_text_custom_color'             => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'header',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'header_text_color',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
		'menu_extras'                          => array(
			'type'     => 'multicheck',
			'label'    => esc_html__( 'Menu Extras', 'toffedassen' ),
			'section'  => 'header',
			'default'  => array( 'search', 'account', 'wishlist', 'cart' ),
			'priority' => 10,
			'choices'  => array(
				'search'   => esc_html__( 'Search', 'toffedassen' ),
				'account'  => esc_html__( 'Account', 'toffedassen' ),
				'wishlist' => esc_html__( 'Wishlist', 'toffedassen' ),
				'cart'     => esc_html__( 'Cart', 'toffedassen' ),
				'sidebar'  => esc_html__( 'Sidebar', 'toffedassen' ),
			),
		),
		'header_menu_text'                     => array(
			'type'     => 'text',
			'label'    => esc_html__( 'Menu Text', 'toffedassen' ),
			'section'  => 'header',
			'default'  => '',
			'priority' => 10,
		),
		'header_socials'                       => array(
			'type'            => 'repeater',
			'label'           => esc_html__( 'Socials', 'toffedassen' ),
			'section'         => 'header',
			'priority'        => 10,
			'row_label'       => array(
				'type'  => 'text',
				'value' => esc_attr__( 'Social', 'toffedassen' ),
			),
			'fields'          => array(
				'link_url' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Social URL', 'toffedassen' ),
					'description' => esc_html__( 'Enter the URL for this social', 'toffedassen' ),
					'default'     => '',
				),
			),
			'active_callback' => array(
				array(
					'setting'  => 'header_layout',
					'operator' => 'in',
					'value'    => array( '4' ),
				),
			),
		),
		'header_custom_field_1'                => array(
			'type'    => 'custom',
			'section' => 'header',
			'default' => '<hr/>',
		),
		'menu_animation'                       => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Menu Hover Animation', 'toffedassen' ),
			'section'  => 'header',
			'default'  => 'fade',
			'priority' => 30,
			'choices'  => array(
				'none'  => esc_html__( 'No Animation', 'toffedassen' ),
				'fade'  => esc_html__( 'Fade', 'toffedassen' ),
				'slide' => esc_html__( 'Slide', 'toffedassen' ),
			),
		),
		'menu_hover_color'                     => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Menu Hover Color', 'toffedassen' ),
			'section'  => 'header',
			'default'  => 'none',
			'priority' => 30,
			'choices'  => array(
				'none'          => esc_html__( 'None', 'toffedassen' ),
				'primary-color' => esc_html__( 'Primary Color', 'toffedassen' ),
				'custom-color'  => esc_html__( 'Custom', 'toffedassen' ),
			),
		),
		'menu_hover_custom_color'              => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'header',
			'priority'        => 30,
			'active_callback' => array(
				array(
					'setting'  => 'menu_hover_color',
					'operator' => '==',
					'value'    => 'custom-color',
				),
			),
		),
		'header_ajax_search'                   => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'AJAX Search', 'toffedassen' ),
			'section'     => 'header',
			'default'     => 1,
			'priority'    => 90,
			'description' => esc_html__( 'Check this option to enable AJAX search in the header', 'toffedassen' ),
		),
		'search_content_type'                  => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Search Content Type', 'toffedassen' ),
			'section'  => 'header',
			'default'  => 'all',
			'priority' => 90,
			'choices'  => array(
				'all'      => esc_html__( 'All', 'toffedassen' ),
				'products' => esc_html__( 'Only products', 'toffedassen' ),
			),
		),
		// Logo
		'logo'                                 => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Logo', 'toffedassen' ),
			'section'  => 'logo',
			'default'  => '',
			'priority' => 10,
		),
		'logo_light'                           => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Logo Light', 'toffedassen' ),
			'section'  => 'logo',
			'default'  => '',
			'priority' => 10,
		),
		'logo_width'                           => array(
			'type'     => 'number',
			'label'    => esc_html__( 'Logo Width', 'toffedassen' ),
			'section'  => 'logo',
			'default'  => '',
			'priority' => 10,
		),
		'logo_height'                          => array(
			'type'     => 'number',
			'label'    => esc_html__( 'Logo Height', 'toffedassen' ),
			'section'  => 'logo',
			'default'  => '',
			'priority' => 10,
		),
		'logo_position'                        => array(
			'type'     => 'spacing',
			'label'    => esc_html__( 'Logo Margin', 'toffedassen' ),
			'section'  => 'logo',
			'priority' => 10,
			'default'  => array(
				'top'    => '0',
				'bottom' => '0',
				'left'   => '0',
				'right'  => '0',
			),
		),

		// Styling
		'back_to_top'                          => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Back to Top', 'toffedassen' ),
			'section'  => 'backtotop',
			'default'  => 1,
			'priority' => 10,
		),
		'preloader'                            => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Preloader', 'toffedassen' ),
			'section'  => 'preloader',
			'default'  => 0,
			'priority' => 10,
		),
		// Color Scheme
		'color_scheme'                         => array(
			'type'     => 'palette',
			'label'    => esc_html__( 'Base Color Scheme', 'toffedassen' ),
			'default'  => '',
			'section'  => 'color_scheme',
			'priority' => 10,
			'choices'  => array(
				''        => array( '#f68872' ),
				'#7cafca' => array( '#7cafca' ),
			),
		),
		'custom_color_scheme'                  => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Custom Color Scheme', 'toffedassen' ),
			'default'  => 0,
			'section'  => 'color_scheme',
			'priority' => 10,
		),
		'custom_color'                         => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'color_scheme',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'custom_color_scheme',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		// Page
		'boxed_layout'                         => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Boxed Layout', 'toffedassen' ),
			'description' => esc_html__( 'It just apply for home page', 'toffedassen' ),
			'section'     => 'boxed_layout',
			'default'     => 0,
			'priority'    => 10,
		),
		'boxed_background_color'               => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Background Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'page_layout',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'page_boxed_layout',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'boxed_background_image'               => array(
			'type'            => 'image',
			'label'           => esc_html__( 'Background Image', 'toffedassen' ),
			'default'         => '',
			'section'         => 'boxed_layout',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'page_boxed_layout',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'boxed_background_horizontal'          => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Background Horizontal', 'toffedassen' ),
			'section'         => 'boxed_layout',
			'default'         => '',
			'priority'        => 10,
			'choices'         => array(
				''       => esc_html__( 'None', 'toffedassen' ),
				'left'   => esc_html__( 'Left', 'toffedassen' ),
				'center' => esc_html__( 'Center', 'toffedassen' ),
				'right'  => esc_html__( 'Right', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'page_boxed_layout',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'boxed_background_vertical'            => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Background Vertical', 'toffedassen' ),
			'section'         => 'boxed_layout',
			'default'         => '',
			'priority'        => 10,
			'choices'         => array(
				''       => esc_html__( 'None', 'toffedassen' ),
				'top'    => esc_html__( 'Top', 'toffedassen' ),
				'center' => esc_html__( 'Center', 'toffedassen' ),
				'bottom' => esc_html__( 'Bottom', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'page_boxed_layout',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'boxed_background_repeat'              => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Background Repeat', 'toffedassen' ),
			'section'         => 'boxed_layout',
			'default'         => '',
			'priority'        => 10,
			'choices'         => array(
				''          => esc_html__( 'None', 'toffedassen' ),
				'no-repeat' => esc_html__( 'No Repeat', 'toffedassen' ),
				'repeat'    => esc_html__( 'Repeat', 'toffedassen' ),
				'repeat-y'  => esc_html__( 'Repeat Vertical', 'toffedassen' ),
				'repeat-x'  => esc_html__( 'Repeat Horizontal', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'page_boxed_layout',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'boxed_background_attachment'          => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Background Attachment', 'toffedassen' ),
			'section'         => 'boxed_layout',
			'default'         => '',
			'priority'        => 10,
			'choices'         => array(
				''       => esc_html__( 'None', 'toffedassen' ),
				'scroll' => esc_html__( 'Scroll', 'toffedassen' ),
				'fixed'  => esc_html__( 'Fixed', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'page_boxed_layout',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'boxed_background_size'                => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Background Size', 'toffedassen' ),
			'section'         => 'boxed_layout',
			'default'         => '',
			'priority'        => 10,
			'choices'         => array(
				''        => esc_html__( 'None', 'toffedassen' ),
				'auto'    => esc_html__( 'Auto', 'toffedassen' ),
				'cover'   => esc_html__( 'Cover', 'toffedassen' ),
				'contain' => esc_html__( 'Contain', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'page_boxed_layout',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		// Page Header of Page
		'page_header'                          => array(
			'type'        => 'toggle',
			'default'     => 1,
			'label'       => esc_html__( 'Enable Page Header', 'toffedassen' ),
			'section'     => 'page_header',
			'description' => esc_html__( 'Enable to show a page header for page below the site header', 'toffedassen' ),
			'priority'    => 10,
		),
		'page_header_breadcrumbs'              => array(
			'type'            => 'toggle',
			'default'         => 1,
			'label'           => esc_html__( 'Enable Breadcrumbs', 'toffedassen' ),
			'section'         => 'page_header',
			'description'     => esc_html__( 'Enable to show a breadcrumbs for page below the site header', 'toffedassen' ),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'page_header_text_color'               => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Page Header Text Color', 'toffedassen' ),
			'section'         => 'page_header',
			'default'         => 'dark',
			'choices'         => array(
				'dark'  => esc_html__( 'Dark', 'toffedassen' ),
				'light' => esc_html__( 'Light', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'page_header_background'               => array(
			'type'            => 'image',
			'label'           => esc_html__( 'Background Image', 'toffedassen' ),
			'section'         => 'page_header',
			'default'         => '',
			'priority'        => 20,
			'active_callback' => array(
				array(
					'setting'  => 'page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'page_header_parallax'                 => array(
			'type'            => 'toggle',
			'label'           => esc_html__( 'Enable Parallax', 'toffedassen' ),
			'section'         => 'page_header',
			'default'         => 1,
			'priority'        => 20,
			'active_callback' => array(
				array(
					'setting'  => 'page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		// Blog
		'blog_page_header'                     => array(
			'type'        => 'toggle',
			'default'     => 1,
			'label'       => esc_html__( 'Enable Page Header', 'toffedassen' ),
			'section'     => 'blog_page_header',
			'description' => esc_html__( 'Enable to show a page header for blog page below the site header', 'toffedassen' ),
			'priority'    => 10,
		),
		'blog_page_header_breadcrumbs'         => array(
			'type'            => 'toggle',
			'default'         => 1,
			'label'           => esc_html__( 'Enable Breadcrumbs', 'toffedassen' ),
			'section'         => 'blog_page_header',
			'description'     => esc_html__( 'Enable to show a breadcrumbs for blog page below the site header', 'toffedassen' ),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'blog_page_header_layout'              => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Page Header Layout', 'toffedassen' ),
			'section'         => 'blog_page_header',
			'default'         => '1',
			'priority'        => 10,
			'choices'         => array(
				'1' => esc_html__( 'Layout 1', 'toffedassen' ),
				'2' => esc_html__( 'Layout 2', 'toffedassen' ),
				'3' => esc_html__( 'Layout 3', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'blog_page_header_subtitle'            => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Blog SubTitle', 'toffedassen' ),
			'section'         => 'blog_page_header',
			'default'         => '',
			'priority'        => 10,
			'description'     => esc_html__( 'Enter Blog SubTitle', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'blog_page_header_layout',
					'operator' => '==',
					'value'    => '1',
				),
			),
		),
		'blog_page_header_title'               => array(
			'type'            => 'textarea',
			'label'           => esc_html__( 'Blog Title', 'toffedassen' ),
			'section'         => 'blog_page_header',
			'default'         => '',
			'priority'        => 10,
			'description'     => esc_html__( 'Enter Blog Title', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'blog_page_header_text_color'          => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Page Header Text Color', 'toffedassen' ),
			'section'         => 'blog_page_header',
			'default'         => 'dark',
			'choices'         => array(
				'dark'  => esc_html__( 'Dark', 'toffedassen' ),
				'light' => esc_html__( 'Light', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'blog_page_header_layout',
					'operator' => 'in',
					'value'    => array( '2', '3' ),
				),
			),
		),
		'blog_page_header_parallax'            => array(
			'type'            => 'toggle',
			'label'           => esc_html__( 'Enable Parallax', 'toffedassen' ),
			'section'         => 'blog_page_header',
			'default'         => 1,
			'priority'        => 20,
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'blog_page_header_layout',
					'operator' => 'in',
					'value'    => array( '2', '3' ),
				),
			),
		),
		'blog_page_header_background'          => array(
			'type'            => 'image',
			'label'           => esc_html__( 'Background Image', 'toffedassen' ),
			'section'         => 'blog_page_header',
			'default'         => '',
			'priority'        => 20,
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'blog_page_header_layout',
					'operator' => 'in',
					'value'    => array( '2', '3' ),
				),
			),
		),

		'blog_style'                           => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Blog Style', 'toffedassen' ),
			'section'  => 'blog_page',
			'default'  => 'list',
			'priority' => 10,
			'choices'  => array(
				'grid'    => esc_html__( 'Grid', 'toffedassen' ),
				'list'    => esc_html__( 'List', 'toffedassen' ),
				'masonry' => esc_html__( 'Masonry', 'toffedassen' ),
			),
		),
		'blog_layout'                          => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Blog Grid Layout', 'toffedassen' ),
			'section'         => 'blog_page',
			'default'         => 'content-sidebar',
			'priority'        => 10,
			'description'     => esc_html__( 'Select default sidebar for blog classic.', 'toffedassen' ),
			'choices'         => array(
				'content-sidebar' => esc_html__( 'Right Sidebar', 'toffedassen' ),
				'sidebar-content' => esc_html__( 'Left Sidebar', 'toffedassen' ),
				'full-content'    => esc_html__( 'Full Content', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'blog_style',
					'operator' => '==',
					'value'    => 'grid',
				),
			),
		),
		'blog_entry_meta'                      => array(
			'type'     => 'multicheck',
			'label'    => esc_html__( 'Entry Metas', 'toffedassen' ),
			'section'  => 'blog_page',
			'default'  => array( 'cat', 'date' ),
			'choices'  => array(
				'cat'  => esc_html__( 'Category', 'toffedassen' ),
				'date' => esc_html__( 'Date', 'toffedassen' ),
			),
			'priority' => 10,
		),
		'excerpt_length'                       => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Excerpt Length', 'toffedassen' ),
			'section'         => 'blog_page',
			'default'         => '20',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'blog_style',
					'operator' => '==',
					'value'    => 'list',
				),
			),
		),
		'blog_custom_field_1'                  => array(
			'type'    => 'custom',
			'section' => 'blog_page',
			'default' => '<hr/>',
		),
		'blog_cat_filter'                      => array(
			'type'     => 'toggle',
			'default'  => 0,
			'label'    => esc_html__( 'Categories Filter', 'toffedassen' ),
			'section'  => 'blog_page',
			'priority' => 10,
		),
		'blog_categories_numbers'              => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Categories Numbers', 'toffedassen' ),
			'section'         => 'blog_page',
			'default'         => '5',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'blog_cat_filter',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'blog_categories'                      => array(
			'type'            => 'textarea',
			'label'           => esc_html__( 'Custom Categories', 'toffedassen' ),
			'section'         => 'blog_page',
			'default'         => '',
			'priority'        => 10,
			'description'     => esc_html__( 'Enter categories slug you want to display. Each slug is separated by comma character ",". If empty, it will display default', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'blog_cat_filter',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		// Single Posts
		'single_post_layout'                   => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Single Post Layout', 'toffedassen' ),
			'section'     => 'single_post',
			'default'     => 'full-content',
			'priority'    => 5,
			'description' => esc_html__( 'Select default sidebar for the single post page.', 'toffedassen' ),
			'choices'     => array(
				'content-sidebar' => esc_html__( 'Right Sidebar', 'toffedassen' ),
				'sidebar-content' => esc_html__( 'Left Sidebar', 'toffedassen' ),
				'full-content'    => esc_html__( 'Full Content', 'toffedassen' ),
			),
		),
		'post_entry_meta'                      => array(
			'type'     => 'multicheck',
			'label'    => esc_html__( 'Entry Meta', 'toffedassen' ),
			'section'  => 'single_post',
			'default'  => array( 'author', 'scat', 'date' ),
			'choices'  => array(
				'scat'   => esc_html__( 'Category', 'toffedassen' ),
				'author' => esc_html__( 'Author', 'toffedassen' ),
				'date'   => esc_html__( 'Date', 'toffedassen' ),
			),
			'priority' => 10,
		),
		'post_custom_field_1'                  => array(
			'type'    => 'custom',
			'section' => 'single_post',
			'default' => '<hr/>',
		),

		'show_post_social_share'               => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show Socials Share', 'toffedassen' ),
			'description' => esc_html__( 'Check this option to show socials share in the single post page.', 'toffedassen' ),
			'section'     => 'single_post',
			'default'     => 0,
			'priority'    => 10,
		),

		'post_socials_share'                   => array(
			'type'            => 'multicheck',
			'label'           => esc_html__( 'Socials Share', 'toffedassen' ),
			'section'         => 'single_post',
			'default'         => array( 'facebook', 'twitter', 'google', 'tumblr' ),
			'choices'         => array(
				'facebook'  => esc_html__( 'Facebook', 'toffedassen' ),
				'twitter'   => esc_html__( 'Twitter', 'toffedassen' ),
				'google'    => esc_html__( 'Google Plus', 'toffedassen' ),
				'tumblr'    => esc_html__( 'Tumblr', 'toffedassen' ),
				'pinterest' => esc_html__( 'Pinterest', 'toffedassen' ),
				'linkedin'  => esc_html__( 'Linkedin', 'toffedassen' ),
			),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'show_post_social_share',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'show_author_box'                      => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show Author Box', 'toffedassen' ),
			'section'  => 'single_post',
			'default'  => 1,
			'priority' => 10,
		),
		'post_custom_field_2'                  => array(
			'type'    => 'custom',
			'section' => 'single_post',
			'default' => '<hr/>',
		),
		'related_posts'                        => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Related Posts', 'toffedassen' ),
			'section'     => 'single_post',
			'description' => esc_html__( 'Check this option to show related posts in the single post page.', 'toffedassen' ),
			'default'     => 1,
			'priority'    => 20,
		),
		'related_posts_title'                  => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Related Posts Title', 'toffedassen' ),
			'section'         => 'single_post',
			'default'         => esc_html__( 'You may also like', 'toffedassen' ),
			'priority'        => 20,

			'active_callback' => array(
				array(
					'setting'  => 'related_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
		'related_posts_numbers'                => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Related Posts Numbers', 'toffedassen' ),
			'section'         => 'single_post',
			'default'         => '2',
			'priority'        => 20,
			'active_callback' => array(
				array(
					'setting'  => 'related_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
		// Catalog
		'catalog_custom'                       => array(
			'type'     => 'custom',
			'section'  => 'woocommerce_product_catalog',
			'default'  => '<hr>',
			'priority' => 70,
		),
		'catalog_layout'                       => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Catalog Layout', 'toffedassen' ),
			'default'     => 'full-content',
			'section'     => 'woocommerce_product_catalog',
			'priority'    => 70,
			'description' => esc_html__( 'Select layout for catalog.', 'toffedassen' ),
			'choices'     => array(
				'sidebar-content' => esc_html__( 'Left Sidebar', 'toffedassen' ),
				'content-sidebar' => esc_html__( 'Right Sidebar', 'toffedassen' ),
				'full-content'    => esc_html__( 'Full Content', 'toffedassen' ),
				'masonry-content' => esc_html__( 'Masonry Content', 'toffedassen' ),
			),
		),
		'catalog_full_width'                   => array(
			'type'            => 'toggle',
			'label'           => esc_html__( 'Catalog Full Width', 'toffedassen' ),
			'default'         => '0',
			'section'         => 'shop',
			'priority'        => 70,
			'active_callback' => array(
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'sidebar-content', 'content-sidebar', 'full-content' ),
				),
			),
		),
		'shop_view'                            => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Catalog View', 'toffedassen' ),
			'description'     => esc_html__( 'Select Catalog View', 'toffedassen' ),
			'section'         => 'shop',
			'priority'        => 70,
			'default'         => 'grid',
			'choices'         => array(
				'grid' => esc_html__( 'Grid', 'toffedassen' ),
				'list' => esc_html__( 'List', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'sidebar-content', 'content-sidebar', 'full-content' ),
				),
			),
		),
		'shop_toolbar_masonry'                 => array(
			'type'            => 'multicheck',
			'label'           => esc_html__( 'Masonry ToolBar Elements', 'toffedassen' ),
			'section'         => 'shop',
			'default'         => array( 'categories', 'filter' ),
			'priority'        => 70,
			'choices'         => array(
				'categories' => esc_html__( 'Categories', 'toffedassen' ),
				'filter'     => esc_html__( 'Filters', 'toffedassen' ),
			),
			'description'     => esc_html__( 'Select which elements you want to show.', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'masonry-content' )
				),
			),
		),
		'catalog_categories_numbers'           => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Categories Numbers', 'toffedassen' ),
			'section'         => 'shop',
			'default'         => 3,
			'priority'        => 70,
			'active_callback' => array(
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'masonry-content' )
				),
			),
		),
		'catalog_categories'                   => array(
			'type'            => 'textarea',
			'label'           => esc_html__( 'Custom Categories', 'toffedassen' ),
			'section'         => 'shop',
			'default'         => '',
			'priority'        => 70,
			'description'     => esc_html__( 'Enter categories slug you want to display. Each slug is separated by comma character ",". If empty, it will display default', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'masonry-content' )
				),
			),
		),
		'catalog_custom_12'                    => array(
			'type'     => 'custom',
			'section'  => 'shop',
			'default'  => '<hr>',
			'priority' => 70,
		),
		'product_attribute'                    => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Product Attribute', 'toffedassen' ),
			'section'     => 'shop',
			'default'     => 'none',
			'priority'    => 20,
			'choices'     => toffedassen_product_attributes(),
			'description' => esc_html__( 'Show product attribute for each item listed under the item name.', 'toffedassen' ),
		),
		'catalog_custom_2'                     => array(
			'type'     => 'custom',
			'section'  => 'shop',
			'default'  => '<hr>',
			'priority' => 70,
		),
		'add_to_cart_action'                   => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Catalog Add to Cart Action', 'toffedassen' ),
			'section'  => 'shop',
			'priority' => 70,
			'default'  => 'notice',
			'choices'  => array(
				'notice' => esc_html__( 'Show Notice', 'toffedassen' ),
				'cart'   => esc_html__( 'Show Cart Sidebar', 'toffedassen' ),
			),
		),
		// My account
		'my_account'                           => array(
			'type'        => 'toggle',
			'default'     => 0,
			'label'       => esc_html__( 'Disable Login Popup', 'toffedassen' ),
			'section'     => 'my_account',
			'description' => esc_html__( 'Disable Login Modal when click on account icon on header', 'toffedassen' ),
			'priority'    => 70,
		),
		// Catalog Page Header
		'catalog_page_header'                  => array(
			'type'        => 'toggle',
			'default'     => 1,
			'label'       => esc_html__( 'Enable Page Header', 'toffedassen' ),
			'section'     => 'catalog_page_header',
			'description' => esc_html__( 'Enable to show a page header for catalog page below the site header', 'toffedassen' ),
			'priority'    => 70,
		),
		'catalog_page_header_breadcrumbs'      => array(
			'type'            => 'toggle',
			'default'         => 1,
			'label'           => esc_html__( 'Enable Breadcrumbs', 'toffedassen' ),
			'section'         => 'catalog_page_header',
			'description'     => esc_html__( 'Enable to show a breadcrumbs for catalog page below the site header', 'toffedassen' ),
			'priority'        => 70,
			'active_callback' => array(
				array(
					'setting'  => 'catalog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'catalog_page_header_layout'           => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Page Header Layout', 'toffedassen' ),
			'section'         => 'catalog_page_header',
			'default'         => '1',
			'priority'        => 70,
			'choices'         => array(
				'1' => esc_html__( 'Layout 1', 'toffedassen' ),
				'2' => esc_html__( 'Layout 2', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'catalog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		'catalog_page_header_custom'           => array(
			'type'     => 'custom',
			'section'  => 'catalog_page_header',
			'default'  => '<hr>',
			'priority' => 70,
		),

		'shop_toolbar'                         => array(
			'type'            => 'multicheck',
			'label'           => esc_html__( 'Shop Toolbar', 'toffedassen' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => array( 'result', 'sort_by', 'shop_view' ),
			'priority'        => 70,
			'choices'         => array(
				'result'    => esc_html__( 'Result', 'toffedassen' ),
				'filter'    => esc_html__( 'Filter', 'toffedassen' ),
				'sort_by'   => esc_html__( 'Sort By', 'toffedassen' ),
				'shop_view' => esc_html__( 'Shop View', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'catalog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'description'     => esc_html__( 'Select which elements you want to show on shop toolbar', 'toffedassen' ),
		),

		'catalog_page_header_custom_2'         => array(
			'type'     => 'custom',
			'section'  => 'catalog_page_header',
			'default'  => '<hr>',
			'priority' => 70,
		),

		'catalog_page_header_banner'           => array(
			'type'            => 'toggle',
			'default'         => 1,
			'label'           => esc_html__( 'Enable Catalog Banner', 'toffedassen' ),
			'section'         => 'catalog_page_header',
			'description'     => esc_html__( 'Enable to show a page header banner for catalog page', 'toffedassen' ),
			'priority'        => 70,
			'active_callback' => array(
				array(
					'setting'  => 'catalog_page_header_layout',
					'operator' => '==',
					'value'    => '3',
				),
			),
		),
		'catalog_page_header_banner_shortcode' => array(
			'type'            => 'textarea',
			'default'         => '',
			'label'           => esc_html__( 'Catalog Banner Shortcode', 'toffedassen' ),
			'section'         => 'catalog_page_header',
			'description'     => esc_html__( 'Enter banner shortcode.', 'toffedassen' ),
			'tooltip'         => wp_kses_post( esc_html__( 'You can build banner by RevSlider then copy that shortcode into here', 'toffedassen' ) ),
			'priority'        => 70,
			'active_callback' => array(
				array(
					'setting'  => 'catalog_page_header_layout',
					'operator' => '==',
					'value'    => '3',
				),
				array(
					'setting'  => 'catalog_page_header_banner',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		'added_to_cart_notice_custom'          => array(
			'type'     => 'custom',
			'section'  => 'shop',
			'default'  => '<hr>',
			'priority' => 70,
		),

		'added_to_cart_notice'                 => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Added to Cart Notification', 'toffedassen' ),
			'description' => esc_html__( 'Display a notification when a product is added to cart', 'toffedassen' ),
			'section'     => 'shop',
			'priority'    => 70,
			'default'     => 1,
		),
		'cart_notice_auto_hide'                => array(
			'type'        => 'number',
			'label'       => esc_html__( 'Cart Notification Auto Hide', 'toffedassen' ),
			'description' => esc_html__( 'How many seconds you want to hide the notification.', 'toffedassen' ),
			'section'     => 'shop',
			'priority'    => 70,
			'default'     => 3,
		),
		'catalog_ajax_filter_custom'           => array(
			'type'     => 'custom',
			'section'  => 'shop',
			'default'  => '<hr>',
			'priority' => 70,
		),
		'catalog_ajax_filter'                  => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Ajax For Filtering', 'toffedassen' ),
			'section'     => 'shop',
			'description' => esc_html__( 'Check this option to use ajax for filtering in the catalog page.', 'toffedassen' ),
			'default'     => 1,
			'priority'    => 70
		),
		'disable_secondary_thumb'              => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Disable Secondary Product Thumbnail', 'toffedassen' ),
			'section'     => 'shop',
			'default'     => 0,
			'priority'    => 70,
			'description' => esc_html__( 'Check this option to disable secondary product thumbnail when hover over the main product image.', 'toffedassen' ),
		),
		'shop_nav_type'                        => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Type of Navigation', 'toffedassen' ),
			'section'  => 'shop',
			'default'  => 'numbers',
			'priority' => 90,
			'choices'  => array(
				'numbers'  => esc_html__( 'Page Numbers', 'toffedassen' ),
				'ajax'     => esc_html__( 'Ajax Loading', 'toffedassen' ),
				'infinite' => esc_html__( 'Infinite Scroll', 'toffedassen' ),
			),
		),

		//Badge
		'show_badges'                          => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show Badges', 'toffedassen' ),
			'section'     => 'shop_badge',
			'default'     => 1,
			'priority'    => 20,
			'description' => esc_html__( 'Check this to show badges on every products.', 'toffedassen' ),
		),
		'badges'                               => array(
			'type'            => 'multicheck',
			'label'           => esc_html__( 'Badges', 'toffedassen' ),
			'section'         => 'shop_badge',
			'default'         => array( 'hot', 'new', 'sale', 'outofstock' ),
			'priority'        => 20,
			'choices'         => array(
				'hot'        => esc_html__( 'Hot', 'toffedassen' ),
				'new'        => esc_html__( 'New', 'toffedassen' ),
				'sale'       => esc_html__( 'Sale', 'toffedassen' ),
				'outofstock' => esc_html__( 'Out Of Stock', 'toffedassen' ),
			),
			'description'     => esc_html__( 'Select which badges you want to show', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'show_badges',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'sale_badge_custom'                    => array(
			'type'     => 'custom',
			'label'    => '<hr/>',
			'default'  => '<h2>' . esc_html__( 'Sale Badge', 'toffedassen' ) . '</h2>',
			'section'  => 'shop_badge',
			'priority' => 20,
		),
		'sale_behaviour'                       => array(
			'type'            => 'radio',
			'label'           => esc_html__( 'Sale Behaviour', 'toffedassen' ),
			'default'         => 'text',
			'section'         => 'shop_badge',
			'priority'        => 20,
			'choices'         => array(
				'text'       => esc_attr__( 'Show Text', 'toffedassen' ),
				'percentage' => esc_attr__( 'Show Percentage Discount', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'sale',
				),
			),
		),
		'sale_text'                            => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Custom Sale Text', 'toffedassen' ),
			'section'         => 'shop_badge',
			'default'         => esc_html__( 'Sale', 'toffedassen' ),
			'priority'        => 20,
			'active_callback' => array(
				array(
					'setting'  => 'show_badges',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'sale_behaviour',
					'operator' => '==',
					'value'    => 'text',
				),
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'sale',
				),
			),
		),
		'sale_color'                           => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'shop_badge',
			'priority'        => 20,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'sale',
				),
			),
		),
		'sale_bg_color'                        => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Background Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'shop_badge',
			'priority'        => 20,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'sale',
				),
			),
		),
		'hot_badge_custom'                     => array(
			'type'     => 'custom',
			'label'    => '<hr/>',
			'default'  => '<h2>' . esc_html__( 'Hot Badge', 'toffedassen' ) . '</h2>',
			'section'  => 'shop_badge',
			'priority' => 20,
		),
		'hot_text'                             => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Custom Hot Text', 'toffedassen' ),
			'section'         => 'shop_badge',
			'priority'        => 20,
			'default'         => esc_html__( 'Hot', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'show_badges',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'hot',
				),
			),
		),
		'hot_color'                            => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'toffedassen' ),
			'default'         => '',
			'priority'        => 20,
			'section'         => 'shop_badge',
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'hot',
				),
			),
		),
		'hot_bg_color'                         => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Background Color', 'supro' ),
			'default'         => '',
			'priority'        => 20,
			'section'         => 'shop_badge',
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'hot',
				),
			),
		),
		'outofstock_badge_custom'              => array(
			'type'    => 'custom',
			'label'   => '<hr/>',
			'default' => '<h2>' . esc_html__( 'Out of stock Badge', 'supro' ) . '</h2>',
			'section' => 'shop_badge',
			'priority'        => 20,
		),
		'outofstock_text'                      => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Custom Out Of Stock Text', 'toffedassen' ),
			'section'         => 'shop_badge',
			'default'         => esc_html__( 'Out Of Stock', 'toffedassen' ),
			'priority'        => 20,
			'active_callback' => array(
				array(
					'setting'  => 'show_badges',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'outofstock',
				),
			),
		),
		'outofstock_color'                     => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'toffedassen' ),
			'default'         => '',
			'priority'        => 20,
			'section'         => 'shop_badge',
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'outofstock',
				),
			),
		),
		'outofstock_bg_color'                  => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Background Color', 'toffedassen' ),
			'default'         => '',
			'priority'        => 20,
			'section'         => 'shop_badge',
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'outofstock',
				),
			),
		),
		'new_badge_custom'                     => array(
			'type'    => 'custom',
			'label'   => '<hr/>',
			'default' => '<h2>' . esc_html__( 'New Badge', 'toffedassen' ) . '</h2>',
			'section' => 'shop_badge',
			'priority'        => 20,
		),
		'new_text'                             => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Custom New Text', 'toffedassen' ),
			'section'         => 'shop_badge',
			'default'         => esc_html__( 'New', 'toffedassen' ),
			'priority'        => 20,
			'active_callback' => array(
				array(
					'setting'  => 'show_badges',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'new',
				),
			),
		),
		'new_color'                            => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'shop_badge',
			'priority'        => 20,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'new',
				),
			),
		),
		'new_bg_color'                         => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Background Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'shop_badge',
			'priority'        => 20,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'new',
				),
			),
		),
		'product_newness'                      => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Product Newness', 'toffedassen' ),
			'section'         => 'shop_badge',
			'default'         => 3,
			'priority'        => 20,
			'description'     => esc_html__( 'Display the "New" badge for how many days?', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'show_badges',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'badges',
					'operator' => 'contains',
					'value'    => 'new',
				),
			),
		),
		'custom_badge_custom'                  => array(
			'type'    => 'custom',
			'label'   => '<hr/>',
			'default' => '<h2>' . esc_html__( 'Custom Badge', 'toffedassen' ) . '</h2>',
			'section' => 'shop_badge',
			'priority'        => 20,
		),
		'custom_badge'                         => array(
			'type'    => 'toggle',
			'label'   => esc_html__( 'Custom Badge', 'toffedassen' ),
			'section' => 'shop_badge',
			'default' => 0,
			'priority'        => 20,
		),
		'custom_badge_color'                   => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'shop_badge',
			'priority'        => 20,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'custom_badge',
					'operator' => '=',
					'value'    => 1,
				),
			),
		),
		'custom_badge_bg_color'                => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Background Color', 'toffedassen' ),
			'default'         => '',
			'section'         => 'shop_badge',
			'priority'        => 20,
			'choices'         => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'custom_badge',
					'operator' => '=',
					'value'    => 1,
				),
			),
		),
		// Single Product
		'product_zoom'                         => array(
			'type'            => 'toggle',
			'label'           => esc_html__( 'Product Zoom', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => 0,
			'description'     => esc_html__( 'Check this option to show a bigger size product image on mouseover', 'supro' ),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'single_product_layout',
					'operator' => 'in',
					'value'    => array( '1', '2' ),
				),
			),
		),
		'product_images_lightbox'              => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Product Images Gallery', 'toffedassen' ),
			'section'     => 'single_product',
			'default'     => 1,
			'description' => esc_html__( 'Check this option to open product gallery images in a lightbox', 'supro' ),
			'priority'    => 10,
		),
		'product_add_to_cart_ajax'             => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Add to cart with AJAX', 'toffedassen' ),
			'section'     => 'single_product',
			'default'     => 1,
			'priority'    => 10,
			'description' => esc_html__( 'Check this option to enable add to cart with AJAX on the product page.', 'supro' ),
		),

		'product_add_to_cart_sticky'           => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Add to cart Sticky', 'toffedassen' ),
			'section'     => 'single_product',
			'default'     => 1,
			'priority'    => 10,
			'description' => esc_html__( 'Check this option to enable add to cart sticky on the product page on mobile.', 'supro' ),
		),
		'single_product_custom'                  => array(
			'type'     => 'custom',
			'section'  => 'single_product',
			'default'  => '<hr>',
			'priority' => 10,
		),
		'single_product_layout'                => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Single Product Layout', 'toffedassen' ),
			'section'  => 'single_product',
			'default'  => '1',
			'priority' => 10,
			'choices'  => array(
				'1' => esc_html__( 'Layout 1', 'toffedassen' ),
				'2' => esc_html__( 'Layout 2', 'toffedassen' ),
				'3' => esc_html__( 'Layout 3', 'toffedassen' ),
				'4' => esc_html__( 'Layout 4', 'toffedassen' ),
				'5' => esc_html__( 'Layout 5', 'toffedassen' ),
				'6' => esc_html__( 'Layout 6', 'toffedassen' ),
			),
		),
		'single_product_sidebar'               => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Single Product Sidebar', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => 'full-content',
			'priority'        => 10,
			'choices'         => array(
				'sidebar-content' => esc_html__( 'Left Sidebar', 'toffedassen' ),
				'content-sidebar' => esc_html__( 'Right Sidebar', 'toffedassen' ),
				'full-content'    => esc_html__( 'Full Content', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'single_product_layout',
					'operator' => '==',
					'value'    => '1',
				),
			),
		),
		'single_product_background_color'      => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Background Color', 'toffedassen' ),
			'default'         => '#f2f1f0',
			'section'         => 'single_product',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'single_product_layout',
					'operator' => '==',
					'value'    => '2',
				),
			),
		),

		'product_badges'                       => array(
			'type'            => 'toggle',
			'label'           => esc_html__( 'Show Badges', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => 1,
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'single_product_layout',
					'operator' => 'in',
					'value'    => array( '1' ),
				),
			),
		),
		'single_product_custom_1'                  => array(
			'type'     => 'custom',
			'section'  => 'single_product',
			'default'  => '<hr>',
			'priority' => 10,
		),
		'product_buy_now'                   => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Buy Now Button', 'toffedassen' ),
			'section'     => 'single_product',
			'default'     => 1,
			'description' => esc_html__( 'Show buy now in the single product.', 'toffedassen' ),
			'priority'    => 10,
		),
		'product_buy_now_text'              => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Buy Now Text', 'toffedassen' ),
			'description'     => esc_html__( 'Enter Buy not button text.', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => esc_html__( 'Buy Now', 'toffedassen' ),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'product_buy_now',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'product_buy_now_link'              => array(
			'type'            => 'textarea',
			'label'           => esc_html__( 'Buy Now Link', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => '',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'product_buy_now',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'single_product_custom_2'                  => array(
			'type'     => 'custom',
			'section'  => 'single_product',
			'default'  => '<hr>',
			'priority' => 10,
		),
		'show_product_socials'                 => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show Product Socials', 'toffedassen' ),
			'section'  => 'single_product',
			'default'  => 1,
			'priority' => 10,
		),
		'single_product_socials_share'         => array(
			'type'            => 'multicheck',
			'label'           => esc_html__( 'Socials Share', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => array( 'facebook', 'twitter', 'pinterest' ),
			'choices'         => array(
				'facebook'  => esc_html__( 'Facebook', 'toffedassen' ),
				'twitter'   => esc_html__( 'Twitter', 'toffedassen' ),
				'google'    => esc_html__( 'Google Plus', 'toffedassen' ),
				'tumblr'    => esc_html__( 'Tumblr', 'toffedassen' ),
				'pinterest' => esc_html__( 'Pinterest', 'toffedassen' ),
				'linkedin'  => esc_html__( 'Linkedin', 'toffedassen' ),
			),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'show_product_socials',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'single_product_custom_3'                  => array(
			'type'     => 'custom',
			'section'  => 'single_product',
			'default'  => '<hr>',
			'priority' => 40,
		),
		'show_product_meta'                    => array(
			'type'        => 'multicheck',
			'label'       => esc_html__( 'Show Product Meta', 'toffedassen' ),
			'section'     => 'single_product',
			'default'     => array( 'sku', 'categories', 'tags' ),
			'priority'    => 40,
			'choices'     => array(
				'sku'        => esc_html__( 'SKU', 'toffedassen' ),
				'categories' => esc_html__( 'Categories', 'toffedassen' ),
				'tags'       => esc_html__( 'Tags', 'toffedassen' ),
				'brand'      => esc_html__( 'Brand', 'toffedassen' )
			),
			'description' => esc_html__( 'Select which product meta you want to show in single product page. Brand product just show if Brand Product Plugin is activated', 'toffedassen' ),
		),
		'single_product_custom_4'                  => array(
			'type'     => 'custom',
			'section'  => 'single_product',
			'default'  => '<hr>',
			'priority' => 40,
		),
		'single_product_toolbar'               => array(
			'type'        => 'multicheck',
			'label'       => esc_html__( 'Product Toolbar', 'toffedassen' ),
			'section'     => 'single_product',
			'default'     => array( 'breadcrumb', 'navigation' ),
			'priority'    => 40,
			'choices'     => array(
				'breadcrumb' => esc_html__( 'Breadcrumb', 'toffedassen' ),
				'navigation' => esc_html__( 'Navigation', 'toffedassen' ),
			),
			'description' => esc_html__( 'Select element you want to show on product toolbar in single product page', 'toffedassen' ),
		),
		'product_related_custom'               => array(
			'type'     => 'custom',
			'section'  => 'single_product',
			'default'  => '<hr>',
			'priority' => 40,
		),
		'product_related'                      => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show Related Products', 'toffedassen' ),
			'section'  => 'single_product',
			'default'  => 1,
			'priority' => 40,
		),
		'product_related_title'                => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Related Products Title', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => esc_html__( 'Related products', 'toffedassen' ),
			'priority'        => 40,
			'active_callback' => array(
				array(
					'setting'  => 'product_related',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'related_products_columns'             => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Related Products Columns', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => '4',
			'priority'        => 40,
			'description'     => esc_html__( 'Specify how many columns of related products you want to show on single product page', 'toffedassen' ),
			'choices'         => array(
				'3' => esc_html__( '3 Columns', 'toffedassen' ),
				'4' => esc_html__( '4 Columns', 'toffedassen' ),
				'5' => esc_html__( '5 Columns', 'toffedassen' ),
				'6' => esc_html__( '6 Columns', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'product_related',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'related_products_numbers'             => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Related Products Numbers', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => 4,
			'priority'        => 40,
			'description'     => esc_html__( 'Specify how many numbers of related products you want to show on single product page', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'product_related',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'product_upsells_custom'               => array(
			'type'     => 'custom',
			'section'  => 'single_product',
			'default'  => '<hr>',
			'priority' => 40,
		),
		'product_upsells'                      => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show Up-sells Products', 'toffedassen' ),
			'section'  => 'single_product',
			'default'  => 0,
			'priority' => 40,
		),
		'product_upsells_title'                => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Up-sells Products Title', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => esc_html__( 'You may also like', 'toffedassen' ),
			'priority'        => 40,
			'active_callback' => array(
				array(
					'setting'  => 'product_upsells',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'upsells_products_columns'             => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Up-sells Products Columns', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => '4',
			'priority'        => 40,
			'description'     => esc_html__( 'Specify how many columns of up-sells products you want to show on single product page', 'toffedassen' ),
			'choices'         => array(
				'3' => esc_html__( '3 Columns', 'toffedassen' ),
				'4' => esc_html__( '4 Columns', 'toffedassen' ),
				'5' => esc_html__( '5 Columns', 'toffedassen' ),
				'6' => esc_html__( '6 Columns', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'product_upsells',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'upsells_products_numbers'             => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Up-sells Products Numbers', 'toffedassen' ),
			'section'         => 'single_product',
			'default'         => 4,
			'priority'        => 40,
			'description'     => esc_html__( 'Specify how many numbers of up-sells products you want to show on single product page', 'toffedassen' ),
			'active_callback' => array(
				array(
					'setting'  => 'product_upsells',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		// Portfolio Page Header
		'portfolio_page_header'                => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Enable Page Header', 'toffedassen' ),
			'section'     => 'portfolio_page_header',
			'description' => esc_html__( 'Enable to show a page header for portfolio below the site header', 'toffedassen' ),
			'default'     => 1,
			'priority'    => 10,
		),
		'portfolio_breadcrumb'                 => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Enable Breadcrumb', 'toffedassen' ),
			'section'     => 'portfolio_page_header',
			'description' => esc_html__( 'Enable to show a breadcrumb on page header', 'toffedassen' ),
			'default'     => 1,
			'priority'    => 10,
		),
		'portfolio_page_header_text_color'     => array(
			'type'    => 'select',
			'label'   => esc_html__( 'Page Header Text Color', 'toffedassen' ),
			'section' => 'portfolio_page_header',
			'default' => 'dark',
			'choices' => array(
				'dark'  => esc_html__( 'Dark', 'toffedassen' ),
				'light' => esc_html__( 'Light', 'toffedassen' ),
			),
		),
		'portfolio_page_header_background'     => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Background Image', 'toffedassen' ),
			'section'  => 'portfolio_page_header',
			'default'  => '',
			'priority' => 20,
		),
		'portfolio_page_header_parallax'       => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Enable Parallax', 'toffedassen' ),
			'section'  => 'portfolio_page_header',
			'default'  => 1,
			'priority' => 20,
		),

		// Portfolio
		'portfolio_layout'                     => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Portfolio Layout', 'toffedassen' ),
			'section'  => 'portfolio',
			'default'  => 'grid',
			'priority' => 10,
			'choices'  => array(
				'grid'     => esc_html__( 'Grid', 'toffedassen' ),
				'masonry'  => esc_html__( 'Masonry', 'toffedassen' ),
				'carousel' => esc_html__( 'Carousel', 'toffedassen' ),
			),
		),

		'portfolio_category_filter'            => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Category Filter', 'toffedassen' ),
			'description' => esc_html__( 'Check this option to display Category Filter in the portfolio page.', 'toffedassen' ),
			'section'     => 'portfolio',
			'default'     => 1,
			'priority'    => 10,
		),

		'portfolio_nav_type'                   => array(
			'type'            => 'radio',
			'label'           => esc_html__( 'Portfolio Navigation Type', 'toffedassen' ),
			'section'         => 'portfolio',
			'default'         => 'ajax',
			'priority'        => 10,
			'choices'         => array(
				'ajax'    => esc_html__( 'Loading Ajax', 'toffedassen' ),
				'numeric' => esc_html__( 'Numeric', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_layout',
					'operator' => 'in',
					'value'    => array( 'grid', 'masonry' ),
				),
			),
		),

		'portfolio_text_color'                 => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Portfolio Text Color', 'toffedassen' ),
			'section'         => 'portfolio',
			'default'         => 'dark',
			'choices'         => array(
				'dark'  => esc_html__( 'Dark', 'toffedassen' ),
				'light' => esc_html__( 'Light', 'toffedassen' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_layout',
					'operator' => '==',
					'value'    => 'carousel',
				),
			),
		),

		// Single Portfolio
		'single_portfolio_show_socials'        => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show Socials Share', 'toffedassen' ),
			'description' => esc_html__( 'Check this option to show socials share in the single portfolio page.', 'toffedassen' ),
			'section'     => 'single_portfolio',
			'default'     => 0,
			'priority'    => 10,
		),
		'single_portfolio_socials'             => array(
			'type'            => 'repeater',
			'label'           => esc_html__( 'Socials', 'toffedassen' ),
			'section'         => 'single_portfolio',
			'priority'        => 10,
			'default'         => array(
				array(
					'link_url' => 'https://facebook.com/toffedassen',
				),
				array(
					'link_url' => 'https://twitter.com/toffedassen',
				),
				array(
					'link_url' => 'https://plus.google.com/toffedassen',
				),
				array(
					'link_url' => 'https://dribbble.com/',
				),
			),
			'fields'          => array(
				'link_url' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Social URL', 'toffedassen' ),
					'description' => esc_html__( 'Enter the URL for this social', 'toffedassen' ),
					'default'     => '',
				),
			),
			'active_callback' => array(
				array(
					'setting'  => 'single_portfolio_show_socials',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		// Footer Newsletter
		'footer_newsletter'                    => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Newsletter', 'toffedassen' ),
			'section'  => 'footer_newsletter',
			'default'  => 0,
			'priority' => 10,
		),
		'footer_newsletter_home'               => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show on HomePage', 'toffedassen' ),
			'section'     => 'footer_newsletter',
			'default'     => 1,
			'priority'    => 10,
			'description' => esc_html__( 'Just show newsletter on HomePage', 'toffedassen' ),
		),
		'newsletter_style'                     => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Style', 'toffedassen' ),
			'section'     => 'footer_newsletter',
			'default'     => 'space-between',
			'priority'    => 10,
			'choices'     => array(
				'space-between' => esc_html__( 'Space Between', 'toffedassen' ),
				'center'        => esc_html__( 'Center', 'toffedassen' ),
			),
			'description' => esc_html__( 'Select Style for Newsletter', 'toffedassen' ),
		),
		'newsletter_shape'                     => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Shape', 'toffedassen' ),
			'section'  => 'footer_newsletter',
			'default'  => 'square',
			'priority' => 10,
			'choices'  => array(
				'square' => esc_html__( 'Square', 'toffedassen' ),
				'round'  => esc_html__( 'Round', 'toffedassen' ),
			),
		),
		'newsletter_title'                     => array(
			'type'     => 'text',
			'label'    => esc_html__( 'Newsletter Title', 'toffedassen' ),
			'section'  => 'footer_newsletter',
			'default'  => esc_html__( 'Keep Connected', 'toffedassen' ),
			'priority' => 10,
		),
		'newsletter_desc'                      => array(
			'type'     => 'textarea',
			'label'    => esc_html__( 'Newsletter Description', 'toffedassen' ),
			'section'  => 'footer_newsletter',
			'default'  => esc_html__( 'Get updates by subscribe our weekly newsletter', 'toffedassen' ),
			'priority' => 10,
		),
		'newsletter_form'                      => array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Newsletter Form', 'toffedassen' ),
			'section'     => 'footer_newsletter',
			'default'     => '',
			'priority'    => 10,
			'description' => esc_html__( 'Go to MailChimp for WP/Form to get shortcode', 'toffedassen' ),
		),
		'newsletter_text_color'                => array(
			'type'     => 'color',
			'label'    => esc_html__( 'Color', 'toffedassen' ),
			'default'  => '',
			'section'  => 'footer_newsletter',
			'priority' => 30,
		),
		'newsletter_background_color'          => array(
			'type'     => 'color',
			'label'    => esc_html__( 'Background Color', 'toffedassen' ),
			'default'  => '',
			'section'  => 'footer_newsletter',
			'priority' => 30,
		),

		// Footer
		'footer_layout'                        => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Footer Layout', 'toffedassen' ),
			'section'  => 'footer_layout',
			'default'  => '1',
			'priority' => 10,
			'choices'  => array(
				'1' => esc_html__( 'Layout 1', 'toffedassen' ),
				'2' => esc_html__( 'Layout 2', 'toffedassen' ),
				'3' => esc_html__( 'Layout 3', 'toffedassen' ),
			),
		),
		'footer_skin'                          => array(
			'type'     => 'radio',
			'label'    => esc_html__( 'Footer Skin', 'toffedassen' ),
			'section'  => 'footer_layout',
			'priority' => 10,
			'default'  => 'light',
			'choices'  => array(
				'light' => esc_html__( 'Light', 'toffedassen' ),
				'dark'  => esc_html__( 'Dark', 'toffedassen' ),
			),
		),
		'footer_background_color'              => array(
			'type'     => 'color',
			'label'    => esc_html__( 'Background Color', 'toffedassen' ),
			'default'  => '',
			'section'  => 'footer_layout',
			'priority' => 10,
		),
		'footer_background_image'              => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Background Image', 'toffedassen' ),
			'default'  => '',
			'section'  => 'footer_layout',
			'priority' => 10,
		),
		'footer_background_horizontal'         => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Horizontal', 'toffedassen' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''       => esc_html__( 'None', 'toffedassen' ),
				'left'   => esc_html__( 'Left', 'toffedassen' ),
				'center' => esc_html__( 'Center', 'toffedassen' ),
				'right'  => esc_html__( 'Right', 'toffedassen' ),
			),
		),
		'footer_background_vertical'           => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Vertical', 'toffedassen' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''       => esc_html__( 'None', 'toffedassen' ),
				'top'    => esc_html__( 'Top', 'toffedassen' ),
				'center' => esc_html__( 'Center', 'toffedassen' ),
				'bottom' => esc_html__( 'Bottom', 'toffedassen' ),
			),
		),
		'footer_background_repeat'             => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Repeat', 'toffedassen' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''          => esc_html__( 'None', 'toffedassen' ),
				'no-repeat' => esc_html__( 'No Repeat', 'toffedassen' ),
				'repeat'    => esc_html__( 'Repeat', 'toffedassen' ),
				'repeat-y'  => esc_html__( 'Repeat Vertical', 'toffedassen' ),
				'repeat-x'  => esc_html__( 'Repeat Horizontal', 'toffedassen' ),
			),
		),
		'footer_background_attachment'         => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Attachment', 'toffedassen' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''       => esc_html__( 'None', 'toffedassen' ),
				'scroll' => esc_html__( 'Scroll', 'toffedassen' ),
				'fixed'  => esc_html__( 'Fixed', 'toffedassen' ),
			),
		),
		'footer_background_size'               => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Size', 'toffedassen' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''        => esc_html__( 'None', 'toffedassen' ),
				'auto'    => esc_html__( 'Auto', 'toffedassen' ),
				'cover'   => esc_html__( 'Cover', 'toffedassen' ),
				'contain' => esc_html__( 'Contain', 'toffedassen' ),
			),
		),

		// Footer Widgets

		'footer_widgets'                       => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Footer Widgets', 'toffedassen' ),
			'section'  => 'footer_widgets',
			'default'  => 1,
			'priority' => 10,
		),
		'footer_widgets_columns'               => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Footer Widgets Columns', 'toffedassen' ),
			'section'     => 'footer_widgets',
			'default'     => '4',
			'priority'    => 10,
			'choices'     => array(
				'1' => esc_html__( '1 Columns', 'supro' ),
				'2' => esc_html__( '2 Columns', 'supro' ),
				'3' => esc_html__( '3 Columns', 'supro' ),
				'4' => esc_html__( '4 Columns', 'supro' ),
				'5' => esc_html__( '5 Columns', 'supro' ),
			),
			'description' => esc_html__( 'Go to Appearance/Widgets/Footer Widget 1, 2, 3, 4, 5 to add widgets content.', 'toffedassen' ),
		),

		// Footer Copyright

		'footer_copyright'                 => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Footer Copyright', 'toffedassen' ),
			'section'  => 'footer_copyright',
			'default'  => 1,
			'priority' => 10,
		),
		'footer_copyright_columns'             => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Footer Copyright Columns', 'toffedassen' ),
			'section'     => 'footer_copyright',
			'default'     => '3',
			'priority'    => 10,
			'choices'     => array(
				'1' => esc_html__( '1 Columns', 'toffedassen' ),
				'2' => esc_html__( '2 Columns', 'toffedassen' ),
				'3' => esc_html__( '3 Columns', 'toffedassen' ),
			),
			'description' => esc_html__( 'Go to Appearance/Widgets/Footer Copyright 1, 2, 3 to add widgets content.', 'toffedassen' ),
		),
		'footer_copyright_menu_style'          => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Menu style', 'toffedassen' ),
			'section'     => 'footer_copyright',
			'default'     => '1',
			'priority'    => 10,
			'choices'     => array(
				'1' => esc_html__( 'Capitalize', 'toffedassen' ),
				'2' => esc_html__( 'Uppercase', 'toffedassen' ),
			),
			'description' => esc_html__( 'Select text transform for menu on footer copyright', 'toffedassen' ),
		),
		'footer_copyright_top_spacing'         => array(
			'type'        => 'number',
			'label'       => esc_html__( 'Top Spacing', 'toffedassen' ),
			'description' => esc_html__( 'Adjust the top spacing.', 'toffedassen' ),
			'section'     => 'footer_copyright',
			'default'     => '20',
			'js_vars'     => array(
				array(
					'element'  => '.site-footer .footer-copyright',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
			'transport'   => 'postMessage',
		),
		'footer_copyright_bottom_spacing'      => array(
			'type'        => 'number',
			'label'       => esc_html__( 'Bottom Spacing', 'toffedassen' ),
			'description' => esc_html__( 'Adjust the bottom spacing.', 'toffedassen' ),
			'section'     => 'footer_copyright',
			'default'     => '10',
			'js_vars'     => array(
				array(
					'element'  => '.site-footer .footer-copyright',
					'property' => 'padding-bottom',
					'units'    => 'px',
				),
			),
			'transport'   => 'postMessage',
		),

		// Footer Recent Viewed
		'footer_recently_viewed'               => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show Recently Viewed', 'toffedassen' ),
			'section'     => 'footer_recently_viewed',
			'default'     => 1,
			'priority'    => 90,
			'description' => esc_html__( 'Check this option to show the recently viewed products above the footer.', 'toffedassen' ),
		),
		'footer_recently_viewed_els'           => array(
			'type'        => 'multicheck',
			'label'       => esc_html__( 'Show Recently Viewed in', 'toffedassen' ),
			'section'     => 'footer_recently_viewed',
			'default'     => array( 'homepage', 'catalog', 'single_product' ),
			'priority'    => 90,
			'choices'     => array(
				'homepage'       => esc_html__( 'HomePage', 'toffedassen' ),
				'catalog'        => esc_html__( 'Catalog', 'toffedassen' ),
				'single_product' => esc_html__( 'Single Product', 'toffedassen' ),
				'page'           => esc_html__( 'Page', 'toffedassen' ),
				'post'           => esc_html__( 'Post', 'toffedassen' ),
				'other'          => esc_html__( 'Other Pages', 'toffedassen' ),
			),
			'description' => esc_html__( 'Check pages to show the recently viewed products above the footer.', 'toffedassen' ),
		),
		'footer_recently_viewed_title'         => array(
			'type'     => 'text',
			'label'    => esc_html__( 'Recently Viewed Title', 'toffedassen' ),
			'section'  => 'footer_recently_viewed',
			'default'  => esc_html__( 'Your Recently Viewed Products', 'toffedassen' ),
			'priority' => 90,
		),
		'footer_recently_viewed_number'        => array(
			'type'     => 'number',
			'label'    => esc_html__( 'Products Per Page', 'toffedassen' ),
			'section'  => 'footer_recently_viewed',
			'default'  => 12,
			'priority' => 90,
		),

		// Mobile
		'menu_mobile_behaviour'                => array(
			'type'    => 'radio',
			'label'   => esc_html__( 'Menu Mobile Icon Behaviour', 'toffedassen' ),
			'default' => 'icon',
			'section' => 'menu_mobile',
			'choices' => array(
				'icon' => esc_attr__( 'Open sub menu by click on icon', 'toffedassen' ),
				'item' => esc_attr__( 'Open sub menu by click on item', 'toffedassen' ),
			),
		),
		// Catalog Mobile
		'catalog_mobile_columns'               => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Catalog Columns', 'toffedassen' ),
			'default'     => '1',
			'section'     => 'catalog_mobile',
			'priority'    => 70,
			'description' => esc_html__( 'Select catalog columns on mobile.', 'toffedassen' ),
			'choices'     => array(
				'1' => esc_html__( '1 Column', 'toffedassen' ),
				'2' => esc_html__( '2 Columns', 'toffedassen' ),
			),
		),
		'catalog_filter_mobile'                => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Filter Mobile Sidebar', 'toffedassen' ),
			'default'     => '0',
			'section'     => 'catalog_mobile',
			'priority'    => 70,
			'description' => esc_html__( 'The Catalog filter display as sidebar', 'toffedassen' ),
		),
	);

	$settings['panels']   = apply_filters( 'toffedassen_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'toffedassen_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'toffedassen_customize_fields', $fields );

	return $settings;
}

$toffedassen_customize = new Toffe_Dassen_Customize( toffedassen_customize_settings() );