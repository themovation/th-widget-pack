<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Schemes\Typography;
use Elementor\Scheme_Color;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Post Navigation widget
 *
 * HFE widget for Post Navigation.
 *
 * @since 1.3.0
 */
class Post_Navigation extends Widget_Base {

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
        return 'thhf-post-navigation';
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
        return __('Post Navigation', 'header-footer-elementor');
    }

    /**
    * get Plugin help URL
    * @return string help url
    */
    public function get_custom_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
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
        return ['themo-single'];
    }

    /**
     * Register Post Navigation controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_post_navigation_controls();
        $this->register_post_navigation_style_controls();
    }

    /**
     * Register Post Navigation General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_post_navigation_controls() {
        $this->start_controls_section(
                'section_general_fields',
                [
                    'label' => __('Navigation', 'header-footer-elementor'),
                ]
        );

        $this->add_control(
                'hide_title',
                [
                    'label' => __('Custom Labels', 'header-footer-elementor'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'header-footer-elementor'),
                    'label_off' => __('No', 'header-footer-elementor'),
                    'return_value' => 'yes',
                    'default' => '',
                ]
        );
        $this->add_control(
                'label_previous',
                [
                    'label' => __('Previous Label', 'header-footer-elementor'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Previous'),
                    'condition' => [
                        'hide_title!' => '',
                    ],
                ]
        );
        $this->add_control(
                'label_next',
                [
                    'label' => __('Next Label', 'header-footer-elementor'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Next'),
                    'condition' => [
                        'hide_title!' => '',
                    ],
                ]
        );
        $this->add_control(
                'stack_phone',
                [
                    'label' => __('Stack on mobile', 'header-footer-elementor'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'header-footer-elementor'),
                    'label_off' => __('No', 'header-footer-elementor'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->end_controls_section();
    }

    /**
     * Register Post Navigation Style Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_post_navigation_style_controls() {
        $this->start_controls_section(
                'section_style_navigation',
                [
                    'label' => __('Navigation', 'header-footer-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'navigation_typography',
                    'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .hfe-post-navigation-wrapper .hfe-post-navigation-inner a',
                ]
        );
        $this->add_control(
                'navigation_color',
                [
                    'label' => __('Color', 'header-footer-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-navigation-wrapper .hfe-post-navigation-inner a' => 'color: {{VALUE}};',
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
        $settings = $this->get_settings_for_display();
        $prev = isset($settings['label_previous']) ? $settings['label_previous'] : '%title';
        $next = isset($settings['label_next']) ? $settings['label_next'] : '%title';
        $prevText = '&laquo; ' . $prev;
        $nextText = $next . ' &raquo;';
        $classMobile = !empty($settings['stack_phone']) ? 'th-flex-phone-column' : 'th-justify-content-phone-between';
        ?>		
        <div class="hfe-post-navigation hfe-post-navigation-wrapper">
            <div class="th-d-flex th-align-items-phone-center <?php echo $classMobile?> th-justify-content-tablet-between">
                <div class="hfe-post-navigation-left hfe-post-navigation-inner">
                    <?php previous_post_link('%link', $prevText); ?>
                </div>
                <div class="hfe-post-navigation-right hfe-post-navigation-inner">
                    <?php next_post_link('%link', $nextText); ?>
                </div>
            </div>


        </div>
        <?php
    }

}
