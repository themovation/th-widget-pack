<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Core\Schemes;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Product Cart widget
 *
 * HFE widget for Product Cart.
 *
 * @since 1.3.0
 */
class Product_Cart extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.3.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'thhf-product-cart';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.3.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Product Cart', 'header-footer-elementor');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.3.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'thhf-eicon-post-excerpt';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.3.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['themo-woocommerce'];
    }

    /**
     * Register Product Cart controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_product_cart_controls();
        $this->register_product_cart_style_controls();
    }

    public function loadTHMVAssets() {
        
    }

    /**
     * Register Product Cart General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_product_cart_controls() {
        $this->start_controls_section(
                'section_general_fields',
                [
                    'label' => __('Content', 'header-footer-elementor'),
                ]
        );
        $this->add_control(
                'section_box',
                [
                    'label' => __('Add to Cart', 'header-footer-elementor'),
                    'type' => Controls_Manager::HEADING,
                ]
        );

        $this->add_responsive_control(
                'align',
                [
                    'label' => __('Alignment', 'header-footer-elementor'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Start', 'header-footer-elementor'),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'header-footer-elementor'),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __('End', 'header-footer-elementor'),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor%s-align-',
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-cart-wrapper .add_to_cart_inline' => 'text-align: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'section_price',
                [
                    'label' => __('Price', 'header-footer-elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );
        $this->add_control(
                'show_price',
                [
                    'label' => __('Show Price', 'header-footer-elementor'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'header-footer-elementor'),
                    'label_off' => __('No', 'header-footer-elementor'),
                    'return_value' => 'yes',
                    'default' => '',
                ]
        );
        $this->add_control(
                'price_color',
                [
                    'label' => __('Color', 'header-footer-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-cart-wrapper .woocommerce-Price-amount' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'price_typography',
                    'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .hfe-product-cart-wrapper .woocommerce-Price-amount',
                    'condition' => [
                        'show_price!' => '',
                    ],
                ]
        );

        $this->add_control(
                'price_margin',
                [
                    'label' => __('Margin', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 50,
                        ],
                    ],
                    'default' => [
                        'size' => 5,
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-cart-wrapper p.price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_price!' => '',
                    ],
                ]
        );
        $this->end_controls_section();
    }

    /**
     * Register Product Cart Style Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_product_cart_style_controls() {
        
    }

    /**
     * Render post content widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function render() {


        $showPrice = $this->get_settings_for_display('show_price');
        $queryProducts = false;
        if ('elementor-thhf' == get_post_type()) {
            //get a product and use it
            $args = array(
                'posts_per_page' => 1,
                'orderby' => 'price',
                'post_type' => 'product',
                'meta_key' => '_price',
                'order' => 'desc'
            );

            $queryProducts = get_posts($args);
            if (count($queryProducts)) {
                global $post;
                $post = $queryProducts[0];
                setup_postdata($post);
            } else {
                echo 'Please, have at least one product with a price in woocommerce to see any output here.';
            }
        }

        if (get_post_type() == 'product') {
            global $product;
            $product = wc_get_product();
            
            ob_start();
            if ($showPrice):
                woocommerce_template_single_price();
            endif;
            woocommerce_template_single_add_to_cart();
            $content = ob_get_clean();
        }
        
        
        
        if ($queryProducts) {
            wp_reset_postdata();
        }
        ?>
        <style>.hfe-product-cart-wrapper .quantity{
                margin: 0 4px 0 0;
                display: inline-block;
            }</style>
        <div class="woocommerce hfe-product-cart hfe-product-cart-wrapper">
                <?php echo $content; ?>
        </div>
        <?php
    }

}
