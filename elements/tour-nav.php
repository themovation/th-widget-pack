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
			'items',
			[
				'label' => __( 'Items', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'icon' => __( 'fa fa-money', 'elementor' ),
                        'text' => __( '$99 per person', 'elementor' ),
                    ],
                    [
                        'icon' => __( 'fa fa-clock-o', 'elementor' ),
                        'text' => __( '3 Hours', 'elementor' ),
                    ],
                    [
                        'icon' => __( 'fa fa-user-o', 'elementor' ),
                        'text' => __( '3+ People', 'elementor' ),
                    ],

                ],
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
                'default' => 'rgba(0,0,0,0.5)',
			]
		);

		/*$this->add_control(
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
		);*/

		/*$this->add_control(
			'details',
			[
				'label' => __( 'Tour Details', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'return_value' => 'off',
			]
		);*/

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
					'{{WRAPPER}} .th-tour-nav-item i' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-tour-nav-item span' => 'color: {{VALUE}};',
				],
                'default' => '#ffffff',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        $items = $this->get_settings( 'items' );

		?>
		<div class="th-tour-nav">
			<div class="th-tour-nav-items">
				<?php
				$counter = 1; ?>
                <?php foreach ( $items as $item ) : ?>
					<span class="th-tour-nav-item">
						<i class="<?php echo esc_attr($item['icon']); ?>" aria-hidden="true"></i>
						<span><?php echo esc_html($item['text']); ?></span>
					</span>
                    <?php
                    $counter++;
                endforeach; ?>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
        <div class="th-tour-nav">
            <div class="th-tour-nav-items">
            <# if ( settings.items ) {
                    _.each(settings.items, function( item ) { #>
                    <span class="th-tour-nav-item">
                        <i class="{{{ item.icon }}}" aria-hidden="true"></i>
                        <span>{{{ item.text }}}</span>
                    </span>

                <#  } );
                } #>
            </div>
        </div>
        <?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_TourNav() );
