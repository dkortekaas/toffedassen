<?php
/**
 * Supro theme customizer
 *
 * @package Supro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Supro_Customize {
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
function supro_get_option( $name ) {
	global $supro_customize;

	if ( empty( $supro_customize ) ) {
		return false;
	}

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( $supro_customize->get_theme(), $name );
	} else {
		$value = $supro_customize->get_option( $name );
	}

	return apply_filters( 'supro_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function supro_get_option_default( $name ) {
	global $supro_customize;

	if ( empty( $supro_customize ) ) {
		return false;
	}

	return $supro_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function supro_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'supro_customize_modify' );


/**
 * Get product attributes
 *
 * @return string
 */
function supro_product_attributes() {
	$output = array();
	if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
		$attributes_tax = wc_get_attribute_taxonomies();
		if ( $attributes_tax ) {
			$output['none'] = esc_html__( 'None', 'supro' );

			foreach ( $attributes_tax as $attribute ) {
				$output[$attribute->attribute_name] = $attribute->attribute_label;
			}

		}
	}

	return $output;
}

function supro_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'supro',
	);

	$panels = array(
		'general'     => array(
			'priority' => 5,
			'title'    => esc_html__( 'General', 'supro' ),
		),
		'typography'  => array(
			'priority' => 10,
			'title'    => esc_html__( 'Typography', 'supro' ),
		),
		// Styling
		'styling'     => array(
			'title'    => esc_html__( 'Styling', 'supro' ),
			'priority' => 10,
		),
		'header'      => array(
			'priority' => 10,
			'title'    => esc_html__( 'Header', 'supro' ),
		),
		'page'        => array(
			'title'      => esc_html__( 'Page', 'supro' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
		'blog'        => array(
			'title'      => esc_html__( 'Blog', 'supro' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
		'woocommerce' => array(
			'priority' => 10,
			'title'    => esc_html__( 'Woocommerce', 'supro' ),
		),
		'portfolio'   => array(
			'title'      => esc_html__( 'Portfolio', 'supro' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
		'footer'      => array(
			'title'    => esc_html__( 'Footer', 'supro' ),
			'priority' => 50,
		),
	);

	$sections = array(
		'body_typo'                   => array(
			'title'       => esc_html__( 'Body', 'supro' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'typography',
		),
		'heading_typo'                => array(
			'title'       => esc_html__( 'Heading', 'supro' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'typography',
		),
		'header_typo'                 => array(
			'title'       => esc_html__( 'Header', 'supro' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'typography',
		),
		'footer_typo'                 => array(
			'title'       => esc_html__( 'Footer', 'supro' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'typography',
		),
		'header'                      => array(
			'title'       => esc_html__( 'Header', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
		'logo'                        => array(
			'title'       => esc_html__( 'Logo', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
		'backtotop'                   => array(
			'title'       => esc_html__( 'Back to Top', 'supro' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'styling',
		),
		'preloader'                   => array(
			'title'       => esc_html__( 'Preloader', 'supro' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'styling',
		),
		'color_scheme'                => array(
			'title'       => esc_html__( 'Color Scheme', 'supro' ),
			'description' => '',
			'priority'    => 210,
			'capability'  => 'edit_theme_options',
			'panel'       => 'styling',
		),
		'page_header'                 => array(
			'title'       => esc_html__( 'Page Header', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'page',
		),
		'coming_soon'                 => array(
			'title'       => esc_html__( 'Coming Soon', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'page',
		),
		'blog_page_header'            => array(
			'title'       => esc_html__( 'Blog Page Header', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'blog_page'                   => array(
			'title'       => esc_html__( 'Blog Page', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'single_post'                 => array(
			'title'       => esc_html__( 'Single Post', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'catalog_page_header'         => array(
			'title'       => esc_html__( 'Catalog Page Header', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'woocommerce',
		),
		'woocommerce_product_catalog' => array(
			'title'       => esc_html__( 'Product Catalog', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'panel'       => 'woocommerce',
			'capability'  => 'edit_theme_options',
		),
		'shop_badge'                  => array(
			'title'       => esc_html__( 'Badges', 'supro' ),
			'description' => '',
			'priority'    => 40,
			'panel'       => 'woocommerce',
			'capability'  => 'edit_theme_options',
		),
		'single_product'              => array(
			'title'       => esc_html__( 'Single Product', 'supro' ),
			'description' => '',
			'priority'    => 90,
			'panel'       => 'woocommerce',
			'capability'  => 'edit_theme_options',
		),
		'portfolio_page_header'       => array(
			'title'       => esc_html__( 'Portfolio Page Header', 'supro' ),
			'description' => '',
			'priority'    => 90,
			'panel'       => 'portfolio',
			'capability'  => 'edit_theme_options',
		),
		'portfolio'                   => array(
			'title'       => esc_html__( 'Portfolio', 'supro' ),
			'description' => '',
			'priority'    => 90,
			'panel'       => 'portfolio',
			'capability'  => 'edit_theme_options',
		),
		'single_portfolio'            => array(
			'title'       => esc_html__( 'Single Portfolio', 'supro' ),
			'description' => '',
			'priority'    => 90,
			'panel'       => 'portfolio',
			'capability'  => 'edit_theme_options',
		),
		'footer_newsletter'           => array(
			'title'       => esc_html__( 'Footer Newsletter', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'footer',
		),
		'footer_layout'               => array(
			'title'       => esc_html__( 'Footer Layout', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'footer',
		),
		'footer_widgets'              => array(
			'title'       => esc_html__( 'Footer Widgets', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'footer',
		),
		'footer_copyright'            => array(
			'title'       => esc_html__( 'Footer Copyright', 'supro' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'footer',
		),
	);

	$fields = array(
		// Typography
		'body_typo'                        => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Body', 'supro' ),
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
		'heading1_typo'                    => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 1', 'supro' ),
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
		'heading2_typo'                    => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 2', 'supro' ),
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
		'heading3_typo'                    => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 3', 'supro' ),
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
		'heading4_typo'                    => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 4', 'supro' ),
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
		'heading5_typo'                    => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 5', 'supro' ),
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
		'heading6_typo'                    => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Heading 6', 'supro' ),
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
		'menu_typo'                        => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Menu', 'supro' ),
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
		'sub_menu_typo'                    => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Sub Menu', 'supro' ),
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
		'footer_text_typo'                 => array(
			'type'     => 'typography',
			'label'    => esc_html__( 'Footer Text', 'supro' ),
			'section'  => 'footer_typo',
			'priority' => 10,
			'default'  => array(
				'font-family' => 'Cerebri Sans',
				'variant'     => 'regular',
				'subsets'     => array( 'latin-ext' ),
				'font-size'   => '15px',
			),
		),

		// Header layout
		'header_layout'                    => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Header Layout', 'supro' ),
			'section'  => 'header',
			'default'  => '1',
			'priority' => 10,
			'choices'  => array(
				'1' => esc_html__( 'Layout 1', 'supro' ),
				'2' => esc_html__( 'Layout 2', 'supro' ),
				'3' => esc_html__( 'Layout 3', 'supro' ),
				'4' => esc_html__( 'Layout 4', 'supro' ),
				'5' => esc_html__( 'Layout 5', 'supro' ),
			),
		),

		'header_sticky'                    => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Header Sticky', 'supro' ),
			'default'  => 1,
			'section'  => 'header',
			'priority' => 10,
		),

		'header_transparent'               => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Header Transparent', 'supro' ),
			'default'     => 1,
			'section'     => 'header',
			'priority'    => 10,
			'description' => esc_html__( 'Check this to enable header transparent in homepage only.', 'supro' ),
		),

		'header_text_color'                => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Header Text Color', 'supro' ),
			'description'     => esc_html__( 'This option apply for homepage only', 'supro' ),
			'section'         => 'header',
			'default'         => 'dark',
			'choices'         => array(
				'dark'   => esc_html__( 'Dark', 'supro' ),
				'light'  => esc_html__( 'Light', 'supro' ),
				'custom' => esc_html__( 'Custom', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'header_transparent',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'header_text_custom_color'         => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'supro' ),
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
		'menu_extras'                      => array(
			'type'     => 'multicheck',
			'label'    => esc_html__( 'Menu Extras', 'supro' ),
			'section'  => 'header',
			'default'  => array( 'search', 'account', 'wishlist', 'cart' ),
			'priority' => 10,
			'choices'  => array(
				'search'   => esc_html__( 'Search', 'supro' ),
				'account'  => esc_html__( 'Account', 'supro' ),
				'wishlist' => esc_html__( 'Wishlist', 'supro' ),
				'cart'     => esc_html__( 'Cart', 'supro' ),
				'sidebar'  => esc_html__( 'Sidebar', 'supro' ),
			),
		),
		'header_menu_text'                 => array(
			'type'     => 'text',
			'label'    => esc_html__( 'Menu Text', 'supro' ),
			'section'  => 'header',
			'default'  => '',
			'priority' => 10,
		),
		'header_socials'                   => array(
			'type'            => 'repeater',
			'label'           => esc_html__( 'Socials', 'supro' ),
			'section'         => 'header',
			'priority'        => 10,
			'row_label'       => array(
				'type'  => 'text',
				'value' => esc_attr__( 'Social', 'supro' ),
			),
			'fields'          => array(
				'link_url' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Social URL', 'supro' ),
					'description' => esc_html__( 'Enter the URL for this social', 'supro' ),
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
		'header_custom_field_1'            => array(
			'type'    => 'custom',
			'section' => 'header',
			'default' => '<hr/>',
		),
		'menu_animation'                   => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Menu Hover Animation', 'supro' ),
			'section'  => 'header',
			'default'  => 'fade',
			'priority' => 30,
			'choices'  => array(
				'none'  => esc_html__( 'No Animation', 'supro' ),
				'fade'  => esc_html__( 'Fade', 'supro' ),
				'slide' => esc_html__( 'Slide', 'supro' ),
			),
		),
		'menu_hover_color'                 => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Menu Hover Color', 'supro' ),
			'section'  => 'header',
			'default'  => 'none',
			'priority' => 30,
			'choices'  => array(
				'none'          => esc_html__( 'None', 'supro' ),
				'primary-color' => esc_html__( 'Primary Color', 'supro' ),
				'custom-color'  => esc_html__( 'Custom', 'supro' ),
			),
		),
		'menu_hover_custom_color'          => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'supro' ),
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
		'header_ajax_search'               => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'AJAX Search', 'supro' ),
			'section'     => 'header',
			'default'     => 1,
			'priority'    => 90,
			'description' => esc_html__( 'Check this option to enable AJAX search in the header', 'supro' ),
		),
		'search_content_type'              => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Search Content Type', 'supro' ),
			'section'  => 'header',
			'default'  => 'all',
			'priority' => 90,
			'choices'  => array(
				'all'      => esc_html__( 'All', 'supro' ),
				'products' => esc_html__( 'Only products', 'supro' ),
			),
		),
		// Logo
		'logo'                             => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Logo', 'supro' ),
			'section'  => 'logo',
			'default'  => '',
			'priority' => 10,
		),
		'logo_light'                       => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Logo Light', 'supro' ),
			'section'  => 'logo',
			'default'  => '',
			'priority' => 10,
		),
		'logo_width'                       => array(
			'type'     => 'number',
			'label'    => esc_html__( 'Logo Width', 'supro' ),
			'section'  => 'logo',
			'default'  => '',
			'priority' => 10,
		),
		'logo_height'                      => array(
			'type'     => 'number',
			'label'    => esc_html__( 'Logo Height', 'supro' ),
			'section'  => 'logo',
			'default'  => '',
			'priority' => 10,
		),
		'logo_position'                    => array(
			'type'     => 'spacing',
			'label'    => esc_html__( 'Logo Margin', 'supro' ),
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
		'back_to_top'                      => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Back to Top', 'supro' ),
			'section'  => 'backtotop',
			'default'  => 1,
			'priority' => 10,
		),
		'preloader'                        => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Preloader', 'supro' ),
			'section'  => 'preloader',
			'default'  => 0,
			'priority' => 10,
		),
		// Color Scheme
		'color_scheme'                     => array(
			'type'     => 'palette',
			'label'    => esc_html__( 'Base Color Scheme', 'supro' ),
			'default'  => '',
			'section'  => 'color_scheme',
			'priority' => 10,
			'choices'  => array(
				''        => array( '#f68872' ),
				'#7cafca' => array( '#7cafca' ),
			),
		),
		'custom_color_scheme'              => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Custom Color Scheme', 'supro' ),
			'default'  => 0,
			'section'  => 'color_scheme',
			'priority' => 10,
		),
		'custom_color'                     => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Color', 'supro' ),
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
		'coming_soon_logo'                 => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Logo', 'supro' ),
			'section'  => 'coming_soon',
			'default'  => '',
			'priority' => 10,
		),
		'coming_soon_background'           => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Background Image', 'supro' ),
			'section'  => 'coming_soon',
			'default'  => '',
			'priority' => 10,
		),
		'coming_soon_background_color'     => array(
			'type'     => 'color',
			'label'    => esc_html__( 'Background Color', 'supro' ),
			'default'  => '',
			'section'  => 'coming_soon',
			'priority' => 10,
		),
		'show_coming_soon_social_share'    => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show Socials Share', 'supro' ),
			'description' => esc_html__( 'Check this option to show socials share in the single post page.', 'supro' ),
			'section'     => 'coming_soon',
			'default'     => 0,
			'priority'    => 10,
		),

		'coming_soon_socials'              => array(
			'type'            => 'repeater',
			'label'           => esc_html__( 'Socials', 'supro' ),
			'section'         => 'coming_soon',
			'priority'        => 10,
			'default'         => array(
				array(
					'link_url' => 'https://facebook.com/supro',
				),
				array(
					'link_url' => 'https://twitter.com/supro',
				),
				array(
					'link_url' => 'https://plus.google.com/supro',
				),
				array(
					'link_url' => 'https://dribbble.com/',
				),
			),
			'fields'          => array(
				'link_url' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Social URL', 'supro' ),
					'description' => esc_html__( 'Enter the URL for this social', 'supro' ),
					'default'     => '',
				),
			),
			'active_callback' => array(
				array(
					'setting'  => 'show_coming_soon_social_share',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'coming_soon_newsletter'           => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Newsletter', 'supro' ),
			'section'  => 'coming_soon',
			'default'  => 1,
			'priority' => 10,
		),
		'coming_soon_newsletter_form'      => array(
			'type'            => 'textarea',
			'label'           => esc_html__( 'Newsletter Form', 'supro' ),
			'section'         => 'coming_soon',
			'default'         => '',
			'priority'        => 10,
			'description'     => esc_html__( 'Go to MailChimp for WP/Form to get shortcode', 'supro' ),
			'active_callback' => array(
				array(
					'setting'  => 'coming_soon_newsletter',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		// Page Header of Page
		'page_header'                      => array(
			'type'        => 'toggle',
			'default'     => 1,
			'label'       => esc_html__( 'Enable Page Header', 'supro' ),
			'section'     => 'page_header',
			'description' => esc_html__( 'Enable to show a page header for page below the site header', 'supro' ),
			'priority'    => 10,
		),
		'page_header_breadcrumbs'          => array(
			'type'            => 'toggle',
			'default'         => 1,
			'label'           => esc_html__( 'Enable Breadcrumbs', 'supro' ),
			'section'         => 'page_header',
			'description'     => esc_html__( 'Enable to show a breadcrumbs for page below the site header', 'supro' ),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'page_header_text_color'           => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Page Header Text Color', 'supro' ),
			'section'         => 'page_header',
			'default'         => 'dark',
			'choices'         => array(
				'dark'  => esc_html__( 'Dark', 'supro' ),
				'light' => esc_html__( 'Light', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'page_header_background'           => array(
			'type'            => 'image',
			'label'           => esc_html__( 'Background Image', 'supro' ),
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
		'page_header_parallax'             => array(
			'type'            => 'toggle',
			'label'           => esc_html__( 'Enable Parallax', 'supro' ),
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
		'blog_page_header'                 => array(
			'type'        => 'toggle',
			'default'     => 1,
			'label'       => esc_html__( 'Enable Page Header', 'supro' ),
			'section'     => 'blog_page_header',
			'description' => esc_html__( 'Enable to show a page header for blog page below the site header', 'supro' ),
			'priority'    => 10,
		),
		'blog_page_header_breadcrumbs'     => array(
			'type'            => 'toggle',
			'default'         => 1,
			'label'           => esc_html__( 'Enable Breadcrumbs', 'supro' ),
			'section'         => 'blog_page_header',
			'description'     => esc_html__( 'Enable to show a breadcrumbs for blog page below the site header', 'supro' ),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'blog_page_header_layout'          => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Page Header Layout', 'supro' ),
			'section'         => 'blog_page_header',
			'default'         => '1',
			'priority'        => 10,
			'choices'         => array(
				'1' => esc_html__( 'Layout 1', 'supro' ),
				'2' => esc_html__( 'Layout 2', 'supro' ),
				'3' => esc_html__( 'Layout 3', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'blog_page_header_subtitle'        => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Blog SubTitle', 'supro' ),
			'section'         => 'blog_page_header',
			'default'         => '',
			'priority'        => 10,
			'description'     => esc_html__( 'Enter Blog SubTitle', 'supro' ),
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
		'blog_page_header_title'           => array(
			'type'            => 'textarea',
			'label'           => esc_html__( 'Blog Title', 'supro' ),
			'section'         => 'blog_page_header',
			'default'         => '',
			'priority'        => 10,
			'description'     => esc_html__( 'Enter Blog Title', 'supro' ),
			'active_callback' => array(
				array(
					'setting'  => 'blog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'blog_page_header_text_color'      => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Page Header Text Color', 'supro' ),
			'section'         => 'blog_page_header',
			'default'         => 'dark',
			'choices'         => array(
				'dark'  => esc_html__( 'Dark', 'supro' ),
				'light' => esc_html__( 'Light', 'supro' ),
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
		'blog_page_header_parallax'        => array(
			'type'            => 'toggle',
			'label'           => esc_html__( 'Enable Parallax', 'supro' ),
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
		'blog_page_header_background'      => array(
			'type'            => 'image',
			'label'           => esc_html__( 'Background Image', 'supro' ),
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

		'blog_style'                       => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Blog Style', 'supro' ),
			'section'  => 'blog_page',
			'default'  => 'list',
			'priority' => 10,
			'choices'  => array(
				'grid'    => esc_html__( 'Grid', 'supro' ),
				'list'    => esc_html__( 'List', 'supro' ),
				'masonry' => esc_html__( 'Masonry', 'supro' ),
			),
		),
		'blog_layout'                      => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Blog Classic Layout', 'supro' ),
			'section'         => 'blog_page',
			'default'         => 'content-sidebar',
			'priority'        => 10,
			'description'     => esc_html__( 'Select default sidebar for blog classic.', 'supro' ),
			'choices'         => array(
				'content-sidebar' => esc_html__( 'Right Sidebar', 'supro' ),
				'sidebar-content' => esc_html__( 'Left Sidebar', 'supro' ),
				'full-content'    => esc_html__( 'Full Content', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'blog_style',
					'operator' => '==',
					'value'    => 'grid',
				),
			),
		),
		'blog_entry_meta'                  => array(
			'type'     => 'multicheck',
			'label'    => esc_html__( 'Entry Metas', 'supro' ),
			'section'  => 'blog_page',
			'default'  => array( 'cat', 'date' ),
			'choices'  => array(
				'cat'  => esc_html__( 'Category', 'supro' ),
				'date' => esc_html__( 'Date', 'supro' ),
			),
			'priority' => 10,
		),
		'excerpt_length'                   => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Excerpt Length', 'supro' ),
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
		'blog_custom_field_1'              => array(
			'type'    => 'custom',
			'section' => 'blog_page',
			'default' => '<hr/>',
		),
		'blog_cat_filter'                  => array(
			'type'     => 'toggle',
			'default'  => 0,
			'label'    => esc_html__( 'Categories Filter', 'supro' ),
			'section'  => 'blog_page',
			'priority' => 10,
		),
		'blog_categories_numbers'          => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Categories Numbers', 'supro' ),
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
		'blog_categories'                  => array(
			'type'            => 'textarea',
			'label'           => esc_html__( 'Custom Categories', 'supro' ),
			'section'         => 'blog_page',
			'default'         => '',
			'priority'        => 10,
			'description'     => esc_html__( 'Enter categories slug you want to display. Each slug is separated by comma character ",". If empty, it will display default', 'supro' ),
			'active_callback' => array(
				array(
					'setting'  => 'blog_cat_filter',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		// Single Posts
		'single_post_layout'               => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Single Post Layout', 'supro' ),
			'section'     => 'single_post',
			'default'     => 'sidebar-content',
			'priority'    => 5,
			'description' => esc_html__( 'Select default sidebar for the single post page.', 'supro' ),
			'choices'     => array(
				'content-sidebar' => esc_html__( 'Right Sidebar', 'supro' ),
				'sidebar-content' => esc_html__( 'Left Sidebar', 'supro' ),
				'full-content'    => esc_html__( 'Full Content', 'supro' ),
			),
		),
		'post_entry_meta'                  => array(
			'type'     => 'multicheck',
			'label'    => esc_html__( 'Entry Meta', 'supro' ),
			'section'  => 'single_post',
			'default'  => array( 'author', 'scat', 'date' ),
			'choices'  => array(
				'scat'   => esc_html__( 'Category', 'supro' ),
				'author' => esc_html__( 'Author', 'supro' ),
				'date'   => esc_html__( 'Date', 'supro' ),
			),
			'priority' => 10,
		),
		'post_custom_field_1'              => array(
			'type'    => 'custom',
			'section' => 'single_post',
			'default' => '<hr/>',
		),

		'show_post_social_share'           => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show Socials Share', 'supro' ),
			'description' => esc_html__( 'Check this option to show socials share in the single post page.', 'supro' ),
			'section'     => 'single_post',
			'default'     => 0,
			'priority'    => 10,
		),

		'post_socials_share'               => array(
			'type'            => 'multicheck',
			'label'           => esc_html__( 'Socials Share', 'supro' ),
			'section'         => 'single_post',
			'default'         => array( 'facebook', 'twitter', 'google', 'tumblr' ),
			'choices'         => array(
				'facebook'  => esc_html__( 'Facebook', 'supro' ),
				'twitter'   => esc_html__( 'Twitter', 'supro' ),
				'google'    => esc_html__( 'Google Plus', 'supro' ),
				'tumblr'    => esc_html__( 'Tumblr', 'supro' ),
				'pinterest' => esc_html__( 'Pinterest', 'supro' ),
				'linkedin'  => esc_html__( 'Linkedin', 'supro' ),
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
		'show_author_box'                  => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show Author Box', 'supro' ),
			'section'  => 'single_post',
			'default'  => 1,
			'priority' => 10,
		),
		'post_custom_field_2'              => array(
			'type'    => 'custom',
			'section' => 'single_post',
			'default' => '<hr/>',
		),
		'related_posts'                    => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Related Posts', 'supro' ),
			'section'     => 'single_post',
			'description' => esc_html__( 'Check this option to show related posts in the single post page.', 'supro' ),
			'default'     => 1,
			'priority'    => 20,
		),
		'related_posts_title'              => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Related Posts Title', 'supro' ),
			'section'         => 'single_post',
			'default'         => esc_html__( 'You may also like', 'supro' ),
			'priority'        => 20,

			'active_callback' => array(
				array(
					'setting'  => 'related_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
		'related_posts_numbers'            => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Related Posts Numbers', 'supro' ),
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
		'catalog_custom'                   => array(
			'type'     => 'custom',
			'section'  => 'woocommerce_product_catalog',
			'default'  => '<hr>',
			'priority' => 70,
		),
		'catalog_layout'                   => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Catalog Layout', 'supro' ),
			'default'     => 'full-content',
			'section'     => 'woocommerce_product_catalog',
			'priority'    => 70,
			'description' => esc_html__( 'Select layout for catalog.', 'supro' ),
			'choices'     => array(
				'sidebar-content' => esc_html__( 'Left Sidebar', 'supro' ),
				'content-sidebar' => esc_html__( 'Right Sidebar', 'supro' ),
				'full-content'    => esc_html__( 'Full Content', 'supro' ),
			),
		),
		'catalog_full_width'               => array(
			'type'            => 'toggle',
			'label'           => esc_html__( 'Catalog Full Width', 'supro' ),
			'default'         => '0',
			'section'         => 'woocommerce_product_catalog',
			'priority'        => 70,
			'active_callback' => array(
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'sidebar-content', 'content-sidebar', 'full-content' ),
				),
			),
		),
		'shop_view'                        => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Catalog View', 'supro' ),
			'description'     => esc_html__( 'Select Catalog View', 'supro' ),
			'section'         => 'woocommerce_product_catalog',
			'priority'        => 70,
			'default'         => 'grid',
			'choices'         => array(
				'grid' => esc_html__( 'Grid', 'supro' ),
				'list' => esc_html__( 'List', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'sidebar-content', 'content-sidebar', 'full-content' ),
				),
			),
		),
		'catalog_filter_mobile'            => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Filter Mobile Sidebar', 'supro' ),
			'default'     => '0',
			'section'     => 'woocommerce_product_catalog',
			'priority'    => 70,
			'description' => esc_html__( 'The Catalog filter display as sidebar', 'supro' ),
		),
		'product_attribute'                => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Product Attribute', 'supro' ),
			'section'     => 'woocommerce_product_catalog',
			'default'     => 'none',
			'priority'    => 20,
			'choices'     => supro_product_attributes(),
			'description' => esc_html__( 'Show product attribute for each item listed under the item name.', 'supro' ),
		),
		'catalog_page_header_custom'       => array(
			'type'            => 'custom',
			'section'         => 'woocommerce_product_catalog',
			'default'         => '<hr>',
			'priority'        => 70,
			'active_callback' => array(
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'sidebar-content', 'content-sidebar', 'full-content' ),
				),
			),
		),
		// Catalog Page Header
		'catalog_page_header'              => array(
			'type'            => 'toggle',
			'default'         => 1,
			'label'           => esc_html__( 'Enable Page Header', 'supro' ),
			'section'         => 'woocommerce_product_catalog',
			'description'     => esc_html__( 'Enable to show a page header for catalog page below the site header', 'supro' ),
			'priority'        => 70,
			'active_callback' => array(
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'sidebar-content', 'content-sidebar', 'full-content' ),
				),
			),
		),
		'catalog_page_header_breadcrumbs'  => array(
			'type'            => 'toggle',
			'default'         => 1,
			'label'           => esc_html__( 'Enable Breadcrumbs', 'supro' ),
			'section'         => 'woocommerce_product_catalog',
			'description'     => esc_html__( 'Enable to show a breadcrumbs for catalog page below the site header', 'supro' ),
			'priority'        => 70,
			'active_callback' => array(
				array(
					'setting'  => 'catalog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'sidebar-content', 'content-sidebar', 'full-content' ),
				),
			),
		),
		'catalog_page_header_layout'       => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Page Header Layout', 'supro' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => '1',
			'priority'        => 70,
			'choices'         => array(
				'1' => esc_html__( 'Layout 1', 'supro' ),
				'2' => esc_html__( 'Layout 2', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'catalog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'sidebar-content', 'content-sidebar', 'full-content' ),
				),
			),
		),
		'shop_toolbar'                     => array(
			'type'            => 'multicheck',
			'label'           => esc_html__( 'Shop Toolbar', 'supro' ),
			'section'         => 'woocommerce_product_catalog',
			'default'         => array( 'result', 'sort_by', 'shop_view' ),
			'priority'        => 70,
			'choices'         => array(
				'result'    => esc_html__( 'Result', 'supro' ),
				'filter'    => esc_html__( 'Filter', 'supro' ),
				'sort_by'   => esc_html__( 'Sort By', 'supro' ),
				'shop_view' => esc_html__( 'Shop View', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'catalog_page_header',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'catalog_layout',
					'operator' => 'in',
					'value'    => array( 'sidebar-content', 'content-sidebar', 'full-content' ),
				),
			),
			'description'     => esc_html__( 'Select which elements you want to show on shop toolbar', 'supro' ),
		),
		'added_to_cart_notice_custom'      => array(
			'type'     => 'custom',
			'section'  => 'woocommerce_product_catalog',
			'default'  => '<hr>',
			'priority' => 70,
		),

		'added_to_cart_notice'             => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Added to Cart Notification', 'supro' ),
			'description' => esc_html__( 'Display a notification when a product is added to cart', 'supro' ),
			'section'     => 'woocommerce_product_catalog',
			'priority'    => 70,
			'default'     => 1,
		),
		'cart_notice_auto_hide'            => array(
			'type'        => 'number',
			'label'       => esc_html__( 'Cart Notification Auto Hide', 'supro' ),
			'description' => esc_html__( 'How many seconds you want to hide the notification.', 'supro' ),
			'section'     => 'woocommerce_product_catalog',
			'priority'    => 70,
			'default'     => 3,
		),
		'catalog_ajax_filter_custom'       => array(
			'type'     => 'custom',
			'section'  => 'woocommerce_product_catalog',
			'default'  => '<hr>',
			'priority' => 70,
		),
		'catalog_ajax_filter'              => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Ajax For Filtering', 'supro' ),
			'section'     => 'woocommerce_product_catalog',
			'description' => esc_html__( 'Check this option to use ajax for filtering in the catalog page.', 'supro' ),
			'default'     => 1,
			'priority'    => 70
		),
		'disable_secondary_thumb'          => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Disable Secondary Product Thumbnail', 'supro' ),
			'section'     => 'woocommerce_product_catalog',
			'default'     => 0,
			'priority'    => 70,
			'description' => esc_html__( 'Check this option to disable secondary product thumbnail when hover over the main product image.', 'supro' ),
		),
		'shop_nav_type'                    => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Type of Navigation', 'supro' ),
			'section'  => 'woocommerce_product_catalog',
			'default'  => 'numbers',
			'priority' => 90,
			'choices'  => array(
				'numbers'  => esc_html__( 'Page Numbers', 'supro' ),
				'ajax'     => esc_html__( 'Ajax Loading', 'supro' ),
				'infinite' => esc_html__( 'Infinite Scroll', 'supro' ),
			),
		),

		//Badge
		'show_badges'                      => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show Badges', 'supro' ),
			'section'     => 'shop_badge',
			'default'     => 1,
			'priority'    => 20,
			'description' => esc_html__( 'Check this to show badges on every products.', 'supro' ),
		),
		'badges'                           => array(
			'type'            => 'multicheck',
			'label'           => esc_html__( 'Badges', 'supro' ),
			'section'         => 'shop_badge',
			'default'         => array( 'hot', 'new', 'sale', 'outofstock' ),
			'priority'        => 20,
			'choices'         => array(
				'hot'        => esc_html__( 'Hot', 'supro' ),
				'new'        => esc_html__( 'New', 'supro' ),
				'sale'       => esc_html__( 'Sale', 'supro' ),
				'outofstock' => esc_html__( 'Out Of Stock', 'supro' ),
			),
			'description'     => esc_html__( 'Select which badges you want to show', 'supro' ),
			'active_callback' => array(
				array(
					'setting'  => 'show_badges',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'sale_text'                        => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Custom Sale Text', 'supro' ),
			'section'         => 'shop_badge',
			'default'         => 'Sale',
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
					'value'    => 'sale',
				),
			),
		),
		'hot_text'                         => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Custom Hot Text', 'supro' ),
			'section'         => 'shop_badge',
			'default'         => 'Hot',
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
					'value'    => 'hot',
				),
			),
		),
		'outofstock_text'                  => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Custom Out Of Stock Text', 'supro' ),
			'section'         => 'shop_badge',
			'default'         => 'Out Of Stock',
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
		'new_text'                         => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Custom New Text', 'supro' ),
			'section'         => 'shop_badge',
			'default'         => 'New',
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
		'product_newness'                  => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Product Newness', 'supro' ),
			'section'         => 'shop_badge',
			'default'         => 3,
			'priority'        => 20,
			'description'     => esc_html__( 'Display the "New" badge for how many days?', 'supro' ),
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
		// Single Product
		'single_product_layout'            => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Single Product Layout', 'supro' ),
			'section'  => 'single_product',
			'default'  => '1',
			'priority' => 10,
			'choices'  => array(
				'1' => esc_html__( 'Layout 1', 'supro' ),
				'2' => esc_html__( 'Layout 2', 'supro' ),
				'3' => esc_html__( 'Layout 3', 'supro' ),
				'4' => esc_html__( 'Layout 4', 'supro' ),
				'5' => esc_html__( 'Layout 5', 'supro' ),
				'6' => esc_html__( 'Layout 6', 'supro' ),
			),
		),
		'single_product_sidebar'           => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Single Product Sidebar', 'supro' ),
			'section'         => 'single_product',
			'default'         => 'full-content',
			'priority'        => 10,
			'choices'         => array(
				'sidebar-content' => esc_html__( 'Left Sidebar', 'supro' ),
				'content-sidebar' => esc_html__( 'Right Sidebar', 'supro' ),
				'full-content'    => esc_html__( 'Full Content', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'single_product_layout',
					'operator' => '==',
					'value'    => '1',
				),
			),
		),
		'single_product_background_color'  => array(
			'type'            => 'color',
			'label'           => esc_html__( 'Backgroubd Color', 'supro' ),
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
		'product_add_to_cart_ajax'         => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Add to cart with AJAX', 'supro' ),
			'section'     => 'product_page',
			'default'     => 1,
			'priority'    => 40,
			'description' => esc_html__( 'Check this option to enable add to cart with AJAX on the product page.', 'supro' ),
		),
		'product_zoom'                     => array(
			'type'            => 'toggle',
			'label'           => esc_html__( 'Product Zoom', 'supro' ),
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
		'product_images_lightbox'          => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Product Images Gallery', 'supro' ),
			'section'     => 'single_product',
			'default'     => 1,
			'description' => esc_html__( 'Check this option to open product gallery images in a lightbox', 'supro' ),
			'priority'    => 10,
		),
		'show_product_socials'             => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show Product Socials', 'supro' ),
			'section'  => 'single_product',
			'default'  => 1,
			'priority' => 10,
		),
		'single_product_socials_share'     => array(
			'type'            => 'multicheck',
			'label'           => esc_html__( 'Socials Share', 'supro' ),
			'section'         => 'single_product',
			'default'         => array( 'facebook', 'twitter', 'pinterest' ),
			'choices'         => array(
				'facebook'  => esc_html__( 'Facebook', 'supro' ),
				'twitter'   => esc_html__( 'Twitter', 'supro' ),
				'google'    => esc_html__( 'Google Plus', 'supro' ),
				'tumblr'    => esc_html__( 'Tumblr', 'supro' ),
				'pinterest' => esc_html__( 'Pinterest', 'supro' ),
				'linkedin'  => esc_html__( 'Linkedin', 'supro' ),
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
		'show_product_meta'                => array(
			'type'        => 'multicheck',
			'label'       => esc_html__( 'Show Product Meta', 'supro' ),
			'section'     => 'single_product',
			'default'     => array( 'sku', 'categories', 'tags' ),
			'priority'    => 40,
			'choices'     => array(
				'sku'        => esc_html__( 'SKU', 'supro' ),
				'categories' => esc_html__( 'Categories', 'supro' ),
				'tags'       => esc_html__( 'Tags', 'supro' ),
			),
			'description' => esc_html__( 'Select which product meta you want to show in single product page', 'supro' ),
		),
		'single_product_toolbar'           => array(
			'type'        => 'multicheck',
			'label'       => esc_html__( 'Product Toolbar', 'supro' ),
			'section'     => 'single_product',
			'default'     => array( 'breadcrumb', 'navigation' ),
			'priority'    => 40,
			'choices'     => array(
				'breadcrumb' => esc_html__( 'Breadcrumb', 'supro' ),
				'navigation' => esc_html__( 'Navigation', 'supro' ),
			),
			'description' => esc_html__( 'Select element you want to show on product toolbar in single product page', 'supro' ),
		),
		'product_related_custom'           => array(
			'type'     => 'custom',
			'section'  => 'single_product',
			'default'  => '<hr>',
			'priority' => 40,
		),
		'product_related'                  => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show Related Products', 'supro' ),
			'section'  => 'single_product',
			'default'  => 1,
			'priority' => 40,
		),
		'product_related_title'            => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Related Products Title', 'supro' ),
			'section'         => 'single_product',
			'default'         => esc_html__( 'Related products', 'supro' ),
			'priority'        => 40,
			'active_callback' => array(
				array(
					'setting'  => 'product_related',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'related_products_columns'         => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Related Products Columns', 'supro' ),
			'section'         => 'single_product',
			'default'         => '4',
			'priority'        => 40,
			'description'     => esc_html__( 'Specify how many columns of related products you want to show on single product page', 'supro' ),
			'choices'         => array(
				'3' => esc_html__( '3 Columns', 'supro' ),
				'4' => esc_html__( '4 Columns', 'supro' ),
				'5' => esc_html__( '5 Columns', 'supro' ),
				'6' => esc_html__( '6 Columns', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'product_related',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'related_products_numbers'         => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Related Products Numbers', 'supro' ),
			'section'         => 'single_product',
			'default'         => 4,
			'priority'        => 40,
			'description'     => esc_html__( 'Specify how many numbers of related products you want to show on single product page', 'supro' ),
			'active_callback' => array(
				array(
					'setting'  => 'product_related',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'product_upsells_custom'           => array(
			'type'     => 'custom',
			'section'  => 'single_product',
			'default'  => '<hr>',
			'priority' => 40,
		),
		'product_upsells'                  => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Show Up-sells Products', 'supro' ),
			'section'  => 'single_product',
			'default'  => 0,
			'priority' => 40,
		),
		'product_upsells_title'            => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Up-sells Products Title', 'supro' ),
			'section'         => 'single_product',
			'default'         => esc_html__( 'You may also like', 'supro' ),
			'priority'        => 40,
			'active_callback' => array(
				array(
					'setting'  => 'product_upsells',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'upsells_products_columns'         => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Up-sells Products Columns', 'supro' ),
			'section'         => 'single_product',
			'default'         => '4',
			'priority'        => 40,
			'description'     => esc_html__( 'Specify how many columns of up-sells products you want to show on single product page', 'supro' ),
			'choices'         => array(
				'3' => esc_html__( '3 Columns', 'supro' ),
				'4' => esc_html__( '4 Columns', 'supro' ),
				'5' => esc_html__( '5 Columns', 'supro' ),
				'6' => esc_html__( '6 Columns', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'product_upsells',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		'upsells_products_numbers'         => array(
			'type'            => 'number',
			'label'           => esc_html__( 'Up-sells Products Numbers', 'supro' ),
			'section'         => 'single_product',
			'default'         => 4,
			'priority'        => 40,
			'description'     => esc_html__( 'Specify how many numbers of up-sells products you want to show on single product page', 'supro' ),
			'active_callback' => array(
				array(
					'setting'  => 'product_upsells',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),

		// Portfolio Page Header
		'portfolio_page_header'            => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Enable Page Header', 'supro' ),
			'section'     => 'portfolio_page_header',
			'description' => esc_html__( 'Enable to show a page header for portfolio below the site header', 'supro' ),
			'default'     => 1,
			'priority'    => 10,
		),
		'portfolio_breadcrumb'             => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Enable Breadcrumb', 'supro' ),
			'section'     => 'portfolio_page_header',
			'description' => esc_html__( 'Enable to show a breadcrumb on page header', 'supro' ),
			'default'     => 1,
			'priority'    => 10,
		),
		'portfolio_page_header_text_color' => array(
			'type'    => 'select',
			'label'   => esc_html__( 'Page Header Text Color', 'supro' ),
			'section' => 'page_header',
			'default' => 'dark',
			'choices' => array(
				'dark'  => esc_html__( 'Dark', 'supro' ),
				'light' => esc_html__( 'Light', 'supro' ),
			),
		),
		'portfolio_page_header_background' => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Background Image', 'supro' ),
			'section'  => 'page_header',
			'default'  => '',
			'priority' => 20,
		),
		'portfolio_page_header_parallax'   => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Enable Parallax', 'supro' ),
			'section'  => 'page_header',
			'default'  => 1,
			'priority' => 20,
		),

		// Portfolio
		'portfolio_layout'                 => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Portfolio Layout', 'supro' ),
			'section'  => 'portfolio',
			'default'  => 'grid',
			'priority' => 10,
			'choices'  => array(
				'grid'     => esc_html__( 'Grid', 'supro' ),
				'masonry'  => esc_html__( 'Masonry', 'supro' ),
				'carousel' => esc_html__( 'Carousel', 'supro' ),
			),
		),

		'portfolio_category_filter'        => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Category Filter', 'supro' ),
			'description' => esc_html__( 'Check this option to display Category Filter in the portfolio page.', 'supro' ),
			'section'     => 'portfolio',
			'default'     => 1,
			'priority'    => 10,
		),

		'portfolio_nav_type'               => array(
			'type'            => 'radio',
			'label'           => esc_html__( 'Portfolio Navigation Type', 'supro' ),
			'section'         => 'portfolio',
			'default'         => 'ajax',
			'priority'        => 10,
			'choices'         => array(
				'ajax'    => esc_html__( 'Loading Ajax', 'supro' ),
				'numeric' => esc_html__( 'Numeric', 'supro' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_layout',
					'operator' => 'in',
					'value'    => array( 'grid', 'masonry' ),
				),
			),
		),

		'portfolio_text_color'             => array(
			'type'            => 'select',
			'label'           => esc_html__( 'Portfolio Text Color', 'supro' ),
			'section'         => 'portfolio',
			'default'         => 'dark',
			'choices'         => array(
				'dark'  => esc_html__( 'Dark', 'supro' ),
				'light' => esc_html__( 'Light', 'supro' ),
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
		'single_portfolio_show_socials'    => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show Socials Share', 'supro' ),
			'description' => esc_html__( 'Check this option to show socials share in the single portfolio page.', 'supro' ),
			'section'     => 'single_portfolio',
			'default'     => 0,
			'priority'    => 10,
		),
		'single_portfolio_socials'         => array(
			'type'            => 'repeater',
			'label'           => esc_html__( 'Socials', 'supro' ),
			'section'         => 'single_portfolio',
			'priority'        => 10,
			'default'         => array(
				array(
					'link_url' => 'https://facebook.com/supro',
				),
				array(
					'link_url' => 'https://twitter.com/supro',
				),
				array(
					'link_url' => 'https://plus.google.com/supro',
				),
				array(
					'link_url' => 'https://dribbble.com/',
				),
			),
			'fields'          => array(
				'link_url' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Social URL', 'supro' ),
					'description' => esc_html__( 'Enter the URL for this social', 'supro' ),
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
		'footer_newsletter'                => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Newsletter', 'supro' ),
			'section'  => 'footer_newsletter',
			'default'  => 0,
			'priority' => 10,
		),
		'footer_newsletter_home'           => array(
			'type'        => 'toggle',
			'label'       => esc_html__( 'Show on HomePage', 'supro' ),
			'section'     => 'footer_newsletter',
			'default'     => 1,
			'priority'    => 10,
			'description' => esc_html__( 'Just show newsletter on HomePage', 'supro' ),
		),
		'newsletter_style'                 => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Style', 'supro' ),
			'section'     => 'footer_newsletter',
			'default'     => 'space-between',
			'priority'    => 10,
			'choices'     => array(
				'space-between' => esc_html__( 'Space Between', 'supro' ),
				'center'        => esc_html__( 'Center', 'supro' ),
			),
			'description' => esc_html__( 'Select Style for Newsletter', 'supro' ),
		),
		'newsletter_shape'                 => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Shape', 'supro' ),
			'section'  => 'footer_newsletter',
			'default'  => 'square',
			'priority' => 10,
			'choices'  => array(
				'square' => esc_html__( 'Square', 'supro' ),
				'round'  => esc_html__( 'Round', 'supro' ),
			),
		),
		'newsletter_title'                 => array(
			'type'     => 'text',
			'label'    => esc_html__( 'Newsletter Title', 'supro' ),
			'section'  => 'footer_newsletter',
			'default'  => esc_html__( 'Keep Connected', 'supro' ),
			'priority' => 10,
		),
		'newsletter_desc'                  => array(
			'type'     => 'textarea',
			'label'    => esc_html__( 'Newsletter Description', 'supro' ),
			'section'  => 'footer_newsletter',
			'default'  => esc_html__( 'Get updates by subscribe our weekly newsletter', 'supro' ),
			'priority' => 10,
		),
		'newsletter_form'                  => array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Newsletter Form', 'supro' ),
			'section'     => 'footer_newsletter',
			'default'     => '',
			'priority'    => 10,
			'description' => esc_html__( 'Go to MailChimp for WP/Form to get shortcode', 'supro' ),
		),
		'newsletter_text_color'            => array(
			'type'     => 'color',
			'label'    => esc_html__( 'Color', 'supro' ),
			'default'  => '',
			'section'  => 'footer_newsletter',
			'priority' => 30,
		),
		'newsletter_background_color'      => array(
			'type'     => 'color',
			'label'    => esc_html__( 'Background Color', 'supro' ),
			'default'  => '',
			'section'  => 'footer_newsletter',
			'priority' => 30,
		),

		// Footer
		'footer_layout'                    => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Footer Layout', 'supro' ),
			'section'  => 'footer_layout',
			'default'  => '1',
			'priority' => 10,
			'choices'  => array(
				'1' => esc_html__( 'Layout 1', 'supro' ),
				'2' => esc_html__( 'Layout 2', 'supro' ),
				'3' => esc_html__( 'Layout 3', 'supro' ),
			),
		),
		'footer_skin'                      => array(
			'type'     => 'radio',
			'label'    => esc_html__( 'Footer Skin', 'supro' ),
			'section'  => 'footer_layout',
			'priority' => 10,
			'default'  => 'light',
			'choices'  => array(
				'light' => esc_html__( 'Light', 'supro' ),
				'dark'  => esc_html__( 'Dark', 'supro' ),
			),
		),
		'footer_background_color'          => array(
			'type'     => 'color',
			'label'    => esc_html__( 'Background Color', 'supro' ),
			'default'  => '',
			'section'  => 'footer_layout',
			'priority' => 10,
		),
		'footer_background_image'          => array(
			'type'     => 'image',
			'label'    => esc_html__( 'Background Image', 'supro' ),
			'default'  => '',
			'section'  => 'footer_layout',
			'priority' => 10,
		),
		'footer_background_horizontal'     => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Horizontal', 'supro' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''       => esc_html__( 'None', 'supro' ),
				'left'   => esc_html__( 'Left', 'supro' ),
				'center' => esc_html__( 'Center', 'supro' ),
				'right'  => esc_html__( 'Right', 'supro' ),
			),
		),
		'footer_background_vertical'       => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Vertical', 'supro' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''       => esc_html__( 'None', 'supro' ),
				'top'    => esc_html__( 'Top', 'supro' ),
				'center' => esc_html__( 'Center', 'supro' ),
				'bottom' => esc_html__( 'Bottom', 'supro' ),
			),
		),
		'footer_background_repeat'         => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Repeat', 'supro' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''          => esc_html__( 'None', 'supro' ),
				'no-repeat' => esc_html__( 'No Repeat', 'supro' ),
				'repeat'    => esc_html__( 'Repeat', 'supro' ),
				'repeat-y'  => esc_html__( 'Repeat Vertical', 'supro' ),
				'repeat-x'  => esc_html__( 'Repeat Horizontal', 'supro' ),
			),
		),
		'footer_background_attachment'     => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Attachment', 'supro' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''       => esc_html__( 'None', 'supro' ),
				'scroll' => esc_html__( 'Scroll', 'supro' ),
				'fixed'  => esc_html__( 'Fixed', 'supro' ),
			),
		),
		'footer_background_size'           => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Background Size', 'supro' ),
			'section'  => 'footer_layout',
			'default'  => '',
			'priority' => 10,
			'choices'  => array(
				''        => esc_html__( 'None', 'supro' ),
				'auto'    => esc_html__( 'Auto', 'supro' ),
				'cover'   => esc_html__( 'Cover', 'supro' ),
				'contain' => esc_html__( 'Contain', 'supro' ),
			),
		),

		// Footer Widgets

		'footer_widgets'                   => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Footer Widgets', 'supro' ),
			'section'  => 'footer_widgets',
			'default'  => 1,
			'priority' => 10,
		),
		'footer_widgets_columns'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Footer Widgets Columns', 'supro' ),
			'section'     => 'footer_widgets',
			'default'     => '5',
			'priority'    => 10,
			'choices'     => array(
				'1' => esc_html__( '1 Columns', 'supro' ),
				'2' => esc_html__( '2 Columns', 'supro' ),
				'3' => esc_html__( '3 Columns', 'supro' ),
				'4' => esc_html__( '4 Columns', 'supro' ),
				'5' => esc_html__( '5 Columns', 'supro' ),
			),
			'description' => esc_html__( 'Go to Appearance/Widgets/Footer Widget 1, 2, 3, 4, 5 to add widgets content.', 'supro' ),
		),

		// Footer Copyright

		'footer_copyright'                 => array(
			'type'     => 'toggle',
			'label'    => esc_html__( 'Footer Copyright', 'supro' ),
			'section'  => 'footer_copyright',
			'default'  => 1,
			'priority' => 10,
		),
		'footer_copyright_columns'         => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Footer Copyright Columns', 'supro' ),
			'section'     => 'footer_copyright',
			'default'     => '3',
			'priority'    => 10,
			'choices'     => array(
				'1' => esc_html__( '1 Columns', 'supro' ),
				'2' => esc_html__( '2 Columns', 'supro' ),
				'3' => esc_html__( '3 Columns', 'supro' ),
			),
			'description' => esc_html__( 'Go to Appearance/Widgets/Footer Copyright 1, 2, 3 to add widgets content.', 'supro' ),
		),
		'footer_copyright_menu_style'      => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Menu style', 'supro' ),
			'section'     => 'footer_copyright',
			'default'     => '1',
			'priority'    => 10,
			'choices'     => array(
				'1' => esc_html__( 'Capitalize', 'supro' ),
				'2' => esc_html__( 'Uppercase', 'supro' ),
			),
			'description' => esc_html__( 'Select text transform for menu on footer copyright', 'supro' ),
		),
		'footer_copyright_top_spacing'     => array(
			'type'        => 'number',
			'label'       => esc_html__( 'Top Spacing', 'supro' ),
			'description' => esc_html__( 'Adjust the top spacing.', 'supro' ),
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
		'footer_copyright_bottom_spacing'  => array(
			'type'        => 'number',
			'label'       => esc_html__( 'Bottom Spacing', 'supro' ),
			'description' => esc_html__( 'Adjust the bottom spacing.', 'supro' ),
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
	);

	$settings['panels']   = apply_filters( 'supro_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'supro_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'supro_customize_fields', $fields );

	return $settings;
}

$supro_customize = new Supro_Customize( supro_customize_settings() );