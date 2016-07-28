<?php
// We enqueued Flex Slider (Version 2.4.0 ) but feel free to try the most recent from github
// We enqueued it in the footer as it didn't need to be initialized in the header.


/** Existing Image Orientation Logic, feel free to use. */
$image_orientation = 'Get Option from form';
$image_size = 'themo_thumb_slider'; // Default image size, already added in our theme.

if($image_orientation === 'portrait'){
    $image_size = 'themo_thumb_slider_portrait'; // Portrait image size, already added in our theme.
}elseif($image_orientation === 'square'){
    $image_size = 'themo_portfolio_standard'; // Sqaure image size, already added in our theme.
}

$unique_number = 'asdfa98asdf89afds'; // Need to generate a unqiue number so that we can use multiple flex sliders on the same page.

echo '<div class="row">';
echo '<div id="'. $unique_number .'_inner" class="thumb-flex-slider flexslider flex-'. $image_orientation.' col-xs-12">';
echo '<ul class="slides gallery">';
$i = 1;
while ('lopp through repeater fields') {
    $unique_img_class = 'thumb-flex-slider-img-'.$i;

    echo '<li class="', $unique_img_class, '">';
    /** Teagan's Code Goes Here */

    echo '</li>';
    $i++;
}
echo '</ul><!-- /.slides -->';
echo '</div> <!-- /.thumb-flex-slider -->';
echo '</div><!-- /.row -->';

?>
<script>
    //-----------------------------------------------------
    // Initiate Thumbnail Slider (flexslider)
    // We also stored this in a global JS file so that we
    // didn't have to duplicate it everytime it was used.
    //-----------------------------------------------------
    function themo_start_thumb_slider(id) {
        jQuery(id).flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: true,
            slideshow: false,
            itemWidth: 255,
            itemMargin: 40,
            maxItems: 4,
            prevText: '',
            nextText: '',
            start: function(){
                jQuery('.thumb-flex-slider .slides img').show();
            }
        });
    }

    // This part may need to be output each time unless you can think of a better way to start the slider.
    jQuery(window).load(function() {
        jQuery('.thumb-flex-slider').show();
        themo_start_thumb_slider('#<?php echo sanitize_html_class($unique_number);?>_inner');
    });
</script>