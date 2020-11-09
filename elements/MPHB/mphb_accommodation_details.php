<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_MPHB_Accommodation_Details extends Widget_Base {

    public function get_name() {
        return 'themo-mphb-accommodation-details';
    }

    public function get_title() {
        return __( 'Accommodation Details', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
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
                'label' => __( 'Accommodation Details', 'th-widget-pack' ),
            ]
        );

        $this->add_control('type_id', array(
            'type'        => Controls_Manager::TEXT,
            'label'       => __('Accommodation Type ID', 'th-widget-pack'),
            'default'     => '',
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ]
        ));


        $this->add_control(
            'show_titles',
            [
                'label' => __( 'Show Titles', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '',
                'tablet_default' => '',
                'mobile_default'=> '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_details .mphb-loop-room-type-attributes li .mphb-attribute-title' => 'display: inherit;'
                ],
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
            'icon_color',
            [
                'label' => __( 'Icon Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_details .mphb-loop-room-type-attributes li:before' => 'color: {{VALUE}};',
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
                'name' => 'icon_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .themo_mphb_room_details .mphb-loop-room-type-attributes li:before',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'exclude' => [ 'font_family','font_weight','text_transform','font_style','text_decoration','letter_spacing'],
            ]
        );


        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_details .mphb-loop-room-type-attributes li .mphb-attribute-title' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'show_titles' => 'yes',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .themo_mphb_room_details .mphb-loop-room-type-attributes li .mphb-attribute-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                    'show_titles' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'value_color',
            [
                'label' => __( 'Value Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_details .mphb-loop-room-type-attributes li .mphb-attribute-value' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'value_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .themo_mphb_room_details .mphb-loop-room-type-attributes li .mphb-attribute-value',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'value_link_color',
            [
                'label' => __( 'Link Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_details .mphb-loop-room-type-attributes li .mphb-attribute-value a,
                    {{WRAPPER}} .themo_mphb_room_details .mphb-loop-room-type-attributes li .mphb-attribute-value a:link' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_spacing',
            [
                'label' => __( 'Spacing', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'value_spacing',
            [
                'label' => __( 'Value Spacing', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => '0',
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_details ul span.mphb-attribute-value' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {

        global $post;

        $settings = $this->get_settings_for_display();

        // If Accommodation type id field is empty, try to get the id automatically.
        if ( !isset( $settings['type_id'] ) || empty( $settings['type_id']) ) {
            if(isset($post->ID )&& $post->ID > ""){
                $postID = $post->ID;
                $themo_post_type = get_post_type($postID);
                if(isset($themo_post_type) && $themo_post_type=='mphb_room_type'){
                    $settings['type_id'] = $postID;
                }
            }
        }

        if ( isset( $settings['type_id'] ) && ! empty( $settings['type_id']) && is_numeric($settings['type_id']) ) {

            if ( isset( $settings['months_to_show'] ) && ! empty( $settings['months_to_show'] ) && is_numeric($settings['months_to_show'])) {
                $th_monthstoshow = $settings['months_to_show'];
            }else{
                $th_monthstoshow=2;
            }

            $th_shortcode = '[mphb_room id='.$settings['type_id'].' title="false" featured_image="false" gallery="false" excerpt="false" book_button="false" price="false"]';
            $th_shortcode = sanitize_text_field( $th_shortcode );
            $th_shortcode = do_shortcode( shortcode_unautop( $th_shortcode ) );

            ?>
            <div class="elementor-shortcode themo_mphb_room_details"><?php echo $th_shortcode; ?></div>
            <?php
        }
    }

    public function render_plain_content() {
        // In plain mode, render without shortcode
        echo $this->get_settings( 'shortcode' );
    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_MPHB_Accommodation_Details() );
