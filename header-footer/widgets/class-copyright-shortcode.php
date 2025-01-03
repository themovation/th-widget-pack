<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Copyright_Shortcode extends Copyright\Copyright_Shortcode {

    public function __construct() {

        add_shortcode('thmv_current_year', [$this, 'display_current_year']);
        add_shortcode('thmv_site_title', [$this, 'display_site_title']);
    }
}
