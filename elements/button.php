<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Button extends Widget_Base {

	public function get_name() {
		return 'themo-button';
	}

	public function get_title() {
		return __( 'Button', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
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
					'cta-primary' => __( 'CTA Accent', 'elementor' ),
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

		$this->add_responsive_control(
			'button_1_align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
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
					'cta-primary' => __( 'CTA Accent', 'elementor' ),
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

		$this->add_responsive_control(
			'button_2_align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
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

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Button() );
