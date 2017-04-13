/**
 * Created by rl on 2017-03-30.
 */
jQuery( function( $ ) {

    // Page Settings Panel - onchange save and reload elementor window.
    if ( undefined !== elementor.pageSettings ) {

        console.log('GETTING HERE');

        // Page Layout Options
        elementor.pageSettings.addChangeCallback( 'themo_page_layout', function( newValue ) {
            // Here you can do as you wish with the newValue

            console.log('PAGE LAYOUT CHANGE.');

            this.save( function() {
                console.log('Calling Reload');
                elementor.reloadPreview();
                console.log('Reload Complete');
                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'settingsPage' );
                } );
            } );
        } );

        // Header Transparency
        elementor.pageSettings.addChangeCallback( 'themo_transparent_header', function( newValue ) {
            // Here you can do as you wish with the newValue

            this.save( function() {
                elementor.reloadPreview();

                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'settingsPage' );
                } );
            } );
        } );

        // Header Contenet Style
        elementor.pageSettings.addChangeCallback( 'themo_header_content_style', function( newValue ) {
            // Here you can do as you wish with the newValue

            this.save( function() {
                elementor.reloadPreview();

                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'settingsPage' );
                } );
            } );
        } );

        // Alt Logo
        elementor.pageSettings.addChangeCallback( 'themo_alt_logo', function( newValue ) {
            // Here you can do as you wish with the newValue

            this.save( function() {
                elementor.reloadPreview();

                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'settingsPage' );
                } );
            } );
        } );

    }


    if ( undefined !== window.elementor ) {

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
    }
} );