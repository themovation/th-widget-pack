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
				'default' => __( 'Book Tour', 'elementor' ),
				'placeholder' => __( 'Book Tour', 'elementor' ),
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
				'icons' => themo_icons(),
			]
		);

		$this->add_control(
			'button_1_link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( '#booktour', 'elementor' ),
			]
		);

		/*$this->add_responsive_control(
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
				'prefix_class' => 'btn-1%s-align-',
				'default' => '',
			]
		);*/

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
				'placeholder' => __( 'Book Tour', 'elementor' ),
				//'default' => __( 'Book Tour', 'elementor' ),
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
				'icons' => themo_icons(),
			]
		);

		$this->add_control(
			'button_2_link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( '#booktour', 'elementor' ),
			]
		);

		/*$this->add_responsive_control(
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
				'prefix_class' => 'btn-2%s-align-',
				'default' => '',
			]
		);*/

		$this->end_controls_section();

        $this->start_controls_section(
            'button_alignment',
            [
                'label' => __( 'Button Alignment', 'elementor' ),
                'type' => Controls_Manager::SECTION,
            ]
        );



        $this->add_control(
			'button_align',
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
					/*'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'fa fa-align-justify',
					],*/
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
		$this->add_render_attribute( 'btn-1-link', 'class', 'btn-' . esc_attr($settings['button_1_style']) );

		if ( ! empty( $settings['button_1_link']['url'] ) ) {
			$this->add_render_attribute( 'btn-1-link', 'href', esc_url($settings['button_1_link']['url']) );

			if ( ! empty( $settings['button_1_link']['is_external'] ) ) {
				$this->add_render_attribute( 'btn-1-link', 'target', '_blank' );
			}
		}

		$this->add_render_attribute( 'btn-2-link', 'class', 'btn-2' );
		$this->add_render_attribute( 'btn-2-link', 'class', 'btn' );
		$this->add_render_attribute( 'btn-2-link', 'class', 'th-btn' );
		$this->add_render_attribute( 'btn-2-link', 'class', 'btn-' . esc_attr($settings['button_2_style']) );

		if ( ! empty( $settings['button_2_link']['url'] ) ) {
			$this->add_render_attribute( 'btn-2-link', 'href', esc_url($settings['button_2_link']['url']) );

			if ( ! empty( $settings['button_2_link']['is_external'] ) ) {
				$this->add_render_attribute( 'btn-2-link', 'target', '_blank' );
			}
		}
		?>

        <?php if ( ! empty( $settings['button_1_text']) ||  ! empty( $settings['button_1_icon'])) : ?>
			<a <?php echo $this->get_render_attribute_string( 'btn-1-link' ); ?>>
				<?php if ( ! empty( $settings['button_1_text'] ) ) : ?>
					<?php echo esc_html( $settings['button_1_text'] ); ?>
				<?php endif; ?>
				<?php if ( ! empty( $settings['button_1_icon'] ) ) : ?>
					<i class="<?php echo esc_attr( $settings['button_1_icon'] ); ?>"></i>
				<?php endif; ?>
			</a>
		<?php endif; ?>

		<?php if ( ! empty( $settings['button_2_text']) ||  ! empty( $settings['button_2_icon'])) : ?>
			<a <?php echo $this->get_render_attribute_string( 'btn-2-link' ); ?>>
				<?php if ( ! empty( $settings['button_2_text'] ) ) : ?>
					<?php echo esc_html( $settings['button_2_text'] ); ?>
				<?php endif; ?>
				<?php if ( ! empty( $settings['button_2_icon'] ) ) : ?>
					<i class="<?php echo esc_attr( $settings['button_2_icon'] ); ?>"></i>
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
				<# if ( settings.button_1_icon ) { #>
					<i class="{{ settings.button_1_icon }}"></i>
				<# } #>
			</a>
		<# } #>
		<# if ( button_2_link_url  && (settings.button_2_text || settings.button_2_icon) ) { #>
			<a class="btn btn-2 th-btn btn-{{ settings.button_2_style }}" href="{{ button_2_link_url }}">
				{{{ settings.button_2_text }}}
				<# if ( settings.button_2_icon ) { #>
					<i class="{{ settings.button_2_icon }}"></i>
				<# } #>
			</a>
		<# } #>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Button() );
