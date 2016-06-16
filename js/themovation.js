(
	function ( $ ) {

	$.fn.wrapGridCell = function(){
		"use strict";

		if($( ".panel-grid-cell" ).length){
			$(".panel-grid-cell").find( "[class^='so-widget-th-']" ).each( function() {
				$(this).parent().parent().wrap('<div class="th-so-container"></div>');
			} );
		}
	}

	}
)( jQuery );

jQuery( function ( $ ) {
	$(document).wrapGridCell();
} );
