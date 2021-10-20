<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Post Media widget
 *
 * HFE widget for Post Media.
 *
 * @since 1.3.0
 */
class Post_Media extends Widget_Base {

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
        return 'thhf-post-media';
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
        return __('Post Media', 'header-footer-elementor');
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
     * Register Post Media controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_post_media_controls();
        $this->register_post_media_style_controls();
    }

    /**
     * Register Post Media General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_post_media_controls() {
        $this->start_controls_section(
                'section_general_fields',
                [
                    'label' => __('Media', 'header-footer-elementor'),
                ]
        );
        $this->add_control(
                'media_type',
                [
                    'label' => __('Meida Type', 'header-footer-elementor'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        '' => __('None', 'header-footer-elementor'),
                        'gallery' => __('Gallery', 'header-footer-elementor'),
                        'video' => __('Video', 'header-footer-elementor'),
                        'audio' => __('Audio', 'header-footer-elementor'),
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
                            'title' => __('Left', 'header-footer-elementor'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'header-footer-elementor'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', 'header-footer-elementor'),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __('Justified', 'header-footer-elementor'),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-media-wrapper' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Post Media Style Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_post_media_style_controls() {
        
    }

   

    /**
     * Render post media widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $type = $settings['media_type'];
        $format = !empty($type) ? $type : 'standard';
//        $duumyContentArr = [
//            'standard' => THHF_DUMMY_CONTENT,
//            'audio' => '<p>No audio sample</p>',
//            'video' => '<div>' . wp_video_shortcode(['src' => 'https://www.youtube.com/watch?v=mWeWEhKe4Wc']) . '</div>',
//            'gallery' => '<p></p>',
//        ];
        ?>		
        <div class="hfe-post-media hfe-post-media-wrapper">
            <?php
            if ('elementor-thhf' == get_post_type()) {
                ?>
                <div><?php echo THHF_DUMMY_CONTENT ?></div>
            <?php } else {
                ?>
                <div <?php
                $th_post_classes = "mas-blog-post ";
                post_class(esc_attr($th_post_classes));
                ?>>
                        <?php get_template_part('templates/content', $format); ?>
                </div>
                <?php
            }
            ?>

        </div>
        <?php
    }

}
