(function ($) {
    
    /**
     * Sticky Header JS
     * 
     */

    function scrollFunction() {

        var regularHeader = $('#thhf-masthead');
        var stickyHeader = $('#thhf-masthead-sticky');
        var $wpAdminBar = $('#wpadminbar');
        var scrollHeight = $(window).scrollTop();

        if ($wpAdminBar.length) {
            var $wpAdminBarHeight = $wpAdminBar.height();
        } else {
            var $wpAdminBarHeight = 0;
        }


        $mobileAdminBar = $wpAdminBarHeight;

        /*if (window.matchMedia("(max-width: 600px)").matches) {
         $mobileAdminBar = 0;
         } else {
         $mobileAdminBar = $wpAdminBarHeight;
         }*/


        if (regularHeader.length && stickyHeader.length) {
            if (regularHeader.height() < scrollHeight) {
                /*if mobile, then adminbar is not sticky and the height should not be considered*/
                $wpAdminBarHeight = $('body').data('elementor-device-mode')==='mobile' ? 0: $wpAdminBarHeight;
                stickyHeader.css({
                    "position": "fixed",
                    "display": "inherit",
                    "top": 0 + $wpAdminBarHeight,
                });

                stickyHeader.show();
            } else {

                stickyHeader.css({
                    "position": "relative",
                    "display": "inherit",
                    "top": 0,
                });
                if (stickyHeader.hasClass("sticky-stacked")) {
                    stickyHeader.show();
                } else {
                    stickyHeader.hide();
                }
            }
        } else {
            stickyHeader.css({
                "position": "fixed",
                "display": "inherit",
                "top": 0 + $mobileAdminBar,
            });
            $wpAdminBar.css({
                "position": "fixed",
                "display": "inherit",
                "top": 0,
            });
        }

    }

    $(window).on('scroll resize load', function () {
        scrollFunction();
    });

})(jQuery);