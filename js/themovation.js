(
	function ( $ ) {

	$.fn.wrapGridCell = function() {
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

	$( '.panel-grid' ).find('.so-panel.widget .widget-animate').waypoint( {
		offset: function() {
			return Waypoint.viewportHeight() - 300
		},
		handler: function() {
			$(this).each(function() {
				$(this).delay( $(this).data( 'th-animation-delay' ) ).queue( function() {
					$(this).removeClass( 'hide-animation' ).clearQueue();
				});
			});
		}
	});

	$( '.th-widget-has-repeater' ).waypoint( {
		offset: function() {
			return Waypoint.viewportHeight() - 300
		},
		handler: function() {
			$(this).find('.widget-repeater-animate').each( function(i) {
				$(this).delay( 250 * i ).queue( function() {
					$(this).removeClass( 'hide-animation' ).clearQueue();
				});
			});
		}
	});

    // fix pricing columns
	themo_adjust_pricing_table_height();

    // start isotope
    themo_init_isotope();

    //-----------------------------------------------------
    // Start isotope / for masonry blog and tours filtering
    //-----------------------------------------------------

    function themo_init_isotope() {

        // filter items on click handler
        $('.th-portfolio-filters').on( 'click', 'a', function(e) {

            e.preventDefault();

            // Get Data-filter value
            var filterValue = $(this).attr('data-filter');

            // Get Parent Class
            if (filterValue == '*') {
                console.log('NOTHING')
                var parent_class = $(this).closest('.th-portfolio').attr("id");
            } else {
                var parent_class = $(filterValue).closest('.th-portfolio').attr("id");
            }

            // Remove .current class from all a links inside .th-portfolio-filters
            $('#'+parent_class+' .th-portfolio-filters a').removeClass( "current" );

            // Add .current class to current filter link.
            $(this).addClass( "current" );

            //console.log(filterValue);
            //console.log(parent_class);

            // Get the container element to initialize isotope.
            var $container = $('#'+parent_class+' .th-portfolio-row');
            // init
            $container.isotope({
                // options
                itemSelector: '.th-portfolio-item',
                layoutMode: 'fitRows'
            });

            $container.isotope({ filter: filterValue });

        });


        /* console.log('BEFORE');
        if ($('.mas-blog').length){
            console.log('FOUND IT');
        }else{
            console.log('NOT THERE');
        }*/
        var $bloggrid = $('.mas-blog').isotope({
            itemSelector: '.mas-blog-post',
            transitionDuration: '0.2s',
            percentPosition: true,
            originLeft: true,
            masonry: {
                columnWidth: '.mas-blog-post-sizer'
                //gutter: 30

            }
        });
        //console.log('AFTER');
		/*$('.mas-blog').isotope({
		 itemSelector: '.grid-item',
		 percentPosition: true,
		 masonry: {
		 columnWidth: '.grid-sizer',
		 gutter: 10
		 }
		 });*/

        $bloggrid.on( 'layoutComplete', function( event, laidOutItems ) {
            console.log( 'layoutComplete with ' + laidOutItems.length + ' items' );
        });



    }

    //-----------------------------------------------------
	// Adjust Pricing Table Height
	//-----------------------------------------------------

    function themo_adjust_pricing_table_height(){

        var $tallestCol;

        // For each pricing-table element
        $('.th-pricing-table').each(function(){
            $tallestCol = 0;

            // Find the plan name
            $(this).find('> div .th-pricing-title').each(function(){
                ($(this).height() > $tallestCol) ? $tallestCol = $(this).height() : $tallestCol = $tallestCol;
            });

            // Safety net increase pricing tables height couldn't be determined
            if($tallestCol == 0) $tallestCol = 'auto';

            // set even height
            $(this).find('> div .th-pricing-title').css('height',$tallestCol);

            // FEATURES UL
            $(this).find('> div .th-pricing-features').each(function(){
                ($(this).height() > $tallestCol) ? $tallestCol = $(this).height() : $tallestCol = $tallestCol;
            });

            // Safety net incase pricing tables height couldn't be determined
            if($tallestCol == 0) $tallestCol = 'auto';

            // Set even height
            $(this).find('> div .th-pricing-features').css('height',$tallestCol);

            // END FEATURES UL

        });
    }

    // Intinerary Toggles

	$( '.th-itinerary' ).find( '.th-itin-single' ).each( function() {
		var $$ = $( this ),
			$title = $$.find( '.th-itin-title' ),
			$content = $$.find( '.th-itin-content' );


		$title.on( 'click', function() {
			if ( $$.hasClass( 'th-itin-active' ) ) {
                $content.slideUp('fast', function() {
                    $$.addClass( 'th-itin-inactive' );
                    $$.removeClass( 'th-itin-active' );
                });
			} else {
                $content.slideDown('fast', function() {
                    $$.addClass( 'th-itin-active' );
                    $$.removeClass( 'th-itin-inactive' );
                });
			}
		} );



	} );

} );
