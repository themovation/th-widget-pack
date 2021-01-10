<?php
/**
 * Header Footer Elementor Function
 *
 * @package  header-footer-elementor
 */

/**
 * Checks if Header is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if header is enabled. False if header is not enabled
 */
function thhf_header_enabled() {
	$header_id = THHF_Header_Footer_Elementor::get_settings( 'type_header', '' );
	$status    = false;

	if ( '' !== $header_id ) {
		$status = true;
	}

	return apply_filters( 'thhf_header_enabled', $status );
}

/**
 * Checks if Sticky Header is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if sticky header is enabled. False if header is not enabled
 */
function thhf_sticky_header_enabled() {
	$header_id = THHF_Header_Footer_Elementor::get_settings( 'type_header_sticky', '' );
	$status    = false;

	if ( '' !== $header_id ) {
		$status = true;
	}

	return apply_filters( 'thhf_sticky_header_enabled', $status );
}

/**
 * Checks if Footer is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if header is enabled. False if header is not enabled.
 */
function thhf_footer_enabled() {
	$footer_id = THHF_Header_Footer_Elementor::get_settings( 'type_footer', '' );
	$status    = false;

	if ( '' !== $footer_id ) {
		$status = true;
	}

	return apply_filters( 'thhf_footer_enabled', $status );
}

/**
 * Get HFE Header ID
 *
 * @since  1.0.2
 * @return (String|boolean) header id if it is set else returns false.
 */
function get_thhf_header_id() {
	$header_id = THHF_Header_Footer_Elementor::get_settings( 'type_header', '' );

	if ( '' === $header_id ) {
		$header_id = false;
	}

	return apply_filters( 'get_thhf_header_id', $header_id );
}

/**
 * Get HFE Sticky Header ID
 *
 * @since  1.0.2
 * @return (String|boolean) sticky header id if it is set else returns false.
 */
function get_thhf_sticky_header_id() {
	$sticky_header_id = THHF_Header_Footer_Elementor::get_settings( 'type_header_sticky', '' );

	if ( '' === $sticky_header_id ) {
		$sticky_header_id = false;
	}

	return apply_filters( 'get_thhf_sticky_header_id', $sticky_header_id );
}

/**
 * Get HFE Footer ID
 *
 * @since  1.0.2
 * @return (String|boolean) header id if it is set else returns false.
 */
function get_thhf_footer_id() {
	$footer_id = THHF_Header_Footer_Elementor::get_settings( 'type_footer', '' );

	if ( '' === $footer_id ) {
		$footer_id = false;
	}

	return apply_filters( 'get_thhf_footer_id', $footer_id );
}

/**
 * Display header markup.
 *
 * @since  1.0.2
 */
function thhf_render_header() {

	if ( false == apply_filters( 'enable_thhf_render_header', true ) ) {
		return;
	}

	$transparent_header = get_post_meta( get_thhf_header_id(), 'transparent-header', true );

	$render_class = '';
	if ( $transparent_header ) {
		$render_class .= 'transparent-header';  
	}

	?>
		<header id="thhf-masthead" class="<?php echo $render_class; ?>" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
			<p class="main-title bhf-hidden" itemprop="headline"><a href="<?php echo bloginfo( 'url' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php THHF_Header_Footer_Elementor::get_header_content(); ?>
		</header>

	<?php

}

/**
 * Display sticky header markup.
 *
 * @since  1.0.2
 */
function thhf_render_sticky_header() {

	if ( false == apply_filters( 'enable_thhf_render_sticky_header', true ) ) {
		return;
	}

	$transparent_header = get_post_meta( get_thhf_sticky_header_id(), 'transparent-header', true );
	$sticky_stacked = get_post_meta( get_thhf_sticky_header_id(), 'sticky-stacked', true );

	$render_class = '';
	if ( $transparent_header ) {
		$render_class .= 'transparent-header';
	}
	if ( $sticky_stacked ) {
		$render_class .= ' sticky-stacked';
	}

	?>
		<header id="thhf-masthead-sticky" class="<?php echo $render_class; ?>" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
			<p class="main-title bhf-hidden" itemprop="headline"><a href="<?php echo bloginfo( 'url' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php THHF_Header_Footer_Elementor::get_sticky_header_content(); ?>
		</header>

	<?php

}


/**
 * Display footer markup.
 *
 * @since  1.0.2
 */
function thhf_render_footer() {

	if ( false == apply_filters( 'enable_thhf_render_footer', true ) ) {
		return;
	}

	?>
		<footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo">
			<?php THHF_Header_Footer_Elementor::get_footer_content(); ?>
		</footer>
	<?php

}


/**
 * Get HFE Before Footer ID
 *
 * @since  1.0.2
 * @return String|boolean before footer id if it is set else returns false.
 */
function thhf_get_before_footer_id() {

	$before_footer_id = THHF_Header_Footer_Elementor::get_settings( 'type_before_footer', '' );

	if ( '' === $before_footer_id ) {
		$before_footer_id = false;
	}

	return apply_filters( 'get_hfe_before_footer_id', $before_footer_id );
}

/**
 * Checks if Before Footer is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if before footer is enabled. False if before footer is not enabled.
 */
function thhf_is_before_footer_enabled() {

	$before_footer_id = THHF_Header_Footer_Elementor::get_settings( 'type_before_footer', '' );
	$status           = false;

	if ( '' !== $before_footer_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_before_footer_enabled', $status );
}

/**
 * Display before footer markup.
 *
 * @since  1.0.2
 */
function thhf_render_before_footer() {

	if ( false == apply_filters( 'enable_thhf_render_before_footer', true ) ) {
		return;
	}

	?>
		<div class="hfe-before-footer-wrap">
			<?php THHF_Header_Footer_Elementor::get_before_footer_content(); ?>
		</div>
	<?php

}
