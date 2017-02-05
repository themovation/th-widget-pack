<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_TourNav extends Widget_Base {

	public function get_name() {
		return 'themo-tour-nav';
	}

	public function get_title() {
		return __( 'Tour Nav', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-form-vertical';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_items',
			[
				'label' => __( 'Items', 'elementor' ),
			]
		);

		$this->add_control(
			'item',
			[
				'label' => __( 'Items', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'icon',
						'label' => __( 'Icon', 'elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => '',
						'label_block' => true,
					],
					[
						'name' => 'text',
						'label' => __( 'Text', 'elementor' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => '$99/person',
						'label_block' => true,
					],
				],
				'title_field' => '<i class="{{ icon }}"></i> {{{ text }}}',
			]
		);

		$this->add_control(
			'background',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'prev_next_links',
			[
				'label' => __( 'Prev / Next Links', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'off',
			]
		);

		$this->add_control(
			'back_link',
			[
				'label' => __( 'Back Link', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'off',
			]
		);

		$this->add_control(
			'details',
			[
				'label' => __( 'Tour Details', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'off',
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
			'icon',
			[
				'label' => __( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text',
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

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_TourNav() );
