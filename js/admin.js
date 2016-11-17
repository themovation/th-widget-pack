(
	function ( $ ) {

		$.fn.themoButtonLogic = function() {
			$("select[name*='[button_1][button_type]'], select[name*='[button_2][button_type]']").change(function(){
				var $$ = $(this),
					$p = '.siteorigin-widget-field-button_type',
					$b = '.siteorigin-widget-field-button_text, .siteorigin-widget-field-button_style, .siteorigin-widget-field-button_icon, .siteorigin-widget-field-button_link',
					$c = '.siteorigin-widget-field-product_button, .siteorigin-widget-field-product_sku',
					$g = '.siteorigin-widget-field-button_graphic, .siteorigin-widget-field-graphic_link';
				$$.find("option:selected").each(function(){
					if($$.attr("value") == "button") {
						$$.parents($p).siblings($b).show();
						$$.parents($p).siblings($c).hide();
						$$.parents($p).siblings($g).hide();
					} else if($$.attr("value") == "add-to-cart") {
						$$.parents($p).siblings($b).hide();
						$$.parents($p).siblings($c).show();
						$$.parents($p).siblings($g).hide();
					} else if($$.attr("value") == "graphic") {
						$$.parents($p).siblings($b).hide();
						$$.parents($p).siblings($c).hide();
						$$.parents($p).siblings($g).show();
					}
				});
			}).change();
		}

		$.fn.themoButtonIcon = function() {
			$('.siteorigin-widget-field-button').find('.siteorigin-widget-field-button_icon .siteorigin-widget-field-style').hide();
		}

	}
)( jQuery );

!function ($) {
	$(document).ready(function($) {
		$('.siteorigin-widget-section').themoButtonLogic();
		$('.siteorigin-widget-section').themoButtonIcon();
		$('.siteorigin-widget-field-type-repeater').click( '.siteorigin-widget-field-repeater-add', function() {
			$(this).themoButtonLogic();
			$(this).themoButtonIcon();
		} );
	});
	$(document).on( "panelsopen", function() {
		$('.siteorigin-widget-section').themoButtonLogic();
		$('.siteorigin-widget-section').themoButtonIcon();
		$('.siteorigin-widget-field-type-repeater').click( '.siteorigin-widget-field-repeater-add', function() {
			$(this).themoButtonLogic();
			$(this).themoButtonIcon();
		} );
	});
	$(document).on( "widget-added", function() {
		$('.siteorigin-widget-section').themoButtonLogic();
		$('.siteorigin-widget-section').themoButtonIcon();
		$('.siteorigin-widget-field-type-repeater').click( '.siteorigin-widget-field-repeater-add', function() {
			$(this).themoButtonLogic();
			$(this).themoButtonIcon();
		} );
	});
	$(document).on( "widget-updated", function() {
		$('.siteorigin-widget-section').themoButtonLogic();
		$('.siteorigin-widget-section').themoButtonIcon();
		$('.siteorigin-widget-field-type-repeater').click( '.siteorigin-widget-field-repeater-add', function() {
			$(this).themoButtonLogic();
			$(this).themoButtonIcon();
		} );
	});
}(jQuery);
