<?php
/**
 * Elementor Classes.
 *
 * @package Header Footer Elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Elementor Copyright
 *
 * Elementor widget for copyright.
 *
 * @since 1.2.0
 */
class Copyright extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'thhf-copyright';
	}
	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Copyright', 'header-footer-elementor' );
	}
	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'thhf-icon-copyright-widget';
	}
	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'themo-elements' ];
	}
	/**
	 * Register Copyright controls.
	 *
	 * @since 1.2.0
	 * @access protected
	 */
	protected function _register_controls() { //phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		$this->register_content_copy_right_controls();
	}
	/**
	 * Register Copyright General Controls.
	 *
	 * @since 1.2.0
	 * @access protected
	 */
	protected function register_content_copy_right_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Copyright', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'shortcode',
			[
				'label'   => __( 'Copyright Text', 'header-footer-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Copyright © [thmv_current_year] [thmv_site_title] | Powered by [thmv_site_title]', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'header-footer-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'header-footer-elementor' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment', 'header-footer-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hfe-copyright-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Text Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting.
					'{{WRAPPER}} .hfe-copyright-wrapper a, {{WRAPPER}} .hfe-copyright-wrapper' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'caption_typography',
				'selector' => '{{WRAPPER}} .hfe-copyright-wrapper, {{WRAPPER}} .hfe-copyright-wrapper a',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);
	}

	/**
	 * Render Copyright output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.2.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$link     = isset( $settings['link']['url'] ) ? $settings['link']['url'] : '';

		if ( ! empty( $settings['link']['nofollow'] ) ) {
			$this->add_render_attribute( 'link', 'rel', 'nofollow' );
		}
		if ( ! empty( $settings['link']['is_external'] ) ) {
			$this->add_render_attribute( 'link', 'target', '_blank' );
		}

		$copy_right_shortcode = do_shortcode( shortcode_unautop( $settings['shortcode'] ) ); ?>
		<div class="hfe-copyright-wrapper">
			<?php if ( ! empty( $link ) ) { ?>
				<a href="<?php echo esc_url( $link ); ?>" <?php echo $this->get_render_attribute_string( 'link' ); ?>>
					<span><?php echo wp_kses_post( $copy_right_shortcode ); ?></span>
				</a>
			<?php } else { ?>
				<span><?php echo wp_kses_post( $copy_right_shortcode ); ?></span>
			<?php } ?>
		</div>
		<?php
	}

	/**
	 * Render shortcode widget as plain content.
	 *
	 * Override the default behavior by printing the shortcode instead of rendering it.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function render_plain_content() {
		// In plain mode, render without shortcode.
		echo esc_attr( $this->get_settings( 'shortcode' ) );
	}

	/**
	 * Render shortcode widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function content_template() {}

	/**
	 * Render shortcode output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * Remove this after Elementor v3.3.0
	 *
	 * @since 1.2.0
	 * @access protected
	 */
	protected function _content_template() {
		$this->content_template();
	}
}
