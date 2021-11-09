<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Product Page widget
 *
 * HFE widget for Product Page.
 *
 * @since 1.3.0
 */
class Product_Page extends Widget_Base {

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
        return 'thhf-product-page';
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
        return __('Product Page', 'header-footer-elementor');
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
        return 'eicon-wordpress';
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
     * Register Product Page controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_product_content_controls();
        $this->register_product_content_style_controls();
    }

    /**
     * Register Product Page General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_product_content_controls() {
        $this->start_controls_section(
                'section_general_fields',
                [
                    'label' => __('Content', 'header-footer-elementor'),
                ]
        );

        $this->add_control(
                'hide_title',
                [
                    'label' => __('Hide Title', 'header-footer-elementor'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'header-footer-elementor'),
                    'label_off' => __('No', 'header-footer-elementor'),
                    'return_value' => 'yes',
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-page-wrapper .product_title' => 'display: none!important;',
                    ],
                ]
        );
        $this->add_control(
                'hide_reviews',
                [
                    'label' => __('Hide Reviews', 'header-footer-elementor'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'header-footer-elementor'),
                    'label_off' => __('No', 'header-footer-elementor'),
                    'return_value' => 'yes',
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-page-wrapper #tab-reviews' => 'display: none!important;',
                    ],
                ]
        );
        $this->add_control(
                'hide_related',
                [
                    'label' => __('Hide Related Products', 'header-footer-elementor'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'header-footer-elementor'),
                    'label_off' => __('No', 'header-footer-elementor'),
                    'return_value' => 'yes',
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-page-wrapper .related.products' => 'display: none!important;',
                    ],
                ]
        );
        

        $this->end_controls_section();
    }

    /**
     * Register Product Page Style Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_product_content_style_controls() {
        
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
        $queryProducts = false;
        $productId = false;
        if ('elementor-thhf' == get_post_type()) {
            //get a product and use it
            $args = array(
                'posts_per_page' => 1,
                'orderby' => 'date',
                'post_type' => 'product',
                'meta_key' => '_price',
                'order' => 'DESC'
            );

            $queryProducts = get_posts($args);
            if (count($queryProducts)) {
                global $post;
                $post = $queryProducts[0];
                $productId = $post->ID;
                setup_postdata($post);
            } else {
                echo 'Please, have at least one product with content in woocommerce to see any output here.';
            }
            
            echo '<style>.hfe-product-page-wrapper .woocommerce-product-gallery{opacity: 1!important;}</style>';
        } else if (get_post_type() == 'product') {
            $productId = get_the_ID();
        }
        ?>

        <?php if ($productId): ?> 
            <div class="hfe-product-page hfe-product-page-wrapper">
                <?php
                $shortCode = '[product_page id="' . $productId . '"]';
                echo do_shortcode($shortCode);
                ?>
            </div>

        <?php endif; ?>
        <?php
        if ($queryProducts) {
            wp_reset_postdata();
        }
    }

}
