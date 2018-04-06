/**
 * Created by rl on 2017-03-30.
 */
jQuery( function( $ ) {

    // Page Settings Panel - onchange save and reload elementor window.

    if ( typeof elementor != "undefined" && typeof elementor.settings.page != "undefined") {

        // Page Layout Options
        elementor.settings.page.addChangeCallback( 'themo_page_layout', function( newValue ) {
            // Here you can do as you wish with the newValue

            //console.log('PAGE LAYOUT CHANGE.');

            elementor.saver.update( {
                onSuccess: function() {

                    //console.log('SAVE');
                    elementor.reloadPreview();

                    elementor.once( 'preview:loaded', function() {
                        elementor.getPanelView().setPage( 'page_settings' );
                    } );
                }
            } );
        } );

        // Header Transparency
        elementor.settings.page.addChangeCallback( 'themo_transparent_header', function( newValue ) {
            // Here you can do as you wish with the newValue

            elementor.saver.update( {
                onSuccess: function() {

                    //console.log('SAVE');
                    elementor.reloadPreview();

                    elementor.once( 'preview:loaded', function() {
                        elementor.getPanelView().setPage( 'page_settings' );
                    } );
                }
            } );



        } );

        // Header Contenet Style
        elementor.settings.page.addChangeCallback( 'themo_header_content_style', function( newValue ) {
            // Here you can do as you wish with the newValue

            elementor.saver.update( {
                onSuccess: function() {

                    //console.log('SAVE');
                    elementor.reloadPreview();

                    elementor.once( 'preview:loaded', function() {
                        elementor.getPanelView().setPage( 'page_settings' );
                    } );
                }
            } );
        } );

        // Alt Logo
        elementor.settings.page.addChangeCallback( 'themo_alt_logo', function( newValue ) {
            // Here you can do as you wish with the newValue

            //console.log('NEW VALUE ALT LOGO '+newValue);

            elementor.saver.update( {
                onSuccess: function() {

                    //console.log('SAVE');
                    elementor.reloadPreview();

                    elementor.once( 'preview:loaded', function() {
                        elementor.getPanelView().setPage( 'page_settings' );
                    } );
                }
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