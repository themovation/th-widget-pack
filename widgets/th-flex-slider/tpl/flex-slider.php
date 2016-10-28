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

<div id='home-slider'>
    <style scoped>
        #main-flex-slider .themo_slider_0{padding-top:100px ; padding-bottom:100px }
        #main-flex-slider .themo_slider_1{padding-top:70px ; padding-bottom:70px }
    </style>
    <div id="main-flex-slider" class="flexslider">
        <ul class="slides">
            <li>
                <div class="slider-bg slide-cal-center form-bg dark-bg light-text themo_slider_0" style=" background-image:url('http://snappy.themovation.com/bellevue/wp-content/uploads/2015/06/Placeholder-Landscape-Dark-1920x1080.jpg');">
                    <div class='container'>
                        <div class="row lrg-txt ">
                            <div class="slider-content col-sm-6">
                                <h1 class="slider-title">Exclusive and Rustic</h1>
                                <div class="slider-subtitle ">
                                    <p>Rooms $99 per night or Chalet $998 per night.</p>
                                </div>
                                <div class='page-title-button '>
                                    <a href="#button1" target='_blank' class="btn btn-ghost   th-btn">Button 1</a>
                                    <a href="#button2" target='_blank' class="btn btn-standard   th-btn">Button 2</a>
                                </div>
                                <div class="page-title-image ">
                                    <a href='#featuredimage' target='_blank' title='Hello'>
                                        <img width="210" height="80" src="http://snappy.themovation.com/bellevue/wp-content/uploads/2015/07/brands-bbb.png" class="hero wp-post-image" alt="brands-bbb" srcset="http://snappy.themovation.com/bellevue/wp-content/uploads/2015/07/brands-bbb.png 210w, http://snappy.themovation.com/bellevue/wp-content/uploads/2015/07/brands-bbb-105x40.png 105w" sizes="(max-width: 210px) 100vw, 210px" />
                                    </a>
                                </div>
                                <div>
                                    [shortcode output]
                                </div>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.slider-bg -->
            </li>
            <li>
                <div class="slider-bg slide-cal-left form-bg dark-bg light-text themo_slider_1" style="background-color:#000000; background-image:url('http://snappy.themovation.com/bellevue/wp-content/uploads/2015/06/Placeholder-Landscape-Dark-1920x1080.jpg');">
                    <div class='container'>
                        <div class="row ">
                            <div class="slider-content col-sm-6">
                                <h1 class="slider-title">Carmanah Suite</h1>
                                <div class="slider-subtitle ">
                                    <p>Sleeps 2, Amazing Views. <a href="rooms/carmanah/?portorder=menu">Book Today.</a></p>
                                </div>
                                <div>
                                    [shortcode output]
                                </div>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.slider-bg -->
            </li>
        </ul>
        <a href="#the-chalet" target="_self" class="slider-scroll-down th-icon th-i-down"></a>
    </div><!-- /.main-flex-slider -->
</div><!-- /#home-slider -->
<script>
    jQuery(window).load(function() {
        themo_adjust_padding_transparent_header('#main-flex-slider .themo_slider_0');
        themo_adjust_padding_transparent_header('#main-flex-slider .themo_slider_1');
        themo_start_flex_slider('#main-flex-slider','fade', 'swing', true, true, 4000, 550, false, true, true, true, false);
    });
</script>