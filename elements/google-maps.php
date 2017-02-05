<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_GoogleMaps extends Widget_Base {

	public function get_name() {
		return 'themo-google-maps';
	}

	public function get_title() {
		return __( 'Google Maps', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_map',
			[
				'label' => __( 'Map', 'elementor' ),
			]
		);

		$default_address = __( 'London Eye, London, United Kingdom', 'elementor' );
		$this->add_control(
			'address',
			[
				'label' => __( 'Address', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => $default_address,
				'default' => $default_address,
				'label_block' => true,
			]
		);

		$this->add_control(
			'zoom',
			[
				'label' => __( 'Zoom Level', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __( 'Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 300,
				],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 1440,
					],
				],
				'selectors' => [
					'{{WRAPPER}} iframe' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'prevent_scroll',
			[
				'label' => __( 'Prevent Scroll', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'elementor' ),
				'label_off' => __( 'No', 'elementor' ),
				'selectors' => [
					'{{WRAPPER}} iframe' => 'pointer-events: none;',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'elementor' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_block',
			[
				'label' => __( 'Text Block', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'address',
			[
				'label' => __( 'Address', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'hours',
			[
				'label' => __( 'Hours', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_1_text',
			[
				'label' => __( 'Link 1 Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_1_url',
			[
				'label' => __( 'Link 1 URL', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'elementor' ),
			]
		);

		$this->add_control(
			'link_2_text',
			[
				'label' => __( 'Link 2 Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_2_url',
			[
				'label' => __( 'Link 2 URL', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['address'] ) )
			return;

		if ( 0 === absint( $settings['zoom']['size'] ) )
			$settings['zoom']['size'] = 10;

		printf(
			'<div class="elementor-custom-embed"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%s&amp;t=m&amp;z=%d&amp;output=embed&amp;iwloc=near"></iframe></div>',
			urlencode( $settings['address'] ),
			absint( $settings['zoom']['size'] )
		);
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_GoogleMaps() );
