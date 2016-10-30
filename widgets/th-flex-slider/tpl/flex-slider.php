<?php

// Flex slider Options stored in Option Tree
if ( function_exists( 'ot_get_option' ) ) {
    $themo_flex_animation  = ot_get_option( 'themo_flex_animation', "fade" );
    $themo_flex_easing  = ot_get_option( 'themo_flex_easing', "swing" );
    $themo_flex_animationloop  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_animationloop', true ));
    $themo_flex_smoothheight  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_smoothheight', false ));
    $themo_flex_slideshowspeed  = ot_get_option( 'themo_flex_slideshowspeed', 7000 );
    $themo_flex_animationspeed  = ot_get_option( 'themo_flex_animationspeed', 600 );
    $themo_flex_randomize  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_randomize', false ));
    $themo_flex_pauseonhover  =themo_return_on_off_boolean( ot_get_option( 'themo_flex_pauseonhover', true ));
    $themo_flex_touch  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_touch', true ));
    $themo_flex_directionnav  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_directionnav', true ));
    $themo_flex_controlNav  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_controlNav', true ));
}
?>


<style scoped>
    #main-flex-slider .themo_slider_0{padding-top:205px ; padding-bottom:205px }
    #main-flex-slider .themo_slider_1{padding-top:150px ; padding-bottom:150px }
    #main-flex-slider .themo_slider_2{padding-top:205px ; padding-bottom:205px }
    #main-flex-slider .themo_slider_3{padding-top:40px ; padding-bottom:60px }
    #main-flex-slider .themo_slider_4{padding-top:110px ; padding-bottom:130px }
</style>

