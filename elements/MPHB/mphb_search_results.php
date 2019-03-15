<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_MPHB_Search_Results extends Widget_Base {

    public function get_name() {
        return 'themo-mphb-search-results';
    }

    public function get_title() {
        return __( 'Hotel Search Results', 'th-widget-pack' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return [ 'themo-elements' ];
    }

    public function is_reload_preview_required() {
        return true;
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_counter_block',
            [
                'label' => __( 'Information Section', 'th-widget-pack' ),
            ]
        );

        $this->add_control('counter_text', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Hide Section', 'th-widget-pack'),
            'description' => __('Displays above Recommendation Section. Example: "2 accommodations found from [Start Date] - till [End Date]', 'th-widget-pack'),
            'label_on' => __( 'On', 'th-widget-pack' ),
            'label_off' => __( 'Off', 'th-widget-pack' ),
            'selectors' => [
                '{{WRAPPER}} .mphb_sc_search_results-info' => 'display:none',
            ],
            'default' => '',
        ));


        $this->end_controls_section();

        $this->start_controls_section(
            'section_recommendation_block',
            [
                'label' => __( 'Recommendation Section', 'th-widget-pack' ),
            ]
        );

        $this->add_control('recommendation_title', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Hide Title', 'th-widget-pack'),
            //'description' => __('Whether to display title of the accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'On', 'th-widget-pack' ),
            'label_off' => __( 'Off', 'th-widget-pack' ),
            'selectors' => [
                '{{WRAPPER}} .mphb-recommendation-title' => 'display:none',
            ],
            'default' => '',
        ));

        $this->add_control('recommendation_content', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Hide Recommendations', 'th-widget-pack'),
            'description' => __('Displays above Search Results. It recommends the best set of accommodations according to a number of guests in a list.', 'th-widget-pack'),
            'label_on' => __( 'On', 'th-widget-pack' ),
            'label_off' => __( 'Off', 'th-widget-pack' ),
            'selectors' => [
                '{{WRAPPER}} #mphb-recommendation' => 'display:none',
            ],
            'default' => '',
        ));

        $this->end_controls_section();

        $this->start_controls_section(
            'section_search_results',
            [
                'label' => __( 'Search Results', 'th-widget-pack' ),
            ]
        );

        $this->add_control('section_heading', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Section Heading', 'th-widget-pack'),
            //'description' => __('Whether to display title of the accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'On', 'th-widget-pack' ),
            'label_off' => __( 'Off', 'th-widget-pack' ),
            'selectors' => [
                '{{WRAPPER}} .mphb-reservation-details' => 'display:none',
            ],
            'default' => '',
        ));

        $this->add_control('title', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Title', 'th-widget-pack'),
            //'description' => __('Whether to display title of the accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ));

        $this->add_control('featured_image', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Featured image', 'th-widget-pack'),
            //'description' => __('Whether to display featured image of the accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control('gallery', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Gallery', 'th-widget-pack'),
            //'description' => __('Whether to display gallery of the accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control('excerpt', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Excerpt', 'th-widget-pack'),
            //'description' => __('Whether to display excerpt (short description) of the accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control('details', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Details', 'th-widget-pack'),
            //'description' => __('Whether to display details of the accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control('price', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('Price', 'th-widget-pack'),
            //'description' => __('Whether to display price of the accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        $this->add_control('view_button', array(
            'type'        => Controls_Manager::SWITCHER,
            'label'       => __('View button', 'th-widget-pack'),
            //'description' => __('Whether to display "View Details" button with the link to accommodation type.', 'th-widget-pack'),
            'label_on' => __( 'Show', 'th-widget-pack' ),
            'label_off' => __( 'Hide', 'th-widget-pack' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ));

        /*$this->add_control(
            'full_width_submit_button',
            [
                'label' => __( 'Full Width Submit Button', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_checkout-submit-wrapper.frm_submit input' => 'width:100%;',

                ],
                'separator' => 'before'
            ]
        );*/

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
                'separator' => 'before'
            ]
        );





        /*$this->add_control(
            'important_note',
            [
                //'label' => __( 'Note', 'th-widget-pack' ),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( '<p style="line-height: 17px;">This widget is designed to work inside the Checkout Page. See: Accommodation / Settings / General / Checkout Page. 
                              <p style="line-height: 17px; margin-top: 10px;">Use the booking form on the front-end to preview your styling changes.</p>', 'th-widget-pack' ),
                'content_classes' => 'themo-elem-html-control',
                'separator' => 'before'
            ]
        );*/


        $this->end_controls_section();

        $this->start_controls_section('section_order', array(
            'label'       => __('Order', 'th-widget-pack')
        ));

        $this->add_control('orderby', array(
            'type'        => Controls_Manager::SELECT,
            'label'       => __('Order By', 'th-widget-pack'),
            'default'     => 'menu_order',
            'options'     => array(
                'none'           => __('No order', 'th-widget-pack'),
                //'ID'             => __('Post ID', 'th-widget-pack'),
                //'author'         => __('Post author', 'th-widget-pack'),
                'title'          => __('Post title', 'th-widget-pack'),
                'name'           => __('Post name (post slug)', 'th-widget-pack'),
                'date'           => __('Post date', 'th-widget-pack'),
                //'modified'       => __('Last modified date', 'th-widget-pack'),
                //'parent'         => __('Parent ID', 'th-widget-pack'),
                'rand'           => __('Random order', 'th-widget-pack'),
                //'comment_count'  => __('Number of comments', 'th-widget-pack'),
                //'relevance'      => __('Relevance', 'th-widget-pack'),
                'menu_order'     => __('Page order', 'th-widget-pack'),
                //'meta_value'     => __('Meta value', 'th-widget-pack'),
                //'meta_value_num' => __('Numeric meta value', 'th-widget-pack'),
                'post__in'       => __('Price', 'th-widget-pack')
            )
        ));

        $this->add_control('order', array(
            'type'        => Controls_Manager::SELECT,
            'label'       => __('Order', 'th-widget-pack'),
            'default'     => 'ASC',
            'options'     => array(
                'ASC'            => __('Ascending (1,2,3)', 'th-widget-pack'),
                'DESC'           => __('Descending (3,2,1)', 'th-widget-pack')
            )
        ));

        /*$this->add_control('meta_key', array(
            'type'        => Controls_Manager::TEXT,
            'label'       => __('Meta Name', 'th-widget-pack'),
            'description' => __('Custom field name. Required if "orderby" is one of the "meta_value", "meta_value_num" or "meta_value_*".', 'th-widget-pack'),
            'default'     => ''
        ));*/

        /*$this->add_control('meta_type', array(
            'type'        => Controls_Manager::SELECT,
            'label'       => __('Meta Type', 'th-widget-pack'),
            'description' => __('Specified type of the custom field. Can be used in conjunction with "orderby" = "meta_value".', 'th-widget-pack'),
            'default'     => '',
            'options'     => array(
                ''               => __('Any', 'th-widget-pack'),
                'NUMERIC'        => __('Numeric', 'th-widget-pack'),
                'BINARY'         => __('Binary', 'th-widget-pack'),
                'CHAR'           => __('String', 'th-widget-pack'),
                'DATE'           => __('Date', 'th-widget-pack'),
                'TIME'           => __('Time', 'th-widget-pack'),
                'DATETIME'       => __('Date and time', 'th-widget-pack'),
                'DECIMAL'        => __('Decimal number', 'th-widget-pack'),
                'SIGNED'         => __('Signed number', 'th-widget-pack'),
                'UNSIGNED'       => __('Unsigned number', 'th-widget-pack')
            )
        ));*/

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Colors', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'headings_1_color',
            [
                'label' => __( 'Heading 1', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],

            ]
        );

        $this->add_control(
            'headings_2_color',
            [
                'label' => __( 'Heading 2', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} h4' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],

            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} li' => 'color: {{VALUE}};',
                    '{{WRAPPER}} th' => 'color: {{VALUE}};',
                    '{{WRAPPER}} td' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],

            ]
        );


        $this->add_control(
            'tip_color',
            [
                'label' => __( 'Required Tips', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb-required-fields-tip' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],

            ]
        );


        $this->add_control(
            'label_color',
            [
                'label' => __( 'Labels', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mphb_sc_checkout-wrapper label' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();



        $atts = $this->get_settings();

        //echo '<pre>';
        //print_r($atts);
        //echo '</pre>';

        //do_action('mphbe_before_search_results_widget_render', $atts);

        //echo '<pre>';
        //print_r($atts);
        //echo '</pre>';

        //$shortcode = MPHB()->getShortcodes()->getSearchResults();
        //echo $shortcode->render($atts, null, $shortcode->getName());

        //do_action('mphbe_after_search_results_widget_render', $atts);


            //$th_shortcode = '[mphb_search_results'.$atts.']';
            //$th_shortcode = sanitize_text_field( $th_shortcode );
            //$th_shortcode = do_shortcode( shortcode_unautop( $th_shortcode ) );

            $th_form_border_class = false;
            //$th_formidable_class = 'th-form-default';

            //$this->add_render_attribute( 'th-form-class', 'class', 'th-fo-form');
            //$this->add_render_attribute( 'th-form-class', 'class', esc_attr( $th_cal_align_class ) );
            //$this->add_render_attribute( 'th-form-class', 'class', esc_attr( $th_formidable_class ) );
            //$this->add_render_attribute( 'th-form-class', 'class', esc_attr( $th_form_border_class ) );
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
            <div <?php echo $themo_form_styling; ?>>
                <?php
                do_action('mphbe_before_search_results_widget_render', $atts);

                $shortcode = MPHB()->getShortcodes()->getSearchResults();
                echo $shortcode->render($atts, null, $shortcode->getName());

                do_action('mphbe_after_search_results_widget_render', $atts);
                ?>
            </div>
            <?php
        //}
    }

    public function render_plain_content() {
        // In plain mode, render without shortcode
        echo $this->get_settings( 'shortcode' );
    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_MPHB_Search_Results() );
