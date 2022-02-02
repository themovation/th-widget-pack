<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Image Carousel Widget
 */
class Themo_Widget_Image_Carousel_Timeline extends Widget_Base {

    /**
     * Retrieve image carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'themo-image-carousel-timeline';
    }

    /**
     * Retrieve image carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Image Carousel Timeline', 'elementor' );
    }

    /**
     * Retrieve image carousel widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'th-editor-icon-slider';
    }

    /**
     * Retrieve the list of categories the image carousel widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'themo-elements' ];
    }

    /**
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'jquery-slick' ];
    }

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
    /**
     * Register image carousel widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_image_carousel',
            [
                'label' => __( 'Image Carousel', 'elementor' ),
            ]
        );

        $this->add_control(
            'carousel',
            [
                'label' => __( 'Add Images', 'elementor' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
            ]
        );

		$slides_to_show = range( 1, 7, 2 );

        $slides_to_show = array_combine( $slides_to_show, $slides_to_show );

        $this->add_responsive_control(
            'slides_to_show',
            [
                'label' => __( 'Slides to Show', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __( 'Default', 'elementor' ),
                    ] + $slides_to_show,
                'frontend_available' => true,
            ]
        );

		/*$this->add_control(
			'slides_to_scroll',
			[
				'label' => __( 'Slides to Scroll', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
                'options' => [
                        '1' => __( '1', 'elementor' ),
                ],
				'condition' => [
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
			]
		);*/

