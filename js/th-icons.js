var th_object;
var wrapper = '.icon-fields-wrapper';
var parent_wrapper = '.option-tree-th-icons-wrap';
var activeClass = 'icon-active';
var orderingField = '#th_room_icons_ordering';
jQuery(document).ready(function ($) {

    $('body').prepend('<div class="thmv-iconpicker-outer"><div class="thmv-iconpicker-middle"><div class="thmv-iconpicker"><div class="thmv-closebtn"></div><input type="text" class="srchicons" placeholder="eg:google" /> <div class="iconsholder"></div><div class="thmv-iconpicker-close dashicons dashicons-no-alt"></div></div></div></div>'); // Appending Iconpicker box below input box
    setupOrdering();

    checkOrderDown();

    function checkOrderDown() {
        $(wrapper + '.' + activeClass).find('.order-down').show();
        $(wrapper + '.' + activeClass).last().find('.order-down').hide();

    }
    function setupOrdering() {
        var ordering = $(orderingField).val();
        if (ordering === '') {
            var orderingTemp = Array($(wrapper).length).fill().map((_, i) => i);
            ordering = orderingTemp.join(',');
            $(orderingField).val(ordering);

        }
        var orderArr = ordering.split(',');

        for (var i = 0; i < orderArr.length; i++) {
            var index = orderArr[i];
            $(parent_wrapper).append($(wrapper + '[data-index="' + index + '"]'));

        }

    }
    function saveOrdering() {
        var valueArr = [];
        $(wrapper).each(function () {
            valueArr.push($(this).data('index'));
        });
        var value = valueArr.join();
        $(orderingField).val(value);
    }
    var allIcons = {};
    if (th_object.urls.brands) {
        $.getJSON(th_object.urls.brands, function (json) {
            allIcons.brands = json.icons;
            for (var i = 0; i < allIcons.brands.length; i++) {
                appendIcon('fa-brands', th_object.keys.brands+ ' fa-' , allIcons.brands[i]);

            }
        });
    }

    if (th_object.urls.regular) {
        $.getJSON(th_object.urls.regular, function (json) {
            allIcons.regular = json.icons;
            for (var i = 0; i < allIcons.regular.length; i++) {
                appendIcon('fa-regular', th_object.keys.regular+ ' fa-' , allIcons.regular[i]);

            }
        });
    }
    if (th_object.urls.solid) {
        $.getJSON(th_object.urls.solid, function (json) {
            allIcons.solid = json.icons;
            for (var i = 0; i < allIcons.solid.length; i++) {
                appendIcon('fa-solid', th_object.keys.solid+ ' fa-' , allIcons.solid[i]);

            }
        });
    }
    if (th_object.trip_icons) {

        for (var i = 0; i < th_object.trip_icons.length; i++) {
            appendIcon('th-trip', 'travelpack-', th_object.trip_icons[i]);
        }
    }
    if (th_object.linea_icons) {
        for (var i = 0; i < th_object.linea_icons.length; i++) {
            appendIcon('th-trip', 'icon-', th_object.linea_icons[i]);
        }
    }
    
    iconpickerbox();
    $(wrapper).find('.remove-button').on('click', function (e) {
        e.preventDefault();
        var $thisWrapper = $(this).closest(wrapper);
        $thisWrapper.find('input').val('');
        $thisWrapper.find('i').attr('class', 'icon ot-icon-plus-circle');
        $('.add-another-icon').before($thisWrapper);
        $(this).hide();
        $thisWrapper.hide();
        $thisWrapper.removeClass(activeClass);
        checkOrderDown();
        saveOrdering();

    });
    $('.add-another-icon').on('click', function (e) {
        e.preventDefault();

        $selectedBlock = $(wrapper + ':hidden').eq(0);
        $selectedBlock.show();
        if (!$(wrapper + ':hidden').length) {
            $(this).hide();
        }
        $selectedBlock.find('.remove-button').show();
        $selectedBlock.addClass(activeClass);
        checkOrderDown();
        saveOrdering();
    });
    function appendIcon(library, prefix, icon) {
        $(".thmv-iconpicker .iconsholder").append('<p class="geticonval"><i data-library="' + library + '" data-value="' + prefix + icon + '" class="' + prefix + icon + '"></i>' + icon + '</p>');

    }
    $('.order-buttons > span').on('click', function (e) {
        e.preventDefault();
        var $thisTab = $(this).closest(wrapper);
        var $holder = $thisTab.closest(parent_wrapper);
        var thisIndex = $thisTab.index();
        var action = $(this).data('action');
        if (thisIndex > 0 && action === 'up') {
            var $previousDiv = $holder.find(wrapper).eq(thisIndex - 1);
            if ($previousDiv.length) {
                $previousDiv.before($thisTab);
            }

        } else if (action === 'down') {
            var $nextDiv = $holder.find(wrapper).eq(thisIndex + 1);
            if ($nextDiv.length) {
                $nextDiv.after($thisTab);
            }


        }
        checkOrderDown();
        saveOrdering();
    });
    $('.add-th-icon').on('click', function (e) {
        e.preventDefault();
        $('.add-th-icon').removeClass('active');
        $(this).addClass('active');
        $('.thmv-iconpicker-outer').css('display', 'table');
        $('.thmv-iconpicker .geticonval').removeClass('selectedicon');

    });
    $("body").on('click', '.thmv-iconpicker .geticonval', function () {
        var getIcon = $(this).find('i');
        $('.thmv-iconpicker .geticonval').removeClass('selectedicon');
        $(this).addClass('selectedicon');
        var $selectedBlock = $('.add-th-icon.active');
        var $valueInput = $selectedBlock.closest(wrapper).find('.th_icon_value');
        var $libraryInput = $selectedBlock.closest(wrapper).find('.th_icon_library');
        var $placeholder = $selectedBlock.find('i');
        $valueInput.val(getIcon.data('value'));
        $libraryInput.val(getIcon.data('library'));
        $placeholder.attr('class', getIcon.data('value'));
        $('.thmv-iconpicker-outer').css('display', 'none');
    });
    function iconpickerbox() {


//Search Box Code Starts
        $(".thmv-iconpicker .srchicons").keyup(function () {

            var filter = $(this).val(),
                    count = 0;
            $(".thmv-iconpicker .geticonval").each(function () {

                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).fadeOut();
                } else {
                    $(this).show();
                    count++;
                }
            });
        }); //Search box code Ends

        //Close button code

        $('.thmv-iconpicker-close').click(function () {
            $('.thmv-iconpicker-outer').css('display', 'none');
        });
    }
});
