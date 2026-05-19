jQuery(document).ready(function ($) {
    var mainParent = '.thmv-tabs';
    var heading_wrapper = '.thmv-tabs-wrapper';
    var tab_title = '.thmv-tab-title';
    var tab_content_wrapper = '.thmv-tabs-content-wrapper';
    var tab_content = '.thmv-tab-content';
    if ($(mainParent).length) {
        $(mainParent + ' ' + tab_title).on('click', function (e) {
            e.preventDefault();
            var $tab = $(this);
            if ($tab.hasClass('active'))
                return;

            $tab.closest(mainParent).find(tab_title).removeClass('active');

            var index = $tab.data('tab');
            $tab.closest(mainParent).find(heading_wrapper).find(tab_title).eq(index).addClass('active');
            $tab.closest(mainParent).find(tab_content_wrapper).find(tab_title).eq(index).addClass('active');
            
            $tab.closest(mainParent).find(tab_content).removeClass('active').hide();

            $tab.closest(mainParent).find(tab_content).eq(index).addClass('active').show();
        });
    }
});

