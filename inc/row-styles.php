<?php

if ( ! function_exists ( 'themovation_so_wb_row_layout_field' ) ) :
// The functions that make it happen
function themovation_so_wb_row_layout_field( $fields ) {

	$fields['themo-row-layout'] = array(
			'name'        => __( 'Row Layout', 'themovation-widgets' ),
			'type'        => 'select',
			'group'       => 'layout',
			'default'     => 'th-full-width',
			'options'     => array(
				'th-full-width'         => __( 'Full Width', 'themovation-widgets' ),
				'th-full-width-stretch' => __( 'Full Width Stretched', 'themovation-widgets' ),
			),
			'description' => __( 'Show by screen size.', 'themovation-widgets' ),
			'priority'    => 1,
	);

	return $fields;
}
endif;
add_filter( 'siteorigin_panels_row_style_fields', 'themovation_so_wb_row_layout_field' );

if ( ! function_exists ( 'themovation_so_wb_row_layout_class' ) ) :
// Adding classes to widgets to control visibility
function themovation_so_wb_row_layout_class( $attributes, $args ) {

	if( ! empty( $args['themo-row-layout'] ) ) {
		array_push( $attributes['class'], $args['themo-row-layout'] );
	}

	return $attributes;
}
endif;
add_filter( 'siteorigin_panels_row_style_attributes', 'themovation_so_wb_row_layout_class', 10, 2);
