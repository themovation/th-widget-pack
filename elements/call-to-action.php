<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_CallToAction extends Widget_Base {

	public function get_name() {
		return 'themo-call-to-action';
	}

	public function get_title() {
		return __( 'Call to Action', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_text',
			[
				'label' => __( 'Text', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Title', 'elementor' ),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_1',
			[
				'label' => __( 'Button 1', 'elementor' ),
			]
		);

		$this->add_control(
			'button_1_text',
			[
				'label' => __( 'Button Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_1_style',
			[
				'label' => __( 'Button Style', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'standard-primary',
				'options' => [
					'standard-primary' => __( 'Standard Primary', 'elementor' ),
					'standard-accent' => __( 'Standard Accent', 'elementor' ),
					'standard-light' => __( 'Standard Light', 'elementor' ),
					'standard-dark' => __( 'Standard Dark', 'elementor' ),
					'ghost-primary' => __( 'Ghost Primary', 'elementor' ),
					'ghost-accent' => __( 'Ghost Accent', 'elementor' ),
					'ghost-light' => __( 'Ghost Light', 'elementor' ),
					'ghost-dark' => __( 'Ghost Dark', 'elementor' ),
					'cta-primary' => __( 'CTA Primary', 'elementor' ),
					'cta-accent' => __( 'CTA Accent', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'button_1_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICON,
			]
		);

		$this->add_control(
			'button_1_link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_2',
			[
				'label' => __( 'Button 2', 'elementor' ),
			]
		);

		$this->add_control(
			'button_2_text',
			[
				'label' => __( 'Button Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_2_style',
			[
				'label' => __( 'Button Style', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'standard-primary',
				'options' => [
					'standard-primary' => __( 'Standard Primary', 'elementor' ),
					'standard-accent' => __( 'Standard Accent', 'elementor' ),
					'standard-light' => __( 'Standard Light', 'elementor' ),
					'standard-dark' => __( 'Standard Dark', 'elementor' ),
					'ghost-primary' => __( 'Ghost Primary', 'elementor' ),
					'ghost-accent' => __( 'Ghost Accent', 'elementor' ),
					'ghost-light' => __( 'Ghost Light', 'elementor' ),
					'ghost-dark' => __( 'Ghost Dark', 'elementor' ),
					'cta-primary' => __( 'CTA Primary', 'elementor' ),
					'cta-accent' => __( 'CTA Accent', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'button_2_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICON,
			]
		);

		$this->add_control(
			'button_2_link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_colors',
			[
				'label' => __( 'Colors', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		?>

		<?php
	}

	protected function _content_template() {
		?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_CallToAction() );