<div id="main-flex-slider" class="flexslider" >
    <ul class="slides">
        <li>
            <div class="slider-bg slide-cal-center light-text themo_slider_0" style=" background-image:url('http://stratus-3c99.kxcdn.com/stratus/wp-content/uploads/2015/11/home-app-gradient.jpg');    ">
                <div class='container'>
                    <div class="row lrg-txt ">
                        <h1 class="slider-title ">Title</h1>
                        <div class="slider-subtitle  ">
                            <p>Content</p>
                        </div>
                        <div class='page-title-button  '>
                            <a href="https://themeforest.net/item/stratus-app-saas-product-showcase/13674236?ref=Themovation" target="_blank" title="Buy on App Store" class="th-btn btn-image">
                                <img src="http://stratus-3c99.kxcdn.com/stratus/wp-content/uploads/2015/11/app_store_button-260x80.png" alt="">
                            </a>
                            <a href="https://themeforest.net/item/stratus-app-saas-product-showcase/13674236?ref=Themovation" target="_blank" title="Buy on Google Play" class="th-btn btn-image">
                                <img src="http://stratus-3c99.kxcdn.com/stratus/wp-content/uploads/2015/11/google_play_button-260x80.png" alt="">
                            </a>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.slider-bg -->
        </li>
        <li>
            <div class="slider-bg slide-cal-center  themo_slider_1" style=" background-image:url('http://stratus-3c99.kxcdn.com/stratus/wp-content/uploads/2015/11/slider_home_1_slide_2_opt.jpg');    ">
                <div class='container'>
                    <div class="row lrg-txt ">
                        <h1 class="slider-title ">Title</h1>
                        <div class="slider-subtitle  ">
                            <p>Content</p>
                        </div>
                        <div class="simple-conversion ">
                            [Formidable shortcode output - Form is here just as an example.]
                            <div class="frm_forms  with_frm_style frm_style_formidable-style" id="frm_form_9_container">
                                <form enctype="multipart/form-data" method="post" class="frm-show-form " id="form_2ssykv22" >
                                    <div class="frm_form_fields ">
                                        <fieldset>
                                            <input type="hidden" name="frm_action" value="create" />
                                            <input type="hidden" name="form_id" value="9" />
                                            <input type="hidden" name="frm_hide_fields_9" id="frm_hide_fields_9" value="" />
                                            <input type="hidden" name="form_key" value="2ssykv22" />
                                            <input type="hidden" name="item_meta[0]" value="" />
                                            <input type="hidden" id="frm_submit_entry_9" name="frm_submit_entry_9" value="bb40086ac2" /><input type="hidden" name="_wp_http_referer" value="/stratus/home-cloud/" />
                                            <div id="frm_field_41_container" class="frm_form_field form-field  frm_none_container">
                                                <label for="field_qy05f83" class="frm_primary_label">Name
                                                    <span class="frm_required"></span>
                                                </label>
                                                <input type="text" id="field_qy05f83" name="item_meta[41]" value=""  placeholder="Name"  />
                                            </div>
                                            <div id="frm_field_42_container" class="frm_form_field form-field  frm_required_field frm_none_container">
                                                <label for="field_3asv293" class="frm_primary_label">Email Address
                                                    <span class="frm_required">*</span>
                                                </label>
                                                <input type="text" id="field_3asv293" name="item_meta[42]" value=""  placeholder="Email Address" data-reqmsg="This field cannot be blank."  />
                                            </div>
                                            <div id="frm_field_43_container" class="frm_form_field form-field  frm_none_container">
                                                <label for="field_2ywico3" class="frm_primary_label">Company Name
                                                    <span class="frm_required"></span>
                                                </label>
                                                <input type="text" id="field_2ywico3" name="item_meta[43]" value=""  placeholder="Company Name"  />
                                            </div>
                                            <input type="hidden" name="item_key" value="" />
                                            <div class="frm_submit">
                                                <input type="submit" value="Start Free Trial"  />
                                                <img class="frm_ajax_loading" src="http://demo.themovation.com/stratus/wp-content/plugins/formidable/images/ajax_loader.gif" alt="Sending" style="visibility:hidden;" />
                                            </div>
                                        </fieldset>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.slider-bg -->
        </li>
        <li>
            <div class="slider-bg slide-cal-center light-text themo_slider_2" style=" background-image:url('http://stratus-3c99.kxcdn.com/stratus/wp-content/uploads/2015/11/space-4.jpg'); background-attachment:scroll; background-position:center bottom; background-repeat:no-repeat; ">
                <div class='container'>
                    <div class="row lrg-txt ">
                        <h1 class="slider-title">Title</h1>
                        <div class='page-title-button '>
                            <a href="#explore" class="btn btn-standard   th-btn">Button 1</a>
                            <a href="#buynow" class="btn btn-ghost   th-btn">Button 2</a>
                        </div>
                        <div class="page-title-image ">
                            <img width="720" height="433" src="http://stratus-3c99.kxcdn.com/stratus/wp-content/uploads/2015/11/MB-isolated-clear-screen.png" class="hero wp-post-image" alt="MB-isolated-clear-screen" />
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.slider-bg -->
        </li>
        <li>
            <div class="slider-bg slide-cal-left light-text themo_slider_3" style="background-color:#000000; background-image:url('http://entrepreneur-3c99.kxcdn.com/entrepreneur/physician/wp-content/uploads/sites/3/2015/02/physician-slider.jpg');    ">
                <div class='container'>
                    <div class="row lrg-txt ">
                        <div class="slider-content col-sm-6">
                            <h1 class="slider-title">Title</h1>
                            <p>[booked calendar shortcode goes here]
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </p>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.slider-bg -->
        </li>

        <li>
            <div class="slider-bg slide-cal-right form-bg light-bg light-text themo_slider_4" style=" background-image:url('http://entrepreneur-3c99.kxcdn.com/entrepreneur/consultant/wp-content/uploads/sites/5/2015/03/consultant-slider-large-02.jpg');    ">
                <div class='container'>
                    <div class="row lrg-txt ">
                        <div class="slider-content col-sm-6">
                            <h1 class="slider-title ">Title</h1>
                            <div class="simple-conversion ">
                                [Formidable shortcode output - Form is here just as an example.]
                                <div class="frm_forms  with_frm_style frm_style_formidable-style" id="frm_form_3_container">
                                    <form enctype="multipart/form-data" method="post" class="frm-show-form " id="form_2ssykv" >
                                        <div class="frm_form_fields ">
                                            <fieldset>
                                                <input type="hidden" name="frm_action" value="create" />
                                                <input type="hidden" name="form_id" value="3" />
                                                <input type="hidden" name="frm_hide_fields_3" id="frm_hide_fields_3" value="" />
                                                <input type="hidden" name="form_key" value="2ssykv" />
                                                <input type="hidden" name="item_meta[0]" value="" />
                                                <input type="hidden" id="frm_submit_entry_3" name="frm_submit_entry_3" value="91203c3124" /><input type="hidden" name="_wp_http_referer" value="/entrepreneur/consultant/" />
                                                <div id="frm_field_16_container" class="frm_form_field form-field  frm_none_container">
                                                    <label for="field_qy05f8" class="frm_primary_label">Name
                                                        <span class="frm_required"></span>
                                                    </label>
                                                    <input type="text" id="field_qy05f8" name="item_meta[16]" value=""  placeholder="Name"  />
                                                </div>
                                                <div id="frm_field_17_container" class="frm_form_field form-field  frm_required_field frm_none_container">
                                                    <label for="field_3asv29" class="frm_primary_label">Email Address
                                                        <span class="frm_required">*</span>
                                                    </label>
                                                    <input type="text" id="field_3asv29" name="item_meta[17]" value=""  placeholder="Email Address" data-reqmsg="This field cannot be blank."  />
                                                </div>
                                                <div id="frm_field_18_container" class="frm_form_field form-field  frm_none_container">
                                                    <label for="field_2ywico" class="frm_primary_label">Company Name
                                                        <span class="frm_required"></span>
                                                    </label>
                                                    <input type="text" id="field_2ywico" name="item_meta[18]" value=""  placeholder="Company Name"  />
                                                </div>
                                                <input type="hidden" name="item_key" value="" />
                                                <div class="frm_submit">
                                                    <input type="submit" value="Send"  />
                                                    <img class="frm_ajax_loading" src="http://demo.themovation.com/entrepreneur/consultant/wp-content/plugins/formidable/images/ajax_loader.gif" alt="Sending" style="visibility:hidden;" />
                                                </div></fieldset>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.slider-bg -->
        </li>
    </ul>
</div>

<script>
    jQuery(window).load(function() {
        themo_start_flex_slider('#main-flex-slider','fade', 'swing', true, true, 4000, 550, false, true, true, true, true);
    });
</script>