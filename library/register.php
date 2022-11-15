<?php
/**
 * Block Library templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<script type="text/template" id="template-thmv-templateLibrary-header-logo">
	<h3><?php _e( 'Block Library (Beta)', 'th-widget-pack' ); ?></h3>
</script>

<script type="text/template" id="template-thmv-templateLibrary-header-back">
	<i class="eicon-" aria-hidden="true"></i>
	<span><?php echo __( 'Back to Library', 'th-widget-pack' ); ?></span>
</script>


<script type="text/template" id="template-thmv-templateLibrary-loading">
	<div class="elementor-loader-wrapper">
		<div class="elementor-loading-title"><?php esc_html_e( 'Loading', 'th-widget-pack' ); ?></div>
	</div>
</script>
<script type="text/template" id="template-thmv-templateLibrary-empty">
	<div class="elementor-template-library-blank-title"><?php esc_html_e( 'You must be registered to use this feature', 'th-widget-pack' ); ?></div>
        <div class="elementor-template-library-blank-message">Visit the <a target="_blank" href="<?php echo admin_url('?page=stratus_dashboard')?>">dashboard</a> to register.</div>
</script>
