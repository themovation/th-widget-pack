
jQuery(function ($) {
	themoGoogleMapInitialize = function() {
		$( '.th-map' ).each( function( index, element ) {

			var $this = $(element);

			var map = new google.maps.Map( document.getElementById($this.attr('id')), {
				zoom: $this.data( 'map-zoom' ),
				center: { lat: parseFloat($this.data( 'map-latitude' )), lng: parseFloat($this.data( 'map-longitude' )) },
				disableDefaultUI: true,
				scrollwheel: $this.data( 'map-scroll' ),
				styles: $this.data( 'map-style' ),
			} );

		} );

	};

});

jQuery(function ($) {

	themoSetupGoogleMaps = function() {
		var libraries = [];
		var mapAPI;
		$('.th-map').each(function(index, element) {
			var $this = $(element);
			mapAPI = $this.data( 'map-api' );
		});


		var mapsApiLoaded = typeof window.google !== 'undefined' && typeof window.google.maps !== 'undefined';
		if ( mapsApiLoaded ) {
			themoGoogleMapInitialize();
		} else {
			var apiUrl = 'https://maps.googleapis.com/maps/api/js?callback=themoGoogleMapInitialize';

			if ( mapAPI ) {
				apiUrl += '&key=' + mapAPI;
			}

			$( 'body' ).append( '<script async type="text/javascript" src="' + apiUrl + '">' );
		}
	};
	themoSetupGoogleMaps();

});
