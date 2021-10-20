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
        return ['themo-elements'];
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
                'class',
                [
                    'label' => __('Class', 'header-footer-elementor'),
                    'type' => Controls_Manager::TEXT,
                ]
        );

        $this->add_control(
                'quantity',
                [
                    'label' => __('Quantity', 'header-footer-elementor'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 999,
                    'step' => 1,
                    'default' => 1,
                ]
        );
        $this->add_control(
                'border_type',
                [
                    'label' => _x('Border Type', 'Border Control', 'elementor'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => esc_html__('None', 'elementor'),
                        'solid' => _x('Solid', 'Border Control', 'elementor'),
                        'double' => _x('Double', 'Border Control', 'elementor'),
                        'dotted' => _x('Dotted', 'Border Control', 'elementor'),
                        'dashed' => _x('Dashed', 'Border Control', 'elementor'),
                        'groove' => _x('Groove', 'Border Control', 'elementor'),
                    ],
                ]
        );
        $this->add_control(
                'border_width',
                [
                    'label' => _x('Border Width', 'Border Control', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 50,
                        ],
                    ],
                    'default' => [
                        'size' => 0,
                        'unit' => 'px',
                    ],
                    'condition' => [
                        'border_type!' => '',
                    ],
                ]
        );
        $this->add_control(
                'border_color',
                [
                    'label' => __('Border Color', 'header-footer-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ccc',
                    'condition' => [
                        'border_type!' => '',
                    ],
                ]
        );

        $this->add_control(
                'padding',
                [
                    'label' => __('Padding', 'header-footer-elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 10,
                        'unit' => 'px',
                    ],
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

        $settings = $this->get_settings_for_display();

        if ('elementor-thhf' == get_post_type()) {
            $content = 'Product Cart';
        } else if (get_post_type() == 'product') {
            $productId = get_the_ID();
            $code[] = 'id="' . $productId . '"';
            $style = [];
            if (isset($settings['quantity'])) {
                $code[] = 'quantity="' . $settings['quantity'] . '"';
            }
            $code[] = 'show_price="' . (empty($settings['show_price']) ? 'FALSE' : 'TRUE') . '"';

            if (isset($settings['class'])) {
                $code[] = 'class="' . $settings['class'] . '"';
            }
            if (isset($settings['border_type']) && !empty($settings['border_type'])) {
                if (isset($settings['border_width']) && !empty($settings['border_width']['size'])) {
                    $style[] = 'border:' . $settings['border_width']['size'] . $settings['border_width']['unit'] . ' ' . $settings['border_type'];
//                    $sidesArr = ['left', 'right', 'top', 'bottom'];
//                    foreach ($sidesArr as $side) {
//                        if (isset($settings['border_width'][$side])) {
//                            $style[] = 'padding-' . $side . ':' . $settings['border_width'][$side] . $settings['border_width']['unit'];
//                        }
//                    }
                }
            }
            if (isset($settings['padding']) && !empty($settings['padding']['size'])) {
                $style[] = 'padding:' . $settings['padding']['size'] . $settings['padding']['unit'];
            }
            if (isset($settings['border_color']) && !empty($settings['border_color'])) {
                $style[] = 'border-color:' . $settings['border_color'];
            }

            if (count($style)) {
                $code[] = 'style="' . implode(";", $style) . ';"';
            }


            $string = implode(" ", $code);
            $shortCode = '[add_to_cart  ' . $string . ']';
            $content = do_shortcode($shortCode);
        }
        ?>		
        <div class="hfe-product-cart hfe-product-cart-wrapper">
            <?php echo $content; ?>
        </div>
        <?php
    }

}
