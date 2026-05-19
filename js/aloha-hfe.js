var aloha_hfe_vars;
jQuery(document).ready(function ($) {    
    $('select#ehf_template_type').on('change', function () {
        if (aloha_hfe_vars.header_types.indexOf($('select#ehf_template_type').val()) != -1) {
            $('.hfe-options-row.transparent-header').show();
        }
        else{
            $('.hfe-options-row.transparent-header').hide();
        }
    });

});

