<?php
if ( ! function_exists( 'themovation_so_wb_default_active' ) ) :
// Activating widgets on install
function themovation_so_wb_default_active( $group ) {
	$active_widgets = array(
		'th-accordions'       => true,
		'th-appointments'     => true,
		'th-button'           => true,
		'th-call-to-action'   => true,
		'th-content-editor'   => true,
		'th-faq'              => true,
		'th-feature'          => true,
		'th-flex-slider'      => true,
		'th-formidable-forms' => true,
		'th-google-map'       => true,
		'th-header'           => true,
		'th-icon'             => true,
		'th-icon-enhanced'    => true,
		'th-link'             => true,
		'th-logos'            => true,
		'th-master-slider'    => true,
		'th-package'          => true,
		'th-portfolio'        => true,
		'th-pricing'          => true,
		'th-service'          => true,
		'th-team'             => true,
		'th-testimonials'     => true,
		'th-thumb-slider'     => true,
		'th-tour'             => true,
		'th-video'            => true,
	);
	return $active_widgets;
}
endif;
add_filter( 'siteorigin_widgets_default_active', 'themovation_so_wb_default_active', 20 );
