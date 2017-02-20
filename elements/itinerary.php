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
				'label' => __( 'Start all Toggles Expanded', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'On', 'elementor' ),
				'label_on' => __( 'Off', 'elementor' ),
				'default' => 'yes',
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
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Content Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$tabs = $this->get_settings( 'tabs' );
		?>
		<div class="elementor-toggle">
			<?php
			$counter = 1; ?>
			<?php foreach ( $tabs as $item ) : ?>
				<div class="elementor-toggle-title" data-tab="<?php echo $counter; ?>">
					<span class="elementor-toggle-icon">
						<i class="fa"></i>
					</span>
					<?php echo $item['tab_title']; ?>
				</div>
				<div class="elementor-toggle-content elementor-clearfix" data-tab="<?php echo $counter; ?>"><?php echo $this->parse_text_editor( $item['tab_content'] ); ?></div>
			<?php
				$counter++;
			endforeach; ?>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="elementor-toggle">
			<#
			if ( settings.tabs ) {
				var counter = 1;
				_.each(settings.tabs, function( item ) { #>
					<div class="elementor-toggle-title" data-tab="{{ counter }}">
						<span class="elementor-toggle-icon">
						<i class="fa"></i>
					</span>
						{{{ item.tab_title }}}
					</div>
					<div class="elementor-toggle-content elementor-clearfix" data-tab="{{ counter }}">{{{ item.tab_content }}}</div>
				<#
					counter++;
				} );
			} #>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Itinerary() );
