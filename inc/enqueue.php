<?php

define("THEMOVATION_WB_VER", '1.0');

if ( ! function_exists ( 'themovation_so_wb_scripts' ) ) :
// Enqueueing Frontend stylesheet and scripts.
function themovation_so_wb_scripts() {
	wp_enqueue_script( 'themo-so-wb-js', plugin_dir_url( __FILE__ ) . '../js/themovation.js', array('jquery'), THEMOVATION_WB_VER, true);

	if ( wp_script_is( 'booked-font-awesome', 'enqueued' ) && wp_style_is( 'font-awesome', 'enqueued' ) ) {
		wp_dequeue_script( 'booked-font-awesome' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'themovation_so_wb_scripts', 20 );

if ( ! function_exists ( 'themovation_icon_styles' ) ) :
// Enqueueing themovation icon styles
function themovation_icon_styles() {
	wp_enqueue_style( 'themo-glyphsocial', plugin_dir_url( __FILE__ ) . '../assets/glyphsocial/style.css', array(), THEMOVATION_WB_VER );
    wp_enqueue_style( 'themo-travelpack', plugin_dir_url( __FILE__ ) . '../assets/travelpack/travelpack.css', array(), THEMOVATION_WB_VER );
}
endif;
add_action( 'wp_enqueue_scripts', 'themovation_icon_styles', 1000000 );


add_action( 'elementor/preview/enqueue_styles', function() {

    /* Themovation Theme Options : Colors for Preview */
    if ( function_exists( 'get_theme_mod' ) ) {

        /* CUSTOM CSS Support */
        $custom_css_outfall = "";

        /* Custom Color */
        $custom_color_primary_not_important = get_theme_mod( 'themo_color_primary', THEMO_COLOR_PRIMARY ) ;

        $custom_color_primary = get_theme_mod( 'themo_color_primary', THEMO_COLOR_PRIMARY ) . " !important"; // Get favicon option
        $custom_color_accent = get_theme_mod( 'themo_color_accent', THEMO_COLOR_ACCENT ) . " !important"; // Get favicon option

        $custom_color_css = "\n/* Custom Color CSS $custom_color_primary */\n";
        $custom_color_css .= "#main-flex-slider .slides h1,.accent,.light-text .btn-ghost:hover,.light-text .googlemap a,.light-text .pricing-column.highlight .btn-ghost:hover,.light-text .pricing-column.highlight .btn-standard,.navbar .navbar-nav .dropdown-menu li a:hover,.navbar .navbar-nav .dropdown-menu li.active a,.navbar .navbar-nav .dropdown-menu li.active a:hover,.page-title h1,.panel-title i,.pricing-column.highlight .btn-ghost:hover,.pricing-column.highlight .btn-standard,.pricing-cost,.simple-cta span,.team-member-social a .soc-icon:hover,a,.light-text .panel-body p a{color:$custom_color_primary_not_important}.footer .widget-title:after,.navbar .navbar-nav>li.active>a:after,.navbar .navbar-nav>li.active>a:focus:after,.navbar .navbar-nav>li.active>a:hover:after,.navbar .navbar-nav>li>a:hover:after,.port-overlay,.section-header h2:after{background-color:$custom_color_primary}.accordion .accordion-btn .btn-ghost:hover,.btn-ghost:hover,.btn-standard,.circle-lrg-icon i,.circle-lrg-icon span,.light-text .pricing-table .btn-ghost:hover,.pager li>a:hover,.pager li>span:hover,.pricing-column.highlight{background-color:$custom_color_primary;border-color:$custom_color_primary}.accordion .accordion-btn .btn-ghost,.btn-ghost,.circle-lrg-icon i:hover,.circle-lrg-icon span:hover,.light-text .pricing-table .btn-ghost,.portfolio-filters a.current{color:$custom_color_primary;border-color:$custom_color_primary}.search-form input:focus,.widget select:focus,form input:focus,form select:focus,form textarea:focus{border-color:$custom_color_primary}.circle-med-icon i,.circle-med-icon span,.frm_form_submit_style,.frm_form_submit_style:hover,.with_frm_style .frm_submit input[type=button],.with_frm_style .frm_submit input[type=button]:hover,.with_frm_style .frm_submit input[type=submit],.with_frm_style .frm_submit input[type=submit]:hover,.with_frm_style.frm_login_form input[type=submit],.with_frm_style.frm_login_form input[type=submit]:hover,form input[type=submit],form input[type=submit]:hover{background:$custom_color_primary}.footer .tagcloud a:hover,.headhesive--clone .navbar-nav>li.active>a:after,.headhesive--clone .navbar-nav>li.active>a:focus:after,.headhesive--clone .navbar-nav>li.active>a:hover:after,.headhesive--clone .navbar-nav>li>a:hover:after,.search-submit,.search-submit:hover,.simple-conversion .with_frm_style input[type=submit],.simple-conversion .with_frm_style input[type=submit]:focus,.simple-conversion form input[type=submit],.simple-conversion form input[type=submit]:focus,.widget .tagcloud a:hover, .wpbs-form .wpbs-form-form .wpbs-form-submit, .wpbs-form .wpbs-form-form .wpbs-form-submit:hover, .wpbs-form .wpbs-form-form .wpbs-form-submit:active, .wpbs-form .wpbs-form-form .wpbs-form-submit:focus{background-color:$custom_color_primary}.btn-cta{background-color:$custom_color_accent}body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,body #booked-profile-page .booked-profile-appt-list .appt-block.approved .status-block{background:$custom_color_accent}body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button{border-color:$custom_color_accent}";
        $custom_color_css .= "html .woocommerce button.button.alt,html .woocommerce input.button.alt,html .woocommerce #respond input#submit.alt,html .woocommerce #content input.button.alt,html .woocommerce-page button.button.alt,html .woocommerce-page input.button.alt,html .woocommerce-page #respond input#submit.alt,html .woocommerce-page #content input.button.althtml .woocommerce button.button,html .woocommerce input.button,html .woocommerce #respond input#submit,html .woocommerce #content input.button,html .woocommerce-page button.button,html .woocommerce-page input.button,html .woocommerce-page #respond input#submit,html .woocommerce-page #content input.button {background-color: $custom_color_primary; color: #fff !important;}";
        $custom_color_css .= "html .woocommerce a.button.alt, html .woocommerce-page a.button.alt, html .woocommerce a.button, html .woocommerce-page a.button{background-color: $custom_color_primary; color: #fff;}";
        $custom_color_css .= "html .woocommerce button.button:hover,html .woocommerce input.button:hover,html .woocommerce #respond input#submit:hover,html .woocommerce #content input.button:hover,html .woocommerce-page button.button:hover,html .woocommerce-page input.button:hover,html .woocommerce-page #respond input#submit:hover,html .woocommerce-page #content input.button:hover {background-color: $custom_color_primary; color: #fff;}";
        $custom_color_css .= "html .woocommerce a.button:hover,html .woocommerce-page a.button:hover{background-color: $custom_color_primary; color: #fff !important;}";
        $custom_color_css .= ".frm_style_formidable-style.with_frm_style .frm_compact .frm_dropzone.dz-clickable .dz-message, .frm_style_formidable-style.with_frm_style input[type=submit], .frm_style_formidable-style.with_frm_style .frm_submit input[type=button], .frm_style_formidable-style.with_frm_style .frm_submit button, .frm_form_submit_style, .frm_style_formidable-style.with_frm_style.frm_login_form input[type=submit]{color:#fff !important};";

        /* Rounded button settings. */
        $rounded_buttons = get_theme_mod( 'themo_enable_rounded_buttons', false ); // Get favicon option
        if(isset($rounded_buttons) && $rounded_buttons =='off') {
            $custom_color_css .= ".simple-conversion form input[type=submit],.simple-conversion .with_frm_style input[type=submit],.search-form input, .wpbs-form-form .wpbs-form-item input, .wpbs-form-form .wpbs-form-item select, .wpbs-form-form .wpbs-form-item textarea{border-radius:1px !important;}";
            $custom_color_css .= ".nav-tabs > li > a {border-radius:1px 1px 0 0 !important}";
            $custom_color_css .= ".btn, .btn-cta, .btn-sm,.btn-group-sm > .btn, .btn-group-xs > .btn, .frm_forms form select,.frm_style_formidable-style.with_frm_style select, .pager li > a,.pager li > span, .form-control, #respond input[type=submit], body .booked-modal button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce .woocommerce-message, .woocommerce .woocommerce-info, .woocommerce form.checkout_coupon,.woocommerce form.login, .woocommerce form.register, .woocommerce-checkout #payment div.payment_box, .panel, .panel-group .panel, .simple-conversion form input, .flex-direction-nav a, .search-form input, .search-submit, .search-form input, .widget select, .widget .tagcloud a, .alert, .progress, #scrollUp, .th-accent, .headhesive--clone.banner[data-transparent-header='true'] .th-accent{border-radius:1px !important;}";
            $custom_color_css .= ".frm_forms form input[type=text], .frm_forms form input[type=email],.frm_forms form input[type=url], .frm_forms form input[type=password],.frm_forms form input[type=number], .frm_forms form input[type=tel],.frm_style_formidable-style.with_frm_style input[type=text],.frm_style_formidable-style.with_frm_style input[type=password],.frm_style_formidable-style.with_frm_style input[type=email],.frm_style_formidable-style.with_frm_style input[type=number],.frm_style_formidable-style.with_frm_style input[type=url],.frm_style_formidable-style.with_frm_style input[type=tel],.frm_style_formidable-style.with_frm_style input[type=file],.frm_style_formidable-style.with_frm_style input[type=search], .frm_forms form input, .frm_forms form textarea,.frm_style_formidable-style.with_frm_style textarea, form input[type=submit],.with_frm_style .frm_submit input[type=submit],.with_frm_style .frm_submit input[type=button],.frm_form_submit_style, .with_frm_style.frm_login_form input[type=submit], with_frm_style .frm_error_style,.with_frm_style .frm_message,.frm_success_style, .widget input[type=submit],.widget .frm_style_formidable-style.with_frm_style input[type=submit], .woocommerce form input[type=text], .woocommerce form input[type=password],.woocommerce form input[type=email], .woocommerce form input[type=number],.woocommerce form input[type=url], .woocommerce form input[type=tel],.woocommerce form input[type=file], .woocommerce form input[type=search], .woocommerce form textarea, .woocommerce form select,.woocommerce-cart select{-webkit-border-radius:1px; -moz-border-radius:1px; border-radius:1px !important;}";
            $custom_color_css .= ".wpbs-form-form .wpbs-form-item .wpbs-form-submit{-webkit-border-radius:1px !important; -moz-border-radius:1px !important; border-radius:1px !important;}";
        }

        $custom_css_outfall .= "$custom_color_css\n";

        if (isset($custom_css_outfall) && $custom_css_outfall > "") {
            echo "\n<!-- Theme Custom CSS outfall for Elementor Preview -->\n<style>\n";
            echo sanitize_text_field($custom_css_outfall); // custom css sanitized just above
            echo "\n</style>\n";
        }
    }


} );