        $this->add_control(
            'image_stretch',
            [
                'label' => __( 'Image Stretch', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'no' => __( 'No', 'elementor' ),
                    'yes' => __( 'Yes', 'elementor' ),
                ],
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
                    'both' => __( 'Arrows and Dots', 'elementor' ),
                    'arrows' => __( 'Arrows', 'elementor' ),
                    'dots' => __( 'Dots', 'elementor' ),
                    'none' => __( 'None', 'elementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'link_to',
            [
                'label' => __( 'Link to', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'elementor' ),
                    'file' => __( 'Media File', 'elementor' ),
                    'custom' => __( 'Custom URL', 'elementor' ),
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => 'Link to',
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'http://your-link.com', 'elementor' ),
                'condition' => [
                    'link_to' => 'custom',
                ],
                'show_label' => false,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'open_lightbox',
            [
                'label' => __( 'Lightbox', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Default', 'elementor' ),
                    'yes' => __( 'Yes', 'elementor' ),
                    'no' => __( 'No', 'elementor' ),
                ],
                'condition' => [
                    'link_to' => 'file',
                ],
            ]
        );

        $this->add_control(
            'caption_type',
            [
                'label' => __( 'Caption', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'title_caption',
                'options' => [
                    '' => __( 'None', 'elementor' ),
                    'title' => __( 'Title', 'elementor' ),
                    'caption' => __( 'Caption', 'elementor' ),
                    //'description' => __( 'Description', 'elementor' ),
                    'title_caption' => __( 'Title & Caption', 'elementor' ),
                ],
            ]
        );
        /*$this->add_control(
            'center_mode',
            [
                'label' => __( 'Slider Center Mode', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'label_on',
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
            ]
        );*/

        $this->add_control(
            'view',
            [
                'label' => __( 'View', 'elementor' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => __( 'Additional Options', 'elementor' ),
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => __( 'Pause on Hover', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'elementor' ),
                    'no' => __( 'No', 'elementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'elementor' ),
                    'no' => __( 'No', 'elementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', 'elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'frontend_available' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        /*$this->add_control(
            'infinite',
            [
                'label' => __( 'Infinite Loop', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'elementor' ),
                ],
                'frontend_available' => true,
            ]
        );*/

        $this->add_control(
            'effect',
            [
                'label' => __( 'Effect', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __( 'Slide', 'elementor' ),
                    'fade' => __( 'Fade', 'elementor' ),
                ],
                'condition' => [
                    'slides_to_show' => '1',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __( 'Animation Speed', 'elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'frontend_available' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => __( 'Direction', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ltr',
                'options' => [
                    'ltr' => __( 'Left', 'elementor' ),
                    'rtl' => __( 'Right', 'elementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => __( 'Navigation', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation' => [ 'arrows', 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'heading_style_arrows',
            [
                'label' => __( 'Arrows', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'arrows_position',
            [
                'label' => __( 'Arrows Position', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inside',
                'options' => [
                    'inside' => __( 'Inside', 'elementor' ),
                    'outside' => __( 'Outside', 'elementor' ),
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_size',
            [
                'label' => __( 'Arrows Size', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-carousel-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-image-carousel-wrapper .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label' => __( 'Arrows Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-carousel-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-image-carousel-wrapper .slick-slider .slick-next:before' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'heading_style_dots',
            [
                'label' => __( 'Dots', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label' => __( 'Dots Position', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'outside',
                'options' => [
                    'outside' => __( 'Outside', 'elementor' ),
                    'inside' => __( 'Inside', 'elementor' ),
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label' => __( 'Dots Size', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __( 'Dots Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => __( 'Image', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_spacing',
            [
                'label' => __( 'Spacing', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Default', 'elementor' ),
                    'custom' => __( 'Custom', 'elementor' ),
                ],
                'default' => '',
                'condition' => [
                    'slides_to_show!' => '1',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_spacing_custom',
            [
                'label' => __( 'Image Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'show_label' => false,
                'selectors' => [
                    '{{WRAPPER}} .slick-list' => 'margin-left: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slick-slide .slick-slide-inner' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'image_spacing' => 'custom',
                    'slides_to_show!' => '1',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .slick-slide-image',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .slick-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_caption',
            [
                'label' => __( 'Caption', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'caption_type!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'caption_align',
            [
                'label' => __( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'elementor' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'caption_text_color',
            [
                'label' => __( 'Text Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-carousel-caption' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'caption_typography',
                'label' => __( 'Typography', 'elementor' ),
                
                'selector' => '{{WRAPPER}} .elementor-image-carousel-caption',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render image carousel widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['carousel'] ) ) {
            return;
        }

        $slides = [];

        foreach ( $settings['carousel'] as $index => $attachment ) {
            $image_url = Group_Control_Image_Size::get_attachment_image_src( $attachment['id'], 'thumbnail', $settings );

            $image_html = '<img class="slick-slide-image" src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( Control_Media::get_image_alt( $attachment ) ) . '" />';

            $link = $this->get_link_url( $attachment, $settings );

            if ( $link ) {
                $link_key = 'link_' . $index;

                $this->add_render_attribute( $link_key, [
                    'href' => $link['url'],
                    'class' => 'elementor-clickable',
                    'data-elementor-open-lightbox' => $settings['open_lightbox'],
                    'data-elementor-lightbox-slideshow' => $this->get_id(),
                    'data-elementor-lightbox-index' => $index,
                ] );

                if ( ! empty( $link['is_external'] ) ) {
                    $this->add_render_attribute( $link_key, 'target', '_blank' );
                }

                if ( ! empty( $link['nofollow'] ) ) {
                    $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                }

                $image_html = '<a ' . $this->get_render_attribute_string( $link_key ) . '>' . $image_html . '</a>';
            }

            $image_title = $this->get_image_title( $attachment );
            $image_caption = $this->get_image_caption( $attachment );


            $slide_html = '<div class="slick-slide"><figure class="slick-slide-inner">' . $image_html;

            $caption_type = $this->get_settings_for_display( 'caption_type' );

            if ( 'caption' === $caption_type && ! empty( $image_caption )) {
                    $slide_html .= '<figcaption class="elementor-image-carousel-caption"><span class="th-timeline-caption">' . $image_caption . '</span></figcaption>';
            }elseif ( 'title' === $caption_type && ! empty( $image_title )) {
                    $slide_html .= '<figcaption class="elementor-image-carousel-caption"><span class="th-timeline-title">' . $image_title . '</span></figcaption>';
            } elseif ( 'title_caption' === $caption_type && (! empty( $image_caption ) ||  ! empty( $image_title ))) {
                    $slide_html .= '<figcaption class="elementor-image-carousel-caption"><span class="th-timeline-title">' . $image_title .'</span><span class="th-timeline-caption">'.$image_caption.'</span></figcaption>';
            }

            $slide_html .= '</figure></div>';

            $slides[] = $slide_html;

        }

        if ( empty( $slides ) ) {
            return;
        }

        $this->add_render_attribute( 'carousel', 'class', 'elementor-image-carousel' );

        if ( 'none' !== $settings['navigation'] ) {
            if ( 'dots' !== $settings['navigation'] ) {
                $this->add_render_attribute( 'carousel', 'class', 'slick-arrows-' . $settings['arrows_position'] );
            }

            if ( 'arrows' !== $settings['navigation'] ) {
                $this->add_render_attribute( 'carousel', 'class', 'slick-dots-' . $settings['dots_position'] );
            }
        }

        if ( 'yes' === $settings['image_stretch'] ) {
            $this->add_render_attribute( 'carousel', 'class', 'slick-image-stretch' );
        }

        // Slider Params
        $slidesToShow       = $settings['slides_to_show'] ? $settings['slides_to_show']     : 3;
        $slidesToShowTablet = $settings['slides_to_show_tablet'] ? $settings['slides_to_show_tablet']     : 3;
        $slidesToShowMobile = $settings['slides_to_show_mobile'] ? $settings['slides_to_show_mobile']     : 3;
        $isSingleSlide      = $slidesToShow === 1;
        $slidesToScroll     = 1; //$settings['slides_to_scroll'] ? $settings['slides_to_scroll'] : $slidesToShow;
        $autoplay           = $settings['autoplay'];
        $autoplaySpeed      = $settings['autoplay_speed'];
        $infinite           = 'yes';//$settings['infinite'];
        $navigation         = $settings['navigation'];
        $centerMode         = 'yes'; //$settings['center_mode'];
        $speed              = $settings['speed'];
        $pauseOnHover       = ( $settings['pause_on_hover'] == 'yes' ) ? true : false;
        $direction              = $settings['direction'];

        $slider_params = array(
            'slidesToShow'      => ( int ) $slidesToShow,
            'autoplay'          => ( $autoplay == 'yes' ) ? true : false,
            'autoplaySpeed'     => intval( $autoplaySpeed ),
            'infinite'          => ( $infinite == 'yes' ) ? true : false,
            'pauseOnHover'      => $pauseOnHover,
            'speed'             => intval( $speed ),
            'arrows'            => ( $navigation == 'arrows' || $navigation == 'both' ) ? true : false,
            'dots'              => ( $navigation == 'dots' || $navigation == 'both' ) ? true : false,
            'draggable'         => isset( $draggable ) ? $draggable : true,
            'centerMode'        => ( $centerMode == 'yes' ) ? true : false,
            'rtl'               => 'rtl' === $direction,
            'responsive'        => array(
                array(
                    'breakpoint'      => 1025,
                    'settings'        => array(
                        'slidesToShow'   => ($slidesToShowTablet ? intval($slidesToShowTablet, 10) : ( $isSingleSlide ? 1 : 2 ) ),
                        'slidesToScroll' => 1
                    )
                ),
                array(
                    'breakpoint'      => 768,
                    'settings'        => array(
                        'slidesToShow'   => ($slidesToShowMobile ? intval($slidesToShowMobile, 10) : 1),
                        'slidesToScroll' => 1
                    )
                ),
            )
        );

        if ( $settings['effect'] === 'fade' ) {
            $slider_params['fade'] = true;
        }

        if ( $settings['slides_to_show'] > 1 ) {
            $slider_params['slidesToScroll'] = ( int ) $slidesToScroll;
        }

        $slider_params_encode = json_encode($slider_params);

        ?>
        <div class="elementor-image-carousel-wrapper elementor-slick-slider th-image-carousel-timeline" dir="<?php echo $settings['direction']; ?>">
            <div <?php echo $this->get_render_attribute_string( 'carousel' ); ?> <?php echo $slider_params_encode ? "data-slick='{$slider_params_encode}'" : ''; ?>>
                <?php echo implode( '', $slides ); ?>
            </div>
        </div>
        <?php
    }

    /**
     * Retrieve image carousel link URL.
     *
     * @since 1.0.0
     * @access private
     *
     * @param array $attachment
     * @param object $instance
     *
     * @return array|string|false An array/string containing the attachment URL, or false if no link.
     */
    private function get_link_url( $attachment, $instance ) {
        if ( 'none' === $instance['link_to'] ) {
            return false;
        }

        if ( 'custom' === $instance['link_to'] ) {
            if ( empty( $instance['link']['url'] ) ) {
                return false;
            }

            return $instance['link'];
        }

        return [
            'url' => wp_get_attachment_url( $attachment['id'] ),
        ];
    }

    /**
     * Retrieve image carousel caption.
     *
     * @since 1.2.0
     * @access private
     *
     * @param array $attachment
     *
     * @return string The caption of the image.
     */
    private function get_image_caption( $attachment ) {

        $attachment_post = get_post( $attachment['id'] );
        return $attachment_post->post_excerpt;

        /*$caption_type = $this->get_settings_for_display( 'caption_type' );

        if ( empty( $caption_type ) ) {
            return '';
        }

        if ( 'caption' === $caption_type ) {
            return $attachment_post->post_excerpt;
        }

        if ( 'title' === $caption_type ) {
            return $attachment_post->post_title;
        }

        return $attachment_post->post_content;
        */
    }

    /**
     * Retrieve image carousel title.
     *
     * @since 1.2.0
     * @access private
     *
     * @param array $attachment
     *
     * @return string The caption of the image.
     */
    private function get_image_title( $attachment ) {
        $attachment_post = get_post( $attachment['id'] );
        return $attachment_post->post_title;
    }
}


Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Image_Carousel_Timeline() );