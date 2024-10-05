<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;


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
        return __('Product Content', ALOHA_DOMAIN);
    }

    /**
    * get Plugin help URL
    * @return string help url
    */
    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
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
        return 'th-editor-icon-text-align-justify';
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
    protected function register_controls() {
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
       
    }

    /**
     * Register Product Content Style Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_product_content_style_controls() {
        $this->start_controls_section(
                'section_content_typography',
                [
                    'label' => __('Title', ALOHA_DOMAIN),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .hfe-product-content-wrapper p',
                ]
        );

        $this->add_control(
                'content_color',
                [
                    'label' => __('Color', ALOHA_DOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-content-wrapper p' => 'color: {{VALUE}};',
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
        $queryProducts = false;
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
            if(count($queryProducts)){
                 global $post;
                 $post = $queryProducts[0];
                 setup_postdata($post);
            }
            else {
                echo 'Please, have at least one product with content in woocommerce to see any output here.';
            }
        }

        ?>		
        <div class="hfe-product-content hfe-product-content-wrapper">
            <?php  echo apply_filters( 'the_content', get_the_content() ); ?>
        </div>
        <?php
      if($queryProducts){
          wp_reset_postdata();
      }
       

    }

}
