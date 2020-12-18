<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Package extends Widget_Base {

    public function get_name() {
        return 'themo-package';
    }

    public function get_title() {
        return __( 'Package', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'themo-elements' ];
    }

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
    protected function _register_controls() {
        $this->start_controls_section(
            'section_about',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'th-widget-pack' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'post_image_size',
            [
                'label' => __( 'Image Size', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'th_img_sm_standard',
                'options' => [
                    'th_img_sm_standard' => __( 'Standard', 'th-widget-pack' ),
                    'th_img_sm_landscape' => __( 'Landscape', 'th-widget-pack' ),
                    'th_img_sm_portrait' => __( 'Portrait', 'th-widget-pack' ),
                    'th_img_sm_square' => __( 'Square', 'th-widget-pack' ),
                    'th_img_lg' => __( 'Large', 'th-widget-pack' ),
                ],
            ]
        );

        $this->add_control(
            'pre_title',
            [
                'label' => __( 'Pre Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '25% Off', 'th-widget-pack' ),
                'placeholder' => __( '25% Off', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Package Title', 'th-widget-pack' ),
                'placeholder' => __( 'Package Title', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Maecenas tristique ullamcorper mauris, et elementum tortor.',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'package_text_align',
            [
                'label' => __( 'Content Align', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-content' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_price',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '$299', 'th-widget-pack' ),
                'placeholder' => __( '$299', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price_text',
            [
                'label' => __( 'Price Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '/each', 'th-widget-pack' ),
                'placeholder' => __( '/each', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'section_link',
            [
                'label' => __( 'Link', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => __( 'Link URL', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Layout', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => [
                    'style_1' => __( 'Style 1', 'th-widget-pack' ),
                    'style_2' => __( 'Style 2', 'th-widget-pack' )
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_photo_content',
            [
                'label' => __( 'Photo', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'photo_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_price_section',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_price_heading',
            [
                'label' => __( 'Price', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_price_typography',
                'selector' => '{{WRAPPER}} h4',
            ]
        );

        $this->add_control(
            'section_price_text_heading',
            [
                'label' => __( 'Price Text', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'price_text_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} span' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_price_text_typography',
                'selector' => '{{WRAPPER}} span',
            ]
        );

        $this->add_control(
            'section_price_text_background',
            [
                'label' => __( 'Background', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'price_background_color',
            [
                'label' => __( 'Background Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-info' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_gradient',
                'label' => __( 'Image Gradient', 'th-widget-pack' ),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .th-package.th-package-style-2 .th-pkg-img:after',
                'description' => 'Control the image overlay gradient.',
                'condition' => [
                    'style' => 'style_2',
                ],

            ]
        );

        $this->add_responsive_control(
            'price_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => 'style_1',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_background',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_pre_heading',
            [
                'label' => __( 'Pre Title', 'elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'pre_title_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-package-pre-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_pre_title_typography',
                'selector' => '{{WRAPPER}} .th-package-pre-title',
            ]
        );

        $this->add_control(
            'section_title_heading',
            [
                'label' => __( 'Title', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_title_typography',
                'selector' => '{{WRAPPER}} h3',
            ]
        );

        $this->add_control(
            'section_content_heading',
            [
                'label' => __( 'Content', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-package-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'elementor' ),
                'name' => 'section_content_typography',
                'selector' => '{{WRAPPER}} .th-package-content',
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'package_content_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();





    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['url']['url'] ) ) {
            $this->add_render_attribute( 'link', 'href', esc_url( $settings['url']['url'] ) );

            if ( ! empty( $settings['url']['is_external'] ) ) {
                $this->add_render_attribute( 'link', 'target', '_blank' );
            }
        }

        $this->add_render_attribute( 'front-icon-wrapper','class','icon-wrapper' );

        $themo_package_row_class = 'th-package';

        $th_package_style_2 = false;
        if ( isset( $settings['style'] ) &&  $settings['style'] == 'style_2' ){
            $themo_package_row_class .= ' th-package-style-2';
            $th_package_style_2 = true;
        }

        ?>

        <article class="<?php echo $themo_package_row_class;?>">

            <?php if ( ! empty( $settings['url']['url'] ) ) : ?>
                <a class="th-pkg-click" <?php echo $this->get_render_attribute_string( 'link' ); ?>></a>
            <?php endif; ?>

            <?php if ( ! $th_package_style_2) : ?>
                <div class="th-pkg-info">
                    <?php if ( ! empty( $settings['price'] ) ) : ?>
                        <h4><?php echo esc_html( $settings['price'] ) ?></h4>
                    <?php endif;?>
                    <?php if ( ! empty( $settings['price_text'] ) ) : ?>
                        <span><?php echo esc_html( $settings['price_text'] ) ?></span>
                    <?php endif;?>
                </div>
            <?php endif; ?>

            <?php
            if ( empty( $settings['image']['url'] ) ) {
                return;
            }
            if ( isset( $settings['post_image_size'] ) && $settings['post_image_size'] > "" && isset( $settings['image']['id'] ) && $settings['image']['id'] > "" ) {
                $image_size = esc_attr( $settings['post_image_size'] );
                if ( $settings['image']['id'] ) $image = wp_get_attachment_image( $settings['image']['id'], $image_size, false, array( 'class' => '' ) );
            } elseif ( ! empty( $settings['image']['url'] ) ) {
                $this->add_render_attribute( 'image', 'src', esc_url( $settings['image']['url'] ) );
                $this->add_render_attribute( 'image', 'alt', esc_attr( Control_Media::get_image_alt( $settings['image'] ) ) );
                $this->add_render_attribute( 'image', 'title', esc_attr( Control_Media::get_image_title( $settings['image'] ) ) );
                $image = '<img ' . $this->get_render_attribute_string( 'image' ) . '>';
            }
            ?>
            <div class="th-pkg-img">
                <?php if ( $th_package_style_2) : ?>
                    <div class="th-pkg-info">
                        <?php if ( ! empty( $settings['price'] ) ) : ?>
                            <h4><?php echo esc_html( $settings['price'] ) ?></h4>
                        <?php endif;?>
                        <?php if ( ! empty( $settings['price_text'] ) ) : ?>
                            <span><?php echo esc_html( $settings['price_text'] ) ?></span>
                        <?php endif;?>
                    </div>
                <?php endif; ?>
                <?php echo wp_kses_post( $image ) ; ?>
            </div>

            <div class="th-pkg-content">
                <?php if ( ! empty( $settings['pre_title'] ) ) : ?>
                    <div class="th-package-pre-title"><?php echo esc_html( $settings['pre_title'] ); ?></div>
                <?php endif; ?>
                <?php if ( ! empty( $settings['title'] ) ) : ?>
                    <h3><?php echo esc_html( $settings['title'] ); ?></h3>
                <?php endif; ?>
                <?php if ( ! empty( $settings['content'] ) ) : ?>
                    <div class="th-package-content">
                        <?php echo wp_kses_post( $settings['content'] ); ?>
                    </div>
                <?php endif; ?>
            </div>

        </article>

        <?php
    }

    protected function _content_template() {}

    /*
     * <article class="th-package">
            <# if ( settings.url && settings.url.url ) { #>
                <a class="th-pkg-click"  href="{{ settings.url.url }}"></a>
            <# } #>
            <div class="th-pkg-info">
                <# if ( '' !== settings.price ) { #>
                    <h4>{{{ settings.price }}}</h4>
                <# } #>
                <# if ( '' !== settings.price_text ) { #>
                    <span>{{{ settings.price_text }}}</span>
                <# } #>
            </div>
            <# if ( '' !== settings.image.url ) {
                    var image = {
                    id: settings.image.id,
                    url: settings.image.url,
                    size: settings.image_size,
                    dimension: settings.image_custom_dimension,
                    model: editModel
                    };

                    var image_url = elementor.imagesManager.getImageUrl( image );

                    if ( ! image_url ) {
                    return;
                    }
                #>
                <div class="th-pkg-img">
                    <img src="{{{ image_url }}}" />
                </div>
            <# } #>
            <div class="th-pkg-content">
                <# if ( '' !== settings.pre_title ) { #>
                    <div class="th-package-pre-title">{{{ settings.pre_title }}}</div>
                <# } #>
                <# if ( '' !== settings.title ) { #>
                    <h3>{{{ settings.title }}}</h3>
                <# } #>
                <# if ( '' !== settings.content ) { #>
                    <div class="th-package-content">
                        {{{ settings.content }}}
                    </div>
                <# } #>
            </div>
        </article>
     * */

    public function add_wpml_support() {
        add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
    }

    public function wpml_widgets_to_translate_filter( $widgets ) {
        $widgets[ $this->get_name() ] = [
            'conditions' => [ 'widgetType' => $this->get_name() ],
            'fields'     => [

                [
                    'field'       => 'pre_title',
                    'type'        => __( 'Pre Title', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
                [
                    'field'       => 'title',
                    'type'        => __( 'Title', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
                [
                    'field'       => 'content',
                    'type'        => __( 'Content', 'th-widget-pack' ),
                    'editor_type' => 'AREA'
                ],
                [
                    'field'       => 'price',
                    'type'        => __( 'Price', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
                [
                    'field'       => 'price_text',
                    'type'        => __( 'Price Text', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
                'url' => [
                    'field'        => 'url',
                    'field_id'    => 'url', // New key
                    'type'        => __('Link URL', 'th-widget-pack'),
                    'editor_type' => 'LINK' // Or 'LINK' but then relative links won't work
                ],
            ],
        ];
        return $widgets;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Package() );
