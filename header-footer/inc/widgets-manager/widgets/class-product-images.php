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
 * HFE Product Images widget
 *
 * HFE widget for Product Images.
 *
 * @since 1.3.0
 */
class Product_Images extends Widget_Base {

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
        return 'thhf-product-images';
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
        return __('Product Images', 'header-footer-elementor');
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
        return 'thhf-eicon-post-images';
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
     * Register Product Images controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_product_images_controls();
    }

    /**
     * Register Product Images General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_product_images_controls() {
        $this->start_controls_section(
                'section_general_fields',
                [
                    'label' => __('Content', 'header-footer-elementor'),
                ]
        );
        $this->add_control(
                'section_main_image',
                [
                    'label' => __('Main Image', 'header-footer-elementor'),
                    'type' => Controls_Manager::HEADING,
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'main_border',
                    'label' => __('Border', 'header-footer-elementor'),
                    'selector' => '{{WRAPPER}} .hfe-product-images-wrapper .flex-active-slide img',
                ]
        );
        $this->add_responsive_control(
                'main_border_radius',
                [
                    'label' => __('Border Radius', 'header-footer-elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-active-slide img' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'spacing',
                [
                    'label' => __('Main image and Thumbnails distance', 'header-footer-elementor'),
                    'separator' => 'before',
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'section_thumbnails',
                [
                    'label' => __('Thumbnails', 'header-footer-elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );
        $this->add_responsive_control(
                'padding',
                [
                    'label' => __('Padding', 'header-footer-elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs li' => 'margin: 0; padding: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs' => 'width: auto; margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'thumbnail_border',
                    'label' => __('Border', 'header-footer-elementor'),
                    'selector' => '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs li img',
                ]
        );
        $this->add_responsive_control(
                'thumbnail_border_radius',
                [
                    'label' => __('Border Radius', 'header-footer-elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs li img' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        
        $this->end_controls_section();
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
            $content = $this->get_title();
        } else if (get_post_type() == 'product') {
            ob_start();
            wc_get_template('single-product/product-image.php');
            $content = ob_get_clean();
        }
        ?>		
        <div class="hfe-product-images hfe-product-images-wrapper">
        <?php echo $content; ?>
        </div>
            <?php
        }

    }
    