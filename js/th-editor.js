/**
 * Created by rl on 2017-03-30.
 */
jQuery( function( $ ) {
    if ( undefined !== window.elementor ) {
        //console.log('We are in!');
        elementor.hooks.addAction('panel/open_editor/widget', function (panel, model, view) {


            //elementor.reloadPreview();

            /*var $element = view.$el.find( '.elementor-selector' );

             if ( $element.length ) {
             $element.click( function() {
             alert( 'Some Message' );
             } );
             }*/

            /* var self = this;

             var settings = self.model.toJSON();

             settings.id = elementor.config.post_id;

             NProgress.start();

             elementor.ajax.send( 'save_page_settings', {
             data: settings,
             success: function() {
             NProgress.done();

             self.setSettings( 'savedSettings', settings );

             self.hasChange = false;

             if ( callback ) {
             callback.apply( self, arguments );
             }
             console.log('saved');
             },
             error: function() {
             alert( 'An error occurred' );
             }
             } );*/

        });

    }else{
        console.log('does not exist');
    }
} );