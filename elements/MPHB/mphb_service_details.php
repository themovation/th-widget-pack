<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_MPHB_Service_Details extends Widget_Base {

    public function get_name() {
        return 'themo-mphb-service-details';
    }

    public function get_title() {
        return __( 'Accommodation Service Details', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-menu-card';
    }

    public function get_categories() {
        return [ 'themo-elements' ];
    }

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
    public function is_reload_preview_required() {
        return true;
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_shortcode',
            [
                'label' => __( 'Service Details', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'important_note',
            [
                //'label' => __( 'Note', 'th-widget-pack' ),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( '<p style="line-height: 17px;">This widget is designed to work inside of a Service Post Type. 
                            You can access yours under Dashboard / Accommodations / Services / Edit /</p>', 'th-widget-pack' ),
                'content_classes' => 'themo-elem-html-control',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_color',
            [
                'label' => __( 'Typography & Color', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_service_details span.mphb-price' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => __( 'Price', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .themo_mphb_service_details span.mphb-price',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_service_details' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __( 'Text', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .themo_mphb_service_details',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );



        $this->end_controls_section();

    }

    protected function render() {

        global $post;

        $settings = $this->get_settings_for_display();

        if ( is_singular( 'mphb_room_service') && function_exists('mphb_tmpl_the_service_price')) { // check if function exists and if we are on a room service single.
            ?>
            <div class="themo_mphb_service_details"><?php mphb_tmpl_the_service_price(); ?></div>
            <?php
        }else{ ?>
            <div class="themo_mphb_service_details"><?php _e( 'This widget is designed to work inside of a Service Post Type. You can access yours under Dashboard / Accommodations / Services / Edit /', 'th-widget-pack' ); ?></div>
        <?php }
    }

    public function render_plain_content() {
        // In plain mode, render without shortcode
        echo $this->get_settings( 'shortcode' );
    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_MPHB_Service_Details() );
