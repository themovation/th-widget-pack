/**
 * Created by rl on 2017-03-30.
 */
jQuery( function( $ ) {

    if (typeof $e != "undefined" ){

        console.log("Loading Page Settings Panel");

        // Page Layout Options
        elementor.settings.page.addChangeCallback( 'themo_page_layout', function( newValue ) {
            // Here you can do as you wish with the newValue
            //console.log("themo_page_layout");

            $e.run('document/save/auto', {
                force:true,
                onSuccess:function(){
                    elementor.reloadPreview();
                    elementor.once('preview:loaded',function(){
                        $e.route('panel/page-settings/settings')}
                    )
                }
            });

        } );

        // Header Transparency
        elementor.settings.page.addChangeCallback( 'themo_transparent_header', function( newValue ) {
            // Here you can do as you wish with the newValue

            //onsole.log("themo_transparent_header");

            $e.run('document/save/auto', {
                force:true,
                onSuccess:function(){
                    elementor.reloadPreview();
                    elementor.once('preview:loaded',function(){
                        $e.route('panel/page-settings/settings')}
                    )
                }
            });


        } );

        // Header Contenet Style
        elementor.settings.page.addChangeCallback( 'themo_header_content_style', function( newValue ) {
            // Here you can do as you wish with the newValue

            //console.log("themo_header_content_style");

            $e.run('document/save/auto', {
                force:true,
                onSuccess:function(){
                    elementor.reloadPreview();
                    elementor.once('preview:loaded',function(){
                        $e.route('panel/page-settings/settings')}
                    )
                }
            });

        } );

        // Alt Logo
        elementor.settings.page.addChangeCallback( 'themo_alt_logo', function( newValue ) {
            // Here you can do as you wish with the newValue

            //console.log("themo_alt_logo");

            $e.run('document/save/auto', {
                force:true,
                onSuccess:function(){
                    elementor.reloadPreview();
                    elementor.once('preview:loaded',function(){
                        $e.route('panel/page-settings/settings')}
                    )
                }
            });
        });
    }
});