<?php
/**
 * HFE_Hello_Elementor_Compat setup
 *
 * @package header-footer-elementor
 */

/**
 * Hello Elementor compatibility.
 */
class HFE_Hello_Elementor_Compat {

	/**
	 * Instance of HFE_Hello_Elementor_Compat.
	 *
	 * @var HFE_Hello_Elementor_Compat
	 */
	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new HFE_Hello_Elementor_Compat();

			require_once THEMO_PATH . 'themes/default/class-hfe-default-compat.php';
		}

		return self::$instance;
	}
}

HFE_Hello_Elementor_Compat::instance();
