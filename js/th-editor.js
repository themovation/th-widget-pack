/**
 * Created by rl on 2017-03-30.
 */
jQuery(function ($) {
    var interval = false;
    var icon_element_generic = '.elementor-control-thmv_icon_icon';
    var icon_element = icon_element_generic + '0';
    var icon_holder = '.icon-holder-parent';
    var ordering_element = '.elementor-control-thmv_icon_ordering';
    if (typeof $e != "undefined") {
        console.log($e.commands.getAll());
        elementor.hooks.addAction('panel/open_editor/widget', function (panel, model, view) {
            if ('themo-accommodation-listing' !== model.elType) {
                clearInterval(interval);
                return;
            }

        });
        elementor.hooks.addAction('panel/open_editor/widget/themo-accommodation-listing', function (panel, model, view) {
            interval = setInterval(function () {
                var element = '#elementor-controls .elementor-control-thmv_section_listing';
                var $collapsed = $(element).next('.elementor-control-listings');
                if ($collapsed.length) {
                    $collapsed.find('> .elementor-control-content >.elementor-repeater-fields-wrapper >.elementor-repeater-fields').on('click', function () {
                        setupAccordion($(this));

                    });
                }

            }, 200);

            function addIconHolder($parent, $iconHolder, $icon, $label, index) {
                var holder = $('<div class="icon-holder"/>');
                var innerholder = $('<div class="icon-content"/>');
                $iconHolder.append(holder);
                holder.append('<h3>Icon ' + (index + 1) + '</h3>');
                holder.append(innerholder);
                innerholder.append($icon);
                innerholder.append($label);

            }
            function setupAccordion($parentElement) {
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
                                addIconHolder($parent, $iconHolder, $thisIcon, $thisLabel, i);

                            }
                        } else {
                            $parent.find('div[class*="elementor-control-thmv_icon_icon"]').each(function (index) {
                                var $thisIcon = $allIcons.eq(index);
                                var $thisLabel = $allIcons.eq(index);
                               addIconHolder($parent, $iconHolder, $thisIcon, $thisLabel, index);
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
                                orderingField.change();
//                               $e.run( 'finder/open' );
//                               $e.run( 'finder/close' );

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