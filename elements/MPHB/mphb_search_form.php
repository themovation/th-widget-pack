<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_MPHB_Search_Form extends Widget_Base {

    public function get_name() {
        return 'themo-mphb-search-form';
    }

    public function get_title() {
        return __( 'Accommodation Availability Search', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return [ 'themo-elements' ];
    }

    public function get_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }
    
    public function is_reload_preview_required() {
        return true;
    }

    protected function _register_controls() {

        // Check that the class exists before trying to use it

    if(is_object(MPHB())){
        $minAdults   = MPHB()->settings()->main()->getMinAdults();
        $maxAdults   = MPHB()->settings()->main()->getSearchMaxAdults();
        $minChildren = MPHB()->settings()->main()->getMinChildren();
        $maxChildren = MPHB()->settings()->main()->getSearchMaxChildren();
    }else{
        $minAdults   = '1';
        $maxAdults   = '30';
        $minChildren = '0';
        $maxChildren = '10';
    }

    /*
    echo "<pre>";
    var_dump(MPHB());   //true
    echo "</pre>";
    */

        $this->start_controls_section(
            'section_shortcode',
            [
                'label' => __( 'Search Form', 'th-widget-pack' ),
            ]
        );

        $this->add_control('adults', array(
            'type'        => Controls_Manager::NUMBER,
            'label'       => __('Adults', 'th-widget-pack'),
            'description' => __('The number of adults presetted in the search form.', 'th-widget-pack'),
            'default'     => $minAdults,
            'min'         => $minAdults,
            'max'         => $maxAdults,
            'dynamic' => [
                'active' => true,
            ],
        ));

        $this->add_control('children', array(
            'type'        => Controls_Manager::NUMBER,
            'label'       => __('Children', 'th-widget-pack'),
            'description' => __('The number of children presetted in the search form.', 'th-widget-pack'),
            'default'     => $minChildren,
            'min'         => $minChildren,
            'max'         => $maxChildren,
            'dynamic' => [
                'active' => true,
            ],
        ));

        $this->add_control('attributes', array(
            'type'        => Controls_Manager::TEXT,
            'label'       => __('Attributes', 'th-widget-pack'),
            'description' => __('Custom attributes for advanced search.', 'th-widget-pack'),
            'placeholder' => __('Slugs of attributes', 'th-widget-pack'),
            'default'     => '',
            'dynamic' => [
                'active' => true,
            ]
        ));


        $this->add_control(
            'inline_form',
            [
                'label' => __( 'Formidable Form Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inline',
                'options' => [
                    'none' => __( 'Default', 'th-widget-pack' ),
                    'inline' => __( 'Inline', 'th-widget-pack' ),
                    'stacked' => __( 'Stretched', 'th-widget-pack' ),

                ],
            ]
        );

        $this->add_control(
            'slide_shortcode_border',
            [
                'label' => __( 'Form Background', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'th-widget-pack' ),
                    'th-form-bg th-light-bg' => __( 'Light', 'th-widget-pack' ),
                    'th-form-bg th-dark-bg' => __( 'Dark', 'th-widget-pack' ),

                ],
                'condition' => [
                    'inline_form' => 'stacked',
                ],
            ]
        );

        $this->add_control(
            'button_1_style',
            [
                'label' => __( 'Button Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'standard-primary',
                'options' => [
                    'standard-primary' => __( 'Standard Primary', 'th-widget-pack' ),
                    'standard-accent' => __( 'Standard Accent', 'th-widget-pack' ),
                    'standard-light' => __( 'Standard Light', 'th-widget-pack' ),
                    'standard-dark' => __( 'Standard Dark', 'th-widget-pack' ),
                    'ghost-primary' => __( 'Ghost Primary', 'th-widget-pack' ),
                    'ghost-accent' => __( 'Ghost Accent', 'th-widget-pack' ),
                    'ghost-light' => __( 'Ghost Light', 'th-widget-pack' ),
                    'ghost-dark' => __( 'Ghost Dark', 'th-widget-pack' ),
                    'cta-primary' => __( 'CTA Primary', 'th-widget-pack' ),
                    'cta-accent' => __( 'CTA Accent', 'th-widget-pack' ),
                ],
            ]
        );

        $this->add_control(
            'slide_text_align',
            [
                'label' => __( 'Align', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
            ]
        );


        $this->add_control(
            'hide_required_notices',
            [
                'label' => __( 'Hide Required Tips', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'label_on',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_search-wrapper .mphb-required-fields-tip' => 'display:none;',
                    '{{WRAPPER}} .mphb_sc_search-wrapper label abbr' => 'display:none;',
                ],
            ]
        );

        $this->add_control(
            'content_max_width',
            [
                'label' => __( 'Content Width', 'th-widget-pack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .th-fo-form' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tip_color',
            [
                'label' => __( 'Required Tips Colour', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-required-fields-tip small' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tip_color_typography',
                'selector' => '{{WRAPPER}} .mphb-required-fields-tip small',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,

            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Label Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_search-wrapper label' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_color_typography',
                'selector' => '{{WRAPPER}} .mphb_sc_search-wrapper label',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        global $post;

        $settings = $this->get_settings_for_display();

        // Include MPHB hook
        do_action('mphbe_before_search_form_widget_render', $settings);

        if(is_object(MPHB())){
            $themo_MPHB_shortcode = MPHB()->getShortcodes()->getSearch();
            $th_shortcode = $themo_MPHB_shortcode->render($settings, null, $themo_MPHB_shortcode->getName());
        }

        /*
        *  We need to add our own form style classes here to match the style of the theme.
        *  Add frm_form_field class to all classes starting with mphb_sc_search-
        *  Exclude classes mphb_sc_search-wrapper , mphb_sc_search-form, mphb_sc_search-submit
        */
        $themo_pattern = '/mphb_sc_search-(?!wrapper|form|submit-button-wrapper)([^"]*)/';
        $themo_replacement = 'mphb_sc_search-$1 frm_form_field';
        $th_shortcode = preg_replace($themo_pattern, $themo_replacement,$th_shortcode);

        // Add with_frm_style to wrapper classes
        $themo_pattern = '/mphb_sc_search-wrapper([^"]*)/';
        $themo_replacement = 'mphb_sc_search-wrapper$1 frm_forms with_frm_style';
        $th_shortcode = preg_replace($themo_pattern, $themo_replacement,$th_shortcode);

        // Add frm_submit to submit button class
        $themo_pattern = '/mphb_sc_search-submit-button-wrapper([^"]*)/';
        $themo_replacement = 'mphb_sc_search-submit-button-wrapper$1 frm_submit';
        $th_shortcode = preg_replace($themo_pattern, $themo_replacement,$th_shortcode);


        $th_form_border_class = false;
        $th_formidable_class = 'th-form-default';
        if ( isset( $settings['inline_form'] ) && $settings['inline_form'] > "" ) :
            switch ( $settings['inline_form'] ) {
                case 'stacked':
                    $th_formidable_class = 'th-form-stacked';
                    if ( isset( $settings['slide_shortcode_border'] ) && $settings['slide_shortcode_border'] != 'none' ) {
                        $th_form_border_class = $settings['slide_shortcode_border'];
                    }
                    break;
                case 'inline':
                    $th_formidable_class = 'th-conversion';
                    break;
            }
        endif;

        /* Form Styling */
        $th_cal_align_class = false;
        if ( isset( $settings['slide_text_align'] ) && $settings['slide_text_align'] > "" ) {
            switch ( $settings['slide_text_align'] ) {
                case 'left':
                    $th_cal_align_class = ' th-left';
                    break;
                case 'center':
                    $th_cal_align_class = ' th-centered';
                    break;
                case 'right':
                    $th_cal_align_class = ' th-right';
                    break;
            }
        }

        $this->add_render_attribute( 'th-form-class', 'class', 'th-fo-form');
        $this->add_render_attribute( 'th-form-class', 'class', esc_attr( $th_cal_align_class ) );
        $this->add_render_attribute( 'th-form-class', 'class', esc_attr( $th_formidable_class ) );
        $this->add_render_attribute( 'th-form-class', 'class', esc_attr( $th_form_border_class ) );
        $this->add_render_attribute( 'th-form-class', 'class', 'th-btn-form' );
        $this->add_render_attribute( 'th-form-class', 'class', 'btn-' . esc_attr( $settings['button_1_style'] . '-form' ) );

        $themo_form_styling = false;
        if ( function_exists( 'get_theme_mod' ) ) {
            $themo_mphb_styling = get_theme_mod('themo_mphb_use_theme_styling', true);
            if ($themo_mphb_styling == true) {
                $themo_form_styling = $this->get_render_attribute_string( 'th-form-class');
            }
        }

        ?>
        <div <?php echo $themo_form_styling; ?>><?php echo $th_shortcode; ?></div>
        <?php
        // Include MPHB hook
        do_action('mphbe_after_search_form_widget_render', $settings);

    }

    public function render_plain_content() {
        // In plain mode, render without shortcode
        echo $this->get_settings( 'shortcode' );
    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_MPHB_Search_Form() );
