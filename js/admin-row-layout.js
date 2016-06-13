!function ($) {
	$(document).ready(function($) {
		setInterval( function(){ $('.style-field-wrapper').find("select[name='style[row_stretch]']").closest('.style-field-wrapper').hide(); }, 3000 );
	});
}(jQuery);
