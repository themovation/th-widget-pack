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

		$this->add_control(
			'shortcode',
			[
				'label' => __( 'Insert your shortcode here', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '[formidable id=3]',
				'placeholder' => '[formidable id="3"]',
			]
		);

        $this->add_control(
            'inline_form',
            [
                'label' => __( 'Show form inline', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'th-conversion',
                'label_on' => __( 'Yes', 'elementor' ),
                'label_off' => __( 'No', 'elementor' ),
                'return_value' => 'th-conversion',
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings();

        if(isset($settings['shortcode']) && ! empty($settings['shortcode'])){
            $th_shortcode = $settings['shortcode'];
            $th_shortcode = do_shortcode( shortcode_unautop( $th_shortcode ) );
            $this->add_render_attribute( 'th-form-class', 'class', esc_attr($settings['inline_form']) );
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