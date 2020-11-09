<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_MPHB_Accommodation_Rates extends Widget_Base {

    public function get_name() {
        return 'themo-mphb-accommodation-rates';
    }

    public function get_title() {
        return __( 'Accommodation Rates', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-price-list';
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
                'label' => __( 'Accommodation Rates', 'th-widget-pack' ),
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

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_color',
            [
                'label' => __( 'Typography & Color', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_rates .mphb-room-rates-list li' => 'color: {{VALUE}};',
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
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .themo_mphb_room_rates .mphb-room-rates-list li',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_rates .mphb-room-rates-list li .mphb-price' => 'color: {{VALUE}};',
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
                'name' => 'price_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .themo_mphb_room_rates .mphb-room-rates-list li .mphb-price',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'price_period_color',
            [
                'label' => __( 'Price Period Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_rates .mphb-room-rates-list li .mphb-price-period' => 'color: {{VALUE}};',
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
                'name' => 'price_period_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .themo_mphb_room_rates .mphb-room-rates-list li .mphb-price-period',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'price_period_clear',
            [
                'label' => __( 'Remove Plugin Styling', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .themo_mphb_room_rates .mphb-room-rates-list li .mphb-price-period' => 'border-bottom: none;cursor: initial',

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

            $th_shortcode = '[mphb_rates id='.$settings['type_id'].']';
            $th_shortcode = sanitize_text_field( $th_shortcode );
            $th_shortcode = do_shortcode( shortcode_unautop( $th_shortcode ) );

            ?>
            <div class="elementor-shortcode themo_mphb_room_rates"><?php echo $th_shortcode; ?></div>
            <?php
        }
    }

    public function render_plain_content() {
        // In plain mode, render without shortcode
        echo $this->get_settings( 'shortcode' );
    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_MPHB_Accommodation_Rates() );
