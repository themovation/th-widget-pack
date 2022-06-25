<?php

if ( ! function_exists ( 'themovation_so_wb_scripts' ) ) :
// Enqueueing Frontend stylesheet and scripts.
    function themovation_so_wb_scripts() {

        //wp_enqueue_script( 'themo-js-head', THEMO_URL . 'js/themo-head.js', array('jquery'), THEMO_VERSION, false);
        wp_enqueue_script( 'themo-js-foot', THEMO_URL . 'js/themo-foot.js', array('jquery'), THEMO_VERSION, true);
        wp_register_script( 'themo-google-map', THEMO_URL . 'js/themo-google-maps.js', array(), THEMO_VERSION, true);

        // Enqueue font awesome on all pages
        wp_enqueue_style( 'font-awesome' );

        if ( wp_script_is( 'booked-font-awesome', 'enqueued' ) && wp_style_is( 'font-awesome', 'enqueued' ) ) {
            wp_dequeue_script( 'booked-font-awesome' );
        }
    }
endif;
add_action( 'wp_enqueue_scripts', 'themovation_so_wb_scripts', 20 );


if(!defined('WIDGET_ASSETS_TO_LOAD')){
    define('WIDGET_ASSETS_TO_LOAD', ['themo-tabs', 'themo-pricing-list','themo-blog','themo-accommodation-listing']);
}

if('uplands' == THEMO_CURRENT_THEME){
    // GOLF
    // FRONTEND // After Elementor registers all styles.
    //add_action( 'elementor/frontend/after_register_styles', 'th_enqueue_after_frontend_golf' );

    //function th_enqueue_after_frontend_golf() {

    //}

    // EDITOR // Before the editor scripts enqueuing.
    add_action( 'elementor/editor/before_enqueue_scripts', 'th_enqueue_before_editor_golf' );

    function th_enqueue_before_editor_golf() {
        wp_enqueue_style( 'themo-icons', THEMO_ASSETS_URL . 'icons/golf_icons.css', array(), THEMO_VERSION);
        // JS for the Editor
        //wp_enqueue_script( 'themo-editor-js', THEMO_URL  . 'js/th-editor.js', array(), THEMO_VERSION);
    }

}

// FRONTEND // After Elementor registers all styles.
add_action( 'elementor/frontend/after_register_styles', 'th_enqueue_after_frontend' );

function th_enqueue_after_frontend() {

    if('uplands' == THEMO_CURRENT_THEME) {
        wp_enqueue_style('themo-icons', THEMO_ASSETS_URL . 'icons/golf_icons.css', array(), THEMO_VERSION);
    }else{
        wp_enqueue_style( 'themo-icons', THEMO_ASSETS_URL . 'icons/icons.css', array(), THEMO_VERSION);
    }

    $timeChanged = filemtime(THEMO_PATH.'css/global.css');//THEMO_VERSION;
    wp_enqueue_style( 'thmv-global', THEMO_URL . 'css/global.css', array(), $timeChanged );
}

add_action( 'elementor/frontend/widget/before_render', function ( $widget ) {
    $widgetName = $widget->get_name();
    if(in_array($widgetName, WIDGET_ASSETS_TO_LOAD) && method_exists($widget, 'loadTHMVAssets')){
        $widget->loadTHMVAssets();
    }
} );



// EDITOR // Before the editor scripts enqueuing.
add_action( 'elementor/editor/before_enqueue_scripts', 'th_enqueue_before_editor' );

function th_enqueue_before_editor() {
    wp_enqueue_style( 'themo-icons', THEMO_ASSETS_URL . 'icons/icons.css', array(), THEMO_VERSION);

    $timeChangedEditor = filemtime(THEMO_PATH.'css/editor.css');
    wp_enqueue_style( 'themo-editor', THEMO_URL . 'css/editor.css', array(), $timeChangedEditor);

    $timeChangedFont = filemtime(THEMO_ASSETS_PATH.'icons/editor-icons.css');
    wp_enqueue_style( 'themo-editor-icons', THEMO_ASSETS_URL . 'icons/editor-icons.css', array(), $timeChangedFont);

    // JS for the Editor
    $timeChanged = filemtime(THEMO_PATH.'js/th-editor.js');
    wp_enqueue_script( 'themo-editor-js', THEMO_URL  . 'js/th-editor.js', array(), $timeChanged, true);

    $elementor_is_single_template = false;
    $elementsToTop = [];

    $templateBlockType = false;

    if(get_post_type() === 'elementor-thhf'){
        $templateBlockType = get_post_meta(get_the_ID(),'ehf_template_type', true );
        if('type_single' === $templateBlockType){
            $elementor_is_single_template = true;
            $locationSelection = get_post_meta(get_the_ID(),'ehf_target_include_locations', true );
            if(isset($locationSelection['rule']) && is_array($locationSelection['rule'])){
                foreach($locationSelection['rule'] as $location){
                    if(strpos($location, 'product|')!==false){
                        $elementsToTop[] = 'themo-woocommerce';
                        break;
                    }
                }
            }

            $elementsToTop[] = 'themo-single';
        }

    }
    wp_localize_script('themo-editor-js', 'themo_editor_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'active_theme' => 'themo-active-theme-'.THEMO_CURRENT_THEME,
        'elementor_theme_ui' => 'themo-elementor-'.th_get_elementor_theme_mode().'-mode',
        'elementor_single_elementor_slug' => $elementsToTop,
        'elementor_is_single_template' => $templateBlockType,
    ));
    $timeChanged2 = filemtime(THEMO_PATH.'css/accordion.css');
    wp_enqueue_style( 'thmv-accordion', THEMO_URL . 'css/accordion.css', array(), $timeChanged2 );

    //load font awesome
    if(!wp_style_is( 'font-awesome', 'enqueued' )){
        $elementorFile = ABSPATH . 'wp-content/plugins/elementor/elementor.php';
        $plugin_url = plugins_url('/', $elementorFile) . 'assets/lib/font-awesome';
        wp_enqueue_style('font-awesome', $plugin_url . '/css/all.min.css', array(), THEMO_VERSION);
    }


}


