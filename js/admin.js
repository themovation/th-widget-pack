(
	function ( $ ) {

		$.fn.buttonLogic = function() {
			$("select[name*='[button][button_type]']").change(function(){
				$(this).find("option:selected").each(function(){
					if($(this).attr("value")=="button"){
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_text").show();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_style").show();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_icon").show();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_link").show();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-product_button").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-product_sku").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_graphic").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-graphic_link").hide();
					}
					else if($(this).attr("value")=="add-to-cart"){
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_text").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_style").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_icon").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_link").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-product_button").show();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-product_sku").show();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_graphic").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-graphic_link").hide();
					}
					else if($(this).attr("value")=="graphic"){
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_text").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_style").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_icon").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_link").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-product_button").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-product_sku").hide();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-button_graphic").show();
						$(this).parents('.siteorigin-widget-field-button_type').siblings(".siteorigin-widget-field-graphic_link").show();
					}
				});
			}).change();
		}

	}
)( jQuery );

!function ($) {
	$(document).ready(function($) {
		$('.siteorigin-widget-section ').buttonLogic();
	});
	$(document).on( "panelsopen", function() {
		$('.siteorigin-widget-section ').buttonLogic();
	});
	$(document).on( "widget-added", function() {
		$('.siteorigin-widget-section ').buttonLogic();
	});
	$(document).on( "widget-updated", function() {
		$('.siteorigin-widget-section ').buttonLogic();
	});
}(jQuery);
