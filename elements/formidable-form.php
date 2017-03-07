<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Formidable extends Widget_Base {

	public function get_name() {
		return 'themo-formidable-form';
	}

	public function get_title() {
		return __( 'Formidable Form', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
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
				'label' => __( 'Form shortcode', 'elementor' ),
			]
		);

		/*$this->add_control(
			'shortcode',
			[
				'label' => __( 'Insert your shortcode here', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '[formidable id=3]',
				'placeholder' => '[formidable id="3"]',
			]
		);*/

        $this->add_control(
            'shortcode',
            [
                'label' => __( 'Shortcode', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( '[formidable id=3]', 'elementor' ),
                'default' => __( '[formidable id=3]', 'elementor' )
            ]
        );

        /*$this->add_control(
            'inline_form',
            [
                'label' => __( 'Show form inline', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'th-conversion',
                'label_on' => __( 'Yes', 'elementor' ),
                'label_off' => __( 'No', 'elementor' ),
                'return_value' => 'th-conversion',
            ]
        );*/
        $this->add_control(
            'inline_form',
            [
                'label' => __( 'Formidable Form Style', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'Default', 'elementor' ),
                    'inline' => __( 'Inline', 'elementor' ),
                    'stacked' => __( 'Stacked', 'elementor' ),

                ],
            ]
        );
        $this->add_control(
            'slide_shortcode_border',
            [
                'label' => __( 'Form Background', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'elementor' ),
                    'th-form-bg th-light-bg' => __( 'Light', 'elementor' ),
                    'th-form-bg th-dark-bg' => __( 'Dark', 'elementor' ),

                ],
                'condition' => [
                    'inline_form' => 'stacked',
                ],
            ]
        );

        $this->add_control(
            'slide_text_align',
            [
                'label' => __( 'Align', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                ],
                'default' => 'center',
            ]
        );

        $this->add_control(
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
                /*'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],*/
                'selectors' => [
                    '{{WRAPPER}} .th-fo-form' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings();

        if(isset($settings['shortcode']) && ! empty($settings['shortcode'])){
            $th_shortcode = sanitize_text_field($settings['shortcode']);
            $th_shortcode = do_shortcode( shortcode_unautop( $th_shortcode ) );

            $th_form_border_class = false;
            $th_formidable_class = 'th-form-default';
            if ( isset($settings['inline_form']) && $settings['inline_form'] > "") :
                switch ($settings['inline_form']) {
                    case 'stacked':
                        $th_formidable_class = 'th-form-stacked';
                        if (isset($settings['slide_shortcode_border']) && $settings['slide_shortcode_border'] != 'none'){
                            $th_form_border_class = $settings['slide_shortcode_border'];
                        }
                        break;
                    case 'inline':
                        $th_formidable_class = 'th-conversion';
                        break;
                }
            endif;

            $th_cal_align_class = false;
            if(isset($settings['slide_text_align']) && $settings['slide_text_align'] > ""){
                switch ($settings['slide_text_align']) {
                    case 'left':
                        $th_cal_align_class =  ' th-left';
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
            $this->add_render_attribute( 'th-form-class', 'class', esc_attr($th_cal_align_class));
            $this->add_render_attribute( 'th-form-class', 'class', esc_attr($th_formidable_class));
            $this->add_render_attribute( 'th-form-class', 'class', esc_attr($th_form_border_class));


            ?>
            <div <?php echo $this->get_render_attribute_string( 'th-form-class'); ?>><?php echo $th_shortcode; ?></div>
            <?php
        }

	}

	public function render_plain_content() {
		// In plain mode, render without shortcode
		echo $this->get_settings( 'shortcode' );
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Formidable() );