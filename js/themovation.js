(
	function ( $ ) {

	$.fn.wrapGridCell = function(){
		"use strict";

		if($( ".panel-grid" ).length){
			$(".panel-grid").each( function() {
				$(this).wrapInner('<div class="th-so-container"></div>');
			} );
		}
	}

	}
)( jQuery );

jQuery( function ( $ ) {
	$(document).wrapGridCell();
} );
