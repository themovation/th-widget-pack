var th_object;
var wrapper = '.icon-fields-wrapper';
jQuery(document).ready(function ($) {
    $('body').prepend('<div class="thmv-iconpicker-outer"><div class="thmv-iconpicker-middle"><div class="thmv-iconpicker"><div class="thmv-closebtn"></div><input type="text" class="srchicons" placeholder="eg:google" /> <div class="iconsholder"></div><div class="thmv-iconpicker-close dashicons dashicons-no-alt"></div></div></div></div>'); // Appending Iconpicker box below input box

    var allIcons = {};
    if (th_object.urls.brands) {
        $.getJSON(th_object.urls.brands, function (json) {
            allIcons.brands = json.icons;
            for (var i = 0; i < allIcons.brands.length; i++) {
                appendIcon('fa-brands', th_object.keys.brands, allIcons.brands[i]);

            }
        });
    }

    if (th_object.urls.regular) {
        $.getJSON(th_object.urls.regular, function (json) {
            allIcons.regular = json.icons;
            for (var i = 0; i < allIcons.regular.length; i++) {
                appendIcon('fa-regular', th_object.keys.regular, allIcons.regular[i]);

            }
        });
    }
    if (th_object.urls.solid) {
        $.getJSON(th_object.urls.solid, function (json) {
            allIcons.solid = json.icons;
            for (var i = 0; i < allIcons.solid.length; i++) {
                appendIcon('fa-solid', th_object.keys.solid, allIcons.solid[i]);

            }
        });
    }
    iconpickerbox();
    $(wrapper).find('.remove-button').on('click', function (e) {
        e.preventDefault();
        var $thisWrapper = $(this).closest(wrapper);
        $thisWrapper.find('input').val('');
        $thisWrapper.find('i').attr('class','icon ot-icon-plus-circle');
        $('.add-another-icon').before($thisWrapper);
        $(this).hide();
        $thisWrapper.hide();
    });
    $('.add-another-icon').on('click', function (e) {
        e.preventDefault();

        $(wrapper + ':hidden').eq(0).show();
        if (!$(wrapper + ':hidden').length) {
            $(this).hide();
        }
    });
    function appendIcon(library, prefix, icon) {
        $(".thmv-iconpicker .iconsholder").append('<p class="geticonval"><i data-library="' + library + '" data-value="' + prefix + ' fa-' + icon + '" class="' + prefix + ' fa-' + icon + '"></i>' + icon + '</p>');

    }
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
        $selectedBlock.closest(wrapper).find('.remove-button').show();
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
