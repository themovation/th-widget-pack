<?php
/**
 * THHF_Elementor_Canvas_Compat setup
 *
 * @package header-footer-elementor
 */

/**
 * Astra theme compatibility.
 */
class THHF_Elementor_Canvas_Compat {

	/**
	 * Instance of THHF_Elementor_Canvas_Compat.
	 *
	 * @var THHF_Elementor_Canvas_Compat
	 */
	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new THHF_Elementor_Canvas_Compat();

			add_action( 'wp', [ self::$instance, 'hooks' ] );
		}

		return self::$instance;
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {
		if ( thhf_header_enabled() ) {

			// Action `elementor/page_templates/canvas/before_content` is introduced in Elementor Version 1.4.1.
			if ( version_compare( ELEMENTOR_VERSION, '1.4.1', '>=' ) ) {
				add_action( 'elementor/page_templates/canvas/before_content', [ $this, 'render_header' ] );
			} else {
				add_action( 'wp_head', [ $this, 'render_header' ] );
			}
		}

		if ( thhf_footer_enabled() ) {

			// Action `elementor/page_templates/canvas/after_content` is introduced in Elementor Version 1.9.0.
			if ( version_compare( ELEMENTOR_VERSION, '1.9.0', '>=' ) ) {
				add_action( 'elementor/page_templates/canvas/after_content', [ $this, 'render_footer' ] );
			} else {
				add_action( 'wp_footer', [ $this, 'render_footer' ] );
			}
		}

		if ( thhf_is_before_footer_enabled() ) {

			// check if current page template is Elemenntor Canvas.
			if ( 'elementor_canvas' == get_page_template_slug() ) {
				$override_cannvas_template = get_post_meta( thhf_get_before_footer_id(), 'display-on-canvas-template', true );

				if ( '1' == $override_cannvas_template ) {
					add_action( 'elementor/page_templates/canvas/after_content', 'thhf_render_before_footer', 9 );
				}
			}
		}
	}

	/**
	 * Render the header if display template on elementor canvas is enabled
	 * and current template is Elementor Canvas
	 */
	public function render_header() {

		// bail if current page template is not Elemenntor Canvas.
		if ( 'elementor_canvas' !== get_page_template_slug() ) {
			return;
		}

		$override_cannvas_template = get_post_meta( get_thhf_header_id(), 'display-on-canvas-template', true );

		if ( '1' == $override_cannvas_template ) {
			thhf_render_header();
		}
	}

	/**
	 * Render the footer if display template on elementor canvas is enabled
	 * and current template is Elementor Canvas
	 */
	public function render_footer() {

		// bail if current page template is not Elemenntor Canvas.
		if ( 'elementor_canvas' !== get_page_template_slug() ) {
			return;
		}

		$override_cannvas_template = get_post_meta( get_thhf_footer_id(), 'display-on-canvas-template', true );

		if ( '1' == $override_cannvas_template ) {
			thhf_render_footer();
		}
	}

}

THHF_Elementor_Canvas_Compat::instance();
