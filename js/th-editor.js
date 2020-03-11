/**
 * Created by rl on 2017-03-30.
 */
jQuery( function( $ ) {

    if (typeof $e != "undefined" ){

        //console.log("Loading Page Settings Panel");

        // Page Layout Options
        elementor.settings.page.addChangeCallback( 'themo_page_layout', function( newValue ) {
            // Here you can do as you wish with the newValue
            //console.log("themo_page_layout");

            try{
            //code that causes an error
                $e.run('document/save/auto', {
                    force:true,
                    onSuccess:function(){
                        elementor.reloadPreview();
                        elementor.once('preview:loaded',function(){
                            $e.route('panel/page-settings/settings')}
                        )
                    }
                });

            }catch(e){
                console.log("Failed to update Page Settings.");
            }

        } );

        // Header Transparency
        elementor.settings.page.addChangeCallback( 'themo_transparent_header', function( newValue ) {
            // Here you can do as you wish with the newValue

            //onsole.log("themo_transparent_header");

            try{
                //code that causes an error
                $e.run('document/save/auto', {
                    force:true,
                    onSuccess:function(){
                        elementor.reloadPreview();
                        elementor.once('preview:loaded',function(){
                            $e.route('panel/page-settings/settings')}
                        )
                    }
                });

            }catch(e){
                console.log("Failed to update Page Settings.");
            }


        } );

        // Header Contenet Style
        elementor.settings.page.addChangeCallback( 'themo_header_content_style', function( newValue ) {
            // Here you can do as you wish with the newValue

            //console.log("themo_header_content_style");

            try{
                //code that causes an error
                $e.run('document/save/auto', {
                    force:true,
                    onSuccess:function(){
                        elementor.reloadPreview();
                        elementor.once('preview:loaded',function(){
                            $e.route('panel/page-settings/settings')}
                        )
                    }
                });

            }catch(e){
                console.log("Failed to update Page Settings.");
            }

        } );

        // Alt Logo
        elementor.settings.page.addChangeCallback( 'themo_alt_logo', function( newValue ) {
            // Here you can do as you wish with the newValue

            //console.log("themo_alt_logo");

            try{
                //code that causes an error
                $e.run('document/save/auto', {
                    force:true,
                    onSuccess:function(){
                        elementor.reloadPreview();
                        elementor.once('preview:loaded',function(){
                            $e.route('panel/page-settings/settings')}
                        )
                    }
                });

            }catch(e){
                console.log("Failed to update Page Settings.");
            }
        });
    }
});