// PREVIEW // Before the preview styles enqueuing.
add_action( 'elementor/preview/enqueue_styles', 'th_enqueue_preview' );

function th_enqueue_preview() {
    wp_enqueue_style( 'themo-preview-style', THEMO_URL  . 'css/th-preview.css', array(), THEMO_VERSION);
    wp_enqueue_script( 'themo-preview-script', THEMO_URL  . 'js/th-preview.js', array(), THEMO_VERSION);
    wp_enqueue_script( 'themo-google-map', THEMO_URL . 'js/themo-google-maps.js', array(), THEMO_VERSION, true);


    $manager = \Elementor\Plugin::$instance->widgets_manager;
    foreach(WIDGET_ASSETS_TO_LOAD as $widgetType){
        $widget = $manager->get_widget_types($widgetType);
        if($widget && method_exists($widget, 'loadTHMVAssets')){
            $widget->loadTHMVAssets(true);
        }
    }

}

// FRONTEND // After Elementor registers all scripts.
//add_action( 'elementor/editor/after_enqueue_scripts', 'th_enqueue_after_frontend_scripts' );

function th_enqueue_after_frontend_scripts() {

    if(showLibrary()){
        // JS for the Editor
        //wp_enqueue_script( 'themo-editor-js', THEMO_URL  . 'js/th-editor.js', array(), THEMO_VERSION);
        $th_library_version = filemtime(THEMO_PATH . '/library/js/th-library.js');
        wp_enqueue_style( 'thmv-library-style', THEMO_URL . 'library/css/th-library.css', [ 'elementor-editor' ], THEMO_VERSION );
        wp_enqueue_script( 'thmv-library-script', THEMO_URL . 'library/js/th-library.js', [ 'elementor-editor', 'jquery-hover-intent' ], $th_library_version, true );

        $localized_data = [
            'i18n' => [
                'templatesEmptyTitle' => esc_html__( 'No Templates Found', 'th-widget-pack' ),
                'templatesEmptyMessage' => esc_html__( 'Try different category or sync for new templates.', 'th-widget-pack' ),
                'templatesNoResultsTitle' => esc_html__( 'No Results Found', 'th-widget-pack' ),
                'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different word.', 'th-widget-pack' ),
            ]
        ];

        wp_localize_script( 'thmv-library-script', 'ThBlockEditor', $localized_data );
    }
    else{
        $th_library_version = filemtime(THEMO_PATH.'/library/js/th-library-empty.js');
        wp_enqueue_script( 'thmv-empty-library-script', THEMO_URL . '/library/js/th-library-empty.js', [ 'elementor-editor', 'jquery-hover-intent' ], $th_library_version, true );
    }
}


add_action( 'elementor/editor/after_enqueue_scripts', 'th_enqueue_after_frontend_scripts' );
function showLibrary() {
    if (is_user_logged_in() && ( ENABLE_BLOCK_LIBRARY === true ) && get_option("theme_is_registered_stratusx", false)) {
        return true;
    } elseif (is_user_logged_in() && ( ENABLE_BLOCK_LIBRARY === true ) && ('bellevue' == THEMO_CURRENT_THEME && get_option("theme_is_registered_bellevuex", false))) {
        return true;
    } elseif (is_user_logged_in() && ( ENABLE_BLOCK_LIBRARY === true ) && (get_option("theme_is_registered_entrepreneurx", false))) {
        return true;
    }

    return false;
}

/* If Elementor P is not active, tuck away widgets. */
if ( ! function_exists ( 'thmv_tuck_pro_widgets' ) ) {
    function thmv_tuck_pro_widgets(){
        ?>
        <style>
            #elementor-panel-category-pro-elements,
            #elementor-panel-category-woocommerce-elements,
            #elementor-panel-category-theme-elements {
                display: none;
            }
        </style>
        <?php
    }
}

if ( !defined( 'ELEMENTOR_PRO_VERSION' )) {
    add_action( 'elementor/editor/footer', 'thmv_tuck_pro_widgets' );
}


