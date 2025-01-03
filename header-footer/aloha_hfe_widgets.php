<?php

use Elementor\Controls_Manager;

DEFINE('THHF_DUMMY_CONTENT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>');
require_once (ALOHA_HFE_PATH . '/inc/widgets-manager/class-widgets-loader.php');

//require HFE_DIR . 'inc/widgets-manager/modules-manager.php';

class Modules_Manager_ALOHA {

    var $widgets = [];

    public function __construct() {
        $this->widgets = [
            'retina',
            'copyright',
            'navigation-menu',
            'site-title',
            'page-title',
            'site-tagline',
            'site-logo',
            'cart',
            'search-button',
            'breadcrumbs-widget',
//            'post-info', we have post info too...
        ];

        $this->register_modulesX();
    }

    /** widgets setup
     * 
     */
    function register_modulesX() {

        //load js and css
//        parent::include_widgets_files();
        $manager = \Elementor\Plugin::$instance->widgets_manager;

        foreach ($this->widgets as $widget) {
            if ($widget === 'menu-walker') {
                continue;
            }

            if ($widget === 'cart' && !class_exists('woocommerce')) {
                continue;
            }

            //load our overrides
            if (is_file(ALOHA_HFE_OVERRIDES_PATH . '/widgets/class-' . $widget . '.php')) {
                

                require_once ALOHA_HFE_OVERRIDES_PATH . '/widgets/class-' . $widget . '.php';
               
                
                $className = '';
                $classNames = explode('-', str_replace('class-', '', $widget));

                if (count($classNames)) {
                    foreach ($classNames as $key => $classPart) {
                        if ($key > 0) {
                            $className .= '_';
                        }
                        $className .= ucfirst($classPart);
                    }
                }
                $classNameFinal = 'HFE\WidgetsManager\Widgets\Aloha_' . $className;

                $manager->register(new $classNameFinal());
                
                 if ('copyright' === $widget) {
                    require_once ALOHA_HFE_OVERRIDES_PATH . '/widgets/class-copyright-shortcode.php';
                    $copyright_shortcode = new HFE\WidgetsManager\Widgets\Aloha_Copyright_Shortcode();
                }
            }
        }

        $widget_list = [
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
        foreach ($widget_list as $widget) {
            require_once ALOHA_HFE_OVERRIDES_PATH . '/widgets/class-' . $widget . '.php';
        }


        $manager->register(new THHF\WidgetsManager\Widgets\Post_Title());
        $manager->register(new THHF\WidgetsManager\Widgets\Post_Content());
        $manager->register(new THHF\WidgetsManager\Widgets\Post_Comments());
        $manager->register(new THHF\WidgetsManager\Widgets\Post_Image());
        $manager->register(new THHF\WidgetsManager\Widgets\Post_Media());
        $manager->register(new THHF\WidgetsManager\Widgets\Post_Info());
        $manager->register(new THHF\WidgetsManager\Widgets\Post_Navigation());

        if (class_exists('woocommerce')) {
            $manager->register(new THHF\WidgetsManager\Widgets\Product_Content());
            $manager->register(new THHF\WidgetsManager\Widgets\Product_Cart());
            $manager->register(new THHF\WidgetsManager\Widgets\Product_Images());
            $manager->register(new THHF\WidgetsManager\Widgets\Product_Page());
        }
        // Emqueue the widgets style.
        $time = filemtime(ALOHA_HFE_OVERRIDES_PATH . '/css/frontend.css');
        wp_enqueue_style('aloha-hfe-widgets-style', ALOHA_HFE_OVERRIDES_URL . 'css/frontend.css', [], $time);

        //override some parts of the original js

        $searchReplace = [
            'navigation-menu.default' => 'thhf-navigation-menu.default', //we instantiate a subclass ourselves
            'hfe-search-button.default' => 'thhf-search-button.default',
            '.elementor-widget-hfe-nav-menu' => '.elementor-widget-thhf-nav-menu',
            '$scope.find( ".hfe-search-form__input" ).trigger( \'focus\' );' => '$scope.find( ".hfe-search-form-wrapper" ).addClass( "active" );',
            '$scope.find( ".hfe-search-button-wrapper" ).addClass( "hfe-input-focus" );' => '',
            '$scope.find( ".hfe-search-form__input" ).blur' => '$scope.find( ".hfe-search-overlay-close" ).on( "click", function( ){' .
            '$scope.find( ".hfe-search-form-wrapper" ).removeClass( "active" );' .
            '});$scope.find( ".hfe-search-form__input" ).blur'
        ];

        $contentsRaw = file_get_contents(ALOHA_HFE_PATH . '/inc/js/frontend.js');
        foreach ($searchReplace as $search => $replace) {
            $contentsRaw = str_replace($search, $replace, $contentsRaw);
        }

        $time2 = filemtime(ALOHA_HFE_OVERRIDES_PATH . '/js/frontend.js');
        wp_register_script('aloha-hfe-widgets-js', ALOHA_HFE_OVERRIDES_URL . 'js/frontend.js', ['jquery'], $time2, true);

        wp_add_inline_script('aloha-hfe-widgets-js', $contentsRaw, $position = 'after');
    }

}

class Widgets_Loader_ALOHA extends HFE\WidgetsManager\Widgets_Loader {

