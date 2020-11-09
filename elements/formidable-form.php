<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Formidable extends Widget_Base {

	public function get_name() {
		return 'themo-formidable-form';
	}

	public function get_title() {
		return __( 'Formidable Form', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'section_shortcode',
			[
				'label' => __( 'Form shortcode', 'th-widget-pack' ),
			]
		);

        $this->add_control(
            'shortcode',
            [
                'label' => __( 'Shortcode', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( '[formidable id=3]', 'th-widget-pack' ),
                'default' => __( '[formidable id=3]', 'th-widget-pack' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'inline_form',
            [
                'label' => __( 'Formidable Form Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'Default', 'th-widget-pack' ),
                    'inline' => __( 'Inline', 'th-widget-pack' ),
                    'stacked' => __( 'Stacked', 'th-widget-pack' ),

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

        $this->add_responsive_control(
            'content_max_width',
            [
                'label' => __( 'Content Width', 'elementor' ),
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
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if ( isset( $settings['shortcode'] ) && ! empty( $settings['shortcode'] ) ) {
            $th_shortcode = sanitize_text_field( $settings['shortcode'] );
            $th_shortcode = do_shortcode( shortcode_unautop( $th_shortcode ) );

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


            ?>
            <div <?php echo $this->get_render_attribute_string( 'th-form-class'); ?>><?php echo $th_shortcode; ?></div>
            <?php
        }

	}

	/*public function render_plain_content() {
		// In plain mode, render without shortcode
		echo sanitize_text_field($this->get_settings( 'shortcode' ));
	}*/

	protected function _content_template() {}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$widgets[ $this->get_name() ] = [
			'conditions' => [ 'widgetType' => $this->get_name() ],
			'fields'     => [
				[
					'field'       => 'shortcode',
					'type'        => __( 'Shortcode', 'th-widget-pack' ),
					'editor_type' => 'LINE'
				],
			],
		];
		return $widgets;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Formidable() );
