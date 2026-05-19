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
 * HFE Post Content widget
 *
 * HFE widget for Post Content.
 *
 * @since 1.3.0
 */
class Post_Content extends Widget_Base {

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
        return 'thhf-post-content';
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
        return __('Post Content', ALOHA_DOMAIN);
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
        return ['themo-single'];
    }

    /**
     * Register Post Content controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_controls() {
        $this->register_content_post_content_controls();
        //$this->register_post_content_style_controls();
    }

    /**
     * Register Post Content General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_post_content_controls() {
        $this->start_controls_section(
                'section_general_fields',
                [
                    'label' => __('Content', ALOHA_DOMAIN),
                ]
        );

        $this->add_responsive_control(
                'align',
                [
                    'label' => __('Alignment', ALOHA_DOMAIN),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', ALOHA_DOMAIN),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', ALOHA_DOMAIN),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', ALOHA_DOMAIN),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __('Justified', ALOHA_DOMAIN),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-content-wrapper p' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Post Content Style Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_post_content_style_controls() {
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
                    'global' => [
			'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                    ],
                    'selector' => '{{WRAPPER}} .hfe-post-content p',
                ]
        );

        $this->add_control(
                'content_color',
                [
                    'label' => __('Color', ALOHA_DOMAIN),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
			'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-content p' => 'color: {{VALUE}};',
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
            $content = THHF_DUMMY_CONTENT;
        } else {
            ob_start();
            the_content();
            $content = ob_get_clean();
        }
        ?>		
        <div class="hfe-post-content hfe-post-content-wrapper">
            <?php echo $content; ?>
        </div>
        <?php
    }

}
