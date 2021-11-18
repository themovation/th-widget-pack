<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

class Post_Image extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve image widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'thhf-post-image';
    }

    /**
     * Get widget title.
     *
     * Retrieve image widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Post Image', 'elementor');
    }

    /**
    * get Plugin help URL
    * @return string help url
    */
    public function get_custom_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
        
    /**
     * Get widget icon.
     *
     * Retrieve image widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'th-editor-icon-post-image';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the image widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['themo-single'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['product image', 'post image', 'image', 'featured image', 'photo', 'visual'];
    }

    function getImageIdByUrl($url) {
        global $wpdb;

        // If the URL is auto-generated thumbnail, remove the sizes and get the URL of the original image
        $url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $url);

        $image = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url));

        if (!empty($image)) {
            return $image[0];
        }

        return false;
    }

    /**
     * setup the image params from the featured image
     * @param type $settings
     */
    private function setupImageFromPost(&$settings) {

        $imageKey = 'image';

        $th_imageId = get_post_thumbnail_id();

        if ($th_imageId) {
            $settings[$imageKey]['id'] = $th_imageId;
            $settings[$imageKey]['url'] = Group_Control_Image_Size::get_attachment_image_src($th_imageId, $imageKey, $settings);
        }
    }

    /**
     * Register image widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 3.1.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
                'section_image',
                [
                    'label' => esc_html__('Image', 'elementor'),
                ]
        );

        $this->add_control(
                'note',
                [
                    //'label' => '<b>' . __('Note', 'header-footer-elementor') . '</b>',
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => __('Displays the Post Featured Image.', 'header-footer-elementor'),
                ]
        );
        $this->add_control(
                'image',
                [
                    'label' => esc_html__('Image fallback', 'elementor'),
                    'type' => Controls_Manager::MEDIA,
                    'description' => __('Replaces missing Post Featured Image.', 'header-footer-elementor'),
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                    'default' => 'medium',
                    'separator' => 'none',
                ]
        );

        $this->add_responsive_control(
                'align',
                [
                    'label' => esc_html__('Alignment', 'elementor'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'elementor'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'elementor'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'elementor'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-image-wrapper' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'caption_source',
                [
                    'label' => esc_html__('Caption', 'elementor'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'none' => esc_html__('None', 'elementor'),
                        'attachment' => esc_html__('Attachment Caption', 'elementor'),
                        'custom' => esc_html__('Custom Caption', 'elementor'),
                    ],
                    'default' => 'none',
                ]
        );

        $this->add_control(
                'caption',
                [
                    'label' => esc_html__('Custom Caption', 'elementor'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'placeholder' => esc_html__('Enter your image caption', 'elementor'),
                    'condition' => [
                        'caption_source' => 'custom',
                    ],
                ]
        );

        $this->add_control(
                'link_to',
                [
                    'label' => esc_html__('Link', 'elementor'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none' => esc_html__('None', 'elementor'),
                        'file' => esc_html__('Media File', 'elementor'),
                        'custom' => esc_html__('Custom URL', 'elementor'),
                    ],
                ]
        );

        $this->add_control(
                'link',
                [
                    'label' => esc_html__('Link', 'elementor'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('https://your-link.com', 'elementor'),
                    'condition' => [
                        'link_to' => 'custom',
                    ],
                    'show_label' => false,
                ]
        );

        $this->add_control(
                'open_lightbox',
                [
                    'label' => esc_html__('Lightbox', 'elementor'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        'yes' => esc_html__('Yes', 'elementor'),
                        '' => esc_html__('No', 'elementor'),
                    ],
                    'condition' => [
                        'link_to' => 'file',
                    ],
                ]
        );

        $this->add_control(
                'view',
                [
                    'label' => esc_html__('View', 'elementor'),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'traditional',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_image',
                [
                    'label' => esc_html__('Image', 'elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'image_border',
                    'selector' => '{{WRAPPER}} .hfe-post-image-wrapper img',
                ]
        );

        $this->add_responsive_control(
                'image_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'elementor'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'image_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} .hfe-post-image-wrapper img',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style_caption',
                [
                    'label' => esc_html__('Caption', 'elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'caption_source!' => 'none',
                    ],
                ]
        );

        $this->add_control(
                'caption_align',
                [
                    'label' => esc_html__('Alignment', 'elementor'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'elementor'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'elementor'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'elementor'),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__('Justified', 'elementor'),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-image-wrapper .widget-image-caption' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'text_color',
                [
                    'label' => esc_html__('Text Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-image-wrapper .widget-image-caption' => 'color: {{VALUE}};',
                    ],
                    'global' => [
                        'default' => Global_Colors::COLOR_TEXT,
                    ],
                ]
        );

        $this->add_control(
                'caption_background_color',
                [
                    'label' => esc_html__('Background Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-image-wrapper .widget-image-caption' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'caption_typography',
                    'selector' => '{{WRAPPER}} .hfe-post-image-wrapper .widget-image-caption',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_TEXT,
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'caption_text_shadow',
                    'selector' => '{{WRAPPER}} .hfe-post-image-wrapper .widget-image-caption',
                ]
        );

        $this->add_responsive_control(
                'caption_space',
                [
                    'label' => esc_html__('Spacing', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-image-wrapper .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Render image widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ('elementor-thhf' == get_post_type()) {

            //check for the fallback image first
            if (empty($settings['image']['url'])) {
                $args = array(
                    'posts_per_page' => 1,
                    'orderby' => 'date',
                    'order' => 'desc',
                    'post_type' => 'post',
                    'meta_query' => array(
                        array(
                            'key' => '_thumbnail_id',
                            'value' => '',
                            'compare' => '!=',
                        ),
                    )
                );

                $imageProduct = get_posts($args);
                if (count($imageProduct)) {
                    $imagePost = $imageProduct[0];
                    $th_imageId = get_post_thumbnail_id($imagePost->ID);
                    $settings['image']['id'] = $th_imageId;
                    $settings['image']['url'] = Group_Control_Image_Size::get_attachment_image_src($th_imageId, 'image', $settings);
                }
                wp_reset_postdata();
            }
        }
        else {
              $this->setupImageFromPost($settings);
        }
        //setup the image
      
        if (empty($settings['image']['url'])) {
            return;
        }

        //get the link
        $link = [];

//        echo "<pre>";
//        print_r($settings);exit;
        if ($settings['link_to'] === 'custom' && isset($settings['link']['url'])) {
            $link = $settings['link'];
        } else if ($settings['link_to'] === 'file') {

            $link = [
                'url' => $settings['image']['url'],
            ];
            if (isset($settings['open_lightbox']) && !empty($settings['open_lightbox'])) {
                $link['data-elementor-open-lightbox'] = 'yes';
            }
        }

        $this->add_link_attributes('link', $link);

        $caption = $captionHtml = '';
        if ($settings['caption_source'] == 'attachment') {
            $caption = wp_get_attachment_caption($settings['image']['id']);
        } else if ($settings['caption_source'] == 'custom') {
            $caption = isset($settings['caption']) ? $settings['caption'] : '';
        }
        if (!empty($caption)):
            $captionHtml = '<figcaption class="widget-image-caption wp-caption-text">' . $caption . '</figcaption>';
        endif;
        ?>
        <div class="hfe-post-image hfe-post-image-wrapper">
            <figure class="wp-caption">
        <?php if (count($link)): ?>
                    <a <?php $this->print_render_attribute_string('link') ?>>
                <?php endif;
                ?>

                    <?php Group_Control_Image_Size::print_attachment_image_html($settings); ?>
                    <?php
                    if (count($link)):
                        echo '</a>';
                    endif;
                    ?>
                    <?php
                    echo $captionHtml;
                    ?>
            </figure>
        </div>
        <?php
    }

    /**
     * Render image widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template() {
        
    }

}
