<?php
/**
 * HFE_Astra_Compat setup
 *
 * @package header-footer-elementor
 */

/**
 * Astra theme compatibility.
 */
class HFE_Astra_Compat {

	/**
	 * Instance of HFE_Astra_Compat.
	 *
	 * @var HFE_Astra_Compat
	 */
	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new HFE_Astra_Compat();

			add_action( 'wp', [ self::$instance, 'hooks' ] );
		}

		return self::$instance;
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {
		if ( thhf_header_enabled() ) {
			add_action( 'template_redirect', [ $this, 'astra_setup_header' ], 10 );
			add_action( 'astra_header', 'thhf_render_header' );
		}

		if ( thhf_footer_enabled() ) {
			add_action( 'template_redirect', [ $this, 'astra_setup_footer' ], 10 );
			add_action( 'astra_footer', 'thhf_render_footer' );
		}

		if ( thhf_is_before_footer_enabled() ) {
			add_action( 'astra_footer_before', 'thhf_render_before_footer' );
		}
	}

	/**
	 * Disable header from the theme.
	 */
	public function astra_setup_header() {
		remove_action( 'astra_header', 'astra_header_markup' );
	}

	/**
	 * Disable footer from the theme.
	 */
	public function astra_setup_footer() {
		remove_action( 'astra_footer', 'astra_footer_markup' );
	}

}

HFE_Astra_Compat::instance();
