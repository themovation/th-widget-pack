/**
 * Created by rl on 2017-03-30.
 */
jQuery(function ($) {
    var interval = false;
    var icon_element_generic = '.elementor-control-thmv_icon_icon';
    var icon_element = icon_element_generic + '0';
    var icon_holder = '.icon-holder-parent';
    var ordering_element = '.elementor-control-thmv_icon_ordering';
    var thmv_repeater_editable = '#elementor-controls > .elementor-control-type-repeater .elementor-repeater-row-controls.editable';
    var thmv_style_element = 'select[data-setting="thmv_style"]';
    var styleToHideIconsFor = ['style_4','style_5'];
    
    var interval_tabs = false;
    var tab_element_generic = '.elementor-control-thmv_tab_item_title';
    var tab_element = tab_element_generic + '0';
    var tab_ordering_element = '.elementor-control-thmv_tab_ordering';
    
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
                        setupAccordion();
                    }
                    

                }

            }, 100);

            function addIconHolder($iconHolder, $icon, $label, index) {
                var holder = $('<div class="icon-holder"/>');
                var innerholder = $('<div class="icon-content"/>');
                $iconHolder.append(holder);
                holder.append('<h3>Icon ' + (index + 1) + '</h3>');
                holder.append(innerholder);
                innerholder.append($icon);
                innerholder.append($label);

            }
            function setupAccordion() {
                var $parentElement = $(thmv_repeater_editable);
                if ($parentElement.find(icon_holder).length !== 0) {
                    if ($parentElement.find(icon_holder).find(icon_element).eq(0).hasClass('elementor-tab-close')) {
                        $parentElement.find(icon_holder).hide();
                    } else {
                        $parentElement.find(icon_holder).show();
                    }
                }
                if ($parentElement.find(icon_holder).length == 0) {
                    $parentElement.find(icon_element).each(function () {
                        var $parent = $(this).closest('.elementor-repeater-row-controls');
                        var $iconHolder = $('<div class="icon-holder-parent"/>');
                        $(this).before($iconHolder);
                        var ordering = $parentElement.find(ordering_element).find('input').val();
                        var $allIcons = $parent.find('div[class*="elementor-control-thmv_icon_icon"]');
                        var $allLabels = $parent.find('div[class*="elementor-control-thmv_icon_label"]');
                        if (ordering !== '') {
                            var orderArr = ordering.split(',');
                            for (var i = 0; i < orderArr.length; i++) {
                                var order = orderArr[i];
                                var $thisIcon = $allIcons.eq(order);
                                var $thisLabel = $allLabels.eq(order);
                                addIconHolder($iconHolder, $thisIcon, $thisLabel, i);

                            }
                        } else {
                            $parent.find('div[class*="elementor-control-thmv_icon_icon"]').each(function (index) {
                                var $thisIcon = $allIcons.eq(index);
                                var $thisLabel = $allIcons.eq(index);
                                addIconHolder($iconHolder, $thisIcon, $thisLabel, index);
                            });
                        }

                    });
                    if ($parentElement.find(icon_holder).length) {
                        $parentElement.find(icon_holder).dragSort({
                            onMoveComplete: function () {
                                var valueArr = [];
                                $parentElement.find(icon_holder).find('.elementor-control-type-icons').each(function () {
                                    var tempSetting = $(this).find('input[type="hidden"]').data('setting');
                                    valueArr.push(tempSetting.replace('thmv_icon_icon', ''));
                                });
                                var value = valueArr.join();
                                var orderingField = $parentElement.find(ordering_element).find('input');
                                orderingField.val(value);
                                orderingField.trigger('input');
                            }
                        });

                        $parentElement.find(icon_holder).find('.icon-holder h3').on('click', function () {
                            $(this).next('.icon-content').toggle();
                        });
                    }


                }
            }

        });

        elementor.hooks.addAction('panel/open_editor/widget/themo-tabs', function (panel, model, view) {
            interval_tabs = setInterval(function () {

                if ($(thmv_repeater_editable).length) {
                    setupTabsAccordion();
                }

            }, 100);

            function addTabHolder($iconHolder, $title, $price, $content, index) {
                var holder = $('<div class="icon-holder"/>');
                var innerholder = $('<div class="icon-content"/>');
                $iconHolder.append(holder);
                holder.append('<h3>Tab ' + (index + 1) + '</h3>');
                holder.append(innerholder);
                innerholder.append($title);
                innerholder.append($price);
                innerholder.append($content);

            }
            function setupTabsAccordion() {
                var $parentElement = $(thmv_repeater_editable);
                if ($parentElement.find(icon_holder).length == 0) {
                    $parentElement.find(tab_ordering_element).hide();
                    $parentElement.find(tab_element).each(function () {
                        var $parent = $(this).closest('.elementor-repeater-row-controls');
                        var $iconHolder = $('<div class="icon-holder-parent"/>');
                        $(this).before($iconHolder);
                        var ordering = $parentElement.find(tab_ordering_element).find('input').val();
                        var $allTitles = $parent.find('div[class*="elementor-control-thmv_tab_item_title"]');
                        var $allPrices = $parent.find('div[class*="elementor-control-thmv_tab_item_price"]');
                        var $allContent = $parent.find('div[class*="elementor-control-thmv_tab_item_content"]');
                        if (ordering !== '') {
                            var orderArr = ordering.split(',');
                            for (var i = 0; i < orderArr.length; i++) {
                                var order = orderArr[i];
                                var $thisTitle = $allTitles.eq(order);
                                var $thisPrice = $allPrices.eq(order);
                                var $thisContent = $allContent.eq(order);
                                addTabHolder($iconHolder, $thisTitle, $thisPrice, $thisContent, i);

                            }
                        } else {
                            $parent.find('div[class*="elementor-control-thmv_tab_item_title"]').each(function (index) {
                               var $thisTitle = $allTitles.eq(index);
                                var $thisPrice = $allPrices.eq(index);
                                var $thisContent = $allContent.eq(index);
                                addTabHolder($iconHolder, $thisTitle, $thisPrice, $thisContent, index);
                            });
                        }

                    });
                    if ($parentElement.find(icon_holder).length) {
                        $parentElement.find(icon_holder).dragSort({
                            onMoveComplete: function () {
                                var valueArr = [];
                                $parentElement.find(icon_holder).find('input[data-setting*="thmv_tab_item_title"]').each(function () {
                                    var tempSetting = $(this).data('setting');
                                    valueArr.push(tempSetting.replace('thmv_tab_item_title', ''));
                                });
                                var value = valueArr.join();
                                var orderingField = $parentElement.find(tab_ordering_element).find('input');
                                orderingField.val(value);
                                orderingField.trigger('input');
                            }
                        });

                        $parentElement.find(icon_holder).find('.icon-holder h3').on('click', function () {
                            $(this).next('.icon-content').toggle();
                        });
                    }


                }
            }

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