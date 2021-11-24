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
use Elementor\Control_Media;

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
        return 'th-editor-icon-post-media';
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
     * get Plugin help URL
     * @return string help url
     */
    public function get_custom_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }

    /**
     * Register Post Media controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_post_media_controls();
        $this->register_content_post_media_standard_controls();
        $this->register_image_styles();
        $this->register_post_media_style_controls();
    }

    /**
     * Register Post Content General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_post_media_standard_controls() {
        $this->start_controls_section(
                'section_standard',
                [
                    'label' => __('Standard & Image', 'header-footer-elementor'),
                ]
        );

        $this->add_control(
                'image_note',
                [
                    //'label' => '<b>' . __('Note', 'header-footer-elementor') . '</b>',
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => __('Displays the featured image from the current post.', 'header-footer-elementor'),
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
                    'default' => 'large',
                    'separator' => 'none',
                ]
        );

        $this->add_responsive_control(
                'align_image',
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
                        '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption' => 'text-align: {{VALUE}};',
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

        $this->end_controls_section();
    }

    /**
     * Register image type controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 3.1.0
     * @access private
     */
    private function register_image_styles() {
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
                    'selector' => '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption img',
                ]
        );

        $this->add_responsive_control(
                'image_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'elementor'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'selector' => '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption img',
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
                        '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption .widget-image-caption' => 'text-align: {{VALUE}};',
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
                        '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption .widget-image-caption' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption .widget-image-caption' => 'background-color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'caption_typography',
                    'selector' => '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption .widget-image-caption',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_TEXT,
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'caption_text_shadow',
                    'selector' => '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption .widget-image-caption',
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
                        '{{WRAPPER}} .hfe-post-media-wrapper .wp-caption .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_gallery',
                [
                    'label' => esc_html__('Gallery', 'elementor'),
                ]
        );
        $this->add_control(
                'autoplay',
                [
                    'label' => esc_html__('autoplay', 'elementor'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'yes' => esc_html__('Yes', 'elementor'),
                        '' => esc_html__('No', 'elementor'),
                    ],
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'autoplay_speed',
                [
                    'label' => esc_html__('Autoplay Speed', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'int' => [
                            'min' => 100,
                            'step' => 100,
                            'max' => 20000,
                        ],
                    ],
                    'default' => [
                        'unit' => 'int',
                        'size' => 4000,
                    ],
                    'condition' => [
                        'autoplay' => 'yes',
                    ],
                ]
        );
        $this->add_control(
                'infinite',
                [
                    'label' => __('Infinite', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'default' => 'yes'
                ]
        );
        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'gallery_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                    'default' => 'large',
                    'separator' => 'none',
                ]
        );
        $this->add_control(
                'popup_switcher',
                [
                    'label' => __('Use popup', 'th-widget-pack'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'th-widget-pack'),
                    'label_off' => __('No', 'th-widget-pack'),
                    'return_value' => 'yes',
                    'default' => ''
                ]
        );
        $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'label' => esc_html__('Popup Image Size', 'elementor'),
                    'name' => 'gallery_large_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                    'default' => 'full',
                    'separator' => 'none',
                    'condition' => [
                        'popup_switcher' => 'yes',
                    ],
                ]
        );
        $this->end_controls_section();
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
                'media_note',
                [
                    //'label' => '<b>' . __('Note:', 'header-footer-elementor') . '</b>',
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => __('Displays the Post Format Media defined in the post settings.', 'header-footer-elementor'),
                ]
        );

        $this->add_control(
                'test_type',
                [
                    'label' => __('Styling preview', 'header-footer-elementor'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'standard',
                    'description' => __('Styling preview requires at least one published blog post with a corresponding format type set to work.', 'header-footer-elementor'),
                    'options' => [
                        'standard' => __('Standard', 'header-footer-elementor'),
                        'image' => __('Image', 'header-footer-elementor'),
                        'video' => __('Video', 'header-footer-elementor'),
                        'audio' => __('Audio', 'header-footer-elementor'),
                        'quote' => __('Quote', 'header-footer-elementor'),
                        'gallery' => __('Gallery', 'header-footer-elementor'),
                        'link' => __('Link', 'header-footer-elementor'),
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

    private function getTypeAudio() {

        $audio_embed = sanitize_text_field(get_post_meta(get_the_ID(), '_format_audio_embed', true));
        $audio_shortcode = sanitize_text_field(get_post_meta(get_the_ID(), '_format_audio_shortcode', true));

        $embed_code = false;
        if (isset($audio_embed) && $audio_embed > "") {
            $embed_code = wp_oembed_get($audio_embed, array('width' => 328));
        } elseif ($audio_shortcode > "") {
            $embed_code = do_shortcode($audio_shortcode);
        }
        ?>

        <div class="audio-embed">
            <?php echo $embed_code; ?>
        </div>

        <?php
    }

    private function getTypeGallery() {
        $settings = $this->get_settings_for_display();

        $imageSize = isset($settings['gallery_image_size']) ? $settings['gallery_image_size'] : 'th_img_xl';
        $gallery_shortcode = sanitize_text_field(get_post_meta(get_the_ID(), '_format_gallery', true));
        //extract image ids from there
        $pattern = "/gallery ids='(.*)'/";
        $found = preg_match($pattern, $gallery_shortcode, $match);
        if (!$found && !isset($match[1])) {
            return;
        }
        $images = explode(",", $match[1]);
        if (!count($images)) {
            return;
        }

        $speed = isset($settings['autoplay_speed']['size']) && !empty($settings['autoplay_speed']['size']) ? $settings['autoplay_speed']['size'] : '4000';
        $infinite = isset($settings['infinite']) && !empty($settings['infinite']) ? 'yes' : 'no';
        $showPopup = isset($settings['popup_switcher']) && !empty($settings['popup_switcher']) ? true : false;
        $popupSize = isset($settings['gallery_large_image_size']) && !empty($settings['gallery_large_image_size']) ? $settings['gallery_large_image_size'] : 'large';
        $autplay = isset($settings['autoplay']) && !empty($settings['autoplay']) ? '"autoplay":"yes","autoplay_speed":' . $speed . ',' : '';
        $sliderSettings = '{"slides_to_show":"1","navigation":"both",' . $autplay . '"pause_on_hover":"yes","pause_on_interaction":"yes","infinite":"' . $infinite . '","effect":"slide","speed":500}';

        $slides = [];
        $id = th_randomString();
        foreach ($images as $attachment_id) {

            $image_url = wp_get_attachment_image_url($attachment_id, $imageSize);

            $image_html = '<img class="swiper-slide-image" src="' . esc_attr($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt($attachment_id)) . '" />';

            $slide_html = ''
                    . '<div class="swiper-slide">';

            if ($showPopup) {
                $attachmentPost = get_post($attachment_id);
                $popupTitle = $attachmentPost->post_title;
                $large_image_url = wp_get_attachment_image_url($attachment_id, $popupSize);
                $slide_html .= '<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="' . $id . '" data-elementor-lightbox-title="' . $popupTitle . '" href="' . $large_image_url . '">';
            }


            $slide_html .= '<figure class="swiper-slide-inner">'
                    . $image_html;
            $slide_html .= '</figure>';

            if ($showPopup) {
                $slide_html .= '</a>';
            }

            $slide_html .= '</div>';

            $slides[] = $slide_html;
        }
        $this->add_render_attribute([
            'carousel' => [
                'class' => 'elementor-image-carousel swiper-wrapper',
            ],
            'carousel-wrapper' => [
                'class' => 'elementor-image-carousel-wrapper swiper-container',
                'dir' => 'ltr',
            ],
        ]);
        ?>
        <div data-widget_type="image-carousel.default" data-settings='<?= $sliderSettings ?>' data-element_type="widget" class="elementor-element elementor-arrows-position-inside  elementor-widget elementor-widget-image-carousel">

            <div <?php echo $this->get_render_attribute_string('carousel-wrapper'); ?> >
                <div <?php echo $this->get_render_attribute_string('carousel'); ?> >
                    <?php echo implode('', $slides); ?>
                </div>
                <?php if (1 < count($slides)) : ?>
                    <div class="elementor-swiper-button elementor-swiper-button-prev">
                        <i class="eicon-chevron-left" aria-hidden="true"></i>
                        <span class="elementor-screen-only"><?php _e('Previous', 'elementor'); ?></span>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-next">
                        <i class="eicon-chevron-right" aria-hidden="true"></i>
                        <span class="elementor-screen-only"><?php _e('Next', 'elementor'); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    private function getTypeStandard() {
        $this->getTypeImage();
    }

    private function getTypeLink() {
        $link_url = get_post_meta(get_the_ID(), '_format_link_url', true);
        $link_title = get_post_meta(get_the_ID(), '_format_link_title', true);
        $link_target = get_post_meta(get_the_ID(), '_format_link_target', true);

        if (isset($link_target) && is_array($link_target)) {
            if ($link_target[0] > "")
                $link_target_markup = "target='" . $link_target[0] . "'";
        } else {
            $link_target_markup = "";
        }
        ?>
        <div class = "link-text">
            <i class = "link-icon float-left accent fa fa-link fa-flip-horizontal"></i>
            <?php
            $href = "";
            $href_close = "";
            if ($link_url > "") {
                $href = "<a href='" . $link_url . "' " . $link_target_markup . ">";
                $href_close = "</a>";
            }
            if ($link_title > "") {
                echo "&nbsp;" . wp_kses_post($href) . esc_attr($link_title) . $href_close;
            }
            ?>
        </div>
        <?php
    }

    private function getTypeVideo() {

        $video_embed = sanitize_text_field(get_post_meta(get_the_ID(), '_format_video_embed', true));
        $video_shortcode = sanitize_text_field(get_post_meta(get_the_ID(), '_format_video_shortcode', true));

        $video_container_class = "";
        if ($video_embed > "") {
            $embed_code = wp_oembed_get($video_embed);
            $video_container_class = "video-container";
        } elseif ($video_shortcode > "" && strpos($video_shortcode, '[embed]') !== FALSE) {
            global $wp_embed;
            $embed_code = $wp_embed->run_shortcode($video_shortcode);
            $embed_code = do_shortcode($embed_code);
            $video_container_class = "video-container";
        } elseif ($video_shortcode > "") {
            $embed_code = do_shortcode($video_shortcode);
            $video_container_class = "wp-hosted-video";
        }




        if (isset($embed_code) && $embed_code > "") {
            ?>
            <div class="<?php echo wp_kses_post($video_container_class); ?>">
                <?php echo $embed_code ?>
            </div>
            <?php
        }
    }

    private function getTypeQuote() {
        get_template_part('templates/content', 'quote');
    }

    private function getTypeImage() {

        $settings = $this->get_settings_for_display();

        //setup the image
        $this->setupImageFromPost($settings);
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
        <?php
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
        $queryPosts = false;
        if ('elementor-thhf' == get_post_type()) {
            $testType = $this->get_settings_for_display('test_type');
            if (!empty($testType)) {
                $ttype = 'post-format-' . $testType;
                $args = array(
                    'posts_per_page' => 1,
                    'orderby' => 'date',
                    'post_type' => 'post',
                    'order' => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                        ),
                    ),
                );
                if ($testType === 'standard') {
                    $args['tax_query'][0]['terms'] = array('post-format-quote', 'post-format-audio', 'post-format-gallery', 'post-format-image', 'post-format-link', 'post-format-video');
                    $args['tax_query'][0]['operator'] = 'NOT IN';
                    $args['meta_query'] = array(
                        array(
                            'key' => '_thumbnail_id',
                            'value' => '',
                            'compare' => '!=',
                        ),
                    );
                } else if ($testType === 'image') {
                    $args['tax_query'][0]['terms'] = array($ttype);
                    $args['meta_query'] = array(
                        array(
                            'key' => '_thumbnail_id',
                            'value' => '',
                            'compare' => '!=',
                        ),
                    );
                } else {
                    $args['tax_query'][0]['terms'] = array($ttype);
                }

                $queryPosts = get_posts($args);
                if (count($queryPosts)) {
                    global $post;
                    $post = $queryPosts[0];
                    setup_postdata($post);
                } else {
                    //echo 'Please, at least have one post of "' . $testType . '" format type to see some output here.';
                    echo 'Styling preview requires at least one published blog post using the <strong>' . $testType . '</strong> format type to work.';
                    if ($testType === 'standard') {
                        echo 'Make sure at least one blog post has a featured image set.';
                    }
                }
            }
        }

        $type = get_post_format();
        $format = !empty($type) ? $type : 'standard';
        ?>		
        <div class="hfe-post-media hfe-post-media-wrapper hfe-post-type-<?= $format ?> format-<?= $format ?>">
            <?php
            if ('elementor-thhf' == get_post_type()) {
            } else {
                ?>
                <?php
                ob_start();
                $methodName = 'getType' . ucfirst($format);
                if (method_exists($this, $methodName)) {
                    $this->$methodName();
                } else {
                    $this->getTypeStandard();
                }

                $content = ob_get_clean();

                echo $content;
                ?>
                <?php
            }
            ?>

        </div>
        <?php
        if ($queryPosts) {
            wp_reset_postdata();
        }
    }

}
