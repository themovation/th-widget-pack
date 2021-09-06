/**
 * Created by rl on 2017-03-30.
 */
(function ($) {

    $.fn.setupTHMVAccordion = function (options) {
        var $parentElement = $(this);
        var accordionClass = '.accordion-holder';

        if ($parentElement.find(accordionClass).length) {
            return false;
        }
        var accordionHolderClass = '.accordion-holder-parent';
        var accordionElementClassWithoutDot = accordionHolderClass.replace('.', '');
        var accordionClassWithoutDot = accordionClass.replace('.', '');
        var accordionContentClass = '.accordion-content';
        var accordionContentClassWithoutDot = accordionContentClass.replace('.', '');
        var elementorControlClassPrefix = 'elementor-control-';
        var elementorRepeaterClass = '.elementor-repeater-row-controls';

        

        // Default options
        var settings = $.extend(true, {
            accordionTitlePrefix: 'Tab',
            contentElements: [],
            orderingField: 'thmv_tab_ordering'
        }, options);
        var firstElement = settings.contentElements[0];
        var ordering_element = '.elementor-control-'+settings.orderingField;
        var ordering = $parentElement.find(ordering_element).find('input').val();


        var init = function () {
            var copy_element = '.'+elementorControlClassPrefix+firstElement + '0';
            
            $parentElement.find(ordering_element).hide();
            $parentElement.find(copy_element).each(function () {
                var $parent = $(this).closest(elementorRepeaterClass);
                var $accordionHolder = $('<div class="' + accordionElementClassWithoutDot + '"/>');
                $(this).before($accordionHolder);
                
                var $testElement = $parent.find('div[class*="'+elementorControlClassPrefix+firstElement+'"]');
                var lengthArr = $testElement.length;
                if (ordering === '') {
                    ordering = Array(lengthArr).fill().map((_, i) => i);
                }
                var orderArr = ordering.split(',');
                
                
                var contentElementsArray = [];
                for(var j=0; j<settings.contentElements.length; j++){
                    contentElementsArray[j] = $parent.find('div[class*="'+elementorControlClassPrefix+settings.contentElements[j]+'"]');
                }
                for (var i = 0; i < orderArr.length; i++) {
                    
                    var order = orderArr[i];
                    var holder = $('<div class="' + accordionClassWithoutDot + '"/>');
                    var innerholder = $('<div class="' + accordionContentClassWithoutDot + '"/>');
                    $accordionHolder.append(holder);
                    holder.append('<h3><span class="title">' +settings.accordionTitlePrefix+' '+ (i + 1) + '</span><span class="order-arrows"><span data-action="up" class="order-up fas fa-chevron-up"></span><span data-action="down" class="order-down fas fa-chevron-down"></span></span>');
                    holder.append(innerholder);
                    
                    
                    for(var j=0; j<contentElementsArray.length; j++){
                        var $tempElement = contentElementsArray[j].eq(order);
                        innerholder.append($tempElement);
                    }
                    
                }

            });
        }

        init();
        
        $(this).find(accordionClass).find('h3 .title').on('click', function (e) {
            e.preventDefault();
            $(this).closest(accordionClass).find(accordionContentClass).toggle();
        });
        function onMoveComplete() {
            var valueArr = [];
            $parentElement.find(accordionHolderClass).find('input[data-setting*="'+firstElement+'"]').each(function () {
                var tempSetting = $(this).data('setting');
                valueArr.push(tempSetting.replace(firstElement, ''));
            });
            var value = valueArr.join();
            var orderingField = $parentElement.find(ordering_element).find('input');
            orderingField.val(value);
            orderingField.trigger('input');
        }

        $(this).find('.order-arrows > span').on('click', function (e) {
            e.preventDefault();

            var $thisTab = $(this).closest(accordionClass);
            var $holder = $thisTab.closest(accordionHolderClass);
            $thisTab.find(accordionContentClass).hide();
            var thisIndex = $thisTab.index();
            var action = $(this).data('action');
            if (thisIndex > 0 && action === 'up') {
                var $previousDiv = $holder.find(accordionClass).eq(thisIndex - 1);
                if ($previousDiv.length) {
                    $previousDiv.before($thisTab);
                }

            } else if (action === 'down') {
                var $nextDiv = $holder.find(accordionClass).eq(thisIndex + 1);
                if ($nextDiv.length) {
                    $nextDiv.after($thisTab);
                }


            }
            onMoveComplete();
        });

        return this;

    };

}(jQuery));
jQuery(function ($) {
    var interval = false;
    var thmv_repeater_editable = '#elementor-controls > .elementor-control-type-repeater .elementor-repeater-row-controls.editable';
    var thmv_style_element = 'select[data-setting="thmv_style"]';
    var styleToHideIconsFor = ['style_4','style_5'];
    var interval_tabs = false;
    
    if (typeof $e != "undefined") {
        elementor.hooks.addAction('panel/open_editor/widget', function (panel, model, view) {
            if ('themo-accommodation-listing' !== model.elType) {
                clearInterval(interval);
                return;
            }
            if ('themo-tabs' !== model.elType) {
                clearInterval(interval_tabs);
                return;
            }

        });
        elementor.hooks.addAction('panel/open_editor/widget/themo-accommodation-listing', function (panel, model, view) {
            interval = setInterval(function () {

                if ($(thmv_repeater_editable).length) {

                    var listing_style = view.container.settings.attributes.thmv_style;

                    $(thmv_repeater_editable).find(thmv_style_element).each(function () {
                        if ($(this).val() !== listing_style) {
                            $(this).val(listing_style).trigger('change');
                        }
                    });
                    if(styleToHideIconsFor.indexOf(listing_style)>-1){
                        $(thmv_repeater_editable).find('.elementor-control-type-tab.elementor-control-icons').hide();
                    }
                    else {
                        $(thmv_repeater_editable).find('.elementor-control-type-tab.elementor-control-icons').show();
                        $(thmv_repeater_editable).setupTHMVAccordion({
                            accordionTitlePrefix: 'Icon',
                            contentElements : ['thmv_icon_icon','thmv_icon_label'],
                            orderingField: 'thmv_icon_ordering'
                        });
                    }
                    

                }

            }, 100);


        });

        elementor.hooks.addAction('panel/open_editor/widget/themo-tabs', function (panel, model, view) {
            interval_tabs = setInterval(function () {

                if ($(thmv_repeater_editable).length) {
                    $(thmv_repeater_editable).setupTHMVAccordion({
                            contentElements : ['thmv_tab_item_title','thmv_tab_item_price','thmv_tab_item_content']
                        });
                }

            }, 100);


        });
        //console.log("Loading Page Settings Panel");

        // Page Layout Options
        elementor.settings.page.addChangeCallback('themo_page_layout', function (newValue) {
            // Here you can do as you wish with the newValue
            //console.log("themo_page_layout");

            try {
                //code that causes an error
                $e.run('document/save/auto', {
                    force: true,
                    onSuccess: function () {
                        elementor.reloadPreview();
                        elementor.once('preview:loaded', function () {
                            $e.route('panel/page-settings/settings')
                        }
                        )
                    }
                });

            } catch (e) {
                console.log("Failed to update Page Settings.");
            }

        });

        // Header Transparency
        elementor.settings.page.addChangeCallback('themo_transparent_header', function (newValue) {
            // Here you can do as you wish with the newValue

            //onsole.log("themo_transparent_header");

            try {
                //code that causes an error
                $e.run('document/save/auto', {
                    force: true,
                    onSuccess: function () {
                        elementor.reloadPreview();
                        elementor.once('preview:loaded', function () {
                            $e.route('panel/page-settings/settings')
                        }
                        )
                    }
                });

            } catch (e) {
                console.log("Failed to update Page Settings.");
            }


        });

        // Header Contenet Style
        elementor.settings.page.addChangeCallback('themo_header_content_style', function (newValue) {
            // Here you can do as you wish with the newValue

            //console.log("themo_header_content_style");

            try {
                //code that causes an error
                $e.run('document/save/auto', {
                    force: true,
                    onSuccess: function () {
                        elementor.reloadPreview();
                        elementor.once('preview:loaded', function () {
                            $e.route('panel/page-settings/settings')
                        }
                        )
                    }
                });

            } catch (e) {
                console.log("Failed to update Page Settings.");
            }

        });

        // Alt Logo
        elementor.settings.page.addChangeCallback('themo_alt_logo', function (newValue) {
            // Here you can do as you wish with the newValue

            //console.log("themo_alt_logo");

            try {
                //code that causes an error
                $e.run('document/save/auto', {
                    force: true,
                    onSuccess: function () {
                        elementor.reloadPreview();
                        elementor.once('preview:loaded', function () {
                            $e.route('panel/page-settings/settings')
                        }
                        )
                    }
                });

            } catch (e) {
                console.log("Failed to update Page Settings.");
            }
        });
    }
});