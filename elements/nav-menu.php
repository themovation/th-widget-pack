<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Themo_Widget_Nav_Menu extends Widget_Base {

    public function get_name() {
        return 'themo-nav-menu';
    }

    public function get_title() {
        return __( 'Nav Menu', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return [ 'themo-elements' ];
    }

    public function get_help_url() {
        return '';
    }

    public function get_menus(){
        $list = [];
        $menus = wp_get_nav_menus();
        foreach($menus as $menu){
            $list[$menu->slug] = $menu->name;
        }

        return $list;
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'thwidgetpack_content_tab',
            [
                'label' => esc_html__('Menu settings', 'th-widget-pack'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );



        $this->add_control(
            'thwidgetpack_nav_menu',
            [
                'label'     =>esc_html__( 'Select menu', 'th-widget-pack' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus(),
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_main_menu_position',
            [
                'label' => esc_html__( 'Horizontal menu position', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'elementskit-menu-po-left',
                'options' => [
                    'elementskit-menu-po-left'  => esc_html__( 'Left', 'th-widget-pack' ),
                    'elementskit-menu-po-center' => esc_html__( 'Center', 'th-widget-pack' ),
                    'elementskit-menu-po-right' => esc_html__( 'Right', 'th-widget-pack' ),
                    'elementskit-menu-po-justified'  => esc_html__( 'Justified', 'th-widget-pack' ),
                ],
            ]

        );

        $this->end_controls_section();
        $this->start_controls_section(
            'thwidgetpack_mobile_menu',
            [
                'label' => esc_html__('Mobile Menu Settings', 'th-widget-pack'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'thwidgetpack_nav_menu_logo',
            [
                'label' => esc_html__( 'Mobile Menu Logo', 'th-widget-pack' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'thwidgetpack_nav_menu_logo_link_to',
            [
                'label' => esc_html__( 'Menu link', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'home',
                'options' => [
                    'home' => esc_html__( 'Default(Home)', 'th-widget-pack' ),
                    'custom' => esc_html__( 'Custom URL', 'th-widget-pack' ),
                ],
            ]
        );

        $this->add_control(
            'thwidgetpack_nav_menu_logo_link',
            [
                'label' => esc_html__( ' Custom Link', 'th-widget-pack' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'condition' => [
                    'thwidgetpack_nav_menu_logo_link_to' => 'custom',
                ],
                'show_label' => false,

            ]
        );



        $this->add_control(
            'thwidgetpack_hamburger_icon',
            [
                'label' => __( 'Hamburger Icon (Optional)', 'th-widget-pack' ),
                'type' => Controls_Manager::ICONS,
                'separator' => 'before',
            ]
        );
			$this->add_control(
				'submenu_click_area',
				[
					'label'         => esc_html__('Submenu Click Area', 'th-widget-pack'),
					'type'          => Controls_Manager::SWITCHER,
					'label_on'      => esc_html__('Icon', 'th-widget-pack'),
					'label_off'     => esc_html__('Text', 'th-widget-pack'),
					'return_value'  => 'icon',
					'default'       => 'icon',
				]
			);
        $this->end_controls_section();


        $this->start_controls_section(
            'thwidgetpack_menu',
            [
                'label' => esc_html__('Menu Settings', 'th-widget-pack'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );




        $this->add_control(
            'thwidgetpack_one_page_enable',
            [
                'label' => esc_html__('Enable one page? ', 'th-widget-pack'),
                'description'	=> esc_html__('This works in the current page.', 'th-widget-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Yes', 'th-widget-pack' ),
                'label_off' =>esc_html__( 'No', 'th-widget-pack' ),
            ]
        );
        $this->add_control(
            'thwidgetpack_responsive_breakpoint',
            [
                'label' => __( 'Responsive Breakpoint', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ekit_menu_responsive_tablet',
                'options' => [
                    'ekit_menu_responsive_tablet'  => __( 'Tablet', 'th-widget-pack' ),
                    'ekit_menu_responsive_mobile' => __( 'Mobile', 'th-widget-pack' ),
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'thwidgetpack_menu_style_tab',
            [
                'label' => esc_html__('Menu Wrapper', 'th-widget-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menubar_height',
            [
                'label' => esc_html__( 'Menu Height', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop' ],
                'desktop_default' => [
                    'size' => 80,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'thwidgetpack_menu_wrap_h',
            [
                'label' => esc_html__( 'Menu wrapper background', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_menubar_background',
                'label' => esc_html__( 'Menu Panel Background', 'th-widget-pack' ),
                'types' => [ 'classic', 'gradient' ],
                'devices' => [ 'desktop' ],
                'selector' => '{{WRAPPER}} .elementskit-menu-container',
            ]
        );

        $this->add_responsive_control(
            'wrapper_color_mobile',
            [
                'label'     => esc_html__( 'Mobile Wrapper Background', 'th-widget-pack' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => [ 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-container'   => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_mobile_menu_panel_spacing',
            [
                'label' => esc_html__( 'Padding', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'tablet_default' => [
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'devices' => ['tablet'],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-nav-identity-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_mobile_menu_panel_width',
            [
                'label' => esc_html__( 'Width', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'devices' => ['tablet', 'mobile'],
                'range' => [
                    'px' => [
                        'min' => 350,
                        'max' => 700,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'tablet_default' => [
                    'size' => 350,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_border_radius',
            [
                'label' => esc_html__( 'Menu border radius', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'separator' => [ 'before' ],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ekit_menu_item_icon_spacing',
            [
                'label' => esc_html__( 'Menu Icon Spacing', 'th-widget-pack' ),
                'description' => esc_html__( 'This is only work with Mega menu icon option', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav li a .ekit-menu-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'thwidgetpack_style_tab_menuitem',
            [
                'label' => esc_html__('Menu item style', 'th-widget-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'thwidgetpack_content_typography',
                'label' => esc_html__( 'Typography', 'th-widget-pack' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav > li > a',
            ]
        );



        $this->add_control(
            'thwidgetpack_menu_item_h',
            [
                'label' => esc_html__( 'Menu Item Style', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->start_controls_tabs(
            'thwidgetpack_nav_menu_tabs'
        );
        // Normal
        $this->start_controls_tab(
            'thwidgetpack_nav_menu_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'th-widget-pack' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_item_background',
                'label' => esc_html__( 'Item background', 'th-widget-pack' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav > li > a',
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_text_color',
            [
                'label' => esc_html__( 'Item text color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'desktop_default' => '#000000',
                'tablet_default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'thwidgetpack_nav_menu_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'th-widget-pack' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_item_background_hover',
                'label' => esc_html__( 'Item background', 'th-widget-pack' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav > li > a:hover, {{WRAPPER}} .elementskit-navbar-nav > li > a:focus, {{WRAPPER}} .elementskit-navbar-nav > li > a:active, {{WRAPPER}} .elementskit-navbar-nav > li:hover > a',
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_item_color_hover',
            [
                'label' => esc_html__( 'Item text color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav > li > a:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav > li:hover > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav > li:hover > a .elementskit-submenu-indicator' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav > li > a:hover .elementskit-submenu-indicator' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav > li > a:focus .elementskit-submenu-indicator' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav > li > a:active .elementskit-submenu-indicator' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // active
        $this->start_controls_tab(
            'thwidgetpack_nav_menu_active_tab',
            [
                'label' => esc_html__( 'Active', 'th-widget-pack' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'		=> 'thwidgetpack_nav_menu_active_bg_color',
                'label' 	=> esc_html__( 'Item background', 'th-widget-pack' ),
                'types'		=> ['classic', 'gradient'],
                'selector'	=> '{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-item > a,{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-ancestor > a'
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_nav_menu_active_text_color',
            [
                'label' => esc_html__( 'Item text color (Active)', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-item > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-ancestor > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav > li.current-menu-ancestor > a .elementskit-submenu-indicator' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'thwidgetpack_menu_item_spacing',
            [
                'label' => esc_html__( 'Item Spacing', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => [ 'before' ],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 15,
                    'bottom' => 0,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 10,
                    'right' => 15,
                    'bottom' => 10,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'thwidgetpack_style_tab_submenu_item',
            [
                'label' => esc_html__('Submenu item style', 'th-widget-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'thwidgetpack_style_tab_submenu_item_arrow',
            [
                'label' => esc_html__( 'Submenu Indicator', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'thwidgetpack_line_arrow',
                'options' => [
                    'thwidgetpack_line_arrow'  => esc_html__( 'Line Arrow', 'th-widget-pack' ),
                    'thwidgetpack_plus_icon' => esc_html__( 'Plus', 'th-widget-pack' ),
                    'thwidgetpack_fill_arrow' => esc_html__( 'Fill Arrow', 'th-widget-pack' ),
                    'thwidgetpack_none' => esc_html__( 'None', 'th-widget-pack' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_style_tab_submenu_indicator_color',
            [
                'label' => esc_html__( 'Indicator color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' =>  '#000000',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav > li > a .elementskit-submenu-indicator' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'thwidgetpack_style_tab_submenu_item_arrow!' => 'thwidgetpack_none'
                ]
            ]
        );
        $this->add_responsive_control(
            'ekit_submenu_indicator_spacing',
            [
                'label' => esc_html__( 'Indicator Margin', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav-default .elementskit-dropdown-has>a .elementskit-submenu-indicator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'thwidgetpack_style_tab_submenu_item_arrow!' => 'thwidgetpack_none'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'thwidgetpack_menu_item_typography',
                'label' => esc_html__( 'Typography', 'th-widget-pack' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a',
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_submenu_item_spacing',
            [
                'label' => esc_html__( 'Spacing', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => [ 'desktop', 'tablet' ],
                'desktop_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'thwidgetpack_submenu_active_hover_tabs'
        );
        $this->start_controls_tab(
            'thwidgetpack_submenu_normal_tab',
            [
                'label'	=> esc_html__('Normal', 'th-widget-pack')
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_submenu_item_color',
            [
                'label' => esc_html__( 'Item text color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a' => 'color: {{VALUE}}',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_menu_item_background',
                'label' => esc_html__( 'Item background', 'th-widget-pack' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'thwidgetpack_submenu_hover_tab',
            [
                'label'	=> esc_html__('Hover', 'th-widget-pack')
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_item_text_color_hover',
            [
                'label' => esc_html__( 'Item text color (hover)', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_menu_item_background_hover',
                'label' => esc_html__( 'Item background (hover)', 'th-widget-pack' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '
					{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:hover,
					{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:focus,
					{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a:active,
					{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li:hover > a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'thwidgetpack_submenu_active_tab',
            [
                'label'	=> esc_html__('Active', 'th-widget-pack')
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_nav_sub_menu_active_text_color',
            [
                'label' => esc_html__( 'Item text color (Active)', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li.current-menu-item > a' => 'color: {{VALUE}} !important'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'		=> 'thwidgetpack_nav_sub_menu_active_bg_color',
                'label' 	=> esc_html__( 'Item background (Active)', 'th-widget-pack' ),
                'types'		=> ['classic', 'gradient'],
                'selector'	=> '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li.current-menu-item > a',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'thwidgetpack_menu_item_border_heading',
            [
                'label' => esc_html__( 'Sub Menu Items Border', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thwidgetpack_menu_item_border',
                'label' => esc_html__( 'Border', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li > a',
            ]
        );

        $this->add_control(
            'thwidgetpack_menu_item_border_last_child_heading',
            [
                'label' => esc_html__( 'Border Last Child', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thwidgetpack_menu_item_border_last_child',
                'label' => esc_html__( 'Border last Child', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li:last-child > a',
            ]
        );

        $this->add_control(
            'thwidgetpack_menu_item_border_first_child_heading',
            [
                'label' => esc_html__( 'Border First Child', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thwidgetpack_menu_item_border_first_child',
                'label' => esc_html__( 'Border First Child', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel > li:first-child > a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'thwidgetpack_style_tab_submenu_panel',
            [
                'label' => esc_html__('Submenu panel style', 'th-widget-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'sub_panel_padding',
			[
				'label'         => esc_html__('Padding', 'th-widget-pack'),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'top'       => '15',
                    'bottom'    => '15',
                    'left'      => '0',
                    'right'     => '0',
                    'isLinked'  => false,
                ],
				'selectors'     => [
					'{{WRAPPER}} .elementskit-submenu-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thwidgetpack_panel_submenu_border',
                'label' => esc_html__( 'Panel Menu Border', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_submenu_container_background',
                'label' => esc_html__( 'Container background', 'th-widget-pack' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel',
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_submenu_panel_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'desktop_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_submenu_container_width',
            [
                'label' => esc_html__( 'Conatiner width', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'devices' => [ 'desktop' ],
                'desktop_default' => '220px',
                'tablet_default' => '200px',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel' => 'min-width: {{VALUE}};',
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'thwidgetpack_panel_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'th-widget-pack' ),
                'selector' => '{{WRAPPER}} .elementskit-navbar-nav .elementskit-submenu-panel',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'thwidgetpack_menu_toggle_style_tab',
            [
                'label' => esc_html__( 'Humburger Style', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'thwidgetpack_menu_toggle_style_title',
            [
                'label' => esc_html__( 'Humburger Toggle', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_toggle_icon_position',
            [
                'label' => esc_html__( 'Position', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Top', 'th-widget-pack' ),
                        'icon' => 'fa fa-angle-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Middle', 'th-widget-pack' ),
                        'icon' => 'fa fa-angle-right',
                    ],
                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-hamburger' => 'float: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_toggle_spacing',
            [
                'label' => esc_html__( 'Padding', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-hamburger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_toggle_width',
            [
                'label' => esc_html__( 'Width', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 45,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-hamburger' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_toggle_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-hamburger' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_open_typography',
            [
                'label' => esc_html__( 'Icon Size', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 15,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-hamburger > .ekit-menu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'thwidgetpack_hamburger_icon[value]!'    => '',
                ],
            ]
        );

        $this->start_controls_tabs(
            'thwidgetpack_menu_toggle_normal_and_hover_tabs'
        );

        $this->start_controls_tab(
            'thwidgetpack_menu_toggle_normal',
            [
                'label' => esc_html__( 'Normal', 'th-widget-pack' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_menu_toggle_background',
                'label' => esc_html__( 'Background', 'th-widget-pack' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .elementskit-menu-hamburger',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thwidgetpack_menu_toggle_border',
                'label' => esc_html__( 'Border', 'th-widget-pack' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elementskit-menu-hamburger',
            ]
        );

        $this->add_control(
            'thwidgetpack_menu_toggle_icon_color',
            [
                'label' => esc_html__( 'Humber Icon Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-hamburger .elementskit-menu-hamburger-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-menu-hamburger > .ekit-menu-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'thwidgetpack_menu_toggle_hover',
            [
                'label' => esc_html__( 'Hover', 'th-widget-pack' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_menu_toggle_background_hover',
                'label' => esc_html__( 'Background', 'th-widget-pack' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .elementskit-menu-hamburger:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thwidgetpack_menu_toggle_border_hover',
                'label' => esc_html__( 'Border', 'th-widget-pack' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elementskit-menu-hamburger:hover',
            ]
        );

        $this->add_control(
            'thwidgetpack_menu_toggle_icon_color_hover',
            [
                'label' => esc_html__( 'Humber Icon Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-hamburger:hover .elementskit-menu-hamburger-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .elementskit-menu-hamburger:hover > .ekit-menu-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'thwidgetpack_menu_close_style_title',
            [
                'label' => esc_html__( 'Close Toggle', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'thwidgetpack_menu_close_typography',
                'label' => esc_html__( 'Typography', 'th-widget-pack' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementskit-menu-close',
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_close_spacing',
            [
                'label' => esc_html__( 'Padding', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_close_margin',
            [
                'label' => esc_html__( 'Margin', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
                    'top' => '12',
                    'right' => '12',
                    'bottom' => '12',
                    'left' => '12',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_close_width',
            [
                'label' => esc_html__( 'Width', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 45,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-close' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_menu_close_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'tablet' ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-close' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'thwidgetpack_menu_close_normal_and_hover_tabs'
        );

        $this->start_controls_tab(
            'thwidgetpack_menu_close_normal',
            [
                'label' => esc_html__( 'Normal', 'th-widget-pack' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_menu_close_background',
                'label' => esc_html__( 'Background', 'th-widget-pack' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .elementskit-menu-close',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thwidgetpack_menu_close_border',
                'label' => esc_html__( 'Border', 'th-widget-pack' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elementskit-menu-close',
            ]
        );

        $this->add_control(
            'thwidgetpack_menu_close_icon_color',
            [
                'label' => esc_html__( 'Humber Icon Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'rgba(51, 51, 51, 1)',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-close' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'thwidgetpack_menu_close_hover',
            [
                'label' => esc_html__( 'Hover', 'th-widget-pack' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'thwidgetpack_menu_close_background_hover',
                'label' => esc_html__( 'Background', 'th-widget-pack' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .elementskit-menu-close:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thwidgetpack_menu_close_border_hover',
                'label' => esc_html__( 'Border', 'th-widget-pack' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elementskit-menu-close:hover',
            ]
        );

        $this->add_control(
            'thwidgetpack_menu_close_icon_color_hover',
            [
                'label' => esc_html__( 'Humber Icon Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-menu-close:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'thwidgetpack_mobile_menu_logo_style_tab',
            [
                'label' => esc_html__( 'Mobile Menu Logo', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_mobile_menu_logo_width',
            [
                'label' => esc_html__( 'Width', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 5,
                    ],
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 160,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 120,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-nav-logo > img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_mobile_menu_logo_height',
            [
                'label' => esc_html__( 'Height', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-nav-logo > img' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_mobile_menu_logo_margin',
            [
                'label' => esc_html__( 'Margin', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'tablet_default' => [
                    'top' => '5',
                    'right' => '0',
                    'bottom' => '5',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => 'false',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-nav-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thwidgetpack_mobile_menu_logo_padding',
            [
                'label' => esc_html__( 'Padding', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'tablet_default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-nav-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();
        $hamburger_icon_value = '';
        $hamburger_icon_type = '';
        if ($settings['thwidgetpack_hamburger_icon'] != '' && $settings['thwidgetpack_hamburger_icon']) {
            if ($settings['thwidgetpack_hamburger_icon']['library'] !== 'svg') {
                $hamburger_icon_value = esc_attr($settings['thwidgetpack_hamburger_icon']['value']);
                $hamburger_icon_type = esc_attr('icon');
            } else {
                $hamburger_icon_value = esc_url($settings['thwidgetpack_hamburger_icon']['value']['url']);
                $hamburger_icon_type = esc_attr('url');
            }
        }

        // Responsive menu breakpoint
        $responsive_menu_breakpoint = '';
        if ($settings['thwidgetpack_responsive_breakpoint'] === 'ekit_menu_responsive_tablet') {
            $responsive_menu_breakpoint = "1024";
        } else {
            $responsive_menu_breakpoint = "767";
        }

        echo '<div class="ekit-wid-con '.$settings['thwidgetpack_responsive_breakpoint'].'" data-hamburger-icon="'.$hamburger_icon_value.'" data-hamburger-icon-type="'.$hamburger_icon_type.'" data-responsive-breakpoint="'.$responsive_menu_breakpoint.'">';
        $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {
        $settings = $this->get_settings_for_display();

        if($settings['thwidgetpack_nav_menu'] != '' && wp_get_nav_menu_items($settings['thwidgetpack_nav_menu']) !== false && count(wp_get_nav_menu_items($settings['thwidgetpack_nav_menu'])) > 0){
            $link = $target = $nofollow = '';

            if (isset($settings['thwidgetpack_nav_menu_logo_link_to']) && $settings['thwidgetpack_nav_menu_logo_link_to'] == 'home') {
                $link = get_home_url();
            }elseif(isset($settings['thwidgetpack_nav_menu_logo_link'])){
                $link = $settings['thwidgetpack_nav_menu_logo_link']['url'];
                $target = ($settings['thwidgetpack_nav_menu_logo_link']['is_external'] != "on" ? "" : "_blank");
                $nofollow = ($settings['thwidgetpack_nav_menu_logo_link']['nofollow'] != "on" ? "" : "nofollow");
            }

            $metadata = '';//\ElementsKit_Lite\Utils::img_meta($settings['thwidgetpack_nav_menu_logo']['id']);
            $markup = '
				<div class="elementskit-nav-identity-panel">
					<div class="elementskit-site-title">
						<a class="elementskit-nav-logo" href="'.$link.'" target="'.(!empty($target) ? $target : '_self').'" rel="'.$nofollow.'">
							<img src="'.$settings['thwidgetpack_nav_menu_logo']['url'].'" alt="'.(isset($metadata['alt']) ? $metadata['alt'] : '').'">
						</a>
					</div>
					<button class="elementskit-menu-close elementskit-menu-toggler" type="button">X</button>
				</div>
			';
            $args = [
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>' . $markup,
                'container'       => 'div',
                'container_id'    => 'ekit-megamenu-' . $settings['thwidgetpack_nav_menu'],
                'container_class' => 'elementskit-menu-container elementskit-menu-offcanvas-elements elementskit-navbar-nav-default ' . $settings['thwidgetpack_style_tab_submenu_item_arrow'] . ' ekit-nav-menu-one-page-' . $settings['thwidgetpack_one_page_enable'],
                'menu_id'         => 'main-menu',
                'menu'         	  => $settings['thwidgetpack_nav_menu'],
                'menu_class'      => 'elementskit-navbar-nav ' . $settings['thwidgetpack_main_menu_position'] .' submenu-click-on-'. $settings['submenu_click_area'],
                'depth'           => 4,
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'walker'          => (class_exists('\ThWidgetPack\Menu_Walker') ? new \ThWidgetPack\Menu_Walker() : '' )
            ];

            wp_nav_menu($args);
        }
    }
    protected function _content_template() { }
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Nav_Menu() );