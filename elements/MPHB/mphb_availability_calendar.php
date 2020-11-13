<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_MPHB_Availability_Calendar extends Widget_Base {

    public function get_name() {
        return 'themo-mphb-availability-calendar';
    }

    public function get_title() {
        return __( 'Accommodation Availability Calendar', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-archive-posts';
    }

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
    public function get_categories() {
        return [ 'themo-elements' ];
    }

    public function is_reload_preview_required() {
        return true;
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tooltip',
            [
                'label' => __( 'Tooltip Title', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'tooltip_title',
            [
                'label' => __( 'Text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Book Today', 'th-widget-pack' ),
                'placeholder' => __( 'Book here', 'th-widget-pack' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'tooltip_color',
            [
                'label' => __( 'Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .th-cal-tooltip h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tooltip_background',
            [
                'label' => __( 'Background Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-cal-tooltip' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .th-cal-tooltip:after' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

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

        $this->add_control('months_to_show', array(
            'type'        => Controls_Manager::TEXT,
            'label'       => __('Months to display', 'th-widget-pack'),
            'default'     => '3',
            'dynamic' => [
                'active' => true,
            ]
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
                'dynamic' => [
                    'active' => true,
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
                ],
            ]
        );



        $this->end_controls_section();
    }

    protected function render() {

        global $post;

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'th-cal-tooltip', 'class', 'th-cal-tooltip' );

        // If Accommodation type id field is empty, try to get the id automatically.
        if ( !isset( $settings['type_id'] ) || empty( $settings['type_id']) ) {
            if(isset($post->ID )&& $post->ID > ""){
                $postID = $post->ID;
                $themo_post_type = get_post_type($postID);
                if(isset($themo_post_type) && $themo_post_type=='mphb_room_type'){
                    $settings['type_id'] = $postID;
                }else{
                    $themo_mphb_args = array(
                        'orderby' => 'rand',
                        'posts_per_page' => '1',
                        'post_type' => 'mphb_room_type'
                    );
                    $mphb_room_type_loop = new \WP_Query( $themo_mphb_args );
                    while ( $mphb_room_type_loop->have_posts() ) : $mphb_room_type_loop->the_post();
                        $mphb_room_type_id = get_the_ID();
                        $settings['type_id'] = $mphb_room_type_id;
                    endwhile;


                }
            }
        }


        if ( isset( $settings['type_id'] ) && ! empty( $settings['type_id']) && is_numeric($settings['type_id']) ) {

            if ( isset( $settings['months_to_show'] ) && ! empty( $settings['months_to_show'] ) && is_numeric($settings['months_to_show'])) {
                $th_monthstoshow = $settings['months_to_show'];
            }else{
                $th_monthstoshow=2;
            }

            $th_shortcode = '[mphb_availability_calendar id='.$settings['type_id'].' monthstoshow='.$th_monthstoshow.']';
            $th_shortcode = sanitize_text_field( $th_shortcode );
            $th_shortcode = do_shortcode( shortcode_unautop( $th_shortcode ) );

            ?>
            <div class="elementor-shortcode themo_mphb_availability_calendar">
                <?php if( $settings['tooltip_title'] ) : ?>
                    <div <?php echo $this->get_render_attribute_string( 'th-cal-tooltip'); ?>><h3><?php echo esc_html( $settings['tooltip_title'] ); ?></h3></div>
                <?php endif; ?>
                <?php echo $th_shortcode; ?>
            </div>
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
                    'field'       => 'tooltip_title',
                    'type'        => __( 'Tooltip Title', 'th-widget-pack' ),
                    'editor_type' => 'LINE'
                ],
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

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_MPHB_Availability_Calendar() );
