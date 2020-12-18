<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_MPHB_Booking_Form extends Widget_Base {

    public function get_name() {
        return 'themo-mphb-booking-form';
    }

    public function get_title() {
        return __( 'Accommodation Booking Request', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-form-vertical';
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
                'label' => __( 'Availability Calendar', 'th-widget-pack' ),
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
            'inline_form',
            [
                'label' => __( 'Form Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'Default', 'th-widget-pack' ),
                    'inline' => __( 'Inline', 'th-widget-pack' ),
                    'stacked' => __( 'Stretched', 'th-widget-pack' ),

                ],
            ]
        );

        $this->add_control(
            'slide_shortcode_border',
            [
                'label' => __( 'Form Background', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'th-widget-pack' ),
                    'th-form-bg th-light-bg' => __( 'Light', 'th-widget-pack' ),
                    'th-form-bg th-dark-bg' => __( 'Dark', 'th-widget-pack' ),

                ],
                'condition' => [
                    'inline_form' => 'stacked',
                ],
            ]
        );

        $this->add_control(
            'button_1_style',
            [
                'label' => __( 'Button Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'standard-primary',
                'options' => [
                    'standard-primary' => __( 'Standard Primary', 'th-widget-pack' ),
                    'standard-accent' => __( 'Standard Accent', 'th-widget-pack' ),
                    'standard-light' => __( 'Standard Light', 'th-widget-pack' ),
                    'standard-dark' => __( 'Standard Dark', 'th-widget-pack' ),
                    'ghost-primary' => __( 'Ghost Primary', 'th-widget-pack' ),
                    'ghost-accent' => __( 'Ghost Accent', 'th-widget-pack' ),
                    'ghost-light' => __( 'Ghost Light', 'th-widget-pack' ),
                    'ghost-dark' => __( 'Ghost Dark', 'th-widget-pack' ),
                    'cta-primary' => __( 'CTA Primary', 'th-widget-pack' ),
                    'cta-accent' => __( 'CTA Accent', 'th-widget-pack' ),
                ],
            ]
        );

        $this->add_control(
            'slide_text_align',
            [
                'label' => __( 'Align', 'th-widget-pack' ),
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
                'default' => 'center',
            ]
        );

        /*$this->add_control(
            'calendar_align',
            [
                'label' => __( 'Center Align', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_booking_form-wrapper' => 'margin: auto;',
                    //'(mobile){{WRAPPER}} .mphb_sc_availability_calendar-wrapper .mphb-calendar .datepick' => 'margin: auto;'
                ],
            ]
        );
        $this->add_control(
            'text_align',
            [
                'label' => __( 'Text Align', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_booking_form-wrapper' => 'text-align: center;',
                ],
            ]
        );*/


        $this->add_control(
            'hide_required_notices',
            [
                'label' => __( 'Hide Required Tips', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_booking_form-wrapper .mphb-required-fields-tip' => 'display:none;',
                    '{{WRAPPER}} .mphb_sc_booking_form-wrapper label abbr' => 'display:none;',
                ],
            ]
        );

        $this->add_control(
            'content_max_width',
            [
                'label' => __( 'Content Width', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .th-fo-form' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tip_color',
            [
                'label' => __( 'Required Tips Colour', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-required-fields-tip small' => 'color: {{VALUE}};',
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
                'name' => 'tip_color_typography',
                'selector' => '{{WRAPPER}} .mphb-required-fields-tip small',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,

            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Label Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_booking_form-wrapper label' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mphb_sc_booking_form-wrapper .mphb-reserve-room-section p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mphb_sc_booking_form-wrapper .mphb-errors-wrapper p' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_color_typography',
                'selector' => '{{WRAPPER}} .mphb_sc_booking_form-wrapper label',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
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

        //echo $settings['type_id'];
        if ( isset( $settings['type_id'] ) && ! empty( $settings['type_id']) && is_numeric($settings['type_id']) ) {

            /*if ( isset( $settings['months_to_show'] ) && ! empty( $settings['months_to_show'] ) && is_numeric($settings['months_to_show'])) {
                $th_monthstoshow = $settings['months_to_show'];
            }else{
                $th_monthstoshow=2;
            }*/

            $th_shortcode = '[mphb_availability id="'.$settings['type_id'].'"]';
            $th_shortcode = sanitize_text_field( $th_shortcode );
            $th_shortcode = do_shortcode( shortcode_unautop( $th_shortcode ) );

            // Add in special classes

            if ( function_exists( 'get_theme_mod' ) ) {
                $themo_mphb_styling = get_theme_mod('themo_mphb_use_theme_styling', true);
                if ($themo_mphb_styling == true) {

                    // Check Availabilty button
                    $th_shortcode = str_replace(
                        'mphb-reserve-btn-wrapper',
                        'mphb-reserve-btn-wrapper frm_submit',
                        $th_shortcode
                    );
                    // Confirm Reservation button
                    $th_shortcode = str_replace(
                        'mphb-reserve-room-section',
                        'mphb-reserve-room-section frm_submit',
                        $th_shortcode
                    );
                    // Date picker / checkin / checkout form
                    $th_shortcode = str_replace(
                        'mphb_sc_booking_form-wrapper',
                        'mphb_sc_booking_form-wrapper frm_forms with_frm_style',
                        $th_shortcode
                    );
                    // Check-in field
                    $th_shortcode = str_replace(
                        'mphb-check-in-date-wrapper',
                        'mphb-check-in-date-wrapper frm_form_field',
                        $th_shortcode
                    );
                    // Check-out field
                    $th_shortcode = str_replace(
                        'mphb-check-out-date-wrapper',
                        'mphb-check-out-date-wrapper frm_form_field',
                        $th_shortcode
                    );

                    // Dropdowns Adults
                    $th_shortcode = str_replace(
                        'mphb-adults-wrapper',
                        'mphb-adults-wrapper frm_form_field',
                        $th_shortcode
                    );
                    // Dropdowns Children
                    $th_shortcode = str_replace(
                        'mphb-children-wrapper',
                        'mphb-children-wrapper frm_form_field',
                        $th_shortcode
                    );
                    // Dropdowns Children
                    /*$th_shortcode = str_replace(
                        'mphb-check-children-date-wrapper',
                        'mphb-check-children-date-wrapper frm_form_field',
                        $th_shortcode
                    );*/
                }
            }



            $th_form_border_class = false;
            $th_formidable_class = 'th-form-default';
            if ( isset( $settings['inline_form'] ) && $settings['inline_form'] > "" ) :
                switch ( $settings['inline_form'] ) {
                    case 'stacked':
                        $th_formidable_class = 'th-form-stacked';
                        if ( isset( $settings['slide_shortcode_border'] ) && $settings['slide_shortcode_border'] != 'none' ) {
                            $th_form_border_class = $settings['slide_shortcode_border'];
                        }
                        break;
                    case 'inline':
                        $th_formidable_class = 'th-conversion';
                        break;
                }
            endif;

            /* Form Styling */
            $th_cal_align_class = false;
            if ( isset( $settings['slide_text_align'] ) && $settings['slide_text_align'] > "" ) {
                switch ( $settings['slide_text_align'] ) {
                    case 'left':
                        $th_cal_align_class = ' th-left';
                        break;
                    case 'center':
                        $th_cal_align_class = ' th-centered';
                        break;
                    case 'right':
                        $th_cal_align_class = ' th-right';
                        break;
                }
            }

            $this->add_render_attribute( 'th-form-class', 'class', 'th-fo-form');
            $this->add_render_attribute( 'th-form-class', 'class', esc_attr( $th_cal_align_class ) );
            $this->add_render_attribute( 'th-form-class', 'class', esc_attr( $th_formidable_class ) );
            $this->add_render_attribute( 'th-form-class', 'class', esc_attr( $th_form_border_class ) );
            $this->add_render_attribute( 'th-form-class', 'class', 'th-btn-form' );
            $this->add_render_attribute( 'th-form-class', 'class', 'btn-' . esc_attr( $settings['button_1_style'] . '-form' ) );

            $themo_form_styling = false;
            if ( function_exists( 'get_theme_mod' ) ) {
                $themo_mphb_styling = get_theme_mod('themo_mphb_use_theme_styling', true);
                if ($themo_mphb_styling == true) {
                    $themo_form_styling = $this->get_render_attribute_string( 'th-form-class');
                }
            }
            ?>
            <div <?php echo $themo_form_styling; ?>><?php echo $th_shortcode; ?></div>
            <?php
        }
    }

    public function render_plain_content() {
        // In plain mode, render without shortcode
        echo $this->get_settings( 'shortcode' );
    }

    protected function _content_template() {}

    public function add_wpml_support() {
        add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
    }

    public function wpml_widgets_to_translate_filter( $widgets ) {
        $widgets[ $this->get_name() ] = [
            'conditions' => [ 'widgetType' => $this->get_name() ],
            'fields'     => [

                [
                    'field'       => 'type_id',
                    'type'        => __( 'Type ID', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
            ],
        ];
        return $widgets;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_MPHB_Booking_Form() );
