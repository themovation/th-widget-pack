<?php
/**
 * Class WPML_Themo_Pricing
 */
class WPML_Themo_Pricing extends WPML_Elementor_Module_With_Items  {

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
            'price_col_title', 
            'price_col_sub_title',
            'price_col_price',
            'price_col_text', 
            'price_col_description', 
            'price_col_button_1_text', 
            'price_col_button_1_link' => array( 'url' ),
            'price_col_button_2_text',
            //'price_col_button_2_link' => array( 'url' ),
        );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'price_col_title':
				return esc_html__( 'Title', 'th-widget-pack' );

			case 'price_col_sub_title':
                return esc_html__( 'Sub Title', 'th-widget-pack' );

            case 'price_col_price':
                return esc_html__( 'Price', 'th-widget-pack' );

			case 'price_col_text':
                return esc_html__( 'Price text', 'th-widget-pack' );
        
            case 'price_col_description':
				return esc_html__( 'Description', 'th-widget-pack' );

			case 'price_col_button_1_text':
                return esc_html__( 'Button 1 Text', 'th-widget-pack' );

            case 'url':
                return esc_html__( 'Button 1 Link', 'th-widget-pack' );

            case 'price_col_button_2_text':
                return esc_html__( 'Button 2 Text', 'th-widget-pack' );

            /*case 'price_col_button_2_link':
                return esc_html__( 'Button 2 Link', 'th-widget-pack' );
            */
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
            case 'price_col_title':
                return 'LINE';

			case 'price_col_sub_title':
                return 'LINE';
                
            case 'price_col_price':
				return 'LINE';

			case 'price_col_text':
                return 'LINE';
        
            case 'price_col_description':
				return 'AREA';

			case 'price_col_button_1_text':
                return 'LINE';

            case 'url':
                return 'LINK';

            case 'price_col_button_2_text':
                return 'LINE';

            /*case 'price_col_button_2_link':
                return 'LINK';
            */
			default:
				return '';
		}
	}

}