if (is_admin()) {

    add_filter('ot_option_types_array', 'add_th_icons');

    function add_th_icons($types) {
        $types['th_room_icons'] = esc_html__('Icon List', 'bellevue');
    }

    function ot_type_th_room_icons($args = array()) {
        $elementorFile = ABSPATH . 'wp-content/plugins/elementor/elementor.php';
        if (!file_exists($elementorFile))
            return;

        if(!wp_style_is( 'font-awesome', 'enqueued' )){
            $plugin_url = plugins_url('/', $elementorFile) . 'assets/lib/font-awesome';
            wp_enqueue_style('font-awesome', $plugin_url . '/css/all.min.css', array(), THEMO_VERSION);
        }
        wp_enqueue_style('th-trip', THEMO_ASSETS_URL . 'icons/icons.css', array(), THEMO_VERSION);
        $trip_icons = array_values(array_filter(themo_icons(), function ($key) {return strpos($key, 'th-trip') === 0;}, ARRAY_FILTER_USE_KEY));
        $linea_icons = array_values(array_filter(themo_icons(), function ($key) {return strpos($key, 'th-linea') === 0;}, ARRAY_FILTER_USE_KEY));

        $arrayKeys = ['brands' => 'fab', 'solid' => 'fas', 'regular' => 'far'];
        $urls = [];

        foreach ($arrayKeys as $key => $fa) {
            wp_enqueue_style('font-awesome-' . $key, $plugin_url . '/css/' . $key . '.min.css', array(), time());
            $urls[$key] = $plugin_url . '/js/' . $key . '.js';
        }


        $timeChanged = filemtime(THEMO_PATH.'css/th-icons.css');
        wp_enqueue_style('th-icons', THEMO_URL . 'css/th-icons.css', array(), $timeChanged);

        $timeChanged2 = filemtime(THEMO_PATH.'js/th-icons.js');
        wp_enqueue_script('th-icons', THEMO_URL . 'js/th-icons.js', array(), $timeChanged2);

        wp_localize_script('th-icons', 'th_object',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'urls' => $urls,
                'keys' => $arrayKeys,
                'trip_icons' => $trip_icons,
                'linea_icons' => $linea_icons,
            )
        );

        $args['field_class'] = (isset($args['field_class']) ? $args['field_class'] : '');
        // Turns arguments array into variables.
        extract($args);

        // Verify a description.
        $has_desc = !empty($field_desc) ? true : false;

        echo '<div class="format-setting ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

        echo $has_desc ? '<div class="description">' . wp_kses_post(htmlspecialchars_decode($field_desc)) . '</div>' : '';

        echo '<div class="format-setting-inner">';

        echo '<div class="option-tree-th-icons-wrap">';

        $showCount = 12;
        for ($index = 0; $index < $showCount; $index++) {
            $value = isset($field_value[$index]) ? $field_value[$index]['value'] : '';
            $label = isset($field_value[$index]) ? $field_value[$index]['label'] : '';
            $library = isset($field_value[$index]) ? $field_value[$index]['library'] : '';
            $hasSomeValue = !empty($value) || !empty($label) ||$index == 0;
            echo '<div data-index="'.$index.'" class="icon-fields-wrapper '.($hasSomeValue ? 'icon-active' : '').'" ' . ($hasSomeValue || $index == 0 ? '' : 'style="display:none"') . '>';
            echo '<div class="icon-title"><div class="title">Icon</div><div class="order-buttons"><span data-action="up" class="order-up icon ot-icon-chevron-up" aria-hidden="true"></span><span data-action="down" class="order-down icon ot-icon-chevron-down" aria-hidden="true"></span></div></div>';
            echo '<div class="icon-holder add-th-icon">'
                . '<i class="' . (!empty($value) ? $value : 'icon ot-icon-plus-circle') . '" aria-hidden="true" ></i>'
                . '</div>';
            echo '<input type="text" placeholder="Label" name="' . esc_attr($field_name) . '[' . $index . '][label]" id="' . esc_attr($field_id) . '_' . $index . '_label" value="' . esc_attr($label) . '" class="' . esc_attr($field_class) . '"  />';
            echo '<input type="hidden" name="' . esc_attr($field_name) . '[' . $index . '][value]" id="' . esc_attr($field_id) . '_' . $index . '_value" value="' . esc_attr($value) . '" class="th_icon_value ' . esc_attr($field_class) . '" />';
            echo '<input type="hidden" name="' . esc_attr($field_name) . '[' . $index . '][library]" id="' . esc_attr($field_id) . '_' . $index . '_library" value="' . esc_attr($library) . '" class="th_icon_library ' . esc_attr($field_class) . '" />';
            echo '<a style="' . (!empty($hasSomeValue) ? '' : 'display:none') . '" href="#" class="remove-button button option-tree-ui-button button-secondary light"><span class="icon ot-icon-minus-circle"></span></a>';
            echo '</div>';
        }

        echo '</div>';
        echo '<div><a class="add-another-icon button-primary" href="#"><span class="icon ot-icon-plus-circle"></span></a></div>';

        echo '</div>';

        echo '</div>';
    }

}
