<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Itinerary extends Widget_Base {

	public function get_name() {
		return 'themo-itinerary';
	}

	public function get_title() {
		return __( 'Itinerary', 'th-widget-pack' );
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
				'label' => __( 'Itinerary', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => __( 'Items', 'th-widget-pack' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title' => __( 'Day 1 Training', 'th-widget-pack' ),
						'tab_content' => __( 'Nulla vitae elit libero, a pharetra augue. Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo.', 'th-widget-pack' ),
					],
					[
						'tab_title' => __( 'Day 2 Rafting Whitewater', 'th-widget-pack' ),
						'tab_content' => __( 'Nulla vitae elit libero, a pharetra augue. Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo.', 'th-widget-pack' ),
					],
                    [
                        'tab_title' => __( 'Day 3 Rafting The Chilko', 'th-widget-pack' ),
                        'tab_content' => __( 'Nulla vitae elit libero, a pharetra augue. Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo.', 'th-widget-pack' ),
                    ],
				],
				'fields' => [
					[
						'name' => 'tab_title',
						'label' => __( 'Title & Content', 'th-widget-pack' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Itinerary Title' , 'th-widget-pack' ),
					],
					[
						'name' => 'tab_content',
						'label' => __( 'Content', 'th-widget-pack' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => __( 'Itinerary Content', 'th-widget-pack' ),
						'show_label' => false,
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'th-widget-pack' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'expanded',
			[
				'label' => __( 'Start all Items Expanded', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'th-widget-pack' ),
				'label_on' => __( 'On', 'th-widget-pack' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'width',
			[
				'label' => __( 'Width', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'th-itin-narrow',
				'options' => [
					'th-itin-narrow' => __( 'Narrow', 'th-widget-pack' ),
					'th-itin-med' => __( 'Medium', 'th-widget-pack' ),
					'th-itin-fw' => __( 'Full Width', 'th-widget-pack' ),
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'th-itin-center',
				'options' => [
					'th-itin-center' => __( 'Center', 'th-widget-pack' ),
					'th-itin-left' => __( 'Left', 'th-widget-pack' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_colors',
			[
				'label' => __( 'Colors', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-itin-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Content Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-itin-content *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'vertical_line_color',
			[
				'label' => __( 'Vertical Line Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-itin-content' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dot_color',
			[
				'label' => __( 'Dot Color', 'th-widget-pack' ),
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
		$this->add_render_attribute( 'itin-main', 'class', esc_attr( $settings['width'] ) );
		$this->add_render_attribute( 'itin-main', 'class', esc_attr( $settings['alignment'] ) );
		?>
		<div <?php echo $this->get_render_attribute_string( 'itin-main' ); ?>>
			<?php
			$counter = 1; ?>
			<?php foreach ( $tabs as $item ) : ?>
				<div class="th-itin-single<?php echo ( esc_attr( $settings['expanded'] ) ? ' th-itin-active' : ( $counter == 1 ? ' th-itin-active' : ' th-itin-inactive' ) ); ?>">
					<i class="th-itin-icon fa fa-circle-o"></i>
					<div class="th-itin-title">
						<span><?php echo esc_html( $item['tab_title'] ); ?></span>
					</div>
					<div class="th-itin-content">
						<?php echo wp_kses_post( $this->parse_text_editor( $item['tab_content'] ) ); ?>
					</div>
				</div>
			<?php
				$counter++;
			endforeach; ?>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="th-itinerary {{settings.width}} {{settings.alignment}}">
			<#
			if ( settings.tabs ) {
				_.each(settings.tabs, function( item ) { #>
					<div class="th-itin-single{{ settings.expanded ? ' th-itin-active' : '' }}">
						<i class="th-itin-icon fa fa-circle-o"></i>
						<div class="th-itin-title">
							<span>{{{ item.tab_title }}}</span>
						</div>
						<div class="th-itin-content">
							{{{ item.tab_content }}}
						</div>
					</div>
				<#
				} );
			} #>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Itinerary() );
