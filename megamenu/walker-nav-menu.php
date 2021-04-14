<?php
namespace ThWidgetPack;

class Menu_Walker extends \Walker_Nav_Menu
{
    public $menu_Settings;

    private static $key = 'thwidgetpack_options';
    public static $menuitem_settings_key = 'thwidgetpack_menuitem_settings';
    public static $megamenu_settings_key = 'megamenu_settings';

    public function get_option($key, $default = ''){
        $data_all = get_option(self::$key);
        return (isset($data_all[$key]) && $data_all[$key] != '') ? $data_all[$key] : $default;
    }

    // custom methods
    public function get_item_meta($menu_item_id){
        $meta_key = self::$menuitem_settings_key;
        $data = get_post_meta($menu_item_id, $meta_key, true);
        $data = (array) json_decode($data);

        $default = [
            "menu_id" => null,
            "menu_has_child" => '',
            "menu_enable" => 0,
            "menu_icon" => '',
            "menu_icon_color" => '',
            "menu_badge_text" => '',
            "menu_badge_color" => '',
            "menu_badge_background" => '',
            "mobile_submenu_content_type" => 'builder_content',
            "vertical_megamenu_position_type" => 'relative_position',
            "vertical_menu_width" => '',
            "megamenu_width_type" => 'default_width',
        ];
        return array_merge($default, $data);
    }

    public function is_megamenu($menu_slug){
        $menu_slug = ( ( (gettype($menu_slug) == 'object') && (isset($menu_slug->slug)) ) ? $menu_slug->slug : $menu_slug );

        $cache_key = 'thwidgetpack_megamenu_data_' . $menu_slug;
        $cached = wp_cache_get( $cache_key );
		if ( false !== $cached ) {
			return $cached;
        }

        $return = 0;

        $settings = $this->get_option(self::$megamenu_settings_key, []);
        $term = get_term_by('slug', $menu_slug, 'nav_menu');

        if( isset($term->term_id)
            && isset($settings['menu_location_' . $term->term_id])
            && $settings['menu_location_' . $term->term_id]['is_enabled'] == '1' ){

            $return = 1;
        }

        wp_cache_set( $cache_key, $return );
        return $return;
    }

    public function is_megamenu_item($item_meta, $menu){
        if($this->is_megamenu($menu) == 1 && $item_meta['menu_enable'] == 1 && class_exists( 'Elementor\Plugin' ) ){
            return true;
        }
        return false;
    }

    /**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    /**
     * Start the element output.
     *
     * @see Walker::start_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $args   = (object) $args;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        //$submenu = $args->has_children ? ' hfe-has-submenu' : '';

        /**
         * Filter the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        // New
        $class_names .= ' nav-item hfe-creative-menu';
        $item_meta = $this->get_item_meta($item->ID);
        $is_megamenu_item = $this->is_megamenu_item($item_meta, $args->menu);

        if (in_array('menu-item-has-children', $classes) || $is_megamenu_item == true) {
            $class_names .= ' hfe-has-submenu thwidgetpack-dropdown-has '.$item_meta['vertical_megamenu_position_type'].' thwidgetpack-dropdown-menu-'.$item_meta['megamenu_width_type'].'';
        }

        if ($is_megamenu_item == true) {
            $class_names .= ' thwidgetpack-megamenu-has';
        }

        if ($item_meta['mobile_submenu_content_type'] == 'builder_content') {
            $class_names .= ' thwidgetpack-mobile-builder-content';
        }

        if (in_array('current-menu-item', $classes)) {
            $class_names .= ' active';
        }


        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        /**
         * Filter the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        // New
        $data_attr = '';
        switch ($item_meta['megamenu_width_type']) {
            case 'default_width':
                $data_attr =  esc_attr( ' data-vertical-menu=750px' );
                break;

            case 'full_width':
                $data_attr =  ' data-vertical-menu=""';
                break;

            case 'custom_width':
                $data_attr = $item_meta['vertical_menu_width'] === '' ? esc_attr( ' data-vertical-menu=750px' ) : esc_attr( ' data-vertical-menu='.$item_meta['vertical_menu_width'].'' );
                break;

            default:
                $data_attr =  esc_attr( ' data-vertical-menu=750px' );
                break;
        }
        //
        $output .= $indent . '<li' . $id . $class_names . $data_attr . '>';
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $submenu_indicator = '';

        // New
        if ($depth === 0) {
            $atts['class'] = 'ekit-menu-nav-link hfe-menu-item';
        }
        if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
            $atts['class']       .= ' ekit-menu-dropdown-toggle';
        }
        if (in_array('menu-item-has-children', $classes) || $is_megamenu_item == true) {
            $submenu_indicator    .= '<i class="icon-arrows-down thwidgetpack-submenu-indicator"></i>';
        }
        if ($depth > 0) {
            $manual_class = array_values($classes)[0] .' '. 'hfe-sub-menu-item';
            $atts ['class']= $manual_class;
        }
        if (in_array('current-menu-item', $item->classes)) {
            $atts['class'] .= ' active';
        }

        //
        /**
         * Filter the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title  Title attribute.
         *     @type string $target Target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param object $item  The current menu item.
         * @param array  $args  An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output  = $args->walker->has_children ? '<div class="hfe-has-submenu-container">' : '';
        $item_output .= $args->before;
        
        //$item_output .= '<a'. $attributes .'>';

        $item_output .= '<a' . $attributes;
		if ( 0 === $depth ) {
			$item_output .= ' class = "hfe-menu-item"';
		} else {
			$item_output .= in_array( 'current-menu-item', $item->classes ) ? ' class = "hfe-sub-menu-item hfe-sub-menu-item-active"' : ' class = "hfe-sub-menu-item"';
		}

		$item_output .= '>';

        /** This filter is documented in wp-includes/post-template.php */
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        if ( $args->walker->has_children ) {
			$item_output .= "<span class='hfe-menu-toggle sub-arrow hfe-menu-child-";
			$item_output .= $depth;
			$item_output .= "'><i class='fa'></i></span>";
		}
        $item_output .= '</a>';
        //$item_output .= $submenu_indicator . '</a>';
        $item_output .= $args->after;
        $item_output .= $args->walker->has_children ? '</div>' : '';
        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item        Menu item data object.
         * @param int    $depth       Depth of menu item. Used for padding.
         * @param array  $args        An array of {@see wp_nav_menu()} arguments.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Page data object. Not used.
     * @param int    $depth  Depth of page. Not Used.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ($depth === 0) {
            if($this->is_megamenu($args->menu) == 1){
                $item_meta = $this->get_item_meta($item->ID);

                if($item_meta['menu_enable'] == 1 && class_exists( 'Elementor\Plugin' ) ){
                    $builder_post_title = 'dynamic-content-megamenu-menuitem' . $item->ID;
                    $builder_post = get_page_by_title($builder_post_title, OBJECT, 'thwidgetpack_content');
                    $output .= '<ul class="thwidgetpack-megamenu-panel">';
                    if($builder_post != null){
                        $elementor = \Elementor\Plugin::instance();
                        $output .= $elementor->frontend->get_builder_content_for_display( $builder_post->ID );
                    }else{
                        $output .= esc_html__('No content found', 'th-widget-pack');
                    }

                    $output .= '</ul>';
                }
            }
            $output .= "</li>\n";
        }
    }
}
