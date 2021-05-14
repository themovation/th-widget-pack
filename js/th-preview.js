/**
 * Created by rl on 2017-03-31.
 */



(function() {

    var runMyCode = function($) {

        /* Only for Elementor Live Preview */
        if ( (typeof window.window.frameElement.id != "undefined" && window.frameElement.id === "elementor-preview-iframe") ) {
            /*
             $( "header[data-transparent-header='true']:not('.headhesive--clone')" ).prepend( "<p class='hide-nav'><a href=''>Test</a></p>" );
             */

            /* Check if we are using Groovy Menu, if we are, check for css position of wrapper div */

            if($( "header" ).hasClass( "gm-navbar" )){
                console.log('Groovy Menu is active');
                var themo_gm_menu_pos = $('header .gm-wrapper').css('position');
                /*if($( "header div" ).hasClass( "gm-padding" )){
                    console.log('Groovy Menu has padding.');
                    var themo_gm_menu_padding = $('.gm-padding').css("padding-top");
                    console.log('Groovy menu top padding: '+themo_gm_menu_padding);
                }*/

                if(themo_gm_menu_pos == 'absolute'){
                    console.log('Groovy menu position: '+themo_gm_menu_pos);
                    $( "<div class='hide-nav-wrap button'><div class='hide-nav'>Hide/Show Header</div> </div>" ).insertAfter( "header.gm-navbar" );

                    $( ".hide-nav-wrap" ).click(function() {
                        $( "header.gm-navbar .gm-wrapper, header.gm-navbar .gm-padding" ).fadeToggle( "fast", function() {
                            // Animation complete.
                        });
                    });

                    setTimeout(function() {
                        $( ".hide-nav-wrap" ).trigger( "click" ); // Hide Nav on Start.
                    }, 2000);
                }
            }else if($("#thhf-masthead").length){ // HFE header.
                $( "<div class='hide-nav-wrap button'><div class='hide-nav'>Hide/Show Header</div> </div>" ).insertAfter( "#thhf-masthead" );
                $( ".hide-nav-wrap" ).click(function() {
                    $( "#thhf-masthead").fadeToggle( "fast", function() {
                        // Animation complete.
                    });
                });
                setTimeout(function() {
                    $( ".hide-nav-wrap" ).trigger( "click" ); // Hide Nav on Start.
                }, 2000);
            }else if($("#thhf-masthead-sticky").length){ // HFE sticky header.
                $( "<div class='hide-nav-wrap button'><div class='hide-nav'>Hide/Show Header</div> </div>" ).insertAfter( "#thhf-masthead-sticky" );
                $( ".hide-nav-wrap" ).click(function() {
                    $( "#thhf-masthead-sticky" ).fadeToggle( "fast", function() {
                        // Animation complete.
                    });
                });
                setTimeout(function() {
                    $( ".hide-nav-wrap" ).trigger( "click" ); // Hide Nav on Start.
                }, 2000);
            }else{ // For Standard Header.
                $( "<div class='hide-nav-wrap button'><div class='hide-nav'>Hide/Show Header</div> </div>" ).insertAfter( "header[data-transparent-header='true']:not('.headhesive--clone')" );

                $( ".hide-nav-wrap" ).click(function() {
                    $( "header[data-transparent-header='true']:not('.headhesive--clone')" ).fadeToggle( "fast", function() {
                        // Animation complete.
                    });
                });

                setTimeout(function() {
                    $( ".hide-nav-wrap" ).trigger( "click" ); // Hide Nav on Start.
                }, 2000);
            }

        }
    };

    var timer = function() {
        if (window.jQuery && window.jQuery.ui) {
            runMyCode(window.jQuery);
        } else {
            window.setTimeout(timer, 100);
        }
    };
    timer();
})();