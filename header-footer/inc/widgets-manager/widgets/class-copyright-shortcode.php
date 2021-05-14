<?php
/**
 * Calling copyright shortcode.
 *
 * @package Copyright
 * @author Brainstorm Force
 */

namespace THHF\WidgetsManager\Widgets;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Helper class for the Copyright.
 *
 * @since 1.2.0
 */
class Copyright_Shortcode {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_shortcode( 'thmv_current_year', [ $this, 'display_current_year' ] );
		add_shortcode( 'thmv_site_title', [ $this, 'display_site_title' ] );
	}

	/**
	 * Get the thmv_current_year Details.
	 *
	 * @return array $thmv_current_year Get Current Year Details.
	 */
	public function display_current_year() {

		$thmv_current_year = gmdate( 'Y' );
		$thmv_current_year = do_shortcode( shortcode_unautop( $thmv_current_year ) );
		if ( ! empty( $thmv_current_year ) ) {
			return $thmv_current_year;
		}
	}

	/**
	 * Get site title of Site.
	 *
	 * @return string.
	 */
	public function display_site_title() {

		$thmv_site_title = get_bloginfo( 'name' );

		if ( ! empty( $thmv_site_title ) ) {
			return $thmv_site_title;
		}
	}

}

new Copyright_Shortcode();
