<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Appointments extends Widget_Base {

	public function get_name() {
		return 'themo-appointments';
	}

	public function get_title() {
		return __( 'Booked Appointment Calendar', 'elementor' );
	}

	public function get_icon() {
		return 'countdown';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_tooltip',
			[
				'label' => __( 'Tooltip Title', 'elementor' ),
			]
		);

		$this->add_control(
			'tooltip_title',
			[
				'label' => __( 'Tooltip Title (optional)', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Book here', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tooltip_background',
			[
				'label' => __( 'Tooltip Background', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-cal-tooltip h3' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_calendar',
			[
				'label' => __( 'Calendar', 'elementor' ),
			]
		);

		$this->add_control(
			'calendar_shortcode',
			[
				'label' => __( 'Shortcode', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '[add_shortcode_here]', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'calendar_size',
			[
				'label' => __( 'Calendar Size', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => [
					'large' => __( 'Large', 'elementor' ),
					'small' => __( 'Small', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'calendar_align',
			[
				'label' => __( 'Align Calendar', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => [
					'left' => __('Left', 'elementor'),
					'centered' => __('Center', 'elementor'),
					'right' => __('Right', 'elementor'),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_tooltip',
			[
				'label' => __( 'Tooltip Title', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tooltip_color',
			[
				'label' => __( 'Tooltip Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .th-cal-tooltip h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tooltip_typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-cal-tooltip h3',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		?>
		<div class="th-book-cal-<?php echo esc_attr( $settings['calendar_size'] ); ?> th-<?php echo esc_attr( $settings['calendar_align'] ); ?>">
			<?php if( $settings['tooltip_title'] ) : ?>
				<div class="th-cal-tooltip"><h3><?php echo esc_html( $settings['tooltip_title'] ); ?></h3></div>
			<?php endif; ?>
			<?php echo do_shortcode( $settings['calendar_shortcode'] ); ?>
		</div>
		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Appointments() );