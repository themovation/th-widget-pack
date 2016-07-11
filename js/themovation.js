(
	function ( $ ) {

	$.fn.wrapGridCell = function(){
		"use strict";

		if($( ".panel-grid-cell" ).length){
			$(".panel-grid-cell").each( function() {
				$(this).wrap('<div class="th-so-container"></div>');
			} );
		}
	}

	}
)( jQuery );

jQuery( function ( $ ) {
	$(document).wrapGridCell();
} );
