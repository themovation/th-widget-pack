<?php
/**
 * Class WPML_Themo_Tour_Info
 */
class WPML_Themo_Tour_Info extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'items';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'text':
				return esc_html__( 'Text', 'th-widget-pack' );

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
			case 'text':
				return 'LINE';

			default:
				return '';
		}
	}

}
