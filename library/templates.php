<?php
/**
 * Block Library templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<script type="text/template" id="template-thmv-templateLibrary-header-logo">
	<h3><?php _e( 'Block Library', 'th-widget-pack' ); ?></h3>
</script>

<script type="text/template" id="template-thmv-templateLibrary-header-back">
	<i class="eicon-" aria-hidden="true"></i>
	<span><?php echo __( 'Back to Library', 'th-widget-pack' ); ?></span>
</script>

<script type="text/template" id="template-thmv-TemplateLibrary_header-menu">
	<# _.each( tabs, function( args, tab ) { var activeClass = args.active ? 'elementor-active' : ''; #>
		<div class="elementor-component-tab elementor-template-library-menu-item {{activeClass}}" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
	<# } ); #>
</script>

<script type="text/template" id="template-thmv-templateLibrary-header-actions">
	<div id="thmv-templateLibrary-header-sync" class="elementor-templates-modal__header__item">
		<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Library', 'th-widget-pack' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Sync Library', 'th-widget-pack' ); ?></span>
	</div>
</script>

<script type="text/template" id="template-thmv-templateLibrary-preview">
    <iframe></iframe>
</script>

<script type="text/template" id="template-thmv-templateLibrary-header-insert">
	<div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
		{{{ thmv.library.getModal().getTemplateActionButton( obj ) }}}
	</div>
</script>

<script type="text/template" id="template-thmv-templateLibrary-insert-button">
	<a class="elementor-template-library-template-action elementor-button thmv-templateLibrary-insert-button">
		<i class="eicon-file-download" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Insert', 'th-widget-pack' ); ?></span>
	</a>
</script>

<script type="text/template" id="template-thmv-templateLibrary-loading">
	<div class="elementor-loader-wrapper">
		<div class="elementor-loader">
			<div class="elementor-loader-boxes">
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
			</div>
		</div>
		<div class="elementor-loading-title"><?php esc_html_e( 'Loading', 'th-widget-pack' ); ?></div>
	</div>
</script>

<script type="text/template" id="template-thmv-templateLibrary-templates">
	<div id="thmv-templateLibrary-toolbar">			
		<div id="thmv-templateLibrary-toolbar-search">
			<label for="thmv-templateLibrary-search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'th-widget-pack' ); ?></label>
			<input id="thmv-templateLibrary-search" placeholder="<?php esc_attr_e( 'Search', 'th-widget-pack' ); ?>">
			<i class="eicon-search"></i>
		</div>
	</div>

	<div class="thmv-templateLibrary-templates-window">
		<div id="thmv-templateLibrary-toolbar-filter" class="thmv-templateLibrary-toolbar-filter">
			<# if ( thmv.library.getTypeCategory() ) { #>
				<ul id="thmv-templateLibrary-filter-category" class="thmv-templateLibrary-filter-category">
					<li class="thmv-templateLibrary-category-filter-item active" value="" data-tag="">All</li>
					<# _.each( thmv.library.getTypeCategory(), function( slug ) { #>
						<li class="thmv-templateLibrary-category-filter-item" value="{{ slug }}" data-tag="{{ slug }}">{{{ thmv.library.getCategory()[slug] }}}</li>
					<# } ); #>
				</ul>
			<# } #>
		</div>	
		<div id="thmv-templateLibrary-templates-list"></div>
	</div>
</script>

<script type="text/template" id="template-thmv-templateLibrary-template">
	<div class="thmv-templateLibrary-template-body" id="thmv-template-{{ template_id }}">
		<div class="thmv-templateLibrary-template-preview">
			<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
		</div>
		<img class="thmv-templateLibrary-template-thumbnail" src="{{ thumbnail }}">
		<div class="thmv-templateLibrary-template-title">
			<span>{{{ title }}}</span>
		</div>
	</div>
	<div class="thmv-templateLibrary-template-footer">
		{{{ thmv.library.getModal().getTemplateActionButton( obj ) }}}
		<a href="#" class="elementor-button thmv-templateLibrary-preview-button">
			<i class="eicon-device-desktop" aria-hidden="true"></i>
			<?php esc_html_e( 'Preview', 'th-widget-pack' ); ?>
		</a>
	</div>
</script>

<script type="text/template" id="template-thmv-templateLibrary-empty">
	<div class="elementor-template-library-blank-icon">
		<i class="eicon-search-results"></i>
	</div>
	<div class="elementor-template-library-blank-title"></div>
	<div class="elementor-template-library-blank-message"></div>
</script>
