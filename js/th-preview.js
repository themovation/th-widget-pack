/**
 * Created by rl on 2017-03-31.
 */



(function() {
    var runMyCode = function($) {
        if ( undefined !== window.elementor ) {
            /*
             $( "header[data-transparent-header='true']:not('.headhesive--clone')" ).prepend( "<p class='hide-nav'><a href=''>Test</a></p>" );
             */

            $( "<div class='hide-nav-wrap button'><div class='hide-nav'>Hide/Show Header</div> </div>" ).insertAfter( "header[data-transparent-header='true']:not('.headhesive--clone')" );

            $( ".hide-nav-wrap" ).click(function() {
                $( "header[data-transparent-header='true']:not('.headhesive--clone')" ).fadeToggle( "fast", function() {
                    // Animation complete.
                });
            });
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