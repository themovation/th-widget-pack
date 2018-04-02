<?php
/**
 * Class WPML_Themo_Expand_List
 */
class WPML_Themo_Expand_List extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'tabs';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'tab_title', 'tab_content' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'tab_title':
				return esc_html__( 'Title & Content', 'th-widget-pack' );

			case 'tab_content':
				return esc_html__( 'Content', 'th-widget-pack' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {
			case 'tab_title':
				return 'LINE';

			case 'tab_content':
				return 'VISUAL';

			default:
				return '';
		}
	}

}
