<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Itinerary extends Widget_Base {

	public function get_name() {
		return 'themo-itinerary';
	}

	public function get_title() {
		return __( 'Itinerary', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-toggle';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_toggles',
			[
				'label' => __( 'Toggles', 'elementor' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => __( 'Items', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title' => __( 'Item #1', 'elementor' ),
						'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
					],
					[
						'tab_title' => __( 'Item #2', 'elementor' ),
						'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
					],
				],
				'fields' => [
					[
						'name' => 'tab_title',
						'label' => __( 'Title & Content', 'elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Toggle Title' , 'elementor' ),
					],
					[
						'name' => 'tab_content',
						'label' => __( 'Content', 'elementor' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => __( 'Toggle Content', 'elementor' ),
						'show_label' => false,
					],
				],
				'title_field' => '{{{ tab_title }}}',
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

		$this->add_control(
			'expanded',
			[
				'label' => __( 'Start all Items Expanded', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'elementor' ),
				'label_on' => __( 'On', 'elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'width',
			[
				'label' => __( 'Width', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'th-itin-narrow',
				'options' => [
					'th-itin-narrow' => __( 'Narrow', 'elementor' ),
					'th-itin-med' => __( 'Medium', 'elementor' ),
					'th-itin-fw' => __( 'Full Width', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'th-itin-center',
				'options' => [
					'th-itin-center' => __( 'Center', 'elementor' ),
					'th-itin-left' => __( 'Left', 'elementor' ),
				],
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
			'title_color',
			[
				'label' => __( 'Title Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-itin-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Content Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-itin-content *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'vertical_line_color',
			[
				'label' => __( 'Vertical Line Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-itin-content' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dot_color',
			[
				'label' => __( 'Dot Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-itin-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$tabs = $this->get_settings( 'tabs' );

		$this->add_render_attribute( 'itin-main', 'class', 'th-itinerary' );
		$this->add_render_attribute( 'itin-main', 'class', $settings['width'] );
		$this->add_render_attribute( 'itin-main', 'class', $settings['alignment'] );
		?>
		<div <?php echo $this->get_render_attribute_string( 'itin-main' ); ?>>
			<?php
			$counter = 1; ?>
			<?php foreach ( $tabs as $item ) : ?>
				<div class="th-itin-single">
					<i class="th-itin-icon halflings halflings-record-empty"></i>
					<div class="th-itin-title">
						<span><?php echo $item['tab_title']; ?></span>
					</div>
					<div class="th-itin-content">
						<?php echo $item['tab_content']; ?>
					</div>
				</div>
			<?php
				$counter++;
			endforeach; ?>
		</div>
		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Itinerary() );
