/**
 * Created by rl on 2017-03-31.
 */
jQuery( function( $ ) {
    if ( undefined !== window.elementor ) {
        console.log('We are in to the preview!');
        /*
          $( "header[data-transparent-header='true']:not('.headhesive--clone')" ).prepend( "<p class='hide-nav'><a href=''>Test</a></p>" );
         */

        $( "<div class='hide-nav-wrap button'><div class='hide-nav'>Hide Navigation</div> </div>" ).insertAfter( "header[data-transparent-header='true']:not('.headhesive--clone')" );

        $( ".hide-nav-wrap" ).click(function() {
            $( "header[data-transparent-header='true']:not('.headhesive--clone')" ).fadeToggle( "fast", function() {
                // Animation complete.
            });
        });
    }
} );