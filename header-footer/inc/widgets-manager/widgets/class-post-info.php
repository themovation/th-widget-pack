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
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Post Info widget
 *
 * HFE widget for Post Info.
 *
 * @since 1.3.0
 */
class Post_Info extends Widget_Base {

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
        return 'thhf-post-info';
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
        return __('Post Info', 'header-footer-elementor');
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
        return 'th-editor-icon-post-info';
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
     * Register Post Info controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_post_info_controls();
        $this->register_post_info_style_controls();
    }

    /**
     * Register Post Info General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_post_info_controls() {
        $this->start_controls_section(
                'section_general_fields',
                [
                    'label' => __('Info', 'header-footer-elementor'),
                ]
        );

        $listing = new Repeater();
        $listing->add_control(
                'type',
                [
                    'label' => __('Type', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'author',
                    'options' => [
                        'author' => __('Author', 'th-widget-pack'),
                        'date' => __('Date', 'th-widget-pack'),
                        'time' => __('Time', 'th-widget-pack'),
                        'comments' => __('Comments', 'th-widget-pack'),
                        'taxonomy' => __('Taxonomies', 'th-widget-pack'),
                    ],
                ]
        );
        $listing->add_control(
                'taxonomy',
                [
                    'label' => __('Taxonomy', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'default' => [],
                    'options' => $this->getTaxonomies(),
                    'condition' => [
                        'type' => 'taxonomy',
                    ],
                ]
        );
        $listing->add_control(
                'name_type',
                [
                    'label' => __('Name Type', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'nickname',
                    'options' => [
                        'nickname' => __('Nickname', 'th-widget-pack'),
                        'user_nicename' => __('Username', 'th-widget-pack'),
                        'display_name' => __('Display Name', 'th-widget-pack'),
                        'first_name' => __('First Name', 'th-widget-pack'),
                        'last_name' => __('Last Name', 'th-widget-pack'),
                        'full_name' => __('Full Name', 'th-widget-pack'),
                    ],
                    'condition' => [
                        'type' => 'author',
                    ],
                ]
        );

        $listing->add_control(
                'show_icon',
                [
                    'label' => __('Show Icon', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                ]
        );
        $listing->add_control(
                'show_avatar',
                [
                    'label' => __('Show Avatar', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'condition' => [
                        'show_icon' => 'yes',
                        'type' => 'author',
                    ],
                ]
        );
        $listing->add_control(
                'icon',
                [
                    'label' => __('Icon', 'th-widget-pack'),
                    'type' => Controls_Manager::ICONS,
                    'condition' => [
                        'show_icon' => 'yes',
                        'show_avatar' => '',
                    ],
                ]
        );
        $listing->add_control(
                'show_link_author',
                [
                    'label' => __('Show Link', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'condition' => [
                        'type' => 'author',
                    ],
                ]
        );
        $listing->add_control(
                'show_link_taxonomy',
                [
                    'label' => __('Show Link', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'condition' => [
                        'type' => 'taxonomy',
                    ],
                ]
        );
        $listing->add_control(
                'show_link_comments',
                [
                    'label' => __('Link to comments', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'condition' => [
                        'type' => 'comments',
                    ],
                ]
        );
        $listing->add_control(
                'text_before',
                [
                    'label' => __('Before', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                ]
        );
        $listing->add_control(
                'text_after',
                [
                    'label' => __('After', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                ]
        );
        $this->add_control(
                'info',
                [
                    'label' => __('', 'th-widget-pack'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $listing->get_controls(),
                    'title_field' => '<span style="text-transform: capitalize;">{{{ type }}}</span>',
                    'default' => [
                        [
                            'type' => 'author',
                            'icon' => [
                                'value' => 'th-trip travelpack-man-circle',
                                'library' => 'th-trip',
                            ]
                        ],
                        [
                            'type' => 'date',
                            'icon' => [
                                'value' => 'th-linea icon-basic-calendar',
                                'library' => 'th-linea',
                            ]
                        ],
                        [
                            'type' => 'time',
                            'icon' => [
                                'value' => 'th-trip travelpack-clock-time',
                                'library' => 'th-trip',
                            ]
                        ],
                        [
                            'type' => 'comments',
                            'icon' => [
                                'value' => 'th-linea icon-basic-message-multiple',
                                'library' => 'th-linea',
                            ]
                        ],
                    ],
                ]
        );
        $this->end_controls_section();
    }

    /**
     * Register Post Info Style Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_post_info_style_controls() {
        $this->start_controls_section(
                'section_generalpography',
                [
                    'label' => __('General', 'header-footer-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'element_spacing',
                [
                    'label' => __('Elements Spacing', 'th-widget-pack'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'default' => [
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-info-wrapper .info-item+.info-item' => 'padding-left: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );
        $this->add_responsive_control(
                'icon_spacing',
                [
                    'label' => __('Icon Spacing', 'th-widget-pack'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%'],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-info-wrapper .thmv-icon' => 'padding-right: {{SIZE}}{{UNIT}}',
                    ],
                    'default' => [
                        'size' => 10,
                    ],
                    'range' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ]
        );
        $this->add_responsive_control(
                'align',
                [
                    'label' => esc_html__('Alignment', 'elementor'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'elementor'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'elementor'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'elementor'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => '',
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'section_avatar_typography',
                [
                    'label' => __('Avatar', 'header-footer-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'avatar_width',
                [
                    'label' => __('Size', 'th-widget-pack'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'default' => [
                        'size' => 29,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-info-wrapper .info-item-type-author img' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                ]
        );
        $this->add_responsive_control(
                'avatar_border',
                [
                    'label' => __('Border Radius', 'th-widget-pack'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%'],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-info-wrapper .info-item-type-author img' => 'border-radius: {{SIZE}}{{UNIT}}',
                    ],
                    'default' => [
                        'size' => 50,
                    ],
                    'range' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
                'section_text_typography',
                [
                    'label' => __('Text', 'header-footer-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .hfe-post-info-wrapper .info-value *',
                ]
        );
        $this->add_control(
                'text_color',
                [
                    'label' => __('Text Color', 'header-footer-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-info-wrapper .info-value *' => 'color: {{VALUE}};',
                    ],
                ]
        );
        
        $this->end_controls_section();
        $this->start_controls_section(
                'section_before_typography',
                [
                    'label' => __('Before', 'header-footer-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'before_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .hfe-post-info-wrapper .text-before',
                ]
        );
        $this->add_control(
                'before_text_color',
                [
                    'label' => __('Text Color', 'header-footer-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-info-wrapper .text-before' => 'color: {{VALUE}};',
                    ],
                ]
        );
        
        $this->end_controls_section();
        $this->start_controls_section(
                'section_after_typography',
                [
                    'label' => __('After', 'header-footer-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'after_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .hfe-post-info-wrapper .text-after',
                ]
        );
        $this->add_control(
                'after_text_color',
                [
                    'label' => __('Text Color', 'header-footer-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-info-wrapper .text-after' => 'color: {{VALUE}};',
                    ],
                ]
        );
        
        $this->end_controls_section();
        $this->start_controls_section(
                'section_icon_typography',
                [
                    'label' => __('Icons', 'header-footer-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'icon_color',
                [
                    'label' => __('Icon Color', 'header-footer-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-info-wrapper .thmv-icon i' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __('Size', 'th-widget-pack'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-info-wrapper .thmv-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    'default' => [
                        'size' => 20,
                    ],
                    'range' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ]
        );
        $this->end_controls_section();
    }

    protected function getTaxonomies() {
        $taxonomies = get_taxonomies([
            'show_in_nav_menus' => true,
                ], 'objects');

        $options = [
            '' => __('Select', 'th-widget-pack'),
        ];

        foreach ($taxonomies as $taxonomy) {
            $options[$taxonomy->name] = $taxonomy->label;
        }

        return $options;
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
        $info = $this->get_settings('info');
        global $post;
        $postId = $post->ID;
        $author_id = $post->post_author;
        
        $class = '';
        $align_default = $this->get_settings('align') ? $this->get_settings('align') : '';
        $align_tablet = $this->get_settings('align_tablet') ? $this->get_settings('align_tablet') : $align_default;
        $align_mobile = $this->get_settings('align_mobile') ? $this->get_settings('align_mobile') : $align_tablet;
        if(!empty($align_default)){
            $class.=' th-justify-content-'.$align_default;
        }
        if(!empty($align_tablet)){
            $class.=' th-justify-content-tablet-'.$align_tablet;
        }
        if(!empty($align_mobile)){
            $class.=' th-justify-content-phone-'.$align_mobile;
        }
        ?>		
        <div class="hfe-post-info hfe-post-info-wrapper th-d-flex th-flex-wrap <?=$class?>">
            <?php
            foreach ($info as $item) {
                $link = $avatar = false;
                $termsList = [];
                $itemType = isset($item['type']) ? $item['type'] : false;
                $itemBefore = !empty($item['text_before']) ? $item['text_before'] : false;
                $itemAfter = !empty($item['text_after']) ? $item['text_after'] : false;
                if ($item['show_link_author'] || $item['show_link_comments']) {
                    if ($itemType === 'author') {
                        $link = get_author_posts_url($author_id);
                        if (!empty($item['show_avatar'])) {
                            $avatar = get_avatar_url($author_id);
                        }
                    }
                    if ($itemType === 'comments' && comments_open()) {
                        $link = get_comments_link();
                    }
                }

                if ($itemType === 'taxonomy') {
                    $taxonomy = $item['taxonomy'];
                    $terms = wp_get_post_terms($postId, $taxonomy);
                    foreach ($terms as $term) {
                        $temp = ['title' => $term->name];
                        if (!empty($item['show_link_taxonomy'])) {
                            $temp['url'] = get_term_link($term);
                        }
                        $termsList[] = $temp;
                    }
                }
                ?>
                <div class="info-item info-item-type-<?= $itemType ?> th-d-flex th-align-items-center">
                    <?php if (isset($item['icon'])): ?>
                        <div class="elementor-icon thmv-icon">
                            <?php
                            if ($link) : echo '<a class="th-d-flex" href="' . $link . '">';
                            endif;
                            ?>
                            <?php
                            if(!empty($item['show_icon'])){
               
                                if ($avatar) {

                                    echo '<img src="' . $avatar . '" alt="' . __('author image', 'th-widget-pack') . '">';
                                } else {
                                    if ($itemType === 'taxonomy' && !count($termsList)) {

                                    } else {
                                        Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'title' => '']);
                                    }
                                }
                            }
                            ?>
                            <?php
                            if ($link) : echo '</a>';
                            endif;
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($itemBefore)): ?>
                    <div class="text-before">
                        <?php echo str_replace(' ', '&nbsp;', $itemBefore)?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($itemType)): ?>
                        <div class="info-value">
                            <span>
                                <?php
                                if ($link) : echo '<a href="' . $link . '">';
                                endif;
                                ?>
                                <?php
                                switch ($itemType) {
                                    case 'author':
                                        global $post;
                                        $author_id = $post->post_author;
                                        $name_type = empty($item['name_type']) ? 'nickname' : $item['name_type'];
                                        if ($name_type === 'full_name') {
                                            $firstName = get_the_author_meta('first_name', $author_id);

                                            echo (!empty($firstName) ? $firstName . " " : '') . get_the_author_meta('last_name', $author_id);
                                        } else {
                                            echo get_the_author_meta($name_type, $author_id);
                                        }

                                        break;

                                    case 'taxonomy':
                                        $string = '';
                                        if (count($termsList)) {
                                            $showlink = !empty($item['show_link_taxonomy']);
                                            foreach ($termsList as $index => $term) {
                                                if ($showlink && !empty($term['url'])) {
                                                    $string .= '<a href="' . $term['url'] . '">';
                                                }
                                                $string .= $term['title'] . (isset($termsList[$index + 1]) ? ', ' : '');

                                                if ($showlink && !empty($term['url'])) {
                                                    $string .= '</a>';
                                                }
                                            }
                                        }
                                        echo $string;
                                        break;

                                    case 'date':

                                        echo get_the_date();

                                        break;

                                    case 'time':
                                        $format = get_option('time_format');
                                        echo get_post_time($format);

                                        break;
                                    case 'comments':
                                        $count = get_comment_count();
                                        if (isset($count['approved'])) {
                                            echo $count['approved'];
                                        }
                                        break;
                                }
                                ?>
                                <?php
                                if ($link) : echo '</a>';
                                endif;
                                ?>
                            </span>
                        </div>
                    <?php endif; ?>
                     <?php if (isset($itemAfter)): ?>
                    <div class="text-after">
                        <?php echo str_replace(' ', '&nbsp;', $itemAfter) ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}
