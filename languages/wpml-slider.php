<?php
/**
 * Class WPML_Themo_Slider
 */
class WPML_Themo_Slider extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'slides';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 
            'slide_title', 
            'slide_text', 
            'slide_button_text_1',
            'slide_button_link_1' => array( 'url' ),
            'slide_button_text_2',
            /*'slide_button_link_2' => array( 'url' ),*/
            'slide_shortcode', 
            'slide_tooltip_text'
        );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'slide_title':
				return esc_html__( 'Title', 'th-widget-pack' );

			case 'slide_text':
                return __( 'Content', 'th-widget-pack' );
                
            case 'slide_button_text_1':
				return esc_html__( 'Button 1 Text', 'th-widget-pack' );

            case 'url':
                return esc_html__( 'Button 1 Link', 'th-widget-pack' );

			case 'slide_button_text_2':
                return esc_html__( 'Button 2 Text', 'th-widget-pack' );

            /*case 'slide_button_link_2':
                return esc_html__( 'Button 2 Link', 'th-widget-pack' );
            */
        
            case 'slide_shortcode':
				return esc_html__( 'Shortcode', 'th-widget-pack' );

			case 'slide_tooltip_text':
                return esc_html__( 'Tooltip Text', 'th-widget-pack' );

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
            case 'slide_title':
				return 'LINE';

			case 'slide_text':
                return 'AREA';
                
            case 'slide_button_text_1':
				return 'LINE';

            case 'url':
                return 'LINK';

			case 'slide_button_text_2':
                return 'LINE';

           /*case 'slide_button_link_2':
                return 'LINK';
           */
            case 'slide_shortcode':
				return 'LINE';

			case 'slide_tooltip_text':
                return 'LINE';
        
			default:
				return '';
		}
	}

}
