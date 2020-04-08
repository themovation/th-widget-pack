<?php
/**
 * Class WPML_Themo_Pricing
 */
class WPML_Themo_Pricing_List extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'pricing';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array(
            'price_title',
            'price_sub_title',
            'price_description',
            'price_price',
            'price_text',
            'price_col_button_1_text',
            'price_link' => array( 'url' ),
        );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'price_title':
				return esc_html__( 'Title', 'th-widget-pack' );

			case 'price_sub_title':
                return esc_html__( 'Sub Title', 'th-widget-pack' );

            case 'price_description':
                return esc_html__( 'Description', 'th-widget-pack' );

            case 'price_price':
                return esc_html__( 'Price', 'th-widget-pack' );

			case 'price_text':
                return esc_html__( 'Price text', 'th-widget-pack' );

			case 'price_col_button_1_text':
                return esc_html__( 'Button Text', 'th-widget-pack' );

            case 'url':
                return esc_html__( 'Link', 'th-widget-pack' );

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
            case 'price_title':
                return 'LINE';

			case 'price_sub_title':
                return 'LINE';

            case 'price_description':
                return 'AREA';
                
            case 'price_price':
				return 'LINE';

			case 'price_text':
                return 'LINE';

			case 'price_col_button_1_text':
                return 'LINE';

            case 'url':
                return 'LINK';

			default:
				return '';
		}
	}

}
