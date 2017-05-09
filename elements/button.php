<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Button extends Widget_Base {

	public function get_name() {
		return 'themo-button';
	}

	public function get_title() {
		return __( 'Button', 'th-widget-pack' );
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
				'label' => __( 'Button 1', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'button_1_text',
			[
				'label' => __( 'Button Text', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Book Tour', 'th-widget-pack' ),
				'placeholder' => __( 'Book Tour', 'th-widget-pack' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_1_style',
			[
				'label' => __( 'Button Style', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'standard-primary',
				'options' => [
					'standard-primary' => __( 'Standard Primary', 'th-widget-pack' ),
					'standard-accent' => __( 'Standard Accent', 'th-widget-pack' ),
					'standard-light' => __( 'Standard Light', 'th-widget-pack' ),
					'standard-dark' => __( 'Standard Dark', 'th-widget-pack' ),
					'ghost-primary' => __( 'Ghost Primary', 'th-widget-pack' ),
					'ghost-accent' => __( 'Ghost Accent', 'th-widget-pack' ),
					'ghost-light' => __( 'Ghost Light', 'th-widget-pack' ),
					'ghost-dark' => __( 'Ghost Dark', 'th-widget-pack' ),
					'cta-primary' => __( 'CTA Primary', 'th-widget-pack' ),
					'cta-accent' => __( 'CTA Accent', 'th-widget-pack' ),
				],
			]
		);

		$this->add_control(
			'button_1_link',
			[
				'label' => __( 'Link', 'th-widget-pack' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( '#booktour', 'th-widget-pack' ),
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_2',
			[
				'label' => __( 'Button 2', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'button_2_text',
			[
				'label' => __( 'Button Text', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Book Tour', 'th-widget-pack' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_2_style',
			[
				'label' => __( 'Button Style', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'standard-primary',
				'options' => [
					'standard-primary' => __( 'Standard Primary', 'th-widget-pack' ),
					'standard-accent' => __( 'Standard Accent', 'th-widget-pack' ),
					'standard-light' => __( 'Standard Light', 'th-widget-pack' ),
					'standard-dark' => __( 'Standard Dark', 'th-widget-pack' ),
					'ghost-primary' => __( 'Ghost Primary', 'th-widget-pack' ),
					'ghost-accent' => __( 'Ghost Accent', 'th-widget-pack' ),
					'ghost-light' => __( 'Ghost Light', 'th-widget-pack' ),
					'ghost-dark' => __( 'Ghost Dark', 'th-widget-pack' ),
					'cta-primary' => __( 'CTA Primary', 'th-widget-pack' ),
					'cta-accent' => __( 'CTA Accent', 'th-widget-pack' ),
				],
			]
		);


		$this->add_control(
			'button_2_link',
			[
				'label' => __( 'Link', 'th-widget-pack' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( '#booktour', 'th-widget-pack' ),
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'button_alignment',
            [
                'label' => __( 'Button Alignment', 'th-widget-pack' ),
                'type' => Controls_Manager::SECTION,
            ]
        );



        $this->add_control(
			'button_align',
			[
				'label' => __( 'Alignment', 'th-widget-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'th-widget-pack' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'th-widget-pack' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'th-widget-pack' ),
						'icon' => 'fa fa-align-right',
					],

				],
				'prefix_class' => 'th-btn-align-',
				'default' => '',
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        if ( empty( $settings['button_1_link']['url'] ) ) { $settings['button_1_link']['url'] = '#'; };
        if ( empty( $settings['button_2_link']['url'] ) ) { $settings['button_2_link']['url'] = '#'; };

		$this->add_render_attribute( 'btn-1-link', 'class', 'btn-1' );
		$this->add_render_attribute( 'btn-1-link', 'class', 'btn' );
		$this->add_render_attribute( 'btn-1-link', 'class', 'th-btn' );
		$this->add_render_attribute( 'btn-1-link', 'class', 'btn-' . esc_attr( $settings['button_1_style'] ) );

		if ( ! empty( $settings['button_1_link']['url'] ) ) {
			$this->add_render_attribute( 'btn-1-link', 'href', esc_url( $settings['button_1_link']['url'] ) );

			if ( ! empty( $settings['button_1_link']['is_external'] ) ) {
				$this->add_render_attribute( 'btn-1-link', 'target', '_blank' );
			}
		}

		$this->add_render_attribute( 'btn-2-link', 'class', 'btn-2' );
		$this->add_render_attribute( 'btn-2-link', 'class', 'btn' );
		$this->add_render_attribute( 'btn-2-link', 'class', 'th-btn' );
		$this->add_render_attribute( 'btn-2-link', 'class', 'btn-' . esc_attr( $settings['button_2_style'] ) );

		if ( ! empty( $settings['button_2_link']['url'] ) ) {
			$this->add_render_attribute( 'btn-2-link', 'href', esc_url( $settings['button_2_link']['url'] ) );

			if ( ! empty( $settings['button_2_link']['is_external'] ) ) {
				$this->add_render_attribute( 'btn-2-link', 'target', '_blank' );
			}
		}
		?>

        <?php if ( ! empty( $settings['button_1_text'] ) ) : ?>
			<a <?php echo $this->get_render_attribute_string( 'btn-1-link' ); ?>>
				<?php if ( ! empty( $settings['button_1_text'] ) ) : ?>
					<?php echo esc_html( $settings['button_1_text'] ); ?>
				<?php endif; ?>
			</a>
		<?php endif; ?>

		<?php if ( ! empty( $settings['button_2_text'] ) ) : ?>
			<a <?php echo $this->get_render_attribute_string( 'btn-2-link' ); ?>>
				<?php if ( ! empty( $settings['button_2_text'] ) ) : ?>
					<?php echo esc_html( $settings['button_2_text'] ); ?>
				<?php endif; ?>
			</a>
		<?php endif; ?>

		<?php
	}

	protected function _content_template() {
		?>
        <#  var button_1_link_url = '#';
            if ( settings.button_1_link.url ) { var button_1_link_url = settings.button_1_link.url }

             var button_2_link_url = '#';
             if ( settings.button_2_link.url ) { var button_2_link_url = settings.button_2_link.url }
        #>

		<# if ( button_1_link_url ) { #>
			<a class="btn btn-1 th-btn btn-{{ settings.button_1_style }}" href="{{ button_1_link_url }}">
				{{{ settings.button_1_text }}}
			</a>
		<# } #>
		<# if ( button_2_link_url  && settings.button_2_text ) { #>
			<a class="btn btn-2 th-btn btn-{{ settings.button_2_style }}" href="{{ button_2_link_url }}">
				{{{ settings.button_2_text }}}
			</a>
		<# } #>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Button() );
