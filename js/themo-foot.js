"use strict";

//-----------------------------------------------------
// Initiate Slider (flexslider)
//-----------------------------------------------------
function themo_start_flex_slider(flex_selector,themo_autoplay,themo_flex_animation, themo_flex_easing,
                                 themo_flex_animationloop, themo_flex_smoothheight, themo_flex_slideshowspeed, themo_flex_animationspeed,
                                 themo_flex_randomize, themo_flex_pauseonhover, themo_flex_touch, themo_flex_directionnav,themo_flex_controlNav){
    // SETUP FLEXSLIDER OPTIONS
    // Remove ajax_loader.gif from Formidable Plugin
    jQuery("img.frm_ajax_loading").remove();
    jQuery(flex_selector).flexslider({
        slideshow: themo_autoplay,
        animation: themo_flex_animation,
        smoothHeight: themo_flex_smoothheight,
        easing: themo_flex_easing,
        animationLoop: themo_flex_animationloop,
        slideshowSpeed: themo_flex_slideshowspeed,
        animationSpeed: themo_flex_animationspeed,
        randomize: themo_flex_randomize,
        pauseOnHover: themo_flex_pauseonhover,
        touch: themo_flex_touch,
        directionNav: themo_flex_directionnav,
        controlNav: themo_flex_controlNav,
        //directionNav: false,
        prevText: '',
        nextText: '',
        start: function (slider) {
            //slider.removeClass( "flexpreloader");
            jQuery('body').addClass('loaded');
        },
        after: function (slider) {
        },
        before: function () {
        }
    });
}

//-----------------------------------------------------
// Active Lightbox
//-----------------------------------------------------
function themo_active_lightbox(){
    // delegate calls to data-toggle="lightbox"
    jQuery(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        return jQuery(this).ekkoLightbox({
            always_show_close: true,
            gallery_parent_selector: '.gallery',
            right_arrow_class: '.flex-next',
            left_arrow_class: '.flex-prev'
        });
    });
}

jQuery( function ( $ ) {

    // fix pricing columns
	themo_adjust_pricing_table_height();

    // start isotope
    themo_init_isotope();

    /*jQuery('.th-parallax').parent().parallax();
8
    jQuery('.th-parallax').parent().css({"border-color": "#000",
        "border-width":"10px",
        "border-style":"solid"});
        */


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
                var parent_class = $(this).closest('.th-portfolio').attr("id");
            } else {
                var parent_class = $(filterValue).closest('.th-portfolio').attr("id");
            }

            // Remove .current class from all a links inside .th-portfolio-filters
            $('#'+parent_class+' .th-portfolio-filters a').removeClass( "current" );

            // Add .current class to current filter link.
            $(this).addClass( "current" );

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

        // layout Isotope after each image loads
        $bloggrid.imagesLoaded().progress( function() {
            $bloggrid.on('layoutComplete', function (event, laidOutItems) {
                console.log('layoutComplete with ' + laidOutItems.length + ' items');
            });
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

            // Button Wrap
            $(this).find('> div .th-btn-wrap').each(function(){
                ($(this).height() > $tallestCol) ? $tallestCol = $(this).height() : $tallestCol = $tallestCol;
            });

            // Safety net incase pricing tables height couldn't be determined
            if($tallestCol == 0) $tallestCol = 'auto';

            // Set even height
            $(this).find('> div .th-btn-wrap').css('height',$tallestCol);

            // FEATURES UL
            $(this).find('> div .th-pricing-features').each(function(){
                ($(this).height() > $tallestCol) ? $tallestCol = $(this).height() : $tallestCol = $tallestCol;
            });

            // Safety net incase pricing tables height couldn't be determined
            if($tallestCol == 0) $tallestCol = 'auto';

            // Set even height
            $(this).find('> div .th-pricing-features').css('height',$tallestCol);



            //th-btn-wrap

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



    // tooltips
    $('a[rel=tooltip]').tooltip();

    // popovers
    $("a[rel=popover]").popover();

} );



//======================================================================
// On Window Load - executes when complete page is fully loaded, including all frames, objects and images
//======================================================================
jQuery(window).load(function($) {
    "use strict";


    // Initiate Lightbox
    themo_active_lightbox();


});


