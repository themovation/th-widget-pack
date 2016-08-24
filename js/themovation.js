(
	function ( $ ) {

	$.fn.wrapGridCell = function(){
		"use strict";

		if($( ".panel-row-style" ).length){
			$(".panel-row-style").each( function() {
				$(this).wrapInner('<div class="th-so-container"></div>');
			} );
		}
	}

	}
)( jQuery );

jQuery( function ( $ ) {
	$(document).wrapGridCell();

	$( '.panel-grid' ).find('.so-panel.widget .hide-animation').waypoint( {
		offset: function() {
			return Waypoint.viewportHeight() - 300
		},
		handler: function() {
			$(this).each(function(){
				$(this).removeClass( 'hide-animation' );
			});
		}
	});
} );
