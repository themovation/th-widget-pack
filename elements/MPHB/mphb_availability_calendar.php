<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_MPHB_Availability_Calendar extends Widget_Base {

    public function get_name() {
        return 'themo-mphb-availability-calendar';
    }

    public function get_title() {
        return __( 'Hotel Booking Availability Calendar', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return [ 'themo-elements' ];
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
            //'description' => __('ID of Accommodation Type to display availability.', 'th-widget-pack'),
            'default'     => '',
            'label_block' => true,
        ));

        $this->add_control('months_to_show', array(
            'type'        => Controls_Manager::TEXT,
            'label'       => __('Months to display', 'th-widget-pack'),
            //'description' => __('How many calendar months would you like to show?', 'th-widget-pack'),
            'default'     => '3'

            //.themo_mphb_availability_calendar{max-width:850px;}
        ));

        $this->add_control(
            'content_max_width',
            [
                'label' => __( 'Calendar Width', 'th-widget-pack' ),
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
                'default' => [
                    'size' => '650',
                    'unit' => 'px',
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_availability_calendar' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'calendar_align',
            [
                'label' => __( 'Center Align', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_availability_calendar' => 'margin: auto;',
                    //'(mobile){{WRAPPER}} .mphb_sc_availability_calendar-wrapper .mphb-calendar .datepick' => 'margin: auto;'
                ],
            ]
        );



        $this->end_controls_section();
    }

    protected function render() {

        global $post;

        $settings = $this->get_settings();

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


        if ( isset( $settings['type_id'] ) && ! empty( $settings['type_id'] && is_numeric($settings['type_id'])) ) {

            if ( isset( $settings['months_to_show'] ) && ! empty( $settings['months_to_show'] ) && is_numeric($settings['months_to_show'])) {
                $th_monthstoshow = $settings['months_to_show'];
            }else{
                $th_monthstoshow=2;
            }

            $th_shortcode = '[mphb_availability_calendar id='.$settings['type_id'].' monthstoshow='.$th_monthstoshow.']';
            $th_shortcode = sanitize_text_field( $th_shortcode );
            $th_shortcode = do_shortcode( shortcode_unautop( $th_shortcode ) );

            ?>
            <div class="elementor-shortcode themo_mphb_availability_calendar"><?php echo $th_shortcode; ?></div>
            <?php
        }
    }

    public function render_plain_content() {
        // In plain mode, render without shortcode
        echo $this->get_settings( 'shortcode' );
    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_MPHB_Availability_Calendar() );