    private static $_instance = null;

    /**
     * Get instance of Widgets_Loader
     *
     * @since  1.2.0
     * @return Widgets_Loader
     */
    public static function instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct() {

        //copied from the HFE_HELPER class constructor, private methods
        spl_autoload_register([$this, 'autoload']);

        //require HFE_DIR . 'inc/widgets-manager/modules-manager.php';
        add_action('elementor/init', [$this, 'elementor_init']);

        // Register category.
        add_action('elementor/elements/categories_registered', [$this, 'register_widget_category']);

        // Register widgets script.
        add_action('elementor/frontend/after_register_scripts', [$this, 'register_widget_scripts']);

        // Add svg support.
        add_filter('upload_mimes', [$this, 'hfe_svg_mime_types']); // PHPCS:Ignore WordPressVIPMinimum.Hooks.RestrictedHooks.upload_mimes
        // Add filter to sanitize uploaded SVG files.
        add_filter('wp_handle_upload_prefilter', [$this, 'sanitize_uploaded_svg']);

        // Refresh the cart fragments.
        if (class_exists('woocommerce')) {

            add_filter('woocommerce_add_to_cart_fragments', [$this, 'wc_refresh_mini_cart_count']);
        }

        /** dynamic post/image background image * */
        $this->addPostImageToSectionWidget();
        $this->renderDynamicImage();
    }

    /**
     * Elementor Init.
     *
     * @since 0.0.1
     */
    public function elementor_init() {
        $this->modules_manager = new Modules_Manager_ALOHA();

//        $this->init_category();

        do_action('header_footer_elementor/init');    //phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
    }

    /**
     * Initialize the cart.
     *
     * @since 1.5.0
     * @access public
     */
    public function init_cart() {
        $has_cart = is_a(WC()->cart, 'WC_Cart');

        if (!$has_cart) {
            $session_class = apply_filters('woocommerce_session_handler', 'WC_Session_Handler');
            WC()->session = new $session_class();
            WC()->session->init();
            WC()->customer = new \WC_Customer(get_current_user_id(), true);
        }
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
                        'label' => __('Use Featured Image', ALOHA_DOMAIN),
                        'type' => Controls_Manager::SWITCHER,
                        'description' => 'Replace Image above with the Featured Image if one exists for the current post or product.',
                        'label_on' => __('Yes', ALOHA_DOMAIN),
                        'label_off' => __('No', ALOHA_DOMAIN),
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
     * Register Category
     *
     * @since 1.2.0
     * @param object $this_cat class.
     */
    function register_widget_category($this_cat) {

        $tempName = 'Themovation';

        $this_cat->add_category(
                'themo-single',
                [
                    'title' => $tempName . " " . __('Single', ALOHA_DOMAIN),
                    'icon' => 'eicon-font',
                ]
        );
        $this_cat->add_category(
                'themo-woocommerce',
                [
                    'title' => $tempName . " " . __('Woocommerce', ALOHA_DOMAIN),
                    'icon' => 'eicon-font',
                ]
        );
        $this_cat->add_category(
                'themo-mbhb',
                [
                    'title' => __('MotoPress Hotel Booking', ALOHA_DOMAIN),
                    'icon' => 'eicon-font',
                ]
        );

        return $this_cat;
    }

}

Widgets_Loader_ALOHA::instance();

add_action('elementor/element/thhf-search-button/section_general_fields/before_section_end', 'add_search_image');

// Add Parallax Control (Switch) to Section Element in the Editor.
function add_search_image(Elementor\Element_Base $element) {

    $element->add_control(
            'search_icon',
            [
                'label' => __('Icon', 'aloha-powerpack'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search',
                    'library' => 'solid',
                ],
                'condition' => [
                    'layout' => 'icon',
                ],
            ]
    );
}
