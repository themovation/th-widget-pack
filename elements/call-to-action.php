<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_CallToAction extends Widget_Base {

	public function get_name() {
		return 'themo-call-to-action';
	}

	public function get_title() {
		return __( 'Call to Action', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_text',
			[
				'label' => __( 'Text', 'elementor' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Does this look like fun, book tickets today!', 'elementor' ),
				'placeholder' => __( 'Title', 'elementor' ),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_colors',
			[
				'label' => __( 'Colors', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-cta-text span' => 'color: {{VALUE}};',
				],
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
		<div class="th-cta">
			<?php if ( $settings['text'] ) : ?>
		        <div class="th-cta-text">
		            <span><?php echo esc_html( $settings['text'] ); ?></span>
		        </div>
		    <?php endif; ?>
            <?php if ( ! empty( $settings['button_1_text']) ||  ! empty( $settings['button_1_icon']) || ! empty( $settings['button_2_text']) ||  ! empty( $settings['button_2_icon'])) : ?>
            <div class="th-cta-btn">
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
            </div>
            <?php endif; ?>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="th-cta">
			<# if ( settings.text ) { #>
		        <div class="th-cta-text">
		            <span>{{{ settings.text }}}</span>
		        </div>
		    <# } #>
            <#  var button_1_link_url = '#';
                var button_1_text = '';
                var button_1_icon = '';
                if ( settings.button_1_link.url ) { var button_1_link_url = settings.button_1_link.url }
                if ( settings.button_1_text ) { var button_1_text = settings.button_1_text }
                if ( settings.button_1_icon ) { var button_1_icon = settings.button_1_icon }

                var button_2_link_url = '#';
                var button_2_text = '';
                var button_2_icon = '';
                if ( settings.button_2_link.url ) { var button_2_link_url = settings.button_2_link.url }
                if ( settings.button_2_text ) { var button_2_text = settings.button_2_text }
                if ( settings.button_2_icon ) { var button_2_icon = settings.button_2_icon }
            #>
            <# if ( button_1_text || button_1_icon || button_2_text || button_2_icon ) { #>
                <div class="th-cta-btn">
                <# if ( button_1_text || button_1_icon ) { #>
                    <a class="btn btn-1 th-btn btn-{{ settings.button_1_style }}" href="{{ button_1_link_url }}">
                        {{{ settings.button_1_text }}}
                        <# if ( settings.button_1_icon ) { #>
                            <i class="{{ settings.button_1_icon }}"></i>
                        <# } #>
                    </a>
                <# } #>
                <# if ( button_2_text || button_2_icon ) { #>
                    <a class="btn btn-2 th-btn btn-{{ settings.button_2_style }}" href="{{ button_2_link_url }}">
                        {{{ settings.button_2_text }}}
                        <# if ( settings.button_2_icon ) { #>
                            <i class="{{ settings.button_2_icon }}"></i>
                        <# } #>
                    </a>
                <# } #>
                </div>
            <# } #>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_CallToAction() );
