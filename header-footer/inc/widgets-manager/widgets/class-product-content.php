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
 * HFE Product Content widget
 *
 * HFE widget for Product Content.
 *
 * @since 1.3.0
 */
class Product_Content extends Widget_Base {

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
        return 'thhf-product-content';
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
        return __('Product Content', 'header-footer-elementor');
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
     * Register Product Content controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_product_content_controls();
        $this->register_product_content_style_controls();
    }

    /**
     * Register Product Content General Controls.
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
                        '{{WRAPPER}} .hfe-product-content-wrapper .product_title' => 'display: none!important;',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Product Content Style Controls.
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
        if ('elementor-thhf' == get_post_type()) {
            $content = THHF_DUMMY_CONTENT;
        } else if (get_post_type() == 'product') {
            $productId = get_the_ID();

            $shortCode = '[product_page id="' . $productId . '"]';
            $content = do_shortcode($shortCode);
        }
        ?>		
        <div class="hfe-product-content hfe-product-content-wrapper">
            <?php echo $content; ?>
        </div>
        <?php
    }

}
