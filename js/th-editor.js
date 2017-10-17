/**
 * Created by rl on 2017-03-30.
 */
jQuery( function( $ ) {

    // Page Settings Panel - onchange save and reload elementor window.
    if ( undefined !== elementor.settings.page ) {

        //elementor.settings.page.addChangeCallback( 'themo_page_layout', handle_themo_page_layout );

        function handle_themo_page_layout ( newValue ) {
            //console.log( newValue );
            elementor.reloadPreview();

            elementor.once( 'preview:loaded', function() {
                elementor.getPanelView().setPage( 'page_settings' );
            } );
        }

        //elementor.settings.page.addChangeCallback( 'themo_transparent_header', handle_themo_transparent_header );

        function handle_themo_transparent_header ( newValue ) {
            //console.log( newValue );
            elementor.reloadPreview();

            /*elementor.once( 'preview:loaded', function() {
                elementor.getPanelView().setPage( 'page_settings' );
            } );*/
        }

        //elementor.settings.page.addChangeCallback( 'themo_header_content_style', handle_themo_header_content_style );

        function handle_themo_header_content_style ( newValue ) {
            //console.log( newValue );
            elementor.reloadPreview();

            elementor.once( 'preview:loaded', function() {
                elementor.getPanelView().setPage( 'page_settings' );
            } );
        }

        //elementor.settings.page.addChangeCallback( 'themo_alt_logo', handle_themo_alt_logo );

        function handle_themo_alt_logo ( newValue ) {
            //console.log( newValue );
            elementor.reloadPreview();

            /*elementor.once( 'preview:loaded', function() {
                elementor.getPanelView().setPage( 'page_settings' );
            } );*/
        }

        // Page Layout Options
        elementor.settings.page.addChangeCallback( 'themo_page_layout', function( newValue ) {
            // Here you can do as you wish with the newValue

            //console.log('PAGE LAYOUT CHANGE.');

            this.save( function() {
                elementor.reloadPreview();

                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'page_settings' );
                } );
            } );
        } );

        // Header Transparency
        elementor.settings.page.addChangeCallback( 'themo_transparent_header', function( newValue ) {
            // Here you can do as you wish with the newValue

            //console.log('NEW VALUE '+newValue);

            this.save( function() {
                elementor.reloadPreview();

                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'page_settings' );
                } );
            } );


        } );

        // Header Contenet Style
        elementor.settings.page.addChangeCallback( 'themo_header_content_style', function( newValue ) {
            // Here you can do as you wish with the newValue

            this.save( function() {
                elementor.reloadPreview();

                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'page_settings' );
                } );
            } );
        } );

        // Alt Logo
        elementor.settings.page.addChangeCallback( 'themo_alt_logo', function( newValue ) {
            // Here you can do as you wish with the newValue

            //console.log('NEW VALUE ALT LOGO '+newValue);

            this.save( function() {
                elementor.reloadPreview();

                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage( 'page_settings' );
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