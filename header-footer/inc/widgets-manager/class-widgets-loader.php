<?php
/**
 * Widgets loader for Header Footer Elementor.
 *
 * @package     HFE
 * @author      HFE
 * @copyright   Copyright (c) 2018, HFE
 * @link        http://brainstormforce.com/
 * @since       HFE 1.2.0
 */

namespace THHF\WidgetsManager;

use Elementor\Plugin;
use Elementor\Controls_Manager;
defined( 'ABSPATH' ) or exit;
DEFINE('THHF_DUMMY_CONTENT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>');

/**
 * Set up Widgets Loader class
 */
class Widgets_Loader {

	/**
	 * Instance of Widgets_Loader.
	 *
	 * @since  1.2.0
	 * @var null
	 */
	private static $_instance = null;

	/**
	 * Get instance of Widgets_Loader
	 *
	 * @since  1.2.0
	 * @return Widgets_Loader
	 */
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Setup actions and filters.
	 *
	 * @since  1.2.0
	 */
	private function __construct() {
		// Register category.
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_category' ] );

		// Register widgets.
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Add svg support.
		add_filter( 'upload_mimes', [ $this, 'hfe_svg_mime_types' ] );

		// Refresh the cart fragments.
		if ( class_exists( 'woocommerce' ) ) {
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'init_cart' ], 10, 0 );
			//add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'wc_refresh_mini_cart_count' ] );
		}
                
                /** dynamic post/image background image **/
                $this->addPostImageToSectionWidget();
                $this->renderDynamicImage();
    }

    private function renderDynamicImage() {
        add_action('elementor/frontend/section/before_render', function (\Elementor\Element_Base $element) {

            //check if the custom image is set, if yes, then override the existing image
            if ($element->get_settings('th_dynamic_image')) {
                //check if the featured image exists for this product/post
                $imageURL = '';
                if (has_post_thumbnail()) {
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail');
                    if (count($image)) {
                        $imageURL = $image[0];
                    }
                }

                if (!empty($imageURL)) {
                    if ('yes' === $element->get_settings_for_display('th_section_parallax')) {
                        $element->set_render_attribute('_wrapper', 'data-image-src', $imageURL);
                    } else {
                        echo '<style>body .elementor-element.elementor-element-' . $element->get_id() . ':not(.elementor-motion-effects-element-type-background){'
                        . 'background-image: url("' . $imageURL . '")!important;'
                        . '}</style>';
                    }
                }
            }
        }, 10, 2);
    }

    private function addPostImageToSectionWidget() {
        add_action('elementor/element/section/section_background/before_section_end', function ($element, $args) {
            $element->add_control(
                    'th_dynamic_image',
                    [
                        'label' => __('Use Featured Image', 'th-widget-pack'),
                        'type' => Controls_Manager::SWITCHER,
                        'description' => 'Replace Image above with the Featured Image if one exists for the current post or product.',
                        'label_on' => __('Yes', 'header-footer-elementor'),
                        'label_off' => __('No', 'header-footer-elementor'),
                        'return_value' => 'yes',
                        'default' => '',
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'background_background',
                                    'operator' => '==',
                                    'value' => 'classic',
                                ],
                            ],
                        ],
                    ]
            );
        }, 10, 2);
    }

    /**
	 * Returns Script array.
	 *
	 * @return array()
	 * @since 1.3.0
	 */
	public static function get_widget_script() {
		$js_files = [
			'thhf-frontend-js' => [
				'path'      => 'header-footer/inc/js/frontend.js',
				'dep'       => [ 'jquery', 'elementor-waypoints' ],
				'in_footer' => true,
			],
		];

		return $js_files;
	}

	/**
	 * Returns Script array.
	 *
	 * @return array()
	 * @since 1.3.0
	 */
	public static function get_widget_list() {
		$widget_list = [
			'retina',
			'copyright',
			'copyright-shortcode',
			'navigation-menu',
			'menu-walker',
			'site-title',
			'page-title',
			'site-tagline',
			'site-logo',
			'cart',
			'search-button',
                        'post-title',
                        'post-content',
                        'post-navigation',
                        'post-comments',
                        'post-image',
                        'post-media',
                        'post-info',
                        'product-content',
                        'product-cart',
                        'product-images',
                        'product-page',
		];

		return $widget_list;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function include_widgets_files() {
		$js_files    = $this->get_widget_script();
		$widget_list = $this->get_widget_list();

		if ( ! empty( $widget_list ) ) {
			foreach ( $widget_list as $handle => $data ) {
				require_once THEMO_PATH . 'header-footer/inc/widgets-manager/widgets/class-' . $data . '.php';
			}
		}

		if ( ! empty( $js_files ) ) {
			foreach ( $js_files as $handle => $data ) {
				wp_enqueue_script( $handle, THEMO_URL . $data['path'], $data['dep'], THEMO_VERSION, $data['in_footer'] );
			}
		}

		// Emqueue the widgets style.
		wp_enqueue_style( 'thhf-widgets-style', THEMO_URL . 'header-footer/inc/widgets-css/frontend.css', [], THEMO_VERSION );
	}

	/**
	 * Provide the SVG support for Retina Logo widget.
	 *
	 * @param array $mimes which return mime type.
	 *
	 * @since  1.2.0
	 * @return $mimes.
	 */
	public function hfe_svg_mime_types( $mimes ) {
		// New allowed mime types.
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	/**
	 * Register Category
	 *
	 * @since 1.2.0
	 * @param object $this_cat class.
	 */
	public function register_widget_category( $this_cat ) {
            
                $template = wp_get_theme()->get_template();
                $arr = ['bellevue', 'stratus'];

                if(in_array($template, $arr)){
                    $tempName = ucfirst($template);
                }
                else {
                   $tempName = 'Themovation'; 
                }
            

		$this_cat->add_category(
			'themo-single',
			[
				'title' => $tempName." ".__( 'Single', 'th-widget-pack' ),
				'icon'  => 'eicon-font',
			]
		);
                $this_cat->add_category(
			'themo-woocommerce',
			[
				'title' => $tempName." ".__( 'Woocommerce', 'th-widget-pack' ),
				'icon'  => 'eicon-font',
			]
		);

		return $this_cat;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files.
		$this->include_widgets_files();
		// Register Widgets.
        if('stratus' == THEMO_CURRENT_THEME || 'bellevue' == THEMO_CURRENT_THEME || 'entrepreneur' == THEMO_CURRENT_THEME) {
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Retina());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Copyright());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Navigation_Menu());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Page_Title());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Site_Title());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Site_Tagline());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Site_Logo());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Search_Button());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Post_Title());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Post_Content());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Post_Comments());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Post_Image());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Post_Media());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Post_Info());
            Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Post_Navigation());

            if (class_exists('woocommerce')) {
                Plugin:: instance()->widgets_manager->register_widget_type(new Widgets\Cart());
                Plugin:: instance()->widgets_manager->register_widget_type(new Widgets\Product_Content());
                Plugin:: instance()->widgets_manager->register_widget_type(new Widgets\Product_Cart());
                Plugin:: instance()->widgets_manager->register_widget_type(new Widgets\Product_Images());
                Plugin:: instance()->widgets_manager->register_widget_type(new Widgets\Product_Page());
            }
        }

	}

	/**
	 * Initialize the cart.
	 *
	 * @since 1.5.0
	 * @access public
	 */
	public function init_cart() {
		$has_cart = is_a( WC()->cart, 'WC_Cart' );

		if ( ! $has_cart ) {
			$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
			WC()->session  = new $session_class();
			WC()->session->init();
			WC()->customer = new \WC_Customer( get_current_user_id(), true );
		}
	}

	/**
	 * Cart Fragments.
	 *
	 * Refresh the cart fragments.
	 *
	 * @since 1.5.0
	 * @param array $fragments Array of fragments.
	 * @access public
	 */
	public function wc_refresh_mini_cart_count( $fragments ) {

		$has_cart = is_a( WC()->cart, 'WC_Cart' );
		if ( ! $has_cart ) {
			return $fragments;
		}

		ob_start();

		include THEMO_PATH . 'header-footer/inc/widgets-manager/widgets/class-cart.php';

		$cart_type = get_option( 'hfe_cart_widget_type' );

		\THHF\WidgetsManager\Widgets\Cart::get_cart_link( $cart_type );

		$fragments['body:not(.elementor-editor-active) a.hfe-cart-container'] = ob_get_clean();

		return $fragments;
	}
}

/**
 * Initiate the class.
 */
Widgets_Loader::instance();
