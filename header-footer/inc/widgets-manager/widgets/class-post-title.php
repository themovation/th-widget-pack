<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Post Title widget
 *
 * HFE widget for Post Title.
 *
 * @since 1.3.0
 */
class Post_Title extends Widget_Base {

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
        return 'thhf-post-title';
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
        return __('Post Title', 'header-footer-elementor');
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
        return 'thhf-icon-post-title';
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
     * Register Post Title controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_post_title_controls();
        $this->register_post_title_style_controls();
    }

    /**
     * Register Post Title General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_post_title_controls() {
        $this->start_controls_section(
                'section_general_fields',
                [
                    'label' => __('Title', 'header-footer-elementor'),
                ]
        );

        $this->add_control(
                'post_custom_link',
                [
                    'label' => __('Link', 'header-footer-elementor'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'custom' => __('Custom URL', 'header-footer-elementor'),
                        'default' => __('Default', 'header-footer-elementor'),
                        'none' => __('None', 'header-footer-elementor'),
                    ],
                    'default' => 'none',
                ]
        );

        $this->add_control(
                'post_heading_link',
                [
                    'label' => __('Link', 'header-footer-elementor'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __('https://your-link.com', 'header-footer-elementor'),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => [
                        'url' => get_home_url(),
                    ],
                    'condition' => [
                        'post_custom_link' => 'custom',
                    ],
                ]
        );

        $this->add_control(
                'heading_tag',
                [
                    'label' => __('HTML Tag', 'header-footer-elementor'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => __('H1', 'header-footer-elementor'),
                        'h2' => __('H2', 'header-footer-elementor'),
                        'h3' => __('H3', 'header-footer-elementor'),
                        'h4' => __('H4', 'header-footer-elementor'),
                        'h5' => __('H5', 'header-footer-elementor'),
                        'h6' => __('H6', 'header-footer-elementor'),
                    ],
                    'default' => 'h1',
                ]
        );

        $this->add_control(
                'size',
                [
                    'label' => __('Size', 'header-footer-elementor'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'default' => __('Default', 'header-footer-elementor'),
                        'small' => __('Small', 'header-footer-elementor'),
                        'medium' => __('Medium', 'header-footer-elementor'),
                        'large' => __('Large', 'header-footer-elementor'),
                        'xl' => __('XL', 'header-footer-elementor'),
                        'xxl' => __('XXL', 'header-footer-elementor'),
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
                        '{{WRAPPER}} .hfe-post-title-wrapper' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Post Title Style Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_post_title_style_controls() {
        $this->start_controls_section(
                'section_title_typography',
                [
                    'label' => __('Title', 'header-footer-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .elementor-heading-title, {{WRAPPER}} .hfe-post-title a',
                ]
        );

        $this->add_control(
                'title_color',
                [
                    'label' => __('Color', 'header-footer-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-heading-title, {{WRAPPER}} .hfe-post-title a' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .hfe-post-title-icon i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .hfe-post-title-icon svg' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'title_shadow',
                    'selector' => '{{WRAPPER}} .elementor-heading-title',
                ]
        );

        $this->add_control(
                'blend_mode',
                [
                    'label' => __('Blend Mode', 'header-footer-elementor'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => __('Normal', 'header-footer-elementor'),
                        'multiply' => 'Multiply',
                        'screen' => 'Screen',
                        'overlay' => 'Overlay',
                        'darken' => 'Darken',
                        'lighten' => 'Lighten',
                        'color-dodge' => 'Color Dodge',
                        'saturation' => 'Saturation',
                        'color' => 'Color',
                        'difference' => 'Difference',
                        'exclusion' => 'Exclusion',
                        'hue' => 'Hue',
                        'luminosity' => 'Luminosity',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-heading-title' => 'mix-blend-mode: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Render post title widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('post_title', 'basic');

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $title = 'Post Title';
        } else {
            if (is_archive() || is_home()) {
                $title = wp_kses_post(get_the_archive_title());
            } else {
                $title = wp_kses_post(get_the_title());
            }
        }

        if (!empty($settings['post_heading_link']['url'])) {
            $this->add_render_attribute('url', 'href', $settings['post_heading_link']['url']);

            if ($settings['post_heading_link']['is_external']) {
                $this->add_render_attribute('url', 'target', '_blank');
            }

            if (!empty($settings['post_heading_link']['nofollow'])) {
                $this->add_render_attribute('url', 'rel', 'nofollow');
            }
            $link = $this->get_render_attribute_string('url');
        }
        ?>		
        <div class="hfe-post-title hfe-post-title-wrapper elementor-widget-heading">

            <?php
            $head_link_url = isset($settings['post_heading_link']['url']) ? $settings['post_heading_link']['url'] : '';
            $head_custom_link = isset($settings['post_custom_link']) ? $settings['post_custom_link'] : '';
            ?>
            <<?php echo wp_kses_post($settings['heading_tag']); ?> class="elementor-heading-title elementor-size-<?php echo $settings['size']; ?>">

            <?php if ('' != $head_link_url && 'custom' === $head_custom_link) { ?>

                <a <?php echo $link; ?> >
                <?php } elseif ('default' === $head_custom_link) { ?>
                    <a href="<?php echo wp_kses_post(get_permalink()); ?>">
                    <?php } ?>

                    <?php
                    echo $title;
                    ?>  

                    <?php if (( '' != $head_link_url && 'custom' === $head_custom_link ) || 'default' === $head_custom_link) { ?>
                    </a>
                <?php } ?>
                </<?php echo wp_kses_post($settings['heading_tag']); ?> > 

        </div>
        <?php
    }

    /**
     * Render post title output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * Remove this after Elementor v3.3.0
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _content_template() {
//		$this->content_template();
    }

}
